var Utils = {
    opTernario: function(obj, paramObj){
      //Si obj es nulo, devuelve, el valor 2° Parametro, sino, devuelve el obj
      return obj == null || obj == undefined ? paramObj : obj;
    },
    cargando: function(bol){
               if(bol){//true mostrar.
                   App.UIBlocker.removeClass("borrar");
                 }else{
                   App.UIBlocker.addClass("borrar");
                 }
        },
     cargando_: function(bol){
         if(bol){//true mostrar.
            app.UIBlocker.removeClass("borrar");
         }else{
           app.UIBlocker.addClass("borrar");
          }
        },
     mostrarError: function(texto,label){          
          label.html("<i class='icon-eye'></i>  "+texto);
          label.removeClass("off");
                setTimeout(function(){
                label.empty();
                label.addClass("off");
          },2000);
      },
      buscar : function (arreglo, nombrePropiedad, textoBuscado){                         
              var arrayRet = [];
                for (var i = 0, len = arreglo.length; i < len; i++) {
                    var cadena = arreglo[i][nombrePropiedad].toLowerCase();
                    var patron = textoBuscado.toLowerCase().split("").reduce(function(a,b){ return a+".*"+b; });
                    if ((new RegExp(patron)).test(cadena)){                      
                        arrayRet.push(arreglo[i]);
                    } 
                }       
                return arrayRet;
       },
       obtenerFecha: function(){
           var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");            
            var f=new Date();
            return diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
       },
       soloNumeros: function (evento) {
          var tecla = (evento.which) ? evento.which : evento.keyCode;
          if ((tecla >= 48 && tecla <= 57)) {
              return true;
          }
          return false;
      },  
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
      },
      soloLetras: function (evento, espacio=null) {
          var tecla = (evento.which) ? evento.which : evento.keyCode;
          if ( espacio != null ) {
              if ((tecla >= 65 && tecla <= 90) || (tecla >= 97 && tecla <= 122) || (tecla==241) || (tecla==209) ) {
                  return true;
              }    
          }else{
              if ((tecla >= 65 && tecla <= 90) || (tecla >= 97 && tecla <= 122) || (tecla==241) || (tecla==209) || (tecla==32) ) {
                  return true;
              } 
          }
          return false;
      }
};

var Arr = {
            conseguir :  function(array, propiedadNombre, valorPropiedad) {
            //var prop = "id";
            for (var i = 0, len = array.length; i < len; i++) {        
                if (array[i][propiedadNombre] == valorPropiedad){
                    return array[i];
                }
            }            
            return -1;
            },
            conseguirTodos :  function(array, propiedadNombre, valorPropiedad) {
            //var prop = "id";
            var arrayRet = [];
            for (var i = 0, len = array.length; i < len; i++) {        
                if (array[i][propiedadNombre] == valorPropiedad){
                   arrayRet.push(array[i]);
                }
            }            
            return arrayRet;
            },              
            remover :  function(array, obj, propiedadNombre) {
            //var prop = "id";
            var t_array = $.grep( array, function( n ) {
                        return n[propiedadNombre] !== obj[propiedadNombre];                 
                        //return n > 0;
                  }); 
            return t_array;
            },              
            eliminar :  function(array, objParams) {
            //var prop = "id";
            var propiedadNombre = Object.keys(objParams)[0],
                    valor = objParams[propiedadNombre];            
                var t_array = $.grep( array, function( n ) {
                        return n[propiedadNombre] !== valor;                 
                        //return n > 0;
                  }); 
            return t_array;
            },
            diferencia: function(array1,array2,propiedadNombre){
               var self = this;
               for (var i = 0, lenI = array2.length; i < lenI; i++) {     
                   for (var j = 0, lenJ = array1.length; j < lenJ; j++) {                        
                        if (array2[i][propiedadNombre] === array1[j][propiedadNombre]){
                           array1 = self.remover(array1,array1[j],propiedadNombre);
                           break;     
                        }
                    }
                }     
                return array1;
            },
            union : function(array1,array2,propiedadNombre){
               var ret = array1, bol;
               for (var i = 0, lenI = array2.length; i < lenI; i++) {     
                   bol = true;
                   for (var j = 0, lenJ = array1.length; j < lenJ; j++) {        
                        if (array2[i][propiedadNombre] === array1[j][propiedadNombre]){
                            //tiene el mismo ID.
                           bol = false;                           
                           break;     
                        }
                    }
                   if (bol){
                       ret.push(array2[i]);
                   }                                         
                }  
                return ret; 
            },
            interseccion : function(array1,array2,propiedadNombre){
               var self = this, ret  = [], bol;
               for (var i = 0, lenI = array1.length; i < lenI; i++) {     
                   bol = false;
                   for (var j = 0, lenJ = array2.length; j < lenJ; j++) {        
                        if (array1[i][propiedadNombre] === array2[j][propiedadNombre]){
                            //tiene el mismo ID.
                           array2 = self.remover(array2,array2[j],propiedadNombre);
                           bol = true;                           
                           break;     
                        }
                    }
                   if (bol){
                       ret.push(array1[i]);
                   }                                         
                }  
                return ret; 
            },
            exclusion: function(array1, array2, propiedadNombre){ //obj => {prop_name}
                //Para este "for" usaremos "grep", grep te devuelve un array con objetos que no 
                //cumplen una regla booleana.        
               var self = this;
               return $.grep(array1, function(i)
                {         
                    var o = self.objEnArray(i,array2,propiedadNombre);
                    return !o;
                });
            },
            objEnArray : function (obj,array,propiedadNombre){
                 for (var i = 0, len = array.length; i < len; i++) {    
                        if (array[i][propiedadNombre] === obj[propiedadNombre]){
                           return true;
                        }
                 }
                 return false;
            }
};
 