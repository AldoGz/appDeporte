<?php
    $rutaTemplate = "../build/";
    //include $rutaTemplate.'AccesoAuxiliar.clase.php';
    //$objAcceso = new AccesoAuxiliar();
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once $rutaTemplate.'meta.vista.php'; ?>
    <title>Evaluación de somatotipo</title>
    <?php require_once $rutaTemplate.'estilo.vista.php'; ?>
</head>

<body class="theme-cyan">
    <div id="chartContainer" style="position: fixed; top:0px;height: 150mm; width: 200mm;"></div>
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
                                <div class="col-sm-12">
                                    <h2>Evaluación de somatotipo</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Datos del alumno</h5>                                                        
                            <input type="hidden" id="txtcodigo_registro" class="form-control">
                            <div class="row clearfix">
                                <div class="col-sm-2">
                                    DNI<input type="text" id="strDocumento" name="strDocumento" class="form-control" disabled>                                    
                                </div>
                                <div class="col-sm-6">
                                    Nombres y apellidos<input type="text" id="strNombres" name="strNombres" class="form-control" disabled>                                    
                                </div>
                                <div class="col-sm-3">
                                    Edad<input type="text" id="strEdad" name="strEdad" class="form-control" disabled>                                    
                                </div>
                                <div class="col-sm-1">
                                    Sexo<input type="text" id="strSexo" name="strSexo" class="form-control" disabled>                                    
                                </div>
                            </div>
                            <hr>
                            <h5>Datos antropométricos</h5>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    Talla(cm)<input type="text" id="strTalla" name="strTalla" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Talla sentado(cm)<input type="text" id="strTallaSentado" name="strTallaSentado" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Peso(kg) <input type="text" id="strPeso" name="strPeso" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Factor actividad
                                    <select class="form-control show-tick" id="txtcodigo_factor">
                                    </select>                                    
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-2 col-sm-offset-10">
                                    <button type="button" id="btnGrabar01" class="btn btn-block btn-lg btn-success  waves-effect" title="Grabar datos antropométricos">Grabar</button>
                                </div>
                            </div> 
                            <hr>
                            <h5>Pliegues cutáneos</h5>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    Pliegue Tricipital(mm)<input type="text" id="strTricipital" name="strTricipital" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Pliegue Subescapular(mm)<input type="text" id="strSubescapular" name="strSubescapular" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Pliegue Supraespinal(mm)<input type="text" id="strSupraespinal" name="strSupraespinal" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Pliegue Abdominal(mm)<input type="text" id="strAbdominal" name="strAbdominal" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Pliegue Muslo Anterior(mm)<input type="text" id="strMusloAnterior" name="strMusloAnterior" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Pliegue Pierna Medial(mm)<input type="text" id="strPiernaMedial" name="strPiernaMedial" class="form-control">                                    
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-2 col-sm-offset-10">
                                    <button type="button" id="btnGrabar02" class="btn btn-block btn-lg btn-success  waves-effect" title="Nuevo horario">Grabar</button>
                                </div>
                            </div> 
                            <hr>
                            <h5>Diametros</h5>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    Diámetro Biestiloideo Muñeca(cm)<input type="text" id="strMuneica" name="strMuneica" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Diámetro Bicondíleo Fémur(cm)<input type="text" id="strFemur" name="strFemur" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Diámetro Biepicondíleo Húmero(cm)<input type="text" id="strHumero" name="strHumero" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Diámetro Biileocrestal(cm)<input type="text" id="strBileocrestal" name="strBileocrestal" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Diámetro Biacromial(cm)<input type="text" id="strBiacromial" name="strBiacromial" class="form-control">                                    
                                </div>  
                                <div class="col-sm-2 col-sm-offset-2">
                                    <br>
                                    <button type="button" id="btnGrabar03" class="btn btn-block btn-lg btn-success  waves-effect" title="Nuevo horario">Grabar</button>
                                </div>                              
                            </div>
                            <hr>
                            <h5>Perímetro</h5>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    Perímetro Mesoesternal(cm)<input type="text" id="strMesoesternal" name="strMesoesternal" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Perímetro de Brazo Contraído(cm)<input type="text" id="strBrazo" name="strBrazo" class="form-control">                                    
                                </div>
                                <div class="col-sm-4">
                                    Perímetro de Pierna(cm)<input type="text" id="strPierna" name="strPierna" class="form-control">                                    
                                </div>                              
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-2 col-sm-offset-10">
                                    <button type="button" id="btnGrabar04" class="btn btn-block btn-lg btn-success  waves-effect" title="Nuevo horario">Grabar</button>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-2 col-sm-offset-10">
                                    <button type="button" id="btnGrabar05" class="btn btn-block btn-lg btn-success  waves-effect" title="Ver reporte">Ver reporte</button>
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
    <script src="../../canvasjs.min.js"></script>
    <script src="../../html2canvas.min.js"></script>
    <script src="../../jsPDF/dist/jspdf.debug.js"></script> 

</body>
</html>