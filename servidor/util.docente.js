 Utils.obtenerPagina = function(pagHash){ //obtiene la pagina en base a su hash.
          switch (pagHash){
              case "sesion":
                return pSesion;             
              case "aulas":
                return pAula;
              case "ninos":
                return pNiño;
              case "registrar-datos":
                return pRegistrarDatos;
              default:
                return "error";
          }
};


