var DOM = {};
$(document).ready(function () {
    setDOM();
    setEventos();
    listar();
    archivo();
});
function setDOM() {
    DOM.p_codigo_docente = $("#intCodigoDocente"),
	DOM.p_documento = $("#strDocumento"),
	DOM.p_nombres = $("#strNombres"),
	DOM.p_paterno = $("#strPaterno"),
	DOM.p_materno = $("#strMaterno"),
    DOM.p_fecha_nacimiento = $("#dateNacimiento"),
    DOM.p_direccion = $("#strDireccion"),
    DOM.p_telefono = $("#strTelefono"),

	DOM.self = $("#myModal"),
	DOM.btnAgregar = $("#btnAgregar"),
	DOM.operacion = $("#operacion"),
    DOM.cboEstado = $("#cboEstado")

	DOM.form = $("#boton"),

    DOM.btnCerrarImagen = $("#btnCerrarImagen"),

	DOM.imagen = $("#imagen");
}



function validar(){
    DOM.p_documento.keypress(function (e) {
        return Validar.soloNumeros(e);
    }); 
    DOM.p_nombres.keypress(function(e){
        return Validar.soloLetras(e);
    });
    DOM.p_paterno.keypress(function(e){
        return Validar.soloLetras(e);
    });
    DOM.p_materno.keypress(function(e){
        return Validar.soloLetras(e);
    });
    DOM.p_telefono.keypress(function (e) {
        return Validar.soloNumeros(e);
    }); 
}

function limpiar(){
    DOM.p_codigo_docente.val("");
    DOM.p_documento.val("");
    DOM.p_nombres.val("");
    DOM.p_paterno.val("");
    DOM.p_materno.val("");
    DOM.p_fecha_nacimiento.val("");
    $('input[name="intSexo"][value="1"]').prop('checked', true);
    DOM.p_direccion.val("");
    DOM.p_telefono.val("");

    $('#adjuntarImagen').attr('src','../../../servidor/images/Docentes/defecto.jpg');
    $("#btnCerrarImagen").hide();
    $("#btnSubirImagen").removeClass("btn-warning");
    $("#btnSubirImagen").addClass("bg-red");
    $("#archivoFoto").val("");        

    $("#idocumento").find(".form-line").removeClass('focused');
    $("#inombres").find(".form-line").removeClass('focused');
    $("#ipaterno").find(".form-line").removeClass('focused');
    $("#imaterno").find(".form-line").removeClass('focused');
    $("#idireccion").find(".form-line").removeClass('focused');
    $("#itelefono").find(".form-line").removeClass('focused');
}

function archivo(){
    if ( $("#archivoFoto")[0].files.length === 0 ) {
        $('#adjuntarImagen').attr('src','../../../servidor/images/Docentes/defecto.jpg');
        $("#btnCerrarImagen").hide();
        $("#btnSubirImagen").addClass("bg-red");
    }else{
        cargarImagenFile($("#archivoFoto")[0]);
        $("#btnSubirImagen").addClass("btn-warning");
        $("#btnCerrarImagen").show();
    }
}

function cargarImagenFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#adjuntarImagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function setEventos() {
    validar();

    DOM.btnCerrarImagen.click(function(){
        $('#adjuntarImagen').attr('src','../../../servidor/images/Docentes/defecto.jpg');
        $("#btnCerrarImagen").hide();
        $("#archivoFoto").val("");
        $("#btnSubirImagen").removeClass("btn-warning");
        $("#btnSubirImagen").addClass("bg-red");
    });

	DOM.btnAgregar.click(function(e){
		DOM.self.find(".modal-title").text("Agregar nuevo docente");
		DOM.operacion.val("agregar");
        limpiar();
	});

    $("#archivoFoto").change(function(){
        archivo();
    });


    DOM.form.click(function(evento){
        evento.preventDefault();

        if ( DOM.p_documento.val().length < 8 ) {
            alert("Debe tener 8 digitos");
            return 0;
        }

        if ( DOM.p_nombres.val() === '' ) {
            alert("Debe ingresar los nombres completos para el docente");
            return 0;
        }

        if ( DOM.p_paterno.val() === '' ) {
            alert("Debe ingresar el apellido paterno del docente");
            return 0;
        }

        if ( DOM.p_materno.val() === '' ) {
            alert("Debe ingresar el apellido materno del docente");
            return 0;
        }

        var datos_frm = new FormData();
        datos_frm.append("p_foto", $("#archivoFoto").prop('files')[0]);        
        datos_frm.append("p_array_datos", $("#frm-grabar").serialize());

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
        $.ajax({
            url: "../../../servidor/ws/controlador.docente.php",
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: datos_frm,
            type: 'post',
            success: funcion
        });

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
                html += '<table id="tabla-listado-docentes" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">';                
                html += '<thead>';
                html += '<tr>';
                html += '<th style="text-align: center">Foto</th>';
                html += '<th style="text-align: center">Docente</th>';
                html += '<th style="text-align: center">Fecha Nacimiento</th>';
                html += '<th style="text-align: center">Edad (años cumplidos)</th>';
                html += '<th style="text-align: center">OPCIONES</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';                
                $.each(resultado.datos.msj, function (i, item) {                 
                    html += '<tr>';
                    html += '<td align="center"><img src="../../../servidor/images/Docentes/'+ item.foto +'" alt="foto" height="42" width="42"></td>';
                    html += '<td align="center">' + item.nombres + '</td>';
                    html += '<td align="center">' + item.fecha_nacimiento + '</td>';
                    html += '<td align="center">' + item.edad + '</td>';

                    html += '<td align="center">';
                    if ( item.estado == "1" ) {
                        html += '<button type="button" class="btn btn-xs bg-lime waves-effect" title="Editar docente" onclick="leerDatos('+item.codigo_docente+')" data-toggle="modal" href="#myModal"><i class="material-icons">edit</i></button>';
                        html += '&nbsp;&nbsp;';
                    }

                    var tmpEstado = item.estado != "1" ?
                        {icon: "up", title: "Habilitar", estado: "habilitar", bol: 1, boton: "btn-warning"} :
                        {icon: "down", title: "Deshabilitar", estado: "deshabilitar", bol: 0, boton: "btn-danger"};

                    html += '<button type="button" class="btn btn-xs '+tmpEstado.boton+' waves-effect" title="'+tmpEstado.title+' docente" onclick="darBaja('+item.codigo_docente+","+tmpEstado.bol+')"><i class="material-icons">thumb_'+tmpEstado.icon+'</i></button>';
                    html += '&nbsp;&nbsp;';

                    html += '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '<tfoot>';            
                html += '</tfoot>';
                html += '</table>';
                $("#listado").html(html);
                $("#tabla-listado-docentes").dataTable({
                    "responsive": true
                });
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }    
        } 
    };
    new Ajxur.Api({
        modelo: "Docente",
        metodo: "listar",
        data_in: {
            p_estado: DOM.cboEstado.val()
        }
    }, funcion);
}

function leerDatos(codigo_docente){
    DOM.self.find(".modal-title").text("Editar datos del docente");
    DOM.operacion.val("editar");

    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                DOM.p_codigo_docente.val(datos.codigo_docente);
                DOM.p_documento.val(datos.documento);                
                DOM.p_nombres.val(datos.nombres);
                DOM.p_paterno.val(datos.paterno);
                DOM.p_materno.val(datos.materno);
                $('input[name="intSexo"][value="' + datos.sexo + '"]').prop('checked', true);
                DOM.p_fecha_nacimiento.val(datos.fecha_nacimiento);
                DOM.p_direccion.val(datos.direccion);
                DOM.p_telefono.val(datos.telefono);

                if ( datos.foto === 'defecto.jpg') {
                    $('#adjuntarImagen').attr('src','../../../servidor/images/docentes/defecto.jpg');
                    $("#btnCerrarImagen").hide();
                    $("#btnSubirImagen").addClass("bg-red");
                }else{
                    $('#adjuntarImagen').attr('src','../../../servidor/images/docentes/'+datos.foto);
                    $("#btnCerrarImagen").show();
                    $("#btnSubirImagen").addClass("btn-warning");
                }

                $("#idocumento").find(".form-line").addClass('focused');
                $("#inombres").find(".form-line").addClass('focused');
                $("#ipaterno").find(".form-line").addClass('focused');
                $("#imaterno").find(".form-line").addClass('focused');
                $("#idireccion").find(".form-line").addClass('focused');
                $("#itelefono").find(".form-line").addClass('focused');                   
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Docente",
        metodo: "leerDatos",
        data_in: {
            p_codigo_docente : codigo_docente
        }
    }, funcion);
}

function darBaja(codigo_docente,estado){
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
        modelo: "Docente",
        metodo: "darBaja",
        data_in: {
            p_codigo_docente : codigo_docente,
            p_estado : estado
        }
    }, funcion);
}