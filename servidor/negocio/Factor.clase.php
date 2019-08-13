<?php

require_once '../acceso/Conexion.clase.php';

class Factor extends Conexion {

    public function llenarCB() {
        try {
            $sql = "SELECT * FROM tabla_factor_actividad";
            $resultado = $this->consultarFilas($sql);
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }


}