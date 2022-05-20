'use strict';

// Put variables in global scope to make them available to the browser console.
const video = document.querySelector('video');
const canvas = window.canvas = document.querySelector('canvas');
canvas.width = 480;
canvas.height = 360;

const button = document.querySelector('button');
button.onclick = function() {

  console.log("canvas");
  canvas.width = video.videoWidth;
  
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
};

const constraints = {
  audio: false,
  video: true
};

function handleSuccess(stream) {
  window.stream = stream; // make stream available to browser console
  video.srcObject = stream;
}

function handleError(error) {
  console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
}

navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);


$(".snapbtn").on('click',function() {


  var divsToHide = document.getElementsByClassName("previewsnap"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

      if( divsToHide[i].style.display== "none"){
    divsToHide[i].style.display = "block";

      }else{

           divsToHide[i].style.display = "none"; // depending on what you're doing
      }    
}}

  var divsToHide = document.getElementsByClassName("snap"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

      if( divsToHide[i].style.display== "none"){
    divsToHide[i].style.display = "block";

      }else{

           divsToHide[i].style.display = "none"; // depending on what you're doing
      }    
}}

var btn = $(".snapbtn").html();

if(btn =="Tomar foto"){
$(".snapbtn").html("Volver a tomar foto");
}else{
$(".snapbtn").html("Tomar foto");
  
}

 

/*$(".snapbtn").html('Save');*/

  canvas.width = video.videoWidth;
  
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);


  var canvas2 = document.getElementById("canvasnap");
var image = canvas2.toDataURL("image/jpeg");
/*$("#picsnapcontrol").attr("src", image);*/
$("#fromcanvas").val(image);
/*$("fromcanvas").val(image);
$(".fromcanvas").val(image);*/
});






$("#cedula-control-asistencia").change(function(){

var cedEmpleado= $(this).val();
 
if(cedEmpleado == ""){
  Swal.fire(
    "Espacio Vacio",
    "Ingrese una cédula para continuar.",
    "error"
  ).then((result) => {

$("#cedula-control-asistencia").val("");
$("#idEmpleadopicsnap").val("");
$("#id_empresaControlAsistencia").val("");

  })

  return false;
}


 var data = new FormData();

    data.append("cedEmpleado",cedEmpleado);
    
     $.ajax({
            url:"ajax/control-asistencia.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",

            success: function(response){

              

              if(!response){

                Swal.fire(
      "Cédula incorrecta!",
      "¡Empleado no existe!",
      "error"
    ).then((result) => {

  $("#cedula-control-asistencia").val("");
  $("#idEmpleadopicsnap").val("");
  $("#id_empresaControlAsistencia").val("");

    })
  }else{

    $("#idEmpleadopicsnap").val(response[0]);
    $("#id_empresaControlAsistencia").val(response[1]);
    $("#nombreEmpleado").val(response["nombre_completo"]);
    $("#empresa").val(response["id_empresa"]);
    validarIngresoAsistencia ();
    
 
}

            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})



 

});




function validarIngresoAsistencia (){

let empresa = $("#empresa").val();
let empleado = $("#idEmpleadopicsnap").val();


console.log(empresa);
console.log(empleado);

 
var data = new FormData();

data.append("IDempresa",empresa);
data.append("IDempleado",empleado);

 
 $.ajax({
        url:"ajax/control-asistencia.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",

        success: function(response){


console.log(response);

if(response == "" || response == false ){

  $(".btnValidarAsis").removeAttr('hidden');

}else{

  Swal.fire(
    "Error",
    "¡Usuario ya cuenta con un registro de asistencia hoy!",
    "error"
  ).then((result) => {
  
    window.location = "control-asistencia";

  })

}

        },
    error: function(response, err){ console.log('my message ' + err + " " + response);}
})


}