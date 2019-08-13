var DOM = {};
$(document).ready(function () {
    setDOM();
    setEventos();
    listar();
    cargarCategorias();
    cargarDocentes();
    $("#mostrar").hide();

});
function setDOM() {
    DOM.p_codigo_grupo = $("#intCodigoGrupo"),
    DOM.p_anio = $("#strAnio"),
    DOM.p_descripcion = $("#strDescripcion"),
    DOM.p_codigo_categoria = $("#intCategoria"),
    DOM.p_codigo_docente = $("#intDocente"),

    DOM.p_codigo_horario = $("#intCodigoHorario");
    DOM.p_dia = $("#intDia"),
    DOM.p_horario_inicio = $("#strTimeInicio"),
    DOM.p_horario_fin = $("#strTimeFin"),
    DOM.p_grupo = $("#intGrupo"),



	DOM.self = $("#myModal"),
    DOM.self2 = $("#myModal2"),
	DOM.btnAgregar = $("#btnAgregar"),
    DOM.btnNuevoHorario = $("#btnNuevoHorario"),
    DOM.btnCerrarOPC = $("#btnCerrarOPC"),
	DOM.operacion = $("#operacion"),
    DOM.operacionHorario = $("#operacionHorario"),
    DOM.cboEstado = $("#cboEstado")

	DOM.form = $("#boton");
}

function limpiar(){
    DOM.p_codigo_grupo.val("");
    DOM.p_anio.val("");
    DOM.p_descripcion.val("");
    DOM.p_codigo_categoria.val("").selectpicker('refresh');
    DOM.p_codigo_docente.val("").selectpicker('refresh');

    $("#ianio").find(".form-line").removeClass('focused');
    $("#idescripcion").find(".form-line").removeClass('focused');
}

function limpiar2(){
    DOM.p_dia.val("").selectpicker('refresh');;
    DOM.p_horario_inicio.val("");
    DOM.p_horario_fin.val("");
}

function validarHorarios(hora_inicio, hora_fin) {      
    var hi = hora_inicio.split(":"); 
    var hf = hora_fin.split(":");

    // Obtener horas y minutos (hora inicio) 
    var hh1 = parseInt(hi[0],10); 
    var mm1 = parseInt(hi[1],10); 

    // Obtener horas y minutos (hora inicio) 
    var hh2 = parseInt(hf[0],10); 
    var mm2 = parseInt(hf[1],10); 


    if ( hh1 < hh2 || ( hh1 === hh2 && mm1<mm2 )) {
        return true;
    }
    return false;
} 


function setEventos() {    
	DOM.btnAgregar.click(function(e){
		DOM.self.find(".modal-title").text("Agregar nuevo grupo");
		DOM.operacion.val("agregar");
        limpiar();
	});

    DOM.btnCerrarOPC.click(function(){
        DOM.btnNuevoHorario.removeClass("btn-success");
        DOM.btnNuevoHorario.addClass("btn-warning");
        DOM.btnNuevoHorario.text("Nuevo");
        limpiar2();
        $("#mostrar").hide();
        $(".btnEditarHorario").attr("disabled",false);
        $(".btnEliminarHorario").attr("disabled",false);
    });

    DOM.btnNuevoHorario.click(function(){    
        if ( $(this)[0].classList.contains('btn-warning') ) {
            DOM.btnNuevoHorario.removeClass("btn-warning");
            DOM.btnNuevoHorario.addClass("btn-success");
            DOM.btnNuevoHorario.text("Grabar");            
            $("#mostrar").show(); 
            DOM.operacionHorario.val("agregar");
            $(".btnEditarHorario").attr("disabled",true);
            $(".btnEliminarHorario").attr("disabled",true);
            $("#title-panel").text("Nuevo horario");
        }else{
            if ( DOM.p_dia.val() === null ) {
                alert("Debe seleccionar un dia para el horario");
                return 0;
            }

            if ( DOM.p_horario_inicio.val() === "" ) {
                alert("Debe ingresar un horario inicial");
                return 0;
            }

            if ( DOM.p_horario_fin.val() === "" ) {
                alert("Debe ingresar un horario final");
                return 0;
            }

            if ( !validarHorarios(DOM.p_horario_inicio.val(),DOM.p_horario_fin.val()) ) {
                alert("El horario fin debe ser mayor que el horario inicio");
                return 0;   
            }
            

            var funcion = function (resultado) {
                if (resultado.estado === 200) {
                    if (resultado.datos.rpt === true) {
                        DOM.btnNuevoHorario.removeClass("btn-success");
                        DOM.btnNuevoHorario.addClass("btn-warning");
                        DOM.btnNuevoHorario.text("Nuevo");
                        limpiar2();
                        $("#mostrar").hide();
                        listarHorarios(DOM.p_grupo.val());
                        alert(resultado.datos.msj);                   
                    }else{
                        alert(resultado.datos.msj.errorInfo[2]);         
                    }
                }    
            };         
            new Ajxur.Api({
                modelo: "Horario",
                metodo: DOM.operacionHorario.val(),
                data_in: {
                    p_codigo_horario : DOM.p_codigo_horario.val(),
                    p_dia : DOM.p_dia.val(),
                    p_horario_inicio : DOM.p_horario_inicio.val(),
                    p_horario_fin : DOM.p_horario_fin.val(),
                    p_codigo_grupo : DOM.p_grupo.val()
                }
            }, funcion);           
        }
    });


    DOM.form.click(function(evento){
        evento.preventDefault();

        if ( DOM.p_anio.val() === '' ) {
            alert("Debe ingresar un año para el grupo");
            return 0;
        }

        if ( DOM.p_descripcion.val() === '' ) {
            alert("Debe ingresar una descripción para el grupo");
            return 0;
        }

        if ( DOM.p_codigo_categoria.val() === '' ) {
            alert("Debe seleccionar una categoria para el grupo");
            return 0;
        }

        if ( DOM.p_codigo_docente.val() === '' ) {
            alert("Debe seleccionar un docente para el grupo");
            return 0;
        }

        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    limpiar();
                    listar();
                    DOM.self.modal("hide");
                    alert(resultado.datos.msj);                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        };         
        new Ajxur.Api({
            modelo: "Grupo",
            metodo: DOM.operacion.val(),
            data_in: {
                p_codigo_grupo : DOM.p_codigo_grupo.val(),
                p_anio : DOM.p_anio.val(),
                p_descripcion : DOM.p_descripcion.val(),
                p_codigo_categoria : DOM.p_codigo_categoria.val(),
                p_codigo_docente : DOM.p_codigo_docente.val()
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
                html += '<table id="tabla-listado-grupos" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">';                
                html += '<thead>';
                html += '<tr>';
                html += '<th style="text-align: center">N°</th>';
                html += '<th style="text-align: center">Grupo</th>';
                html += '<th style="text-align: center">Categoria</th>';
                html += '<th style="text-align: center">Docente</th>';
                html += '<th style="text-align: center">OPCIONES</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';                
                $.each(resultado.datos.msj, function (i, item) {                 
                    html += '<tr>';
                    html += '<td align="center">' + (i+1) +'</td>';
                    html += '<td align="center">' + item.descripcion + '</td>';
                    html += '<td align="center">' + item.categoria + '</td>';
                    html += '<td align="center">' + item.docente + '</td>';


                    html += '<td align="center">';
                    if ( item.estado == "1" ) {
                        html += '<button type="button" class="btn btn-xs bg-lime waves-effect" title="Editar grupo" onclick="leerDatos('+item.codigo_grupo+')" data-toggle="modal" href="#myModal"><i class="material-icons">edit</i></button>';
                        html += '&nbsp;&nbsp;';
                    }

                    var tmpEstado = item.estado != "1" ?
                        {icon: "up", title: "Habilitar", estado: "habilitar", bol: 1, boton: "btn-warning"} :
                        {icon: "down", title: "Deshabilitar", estado: "deshabilitar", bol: 0, boton: "btn-danger"};

                    html += '<button type="button" class="btn btn-xs '+tmpEstado.boton+' waves-effect" title="'+tmpEstado.title+' grupo" onclick="darBaja('+item.codigo_grupo+","+tmpEstado.bol+')"><i class="material-icons">thumb_'+tmpEstado.icon+'</i></button>';
                    html += '&nbsp;&nbsp;';

                    html += '<button type="button" class="btn btn-xs btn-default waves-effect" title="Ver horarios" onclick="ver('+item.codigo_grupo+",'"+item.descripcion +"','"+item.categoria+"'"+')" data-toggle="modal" href="#myModal2"><i class="material-icons">remove_red_eye</i></button>';
                    html += '&nbsp;&nbsp;';

                    html += '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '<tfoot>';            
                html += '</tfoot>';
                html += '</table>';
                $("#listado").html(html);
                $("#tabla-listado-grupos").dataTable({
                    "responsive": true
                });
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }    
        } 
    };
    new Ajxur.Api({
        modelo: "Grupo",
        metodo: "listar",
        data_in: {
            p_estado: DOM.cboEstado.val()
        }
    }, funcion);
}

function leerDatos(codigo_grupo){
    DOM.self.find(".modal-title").text("Editar datos del grupo");
    DOM.operacion.val("editar");

    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                DOM.p_codigo_grupo.val(datos.codigo_grupo);
                DOM.p_anio.val(datos.anio);
                DOM.p_descripcion.val(datos.descripcion);
                DOM.p_codigo_categoria.val(datos.codigo_categoria).selectpicker('refresh');
                DOM.p_codigo_docente.val(datos.codigo_docente).selectpicker('refresh');

                $("#ianio").find(".form-line").addClass('focused');
                $("#idescripcion").find(".form-line").addClass('focused');              
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Grupo",
        metodo: "leerDatos",
        data_in: {
            p_codigo_grupo : codigo_grupo
        }
    }, funcion);
}

function darBaja(codigo_grupo,estado){
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
        modelo: "Grupo",
        metodo: "darBaja",
        data_in: {
            p_codigo_grupo : codigo_grupo,
            p_estado : estado
        }
    }, funcion);
}

function cargarCategorias(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" disabled selected>Seleccionar categoria</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_categoria + '">'+ item.nombre + '</option>';
                });
                DOM.p_codigo_categoria.html(html).selectpicker('refresh');
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Categoria",
        metodo: "llenarCB"
    }, funcion);
}

function cargarDocentes(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" disabled selected>Seleccionar docente</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_docente + '">(' + item.documento +') '+ item.nombres + ' ' + item.paterno + ' ' + item.materno + '</option>';
                });
                DOM.p_codigo_docente.html(html).selectpicker('refresh');
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Docente",
        metodo: "llenarCB"
    }, funcion);
}

function ver(codigo_grupo,nombre,categoria){
    DOM.self2.find(".modal-title").text("Horario del grupo "+nombre.toLowerCase()+" categoria: "+categoria.toLowerCase());
    DOM.btnNuevoHorario.removeClass("btn-success");
    DOM.btnNuevoHorario.addClass("btn-warning");
    DOM.btnNuevoHorario.text("Nuevo");
    limpiar2();
    $("#mostrar").hide();
    
    DOM.p_grupo.val(codigo_grupo);
    listarHorarios(codigo_grupo);
}


function listarHorarios(codigo_grupo){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = "";
                html += '<table id="tabla-listado-horarios" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">';                
                html += '<thead>';
                html += '<tr>';
                html += '<th style="text-align: center">Día</th>';
                html += '<th style="text-align: center">Turno</th>';
                html += '<th style="text-align: center">Horario</th>';
                html += '<th style="text-align: center">Opciones</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                if ( resultado.datos.msj.length === 0 ) {
                    html += '<tr>';
                    html += '<td colspan="4" align="center">No hay resultado</td>';
                    html += '</tr>';
                }else{
                    $.each(resultado.datos.msj, function (i, item) {                 
                        html += '<tr>';
                        html += '<td align="center">' + item.dia + '</td>';
                        html += '<td align="center">' + item.turno + '</td>';
                        html += '<td align="center">' + item.horario_inicio + ' - ' + item.horario_fin + '</td>';

                        html += '<td align="center">';
                        html += '<button type="button" class="btn btn-xs btn-default waves-effect btnEditarHorario" title="Editar horario" onclick="leerHorario('+ item.codigo_horario +","+ item.codigo_grupo + ",'" + item.dia + "','" + item.turno +"'"+ ')"><i class="material-icons">edit</i></button>';
                        html += '&nbsp;&nbsp;';
                        html += '<button type="button" class="btn btn-xs btn-danger waves-effect btnEliminarHorario" title="Eliminar horario" onclick="eliminarHorario('+ item.codigo_horario +","+ item.codigo_grupo + ')"><i class="material-icons">delete_forever</i></button>';
                        html += '&nbsp;&nbsp;';
                        html += '</td>';

                        html += '</tr>';
                    });
                }
                html += '</tbody>';
                html += '<tfoot>';            
                html += '</tfoot>';
                html += '</table>';
                $("#listar-horarios").html(html);             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Horario",
        metodo: "ver",
        data_in: {
            p_codigo_grupo : codigo_grupo
        }
    }, funcion);
}

function leerHorario(codigo_horario,codigo_grupo,dia,turno){
    DOM.btnNuevoHorario.removeClass("btn-warning");
    DOM.btnNuevoHorario.addClass("btn-success");
    DOM.btnNuevoHorario.text("Grabar");
    $("#mostrar").show(); 
    DOM.operacionHorario.val("editar");
    $("#title-panel").text("Editar horario del " + dia.toLowerCase() +" turno de "+turno.toLowerCase());

    $(".btnEditarHorario").attr("disabled",true);
    $(".btnEliminarHorario").attr("disabled",true);

    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                DOM.p_codigo_horario.val(datos.codigo_horario);
                DOM.p_dia.val(datos.dia).selectpicker('refresh');
                DOM.p_horario_inicio.val(datos.horario_inicio);
                DOM.p_horario_fin.val(datos.horario_fin);             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Horario",
        metodo: "leerDatos",
        data_in: {
            p_codigo_horario : codigo_horario
        }
    }, funcion);

}

function eliminarHorario(codigo_horario,codigo_grupo){
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                alert(resultado.datos.msj);
                listarHorarios(codigo_grupo);
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Horario",
        metodo: "eliminar",
        data_in: {
            p_codigo_horario : codigo_horario
        }
    }, funcion);
}