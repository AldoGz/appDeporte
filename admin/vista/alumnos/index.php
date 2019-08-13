<?php
    $rutaTemplate = "../build/";
    //include $rutaTemplate.'AccesoAuxiliar.clase.php';
    //$objAcceso = new AccesoAuxiliar();
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once $rutaTemplate.'meta.vista.php'; ?>
    <title>Alumnos</title>
    <?php require_once $rutaTemplate.'estilo.vista.php'; ?>
</head>

<body class="theme-cyan">
    <?php require_once $rutaTemplate.'loader.vista.php'; ?> 
    <?php require_once $rutaTemplate.'cabecera.vista.php'; ?>       
    
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php require_once $rutaTemplate.'user-info.vista.php'; ?> 
            <?php require_once $rutaTemplate.'menu.vista.php'; ?> 
            <?php require_once $rutaTemplate.'pie-pagina.vista.php'; ?> 
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!--SE ESTA PENSADO HACER UN CHAT-->    
        <!--<aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>

                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>-->
        <!-- #END# Right Sidebar -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <!-- CONTENIDO DE PAGINA WEB -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-8">
                                    <h2>Formulario de alumno</h2>
                                </div>
                                <div class="col-xs-12 col-sm-2 align-right">
                                    <select class="form-control show-tick" id="cboEstado">           
                                        <option value="1">ACTIVOS</option>
                                        <option value="0">INACTIVOS</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-2 align-right">
                                    <button id="btnAgregar" type="button" class="btn bg-cyan btn-block btn-sm waves-effect" data-toggle="modal" href="#myModal" title="Nuevo alumno">NUEVO</button>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="listado" class="table-responsive"></div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" role="dialog" style="display: none;">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"></h4>
                                                </div>
                                                <form name="frm-grabar" id="frm-grabar"  role="form">
                                                    <div class="modal-body">
                                                        <input type="hidden" id="intCodigoAlumno" name="intCodigoAlumno" class="form-control">
                                                        <input type="hidden" id="operacion" name="operacion" class="form-control">


                                                        <div class="row clearfix">
                                                            <div class="col-sm-8">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12" id="idocumento">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strDocumento" name="strDocumento" class="form-control" maxlength="8">
                                                                                <label class="form-label">DNI</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12" id="inombres">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strNombres" name="strNombres" class="form-control" >
                                                                                <label class="form-label">Nombres completos</label>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12" id="ipaterno">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strPaterno" name="strPaterno" class="form-control">
                                                                                <label class="form-label">Apellido Paterno</label>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12" id="imaterno">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strMaterno" name="strMaterno" class="form-control">
                                                                                <label class="form-label">Apellido Materno</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-6">
                                                                        <h5>Sexo</h5>
                                                                        <div class="form-group">
                                                                            <input type="radio" name="intSexo" id="male" class="with-gap" value="1">
                                                                            <label for="male">Male</label>

                                                                            <input type="radio" name="intSexo" id="female" class="with-gap" value="0">
                                                                            <label for="female">Female</label>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-sm-6">
                                                                        <h5>Fecha de nacimiento</h5>
                                                                        <input type="date" id="dateNacimiento" name="dateNacimiento" class="form-control">
                                                                    </div> 
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12">
                                                                        <div class="panel" id="mostrarImagenFile">
                                                                            <div class="panel-heading">                                             
                                                                                <div class="right"><label id="btnCerrarImagen">X</label></div>
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <div class="text-center">
                                                                                    <img id="adjuntarImagen" name="adjuntarImagen" class="rounded" alt="foto" width="100" height="100" > 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix"> 
                                                                    <div class="col-sm-12">
                                                                        <button type="button" id="btnSubirImagen" class="btn btn-block waves-effect" style="position:relative;">
                                                                            Subir imagen<input type="file" id="archivoFoto" style="left:0;top:0;right:0;bottom:0;width:100%;height:100%;position:absolute;opacity:0;"> 
                                                                        </button>
                                                                    </div> 
                                                                </div>                                                               
                                                                
                                                            </div>
                                                        </div>                                                          .
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="boton" class="btn btn-link waves-effect">Guardar</button>
                                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #Modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #CONTENIDO DE PAGINA WEB --> 
        </div>
    </section>
    <?php require_once $rutaTemplate.'script.vista.php'; ?>

</body>
</html>