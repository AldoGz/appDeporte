<?php

require_once '../acceso/BD.php';

class EstudianteDocenteRegistro{ 
    private $dni_estudiante;
    private $anio;
    private $codigo_colegio;
    private $codigo_aula;

    public function getDniEstudiante()
    {
        return $this->dni_estudiante;
    }
    
    
    public function setDniEstudiante($dni_estudiante)
    {
        $this->dni_estudiante = $dni_estudiante;
        return $this;
    }

    public function getAnio()
    {
        return $this->anio;
    }
    
    
    public function setAnio($anio)
    {
        $this->anio = $anio;
        return $this;
    }

    public function getCodigoColegio()
    {
        return $this->codigo_colegio;
    }
    
    
    public function setCodigoColegio($codigo_colegio)
    {
        $this->codigo_colegio = $codigo_colegio;
        return $this;
    }

    public function getCodigoAula()
    {
        return $this->codigo_aula;
    }
    
    
    public function setCodigoAula($codigo_aula)
    {
        $this->codigo_aula = $codigo_aula;
        return $this;
    }
    
    public function listarNinosAula($p_codigo_cronograma){                
       $bd = new BD();

       $ccr = $bd->consultaSingle("SELECT codigo_cronograma_registro  as crr
              FROM cronograma_registro CRR
              WHERE CRR.estado AND codigo_cronograma = ".$p_codigo_cronograma)["crr"];

       $sql = " SELECT 
        CR.codigo_cronograma,
        E.dni,
        upper(CONCAT(E.nombre,' ',E.paterno,' ',E.materno)) as nombres_completos,
        CONCAT(E.dni,' ',CONCAT(E.nombre,' ',E.paterno,' ',E.materno)) as etiqueta,
        (IF(E.sexo=0, 'Femenino', 'Masculino')) as sexo,
        TIMESTAMPDIFF(YEAR, E.fecha_nacimiento,CURDATE()) as edad, 
        E.foto,
        E.estado,
        (SELECT COUNT(dni_estudiante)
            FROM estudiante_docente_registro 
            WHERE semana > (
                SELECT MAX(semana) as max FROM estudiante_docente_registro WHERE dni_docente = AA.dni_docente AND
                codigo_cronograma_registro =  ".$ccr."
                ) AND codigo_cronograma_registro = ".$ccr." ) as estado_registro                                        
        FROM estudiante_aula_año EAA
        INNER JOIN aula_año AA ON AA.anio = EAA.anio AND EAA.codigo_colegio AND AA.codigo_aula = EAA.codigo_aula
        INNER JOIN cronograma CR 
        ON CR.codigo_colegio = EAA.codigo_colegio AND CR.anio = EAA.anio
        INNER JOIN estudiante E ON EAA.dni_estudiante  = E.dni
        WHERE 
        CR.codigo_cronograma  = ".$p_codigo_cronograma." AND
        EAA.codigo_aula = ".$this->getCodigoAula()." AND
        (SELECT COUNT(dni_estudiante)
            FROM estudiante_docente_registro 
            WHERE semana > (
                SELECT MAX(semana) as max FROM estudiante_docente_registro WHERE dni_docente = AA.dni_docente AND
                codigo_cronograma_registro =  ".$ccr."
                ) ) = 0
        ";       

       return $bd->consulta($sql);
    } 
    
    
    public function listarCronogramaEmpleado(){
        $bd = new BD();
        return $bd->consulta("
              SELECT  CR.codigo_cronograma, COL.nombre as colegio, COL.nombre as etiqueta,CRR.numero_cronograma_registro as nro, 
                            CRR.codigo_cronograma_registro
                            FROM anio_escolar AES
                            JOIN cronograma CR ON AES.codigo_colegio = CR.codigo_Colegio AND AES.anio = CR.anio
                            JOIN colegio COL ON AES.codigo_Colegio = COL.codigo_colegio
                            JOIN cronograma_registro CRR ON CR.codigo_cronograma = CRR.codigo_cronograma AND CRR.estado
                            WHERE 
                            AES.estado AND CRR.estado AND
                            CR.dni_empleado  = '".$this->getDni_empleado()."'" );
        /*
            SELECT 
                c.codigo_cronograma,
                cr.codigo_cronograma_registro,
                co.nombre as colegio,
                CONCAT(a.grado,' ',a.seccion) as etiqueta,
                a.grado,a.seccion,a.nivel
                FROM
                cronograma c 
                INNER JOIN cronograma_registro cr ON c.codigo_cronograma = cr.codigo_cronograma AND cr.estado
                INNER JOIN aula a ON c.codigo_aula = a.codigo_aula
                INNER JOIN colegio co ON co.codigo_colegio = a.codigo_colegio
                WHERE  c.estado AND c.dni_empleado= '".$this->getDni_empleado()."' AND c.anio = YEAR(current_date)"       
            );        */
    }
    
    
    public function listarCronogramaRegistros(){
        $bd = new BD();
        return $bd->consulta("
                    SELECT 
                    ecr.dni_estudiante as dni
                    FROM
                    estudiante_cronograma_registro ecr
                    INNER JOIN cronograma_registro cr ON ecr.codigo_cronograma_registro = cr.codigo_cronograma_registro AND cr.estado AND ecr.estado
                    WHERE
                    ecr.codigo_cronograma_registro = ".$this->getCodigo_cronograma_registro()
            );
    }
    
    public function listarEstudianteAulaCronograma(){
        $bd = new BD();
        $SQL = "SELECT  (IF(e.sexo=0, 'Femenino', 'Masculino')) as sexo,
                          TIMESTAMPDIFF(YEAR, e.fecha_nacimiento,CURDATE()) as edad,e.estado,
                          upper(CONCAT(e.nombre,' ',e.paterno,' ',e.materno)) as nombres_completos,
                          e.dni,
                          (SELECT COUNT(dni_estudiante)
                            FROM estudiante_cronograma_registro 
                            WHERE dni_estudiante = e.dni AND
                            codigo_cronograma_registro = 
                              (SELECT codigo_cronograma_registro 
                              FROM cronograma_registro 
                              WHERE cronograma_registro.estado AND codigo_cronograma = ".$this->getCodigo_cronograma().") ) as estado_registro
                          FROM cronograma cr 
                          INNER JOIN estudiante_aula_año eaa ON cr.codigo_colegio = eaa.codigo_colegio AND eaa.anio = cr.anio
                          INNER JOIN estudiante e ON e.dni = eaa.dni_estudiante
                          WHERE 
                          e.dni = '".$this->getDni_estudiante()."' 
                          AND eaa.codigo_aula =  ".$this->getCodigo_aula()." 
                          AND codigo_cronograma = ".$this->getCodigo_cronograma();
        return $bd->consultaSingle($SQL); 
    }
    
    
    public function enviarDatos($p_valores)
    {
        $bd = new BD();
        
        if ($bd->getEstado())
        {       
            $resultado = $bd->insert ($this->nombre_tabla_registro,
                    array("talla", "peso","dniestudiante"), $p_valores);
            
            if ($resultado!=1){
                return -1;
            }
                
            
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function listarCronogramas() {
        $bd = new BD();
        return $bd->consulta("select * from cronograma");
    }

    public function actualizarFechaCronograma(){      
       
        $bd = new BD();
        
        if ($bd->getEstado())
        {
            $bd->beginTransaction();                        
            
           
             $resultado = $bd->consulta(""
        .   "SELECT id_cronograma FROM cronograma WHERE estado = 1");
             
             $id_cronograma = $resultado[0]["id_cronograma"];
                          
          
             $resultado = $bd->consulta(""
                     . "SELECT id_cronograma_registro FROM cronograma_registro WHERE activo = 1 AND id_cronograma =  $id_cronograma");             
             
             if (count($resultado) > 0){
                 $id_cronograma_registro = $resultado[0]["id_cronograma_registro"];
                 
                 $resultado = $bd->update(
                        "cronograma_registro", 
                    array("activo"), array(false),
                     array("id_cronograma","id_cronograma_registro"),array($id_cronograma,$id_cronograma_registro));    
             
             
                    if ($resultado!=1){
                          $bd->rollBack();                    
                          return -1;    
                      }      

                    $resultado = $bd->update(
                              "cronograma_registro", 
                          array("activo"), array(1),
                           array("id_cronograma","id_cronograma_registro"),array($id_cronograma,($id_cronograma_registro+1)));   

                      if ($resultado!=1){
                          $bd->rollBack();                    
                          return -1;    
                      }            
             } 
             
            $bd->commit();
         
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function registrarEstudianteCronograma($p_valores){      
        $bd = new BD();        
        if ($bd->getEstado())
        {
            $bd->beginTransaction();
                              
            /*
             * Registrar el cronograma.
             * 
             * Tabla: Diagnostico.
             *      PK: codigo_diagnostico (/)
             *      codigo_estudiante_cronograma_registro,
             *      peso_edad, //c
             *      talla_edad, //c
             *      imc_edad,  //c
             *      metabolismo_basal,
             *      calorias_bajar,
             *      calorias_normal,
             *      calorias_subir             
             *              
             */
             $resultado = $bd->consultaSingle("select (case when count(*)=0 then 1 else max(codigo_estudiante_cronograma_registro)+1 end) as siguiente from $this->nombre_tbl_estudiante_cronograma_registro");
             $cecr = $resultado["siguiente"];
             
             $p_campos = array("dni_estudiante",
                        "codigo_cronograma_registro","peso","talla","codigo_estudiante_cronograma_registro");
                        
             array_push($p_valores,$cecr); 
             
             //array_splice($p_valores, 0,1);
        
             $resultado = $bd->insert(
                     $this->nombre_tbl_estudiante_cronograma_registro, 
                     $p_campos, $p_valores);    
               
                if ($resultado!=1){
                    $bd->rollBack();                    
                    return -1;    
                }    
                
             $dni = $p_valores[0];
             $ccr = $p_valores[1];
             $peso = $p_valores[2];             
             $talla = $p_valores[3];
             
                $sql = "SELECT CAST(AVG(codigo_factor) AS UNSIGNED) as factor FROM estudiante_docente_registro "
                     . "WHERE codigo_cronograma_registro =  $cecr AND dni_estudiante = '$dni'";
                
             $resultado = $bd->consultaSingle($sql);
             $factor = $resultado["factor"] == NULL ? 3  : $resultado["factor"];
             
             $registro  =  $bd->consultaSingle("SELECT percentil                  
                    FROM tabla_percentil WHERE talla = $talla AND peso = $peso");
      
             $percentil =  $registro["percentil"];
                
             $registro  = $bd->consultaSingle("SELECT "
                    . " DATE_ADD(fecha_nacimiento, "
                     . "INTERVAL TIMESTAMPDIFF(MONTH,fecha_nacimiento,current_date) MONTH) as fecha_ms,"
                    . " sexo,"
                    . " TIMESTAMPDIFF(MONTH,fecha_nacimiento,current_date) as meses,"
                    . " TIMESTAMPDIFF(YEAR,fecha_nacimiento,current_date) as anhos"
                    . " FROM estudiante WHERE dni = $dni");
                         
            $sexo = $registro["sexo"];
            $edad = $registro["anhos"];
            $edad_mes = round(($registro["meses"] / 12),2);            
            $edad_dif = $edad_mes - $edad;
            $edad_dec = ($edad_dif) < 0.5 ? $edad : $edad+.5;                                 
          
            $date1 = new DateTime($registro["fecha_ms"]);
            $date2 = new DateTime("now");
            $interval = $date1->diff($date2);
              
            //edad_mx es la edd en meeses para ls funciones TxE y PxE.
            $edad_mx = $interval->d / 2 >= 15  ? $registro["meses"] + .5 : $registro["meses"] + .5;       
          
            $aux_sexo = $sexo == 0 ? "H" : "M";
            
            $txe = $this->obtenerTxE($aux_sexo,$edad_mx,$talla);
            $pxe = $this->obtenerPxE($aux_sexo,$edad_mx,$peso);
            $imc = $this->obtenerCMI($percentil,$edad_dec,$aux_sexo);
            $basal = $this->obtenerBasal($aux_sexo,$edad_dec,$talla,$peso);
            $valor_factor = $this->obtenerValorFactor($factor);
            $calorias_normal = $basal * $valor_factor ;
            $calorias =  ($peso + $talla + $edad + ($aux_sexo == "M" ? 5 : -161)) * $valor_factor;
            $calorias_bajar = $calorias_normal - $calorias;
            $calorias_subir = $calorias_normal + $calorias;
            
             switch($imc){
                 case 1:
                 case 2:
                     $total_calorias  = $calorias_subir;
                     break;
                 case 3:
                     $total_calorias  = $calorias_normal;
                     break;
                 case 4:
                 case 5:
                     $total_calorias = $calorias_bajar;
                     break;
             }
            $p_campos = array("codigo_estudiante_cronograma_registro","peso_edad",
                    "talla_edad","imc_edad","metabolismo_basal","calorias_bajar","calorias_normal",
                    "calorias_subir","total_calorias");
            
            $p_valores = array($cecr,$pxe["id_rango"],$txe["id_rango"],$imc,$basal,$calorias_bajar,
                $calorias_normal,$calorias_subir,$total_calorias);                
          
           
             $resultado = $bd->insert(
                     $this->tbl_diagnostico, 
                     $p_campos, $p_valores);    
              
                if ($resultado!=1){
                    $bd->rollBack();                    
                    return -1;    
                }    
            
                
           $bd->commit();   
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function obtenerTxE($auxSexo,$edad,$talla){
        $bd = new BD();       
             
         if ($bd->getEstado())   {
             $sql ="SELECT 
                    tte.id_rango, tcp.detalle
                    FROM 
                    tabla_talla_edad  tte, tabla_cdc_percentil tcp 
                    WHERE 
                        tte.id_rango = tcp.id_rango AND
                        meses = $edad  AND"
                    . " tte.talla_$auxSexo <= $talla "
                    . " ORDER BY id_rango DESC"
                    . " LIMIT 1";
            $registros =  $bd->consultaSingle($sql);    
         }     
         
        if( !$registros) {
             
             $registros =  $bd->consultaSingle("SELECT 
                    tte.id_rango, tcp.detalle
                    FROM 
                    tabla_talla_edad  tte, tabla_cdc_percentil tcp 
                    WHERE 
                        tte.id_rango = tcp.id_rango AND
                        meses = $edad  AND"
                    . " tte.id_rango = 1");             
         }         
         
         
         if ($bd->getEstado())   {
            $temporal =  $bd->consultaSingle("SELECT 
                    talla_$auxSexo as ideal
                    FROM 
                    tabla_talla_edad  
                    WHERE                         
                        meses = $edad AND id_rango = 3;");                      
            
            $registros["txe_ideal"] = $temporal["ideal"];
         }        
         
        return $registros;
    }    
    
    public function obtenerPxE($auxSexo ,$edad,$peso){
        $bd = new BD();       
        
        
         if ($bd->getEstado())   {
            $registros =  $bd->consultaSingle("SELECT 
                    tte.id_rango, tcp.detalle
                    FROM 
                    tabla_peso_edad  tte, tabla_cdc_percentil tcp 
                    WHERE 
                        tte.id_rango = tcp.id_rango AND
                        meses = $edad  AND"
                    . " tte.peso_$auxSexo <= $peso "
                    . " ORDER BY id_rango DESC"
                    . " LIMIT 1");  
         }     
        
        
         if( !$registros) {
             
             $registros =  $bd->consultaSingle("SELECT 
                    tte.id_rango, tcp.detalle
                    FROM 
                    tabla_peso_edad  tte, tabla_cdc_percentil tcp 
                    WHERE 
                        tte.id_rango = tcp.id_rango AND
                        meses = $edad  AND"
                    . " tte.id_rango = 1");             
         }
         
         if ($bd->getEstado())   {
            $temporal =  $bd->consultaSingle("SELECT 
                    peso_$auxSexo as ideal
                    FROM 
                    tabla_peso_edad  tte
                    WHERE                         
                        meses = $edad AND id_rango = 3");                      
            
            $registros["pxe_ideal"] = $temporal["ideal"];
         }  
         
        return $registros;
    }
     
    public function obtenerCMI($percentil,$edad_dec,$sexo){
        //$maxCMI = 51.2;
        //$minCMI = 5.8;         
        $bd = new BD();                                 
        
         if ($bd->getEstado())   {
            $registros =  $bd->consultaSingle("SELECT id_rango 
                    FROM 
                    edad_rango_imc
                    WHERE edad = $edad_dec AND"
                    . " $percentil >= min_$sexo AND $percentil <= max_$sexo "
                    . " ORDER BY id_rango"
                    . " LIMIT 1");  
         }     
                  
         return $registros["id_rango"];
       // if ($percentil)
    }
    
    public function obtenerBasal($sexo,$edad,$talla,$peso){
       return (10*$peso) + (6.25 * $talla) - (5 * $edad) + ($sexo == "M" ? 5 : -161) ;       
    }
    
    public function obtenerValorFactor($factor){
        $bd = new BD();                                 
        
         if ($bd->getEstado())   {
            $registros =  $bd->consultaSingle("SELECT valor 
                    FROM 
                    tabla_factor
                    WHERE id_factor = $factor");
         }     
                  
         return $registros["valor"];    
    }
    
    
   public function registrarCronograma(){
        $fInicio = new DateTime($this->getFecha_inicio());
        $fFin = new DateTime($this->getFecha_fin());
        $salto = $this->getTiempo_nuevo_registro();  
        $interval = $fInicio->diff($fFin);        
        $dias = $interval->format('%a');
        $veces = round($dias / $salto);
              
        $bd = new BD();
        
        if ($bd->getEstado())
        {
            $bd->beginTransaction();
                        
            
             $resultado = $bd->consulta("select (case when count(*)=0 then 1 else max(id_cronograma)+1 end) as siguiente,dias_limite from $this->tabla_cronograma");
             $id_cronograma = $resultado[0]["siguiente"];
             $dias_limite = $resultado[0]["dias_limite"];
             
             $p_valores = array($this->getFecha_inicio(),$this->getFecha_fin(),$this->getTiempo_nuevo_registro(),
                        $id_cronograma,$dias_limite);
             //array_push($p_valores,$id_cronograma);             
             
             $resultado = $bd->insert(
                        $this->tabla_cronograma, 
                    array("fecha_inicio", "fecha_fin","tiempo_nuevo_registro","id_cronograma","dias_limite"), $p_valores);    
                
                if ($resultado!=1){
                    $bd->rollBack();                    
                    return -1;    
                }    
            
            $p_temp_valores = null;
                     
            //$fv = $fInicio;  
          
            for ($i=0;$i<$veces;$i++){
                //$salto = $salto * ($i+1);
                $fv = date('Y-m-d', strtotime($this->getFecha_inicio(). ' + '.$salto * ($i+1).' days'));
                $fi = date('Y-m-d', strtotime($fv. ' - '.$salto.' days'));
                $fl = date('Y-m-d', strtotime($fi. '+ '.$dias_limite.' days'));
                var_dump($fv,$fi,$fl);
                $activo = $i === 0 ? 1 : 0;
                $p_temp_valores=array($id_cronograma,($i+1),
                                 $fi,$fl,$fv,$activo);                 
                
                $resultado = $bd->insert(
                        "cronograma_registro", 
                    array("id_cronograma", "id_cronograma_registro",
                            "fecha_inicio","fecha_limite","fecha_vencimiento","activo"), $p_temp_valores);                                   
              
                if ($resultado!=1){
                    $bd->rollBack();                    
                    return -1;    
                }               
            }
         
            $bd->commit();
         
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function proximasNotificaciones(){
        $bd = new BD();       
                
        if ($bd->getEstado())  {      
            
              $response = null;
            
              $sql = "SELECT  cr.fecha_inicio,DATEDIFF(cr.fecha_inicio,current_date) as dif_inicio,        	
        		cr.fecha_limite,DATEDIFF(cr.fecha_limite,current_date) as dif_limite
                      FROM cronograma c , cronograma_registro cr
                     WHERE  c.id_cronograma = cr.id_cronograma AND
                   c.estado AND cr.activo";
              
              //Sin limite de fecha.
              
              $res=$bd->consultaSingle($sql);
                         
              $fInicio = array($res["fecha_inicio"],$res["dif_inicio"]); 
            //dif_inicio contiene los dias de diferencia entre EL MOMENTO EN EL QUE TOCA AVISARLE Y EL DIA HOY.
              $fLimit = array($res["fecha_limite"],$res["dif_limite"]);                           
            //dif_inicio contiene los dias de diferencia entre EL MOMENTO EN EL QUE TOCA AVISARLE LIMITE Y EL DIA HOY.
              
              //Verificar los dias.
              if ($fInicio[1] >= 0){                  
                  $msj  = "Señor :p_padre, lo saludamos del colegio de su hijo. Le recordamos que hoy ($fInicio[0]) puede enviar los datos de su(s) niño(s) mediante nuestra app.";                  
              } else if ($fLimit[1] == 2){
                  $msj  = "Señor :p_padre, lo saludamos del colegio de su hijo. Le recordamos que hoy ($fLimit[0]) es el último día para enviar los datos su(s) niño(s) mediante nuestra app.";                  
              } else {
                  
                  
                    $response["mensaje"] = "";
                    $response["padres"]  = array();
                    return $response;                  
              }
              
              $response["mensaje"] = $msj;
        
              $sql = "SELECT  nombre as nombres, telefono as celular from v_apoderado";
              $res = $bd->consulta($sql);              
                      
              $response["padres"] = $res;
              return $response;
            }
        else
            return 8000; 
        
    }
    /*public function registrarCronogramaEstudiante($idEstudiante){
  
        $bd = new BD();
        
        if ($bd->getEstado())
        {
                        
             $resultado = $bd->consulta("select * from $this->nombre_tbl_cronograma_registro where id_cronograma = $id_cronograma AND activo = 1");
             $ic = $resultado[0]["id_cronograma"];
             $icr = $resultado[0]["id_cronograma_registro"];             
            
             $bd->beginTransaction();
           
             $estudiantes = $bd->consulta("select dniEstudiante from $this->nombre_tbl_estudiante");
                          
             for ($i=0;$i<count($estudiantes);$i++){                
                
                $p_valores =array($ic,$icr,$estudiantes[$i],$fv,$activo);                 
                
                 $resultado = $bd->insert(
                        $this->nombre_tbl_estudiante_cronograma_registro, 
                    ["id_cronograma", "id_cronograma_registro","dni_estudiante","peso","talla"], $p_valores);    
                
                if ($resultado!=1){
                    $bd->rollBack();                     
                }                 
            }
            
           
            $bd->commit();
         
            return 1;
        }
        else
        {
            return 0;
        }
    }*/
}