

var Paginador = function(vars){
  var self = this;
  this.init = function(vars){
    self.setVars(vars);
    self.setDOM();
    self.setEventos();
    self.navegar();
    /*self.gestionarHash();*/
  };

  this.setVars = function(vars){
    self.DOM = {};
    self.tpl8 = {};
    self.botonesAuth = false;
    self.pgs = vars.paginas;
    self.homeAuth = vars.homeAuth ? vars.homeAuth : "#sesion";
    self.homeNoAuth = vars.homeNoAuth ? vars.homeNoAuth : "#principal";
    self.opcionesFooter = vars.opcionesFooter ? vars.opcionesFooter : [];
    self.prevHash = null;  
  }

  this.setDOM = function(){
    self.DOM.$scroller = $(".scroller");
    self.DOM.$pagina = $("#pagina");
    self.DOM.$nombrePagina = $("#p-nombre-pagina");
    self.DOM.$menuOpc = $("#menu-opc");
    self.DOM.$ulMenuOpc = $("#menu-opc").find("ul");
    self.DOM.$ulMenuOpc2 = $("#modal-ayuda").find("ul");

    self.DOM.$pSesion = $("#p-sesion");
    self.DOM.$copyFooter = $("#copy");
    self.DOM.$header = $(".header");
    self.DOM.$footer = $(".footer");
    self.DOM.$uiBlocker = $("#ui-blocker");
    self.DOM.$btnMenu = $("#btn-menu");
    if (self.DOM.$btnMenu.length > 0) {
      self.crearFooter();    
    }
    self.DOM.$cerrarAyuda = $("#close-ayuda");
    self.DOM.$cerrarSH = $("#close-sh");
    self.DOM.$cerrarPH = $("#close-ph");
    self.DOM.$cerrarDG = $("#close-dg");
    self.DOM.$cerrarDI = $("#close-di");
  };

  this.setEventos = function(){
    $(window).on('hashchange', function() {
      self.navegar();
    });

    self.DOM.$pSesion.click(function(e){   
      self.DOM.$menuOpc.addClass("on");
    }); 

    self.DOM.$cerrarAyuda.click(function(e){
        $("#modal-ayuda").removeClass("on");
    });
    self.DOM.$cerrarSH.click(function(e){
        $("#myModal2").removeClass("on");
    });

    self.DOM.$cerrarPH.click(function(e){
        $("#myModal3").removeClass("on");
    });
    self.DOM.$cerrarDG.click(function(e){
        $("#myModal4").removeClass("on");
    });
    self.DOM.$cerrarDI.click(function(e){
        $("#myModal5").removeClass("on");
    });
      
    self.DOM.$ulMenuOpc.on("click","li",function(e){
        var id = e.currentTarget.id;
        switch(id){
            case "mnuAyuda":
                app.abrirAutoAyuda();
                break;
            case "mnuSesion":
                if (!confirm("¿Desea cerrar sesión?")){
                  return;
                }                   
                app.cerrarSesion();                                     
                break;
            case "mnuCancelar":                  
                break;
        }
        self.DOM.$menuOpc.removeClass("on");
    });

    self.DOM.$ulMenuOpc2.on("click","li", function(e){
        var id = e.currentTarget.id;
        switch(id){
            case "mnu-sh":
                app.abrirModal2();
                break;
            case "mnu-ph":
                app.abrirModal3();
                break;
            case "mnu-dg":
                app.abrirModal4();
                break;
            case "mnu-di":
                app.abrirModal5();
                break;
        }        
    });
/*
    if (self.DOM.$btnMenu.length > 0) {
      self.eventosFooter();
    }*/
  };

  this.mostrarBotonesAuth = function (bol){
      //bol = true; muestra, false : esconde. 
      if (this.DOM.$btnMenu.length > 0){
          this.mostrarFooter(bol);
      }

      if (bol == self.botonesAuth) return;
      if (bol){
        this.DOM.$pSesion.removeClass("esconder");
        this.DOM.$copyFooter.addClass("borrar");
      } else{
        this.DOM.$pSesion.addClass("esconder");
        this.DOM.$copyFooter.removeClass("borrar");
      }

      
      self.botonesAuth = bol;
  };

  this.crearFooter = function(){
    var tpl8 = Handlebars.compile(self.DOM.$btnMenu.find("script").html());
    self.DOM.$btnMenu.html(tpl8(self.opcionesFooter));
  }

  this.mostrarFooter = function(opcion){
    /*Si es verdadero, mostrar las opciones y si es falso retornar a solo el empty.*/
    if (opcion){
      this.DOM.$copyFooter.hide();      
      this.DOM.$btnMenu.show();
    } else{
      this.DOM.$copyFooter.show();      
      this.DOM.$btnMenu.hide();
    }
  };


  this.eventosFooter = function(){
    self.DOM.$btnMenu.on("click","div.btn-group",function(e){
          var href = e.currentTarget.dataset.href;
          self.ir(href);
    });
  };

  this.filtrarHash = function(hashRaw){
        /*Filtra el hash, para saber en que página estamos.
        Se busca la pagina (antes del "?")
        Se busca los parametros.*/
        var pagHash = [], pag = "", params = [];

        if (hashRaw.charAt(0) != "#"){
          return {
            hash: "error",
            params: params
          };
        }

        pagHash = hashRaw.split("?");
        pag = pagHash[0].substr(1),
        params = [];

        if (pagHash.length > 1){
          params = pagHash[1].split("_");          
        }
        
        return {
          hash: pag,
          params: params
        };
  };

  this.ir = function(hash,opcion){     
    self.prevHash = window.location.hash;  
    window.location.href = hash;
    if (opcion && opcion == true){
      window.location.replace(window.location);                                
    }
  };

  this.atras = function(){
    window.history.back();
  };

  this.navegar = function(){
    var pag = self.filtrarHash(location.hash), 
      objPg = self.pgs[pag.hash];
      if (!objPg){
        alert("Página no existe: "+pag.hash);
        this.ir("#error");
        return;
      }

    if (objPg.auth == true){
      if (Sesion.obj == false){ /*No existe sesion.*/
        self.ir(self.homeAuth);
        return;
      }
    };

    self.toggleLoader(true);
    
    objPg.setContentData(function(data){
      self.mostrarBotonesAuth(pag.hash != "sesion");
      self.renderPagina(objPg);
      self.toggleLoader(false);
    },pag.params);
  };

  this.setContentData = function(data, parametros){
    var self = this;
    $.when(
      self.getUI()      
      ).then(function(ui){
        self.data.objUI = ui[0];
        callback(self.data);
      });
    };

  this.renderPagina = function(objPg){
    console.log("Renderizada Pág: "+ objPg.title);
    self.DOM.$scroller.addClass("righto");
    self.DOM.$nombrePagina.html(objPg.title);
    self.DOM.$pagina.html(objPg.getRender());
    objPg.start();
    objPg.postRender();

    setTimeout(function(){
      self.DOM.$scroller.removeClass("righto");
    },250);
  };

  this.toggleLoader = function(opcion){
    if (opcion){
      if (opcion == true){
        self.DOM.$uiBlocker.removeClass("borrar");        
      }else{
        self.DOM.$uiBlocker.addClass("borrar");
      }
    } else{
      if (self.DOM.$uiBlocker.hasClass("borrar")){
        self.DOM.$uiBlocker.removeClass("borrar");        
      } else{
        self.DOM.$uiBlocker.addClass("borrar");
      }
    }
  };

  this.init(vars)
  return this;
};
