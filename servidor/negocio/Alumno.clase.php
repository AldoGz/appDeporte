<?php

require_once '../acceso/Conexion.clase.php';

class Alumno extends Conexion {
    private $codigo_alumno;
    private $documento;
    private $nombres;
    private $paterno;
    private $materno;
    private $sexo;
    private $fecha_nacimiento;
    private $foto;
    private $estado;

    public function getCodigo_alumno(){
        return $this->codigo_alumno;
    }
    
    public function setCodigo_alumno($codigo_alumno){
        $this->codigo_alumno = $codigo_alumno;
        return $this;
    }

    public function getDocumento(){
        return $this->documento;
    }
    
    public function setDocumento($documento){
        $this->documento = $documento;
        return $this;
    }

    public function getNombres(){
        return $this->nombres;
    }
    
    public function setNombres($nombres){
        $this->nombres = $nombres;
        return $this;
    }

    public function getPaterno(){
        return $this->paterno;
    }
    
    public function setPaterno($paterno){
        $this->paterno = $paterno;
        return $this;
    }
    public function getMaterno(){
        return $this->materno;
    }
    
    public function setMaterno($materno){
        $this->materno = $materno;
        return $this;
    }

    public function getSexo(){
        return $this->sexo;
    }
    
    public function setSexo($sexo){
        $this->sexo = $sexo;
        return $this;
    }

    public function getFecha_nacimiento(){
        return $this->fecha_nacimiento;
    }
    
    public function setFecha_nacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
        return $this;
    }

    public function getFoto(){
        return $this->foto;
    }
    
    public function setFoto($foto){
        $this->foto = $foto;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }
    
    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function correlativo(){
        try {
            $sql = "SELECT CONCAT('imgAlum',CASE WHEN COUNT(*)=0 THEN 1 ELSE COUNT(*)+1 END,'.jpg') as foto FROM alumnos WHERE foto<>'defecto.jpg'";
            return $this->consultarValor($sql);            
        } catch (Exception $exc) {
            throw $exc;
        }
    }



    public function agregar() {
        $this->beginTransaction();
        try {            
            $campos_valores = 
            array(  "documento"=>$this->getDocumento(),
                    "nombres"=>strtoupper($this->getNombres()),
                    "paterno"=>strtoupper($this->getPaterno()),
                    "materno"=>strtoupper($this->getMaterno()),
                    "sexo"=>$this->getSexo(),
                    "fecha_nacimiento"=>$this->getFecha_nacimiento(),
                    "foto"=>$this->getFoto());

            $this->insert("alumnos", $campos_valores);

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
            array(  "documento"=>$this->getDocumento(),
                    "nombres"=>strtoupper($this->getNombres()),
                    "paterno"=>strtoupper($this->getPaterno()),
                    "materno"=>strtoupper($this->getMaterno()),
                    "sexo"=>$this->getSexo(),
                    "fecha_nacimiento"=>$this->getFecha_nacimiento(),
                    "foto"=>$this->getFoto());

            $campos_valores_where = 
            array(  "codigo_alumno"=>$this->getCodigo_alumno());

            $this->update("alumnos", $campos_valores,$campos_valores_where);

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
                        codigo_alumno,
                        CONCAT(nombres,' ',paterno,' ',materno) as nombres,
                        IF(sexo=1,'MASCULINO','FEMENINO') as sexo,
                        CONCAT(EXTRACT(DAY FROM fecha_nacimiento),' de ',
                            IF(EXTRACT(MONTH FROM fecha_nacimiento)=1,'Enero',
                               IF(EXTRACT(MONTH FROM fecha_nacimiento)=2,'Febrero',
                                  IF(EXTRACT(MONTH FROM fecha_nacimiento)=3,'Marzo',
                                    IF(EXTRACT(MONTH FROM fecha_nacimiento)=4,'Abril',
                                      IF(EXTRACT(MONTH FROM fecha_nacimiento)=5,'Mayo',
                                        IF(EXTRACT(MONTH FROM fecha_nacimiento)=6,'Junio',
                                           IF(EXTRACT(MONTH FROM fecha_nacimiento)=7,'Julio',
                                            IF(EXTRACT(MONTH FROM fecha_nacimiento)=8,'Agosto',
                                              IF(EXTRACT(MONTH FROM fecha_nacimiento)=9,'Septiembre',
                                                IF(EXTRACT(MONTH FROM fecha_nacimiento)=10,'Octubre',
                                                  IF(EXTRACT(MONTH FROM fecha_nacimiento)=11,'Noviembre','Diciembre'))))))))))), 
                        ' de ',EXTRACT(YEAR FROM fecha_nacimiento)) as fecha_nacimiento,
                        TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) as edad,
                        foto,
                        estado
                    FROM alumnos
                    WHERE estado = :0";
            $resultado = $this->consultarFilas($sql,array($this->getEstado()));

            
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }



    public function leerDatos() {
        try {
            $sql = "SELECT * FROM alumnos WHERE codigo_alumno = :0";
            $resultado = $this->consultarFila($sql,array($this->getCodigo_alumno()));
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
            
            $campos_valores = 
            array(  "estado"=>$this->getEstado());

            $campos_valores_where = 
            array(  "codigo_alumno"=>$this->getCodigo_alumno());

            $this->update("alumnos", $campos_valores,$campos_valores_where);

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
            $sql = "SELECT * FROM alumnos WHERE estado = 1";
            $resultado = $this->consultarFilas($sql);
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function inscripcionCB() {
        try {
            $sql = "SELECT a.* FROM inscripciones i INNER JOIN alumnos a ON i.codigo_alumno = a.codigo_alumno 
                    WHERE i.estado = 1
                    ORDER BY 1";
            $resultado = $this->consultarFilas($sql);
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

}