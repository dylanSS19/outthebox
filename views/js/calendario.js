/*=============================================
=             Previsualizar fotos            =
=============================================*/

$(".fotos_eventos").change(function(){

    var image = this.files[0];
    //console.log("image", image);
  
  /*=============================================
  =FILTER FORMAT PICTURE ONLY PNG - JPG        =
  =============================================*/
  
  if(image["type"] != "image/jpeg" && image["type"] != "image/png"){
  
    $(".fotos_eventos").val("");
  
    swal({
  
          type: "error",
          text: "La imagen debe estar en formato JPG o PNG",
          title: "¡Error al subir la imagen!",
          confirmButtonText: "Cerrar"
  
        }); 
  
  } else if(image["size"] > 4000000){
  
    $(".fotos_eventos").val("");
  
    swal({
  
          type: "error",
          text: "La imagen no debe pesar más de 4MB",
          title: "¡Error al subir la imagen!",
          confirmButtonText: "Cerrar"
  
        }); 
  } else {
  
    var ImageData = new FileReader;
  
    ImageData.readAsDataURL(image);
  
    $(ImageData).on("load", function(event){
   
      var ImageRoute = event.target.result;
  
      $("#fotos_eventos_vista").attr("src",ImageRoute);

  
    })
  
  }
  
});

$(".agregarFoto").click(function(){

  $(this).attr('disabled', "true");

let idEvento = $('#tituloEvento').attr('idevento');
let contador = $('#tituloEvento').attr('cont');
let imagen = $('.fotos_eventos');
imagen = imagen[0].files[0];
contador = Number(contador) + 1;
// console.log(idEvento);
// console.log(contador);
// console.log(imagen);

var data = new FormData();

     data.append("idEvento",idEvento);
     data.append("contador",contador);
     data.append("fotoEvento", imagen);

     $.ajax({

          url:"ajax/calendario.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          success: function(response){
            console.log("response", response);

              if(response.trim() == "ok"){
                console.log("response", 'entre bien');
                $('.agregarFoto').removeAttr('disabled');
                $("#fotos_eventos_vista").attr('src','views/img/users/default/anonymous.png');
                $("#fotos_eventos").val("");
                CargarCarrusel(idEvento);
              }else{
                console.log("response", 'entre mal');
                Swal.fire(
                  "Aviso!",
                  "Error al ingresar la foto, intente nuevamente.",
                  "error"
                ).then((result) => {
  
              window.location = "calendar";
                }) 


              }
                    

               },
           error: function(response, err){ console.log('my message ' + err + " " + response);}
     })

     $('#tituloEvento').attr('cont', contador);
});



function CargarCarrusel(idEvento){


  // console.log(idEvento);
  var data = new FormData();

  data.append("eventID",idEvento);

  $.ajax({
 
    url:"ajax/calendario.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",  
    success: function(response){

      // console.log("response", response);
      $(".carrucel").empty();
      if(response == ""){


      }else{

        for(let i = 0; i < response.length; i++){

          if(i == 0){
          
            $(".carrucel").append(
              '<div class="carousel-item active">'+
                '<img class="d-block w-100" src="https://backup.midigitalsat.com'+ response[i]['ruta'] +'" width="400px" height="400px">'+
              '</div>'
            );
          
          
          }else{
          
            $(".carrucel").append(
              '<div class="carousel-item">'+
                '<img class="d-block w-100" src="https://backup.midigitalsat.com'+ response[i]['ruta'] +'" width="400px" height="400px">'+
              '</div>'
            );
          
          }
          
          
          
            } 
                 $(".controlPasarela").append(
                 '<a class="carousel-control-prev" href="#carouselExampleControls"  role="button" data-slide="prev">'+
                 '<span class="carousel-control-prev-icon" style="background-color: #000000;" aria-hidden="true"></span>'+
                 '<span class="sr-only">Previous</span>'+
               '</a>'+
               '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">'+
                 '<span class="carousel-control-next-icon" style="background-color: #000000;" aria-hidden="true"></span>'+
                 '<span class="sr-only">Next</span>'+
               '</a>');



      }



    },
    error: function(response, err){ console.log('my message ' + err + " " + response);}
})


}



$(".facebook2").click(function(){

	FB.login(function(response){
console.log(response);
		validarUsuario();

	}, {scope: 'public_profile, email'})

})


function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);

	})

}

function statusChangeCallback(response){

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

    console.log(response);
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

     if(exist == 1){

window.location('home');


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
      // dataType: "json", 
            success:function(respuesta){
    
              if(respuesta == "ok"){

                window.location('home');

              }else{

                FB.getLoginStatus(function(response){	

                  if(response.status === 'connected'){     

                      FB.logout(function(response){

                        deleteCookie("fblo_2180677115313399");

                        setTimeout(function(){

                             window.location="login";

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

return;
			var email = response.email;
			var nombre = response.name;
			var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";

			var datos = new FormData();
			datos.append("email", email);
			datos.append("nombre",nombre);
			datos.append("foto",foto);

			$.ajax({

				url:urlPrincipal+"ajax/usuarios.ajax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					
					if(respuesta == "ok"){

						window.location = "calendar";

					}else{

            Swal.fire({
						type: "error",
				          title: "¡ERROR!",
				          text: "¡El correo electrónico "+email+" ya está registrado con un método diferente a Facebook!",				          
				         showConfirmButton: true,
						confirmButtonText: "Cerrar"
					
						}).then(function(result){

							if(result.value){    

								 FB.getLoginStatus(function(response){	

								 	 if(response.status === 'connected'){     

								 	 		FB.logout(function(response){

								 	 			deleteCookie("fblo_2180677115313399");

								 	 			setTimeout(function(){

							   		 	 			window.location="calendar";

							   		 	 		},500)

								 	 		});

								 	 		function deleteCookie(name){

					           		 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
				           		 	 	}

								 	 }

								 })

							}							

						})

					}

				}

			})

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

          existencia = respuesta[0];  
          // console.log(respuesta[0]);
        },

        error: function(response, err){ console.log('my message ' + err + " " + response);}
        
    })

return existencia;

}

// document.getElementById("btnAddEvento").addEventListener("click", function(event){

//   event.preventDefault();

// })
 

$(".comentariosEvento").on("keydown", function (e) {

  // e.preventDefault();
  if (e.keyCode === 13) {  
 
  let comentarios;
  let nombre;
  let id_evento;
  comentarios = e.target.value;
  nombre = $('option:selected', '#empresaheader').text();
  id_evento = $('#tituloEvento').attr('idevento');
  

  agregarComentario(comentarios, id_evento, nombre);


    }


});


function agregarComentario(comentarios, idevento, nombre){
  
  var data = new FormData();

  data.append("nombre",nombre);
  data.append("comentario",comentarios);
  data.append("evenid",idevento);
    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",  
      success: function(response){
        console.log(response);


      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })

  cargarComentarios(idevento);
}

function cargarComentarios(idEvento){

  var fecha = new Date()
  fecha = moment(fecha).format('YYYY-MM-DD')

  var data = new FormData();
  $(".cajaComentarios").empty();
  data.append("idE",idEvento);
    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){
        console.log(response);
        
        if(response == ""){


        }else{

          let fecha_comentario;
          let fecha_nueva;
          for(let i = 0; i < response.length; i++){

            fecha_comentario = moment(response[i].fecha_comentario).format('YYYY-MM-DD');

          if(fecha_comentario == fecha){

            fecha_nueva = moment(response[i].fecha_comentario).format('hh:mm:ss A');
            

          }else{

            fecha_nueva = moment(response[i].fecha_comentario).format('YYYY-MM-DD');
            
          }


            $(".cajaComentarios").append(

                '<div class="card-comment">'+						
									'<img class="img-circle img-sm" src="views/img/users/default/anonymous.png" alt="Imagen de usuario">'+
									'<div class="comment-text">'+
									'<span class="username">'+ response[i].usuario +
                  '<span class="text-muted float-right">'+ fecha_nueva +
                  '</span> '+
                  '<p class="text-muted" style="font-size:18px;">'+ response[i].comentario +'.</p>' +
									'</div>'+					 
								'</div>'
							
            );

          }

        }

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })

 let  nombre = $('option:selected', '#empresaheader').text();
 $('.userEvent').empty();
$('.userEvent').append(nombre);
$(".comentariosEvento").val("");
cargarReacciones(idEvento);
}

// $(".btnreaccion").click(function(){

// let id_evento = $('#tituloEvento').attr('idevento');
// let reaccion = $(".cantreaccion").attr('likes');

//   var data = new FormData();
//   data.append("addevent",id_evento);
//   data.append("addReaccion",reaccion);
//     $.ajax({

//       url:"ajax/calendario.ajax.php",
//       method: "POST",
//       data: data,
//       cache: false,
//       contentType: false,
//       processData: false,
//       async: false,
//       dataType: "json",  
//       success: function(response){

//         // console.log(response);


//       },

//       error: function(response, err){ console.log('my message ' + err + " " + response);}
      
//   })

// });



function cargarReacciones(idEvento){

  $(".cantreaccion").empty();

  var data = new FormData();
  data.append("evento",idEvento);
    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){


if(response.length == 1){

  $(".cantreaccion").append('0 comentarios');
  $(".cantreaccion").attr('likes', response[0].reacciones);
  $(".cantreaccion").attr('comentarios', '0');

}else{

  $(".cantreaccion").append(''+ response[1].reacciones +' comentarios');
  $(".cantreaccion").attr('likes', response[0].reacciones);
  $(".cantreaccion").attr('comentarios', response[1].reacciones);

}



      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })



}


function cargarDatosEvento(idEvento){



  var data = new FormData();
  data.append("IDEvento",idEvento);
    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){

        console.log(response);

        $("#comentarioEvento").val(response[0].detalle_evento);
        $('#direccionEvento').val( response[0].Ubicacion);
        $('#limiteEvento').val(response[0].limite_invitados);
        $('#latubicacion').val(response[0].lat);
        $('#longubicacion').val(response[0].lon);
  $('.fechaCalendario').val(moment(response[0].inicio).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(response[0].fin).format('YYYY-MM-DD hh:mm:ss A'));
  $('.fechaCalendario').attr('fechaReal', moment(response[0].inicio).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(response[0].fin).format('YYYY-MM-DD hh:mm:ss A'));
  $('.fechaCalendario').attr('condicion', response[0].allday);
  
        if(response[0].tipo == "Privado"){
          console.log(response[0].tipo);
        // $("#comentarioEvento").val(response[0].detalle_evento);
        $('#radioPrivado').iCheck('check');
        // remove 'checked' state
        $('#radioPublico').iCheck('uncheck');


        }else{

          $('#radioPublico').iCheck('check');
          // remove 'checked' state
          $('#radioPrivado').iCheck('uncheck');

        }

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })

 

}

$(".btnAddEvento").click(function(){

  let fecha = $(".fechaCalendario").attr("fechaReal");
  fecha = fecha.split("/");
  let nombreEvento = $("#tituloEvento").val();
  let id_evento = $("#tituloEvento").attr('idevento');
  let fechainicio =  moment(fecha[0].trim()).format('YYYY-MM-DD HH:mm:ss');
  let fecha_fin =  moment(fecha[1].trim()).format('YYYY-MM-DD HH:mm:ss');
  let detalle_evento = $("#comentarioEvento").val();
  let tipo_evento = document.querySelector('#radioPublico').checked;
  let tipo ;
  let condicion = $(".fechaCalendario").attr("condicion");
  let ubicacion = $("#direccionEvento").val();
  let limite = $("#limiteEvento").val();
  let latitud = $("#latubicacion").val();
  let longitud = $("#longubicacion").val();

if(nombreEvento == "" || ubicacion == "" || limite == "" || latitud == "" || longitud == ""){

  Swal.fire(
    "Aviso!",
    "Favor llenar todos los datos, intente nuevamente.",
    "error"
  ).then((result) => {

    
// window.location = "calendar";
  }) 

return false;
}


  if(tipo_evento){

    tipo = "Publico";

  }else{

    tipo = "Privado";

  }


let horaFin = moment(fecha[0].trim()).format('HH:mm:ss');

if(horaFin == "23:59:59"){

  condicion = "true";

}else{

  condicion = "false";


}



  console.log(condicion);
  console.log(moment(fecha[1].trim()).format('HH:mm:ss'));
  console.log(condicion);
  console.log(fechainicio);
  console.log(fecha_fin);


  var data = new FormData();
  data.append("idEV",id_evento);
  data.append("nombreEV",nombreEvento);
  data.append("detalle",detalle_evento);
  data.append("fecha_inicio",fechainicio);
  data.append("fecha_fin",fecha_fin);
  data.append("tipo",tipo);
  data.append("allday",condicion);
  data.append("ubicacion",ubicacion);
  data.append("limite",limite);
  data.append("lat",latitud);
  data.append("lon",longitud);
    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",  
      success: function(response){

if(response == "ok"){

  Swal.fire(
    "Exito!",
    "Datos ingresados correctamente.",
    "success"
  ).then((result) => {

    
window.location = "calendar";
  }) 

}else{

  Swal.fire(
    "Aviso",
    "Error al ingresar los datos, intente nuevamente.",
    "error"
  ).then((result) => {

    
// window.location = "reporte-sistema-facturacion";
  }) 

}

        


        console.log(response);

        // $("#comentarioEvento").val(response[0].detalle_evento);

     

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })


});


$(".EnviarCorreo").click(function(){

  let idEvento = $("#tituloEvento").attr('idevento');
  let user = '184';

  var data = new FormData();

  data.append("eventid",idEvento);
  data.append("userid",user);

    $.ajax({

      url:"ajax/calendario.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",  
      success: function(response){

    console.log(response);

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })


});



// var idevento =  $('#SubirFotos').val();
// var ruta = "juego.js";
//   // DropzoneJS Demo Code Start
//   Dropzone.autoDiscover = false;
//   // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
//   var previewNode = document.querySelector("#template");
//   previewNode.id = "";
//   var previewTemplate = previewNode.parentNode.innerHTML;
//   previewNode.parentNode.removeChild(previewNode);

//   var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
//     url: "ajax/calendario.ajax.php?id_evento="+ idevento +"&ruta="+ ruta, // Set the url
//     thumbnailWidth: 80,
//     thumbnailHeight: 80,
//     parallelUploads: 20,
//     previewTemplate: previewTemplate,
//     autoQueue: false, // Make sure the files aren't queued until manually added
//     previewsContainer: "#previews", // Define the container to display the previews
//     clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
//   });


// // var myDropzone = new Dropzone("#SubirFotos");

//   myDropzone.on("addedfile", function(file) {
//     // Hookup the start button
//     if(file["type"] != "image/jpeg" && file["type"] != "image/png"){

//           Swal.fire(
//             "error",
//             "La imagen debe estar en formato JPG o PNG",
//             "warning"
//         ); 
//         file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
//           return false;

//     }else if(file["size"] > 4000000){

//         Swal.fire(
//             "error",
//             "La imagen no debe pesar más de 4MB",
//             "warning"
//         ); 
//         file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
//           return false;

//     }else{
//         file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };

//     }

//   });

//   // Update the total progress bar
//   myDropzone.on("totaluploadprogress", function(progress) {
//     document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
//   });

//   myDropzone.on("sending", function(file) {
//     // Show the total progress bar when upload starts
//     document.querySelector("#total-progress").style.opacity = "1";
//     // And disable the start button
//     file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
//   });

//   // Hide the total progress bar when nothing's uploading anymore
//   myDropzone.on("queuecomplete", function(progress) {
//     document.querySelector("#total-progress").style.opacity = "0";
//   });

//   // Setup the buttons for all transfers
//   // The "add files" button doesn't need to be setup because the config
//   // `clickable` has already been specified.
//   document.querySelector("#actions .start").onclick = function() {
//     myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
//   };
//   document.querySelector("#actions .cancel").onclick = function() {
//     myDropzone.removeAllFiles(true);
//   };


let direccion = window.location.href;
if(direccion.includes("calendar")){

  $(document).ready(function () {
    var stepper = new Stepper($('.bs-stepper')[0])
  
  })
  
  var stepper = new Stepper(document.querySelector('.bs-stepper'));
  // console.log(stepper);

}






