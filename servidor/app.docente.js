window.addEventListener('load', function () {   
    new FastClick(document.body);
    app.init();
}, false);

var app = {  
  init : function(){
    Ajxur.URL = "../../proyecto/servidor/ws/";
    Sesion.crear();
     var paginadorVariables = {
      paginas : {"aulas":pAula, "estudiantes":pEstudiante, "registrar-datos":pRegistrarDatos, "registrar-medidas":pRegistrarMedidas, "sesion":pSesion,"error":pError},
      homeAuth :  "#aulas", //cambio
      homeNoAuth : "#sesion"
    }
    this.paginador = new Paginador(paginadorVariables);
  },
  preload: function(){
    this.partialsCache = {};
    this.auth = Utils.opTernario($.jStorage.get(Config.global.cacheKey, false));
    this.homeNoAuth = "#sesion";
    this.home = "#aulas"; //cambio
    this.botonesAuth = false;
  },
  cerrarSesion: function(){
    Sesion.eliminar();
    window.location.hash="#sesion";
    window.location.replace(window.location);                     
  }
};

/*Clase Sesion, si es que es == false, signficia que no hay sesioón iniciada.*/
