<?php
    $rutaTemplate = "../build/";
    //include $rutaTemplate.'AccesoAuxiliar.clase.php';
    //$objAcceso = new AccesoAuxiliar();
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once $rutaTemplate.'meta.vista.php'; ?>
    <title>Grupo</title>
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
                                    <h2>Formulario de grupo</h2>
                                </div>
                                <div class="col-xs-12 col-sm-2 align-right">
                                    <select class="form-control show-tick" id="cboEstado">           
                                        <option value="1">ACTIVOS</option>
                                        <option value="0">INACTIVOS</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-2 align-right">
                                    <button id="btnAgregar" type="button" class="btn bg-cyan btn-block btn-sm waves-effect" data-toggle="modal" href="#myModal" title="Nuevo grupo">NUEVO</button>
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
                                                        <input type="hidden" id="intCodigoGrupo" name="intCodigoGrupo" class="form-control">
                                                        <input type="hidden" id="operacion" name="operacion" class="form-control">


                                                        <div class="row clearfix">
                                                            <div class="col-sm-12">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4" id="ianio">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strAnio" name="strAnio" class="form-control">
                                                                                <label class="form-label">Año</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8" id="idescripcion">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input type="text" id="strDescripcion" name="strDescripcion" class="form-control">
                                                                                <label class="form-label">Descripción</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control show-tick" id="intCategoria">
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control show-tick" id="intDocente">
                                                                        </select>
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

                                    <!-- #Modal Horario -->
                                    <div class="modal fade" id="myModal2" role="dialog" style="display: none;">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"></h4>
                                                </div>                                                
                                                <div class="modal-body">
                                                    <div class="row clearfix" id="mostrar">
                                                        <input type="hidden" id="intCodigoHorario" class="form-control" placeholder="codigo horario">
                                                        <input type="hidden" id="operacionHorario" class="form-control" placeholder="operacion">
                                                        <input type="hidden" id="intGrupo" class="form-control" placeholder="codigo_grupo">

                                                        <!---->
                                                        <div class="col-sm-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <div class="col-sm-10">
                                                                        <h2 id="title-panel"></h2>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button type="button" class="close" aria-hidden="true" id="btnCerrarOPC">&times;</button>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                                <div class="body">
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control show-tick" id="intDia">
                                                                                <option value="" disabled selected>Seleccionar día</option>
                                                                                <option value="1">Lunes</option>
                                                                                <option value="2">Martes</option>
                                                                                <option value="3">Miercoles</option>
                                                                                <option value="4">Jueves</option>
                                                                                <option value="5">Viernes</option>
                                                                                <option value="6">Sábado</option>
                                                                                <option value="7">Domingo</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input type="time" class="form-control" id="strTimeInicio">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input type="time" class="form-control" id="strTimeFin">
                                                                        </div>
                                                                    </div>  


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!---->                                              
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-sm-2 col-sm-offset-10">
                                                            <button type="button" id="btnNuevoHorario" class="btn btn-block btn-lg btn-warning  waves-effect" title="Nuevo horario">Nuevo</button>
                                                        </div>
                                                    </div> 
                                                    <div class="row clearfix">
                                                        <div class="col-sm-12">
                                                            <div id="listar-horarios" class="table-responsive"></div>
                                                        </div>
                                                    </div>                                                         .
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #Modal horario -->

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