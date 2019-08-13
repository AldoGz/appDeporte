/* Clase Página maestra */
var clsPagina  = function(data){
  var self = this;
  this.hash = data.hash;  
  this.title = data.title;
  this.auth = data.auth;
  this.ui = data.ui;
  this.data = {};
  this.tpl8 = {};

  this.setData = function(_data){
    self.data = _data;
  }

  this.getUI = function(){
    return $.get("templates/"+this.ui);
  };

  this.getRender = function(){
    return "";
  }

  this.postRender = function(){
    return;
  };

  this.start = function (){   
    self.setDOM();
    self.setEventos();
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
};