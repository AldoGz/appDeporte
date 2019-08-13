<?php 
    $arr = split("/",$_SERVER["PHP_SELF"]);        
    $url = $arr[count($arr) - 2];
    $menu = "";
    switch($url){
        case "alumnos":
            $menu .=   '<li class="active">
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "categorias":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "docentes":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "grupos":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "inscripciones":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "somatotipo":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
        case "msomatotipo":
            $menu .=   '<li>
                            <a href="../alumnos">
                                <i class="material-icons">home</i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../categorias">
                                <i class="material-icons">home</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                        <li>
                            <a href="../docentes">
                                <i class="material-icons">home</i>
                                <span>Docentes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../grupos">
                                <i class="material-icons">home</i>
                                <span>Grupos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../inscripciones">
                                <i class="material-icons">home</i>
                                <span>Inscripciones</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../somatotipo">
                                <i class="material-icons">home</i>
                                <span>Somatotipo</span>
                            </a>
                        </li>';
            break;
    }
?>

<div class="menu">
    <ul class="list">
        <li class="header">Menú principal</li>
        <?php echo $menu; ?>
        <!-- #Construir Menú -->
        <li>
            <a href="javascript:void(0);" onclick="Util.cerrarSesion();"  class="waves-effect waves-block">
                <i class="material-icons col-green">donut_large</i>
                <span>Cerrar Sesión</span>
            </a>
        </li>                    
    </ul>
</div>


  <!-- Construir Menú -->
        <!--<li>
            <a href="../../index.html">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>                    
        <li class="active">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">content_copy</i>
                <span>PAGINAS</span>
            </a>
            <ul class="ml-menu">
                <li class="active">
                    <a href="../../vista/prueba">Primero</a>
                </li>
                <li>
                    <a href="../../vista/prueba2">Segundo</a>
                </li>
            </ul>
        </li>-->
