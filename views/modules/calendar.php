  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Eventos Arrastrables</h4>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                 <!--    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div> -->
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        Quitar despúes de agregar
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Crear Evento</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                  <!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Titulo del Evento">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Agregar</button>
                    </div>
                    <!-- /btn-group -->
                  </div>
                  <!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
 
 
window.onload = cargarCalendario;

function load(){

 $.ajax({

          type:"GET",
          url:'ajax/calendario.ajax.php?eventsLoad=true',
          async: false,
          success: function(response){

       
       console.log("respuesta",response);
              
             },

      });

}
 

  function cargarCalendario () {
       <?php

      $idempresa=$_SESSION['empresa'];

    $calendario = CalendarioController::ctrCargarCalendario($idempresa); 

 
          //  echo '<pre>'; print_r($calendario); echo '</pre>';

            // echo("<script>console.log('PHP: USER ".json_encode($calendario) .  "');</script>");


      ?>

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
       
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),


        };
      }
    });

    var calendar = new Calendar(calendarEl, {
       locale: 'es',
       dayMaxEventRows:true,
       editable  : true,
       droppable : true,  
 /*     titleFormat: { 
    month: '2-digit',
    year: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  },  */  
       eventClick: function(info) {
/*    alert('Event: ' + info.event.start);
    alert('Event: ' + info .event.end);
    alert('ID: ' + info.event.title);*/
    // $('#modalCorreo2').modal('hide'); 
    
// console.log(info);
    
// if(info.event.allDay == true){

//   let fecha_fin;
//   fecha_fin = moment(info.event.start).add(12, 'hours');
//   $('.fechaCalendario').val(moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(fecha_fin).format('YYYY-MM-DD hh:mm:ss A'));
//   $('.fechaCalendario').attr('fechaReal', moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(fecha_fin).format('YYYY-MM-DD hh:mm:ss A'));

// }else{

//   $('.fechaCalendario').val(moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(info.event.end).format('YYYY-MM-DD hh:mm:ss A'));
//   $('.fechaCalendario').attr('fechaReal', moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(info.event.end).format('YYYY-MM-DD hh:mm:ss A'));
// }

// $('.fechaCalendario').val(moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(info.event.end).format('YYYY-MM-DD hh:mm:ss A'));
//   $('.fechaCalendario').attr('fechaReal', moment(info.event.start).format('YYYY-MM-DD hh:mm:ss A') +" / "+ moment(info.event.end).format('YYYY-MM-DD hh:mm:ss A'));




    $('#tituloEvento').val(info.event.title);
    $('#tituloEvento').attr('idevento', info.event.id);
    $('#tituloEvento').attr('cont', 0);
    $('#modalCalendar').modal('show'); 

    cargarDatosEvento(info.event.id);
    CargarCarrusel(info.event.id);
    cargarComentarios(info.event.id);
    cargarReacciones(info.event.id);
console.log(info.event.start +"  /  "+ info.event.end +"  /  "+ info.event.id+" / "+ info.event.allDay);
  },
         eventChange: function(info) {

          // var fecha;
          // fecha = moment(info .event.start).subtract(1, 'days');
          // console.log(moment(fecha).format('YYYY-MM-DD HH:mm:ss'));

if(info.event.allDay == true){

  var fin= moment(info .event.start).format('YYYY-MM-DD 23:59:59');

}else{

  var fin = moment(info.event.start).add(1, 'hours');
   fin= moment(fin).format('YYYY-MM-DD HH:mm:ss');
  
}


         var inicio= moment(info .event.start).format('YYYY-MM-DD HH:mm:ss');   
         var data = new FormData();

         console.log(info.event.start +"  /  "+ info.event.end +"  /  "+ info.event.id+" / "+ info.event.allDay);

    data.append("eventUpdateFecha",true);
    data.append("inicioUpdateFecha",inicio);
    data.append("finUpdateFecha",fin);
    data.append("IDUpdateFecha",info.event.id);

     $.ajax({
            url:"ajax/calendario.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            // dataType: "json",

            success: function(response){
              console.log(response);
               calendar.render();

            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})  
  },
           eventReceive: function(info) {


    var inicio= moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
    var fin= moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
    fin = moment(info.event.start).add(1, 'hours');
    // fin= moment(fin).format('YYYY-MM-DD 23:59:59');
    var data = new FormData();

    data.append("eventAddFecha",true);
    data.append("inicioAddFecha",inicio);
    data.append("finAddFecha",fin);
    data.append("tituloAddFecha",info.event.title);
    data.append("alldayAddFecha",info.event.allDay);
    data.append("backgroundColorAddFecha",info.event.backgroundColor);
    data.append("borderColorAddFecha",info.event.backgroundColor);
 
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
              location.reload();
           
            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})  
  },
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      themeSystem: 'bootstrap',

 events             : [
    <?php
date_default_timezone_set('America/Costa_Rica');
  
if ($calendario ==null){


 //echo "{ y: 0, dth: 0, internet: 0, pospago: 0, gpon: 0 }";


}else{


    foreach ($calendario as $key => $value) {
      

      if ($key === array_key_last($calendario)){

        
        echo "{ 
          timeZone: 'UTC',
          id             :'".$value["idtbl_calendario"]."',
          title          : '".$value["titulo"]."',
          start          : '".date('Y-m-d h:i:s', strtotime($value["inicio"]))."',
          end            : '".date('Y-m-d h:i:s', strtotime($value["fin"]))."',
          backgroundColor: '".$value["backgroundColor"]."',
          borderColor    : '".$value["borderColor"]."',
          allDay         : ".$value["allday"].",
          editable       : ".$value["editable"].",
          privilegios    : '".$value["tipo"]."' 
        }";

      }else{

          echo "{ 
          timeZone: 'UTC',
          id       :'".$value["idtbl_calendario"]."',
          title          : '".$value["titulo"]."',
          start          : '".date('Y-m-d h:i:s', strtotime($value["inicio"]))."',
          end            : '".date('Y-m-d h:i:s', strtotime($value["fin"]))."',
          backgroundColor: '".$value["backgroundColor"]."',
          borderColor    : '".$value["borderColor"]."',
          allDay         : ".$value["allday"].",
          editable       : ".$value["editable"].",
          privilegios    : '".$value["tipo"]."'
        },";


      }

      

    }

} 
// : '".date('Y-m-d h:i:s', strtotime($value["fin"]))."'
      ?>

    ], 
           
    
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })

  }

function cargarDatosEvento(id){







}

</script>


<div class="modal" id="modalCalendar">

	<div class="modal-dialog modal-lg">
		
		<div class="modal-content">  
		
			<div class="modal-header">
				<h4 style="text-align: center;" class="modal-title">Datos Evento</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		
		        <div class="modal-body">

					<div class="row">
					

            <!-- inicio bloque prueba -->


          <div class="col-md-12 col-lg-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#DatosEvento">
                      <button type="button" class="step-trigger" role="tab" aria-controls="DatosEvento" id="DatosEvento-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Datos Evento</span>
                      </button>
                    </div>


                    <div class="line"></div>
                    <div class="step" data-target="#ubicacion">
                      <button type="button" class="step-trigger" role="tab" aria-controls="ubicacion" id="ubicacion-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Ubicación</span>
                      </button>
                    </div>

                    <div class="line"></div>
                    <div class="step" data-target="#comentarios">
                      <button type="button" class="step-trigger" role="tab" aria-controls="comentarios" id="comentarios-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Comentarios</span>
                      </button>
                    </div>

                    <div class="line"></div>
                    <div class="step" data-target="#invitar">
                      <button type="button" class="step-trigger" role="tab" aria-controls="invitar" id="invitar-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Invitaciones</span>
                      </button>
                    </div>
            
                  </div>

                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="DatosEvento" class="content" role="tabpanel" aria-labelledby="DatosEvento-trigger">
                      <div class="form-group">
                      
                        <div class="col-xs-12 col-lg-12">
                        <label>&nbsp;&nbspNombre Evento:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="far fa-edit"></i></span>
                          </div>
                          <input type="text" style="font-size:15px;"  class="form-control" id="tituloEvento" name="tituloEvento" idevento="" cont="" required placeholder="Evento" >  
                        </div> 
                      </div>
                    

                      <div class="col-xs-12 col-lg-12">
                        <label>Fecha Evento:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock"></i></span>
                          </div>
                          <input type="text" class="form-control float-right fechaCalendario"  id="reservationtime" fechaReal="" condicion="">
                        </div>
                      </div>
                
                      
                      <div class="col-xs-12 col-lg-12">
                        <label>&nbsp;&nbspDetalle Evento:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="far fa-edit"></i></span>
                          </div>
                          <input type="text" style="font-size:15px;"  class="form-control" id="comentarioEvento" name="comentarioEvento" required placeholder="Comentarios" >  
                        </div> 
                        
                      </div>
                      
                      <div class="col-xs-12 col-lg-12">
                        <label>&nbsp;&nbspDirección evento:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                          </div>
                          <input type="text" style="font-size:15px;"  class="form-control" id="direccionEvento" name="direccionEvento" required placeholder="Dirección" >  
                        </div> 
                        
                      </div>
                      
                      <div class="col-xs-12 col-lg-12">
                        <label>&nbsp;&nbspLimite Invitados:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="fas fa-users"></i></span>
                          </div>
                          <input type="number" style="font-size:15px;"  class="form-control" id="limiteEvento" name="limiteEvento" required placeholder="Limite Invitados" >  
                        </div> 
                            <br>
                      </div>

                        
                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">        
                        <!-- <div class="form-group clearfix"> -->
                          <div class="icheck-primary d-inline ">
                          <input type="radio"  id="radioPublico" name="r1"  >
                          <label for="radioPublico">Publico</label>
                          </div>
                          <!-- </div> -->
                        </div>

                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">  
                        <!-- <div class="form-group clearfix">                    -->
                            <div class="icheck-primary d-inline ">
                            <input type="radio" id="radioPrivado" name="r1">
                            <label for="radioPrivado">Privado</label>
                          </div>
                        <!-- </div> -->
                      </div>  


                      </div>    
                      <div class="row">

                          <div class="col-6 col-sm-6 col-md-6 col-lg-6 "> 

                          <button type="button" class="btn btn-primary btnAddEvento" id="btnAddEvento" >Guardar</button>

                          </div> 

                          <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end"> 

                          <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>

                          </div> 

                      </div>    
                      
                      

                      
                    </div>


                    <div id="ubicacion" class="content" role="tabpanel" aria-labelledby="ubicacion-trigger">
                      <div class="form-group">
                        
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          
                              <div id="map">
               

                               

                              </div> 
                            
                          <input type="text" style="font-size:15px;"  class="form-control" id="latubicacion" name="latubicacion" required placeholder="Limite Invitados" hidden>  
                          <input type="text" style="font-size:15px;"  class="form-control" id="longubicacion" name="longubicacion" required placeholder="Limite Invitados" hidden>  


                        </div>
                            <br>
                      </div>

                      <div class="row">

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 "> 

                        <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>

                        </div> 

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end"> 

                        <button class="btn btn-primary justify-content-end" onclick="stepper.next()">Siguiente</button>

                        </div> 

                      </div>    
                      
                      
                                      
                    </div>

                    <div id="comentarios" class="content" role="tabpanel" aria-labelledby="comentarios-trigger">
                      <div class="form-group">

                      <div class="col-6 col-xs-6 col-lg-6">                
                      <label>&nbsp;&nbspImagenes Evento</label>
                      <div class="input-group mb-6" style=" width: 100%;">
                      <img src="views/img/users/default/anonymous.png" class="img-thumbnail" id="fotos_eventos_vista" width="100px">
                      <input type="file" class="fotos_eventos " id="fotos_eventos"  name="fotos_eventos" >                 
                      <p class="help-block">Peso máximo de la foto 4MB</p>                           
                      </div>                 
                      </div> 
                  
                      <div class="col-xs-6 col-lg-12">         
                      <div class="input-group mb-2" style=" width: 100%;">       
                      <div class='btn-group'>
                        <button type="button" class="btn btn-outline-secondary agregarFoto">Agregar</button>     
                      </div>       
                      </div>                         
                      </div>


                      <div class="col-xs-12 col-lg-12">
                          <div class="card card-widget">
                              <div class="card-header">
                              <div class="user-block">
                                <img class="img-circle" src="views/img/users/default/anonymous.png" alt="Imagen de usuario">
                                <span class="username "><a href="#" class="userEvent"></a></span>
                                <!-- <span class="description">Compartido públicamente - 7:30 p.m. Hoy</span> -->
                              </div>
                              <!-- /.user-block -->
                              <div class="card-tools">
                                <!-- <button type="button" class="btn btn-tool" title="Marcar como leído">
                                <i class="far fa-circle"></i>
                                </button> -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button> -->
                              </div>
                              <!-- /.card-tools -->
                              </div>
                            <!-- /.card-header -->
                             
                            <div class="card-body " >

                              <center>

                              <div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner carrucel">

                                </div>
                                
                                <div class="controlPasarela">

                                </div>
                              </div>
                              
                              <!-- <img class="img-fluid pad"  src="https://backup.midigitalsat.com/private/apiHacienda/clientes/2505/img/imgEvento/28/fotoEvento1.jpg" width="400" height="300" alt="Foto">     -->
                              </center>
                              <!-- </div> -->
                              <!-- <p>Tomé esta foto esta mañana. ¿Qué piensan ustedes?</p> -->
                              <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i>Compartir</button> -->
                              <br>
                              <!-- <button type="button" class="btn btn-default btn-sm btnreaccion"><i class="far fa-thumbs-up"></i>Me gusta</button> -->
                              <span class="float-right text-muted cantreaccion" likes="" comentarios=""></span>
                              <br>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer card-comments cajaComentarios">

                              
                          <!-- 
                            <div class="card-comment">
                              <img class="img-circle img-sm" src="views/img/users/default/anonymous.png" alt="Imagen de usuario">
                              <div class="comment-text">
                              <span class="username">Luna Stark
                              <span class="text-muted float-right">8:03 PM Hoy</span>
                              </span>
                              Es un hecho establecido desde hace mucho tiempo que un lector se distraerá con el contenido legible de una página cuando mire su diseño.
                              </div>
                            </div> -->
                            
                            </div>
                            <div class="card-footer">
                              <!-- <form> -->
                                <img class="img-fluid img-circle img-sm" src="views/img/users/default/anonymous.png" alt="Texto alternativo">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                <input type="text" class="form-control form-control-sm comentariosEvento" value="" placeholder="Presione enter para publicar un comentario">
                                </div>
                              <!-- </form> -->
                            </div>
                            <!-- /.card-footer -->
                          </div>
                          </div>

                      
                      </div>
              
                    <div class="row">

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 "> 

                        <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>

                        </div> 

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end"> 

                        <button class="btn btn-primary justify-content-end" onclick="stepper.next()">Siguiente</button>

                        </div> 

                      </div>    
                      
                      
                    </div>


                    <div id="invitar" class="content" role="tabpanel" aria-labelledby="invitar-trigger">
                      <div class="row">

                      <div class="col-xs-6 col-lg-6">
                        <label>&nbsp;&nbspUsuario:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
                          </div>
                          <input type="text" style="font-size:15px;"  class="form-control" id="userinvitado" name="userinvitado" required placeholder="Usuario" >  
                        </div> 
                        
                      </div>

                      <div class="col-xs-6 col-lg-6">
                        <label>&nbsp;&nbspCorreo:</label>
                        <div class="input-group mb-6" style=" width: 100%;">
                          <div class="input-group-prepend">
                          <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
                          </div>
                          <input type="number" style="font-size:15px;"  class="form-control" id="Correoinvitado" name="Correoinvitado" required placeholder="Correo" >  
                        </div> 
                            <br>
                      </div>


                      </div>

                      <div class="row">

                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 "> 

                      <button class="btn btn-primary EnviarCorreo" >Invitar</button>

                      </div>

                      
                    <div class="col-6 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end"> 

                    <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>

                    </div> 

                    </div> 


                    </div>

                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                
              </div>
            </div>
            <!-- /.card -->
          </div>


<!-- inicio bloque prueba -->

            <!-- <button type="button" class="btn btn-primary facebook" >ingresar</button>
            										 -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.modal-body -->
	
			<div class="modal-footer justify-content-between">
			   <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
			   <!-- <button type="button" class="btn btn-primary btnAddEvento" id="btnAddEvento" >Guardar</button> -->
			</div>
			
		</div>

	</div>
	
</div>



   <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
   <script
                                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6DXuX_kl6D4J3_Du6ud68odvppSg5i3g&callback=initMap&libraries=&v=weekly"
                                  defer
                                ></script>

                                <style type="text/css">
                                  /* Set the size of the div element that contains the map */
                                  #map {
                                    height: 300px;
                                    /* The height is 400 pixels */
                                    width: 100%;
                                    /* The width is the width of the web page */
                                  }
                                </style>

                                <script>

                      function initMap() {
                        const myLatlng = { lat:9.876780213623467 , lng:-84.08955601027321 };
                        const map = new google.maps.Map(document.getElementById("map"), {
                          zoom: 10,
                          center: myLatlng,
                        });
                        // Create the initial InfoWindow.
                        let infoWindow = new google.maps.InfoWindow({
                          content: "Click para agregar ubicación.",
                          position: myLatlng,
                        });

                        infoWindow.open(map);



                        // Configure the click listener.
                        map.addListener("click", (mapsMouseEvent) => {
                          // Close the current InfoWindow.
                          infoWindow.close();
                          // Create a new InfoWindow.
                          infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            
                          });

                          infoWindow.setContent(
                            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                          );
                          infoWindow.open(map);

                          let lat;
                          let lon;
                          let ubicacion = JSON.parse(infoWindow.content);
                          lat = ubicacion["lat"];
                          lon = ubicacion["lng"];
                      
                      $("#longubicacion").val(lon);
                      $("#latubicacion").val(lat);
                        });
                      }



                                </script>