<?php

require_once '../acceso/Conexion.clase.php';

class Inscripcion extends Conexion {
    private $codigo_inscripcion;
    private $codigo_alumno;
    private $codigo_grupo;
    private $estado;

    public function getCodigo_inscripcion(){
        return $this->codigo_inscripcion;
    }
    
    public function setCodigo_inscripcion($codigo_inscripcion){
        $this->codigo_inscripcion = $codigo_inscripcion;
        return $this;
    }

    public function getCodigo_alumno(){
        return $this->codigo_alumno;
    }
    
    public function setCodigo_alumno($codigo_alumno){
        $this->codigo_alumno = $codigo_alumno;
        return $this;
    }

    public function getCodigo_grupo(){
        return $this->codigo_grupo;
    }
    
    public function setCodigo_grupo($codigo_grupo){
        $this->codigo_grupo = $codigo_grupo;
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
            $sql = "SELECT COUNT(*) FROM inscripciones WHERE codigo_alumno = :0 AND estado = 1";           
            $fila = intval($this->consultarValor($sql,array($this->getCodigo_alumno())));

            if ( $fila == 1 ) {
               return array("rpt"=>true,"estado"=>false,"msj"=>"Se tiene un registro de inscripcion guardada. Intento más tarde.");
            }
            $campos_valores = array(
                "codigo_grupo"=>$this->getCodigo_grupo(),
                "codigo_alumno"=>$this->getCodigo_alumno()
                );            

            $this->insert("inscripciones", $campos_valores);
            $this->commit();
            return array("rpt"=>true,"estdo"=>true,"msj"=>"Se agregado exitosamente");            
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function editar() {
        $this->beginTransaction();
        try { 
            $sql = "SELECT COUNT(*) FROM inscripciones WHERE codigo_alumno = :0 AND estado = 1";           
            $fila = intval($this->consultarValor($sql,array($this->getCodigo_alumno())));

            if ( $fila == 1 ) {
               return array("rpt"=>true,"estado"=>false,"msj"=>"Se tiene un registro de inscripcion guardada. Intento más tarde.");
            }

            $campos_valores = array(
                "codigo_grupo"=>$this->getCodigo_grupo(),
                "codigo_alumno"=>$this->getCodigo_alumno()
                );

            $campos_valores_where = array("codigo_inscripcion"=>$this->getCodigo_inscripcion());

            $this->update("inscripciones", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"estado"=>true,"msj"=>"Se actualizado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT i.*,CONCAT('(',documento,') ',nombres,' ',paterno,' ',materno) as alumno,CONCAT('(',g.descripcion,') ',c.nombre) as grupo 
                    FROM inscripciones i 
                    INNER JOIN alumnos a ON i.codigo_alumno = a.codigo_alumno 
                    INNER JOIN grupos g ON i.codigo_grupo = g.codigo_grupo 
                    INNER JOIN categorias c ON g.codigo_categoria = c.codigo_categoria
                    WHERE i.estado = :0";
            $resultado = $this->consultarFilas($sql,array($this->getEstado()));
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function leerDatos() {
        try {
            $sql = "SELECT * FROM inscripciones WHERE codigo_inscripcion =:0";
            $resultado = $this->consultarFila($sql,array($this->getCodigo_inscripcion()));
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
            $campos_valores_where = array("codigo_inscripcion"=>$this->getCodigo_inscripcion());

            $this->update("inscripciones", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>$texto);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

}