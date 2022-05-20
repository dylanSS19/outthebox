$(document).ready(function() {

    CargarEventos();


});



function CargarEventos(){
  
  var fecha = new Date()
  fecha = moment(fecha).format('YYYY-MM-DD')
  var fecha_nueva;
  var fecha_evento;

    var data = new FormData();
  
    data.append("event","ok");

      $.ajax({
  
        url:"ajax/calendario-invitados.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",  
        success: function(response){
         
          // console.log(response);

          for(let i = 0; i <response.length; i++){

            fecha_evento = moment(response[i].inicio).format('YYYY-MM-DD');

            if(fecha_evento == fecha){
  
              fecha_nueva = "Hoy " + moment(response[i].inicio).format('hh:mm a');
               
  
            }else{
  
              fecha_nueva = moment(response[i].inicio).format('YYYY-MM-DD hh:mm a');
              
            }

            if(response[i].Invitado == "No" && response[i].tipo =="Privado"){


            }else if(response[i].Invitado != "No"){

              $(".eventos").append('<div class="col-sm-12 col-lg-6">'+
              '<div class="card card-success shadow-sm">'+
              '<div class="card-header">'+
                '<h3 class="card-title">'+response[i].titulo +'  '+ fecha_nueva +'</h3>'+
                '<div class="card-tools">'+
                  '<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
                    '<i class="fas fa-minus"></i>'+
                  '</button>'+
                '</div>'+
              '</div>'+
              '<div class="card-body">'+
              '<div class="row">'+


              '<div class="col-xs-12 col-lg-12">'+
                          '<div class="card card-widget collapsed-card">'+
                              '<div class="card-header">'+
                              '<div class="user-block">'+
                                '<img class="img-circle" id="imgUser'+ response[i].idtbl_calendario +'" src="views/img/users/default/anonymous.png" alt="Imagen de usuario">&nbsp&nbsp'+
                                '<span class="username'+ response[i].idtbl_calendario +'"><a href="#" class="userEvent"></a></span>'+
                                
                              '</div>'+
                             
                              '<div class="card-tools">'+
   
                              '<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
                              '<i class="fas fa-minus"></i>'+
                              '</button>'+

                              '</div>'+
                              
                             '</div>'+
                            
                            
                            '<div class="card-body " >'+

                              '<center>'+

                              '<div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">'+
                                '<div class="carousel-inner carrucel'+ response[i].idtbl_calendario +'">'+

                                '</div>'+
                                
                                '<div class="controlPasarela'+ response[i].idtbl_calendario +'">'+

                                '</div>'+
                              '</div>'+
                                           
                              
                              '<br>'+
                              
                              '<span class="float-right text-muted cantreaccion" likes="" comentarios=""></span>'+
                              '<br>'+
                            '</div>'+
                            
                            '<div class="card-footer card-comments cajaComentarios'+ response[i].idtbl_calendario +'">'+
                            
                            '</div>'+
                            '<div class="card-footer">'+
                              
                                '<img class="img-fluid img-circle img-sm" src="views/img/users/default/anonymous.png" alt="Texto alternativo">'+
                                
                                '<div class="img-push">'+
                                '<input type="text" class="form-control form-control-sm comentariosEvento'+ response[i].idtbl_calendario +'" id="comentariosEvento" idDiv= "'+ response[i].idtbl_calendario +'" value="" placeholder="Presione enter para publicar un comentario">'+
                                '</div>'+
                              
                            '</div>'+
                            
                          '</div>'+
                          '</div>'+

                 
                  '<div class="col-6 col-sm-6 col-md-6 col-lg-6">'+         
                  '<div class="input-group mb-2" style=" width: 100%;">'+       
                  '<div class="btn-group">'+
                  '<button class="btn btn-outline-primary btnConfirmacion" idDiv= "'+ response[i].idtbl_calendario +'" id="btnConfirmacion'+ response[i].idtbl_calendario +'">Asistir</button>'+    
                  '</div>'+       
                  '</div>'+                         
                  '</div>'+
                  '<div class="col-6 col-sm-6 col-md-6 col-lg-6 ">'+         
                  '<div class="input-group mb-2 d-flex flex-row-reverse" style=" width: 100%;">'+       
                  '<div class="btn-group">'+
                  '<button class="btn btn-outline-primary btnUbicacion" idDiv= "'+ response[i].idtbl_calendario +'" id="btnUbicacion'+ response[i].idtbl_calendario +'">Ubicación</button>'+    
                  '</div>'+       
                  '</div>'+                         
                  '</div>'+
                

            '</div>'+
              '</div>'+         
            '</div>');

            }else if(response[i].Invitado == "No" && response[i].tipo =="Publico"){

              $(".eventos").append('<div class="col-sm-12 col-lg-6">'+
              '<div class="card card-warning shadow-sm">'+
              '<div class="card-header">'+
                '<h3 class="card-title">'+response[i].titulo +'  '+ fecha_nueva +'</h3>'+
                '<div class="card-tools">'+
                  '<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
                    '<i class="fas fa-minus"></i>'+
                  '</button>'+
                '</div>'+
              '</div>'+
              '<div class="card-body">'+
              '<div class="row">'+

              '<div class="col-xs-12 col-lg-12">'+
                          '<div class="card card-widget collapsed-card">'+
                              '<div class="card-header">'+
                              '<div class="user-block">'+
                                '<img class="img-circle" id="imgUser'+ response[i].idtbl_calendario +'" src="views/img/users/default/anonymous.png" alt="Imagen de usuario">&nbsp&nbsp'+
                                '<span class="username'+ response[i].idtbl_calendario +'"><a href="#" class="userEvent"></a></span>'+
                                
                              '</div>'+
                             
                              '<div class="card-tools">'+
   
                                '<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
                                '<i class="fas fa-minus"></i>'+
                                '</button>'+

                              '</div>'+
                              
                             '</div>'+
                            
                            
                            '<div class="card-body " >'+

                              '<center>'+

                              '<div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">'+
                                '<div class="carousel-inner carrucel'+ response[i].idtbl_calendario +'">'+

                                '</div>'+
                                
                                '<div class="controlPasarela'+ response[i].idtbl_calendario +'">'+

                                '</div>'+
                              '</div>'+
                                           
                              
                              '<br>'+
                              
                              '<span class="float-right text-muted cantreaccion" likes="" comentarios=""></span>'+
                              '<br>'+
                            '</div>'+
                            
                            '<div class="card-footer card-comments cajaComentarios'+ response[i].idtbl_calendario +'">'+
                            
                            '</div>'+
                            '<div class="card-footer">'+
                              
                                '<img class="img-fluid img-circle img-sm" src="views/img/users/default/anonymous.png" alt="Texto alternativo">'+
                                
                                '<div class="img-push">'+
                                '<input type="text" class="form-control form-control-sm comentariosEvento'+ response[i].idtbl_calendario +'" id="comentariosEvento" idDiv= "'+ response[i].idtbl_calendario +'"  value="" placeholder="Presione enter para publicar un comentario">'+
                                '</div>'+
                              
                            '</div>'+
                            
                          '</div>'+
                          '</div>'+


                
                '<div class="col-6 col-sm-6 col-md-6 col-lg-6">'+         
                '<div class="input-group mb-2" style=" width: 100%;">'+       
                '<div class="btn-group">'+
                '<button class="btn btn-outline-primary btnConfirmacion" idDiv= "'+ response[i].idtbl_calendario +'" id="btnConfirmacion'+ response[i].idtbl_calendario +'">Asistir</button>'+    
                '</div>'+       
                '</div>'+                         
              '</div>'+

              '<div class="col-6 col-sm-6 col-md-6 col-lg-6 ">'+         
              '<div class="input-group mb-2 d-flex flex-row-reverse" style=" width: 100%;">'+       
              '<div class="btn-group">'+
              '<button class="btn btn-outline-primary btnUbicacion" idDiv= "'+ response[i].idtbl_calendario +'" id="btnUbicacion'+ response[i].idtbl_calendario +'" lon="'+ response[i].lon +'" lat="'+ response[i].lat +'">Ubicación</button>'+    
              '</div>'+       
              '</div>'+ 
              '</div>'+
             
            
              '</div>'+
              '</div>'+         
            '</div>');

            }

            CargarCarrusel2(response[i].idtbl_calendario);
            cargarComentarios2(response[i].idtbl_calendario);
            cargarCreadorEvento2(response[i].idtbl_calendario, response[i].empresa);
          }
  
  
        },
  
        error: function(response, err){ console.log('my message ' + err + " " + response);}
        
    })
  
  }

$(".eventos").on("click", "button.btnUbicacion", function(){

let idDiv = $(this).attr('idDiv');

let long = $(this).attr('lon');
let lat =  $(this).attr('lat');


if(long == "" || lat == "" || long == "null" || lat == "null"){

  Swal.fire(
    "Aviso",
    "No se encuentra una ubicación agregada al evento.",
    "warning"
  ).then((result) => {

  }) 

  return;
}


var a = document.createElement('A');
var filePath = 'https://www.google.com/maps/search/?api=1&query='+lat+','+long+'';
a.href = filePath;
a.target = "_blank";
// a.download = filePath.substr(filePath.lastIndexOf('/') + 1);
document.body.appendChild(a);
a.click();
document.body.removeChild(a);

});



$(".eventos").on("click", "button.btnConfirmacion", function(){

    let idDiv = $(this).attr('idDiv');
    let username = sessionStorage.getItem('id'); 


   let validacion = validarUsuario(idDiv, username);



  let disp =   validarDisponibilidad(idDiv);

      if(disp[1] >  disp[0]){

        return;

      }else{

        if(validacion == 1){

          let estado = "Aceptado";
          modificarEvento(idDiv, username, estado)



        }else{

          let estado = "Aceptado";
          ingresarAevento(idDiv, username, estado)


        }


      }

    
});


function ingresarAevento(evento, usuario, estado){

  var data = new FormData();
        
  data.append("AddAcepEvent", evento);
  data.append("Addestado", estado);
  data.append("Addusuario", usuario);

    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
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
            "Reserva exitosa",
            "",
            "success"
            ).then((result) => {
           window.location = "invitados-eventos";
          }) 

        }else{

          Swal.fire(
          "Error",
          "Error al reservar, intente nuevamente.",
          "error"
          ).then((result) => {
          window.location = "invitados-eventos";
          }) 

        }

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })



}

function modificarEvento(evento, usuario, estado){

  var data = new FormData();
        
  data.append("UpdAcepEvent", evento);
  data.append("Updestado", estado);
  data.append("Updusuario", usuario);

    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
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
            "Reserva exitosa",
            "",
            "success"
            ).then((result) => {
           window.location = "invitados-eventos";
          }) 

        }else{

          Swal.fire(
          "Error",
          "Error al reservar, intente nuevamente.",
          "error"
          ).then((result) => {
          window.location = "invitados-eventos";
          }) 


        }

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })


}





function validarUsuario(Evento, username){

  var respuesta;
  var data = new FormData();
  
  data.append("validevento", Evento);
  data.append("username", username);

    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){

        respuesta = response[0];

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  });

return respuesta;

}

function validarDisponibilidad(Evento){

  var respuesta = [];
  var data = new FormData();
  
  data.append("idEvento", Evento);

    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){

        respuesta.push(response[0]);

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  });


  var data = new FormData();
  
  data.append("invitados", Evento);

    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){

        respuesta.push(response[0]);

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  });

  return respuesta;
}

function CargarCarrusel2(Evento){


  var data = new FormData();

  data.append("eventID",Evento);

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
      $(".carrucel"+Evento).empty();
      if(response == ""){


      }else{

        for(let i = 0; i < response.length; i++){

          if(i == 0){
          
            $(".carrucel"+Evento).append(
              '<div class="carousel-item active">'+
                '<img class="d-block w-100" src="http://backup.midigitalsat.com'+ response[i]['ruta'] +'" width="400px" height="400px">'+
              '</div>'
            );
          
          
          }else{
          
            $(".carrucel"+Evento).append(
              '<div class="carousel-item">'+
                '<img class="d-block w-100" src="http://backup.midigitalsat.com'+ response[i]['ruta'] +'" width="400px" height="400px">'+
              '</div>'
            );
          
          }
          
          
          
            } 
                 $(".controlPasarela"+Evento).append(
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


function cargarComentarios2(Evento){

  var fecha = new Date()
  fecha = moment(fecha).format('YYYY-MM-DD')

  var data = new FormData();
  $(".cajaComentarios"+Evento).empty();
  data.append("idE",Evento);
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


            $(".cajaComentarios"+Evento).append(

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


cargarReacciones2(Evento);

}

function cargarCreadorEvento2(idevento, empresa){

  var data = new FormData();
  data.append("empresaEvento",empresa);
    $.ajax({

      url:"ajax/calendario-invitados.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  
      success: function(response){

        
        $('.username'+idevento).empty();
        $('.username'+idevento).append(response.nombre_ficticio);

      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })

  // 'views/img/users/default/anonymous.png'

  // $('#imgUser'+idevento).attr('src', 'https://backup.midigitalsat.com/private/apiHacienda/clientes/'+ empresa +'/img/logo.png');



}


function cargarReacciones2(Evento){

  $(".cantreaccion"+Evento).empty();

  var data = new FormData();
  data.append("evento",Evento);
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

  $(".cantreaccion"+Evento).append('0 comentarios');
  $(".cantreaccion"+Evento).attr('likes', response[0].reacciones);
  $(".cantreaccion"+Evento).attr('comentarios', '0');

}else{

  $(".cantreaccion"+Evento).append(''+ response[1].reacciones +' comentarios');
  $(".cantreaccion"+Evento).attr('likes', response[0].reacciones);
  $(".cantreaccion"+Evento).attr('comentarios', response[1].reacciones);

}



      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })



}

$(".eventos").on("keydown", "input#comentariosEvento", function(e){
// $(".comentariosEvento").on("keydown", function (e) {

  // e.preventDefault();
  if (e.keyCode === 13) {  
 
  let comentarios;
  let nombre;
  let id_evento;
  comentarios = e.target.value;
  nombre = cargarNombreUsuario();
  id_evento = $(this).attr('idDiv');

 if(comentarios == ""){


 }else{

  agregarComentario(comentarios, id_evento, nombre);
  $(this).val("");
 }

  
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
       


      },

      error: function(response, err){ console.log('my message ' + err + " " + response);}
      
  })

  cargarComentarios2(idevento);



}




function cargarNombreUsuario(){

let idUsuario =  sessionStorage.getItem('id');
var nombre;
var data = new FormData();

data.append("userSearch",idUsuario);

  $.ajax({

    url:"ajax/calendario-invitados.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",  
    success: function(response){
      
      nombre = response.nombre_perfil;

    },

    error: function(response, err){ console.log('my message ' + err + " " + response);}
    
})

return nombre;

}