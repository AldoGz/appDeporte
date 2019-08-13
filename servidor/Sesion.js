var Sesion = {   
   verificar: function(){
     return Utils.opTernario($.jStorage.get(Config.global.cacheKey), false);
   },
   crear : function(usuarioSesion){
     var objSesion = this.verificar(), obj;
      if (objSesion == false){
         obj = usuarioSesion;
      } else {
         obj = objSesion;
      }    
     $.jStorage.set(Config.global.cacheKey, obj);
   },
   obtener: function(){
     return $.jStorage.get(Config.global.cacheKey);
   },
   eliminar : function(){
     this.obj = false;
     return $.jStorage.deleteKey(Config.global.cacheKey);
   }
};


