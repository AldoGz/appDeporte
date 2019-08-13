var DOM = {};
$(document).ready(function () {
    setDOM();
    setEventos();
    listar();
    cargarAlumno();
    cargarGrupo();
});
function setDOM() {
    DOM.p_codigo_inscripcion = $("#intCodigoInscripcion"),
    DOM.p_codigo_grupo = $("#intGrupo"),
    DOM.p_codigo_alumno = $("#intAlumno"),

	DOM.self = $("#myModal"),
	DOM.btnAgregar = $("#btnAgregar"),
	DOM.operacion = $("#operacion"),
    DOM.cboEstado = $("#cboEstado")

	DOM.form = $("#boton");
}

function limpiar(){
    DOM.p_codigo_inscripcion.val("");    
    DOM.p_codigo_alumno.val("").selectpicker('refresh');
    DOM.p_codigo_grupo.val("").selectpicker('refresh');
}

function setEventos() {    
	DOM.btnAgregar.click(function(e){
		DOM.self.find(".modal-title").text("Agregar nueva inscripcion");
		DOM.operacion.val("agregar");
        limpiar();
	});


    DOM.form.click(function(evento){
        evento.preventDefault();

        if ( DOM.p_codigo_alumno.val() === '' ) {
            alert("Debe seleccionar un alumno para la inscripción");
            return 0;
        }

        if ( DOM.p_codigo_grupo.val() === '' ) {
            alert("Debe seleccionar un grupo para la inscripción");
            return 0;
        }

        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    limpiar();
                    listar();
                    DOM.self.modal("hide");                    
                    resultado.datos.estado === true ? alert(resultado.datos.msj) : alert(resultado.datos.msj);                                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        };         
        new Ajxur.Api({
            modelo: "Inscripcion",
            metodo: DOM.operacion.val(),
            data_in: {
                p_codigo_inscripcion : DOM.p_codigo_inscripcion.val(),
                p_codigo_alumno : DOM.p_codigo_alumno.val(),
                p_codigo_grupo : DOM.p_codigo_grupo.val()
            }
        }, funcion);
    });

    DOM.cboEstado.change(function () {
        listar();
    });
}

function listar(){
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = "";
                html += '<table id="tabla-listado-inscripcion" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">';                
                html += '<thead>';
                html += '<tr>';
                html += '<th style="text-align: center">N°</th>';
                html += '<th style="text-align: center">Grupo</th>';
                html += '<th style="text-align: center">Alumno</th>';
                html += '<th style="text-align: center">OPCIONES</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';                
                $.each(resultado.datos.msj, function (i, item) {                 
                    html += '<tr>';
                    html += '<td align="center">' + (i+1) +'</td>';
                    html += '<td align="center">' + item.grupo + '</td>';
                    html += '<td align="center">' + item.alumno + '</td>';

                    html += '<td align="center">';
                    if ( item.estado == "1" ) {
                        html += '<button type="button" class="btn btn-xs bg-lime waves-effect" title="Editar inscripción" onclick="leerDatos('+item.codigo_inscripcion+')" data-toggle="modal" href="#myModal"><i class="material-icons">edit</i></button>';
                        html += '&nbsp;&nbsp;';
                    }

                    var tmpEstado = item.estado != "1" ?
                        {icon: "up", title: "Habilitar", estado: "habilitar", bol: 1, boton: "btn-warning"} :
                        {icon: "down", title: "Deshabilitar", estado: "deshabilitar", bol: 0, boton: "btn-danger"};

                    html += '<button type="button" class="btn btn-xs '+tmpEstado.boton+' waves-effect" title="'+tmpEstado.title+' inscripción" onclick="darBaja('+item.codigo_inscripcion+","+tmpEstado.bol+')"><i class="material-icons">thumb_'+tmpEstado.icon+'</i></button>';
                    html += '&nbsp;&nbsp;';

                    html += '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '<tfoot>';            
                html += '</tfoot>';
                html += '</table>';
                $("#listado").html(html);
                $("#tabla-listado-inscripcion").dataTable({
                    "responsive": true
                });
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }    
        } 
    };
    new Ajxur.Api({
        modelo: "Inscripcion",
        metodo: "listar",
        data_in: {
            p_estado: DOM.cboEstado.val()
        }
    }, funcion);
}

function leerDatos(codigo_inscripcion){
    DOM.self.find(".modal-title").text("Editar datos de la inscripcion");
    DOM.operacion.val("editar");

    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                DOM.p_codigo_inscripcion.val(datos.codigo_inscripcion);
                DOM.p_codigo_alumno.val(datos.codigo_alumno).selectpicker('refresh');
                DOM.p_codigo_grupo.val(datos.codigo_grupo).selectpicker('refresh');            
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Inscripcion",
        metodo: "leerDatos",
        data_in: {
            p_codigo_inscripcion : codigo_inscripcion
        }
    }, funcion);
}

function darBaja(codigo_inscripcion,estado){
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                alert(resultado.datos.msj);
                listar();
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Inscripcion",
        metodo: "darBaja",
        data_in: {
            p_codigo_inscripcion : codigo_inscripcion,
            p_estado : estado
        }
    }, funcion);
}

function cargarGrupo(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" disabled selected>Seleccionar grupo</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_grupo + '">('+ item.descripcion + ') ' + item.categoria + '</option>';
                });
                DOM.p_codigo_grupo.html(html).selectpicker('refresh');
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Grupo",
        metodo: "llenarCB"
    }, funcion);
}

function cargarAlumno(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" disabled selected>Seleccionar alumno</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_alumno + '">(' + item.documento +') '+ item.nombres + ' ' + item.paterno + ' ' + item.materno + '</option>';
                });
                DOM.p_codigo_alumno.html(html).selectpicker('refresh');
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Alumno",
        metodo: "llenarCB"
    }, funcion);
}
