<?php

require_once '../acceso/Conexion.clase.php';

class Grupo extends Conexion {
    public $codigo_grupo;
    public $anio;
    public $descripcion;
    public $codigo_categoria;
    public $codigo_docente;
    public $estado;

    public function getCodigo_grupo(){
        return $this->codigo_grupo;
    }
    
    public function setCodigo_grupo($codigo_grupo){
        $this->codigo_grupo = $codigo_grupo;
        return $this;
    }

    public function getAnio(){
        return $this->anio;
    }
    
    public function setAnio($anio){
        $this->anio = $anio;
        return $this;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getCodigo_categoria(){
        return $this->codigo_categoria;
    }
    
    public function setCodigo_categoria($codigo_categoria){
        $this->codigo_categoria = $codigo_categoria;
        return $this;
    }

    public function getCodigo_docente(){
        return $this->codigo_docente;
    }
    
    public function setCodigo_docente($codigo_docente){
        $this->codigo_docente = $codigo_docente;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }
    
    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function agregar() {
        $this->beginTransaction();
        try {            
            $campos_valores = 
            array("anio"=>$this->getAnio(),
                  "descripcion"=>strtoupper($this->getDescripcion()),
                  "codigo_categoria"=>$this->getCodigo_categoria(),
                  "codigo_docente"=>$this->getCodigo_docente());            

            $this->insert("grupos", $campos_valores);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function editar() {
        $this->beginTransaction();
        try { 
            $campos_valores = 
            array("anio"=>$this->getAnio(),
                  "descripcion"=>strtoupper($this->getDescripcion()),
                  "codigo_categoria"=>$this->getCodigo_categoria(),
                  "codigo_docente"=>$this->getCodigo_docente()); 

            $campos_valores_where = array("codigo_grupo"=>$this->getCodigo_grupo());

            $this->update("grupos", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se actualizado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT 
                        g.*,
                        c.nombre as categoria,
                        CONCAT(d.nombres,' ',d.paterno,' ',d.materno) as docente,
                        (SELECT COUNT(*) FROM horarios WHERE codigo_grupo = g.codigo_grupo) as total_horario
                    FROM grupos g 
                    INNER JOIN categorias c ON g.codigo_categoria = c.codigo_categoria
                    INNER JOIN docentes d ON g.codigo_docente = d.codigo_docente
                    WHERE g.estado = :0";
            $resultado = $this->consultarFilas($sql,array($this->getEstado()));
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function leerDatos() {
        try {
            $sql = "SELECT * FROM grupos WHERE codigo_grupo =:0";
            $resultado = $this->consultarFila($sql,array($this->getCodigo_grupo()));
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function darBaja() {
        $this->beginTransaction();
        try {
            $texto = $this->getEstado() != '1' ? 
                'Se inactivado existosamente' : 'Se activado existosamente';
            
            $campos_valores = array("estado"=>$this->getEstado());
            $campos_valores_where = array("codigo_grupo"=>$this->getCodigo_grupo());

            $this->update("grupos", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>$texto);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function llenarCB() {
        try {
            $sql = "SELECT 
                        g.*,
                        c.nombre as categoria                      
                    FROM grupos g 
                    INNER JOIN categorias c ON g.codigo_categoria = c.codigo_categoria 
                    WHERE g.estado = 1";
            $resultado = $this->consultarFilas($sql);
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

}