const  ramdon = Math.floor(Math.random() * (999999999 - 1)) + 1 ;

$(".btn_validar").click(function(){

     let correo = $("#correo_cliente").val();
     let user = $("#user_cliente").val();
     validarEmail(correo);
     validarCorreo(correo, user);
     // enviarCodigo(ramdon, correo);

});


$(".user_cliente").change(function(){

let validar_usuario = $(this).val();

var data = new FormData();

data.append("validar_usuario",validar_usuario); 

     $.ajax({

          url:"ajax/recuperar-contrasena-frm1.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",  

          success: function(response){
          	
          if(response[0][0] == "0" ){

               $(".btn_validar").prop("disabled", "true");

               $(this).val("");

               Swal.fire(
                    "Usuario No Registrado!",
                    "Valide la información e intente nuevamente.",
                    "warning"
               ).then((result) => {

               }); 

          }else{

               $(".btn_validar").removeAttr("disabled");
               validarCorreoVacio(validar_usuario);

          }

     },

           error: function(response, err){ console.log('my message ' + err + " " + response);}
     })


});


function AgregarCodigoValidacion(usuario, validacion){

let respuesta;

var data = new FormData();

data.append("codigo_validacion",ramdon); 
data.append("usuario_validacion",usuario);

     $.ajax({

          url:"ajax/recuperar-contrasena-frm1.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",  

          success: function(response){
            console.log("response", response);
         
                if(response == "OK"){




const numero="506"+ validacion +"";
const mensage="UPEE: Estimado(a) Cliente. El usuario "+ usuario +" acaba solicitar el cambio de la contraseña para el acceso a la plataforma. El Código Temporal es: "+ ramdon +". Para mas informacion: bla bla bla";
const apikey="Tz1jcETA32rnM3MKH8KRRY9OVjaAMoVj";


const url = "https://notificame.claro.cr/api/http/send_to_contact?msisdn="+ numero +"&message="+ mensage +"&api_key="+ apikey +"";


   const resp =   fetch(url, {
            method: 'POST',
            mode: 'no-cors'
            });

                    Swal.fire(
      "Codigo enviado exitosamente!",
      "El código fue enviado al número ingresado.",
      "success"
    ).then((result) => {
   window.location = "index.php?route=recuperar-contrasena-frm2&user="+ usuario +"";
    }); 


                }else{

                 Swal.fire(
      "Error al enviar!",
      "Error al ingresar los datos, intente nuevamente.",
      "error"
    ).then((result) => {

   // window.location = "recuperar-contrasena-frm2";
    });

                }


               },

           error: function(response, err){ console.log('my message ' + err + " " + response);}
     })

}


function validarCorreoVacio(user){

     var data = new FormData();
     
     data.append("UsuarioValid",user); 
     
          $.ajax({
     
               url:"ajax/recuperar-contrasena-frm1.ajax.php",
               method: "POST",
               data: data,
               cache: false,
               contentType: false,
               processData: false,
               async: false,
               dataType: "json",  
     
               success: function(response){
               
                    console.log(response);
     
               if(response[0][0] == "empty" || response[0][0] == ""){
     
                    Swal.fire({
                         title: 'Correo No registrado, desea ingresar uno?',
                         input: 'text',
                         inputAttributes: {
                           autocapitalize: 'off'
                         },
                         showCancelButton: true,
                         confirmButtonText: 'Agregar Correo',
                         showLoaderOnConfirm: true,
                         preConfirm: (correoUser) => {
                           
                             console.log("correo ingresado: "+ correoUser);
                             IngresarCorreo(user, correoUser);
                         }
                       })
     
     
               }else{
     
     
               }
         
          },
     
                error: function(response, err){ console.log('my message ' + err + " " + response);}
          })
     
     }


function validarCorreo(correo, user){

     var data = new FormData();

     data.append("correoValid",correo); 
     data.append("user",user); 

     $.ajax({

          url:"ajax/recuperar-contrasena-frm1.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){
          
               console.log(response);
         

          if(response[0][0] == "1" || response[0][0] == 1){

               enviarCodigo(ramdon, correo, user);

          }else{

               Swal.fire(
                    "Correo no Valido",
                    "Correo no corresponde al usuario ingresado.",
                    "error"
               ).then((result) => {
               //   window.location = "index.php?route=recuperar-contrasena-frm2&user="+ usuario +"";
               }); 
               
            return false;
          }

     },

          error: function(response, err){ console.log('my message ' + err + " " + response);}
     })

}

function IngresarCorreo(usuario, correo){

     var data = new FormData();

     data.append("addusuario",usuario); 
     data.append("addCorreo",correo); 
     
          $.ajax({
     
               url:"ajax/recuperar-contrasena-frm1.ajax.php",
               method: "POST",
               data: data,
               cache: false,
               contentType: false,
               processData: false,
               async: false,
               // dataType: "json",  
     
               success: function(response){
               
                    console.log(response);
          if(response == "ok"){

               Swal.fire(
                    "Datos ingresados",
                    "Correo registrado Exitosamente.",
                    "success"
               ).then((result) => {
               //   window.location = "index.php?route=recuperar-contrasena-frm2&user="+ usuario +"";
               }); 

          }else{

               Swal.fire(
                    "Error al enviar!",
                    "Error al ingresar los datos, intente nuevamente.",
                    "error"
               ).then((result) => {
          
               // window.location = "recuperar-contrasena-frm2";
               });

          }
      
          },
               error: function(response, err){ console.log('my message ' + err + " " + response);}
          })

}


function enviarCodigo(codigo, correo, user){

     var data = new FormData();

     data.append("Sendcodigo",codigo); 
     data.append("SendCorreo",correo);
     data.append("SendUser",user); 

     
          $.ajax({
     
               url:"ajax/recuperar-contrasena-frm1.ajax.php",
               method: "POST",
               data: data,
               cache: false,
               contentType: false,
               processData: false,
               async: false,
               // dataType: "json",  
     
               success: function(response){
               
                    console.log(response);

                    // return false;
          
                    if(response == "ok"){

                    Swal.fire(
                         "Datos ingresados",
                         "Correo registrado Exitosamente.",
                         "success"
                    ).then((result) => {
                      window.location = "index.php?route=recuperar-contrasena-frm2&user="+ user +"";
                    }); 

               }else{

                    Swal.fire(
                         "Error al enviar!",
                         "Error al ingresar los datos, intente nuevamente.",
                         "error"
                    ).then((result) => {
               
                    window.location = "recuperar-contrasena-frm1";
                    });

          }
      
          },
               error: function(response, err){ console.log('my message ' + err + " " + response);}
          })
}

function validarEmail(valor) {
     if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
           
     } else {
     
          Swal.fire(
               "Correo invalido!",
               "Datos del correo no son validos.",
               "error"
          ).then((result) => {
     
          // window.location = "recuperar-contrasena-frm2";
          });

          return false;
     }
   }

// var validacion = $(".tel_cliente").val();

// var data = new FormData();

// data.append("validacion",validacion); 

//      $.ajax({

//           url:"ajax/recuperar-contrasena-frm1.ajax.php",
//           method: "POST",
//           data: data,
//           cache: false,
//           contentType: false,
//           processData: false,
//           dataType: "json",  

//           success: function(response){
          
         
// if(response == "false" || response == false){

// Swal.fire(
//       "Error de validación!",
//       "El número de teléfono ingresado no se encuentra registrado, contacte con el proveedor.",
//       "error"
//     ).then((result) => {

//   // window.location = "clientes";
//     }); 

// $(".tel_cliente").val("");

// }else{

// const usuario = $(".user_cliente").val()
// AgregarCodigoValidacion(usuario, validacion);


// }


 
//                },

//            error: function(response, err){ console.log('my message ' + err + " " + response);}
//      })