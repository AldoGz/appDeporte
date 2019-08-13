<?php 

require_once 'acceso/Conexion.clase.php';
//require_once '../../datos/local_config_web.php';

class AccesoAuxiliar extends Conexion{
	
	private $idRol;
	private $descripcionRol;
	private $idUsuario;
	private $usuario;
	private $correo;

	private $URL = "";
	private $ID_URL_PADRE = "";

	public function getIdRol()
	{
	    return $this->idRol;
	}
	
	
	public function setIdRol($idRol)
	{
	    $this->idRol = $idRol;
	    return $this;
	}

	public function getDesripcionRol()
	{
	    return $this->desripcionRol;
	}
	
	
	public function setDesripcionRol($desripcionRol)
	{
	    $this->desripcionRol = $desripcionRol;
	    return $this;
	}

	public function getIdUsuario()
	{
	    return $this->idUsuario;
	}
	
	
	public function setIdUsuario($idUsuario)
	{
	    $this->idUsuario = $idUsuario;
	    return $this;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}
	
	
	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	    return $this;
	}

	public function getCorreo()
	{
	    return $this->correo;
	}
	
	
	public function setCorreo($correo)
	{
	    $this->correo = $correo;
	    return $this;
	}

	public function getMenu()
	{
		return $this->phpMenu;
	}

	public function __construct()
	{	
		parent::__construct();
		$objUsuario = $_SESSION["obj_usuario"];
		$this->usuario = $objUsuario["nombres_usuario"];
		$this->idRol = $objUsuario["id_rol"];
		$this->descripcionRol = $objUsuario["rol"];
		$this->idUsuario = $objUsuario["id_usuario"];
		$this->correo = $objUsuario["correo"];

		/* OBTENGO MI URL */
		$arr = split("/",$_SERVER["PHP_SELF"]);
        $interfaz = $arr[count($arr) - 2];
        $this->URL = $interfaz;
        /* ID PARA MENU */
        $this->ID_URL_PADRE = $this->consultarValor("SELECT padre FROM permiso WHERE url = :0", ['../'.$this->URL]);     

		/*Funcion para verificar si es que mi acceso*/
		/*escribir funcion*/
		$this->phpMenu = $this->obtenerMenu();
	}

	public function __desctruct()
	{
		parent::__desctruct();	
		session_destroy(_SESION_);
	}

	public function dibujarMenu()
    {
        $arr = split("/",$_SERVER["PHP_SELF"]);
        $interfaz = $arr[count($arr) - 2];

        return $this->dibujarFila($this->crearMenu());
    }

    public function crearMenu($padre = NULL)
    {	
    	//?$this->idRol
        $sql = "SELECT pr.id_permiso, p.es_menu_interfaz, p.titulo_interfaz, p.url, p.icono_interfaz, p.padre 
        		FROM permiso_rol pr 
        		INNER JOIN permiso p ON p.id_permiso = pr.id_permiso
        		WHERE pr.estado = 'A' AND pr.id_rol = :0 AND p.padre";
        if ($padre == NULL){
            $sql .= " IS NULL ORDER BY 1 ASC";
            $hijos = $this->consultarFilas($sql,[$this->idRol]);
            $padre = array("id_permiso"=>0);
        } else {
            $sql .= " = :1 ORDER BY 1 ASC";
            $hijos = $this->consultarFilas($sql, [$this->idRol,$padre["id_permiso"]]);
        }

        if (count($hijos)){
            $padre["hijos"] = array();
            foreach ($hijos as $key => $value) {
                array_push($padre["hijos"], $this->crearMenu($value));
            }  
        }

        return $padre;
    }


    public function dibujarFila($item)
    {
        $html = "";        

        if ( !array_key_exists("hijos",$item) || count( $item["hijos"] ) <= 0){
            $active = ('../'.$this->URL == $item["url"])? 'class="active"' : '';
            $html.= '<li '.$active.'><a href="'.$item["url"].'">'.$item["titulo_interfaz"].'</a></li>';
        } else {
            if ($item["id_permiso"] == 0 ){
                foreach ($item["hijos"] as $key => $value) {
                    $html.= $this->dibujarFila($value);
                }
            } else {
                $html.= '<li>';
                $toggled = ($this->ID_URL_PADRE == $item["id_permiso"]) ?  'toggled' : '';
                $html.= '<a href="javascript:void(0);" class="menu-toggle '.$toggled.'">';
                $html.= '<i class="material-icons">'.$item["icono_interfaz"].'</i>';
                $html.= '<span>'.$item["titulo_interfaz"].'</span>';
                $html.= '</a>';
                $html.= '<ul class="ml-menu">';
                foreach ($item["hijos"] as $key => $value) {
                    $html.= $this->dibujarFila($value);
                }
                $html.= '</ul>';
            $html.= '</li>';
            }
            
        }

        return $html;
    }


    public function obtenerMenu()
    {         
        return $this->dibujarFila( $this->crearMenu() );        
    }

};

?>