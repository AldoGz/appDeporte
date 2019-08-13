<?php

require_once '../acceso/Conexion.clase.php';

class Horario extends Conexion {
    private $codigo_horario;
    private $dia;
    private $horario_inicio;
    private $horario_fin;
    private $codigo_grupo;

    public function getCodigo_horario(){
        return $this->codigo_horario;
    }
    
    public function setCodigo_horario($codigo_horario){
        $this->codigo_horario = $codigo_horario;
        return $this;
    }

    public function getDia(){
        return $this->dia;
    }
    
    public function setDia($dia){
        $this->dia = $dia;
        return $this;
    }

    public function getHorario_inicio(){
        return $this->horario_inicio;
    }
    
    public function setHorario_inicio($horario_inicio){
        $this->horario_inicio = $horario_inicio;
        return $this;
    }

    public function getHorario_fin(){
        return $this->horario_fin;
    }
    
    public function setHorario_fin($horario_fin){
        $this->horario_fin = $horario_fin;
        return $this;
    }

    public function getCodigo_grupo(){
        return $this->codigo_grupo;
    }
    
    public function setCodigo_grupo($codigo_grupo){
        $this->codigo_grupo = $codigo_grupo;
        return $this;
    }

    public function agregar(){
        $this->beginTransaction();
        try {            
            $campos_valores = 
            array(  "dia"=>$this->getDia(),
                    "horario_inicio"=>$this->getHorario_inicio(),
                    "horario_fin"=>$this->getHorario_fin(),
                    "codigo_grupo"=>$this->getCodigo_grupo());
            
            $this->insert("horarios", $campos_valores);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function editar(){
        $this->beginTransaction();
        try {            
            $campos_valores = 
            array(  "dia"=>$this->getDia(),
                    "horario_inicio"=>$this->getHorario_inicio(),
                    "horario_fin"=>$this->getHorario_fin(),
                    "codigo_grupo"=>$this->getCodigo_grupo());
            
            $campos_valores_where = 
            array(  "codigo_horario"=>$this->getCodigo_horario());

            $this->update("horarios", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se actualizado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function leerDatos(){
        try {
            $sql = "SELECT * FROM horarios WHERE codigo_horario = :0";
            $resultado = $this->consultarFila($sql,array($this->getCodigo_horario()));           
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function eliminar(){
        $this->beginTransaction();
        try {            
            $campos_valores = 
            array(  "codigo_horario"=>$this->getCodigo_horario());
            
            $this->delete("horarios", $campos_valores);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se eliminado correctamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }
    
    public function ver() {
        try {
            $sql = "SELECT
                    codigo_horario,
                    IF(dia=1,'LUNES',IF(dia=2,'MARTES',IF(dia=3,'Miercoles',IF(dia=4,'Jueves',IF(dia=5,'Viernes',IF(dia=6,'Sábado','Domingo')))))) as dia,
                    IF(DATE_FORMAT(horario_inicio, '%p')='AM','Mañana','Tarde') as turno,
                    CONCAT(
                        IF( 
                            DATE_FORMAT(horario_inicio, '%H') = 0,
                            '12',
                            IF(
                                DATE_FORMAT(horario_inicio, '%H')>12,
                                CONCAT('0',DATE_FORMAT(horario_inicio, '%H')-12),
                                DATE_FORMAT(horario_inicio, '%H')
                            )    
                        ),':',DATE_FORMAT(horario_inicio, '%i'),' ',DATE_FORMAT(horario_inicio, '%p')
                    ) as horario_inicio,
                    CONCAT(
                        IF(
                            DATE_FORMAT(horario_fin, '%H') = 0,
                            '12',
                            IF(
                                DATE_FORMAT(horario_fin, '%H')>12,
                                CONCAT('0',DATE_FORMAT(horario_fin, '%H')-12),
                                DATE_FORMAT(horario_fin, '%H')
                            )    
                        ),':',DATE_FORMAT(horario_fin, '%i'),' ',DATE_FORMAT(horario_fin, '%p')
                    ) as horario_fin
                    FROM horarios
                    WHERE codigo_grupo = :0
                    ORDER BY 2";
            $resultado = $this->consultarFilas($sql,array($this->getCodigo_grupo()));           
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }
    






}