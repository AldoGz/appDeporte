var Ajxur = {
   // var self = this;
   URL : "../../../servidor/ws" ,
    $Ld : $(".loader"),
    Loader : {  
        numAPIs: 0,     
        c  : 0, // contador de peticiones activas.        
        timer : 1300,
        esMostrado :function(){
            return !(Ajxur.$Ld.hasClass("off"));
        },
        quitar : function(){
           Ajxur.$Ld.addClass("off"); 
        },
        mostrar : function(){
           Ajxur.$Ld.removeClass("off"); 
        }
    },
    Api : function (params, callbackFunction, callbackFunctionError){    
            var self = this, data_frm;
            this.tracer = false;
            this.loader = false;
            this.needParseJSON = 0; 
            this.url = Ajxur.URL;

            if (params.data_files){ 
               data_frm  = new FormData();
               data_frm.append("modelo",params.modelo);
               data_frm.append("metodo",params.metodo);
               if (params.formulario){
                 data_frm.append("formulario",params.formulario);
               }
               if (params.data_in){
                 data_frm.append("data_in",params.data_in);
               }
               if (params.data_out){
                 data_frm.append("data_out",params.data_out);
               }

               if (params.data_files && params.data_files != undefined){
                $.each(params.data_files, function(key,value){
                  if (value)
                    data_frm.append(key,value);   
                })
               }
               
               this.ajax = $.ajax({                
                url: self.url,
                cache: false,
                contentType: false,
                processData: false,
                data: data_frm,
                type: "get"
              });
            } else{
              this.ajax = $.ajax({
                url: self.url,
                data: params,
                type: "get"
              });
            }

            Ajxur.Loader.c++;
            this.id =  ++Ajxur.Loader.numAPIs;

            if(self.tracer) console.log("INICIO PETICIÓN. ID:",self.id); 
        
            if (typeof callbackFunction != "function"){
              if (callbackFunction == "deferred"){
                return this.ajax;
              }
            }

            this.ajax
            .done( function(r){
                self.successCallback(r);
            })
            .fail( function(e){
                self.failCallback(e);
            });
               
            setTimeout(function(){
              if(self.tracer) {
                console.log("PETICIONES ACTIVAS ", Ajxur.Loader.c);
                console.log("Verificador de DELAY: Estado de ID:",self.id); 
                }
                if (self.ajax.readyState != 4){
                  if(self.tracer) console.log("DATA aún no ha llegado.:");
                  if (self.loader) Ajxur.Loader.mostrar();
                  return;
                }
              if(self.tracer) console.log("DATA ya había llegado. ");
            },Ajxur.Loader.timer);
            
            this.back = function(){
                if (self.tracer) console.log("DATA llegó. ID: ", self.id);
                Ajxur.Loader.c--;
                if (self.tracer) console.log("PETICIONES ACTIVAS ", Ajxur.Loader.c);
                if (Ajxur.Loader.esMostrado()){
                    if (self.tracer) console.log("CARGANDO... Está en pantalla.");
                    if (Ajxur.Loader.c <= 0){
                        if (self.tracer) console.log("No hay peticiones.");
                        if (self.loader) Ajxur.Loader.quitar();
                        return;
                    }    
                    return;
                }      
                if (self.tracer)  console.log("CARGANDO... Está fuera de pantalla");  
            };


            this.successCallback = function(success){
                self.back();
                if (  self.needParseJSON  == 1){
                  success = JSON.parse(success);    
                }
                callbackFunction(success);    
            }

            this.failCallback = function(error){
                if (self.loader) Ajxur.Loader.quitar();

                if (self.needParseJSON == 1){
                    error = JSON.parse(error);            
                }

                if (typeof callbackFunctionError != "function"){
                    callbackFunctionError(error.responseText);
                } else {                                      
                    var datosJSON = JSON.parse(error.responseText);
                    console.error(datosJSON.mensaje);
                    alert(datosJSON.mensaje);                    
                    //swal("Error", datosJSON.mensaje, "error");    
                }   
            }
        }
};

var Funciones = {
    soloDecimal: function(evento, cadena,mostrar){
        var tecla = (evento.which) ? evento.which : evento.keyCode;
        var key = cadena.length;
        var posicion = cadena.indexOf('.');
        var contador = 0;
        var numero = cadena.split(".");
        var resultado1 = numero[0];
        var suma = resultado1.length+mostrar; 

        while (posicion != -1) { 
            contador++;             
            posicion = cadena.indexOf('.', posicion + 1);

        }
        

        if ( (tecla>=48 && tecla<=57) || (tecla==46) ) {    
            if ( key == 0 &&  tecla == 46 ) { // SOLO PERMITE ENTRE 0 AL 9
                return false;
            }
            
            if (contador != 0 && tecla == 46) { //NO SE REPITA EL PUNTO                
                return false;
            }

            if ( cadena == '0') { // EL SIGUIENTE ES PUNTO   
                if ( tecla>=48 && tecla<=57 ) {
                    return false;
                }
                return true;                
            }      
            
            if (!(key <= suma)) {
                return false;
            }
            return true;            
        }
        return false;
    }
};
