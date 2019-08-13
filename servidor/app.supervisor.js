window.addEventListener('load', function () {   
    new FastClick(document.body);
    app.init();
}, false);


var app = {  
  init : function(){
    this.preload();
    this.setDOM();
    this.eventos();

    app.usuario =  Utils.opTernario($.jStorage.get(Config.global.cacheKey),app.usuario);

    this.navegar();
    if(!location.hash) {
      location.hash = this.auth ? this.home : this.homeNoAuth;
    }

    window.onhashchange = app.navegar;
  },
  preload: function(){
    this.partialsCache = {};
    var cache = Utils.opTernario($.jStorage.get(Config.global.cacheKey+"auth"), false);
    this.auth = cache;
    this.homeNoAuth = "#sesion";
    this.home = "#principal";
    this.botonesAuth = false;
  },
  setDOM : function(){
    this.UIBlocker = $("#ui-blocker");
    this.DOM = {
      container: $("#container"),
      pNombrePagina : $("#p-nombre-pagina"),
      pSesion : $("#p-sesion"),
      pagina : $("#pagina"),
      menuBtnFooter : $("#menu-btn"),
      copyFooter : $("#copy"),
      menuOpc : $("#menu-opc"),
      header : $(".header"),
      footer : $(".footer")
    };    

    this.DOM.ulMenuOpc = this.DOM.menuOpc.find("ul").eq(0);
  },
  eventos: function(){
    var self  = this;

    this.DOM.pSesion.click(function(e){   
      self.DOM.menuOpc.addClass("on");
    }); 
      
    this.DOM.ulMenuOpc.on("click","li",function(e){
          var id = e.currentTarget.id;
          switch(id){
              case "mnuPerfil":
                 // window.location.hash = "#mi-perfil";
                  break;
              case "mnuAyuda":
                 // window.location.hash = "#ayuda";
                  break;
              case "mnuSesion":
                  if (!confirm("¿Desea cerrar sesión, "+app.usuario.nombre.toUpperCase() +"?")){
                    return;
                  }                   
                   $.jStorage.set(Config.global.cacheKey,null);
                   self.usuario = undefined;
                   window.location.hash="#sesion";
                   window.location.replace(window.location);                     
                  break;
              case "mnuCancelar":                  
                  break;
          }
          self.DOM.menuOpc.removeClass("on");
      });
      
      this.DOM.menuBtnFooter.on("click",".btn-group",function(e){      
          window.location.hash = e.currentTarget.dataset.href;
      });

      this.crearFooter();
  },
  crearFooter : function (){
      var dataMnuBtn  = [
          {link: "#cronogramas", icono:"user",nombre:"Cronogramas"},
          {link: "#buscar", icono:"search",nombre:"Buscar Niño"},          
      ];
      var fComp = Handlebars.compile(this.DOM.menuBtnFooter.find("script").html());
      this.footerT = fComp(dataMnuBtn);
  }
};

app.mostrarBotonesAuth = function (bol){
      //bol = true; muestra, false : esocnde.   
      if (bol == app.botonesAuth) return;
      if (bol){
        this.DOM.pSesion.removeClass("esconder");
        this.DOM.copyFooter.addClass("borrar");
        this.DOM.menuBtnFooter.html(this.footerT);
      } else{
        this.DOM.pSesion.addClass("esconder");
        this.DOM.copyFooter.removeClass("borrar");
        this.DOM.menuBtnFooter.empty();
      }
      
      app.botonesAuth = bol;
  };

app.getContent = function(fragmentId, callback){
    if(this.partialsCache[fragmentId]) {
      callback(this.partialsCache[fragmentId]);
    } else {
      $.get("templates/"+fragmentId+ ".html", function (content) {
        app.partialsCache[fragmentId] = content;
        callback(content);
      });
    }
};

app.navegar = function(){

  //var fragmentId =  location.hash.substr(1);
  // Set the "content" div innerHTML based on the fragment identifier.
  var pagina = Utils.gestionarHash(location.hash);
  var objPag = Utils.obtenerPagina(pagina.pag);
  if (objPag == "error"){
    pagina.pag = "error";
  }

  app.getContent(pagina.pag, function (content){
    //devuelve el html
    //acá carga los datos necesarios para la vida util del apg y solo cuando termina de cargarlos
    //dibuja la página, caso contrario no pasa nada.
    //si la carga toma más de 1 seg que muestre la bolita
    var cargando = true;    
    var hasXHR = false;

    //solo error
    if (pagina.pag == "error"){
       app.DOM.pNombrePagina.html("No encontrada");
       app.DOM.pagina.html(content);
       return;
    }

    objPag.init(pagina.params);
    app.mostrarBotonesAuth(objPag.hash != "#sesion");

    if (objPag.content == null){
      objPag.setContent(content);          
    }

    //Cuando no se  requiere data se cambio a cargando == false
    if (objPag.initData == undefined || objPag.initData == null){
      cargando = false;    
    } else {
      hasXHR = true;
      objPag.initData
      .done(function (r){
        cargando = false;        
        Utils.cargando_(cargando); 
        if (r.state == 200){
          objPag.setData(r.data);
          objPag.render();                    
        }       
      })
      .fail(function(e){
        console.log(e.responseText);
      });
    } 

    if (objPag.localData != null && objPag.localData != undefined){
      objPag.setData(objPag.localData);            
    }

    setTimeout(function(){
      if (cargando){
        Utils.cargando_(true);
      } 
    },1000);

    if (!hasXHR){
      objPag.render(); 
    }
    //app.DOM.pagina.html(content);
  });
};

//Paginas
var pagina  = function(data){
  var self = this;
  this.hash = data.hash;  
  this.title = data.title;
  this.auth = data.auth;
  this.data = null;
  //this.initData = data.initData(); 
  //this.localData = data.localData; 
  this.setData = function(_data){
    self.data = _data;
  }

  this.setContent = function(content){
    self.tmpl8 = $(content).find(".tmpl8").eq(0).html();
    self.content = Handlebars.compile(content);
  };

  this.render = function (){   
    console.log("Renderizada Pág: "+ this.title);
    app.DOM.pNombrePagina.html(this.title);
    app.DOM.pagina.html(self.content(self.data));
    console.log(self.data);
    self.setDOM();
    self.setEventos();

  } 

};

