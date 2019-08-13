var DOM = {};
$(document).ready(function () {
    setDOM();
    setEventos();
    cargarAlumno();
    cargarFormulario();


});
function setDOM() {
    DOM.p_codigo_alumno =  $("#intAlumno"),

    DOM.btnNuevo = $("#btnAgregar")

     ;
    
}

function cargarFormulario(){    
    if ( DOM.p_codigo_alumno.val() === "" || DOM.p_codigo_alumno.val() === null ) {
        $("#mostrarA").hide(); 
        $("#listado").empty();
    }else{
        $("#mostrarA").show();
        listar();
    }    
}

function setEventos() {   
    DOM.p_codigo_alumno.change(function(){
        cargarFormulario();
    });	

    DOM.btnNuevo.click(function(){
        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    resultado.datos.estado === true ? alert(resultado.datos.msj):  alert(resultado.datos.msj); 
                    listar();                  
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        };         
        new Ajxur.Api({
            modelo: "Medidas",
            metodo: "agregar",
            data_in: {
                p_codigo_alumno : DOM.p_codigo_alumno.val()
            }
        }, funcion);        
    });
}

function listar(){
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = "";
                html += '<table id="tabla-listado-somatotipos" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">';                
                html += '<thead>';
                html += '<tr>';
                html += '<th style="text-align: center">N°</th>';
                html += '<th style="text-align: center">Antropometricos</th>';
                html += '<th style="text-align: center">Pliegues</th>';
                html += '<th style="text-align: center">Diametros</th>';
                html += '<th style="text-align: center">Perimetros</th>';
                
                html += '<th style="text-align: center">OPCIONES</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';             
                $.each(resultado.datos.msj, function (i, item) {                 
                    html += '<tr>';
                    html += '<td align="center">' + (i+1) +'</td>';
                    html += '<td align="center">' + (item.antropometricos == '1' ?  '<i class="material-icons">check</i>':'<i class="material-icons">close</i>') + '</td>';
                    html += '<td align="center">' + (item.pliegues == '1' ?  '<i class="material-icons">check</i>':'<i class="material-icons">close</i>') + '</td>';
                    html += '<td align="center">' + (item.diametros == '1' ?  '<i class="material-icons">check</i>':'<i class="material-icons">close</i>') + '</td>';
                    html += '<td align="center">' + (item.perimetros == '1' ?  '<i class="material-icons">check</i>':'<i class="material-icons">close</i>') + '</td>';                    

                    html += '<td align="center">';
                    if ( item.estado == "1" ) {
                        html += '<button type="button" class="btn btn-xs bg-lime waves-effect" title="Editar somatotipo" onclick="leer('+item.codigo_registro+')"><i class="material-icons">edit</i></button>';
                        html += '&nbsp;&nbsp;';
                    }else{
                        html += '<button type="button" class="btn btn-xs btn-danger waves-effect" title="Ver somatotipo" onclick="leer('+item.codigo_registro+')">Terminado</button>';
                        html += '&nbsp;&nbsp;';
                    }
                    html += '</td>'                    
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '<tfoot>';            
                html += '</tfoot>';
                html += '</table>';
                $("#listado").html(html);
                $("#tabla-listado-somatotipos").dataTable({
                    "responsive": true
                });
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }    
        } 
    };
    new Ajxur.Api({
        modelo: "Medidas",
        metodo: "listar",
        data_in: {
            p_codigo_alumno: DOM.p_codigo_alumno.val()
        }
    }, funcion);
}

function leer(p){
    var codigo_registro = window.btoa(p);
    document.location.href = "../msomatotipo/?pe="+codigo_registro;
}

function cargarAlumno(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" selected>Seleccionar alumno</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_alumno + '">(' + item.documento +') '+ item.nombres + ' ' + item.paterno + ' ' + item.materno + '</option>';
                });
                DOM.p_codigo_alumno.html(html).select2({
                    placeholder: "Seleccionar alumno",
                    allowClear: true
                });             
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Alumno",
        metodo: "inscripcionCB"
    }, funcion);
}
