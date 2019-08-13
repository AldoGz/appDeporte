var DOM = {};
$(document).ready(function () {
    setDOM();
    setEventos();    
    cargarParametro();
    cargarFactores(); 
    $("#chartContainer").hide();
});

function cargarParametro(){
    if ( Parametro.retornar().length === 0 ) {
        document.location.href = "../somatotipo/";
    }
    cargarEstudiante(Parametro.retornar()[0]);
    
}

function cargarEstudiante(p){
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                DOM.p_documento.val(datos["estudiante"].documento);
                DOM.p_nombres.val(datos["estudiante"].nombres);
                DOM.p_edad.val(datos["estudiante"].fecha_nacimiento);
                DOM.p_sexo.val(datos["estudiante"].sexo);

                DOM.p_codigo_registro.val(datos["medidas"].codigo_registro);

                DOM.p_codigo_factor.val(datos["medidas"].codigo_factor).selectpicker('refresh');

                if ( datos["medidas"].antropometricos === "1" ) {                    
                    DOM.p_talla.val(datos["medidas"].talla);
                    DOM.p_talla_sentado.val(datos["medidas"].talla_sentado);
                    DOM.p_peso.val(datos["medidas"].peso);
                    DOM.p_talla.attr("disabled",true);
                    DOM.p_talla_sentado.attr("disabled",true);
                    DOM.p_peso.attr("disabled",true);
                    DOM.p_codigo_factor.attr("disabled",true);
                    DOM.btnGrabar01.hide();
                }

                if ( datos["medidas"].pliegues === "1" ) {                    
                    DOM.p_tricipital.val(datos["medidas"].tricipital);
                    DOM.p_subescapular.val(datos["medidas"].subescapular);
                    DOM.p_supraespinal.val(datos["medidas"].supraespinal);
                    DOM.p_abdominal.val(datos["medidas"].abdominal);
                    DOM.p_muslo_anterior.val(datos["medidas"].muslo_anterior);
                    DOM.p_pierna_medial.val(datos["medidas"].pierna_medial);


                    DOM.p_tricipital.attr("disabled",true);
                    DOM.p_subescapular.attr("disabled",true);
                    DOM.p_supraespinal.attr("disabled",true);
                    DOM.p_abdominal.attr("disabled",true);
                    DOM.p_muslo_anterior.attr("disabled",true);
                    DOM.p_pierna_medial.attr("disabled",true);
                    DOM.btnGrabar02.hide();
                }

                if ( datos["medidas"].diametros === "1" ) {                    
                    DOM.p_muneica.val(datos["medidas"].tricipital);
                    DOM.p_femur.val(datos["medidas"].subescapular);
                    DOM.p_humero.val(datos["medidas"].supraespinal);
                    DOM.p_bileocrestal.val(datos["medidas"].abdominal);
                    DOM.p_biacromial.val(datos["medidas"].muslo_anterior);

                    DOM.p_muneica.attr("disabled",true);
                    DOM.p_femur.attr("disabled",true);
                    DOM.p_humero.attr("disabled",true);
                    DOM.p_bileocrestal.attr("disabled",true);
                    DOM.p_biacromial.attr("disabled",true);
                    DOM.btnGrabar03.hide();
                }

                if ( datos["medidas"].perimetros === "1" ) {                    
                    DOM.p_mesoesternal.val(datos["medidas"].mesoesternal);
                    DOM.p_brazo.val(datos["medidas"].brazo);
                    DOM.p_pierna.val(datos["medidas"].pierna);

                    DOM.p_mesoesternal.attr("disabled",true);
                    DOM.p_brazo.attr("disabled",true);
                    DOM.p_pierna.attr("disabled",true);
                    DOM.btnGrabar04.hide();
                }

                var sumar = parseInt(datos["medidas"].antropometricos)+parseInt(datos["medidas"].pliegues)+parseInt(datos["medidas"].diametros)+parseInt(datos["medidas"].perimetros);

                sumar === 4 ? DOM.btnGrabar05.show() : DOM.btnGrabar05.hide();
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        } 
    };

    new Ajxur.Api({
        modelo: "Medidas",
        metodo: "autocompletar",
        data_in: {
            p_codigo_registro : p
        }
    }, funcion);
}

function validar(){
    DOM.p_talla.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_talla.val(),2);
    }); 
    DOM.p_talla_sentado.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_talla_sentado.val(),2);
    }); 
    DOM.p_peso.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_peso.val(),2);
    }); 

    DOM.p_tricipital.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_tricipital.val(),2);
    }); 
    DOM.p_subescapular.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_subescapular.val(),2);
    }); 
    DOM.p_supraespinal.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_supraespinal.val(),2);
    }); 
    DOM.p_abdominal.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_abdominal.val(),2);
    }); 
    DOM.p_muslo_anterior.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_muslo_anterior.val(),2);
    }); 
    DOM.p_pierna_medial.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_pierna_medial.val(),2);
    }); 

    DOM.p_muneica.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_muneica.val(),2);
    }); 
    DOM.p_femur.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_femur.val(),2);
    }); 
    DOM.p_humero.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_humero.val(),2);
    }); 
    DOM.p_bileocrestal.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_bileocrestal.val(),2);
    }); 
    DOM.p_biacromial.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_biacromial.val(),2);
    }); 

    DOM.p_mesoesternal.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_mesoesternal.val(),2);
    }); 
    DOM.p_brazo.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_brazo.val(),2);
    }); 
    DOM.p_pierna.keypress(function (e) {
        return Validar.numeroDecimal(e,DOM.p_pierna.val(),2);
    }); 
}


function setDOM() {
    DOM.p_codigo_registro = $("#txtcodigo_registro"),
    DOM.p_documento = $("#strDocumento"),
    DOM.p_nombres = $("#strNombres"),
    DOM.p_edad = $("#strEdad"),
    DOM.p_sexo = $("#strSexo"),

    DOM.p_codigo_factor = $("#txtcodigo_factor"),

    DOM.p_talla = $("#strTalla"),
    DOM.p_talla_sentado = $("#strTallaSentado"),
    DOM.p_peso = $("#strPeso"),

    DOM.p_tricipital = $("#strTricipital"),
    DOM.p_subescapular = $("#strSubescapular"),
    DOM.p_supraespinal = $("#strSupraespinal"),
    DOM.p_abdominal = $("#strAbdominal"),
    DOM.p_muslo_anterior = $("#strMusloAnterior"),
    DOM.p_pierna_medial = $("#strPiernaMedial"),

    DOM.p_muneica = $("#strMuneica"),
    DOM.p_femur = $("#strFemur"),
    DOM.p_humero = $("#strHumero"),
    DOM.p_bileocrestal = $("#strBileocrestal"),
    DOM.p_biacromial = $("#strBiacromial"),

    DOM.p_mesoesternal = $("#strMesoesternal"),
    DOM.p_brazo = $("#strBrazo"),
    DOM.p_pierna = $("#strPierna"),

    DOM.btnGrabar01 = $("#btnGrabar01"),
    DOM.btnGrabar02 = $("#btnGrabar02"),
    DOM.btnGrabar03 = $("#btnGrabar03"),
    DOM.btnGrabar04 = $("#btnGrabar04"),

    DOM.btnReporte = $("#btnReporte");
    DOM.btnGrabar05 = $("#btnGrabar05");
}



function setEventos() { 
    validar();
    
    DOM.btnGrabar01.click(function(){
        if ( DOM.p_talla.val() === "" ) {
            alert("Debe ingresar un talla para evaluciación antropometrica");
            return 0;
        }

        if ( DOM.p_talla_sentado.val() === "" ) {
            alert("Debe ingresar un talla sentado para evaluciación antropometrica");
            return 0;
        }

        if ( DOM.p_peso.val() === "" ) {
            alert("Debe ingresar un peso para evaluciación antropometrica");
            return 0;
        }

        if ( DOM.p_codigo_factor.val() === null ) {
            alert("Debe seleccionar un factor actividad para evaluación antropometrica");
            return 0;
        }

        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    cargarEstudiante(Parametro.retornar()[0]);
                    alert(resultado.datos.msj);                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        };         
        new Ajxur.Api({
            modelo: "Medidas",
            metodo: "agregarDA",
            data_in: {
                p_codigo_registro : DOM.p_codigo_registro.val(),
                p_talla : DOM.p_talla.val(),
                p_talla_sentado : DOM.p_talla_sentado.val(),
                p_peso : DOM.p_peso.val(),
                p_factor_actividad : DOM.p_codigo_factor.val()
            }
        }, funcion);
    });   

    DOM.btnGrabar02.click(function(){
        if ( DOM.p_tricipital.val() === "" ) {
            alert("Debe ingresar el pliegue tricipital para evaluciación");
            return 0;
        }

        if ( DOM.p_subescapular.val() === "" ) {
            alert("Debe ingresar el pliegue subescapular para evaluciación");
            return 0;
        }

        if ( DOM.p_supraespinal.val() === "" ) {
            alert("Debe ingresar el pliegue supraespinal para evaluciación");
            return 0;
        }

        if ( DOM.p_abdominal.val() === "" ) {
            alert("Debe ingresar el pliegue abdominal para evaluciación");
            return 0;
        }

        if ( DOM.p_muslo_anterior.val() === "" ) {
            alert("Debe ingresar el pliegue muslo anterior para evaluciación");
            return 0;
        }

        if ( DOM.p_pierna_medial.val() === "" ) {
            alert("Debe ingresar el pliegue pierna medial para evaluciación");
            return 0;
        }
         
        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    cargarEstudiante(Parametro.retornar()[0]);
                    alert(resultado.datos.msj);                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        }; 

        new Ajxur.Api({
            modelo: "Medidas",
            metodo: "agregarP",
            data_in: {
                p_codigo_registro : DOM.p_codigo_registro.val(),
                p_tricipital : DOM.p_tricipital.val(),
                p_subescapular : DOM.p_subescapular.val(),
                p_supraespinal : DOM.p_supraespinal.val(),
                p_abdominal : DOM.p_abdominal.val(),
                p_muslo_anterior : DOM.p_muslo_anterior.val(),
                p_pierna_medial : DOM.p_pierna_medial.val(),
            }
        }, funcion);
    }); 
	
    DOM.btnGrabar03.click(function(){
        if ( DOM.p_muneica.val() === "" ) {
            alert("Debe ingresar el diametro de la muñeca para evaluciación");
            return 0;
        }

        if ( DOM.p_femur.val() === "" ) {
            alert("Debe ingresar el diametro del femur para evaluciación");
            return 0;
        }

        if ( DOM.p_humero.val() === "" ) {
            alert("Debe ingresar el diametro del humero para evaluciación");
            return 0;
        }

        if ( DOM.p_bileocrestal.val() === "" ) {
            alert("Debe ingresar el diametro del bileocrestal para evaluciación");
            return 0;
        }

        if ( DOM.p_biacromial.val() === "" ) {
            alert("Debe ingresar el diametro del biacromial para evaluciación");
            return 0;
        }

        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    cargarEstudiante(Parametro.retornar()[0]);
                    alert(resultado.datos.msj);                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        }; 

        new Ajxur.Api({
            modelo: "Medidas",
            metodo: "agregarD",
            data_in: {
                p_codigo_registro : DOM.p_codigo_registro.val(),
                p_muneica : DOM.p_muneica.val(),
                p_femur : DOM.p_femur.val(),
                p_humero : DOM.p_humero.val(),
                p_bileocrestal : DOM.p_bileocrestal.val(),
                p_biacromial : DOM.p_biacromial.val()
            }
        }, funcion);
    }); 

    DOM.btnGrabar04.click(function(){
        if ( DOM.p_mesoesternal.val() === "" ) {
            alert("Debe ingresar el perimetro mesoesternal para evaluciación");
            return 0;
        }

        if ( DOM.p_brazo.val() === "" ) {
            alert("Debe ingresar el perimetro brazo para evaluciación");
            return 0;
        }

        if ( DOM.p_pierna.val() === "" ) {
            alert("Debe ingresar el perimetro pierna para evaluciación");
            return 0;
        }


        var funcion = function (resultado) {
            if (resultado.estado === 200) {
                if (resultado.datos.rpt === true) {
                    cargarEstudiante(Parametro.retornar()[0]);
                    alert(resultado.datos.msj);                   
                }else{
                    alert(resultado.datos.msj.errorInfo[2]);         
                }
            }    
        }; 

        new Ajxur.Api({
            modelo: "Medidas",
            metodo: "agregarPE",
            data_in: {
                p_codigo_registro : DOM.p_codigo_registro.val(),
                p_mesoesternal : DOM.p_mesoesternal.val(),
                p_brazo : DOM.p_brazo.val(),
                p_pierna : DOM.p_pierna.val()
            }
        }, funcion);
    }); 

    DOM.btnGrabar05.click(function(){
        init();
    });

    
}

function cargarFactores(){
    var funcion = function (resultado) {        
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var html = '<option value="" disabled selected>Seleccionar factor actividad</option>';
                $.each(resultado.datos.msj, function (i, item) { 
                    html += '<option value="' + item.codigo_registro + '">'+ item.descripcion + '</option>';
                });
                DOM.p_codigo_factor.html(html).selectpicker('refresh');
             
            }else{
                alert(resultado.datos.msj.errorInfo[2]);
            }            
        }
    };

    new Ajxur.Api({
        modelo: "Factor",
        metodo: "llenarCB"
    }, funcion);
}

var P;
var IMG_SOMATOCARTA, IMG_CABECERA;
var arreglo1,arreglo2,arreglo3,arreglo4,arreglo5,arreglo6,arreglo7,arreglo8,arreglo9,arreglo10,arreglo11,arreglo12;
var documento, nombres,sexo,fecha_nacimiento,ts,timc,tie,tia,tctr,edad="",pt,tc,
total_desayuno,total_almuerzo,total_merienda,total_cena,peso_actual,peso_ideal,indice;

function init() {   
    var funcion = function (resultado) {
        if (resultado.estado === 200) {
            if (resultado.datos.rpt === true) {
                var datos = resultado.datos.msj;
                arreglo1 = [datos.talla+' cm.',datos.talla_sentado+' cm.',datos.peso+' kg.'];
                arreglo2 = [datos.tricipital+' mm.',datos.subescapular+' mm.',datos.supraespinal+' mm.',datos.abdominal+' mm.',datos.muslo_anterior+' mm.',datos.pierna_medial+' mm.'];
                arreglo3 = [datos.muneica+' cm.',datos.femur+' cm.',datos.humero+' cm.',datos.bileocrestal+' cm.',datos.biacromial+' cm.'];
                arreglo4 = [datos.mesoesternal+' cm.',datos.brazo+' cm.',datos.pierna+' cm.'];
                arreglo5 = [String(Math.round(datos.endomorfia)),String(Math.round(datos.mesomorfia)),String(Math.round(datos.ectomorfia))];
                /* IMC */
                var imc = parseFloat(datos.imc);
                if ( imc >= 40 ) {
                    timc = "Obesidad grado 3";
                }

                if ( imc >= 35 || imc<=39.9 ) {
                    timc = "Obesidad grado 2";
                }

                if ( imc >= 30 || imc<=34.9 ) {
                    timc = "Obesidad grado 1";
                }

                if ( imc >= 25 || imc<=29.9 ) {
                    timc = "Sobrepeso";
                }

                if ( imc >= 18.5 || imc<=24.9 ) {
                    timc = "Peso normal";
                }

                if ( imc < 18.5 ) {
                    timc = "Peso bajo";
                }

                /* IE */                
                var iem = parseFloat(datos.iem);
                if ( iem > 90 ) {
                    tie = "Extremidades Inferiores Largas";
                }

                if ( iem > 85 ) {
                    tie = "Extremidades Inferiores Medianas";
                }
                if ( iem <= 85 ) {
                    tie = "Extremidades Inferiores Cortas";
                }

                /*IA*/
                var iai = parseFloat(datos.iai);
                if ( iem > 75 ) {
                    tia = "Tronco Rectangular";
                }
                if ( iem > 70 ) {
                    tia = "Tronco Intermedio";
                }
                if ( iem <= 70 ) {
                    tia = "Tronco Trapezoidal";
                }

                var ictr = parseFloat(datos.ictr);
                if ( ictr > 56 ) {
                    tctr = "Tórax Ancho";
                }
                if ( ictr > 51 ) {
                    tctr = "Tórax Medio";
                }
                if ( ictr <= 51 ) {
                    tctr = "Tórax Estrecho";
                }


                arreglo6 = [timc,tie,tia,tctr];

                documento = datos.documento;
                nombres = datos.nombres;
                sexo = datos.sexo;
                fecha_nacimiento = datos.fecha_nacimiento;
                
                edad += datos.anio+(parseInt(datos.anio) == 1 ? " año con " : " años con ");
                edad += datos.mes+(parseInt(datos.mes) == 1 ? " mes con " : " meses con ");
                edad += datos.dia+(parseInt(datos.dia) == 1 ? " día " : " días ");

                //TIPO DE SOMOTOTIPO
                var EN = Math.round(datos.endomorfia);
                var ME = Math.round(datos.mesomorfia);
                var EC = Math.round(datos.ectomorfia);

                if ( (EN == 4) && (ME == 4) && (EC == 4) ) {
                    ts = "Central";
                }

                if ( (EN == 4) && (ME == 4) && (EC == 2) ) {
                    ts = "Mesomorfo Endomorfo";
                }

                if ( (EN == 4) && (ME == 3) && (EC == 2) ) {
                    ts = "Meso-Endomórfico";
                }
    
                if ( (EN == 4) && (ME == 2) && (EC == 4) ) {
                    ts = "Endomorfo Ectomorfo";
                }

                if ( (EN == 4) && (ME == 2) && (EC == 3) ) {
                    ts = "Ecto-Endomorfo";
                }

                if ( (EN == 4) && (ME == 2) && (EC == 2) ) {
                    ts = "Endomórfico Balanceado";
                }

                if ( (EN == 3) && (ME == 4) && (EC == 2) ) {
                    ts = "Endo-Mesomorfo";
                }

                if ( (EN == 3) && (ME == 2) && (EC == 4) ) {
                    ts = "Endo-Ectomorfo";
                }

                if ( (EN == 3) && (ME == 2) && (EC == 4) ) {
                    ts = "Mesomorfo Balaceado";
                }

                if ( (EN == 2) && (ME == 4) && (EC == 4) ) {
                    ts = "Mesomorfo Ectomorfo";
                }

                if ( (EN == 2) && (ME == 4) && (EC == 3) ) {
                    ts = "Ecto-Mesomorfo";
                }

                if ( (EN == 2) && (ME == 4) && (EC == 2) ) {
                    ts = "Mesomorfo Balaceado";
                }

                if ( (EN == 2) && (ME == 3) && (EC == 4) ) {
                    ts = "Meso-Ectomorfo";
                }

                if ( (EN == 2) && (ME == 2) && (EC == 4) ) {
                    ts = "Ectomorfo Balanceado";
                }

                if ( ts == undefined) {
                    ts = "NO TIENE TIPO DE SOMATIPO";
                }   

                pt = datos.proyeccion_talla;

                arreglo6 = [datos.fecha_registro_pt,datos.proyeccion_talla];            
                arreglo7 = [datos.carbohidratos+" gr.",datos.proteinas+" gr.",datos.grasas+" gr."]; 

                tc = datos.total_calorias;

                var carbohidratos = parseFloat(datos.carbohidratos).toFixed(2);
                var proteinas = parseFloat(datos.carbohidratos).toFixed(2);
                var grasas = parseFloat(datos.carbohidratos).toFixed(2);

                //DESAYUNO
                arreglo8 = [String(parseFloat(carbohidratos*0.2).toFixed(2))+" gr.",String(parseFloat(proteinas*0.2).toFixed(2))+" gr.",String(parseFloat(grasas*0.2).toFixed(2))+" gr."];
                //ALMUERZO  
                arreglo9 = [String(parseFloat(carbohidratos*0.35).toFixed(2))+" gr.",String(parseFloat(proteinas*0.35).toFixed(2))+" gr.",String(parseFloat(grasas*0.35).toFixed(2))+" gr."];
                //MERIENDA  
                arreglo10 = [String(parseFloat(carbohidratos*0.2).toFixed(2))+" gr.",String(parseFloat(proteinas*0.2).toFixed(2))+" gr.",String(parseFloat(grasas*0.2).toFixed(2))+" gr."];
                //CENA  
                arreglo11 = [String(parseFloat(carbohidratos*0.25).toFixed(2))+" gr.",String(parseFloat(proteinas*0.25).toFixed(2))+" gr.",String(parseFloat(grasas*0.25).toFixed(2))+" gr."];

                //DESAYUNO
                total_desayuno = (tc*0.2).toFixed(2);
                //ALMUERZO  
                total_almuerzo = (tc*0.35).toFixed(2);
                //MERIENDA  
                total_merienda = (tc*0.2).toFixed(2);
                //CENA  
                total_cena = (tc*0.25).toFixed(2);

                arreglo12 = [datos.porcentaje_grasa+' %',datos.indice_peso_grasa+' %',datos.masa_corporal_activa+' %'];

                peso_actual = datos.peso;
                peso_ideal = datos.peso_ideal;
                indice = datos.indicador;

                var chart = new CanvasJS.Chart("chartContainer", {
                    data: [
                        {        
                          type: "line",
                          color: "back",
                          markerSize: 1,
                          dataPoints: [
                              { x: -6, y: -6 },
                              /* rango a(-6,-6) && b(0,12)*/
                              { x: -6, y: -5 }, 
                              { x: -5.99, y: -4.5 }, 
                              { x: -5.96, y: -4 }, 
                              { x: -5.93, y: -3.5 }, 
                              { x: -5.89, y: -3 }, 
                              { x: -5.85, y: -2.5 }, 
                              { x: -5.79, y: -2 },
                              { x: -5.72, y: -1.5 },
                              { x: -5.65, y: -1 },
                              { x: -5.56, y: -0.5 },
                              { x: -5.47, y: 0 },
                              { x: -5.37, y: 0.5 },
                              { x: -5.25, y: 1 },
                              { x: -5.13, y: 1.5 },            
                              { x: -5, y: 2 },
                              { x: -4, y: 5 },
                              { x: -3, y: 7.23 },
                              { x: -2, y: 9.07 },
                              { x: -1, y: 10.64 },
                              /* rango a(-6,-6) && b(0,12)*/                      
                              { x: 0, y: 12 },
                              /* rango a(0,12) && b(6,-6)*/              
                              { x: 1, y: 10.64 },              
                              { x: 2, y: 9.07 },              
                              { x: 3, y: 7.23 },              
                              { x: 4, y: 5 },                        
                              { x: 5, y: 2 },              
                              { x: 5.13, y: 1.5 },
                              { x: 5.25, y: 1 },              
                              { x: 5.37, y: 0.5 },               
                              { x: 5.47, y: 0 },              
                              { x: 5.56, y: -0.5 },              
                              { x: 5.65, y: -1 },              
                              { x: 5.72, y: -1.5 },              
                              { x: 5.79, y: -2 },              
                              { x: 5.85, y: -2.5 },               
                              { x: 5.89, y: -3 },               
                              { x: 5.93, y: -3.5 },               
                              { x: 5.96, y: -4 },               
                              { x: 5.99, y: -4.5 },              
                              { x: 6, y: -5 },           
                              /* rango a(0,12) && b(6,-6)*/                                  
                              { x: 6, y: -6 },   
                              /*PUNTO DENTRO DE LOS RANGO    a=(6,-6) && b=(0,-8.5) */ 
                              { x: 5.50 , y: -6.46 },
                              { x: 5.00 , y: -6.86 },
                              { x: 4.50 , y: -7.20 },
                              { x: 4.00 , y: -7.49 },
                              { x: 3.50 , y: -7.74 },
                              { x: 3.00 , y: -7.95 },
                              { x: 2.50 , y: -8.12 },
                              { x: 2.00 , y: -8.26 },
                              { x: 1.50 , y: -8.37 },
                              { x: 1.00 , y: -8.44 },  
                              { x: 0.50 , y: -8.49 },
                              /*PUNTO DENTRO DE LOS RANGO    a=(6,-6) && b=(0,-8.5) */
                              { x: 0.00 , y: -8.5 },   
                              /*PUNTO DENTRO DE LOS RANGO    a=(0,-8.5) && b=(-6,-6) */           
                              { x: -0.50 , y: -8.49 },              
                              { x: -1.00 , y: -8.44 },
                              { x: -1.50 , y: -8.37 },
                              { x: -2.00 , y: -8.26 },
                              { x: -2.50 , y: -8.12 },
                              { x: -3.00 , y: -7.95 },
                              { x: -3.50 , y: -7.74 },
                              { x: -4.00 , y: -7.49 },
                              { x: -4.50 , y: -7.20 },
                              { x: -5.00 , y: -6.86 },              
                              { x: -5.50 , y: -6.46 },
                              /*PUNTO DENTRO DE LOS RANGO    a=(0,-8.5) && b=(-6,-6) */
                              { x: -6 , y: -6 }
                          ]
                      },
                      {        
                          type: "line",
                          color: "back",
                          markerSize: 1,
                          dataPoints: [
                              { x: -9, y: -9},
                              { x: 9, y: 9 } 
                          ]
                      },
                      {        
                          type: "line",  
                          color: "back",
                          markerSize: 1,
                          dataPoints: [
                              { x: 9, y: -9 },
                              { x: -9, y: 9 }
                          ]
                      },
                      {        
                          type: "line",  
                          color: "back",
                          markerSize: 1,
                          dataPoints: [
                              { x: 0, y: 12 },
                              { x: 0, y: -8.5 }
                          ]
                      },
                        
                        {        
                        type: "line",
                        color: "red", 
                        dataPoints: [{x : parseFloat(datos.valor_x) , y : parseFloat(datos.valor_y) }]
                        }
                    ]
                });
                chart.render();
                $("#chartContainer").show();
                var w = 500;
                var h = 400;

                var div = document.getElementById("chartContainer");
                var canvas = document.createElement('canvas');
                canvas.width = w*2;
                canvas.height = h*2;
                canvas.style.width = w + 'px';
                canvas.style.height = h + 'px';
                var context = canvas.getContext('2d');
                context.scale(2,2);

                html2canvas(div, { canvas: canvas }).then(function(canvas) {
                    toDataURL("../../images/ajax.jpg", function(_imgData){
                        IMG_CABECERA = _imgData; 
                        IMG_SOMATOCARTA = canvas.toDataURL("image/jpeg");
                        P = new PDF();
                    });
                });
                $("#chartContainer").hide();
            }else{
                Util.alertaB(resultado.datos);
            }
        }
    };
    new Ajxur.Api({
        modelo: "Medidas",
        metodo: "leerReporte",
        data_in : {
            p_codigo_registro : Parametro.retornar()[0]
        }
    },funcion);
}

var PDF = function(){
    /*210-297*/
    var ORIENTACION = "p",
        ALTURA_HOJA = 297,
        ANCHO_HOJA = 210, 
        ALTURA_MIN = 25,            
        ALTURA_MAX = ALTURA_HOJA - ALTURA_MIN,
        ALTURA_CABECERA = 7.5,
        ALTURA_PIE = ALTURA_HOJA - 10,
        MARGEN_IZQ = 30,
        MARGEN_DER = ANCHO_HOJA - 30,
        ANCHO_HOJA_REAL = ANCHO_HOJA - (2 * MARGEN_IZQ), 
        ALTO_HOJA_REAL = ALTURA_HOJA - (2 * ALTURA_MIN),
        DEFAULT_FONT_SIZE = 12,
        DEFAULT_FONT_TYPE = "normal";


    var alturaActual = ALTURA_MIN;
    var self = this;
    var pdf;

    function init () {
        pdf = new jsPDF(ORIENTACION,'mm','a4');
        //crearHoja();
        if (ORIENTACION == "l"){
            ALTURA_HOJA = 210;
            ANCHO_HOJA = 297;
            ALTURA_MIN = 20;
        }

        self.agregarTexto("Datos personales", 14, true);
        self.saltoPagina(13);   
        self.agregarTexto("DOCUMETO DE IDENTIDAD (DNI) : "+documento, 12, false);
        self.saltoPagina(10);
        self.agregarTexto("Nombres y apellidos : "+nombres, 12, false);
        self.saltoPagina(10);
        self.agregarTexto("Sexo : "+sexo, 12, false);
        self.saltoPagina(10);
        self.agregarTexto("Fecha de nacimiento : "+fecha_nacimiento, 12, false);
        self.saltoPagina(10);
        self.agregarTexto("Edad (años cumplidos) : "+edad, 12, false);
        self.saltoPagina(15);

        self.agregarTexto("Datos antropométricos", 14, true);       
        crearTabla({
                margenIzquierdo : 10,
                anchoTabla : 130,
                dataCabecera : [{item: "PESO", abrv: "PE."},{item: "TALLA", abrv: "TA."},{item: "TALLA SENTADO", abrv: "TAS."}],
                dataFilas: [arreglo1],
                alturaFila: 10
            });

        self.saltoPagina(15);

        self.agregarTexto("Pliegues cutaneos", 14, true);

        pdf.setFontSize(10);
        crearTabla({
                margenIzquierdo : 10,
                anchoTabla : 130,
                dataCabecera : [{item: "TRICIPITAL", abrv: "TRI."},
                                {item: "SUBESCAPULAR", abrv: "SE."},
                                {item: "SUPRAESPINAL", abrv: "SESP."},
                                {item: "ABDOMINAL", abrv: "ABD."},
                                {item: "MUSLO ANTERIOR", abrv: "MANT."},
                                {item: "PIERNA MEDIAL", abrv: "PI."}],
                dataFilas: [arreglo2],
                alturaFila: 10
            });
        pdf.setFontSize(DEFAULT_FONT_SIZE);
        self.saltoPagina(15);
        self.agregarTexto("Diametros", 14, true);

        /*FORMA CREAR UNA TABLA.*/
        pdf.setFontSize(10);
        crearTabla({
                margenIzquierdo : 10,
                anchoTabla : 130,
                dataCabecera : [{item: "BIESTILO MUÑECA", abrv: "B. MUÑECA"},
                                {item: "BILEOCRESTAL", abrv: "BILEO"},
                                {item: "FÉMUR", abrv: "FÉRMUN"},
                                {item: "HÚMERO", abrv: "HÚMERO"},
                                {item: "BIACROMIAL", abrv: "MANT."}],
                dataFilas: [arreglo3],
                alturaFila: 10
            });
        pdf.setFontSize(DEFAULT_FONT_SIZE);
        self.saltoPagina(15);

        self.agregarTexto("Perimetros", 14, true);
        /*FORMA CREAR UNA TABLA.*/
        pdf.setFontSize(10);
        crearTabla({
                margenIzquierdo : 10,
                anchoTabla : 130,
                dataCabecera : [{item: "MESOESTERNAL", abrv: "MESOESTERNAL"},
                                {item: "BRAZO", abrv: "BRAZO"},
                                {item: "PIERNA", abrv: "PIERNA"}],
                dataFilas: [arreglo4],
                alturaFila: 10
            });
        pdf.setFontSize(DEFAULT_FONT_SIZE);

        self.saltoPaginaFull();
        self.agregarTexto("Evaluación de somatotipo : ", 14, false);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Endomorfia", abrv: "Endo"},
                                {item: "Mesomorfia", abrv: "Meso"},
                                {item: "Ectomorfia", abrv: "Ecto"}],
                dataFilas: [arreglo5],
                alturaFila: 10
            });
        self.saltoPagina(15);
        self.agregarTexto("Somatocarta", 14, true);
        self.agregarImagen(IMG_SOMATOCARTA, ANCHO_HOJA_REAL, 150 - ALTURA_MIN);
        //TIPO DE SOMATOTIPO
        self.saltoPagina(15);
        self.agregarTexto("Tipo de somatotipo : "+ts, 12, false);
        self.saltoPagina(15);
        //Índice
        self.agregarTexto("Índices", 14, true);
        self.saltoPagina(10);   
        self.agregarTexto("Índice de masa corporal : "+timc, 12, false);
        self.saltoPagina(5);
        self.agregarTexto("Índice Esquélico o de Manouvrier : "+tie, 12, false);
        self.saltoPagina(5);
        self.agregarTexto("Indice Acromio - Iliaco : "+tia, 12, false);
        self.saltoPagina(5);
        self.agregarTexto("Circunferencia Torácica Relativa :"+tctr, 12, false);
        self.saltoPaginaFull();
        //Proyección de talla
        if ( pt != null ) {
            self.agregarTexto("Proyección de talla", 14, true);
            pdf.setFontSize(10);
            /*FORMA CREAR UNA TABLA.*/
            crearTabla({
                    margenIzquierdo : 5,
                    anchoTabla : 135,
                    dataCabecera : [{item: "Fecha registro", abrv: "Evaluado"},
                                    {item: "Talla Proyección", abrv: "T. Proyección"}],
                    dataFilas: [arreglo6],
                    alturaFila: 10
                });
            self.saltoPagina(15);
        }
        self.agregarTexto("Evaluación del estado nutricional", 14, true);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Carbohidratos", abrv: "Carbohidratos"},
                                {item: "Proteínas", abrv: "Proteínas"},
                                {item: "Grasas", abrv: "Grasas"}],
                dataFilas: [arreglo7],
                alturaFila: 10
            });
        self.saltoPagina(15);
        self.agregarTexto("R.C.T de "+nombres+" es de "+ tc +" calorías consumo diario.", 12, false);
        self.saltoPagina(15);
        self.agregarTexto("DESAYUNO", 12, false);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Carbohidratos", abrv: "Carbohidratos"},
                                {item: "Proteínas", abrv: "Proteínas"},
                                {item: "Grasas", abrv: "Grasas"}],
                dataFilas: [arreglo8],
                alturaFila: 10
            })
        self.saltoPagina(15);
        self.agregarTexto("ALMUERZO", 12, false);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Carbohidratos", abrv: "Carbohidratos"},
                                {item: "Proteínas", abrv: "Proteínas"},
                                {item: "Grasas", abrv: "Grasas"}],
                dataFilas: [arreglo9],
                alturaFila: 10
            })
        self.saltoPagina(15);
        self.agregarTexto("MERIENDA", 12, false);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Carbohidratos", abrv: "Carbohidratos"},
                                {item: "Proteínas", abrv: "Proteínas"},
                                {item: "Grasas", abrv: "Grasas"}],
                dataFilas: [arreglo10],
                alturaFila: 10
            })
        self.saltoPagina(15);
        self.agregarTexto("CENA", 12, false);
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "Carbohidratos", abrv: "Carbohidratos"},
                                {item: "Proteínas", abrv: "Proteínas"},
                                {item: "Grasas", abrv: "Grasas"}],
                dataFilas: [arreglo11],
                alturaFila: 10
            })
        self.saltoPaginaFull();

        self.agregarTexto("Verificación del Requerimiento Calórico Total", 14, true);
        self.saltoPagina(15);
        self.agregarTexto("RCT es de "+total_desayuno+" calorías en el desayuno.", 12, true);
        self.saltoPagina(10);
        self.agregarTexto("RCT es de "+total_almuerzo+" calorías en el almuerzo.", 12, true);
        self.saltoPagina(10);
        self.agregarTexto("RCT es de "+total_merienda+" calorías en la merienda.", 12, true);
        self.saltoPagina(10);
        self.agregarTexto("RCT es de "+total_cena+" calorías en la cena.", 12, true);
        self.saltoPagina(20);
        self.agregarTexto("Nota: El agua viene en la sopa frutas, jugos líquidos.", 12, true);
        self.saltoPagina(35);

        self.agregarTexto("Cantidad de Agua que debe ingerir el deportista ", 14, true);
        self.saltoPagina(15);       
        self.agregarTexto("En el desayuno se debe ingerir de agua aprox. "+mililitros(total_desayuno), 12, true);
        self.saltoPagina(10);
        self.agregarTexto("En el almuerzo se debe ingerir de agua aprox. "+mililitros(total_almuerzo), 12, true);
        self.saltoPagina(10);
        self.agregarTexto("En la merienda se debe ingerir de agua aprox. "+mililitros(total_merienda), 12, true);
        self.saltoPagina(10);
        self.agregarTexto("En la cena se debe ingerir de agua aprox. "+mililitros(total_cena), 12, true);
        self.saltoPagina(20);
        self.agregarTexto("Nota: cada gramo de glucógeno = 2.7 ml.", 12, true);
        self.saltoPagina(5);
        self.agregarTexto("El glucógeno se almacena con agua.", 12, true);
        self.saltoPagina(5);
        self.agregarTexto("El agua nos sirve para la recirculación y la temperatura corporal.", 12, true);
        self.saltoPaginaFull();

        self.agregarTexto("Peso ideal", 14, true);      
        pdf.setFontSize(10);
        /*FORMA CREAR UNA TABLA.*/
        crearTabla({
                margenIzquierdo : 5,
                anchoTabla : 135,
                dataCabecera : [{item: "% Grasa", abrv: "% Grasa"},
                                {item: "Índice Peso de Grasa", abrv: "Índice Peso de Grasa"},
                                {item: "Masa Corporal Activa", abrv: "MCA"}],
                dataFilas: [arreglo12],
                alturaFila: 10
            })
        self.saltoPagina(15);
        self.agregarTexto("Actualmente ud. tiene un peso de "+String(parseInt(peso_actual))+" kg.", 12, false); 
        self.saltoPagina(5);
        self.agregarTexto("Su peso ideal es de "+String(parseInt(peso_ideal))+" kg.", 12, false);
        self.saltoPagina(5);

        var baja = String(parseInt(parseFloat(peso_actual) - parseFloat(peso_ideal)));
        var subir = String(parseInt(parseFloat(peso_ideal) - parseFloat(peso_actual)));

        var texto_peso = indice == 2 ? "Ud. actualmente tiene un peso estable." : (indice === 1 ? "Ud. tiene que bajar "+baja+" kg." : "Ud. tiene que subir "+subir+" kg.");
        self.agregarTexto(texto_peso, 12, false);


        agregarEncabezadoPie();
        self.imprimirPDF(); 
    }

    function mililitros(texto){
        return (texto).length == 4 ? (texto).substring(0,1)+(parseInt((texto).substring(0,1)) === 1 ? ' litro ' : ' litros ')+(parseFloat((texto).substring(1,4)) === 0 ? '': 'con '+(texto).substring(1,4)+' ml.'):(parseFloat(texto) === 0 ? '': texto+' ml.');
    }

    function crearTextoCentro(texto, y){
        var textWidth = pdf.getStringUnitWidth(texto)*pdf.internal.getFontSize()/pdf.internal.scaleFactor;
        var textOffset = (pdf.internal.pageSize.width-textWidth) / 2;
        pdf.text(textOffset, y, texto);
    }
    
    this.crearHoja= function(){
        pdf.addPage();
    }

    function crearCabecera(texto) {
        if ( texto == "") {
            pdf.addImage(IMG_CABECERA, 'JPEG', MARGEN_IZQ-10, ALTURA_CABECERA - 5,15,15);   
            pdf.text(ANCHO_HOJA-35, ALTURA_CABECERA + 7.5, "Logo derecha");     
        }else{
            crearTextoCentro(texto,ALTURA_CABECERA);
        }
    }

    function crearPie(texto) {
        crearTextoCentro(texto,ALTURA_PIE);
    }

    function agregarEncabezadoPie () {
        var pageCount = pdf.internal.getNumberOfPages(); 
        for (var i = 0; i < pageCount; i++) {
            pdf.setPage(i); 
            crearPie('Página '+pdf.internal.getCurrentPageInfo().pageNumber + ' de ' + pageCount);
            crearCabecera("");
        };
    }

    function px2mm (px) {
        return parseFloat(px * 0.2645833333).toFixed(2);
    }

    function checkAltura(){
        if (alturaActual > ALTURA_MAX){
            pdf.addPage();
            alturaActual = ALTURA_MIN;
        }
    }

    function crearTabla (iD) {
        var i;

        if (!iD){
         console.error("Ingrese parámetros de TABLA.")
         return;
        }
         
        var numeroColumnas =  iD.dataCabecera.length,
            anchoCelda = parseFloat(iD.anchoTabla / numeroColumnas).toFixed(2),
            altoCelda = iD.alturaFila,
            margenIzquierdoTotal = MARGEN_IZQ + iD.margenIzquierdo,
            saltoTexto = 7;

        /*Creando cabecera*/
        pdf.setFontType("bold");
        for (i = 0; i < numeroColumnas; i++) {
            var textoCelda = iD.dataCabecera[i].item,
                X = margenIzquierdoTotal + (anchoCelda * i),
                textWidth, textOffset;

            pdf.setFillColor(115, 200, 222);            
            pdf.rect(X, alturaActual, anchoCelda, altoCelda, 'FD');
            pdf.setTextColor(255,255,255);

            textWidth = pdf.getStringUnitWidth(textoCelda)*pdf.internal.getFontSize()/pdf.internal.scaleFactor;

            if (textWidth > anchoCelda){
                textoCelda = iD.dataCabecera[i].abrv;
                textWidth = pdf.getStringUnitWidth(textoCelda)*pdf.internal.getFontSize()/pdf.internal.scaleFactor;
            }
            textOffset = (anchoCelda-textWidth) / 2;

            pdf.text(X + textOffset,alturaActual + saltoTexto, textoCelda);


        };

        /*Limpiando buffer*/
        pdf.setFillColor(255,255,255);
        pdf.setTextColor(0,0,0);
        pdf.setFontType(DEFAULT_FONT_TYPE);

        alturaActual += parseFloat(altoCelda);

        /*Datos de las Filas*/
        for (var j = 0; j < iD.dataFilas.length ; j++) {                
            for ( i = 0; i < numeroColumnas; i++) {
                var textoCelda = iD.dataFilas[j][i],
                    X = margenIzquierdoTotal + (anchoCelda * i),
                    textWidth, textOffset;

                pdf.rect(X, alturaActual, anchoCelda, altoCelda);
                textWidth = pdf.getStringUnitWidth(textoCelda)*pdf.internal.getFontSize()/pdf.internal.scaleFactor;
                textOffset = (anchoCelda-textWidth) / 2;

                pdf.text(X + textOffset,alturaActual + saltoTexto, textoCelda);
            };
            alturaActual += parseFloat(altoCelda);
        };      
    }


    this.saltoPagina = function(mm){
        alturaActual += parseFloat(mm);
    }

    this.saltoPaginaFull = function(num){
        if (!num){
            num = 1;
        }

        for (var i = 0; i < num; i++) {
            pdf.addPage();
        };

        alturaActual = ALTURA_MIN;
    }

    this.agregarImagen = function(imgData, wPixel, h){
        pdf.addImage(imgData, 'JPEG', MARGEN_IZQ, alturaActual, wPixel, h);
        alturaActual += parseFloat(h);
    }

    this.agregarTexto = function(texto, fontSize, esCentrado, fontType){
        checkAltura();

        pdf.setFontSize(fontSize);
        if (fontType){
            pdf.setFontType(fontType);
        }

        if (esCentrado){
            crearTextoCentro(texto, alturaActual);
        } else {
            pdf.text(MARGEN_IZQ, alturaActual, texto);
        }

        //alturaActual += pdf.inte;
        var dim = pdf.getTextDimensions(texto),
            H = dim.h;

        pdf.setFontSize(DEFAULT_FONT_SIZE);
        pdf.setFontType(DEFAULT_FONT_TYPE);

        alturaActual += parseFloat(px2mm(dim.h));
    }

    this.imprimirPDF = function(){
        var f = new Date();
        var fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
        pdf.save(nombres+"_"+fecha+".pdf");
    }

    this.getPdf = function(){
        return pdf;
    }

    return init();
}

function toDataURL(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    var reader = new FileReader();
    reader.onloadend = function() {
      callback(reader.result);
    }
    reader.readAsDataURL(xhr.response);
  };
  xhr.open('GET', url);
  xhr.responseType = 'blob';
  xhr.send();
}
