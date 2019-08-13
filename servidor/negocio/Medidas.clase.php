<?php

require_once '../acceso/Conexion.clase.php';

class Medidas extends Conexion {
    private $codigo_registro;
    private $codigo_alumno;

    private $factor_actividad;

    private $talla;
    private $talla_sentado;
    private $peso;

    private $tricipital;
    private $subescapular;
    private $supraespinal;
    private $abdominal;
    private $muslo_anterior;
    private $pierna_medial;

    private $muneica;
    private $femur;
    private $humero;
    private $bileocrestal;
    private $biacromial;

    private $mesoesternal;
    private $brazo;
    private $pierna;

    private $estado;

    public function getCodigo_registro(){
        return $this->codigo_registro;
    }
    
    public function setCodigo_registro($codigo_registro){
        $this->codigo_registro = $codigo_registro;
        return $this;
    }

    public function getCodigo_alumno(){
        return $this->codigo_alumno;
    }
    
    public function setCodigo_alumno($codigo_alumno){
        $this->codigo_alumno = $codigo_alumno;
        return $this;
    }

    public function getFactor_actividad(){
        return $this->factor_actividad;
    }
    
    public function setFactor_actividad($factor_actividad){
        $this->factor_actividad = $factor_actividad;
        return $this;
    }

    public function getTalla(){
        return $this->talla;
    }
    
    public function setTalla($talla){
        $this->talla = $talla;
        return $this;
    }

    public function getTalla_sentado(){
        return $this->talla_sentado;
    }
    
    public function setTalla_sentado($talla_sentado){
        $this->talla_sentado = $talla_sentado;
        return $this;
    }

    public function getPeso(){
        return $this->peso;
    }
    
    public function setPeso($peso){
        $this->peso = $peso;
        return $this;
    }

    public function getTricipital(){
        return $this->tricipital;
    }
    
    public function setTricipital($tricipital){
        $this->tricipital = $tricipital;
        return $this;
    }

    public function getSubescapular(){
        return $this->subescapular;
    }
    
    public function setSubescapular($subescapular){
        $this->subescapular = $subescapular;
        return $this;
    }

    public function getSupraespinal(){
        return $this->supraespinal;
    }
    
    public function setSupraespinal($supraespinal){
        $this->supraespinal = $supraespinal;
        return $this;
    }

    public function getAbdominal(){
        return $this->abdominal;
    }
    
    public function setAbdominal($abdominal){
        $this->abdominal = $abdominal;
        return $this;
    }

    public function getMuslo_anterior(){
        return $this->muslo_anterior;
    }
    
    public function setMuslo_anterior($muslo_anterior){
        $this->muslo_anterior = $muslo_anterior;
        return $this;
    }

    public function getPierna_medial(){
        return $this->pierna_medial;
    }
    
    public function setPierna_medial($pierna_medial){
        $this->pierna_medial = $pierna_medial;
        return $this;
    }

    public function getMuneica(){
        return $this->muneica;
    }
    
    public function setMuneica($muneica){
        $this->muneica = $muneica;
        return $this;
    }

    public function getFemur(){
        return $this->femur;
    }
    
    public function setFemur($femur){
        $this->femur = $femur;
        return $this;
    }

    public function getHumero(){
        return $this->humero;
    }
    
    public function setHumero($humero){
        $this->humero = $humero;
        return $this;
    }

    public function getBileocrestal(){
        return $this->bileocrestal;
    }
    
    public function setBileocrestal($bileocrestal){
        $this->bileocrestal = $bileocrestal;
        return $this;
    }

    public function getBiacromial(){
        return $this->biacromial;
    }
    
    public function setBiacromial($biacromial){
        $this->biacromial = $biacromial;
        return $this;
    }

    public function getMesoesternal(){
        return $this->mesoesternal;
    }
    
    public function setMesoesternal($mesoesternal){
        $this->mesoesternal = $mesoesternal;
        return $this;
    }

    public function getBrazo(){
        return $this->brazo;
    }
    
    public function setBrazo($brazo){
        $this->brazo = $brazo;
        return $this;
    }

    public function getPierna(){
        return $this->pierna;
    }
    
    public function setPierna($pierna){
        $this->pierna = $pierna;
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
            $sql = "SELECT * FROM medidas WHERE codigo_alumno = :0";
            $filas = $this->consultarFilas($sql,[$this->getCodigo_alumno()]);

            if ( count($filas) == 0 ) {
                $campos_valores = array("codigo_alumno"=>$this->getCodigo_alumno());
                $this->insert("medidas", $campos_valores);
                $this->commit();
                return array("rpt"=>true,"estado"=>true,"msj"=>"Se agregado exitosamente");
            }else{
                $sql = "SELECT antropometricos+pliegues+diametros+perimetros as valor FROM medidas WHERE codigo_alumno = :0 ORDER BY codigo_registro DESC LIMIT 1"; 
                $resultado = $this->consultarValor($sql,[$this->getCodigo_alumno()]);

                if ( intval($resultado) < 4 ) {
                    return array("rpt"=>true,"estado"=>false,"msj"=>"Tiene un evaluación actual sin terminar");
                }

                $campos_valores = array("codigo_alumno"=>$this->getCodigo_alumno());
                $this->insert("medidas", $campos_valores);
                $this->commit();
                return array("rpt"=>true,"estado"=>true,"msj"=>"Se agregado exitosamente");
            }
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }
    // DESPUES CUANDO ACABE TODO DE REGISTRAR
    public function contar($p){
        try {
            $sql = 'SELECT antropometricos+pliegues+diametros+perimetros as valor FROM medidas WHERE codigo_registro = :0';
            $resultado = intval($this->consultarValor($sql,[$p]));
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }
    public function agregarDA() {
        $this->beginTransaction();
        try {
            $sql = "SELECT * FROM medidas WHERE codigo_registro = :0";
            $opc = $this->consultarFila($sql,[$this->getCodigo_registro()]);
            if ( $opc["pliegues"] == "1" ) {
                $campos_valores = $this->obtenerPesoIdeal();
                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }

            if ( $this->contar($this->getCodigo_registro())["msj"] == 3 ) {
                $campos_valores = $this->obtenerCalculo();
                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }

            $proyeccion_talla = $this->obtenerProyeccion();

            $campos_valores = 
            array(
                "talla"=>$this->getTalla(),
                "talla_sentado"=>$this->getTalla_sentado(),
                "peso"=>$this->getPeso(),
                "proyeccion_talla"=>$proyeccion_talla,
                "pt_fecha_registro"=>empty($proyeccion_talladate) ? null : date("Y-m-d"),
                "antropometricos"=>1,
                "codigo_factor"=>$this->getFactor_actividad()
            );
            $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
            $this->update("medidas", $campos_valores,$campos_valores_where);

            $campos_valores = $this->obtenerNutricion();
            $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
            $this->update("medidas", $campos_valores,$campos_valores_where);

            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function obtenerNutricion(){
        $sql = "SELECT * FROM medidas m INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno WHERE codigo_registro = :0";
        $registro = $this->consultarFila($sql,[$this->getCodigo_registro()]);

        list($Y,$m,$d) = explode("-",$registro["fecha_nacimiento"]);
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;
        $peso = $this->getPeso();        
        $sexo = $registro["sexo"] == 1 ? 'H':'M';

        $sql = "SELECT * FROM tabla_metabolismo_basal WHERE edad >= :0 ORDER BY edad ASC LIMIT 1";
        $metabolismo = $this->consultarFila($sql,[$edad]);
        $resultado["metabolismo"] = round(($metabolismo["percentil_$sexo"]*$peso)+$metabolismo["acumulado_$sexo"],2);

        $sql = "SELECT * FROM tabla_factor_actividad WHERE codigo_registro = :0";
        $factor_actividad = $this->consultarFila($sql,[$this->getFactor_actividad()]);
        $resultado["factor_actividad"] = round(floatval($edad <= 20 ? $factor_actividad["actividad_adolescente_$sexo"] :  $factor_actividad["actividad_adulto_$sexo"]),2);

        $resultado["total_calorias"] = round($resultado["factor_actividad"]*$resultado["metabolismo"],2);

        $resultado["carbohidratos"] = round($resultado["total_calorias"]*0.55/4,2);
        $resultado["proteinas"] = round($resultado["total_calorias"]*0.15/4,2);
        $resultado["grasas"] = round($resultado["total_calorias"]*0.3/9,2);

        return $resultado; 
    }

    public function obtenerProyeccion() {
        $sql = "SELECT * FROM medidas m INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno WHERE codigo_registro = :0";
        $registro = $this->consultarFila($sql,[$this->getCodigo_registro()]);

        $fn = strtotime($registro["fecha_nacimiento"]);
        $sexo = $registro["sexo"] == 1 ? 'H':'M';
        $talla = $this->getTalla();

        list($Y,$m,$d) = explode("-",$registro["fecha_nacimiento"]);
        $edad = date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y;

        if ( ($edad > 17 && $sexo == 'M') || ($edad > 19 && $sexo == 'H') ) {
            $proyeccion_talla = null;
        }else{
            $proyeccion_talla = $this->calcularPT($fn,$sexo,$talla);    
        }
        return $proyeccion_talla;
    }

    public function calcularPT($fn,$sexo,$talla){
        $Ae = date("Y");
        $Me = date("m");
        $De = date("d");

        $An = date("Y", $fn);
        $Mn = date("m", $fn);
        $Dn = date("d", $fn);

        $edad_decimal = round(((($Ae*365.25)+($Me*30.6001)+$De)-(($An*365.25)+($Mn*30.6001)+$Dn))/365.25,1);
        $edad = intval($edad_decimal);
        $item = ($edad_decimal - intval($edad_decimal))*10;

        $sql = "SELECT percentil_$sexo FROM tabla_proyeccion_talla WHERE edad = :0 AND item = :1";        
        return round(($talla/$this->consultarValor($sql,[$edad,$item]))*100,2);
    }

    public function agregarP() {
        $this->beginTransaction();
        try {
            if ( $this->contar($this->getCodigo_registro())["msj"] == 3 ) {
                $campos_valores = $this->obtenerCalculo();
                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }
            $sql = "SELECT * FROM medidas WHERE codigo_registro = :0";
            $opc = $this->consultarFila($sql,[$this->getCodigo_registro()]);

            if ( $opc["antropometricos"] == "1" ) {

                $campos_valores = $this->obtenerPesoIdeal();

                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }

            $campos_valores = 
            array(
                "tricipital"=>$this->getTricipital(),
                "subescapular"=>$this->getSubescapular(),
                "supraespinal"=>$this->getSupraespinal(),
                "abdominal"=>$this->getAbdominal(),
                "muslo_anterior"=>$this->getMuslo_anterior(),
                "pierna_medial"=>$this->getPierna_medial(),
                "pliegues"=>1
            );
            $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
            $this->update("medidas", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function obtenerPesoIdeal(){
        $sql = "SELECT * FROM medidas m INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno WHERE m.codigo_registro = :0";
        $registro = $this->consultarFila($sql,[$this->getCodigo_registro()]);
        $suma_pliegues = $registro["tricipital"]+$registro["subescapular"]+$registro["supraespinal"]+$registro["abdominal"];

        $resultado["porcentaje_grasa"] = round(($suma_pliegues*0.153)+5.783,2);
        $resultado["indice_peso_grasa"] = round($registro["peso"]*$resultado["porcentaje_grasa"]/100,2);
        $resultado["masa_corporal_activa"] = round($registro["peso"]-$resultado["indice_peso_grasa"],2);

        $porcentaje_masa = round($resultado["masa_corporal_activa"]*0.1,2);
        $resultado["peso_ideal"] = round($resultado["masa_corporal_activa"]+$porcentaje_masa,2);

        $resultado["indicador"] = $registro["peso"]>$resultado["peso_ideal"] ? "1" : ($registro["peso"]==$resultado["peso_ideal"] ? "2" :"3");

        return $resultado;
    }

    public function agregarD() {
        $this->beginTransaction();
        try {
            if ( $this->contar($this->getCodigo_registro())["msj"] == 3 ) {
                $campos_valores = $this->obtenerCalculo();
                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }

            $campos_valores = 
            array(
                "muneica"=>$this->getMuneica(),
                "femur"=>$this->getFemur(),
                "humero"=>$this->getHumero(),
                "bileocrestal"=>$this->getBileocrestal(),
                "biacromial"=>$this->getBiacromial(),
                "diametros"=>1
            );
            $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
            $this->update("medidas", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function agregarPE() {
        $this->beginTransaction();
        try {
            if ( $this->contar($this->getCodigo_registro())["msj"] == 3 ) {
                $campos_valores = $this->obtenerCalculo();

                $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
                $this->update("medidas", $campos_valores,$campos_valores_where);
            }

            $campos_valores = 
            array(
                "mesoesternal"=>$this->getMesoesternal(),
                "brazo"=>$this->getBrazo(),
                "pierna"=>$this->getPierna(),
                "perimetros"=>1
            );
            $campos_valores_where = array("codigo_registro"=>$this->getCodigo_registro());
            $this->update("medidas", $campos_valores,$campos_valores_where);
            $this->commit();
            return array("rpt"=>true,"msj"=>"Se agregado exitosamente");
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            $this->rollBack();
            throw $exc;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM medidas WHERE codigo_alumno = :0";
            $resultado = $this->consultarFilas($sql,[$this->getCodigo_alumno()]);

            
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

    public function obtenerCalculo(){
        $sql = "SELECT * FROM medidas m INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno WHERE m.codigo_registro = :0";
        $registro = $this->consultarFila($sql,[$this->getCodigo_registro()]);
        
        

        /* SUMA DE PLIEGUES */
        $suma_pliegues = $registro["tricipital"]+$registro["subescapular"]+$registro["supraespinal"]+$registro["abdominal"]+$registro["muslo_anterior"]+$registro["pierna_medial"];

        $resultado["por_adiposo"]  = round($registro["sexo"] == 1 ? (3.64+($suma_pliegues*0.097)) : (4.56+($suma_pliegues*0.143)), 2);     
        $resultado["por_residual"] = round($registro["sexo"] == 1 ? ($registro["peso"]*0.241) :  ($registro["peso"]*0.209),2);        
        $resultado["peso_adiposo"] = round($registro["peso"]*$resultado["por_adiposo"]/100,2);
        $resultado["peso_oseo"] = round(3.02*((pow($registro["talla"]/100,2)*($registro["muneica"]/100)*($registro["femur"]/100)*400)*0.712),2);
        $resultado["peso_residual"] = round($registro["peso"]*$resultado["por_residual"]/100,2);
        $resultado["peso_muscular"] = round($registro["peso"]-$resultado["peso_adiposo"]-$resultado["peso_oseo"]-$resultado["peso_residual"],2);
        $resultado["por_oseo"] = round($resultado["peso_oseo"]*100/$registro["peso"],2);
        $resultado["por_muscular"] = round(100-$resultado["por_adiposo"]-$resultado["por_oseo"]-$resultado["por_residual"]);

        $suma_endomorfia = $registro["tricipital"]+$registro["subescapular"]+$registro["supraespinal"];
        $resultado["endomorfia"] = round((-0.7182+0.1451*($suma_endomorfia)-0.00068*pow($suma_endomorfia,2)+0.0000014*pow($suma_endomorfia,3))*170.18/$registro["talla"],2);

        $p1 = (0.858*$registro["humero"])+(0.601*$registro["femur"])+(0.188*($registro["brazo"]-$registro["tricipital"]/10))+(0.161*($registro["pierna"]-$registro["pierna_medial"]/10));
        $p2 = 0.131*$registro["talla"];
        $resultado["mesomorfia"] = round($p1-$p2+4.5,2);
        $numero_ectomorfo = $registro["talla"]/pow($registro["peso"],0.33333);
        $resultado["ectomorfia"] = round($numero_ectomorfo>40.75 ? ($numero_ectomorfo*0.732)-28.58 : ($numero_ectomorfo>38.28 ? ($numero_ectomorfo*0.463)-17.63 : 0.1),2);

        $resultado["valor_x"] = $resultado["ectomorfia"]-$resultado["endomorfia"];
        $resultado["valor_y"] = $resultado["mesomorfia"]+$resultado["mesomorfia"]-$resultado["endomorfia"]-$resultado["ectomorfia"];

        $resultado["imc"] = $registro["peso"]/pow(($registro["talla"]/100),2);
        $resultado["iem"] = ($registro["talla"]-$registro["talla_sentado"])/$registro["talla_sentado"]*100;
        $resultado["iai"] = $registro["bileocrestal"]/$registro["biacromial"]*100 <= 0 ? "100" : $registro["bileocrestal"]/$registro["biacromial"]*100;
        $resultado["ictr"] = $registro["mesoesternal"]*100/$registro["talla"];
        $resultado["estado"] = 0;

        return $resultado;   
    }



    public function leerReporte(){
        try {
            $sql = "SELECT 
                    m.*,
                    CONCAT(EXTRACT(DAY FROM m.pt_fecha_registro),' de ',
                        IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=1,'enero',
                           IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=2,'febrero',
                              IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=3,'marzo',
                                IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=4,'abril',
                                  IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=6,'junio',
                                       IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=7,'julio',
                                        IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM m.pt_fecha_registro)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM m.pt_fecha_registro)) as fecha_registro_pt,
                    a.documento,
                    IF(a.sexo = '1', 'Masculino','Femenino') as sexo,
                    CONCAT(a.nombres,' ',a.paterno,' ',a.materno) as nombres,
                    CONCAT(EXTRACT(DAY FROM a.fecha_nacimiento),' de ',
                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=1,'enero',
                           IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=2,'febrero',
                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=3,'marzo',
                                IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=4,'abril',
                                  IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=6,'junio',
                                       IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=7,'julio',
                                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM a.fecha_nacimiento)) as fecha_nacimiento,
                    (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()))  AS anio,
                    (SELECT (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12)) AS mes,
                    (SELECT DATEDIFF(CURDATE(),DATE_ADD(DATE_ADD(a.fecha_nacimiento, INTERVAL TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) YEAR), INTERVAL (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12) MONTH))) AS dia,
                    (SELECT 
                        CONCAT(EXTRACT(DAY FROM CURRENT_DATE),' de ',
                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=1,'enero',
                           IF(EXTRACT(MONTH FROM CURRENT_DATE)=2,'febrero',
                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=3,'marzo',
                                IF(EXTRACT(MONTH FROM CURRENT_DATE)=4,'abril',
                                  IF(EXTRACT(MONTH FROM CURRENT_DATE)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM CURRENT_DATE)=6,'junio',
                                       IF(EXTRACT(MONTH FROM CURRENT_DATE)=7,'julio',
                                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM CURRENT_DATE)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM CURRENT_DATE)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM CURRENT_DATE))) as hoy FROM medidas m INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno";
            $resultado = $this->consultarFila($sql);            
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        } 
    }


    public function autocompletar() {
        try {
            $sql = "SELECT * FROM medidas WHERE codigo_registro = :0";
            $resultado["medidas"] = $this->consultarFila($sql,[$this->getCodigo_registro()]);

            $sql = "SELECT 
                    a.codigo_alumno,
                    a.documento,
                    IF(a.sexo = '1', 'M','F') as sexo,
                    CONCAT(a.nombres,' ',a.paterno,' ',a.materno) as nombres,
                    CONCAT(EXTRACT(DAY FROM a.fecha_nacimiento),' de ',
                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=1,'enero',
                           IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=2,'febrero',
                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=3,'marzo',
                                IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=4,'abril',
                                  IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=6,'junio',
                                       IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=7,'julio',
                                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM a.fecha_nacimiento)) as fecha_nacimiento,
                    (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()))  AS anio,
                    (SELECT (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12)) AS mes,
                    (SELECT DATEDIFF(CURDATE(),DATE_ADD(DATE_ADD(a.fecha_nacimiento, INTERVAL TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) YEAR), INTERVAL (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12) MONTH))) AS dia,
                    (SELECT 
                        CONCAT(EXTRACT(DAY FROM CURRENT_DATE),' de ',
                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=1,'enero',
                           IF(EXTRACT(MONTH FROM CURRENT_DATE)=2,'febrero',
                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=3,'marzo',
                                IF(EXTRACT(MONTH FROM CURRENT_DATE)=4,'abril',
                                  IF(EXTRACT(MONTH FROM CURRENT_DATE)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM CURRENT_DATE)=6,'junio',
                                       IF(EXTRACT(MONTH FROM CURRENT_DATE)=7,'julio',
                                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM CURRENT_DATE)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM CURRENT_DATE)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM CURRENT_DATE))) as hoy
                    FROM alumnos a WHERE a.codigo_alumno = :0";
            $resultado["estudiante"] = $this->consultarFila($sql,[$resultado["medidas"]["codigo_alumno"]]);

             
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }


    public function leerEstudiante(){
        try {
            $sql = "SELECT 
                    a.documento,
                    IF(a.sexo = '1', 'M','F') as sexo,
                    CONCAT(a.nombres,' ',a.paterno,' ',a.materno) as nombres,
                    CONCAT(EXTRACT(DAY FROM a.fecha_nacimiento),' de ',
                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=1,'enero',
                           IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=2,'febrero',
                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=3,'marzo',
                                IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=4,'abril',
                                  IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=6,'junio',
                                       IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=7,'julio',
                                        IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM a.fecha_nacimiento)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM a.fecha_nacimiento)) as fecha_nacimiento,
                    (SELECT TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()))  AS anio,
                    (SELECT (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12)) AS mes,
                    (SELECT DATEDIFF(CURDATE(),DATE_ADD(DATE_ADD(a.fecha_nacimiento, INTERVAL TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) YEAR), INTERVAL (TIMESTAMPDIFF(MONTH,a.fecha_nacimiento,CURDATE())) - (TIMESTAMPDIFF(YEAR,a.fecha_nacimiento,CURDATE()) * 12) MONTH))) AS dia,
                    (SELECT 
                        CONCAT(EXTRACT(DAY FROM CURRENT_DATE),' de ',
                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=1,'enero',
                           IF(EXTRACT(MONTH FROM CURRENT_DATE)=2,'febrero',
                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=3,'marzo',
                                IF(EXTRACT(MONTH FROM CURRENT_DATE)=4,'abril',
                                  IF(EXTRACT(MONTH FROM CURRENT_DATE)=5,'mayo',
                                    IF(EXTRACT(MONTH FROM CURRENT_DATE)=6,'junio',
                                       IF(EXTRACT(MONTH FROM CURRENT_DATE)=7,'julio',
                                        IF(EXTRACT(MONTH FROM CURRENT_DATE)=8,'agosto',
                                          IF(EXTRACT(MONTH FROM CURRENT_DATE)=9,'septiembre',
                                            IF(EXTRACT(MONTH FROM CURRENT_DATE)=10,'octubre',
                                              IF(EXTRACT(MONTH FROM CURRENT_DATE)=11,'noviembre','diciembre'))))))))))), 
                    ' de ',EXTRACT(YEAR FROM CURRENT_DATE))) as hoy
                    FROM alumnos a WHERE a.codigo_alumno = :0";
            $resultado = $this->consultarFila($sql,[$this->getCodigo_alumno()]);            
            return array("rpt"=>true,"msj"=>$resultado);
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        } 
    }



}

