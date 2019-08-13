<?php

require_once '../acceso/Conexion.clase.php';

class Categoria extends Conexion {
    private $codigo_categoria;
    private $nombre;
    private $estado;

    public function getCodigo_categoria(){
        return $this->codigo_categoria;
    }
    
    public function setCodigo_categoria($codigo_categoria){
        $this->codigo_categoria = $codigo_categoria;
        return $this;
    }

    public function getNombre(){
        return $this->nombre;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
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
            $campos_valores = array("nombre"=>strtoupper($this->getNombre()));            

            $this->insert("categorias", $campos_valores);
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
            $campos_valores = array("nombre"=>strtoupper($this->getNombre()));

            $campos_valores_where = array("codigo_categoria"=>$this->getCodigo_categoria());

            $this->update("categorias", $campos_valores,$campos_valores_where);
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
            $sql = "SELECT * FROM categorias WHERE estado = :0";
            $resultado = $this->consultarFilas($sql,array($this->getEstado()));
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function leerDatos() {
        try {
            $sql = "SELECT * FROM categorias WHERE codigo_categoria =:0";
            $resultado = $this->consultarFila($sql,array($this->getCodigo_categoria()));
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
            $campos_valores_where = array("codigo_categoria"=>$this->getCodigo_categoria());

            $this->update("categorias", $campos_valores,$campos_valores_where);
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
            $sql = "SELECT * FROM categorias WHERE estado = 1";
            $resultado = $this->consultarFilas($sql);
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }


}