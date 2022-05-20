
$(".facebook").click(function(){


  sessionStorage.clear();

  var cookie = document.cookie.split(";");
  
  for (var i = 0; i < cookie.length; i++) {
  
      var chip = cookie[i],
          entry = chip.split("="),
          name = entry[0];
  
      document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
  }


      FB.login(function(response){
    //  console.log(response);
          validarUsuario();
  
      }, {scope: 'public_profile, email'})
  
  })
  

  
  function validarUsuario(){
  
      FB.getLoginStatus(function(response){
  
          statusChangeCallback(response);
  
      })
  
  }
  
  function statusChangeCallback(response){
  
    // console.log(response.status);

      if(response.status === 'connected'){
  
          testApi();
  
      }else{
  
          Swal.fire({
              type: "error",
            title: "¡ERROR!",
            text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
            showConfirmButton: true,
          confirmButtonText: "Cerrar"
      
          }).then(function(result){
  
              if(result.value){   

              
                    history.back();

              } 
            });
  
      }
  
  }
  
  function testApi(){
  
      FB.api('/me?fields=id,name,email,picture',function(response){
  
      // console.log(response);
      // return;
          if(response.email == null){
  
        Swal.fire({
                  type: "error",
                title: "¡ERROR!",
                text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",         
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
          
              }).then(function(result){
  
                  if(result.value){  
                        history.back();
                  } 
                });
  
                return;
   
          }else{
  
        var email = response.email;
              var nombre = response.name;
              var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";
  
  
       let exist =  validarExistencia(email);
  
      // console.log(exist);

       if(exist == 1){
  
        window.location = "home";
  
       }else{
  


        Swal.fire({
          type: "warning",
        title: "Usuario NO registrado!",
        text: "¡El usuario no se encuentra registrado, por favor registrarse e iniciar nuevamente.!",
        showConfirmButton: true,
      confirmButtonText: "Cerrar"
  
      }).then(function(result){

        window.location = "login";
        });

  
      //   var data = new FormData();
  
      //   data.append("correo", email);
      //   data.append("nombre", nombre);
      //   data.append("foto", foto);
      //   data.append("idperfil", response.id);
  
  
      //   $.ajax({
      //   url:"ajax/users.ajax.php",
      //   method: "POST",
      //   data: data,
      //   cache: false,
      //   contentType: false,
      //   processData: false,
      //   async: false,
      //   // dataType: "json", 
      //         success:function(respuesta){
      // console.log(respuesta);
     
      // if(respuesta.trim() == "ok"){
  
      //               window.location = "home";
  
      //           }else{
  
                  FB.getLoginStatus(function(response){	
  
                    if(response.status === 'connected'){     
  
                        FB.logout(function(response){
  
                          deleteCookie("fblo_543681613364049");
  
                          // setTimeout(function(){
  
                          //   window.location = "login";
  
                          //    },500)
  
                        });
  
                        function deleteCookie(name){
  
                                  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                             }
  
                    }
                  })
  
                // }
  
          //     },
      
          //     error: function(response, err){ console.log('my message ' + err + " " + response);}
              
          // })
  
       }
  
    }
  
      })
  
  }
   
  
  function validarExistencia(email){
    
    var existencia;
    var data = new FormData();
  
    data.append("correoIngreso",email);
    
        $.ajax({
        url:"ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json", 
        
                  success:function(respuesta){
                    // console.log(respuesta);
                                 
                    // let datos = JSON.parse(respuesta);

            existencia = respuesta["existencia"];  
            sessionStorage.setItem("rol", respuesta["rol"]);
            sessionStorage.setItem("id", respuesta["id"]);
            sessionStorage.setItem("tabla_tiendas", respuesta["tabla_tiendas"]);
            sessionStorage.setItem("tabla_dth", respuesta["tabla_dth"]);
            // existencia = datos["existencia"];  
            // sessionStorage.setItem("rol", datos["rol"]);
            // sessionStorage.setItem("id", datos["id"]);
            // sessionStorage.setItem("tabla_tiendas", datos["tabla_tiendas"]);
            // sessionStorage.setItem("tabla_dth", datos["tabla_dth"]);


            // console.log(datos);
            // console.log(respuesta[0]);
          },
  
          error: function(response, err){ console.log('my message ' + err + " " + response);}
          
      })
  
  return existencia;
  
  }



  /*=============================================
  =      REGISTRO SESION CON FACEBOOK           =
  =============================================*/

  $(".facebookRegistro").click(function(){


    FB.login(function(response){
  //  console.log(response);
   validarUsuarioRegistro();

    }, {scope: 'public_profile, email'})

})

function validarUsuarioRegistro(){
  
  FB.getLoginStatus(function(response){

    statusChangeCallbackRegistro(response);

  })

}

function statusChangeCallbackRegistro(response){

  if(response.status === 'connected'){

    testApiRegistro();

  }else{

      Swal.fire({
          type: "error",
        title: "¡ERROR!",
        text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
        showConfirmButton: true,
      confirmButtonText: "Cerrar"
  
      }).then(function(result){

          if(result.value){   
                history.back();
          } 
        });

  }


  function testApiRegistro(){
  
    FB.api('/me?fields=id,name,email,picture',function(response){

    // console.log(response);
    // return;
        if(response.email == null){

      Swal.fire({
                type: "error",
              title: "¡ERROR!",
              text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",         
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        
            }).then(function(result){

                if(result.value){  
                      history.back();
                } 
              });

              return;
 
        }else{

      var email = response.email;
            var nombre = response.name;
            var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";
 

     let exist =  validarExistenciaRegistro(email);

    // console.log(exist);

     if(exist == 1){

      // window.location = "home";


        Swal.fire({
          type: "warning",
        title: "Usuario YA se encuentra registrado!",
        text: "¡El usuario ya se encuentra registrado, por favor iniciar sesion!",
        showConfirmButton: true,
      confirmButtonText: "Cerrar"

      }).then(function(result){

          
      });



     }else{


      var data = new FormData();

      data.append("correo", email);
      data.append("nombre", nombre);
      data.append("foto", foto);
      data.append("idperfil", response.id);


      $.ajax({
      url:"ajax/users.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json", 
            success:function(respuesta){
    // console.log(respuesta);
    // let datos = JSON.parse(respuesta);

    if(respuesta["existencia"] == 1){


      existencia = datos["existencia"];  
      sessionStorage.setItem("rol", respuesta["rol"]);
      sessionStorage.setItem("id", respuesta["id"]);
      sessionStorage.setItem("tabla_tiendas", respuesta["tabla_tiendas"]);
      sessionStorage.setItem("tabla_dth", respuesta["tabla_dth"]);

                  window.location = "home";

              }else{

                FB.getLoginStatus(function(response){	

                  if(response.status === 'connected'){     

                      FB.logout(function(response){

                        deleteCookie("fblo_543681613364049");

                        setTimeout(function(){

                          window.location = "login";

                           },500)

                      });

                      function deleteCookie(name){

                                document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                           }

                  }
                })

              }

            },
    
            error: function(response, err){ console.log('my message ' + err + " " + response);}
            
        })

     }

  }

    })

}



}



function validarExistenciaRegistro(email){
    
  var existencia;
  var data = new FormData();

  data.append("correoRegistro",email);
  
      $.ajax({
      url:"ajax/users.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json", 
      
                success:function(respuesta){
                  // console.log(respuesta);
                              
          existencia = respuesta[0];  

     
          // console.log(respuesta[0]);
        },

        error: function(response, err){ console.log('my message ' + err + " " + response);}
        
    })

return existencia;

}