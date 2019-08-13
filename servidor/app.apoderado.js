window.addEventListener('load', function () {   
    new FastClick(document.body);
    app.init();
}, false);

var app = {  
  init : function(){
    Ajxur.URL = "../../proyecto/servidor/ws/";
    Sesion.crear();
    var paginadorVariables = {
      paginas : {"principal":pPrincipal,"perfil":pPerfil,"diagnostico":pDiagnostico,"dieta":pDieta,"sesion":pSesion,"error":pError},
      homeAuth :  "#principal",
      homeNoAuth : "#sesion",
      opcionesFooter : [
          {link: "#perfil", icono:"user",nombre:"Perfil Hijo"},
          {link: "#diagnostico", icono:"medkit",nombre:"Diagnóstico"},
          {link: "#dieta", icono:"food",nombre:"Dietas"}
      ]
    };
    this.data = {};
    this.data.pasar = false;
    this.data.indexHijo = -1;
    this.data.hijoSeleccionado = '';
    this.paginador = new Paginador(paginadorVariables);    
    this.eventosFooter();
  },
  obtenerFecha: function(){
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");            
    var f=new Date();
    return diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
  },
  cerrarSesion: function(){
    Sesion.eliminar();
    window.location.hash="#sesion";
    window.location.replace(window.location);                     
  },
  eventosFooter : function(){
    var self = this;
    this.paginador.DOM.$btnMenu.on("click","div.btn-group",function(e){
          var href = e.currentTarget.dataset.href;      
          if (self.data.pasar == true){
            self.paginador.ir(href);
          }else{
            alert("Debe seleccionar un hijo");
          }
    });
  },
  dataset : function(parametro,index,hijo){
    var self = this;
    self.data.pasar = parametro;
    self.data.indexHijo = index;
    self.data.hijoSeleccionado = hijo;
  },
  abrirAutoAyuda : function(){
    return $("#modal-ayuda").addClass("on");
  },
  abrirModal2 : function(){
    return $("#myModal2").addClass("on");
  },
  abrirModal3 : function(){
    return $("#myModal3").addClass("on");
  },
  abrirModal4 : function(){
    return $("#myModal4").addClass("on");
  },
  abrirModal5 : function(){
    return $("#myModal5").addClass("on");
  }
};

/*Clase Sesion, si es que es == false, signficia que no hay sesioón iniciada.*/
