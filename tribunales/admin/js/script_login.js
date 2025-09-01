
function login(){

    var parametros = {
      "accion"   : "validar_credenciales",
      "nombre"   : $("#rut").val(),
      "clave"    : $("#clave").val(),
      "correo"    : $("#correo").val()
    };
    console.log(parametros);
  
        $.ajax({              
          data:  parametros,
          url:   'accion.php',
          type:  'post',
          success:  function (response) {
            console.log(response);
            if (response == "faltan_datos") {
              $("#respuesta").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Credenciales no válidas</strong></div>");
              //desaparecer();
            };
            if (response == "datos_correctos") {
             
                location.assign("index.html");
              
            };
          }
        })
}; 