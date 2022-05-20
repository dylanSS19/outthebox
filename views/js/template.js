 

var oldURL = document.referrer;
if(window.location.href.includes('login') && !oldURL.includes('outthebox') ){
  if ((!sessionStorage['id'] && !window.location.href.includes('registro') && !window.location.href.includes('recuperar-contrasena-frm1') && !window.location.href.includes('recuperar-contrasena-frm2') && !window.location.href.includes('login') && !window.location.href.includes('machoteFactura')) ) {
    
    window.location = "logout";

    console.log("1");
}else if ((!sessionStorage['id'] && !window.location.href.includes('login') && !window.location.href.includes('registro') && !window.location.href.includes('recuperar-contrasena-frm1') && !window.location.href.includes('recuperar-contrasena-frm2') && !window.location.href.includes('machoteFactura'))){

  window.location = "logout";

  console.log("2");

}
  
}


if(!window.location.href.includes('login') ){
  if ((!sessionStorage['id'] && !window.location.href.includes('registro') && !window.location.href.includes('recuperar-contrasena-frm1') && !window.location.href.includes('recuperar-contrasena-frm2') && !window.location.href.includes('login') && !window.location.href.includes('machoteFactura'))) {

    window.location = "logout";

}else if ((!sessionStorage['id'] && !window.location.href.includes('login') && !window.location.href.includes('registro') && !window.location.href.includes('recuperar-contrasena-frm1') && !window.location.href.includes('recuperar-contrasena-frm2') && !window.location.href.includes('machoteFactura'))){

 window.location = "logout";

}
  
}
/*VALIDAR EMPRESA SELECIONADA*/




if(!window.location.href.includes('login')){
      if(sessionStorage.getItem("empresa")){


$("#empresaheader").val(sessionStorage.getItem('empresa'));

var varempresa = $('select[name="empresaheader"] option:selected').val();
var nomempresa = $('select[name="empresaheader"] option:selected').text();
var varSubMod = $('select[name="empresaheader"] option:selected').attr("subM");
  sessionStorage.setItem("empresa", varempresa);


  
 var data = new FormData();

    data.append("varempresa",varempresa);
    data.append("varnomEmpresa",nomempresa);
    data.append("varSubMod",varSubMod);
     $.ajax({
            url:"ajax/home.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             /*dataType: "json",*/

            success: function(response){
                //console.log("response", response);

var split = response.split(' ');
//console.log("split", split);
var tabla_tiendas = split[0];
var tabla_dth = split[1];
var Idmpresa = split[2];
//console.log("Idmpresa", Idmpresa);
            sessionStorage.setItem("tabla_tiendas", tabla_tiendas.replace(/['"]+/g, ''));
            sessionStorage.setItem("tabla_dth", tabla_dth.replace(/['"]+/g, ''));

                 var nombre =sessionStorage.getItem('tabla_tiendas');
     var name="tabla_tiendas";
     document.cookie= name + "=" + nombre;
      
          
          document.cookie = "cookie_empresa="+Idmpresa;

     var nombredth =sessionStorage.getItem('tabla_dth');
     var namedth="tabla_dth";
     document.cookie= namedth + "=" + nombredth;
     
          //window.location="home";


            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})


   }else{

      $("#empresaheader").prop("selectedIndex", 1).val();

  
var varempresa = $('select[name="empresaheader"] option:selected').val();
var nomempresa = $('select[name="empresaheader"] option:selected').text();
var varSubMod = $('select[name="empresaheader"] option:selected').attr("subM");
  sessionStorage.setItem("empresa", varempresa);


 
 var data = new FormData();

    data.append("varempresa",varempresa);
    data.append("varnomEmpresa",nomempresa);
    data.append("varSubMod",varSubMod);
     $.ajax({
            url:"ajax/home.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             /*dataType: "json",*/

            success: function(response){
                //console.log("response", response);

var split = response.split(' '); 
//console.log("split", split);
var tabla_tiendas = split[0];
var tabla_dth = split[1];
var Idmpresa = split[2];
//console.log("Idmpresa", Idmpresa);
            sessionStorage.setItem("tabla_tiendas", tabla_tiendas.replace(/['"]+/g, ''));
            sessionStorage.setItem("tabla_dth", tabla_dth.replace(/['"]+/g, ''));

                 var nombre =sessionStorage.getItem('tabla_tiendas');
     var name="tabla_tiendas";
     document.cookie= name + "=" + nombre;
      
          
          document.cookie = "cookie_empresa="+Idmpresa;

     var nombredth =sessionStorage.getItem('tabla_dth');
     var namedth="tabla_dth";
     document.cookie= namedth + "=" + nombredth;
     
        //  window.location="home";


            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})
   }
}

 

  



 var data = new FormData();

    data.append("varempresaProfile",sessionStorage.getItem("id"));
  
     $.ajax({
            url:"ajax/home.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
             dataType: "json",

            success: function(response){

              $("#profilePic").attr("src", response["img_perfil"]);
              $("#imageResult").attr("src", response["img_perfil"]);
              $("#currentPicture").val(response["img_perfil"]);
              $("#name_perfil").val(response["nombre_perfil"]);

              



              
              

      if(!window.location.href.includes('login') && !window.location.href.includes('registro')){
                document.getElementById("userProfile").innerHTML = response["nombre_perfil"];

}
 


            },
        error: function(response, err){ console.log('my message ' + err + " " + response);}
})



 
  /*=============================================
 =            DATA TABLE     =
 =============================================*/

 
$(function () {
    $(".tablasbtn").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
 "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

     

  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros", 
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último", 
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

    }).buttons().container().appendTo('#tablasbtn_wrapper .col-md-6:eq(0)');
  });




/*$(function () {
    $("#tablas").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,


     

  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último", 
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

    }).buttons().container().appendTo('#tablas_wrapper .col-md-6:eq(0)');
  });*/


$(".tablas").DataTable({
  

  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior",
    "decimal": ",",
    "thousands": "."
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }



});



  /*=============================================
 =     iCheck for checkbox and radio inputs     =
 =============================================*/
    //iCheck for checkbox and radio inputs
/*$("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
checkboxClass: 'icheckbox_minimal',
radioClass: 'iradio_minimal'
});*/

/*  $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            radioClass: 'iradio_minimal-grey'
        });*/


     $('input[type="checkbox"], input[type="radio"]').iCheck({
  checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red',
    increaseArea: '20%' // optional
  });




    //Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask();


/*$('input').iCheck();

/*function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    console.log("Geolocation is not supported by this browser.");
  }
}*/

/*function showPosition(position) {
 console.log("Latitude: " + position.coords.latitude + 
  " Longitude: " + position.coords.longitude);

 $("#newGeo").val("Latitude: " + position.coords.latitude + 
  " Longitude: " + position.coords.longitude);  
}
*/

    //Initialize Select2 Elements
   //Initialize Select2 Elements
   $('.select2').select2({
    //    width : 'resolve',
    //    theme: "classic"
     })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'

    })
$('.noEnterSubmit').bind('keypress', false);


/*$(".js-example-responsive").select2({
*//*    width: 'resolve' // need to override the changed default
*//*});
*/


function keyPressed(e)
{
     var key;      
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      

     return (key != 13);
}

$(".reveal").on('click',function() {
  //console.log("reveal");


 var element = document.getElementById("lockbtn");
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');

  element.classList.remove("fa-eye");
   element.classList.add("fa-lock");
   
    } else {
        $pwd.attr('type', 'password');
          element.classList.remove("fa-lock");
   element.classList.add("fa-eye");
  
    }
});




$("#whatsappbtn").on('click',function() {
  //console.log("click");



    var num="+50686335806";

  
  var win = window.open(`https://wa.me/${num}?text=Buen día, mi consulta es la siguiente: `, '_blank');
});







function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}


$('.cleanmodal').on('hidden.bs.modal', function (e) {
  $(this)
    .find("input,textarea,img")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end()
        .find("select")
       .val($(".cleancombo option:first").val())
       .end();

    $('.agua').each(function () { 

    sList =  $(this).attr("id");

  itemid ="";
itemid=sList;

         $("#"+itemid+"").removeClass("d-none"); 
                 

});
         
})

$(function () {
  $('[data-toggle="popover"]').popover()
})

if(!window.location.href.includes('login')){

/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#imageResult')
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$(function() {
  $('#upload-profile-pic').on('change', function() {
    readURL(input);
  });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById('upload-profile-pic');
var infoArea = document.getElementById('upload-label');

input.addEventListener('change', showFileName);

function showFileName(event) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'Archivo: ' + fileName;
}

}




