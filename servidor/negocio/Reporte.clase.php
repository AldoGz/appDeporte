<?php
require_once '../../../servidor/acceso/Conexion.clase.php';

//require_once '../acceso/Conexion.clase.php';

class Reporte extends Conexion {
    private $codigo_registro_medidas;

    public function getCodigo_registro_medidas(){
        return $this->codigo_registro_medidas;
    }
    
    public function setCodigo_registro_medidas($codigo_registro_medidas){
        $this->codigo_registro_medidas = $codigo_registro_medidas;
        return $this;
    }
    public function reportear() {
        try {
            $sql = "SELECT 
                        m.*,
                        a.documento as documento_alumno,
                        a.nombres as nombres_alumno,
                        a.paterno as paterno_alumno,
                        a.materno as materno_alumno,
                        IF(a.sexo=1,'Masculino','Femenino') as sexo_alumno,
                        a.fecha_nacimiento as fecha_nacimiento_alumno,
                        g.anio as anio_grupo,
                        g.descripcion as descripcion_grupo,
                        c.nombre as descripcion_categoria,
                        d.documento as documento_docente,
                        d.nombres as nombres_docente,
                        d.paterno as paterno_docente,
                        d.materno as materno_docente,
                        d.sexo as sexo_docente,
                        g.codigo_grupo

                    FROM medidas m 
                    INNER JOIN alumnos a ON m.codigo_alumno = a.codigo_alumno
                    INNER JOIN inscripciones i ON a.codigo_alumno = i.codigo_alumno
                    INNER JOIN grupos g ON i.codigo_grupo = g.codigo_grupo
                    INNER JOIN categorias c ON g.codigo_categoria = c.codigo_categoria
                    INNER JOIN docentes d ON g.codigo_docente = d.codigo_docente
                    WHERE codigo_registro = :0";
            $resultado["medidas"] = $this->consultarFila($sql,[$this->getCodigo_registro_medidas()]);

            $sql = "SELECT * FROM horarios WHERE codigo_grupo = :0";
            $resultado["horarios"] = $this->consultarFilas($sql,[$resultado["medidas"]["codigo_grupo"]]);

            

            return $resultado;
        } catch (Exception $exc) {
            return array("rpt"=>false,"msj"=>$exc);
            throw $exc;
        }
    }

}