        
  /*=============================================
    =                   EDIT USER                 =
     =============================================*/

     $(document).on("click", ".btnEditClient", function(){

      var ClientId = $(this).attr("ClientId");

      var data = new FormData();
 
      data.append("ClientId",ClientId);

      $.ajax({

        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async:false,
        dataType: "json",
        success: function(response){
          // console.log("response",response);

          $("#editar_idempresa").val(response["idtbl_clientes"]);
          $("#editarcodigocliente").val(response["codigo"]);
          $("#editartipocedulacliente").val(response["tipo_personeria"]);
          $("#editarcedulacliente").val(response["cedula"]);
          $("#editarnombrecliente").val(response["nombre_ficticio"]);
          $("#editarnombrecontactocliente").val(response["nombre"]);
          $("#editarubicacioncliente").val(response["direccion"]);
          // $("#editarservicio_contratado").val(response["privilegio"]);

          var values = new Array();

          let privilegios = JSON.parse(response["privilegio"]);

          var x;

          for (x of privilegios) {

            values.push(x);

          }

$("#editarservicio_contratado").val(values).trigger('change');

console.log(response["privilegio"]);
// console.log(values);


          // $("#editarservicio_contratado").append('<option disabled selected value="'+ response["privilegio"] +'">'+ response["privilegio"] +'</option>');  
          if(response["privilegio"].includes("Facturacion") ){

            $("#txt_empresa_editar").removeAttr("hidden");
            $("#datos_empresa_editar").removeAttr("hidden");
            $("#txt_pruebas_editar").removeAttr("hidden");
            $("#datos_empresa_prueba_editar").removeAttr("hidden");

          }else{





          }
          
          // $('option:selected', '#editarprovinciacliente').val(response["id_provincia"]);
          // $("#editarprovinciacliente").val(response["provincia"]);

  const option = document.querySelector('#editarprovinciaempresas');
  const valor = response["provincia"];
  option.value = valor;
  // console.log("valor", valor);


 var varProvincia = response["provincia"];




    var data = new FormData();

    data.append("varProvincia",varProvincia);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async:false,
            dataType: "json",

            success: function(response){
              // console.log("response", response);
            $("#editarcantonempresas").empty();
            $("#editardistritoempresas").empty();
            $("#editardistritoempresas").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                         $("#editarcantonempresas").append('<option disabled selected value="">Seleccionar Canton</option>');             
            for(var i = 0; i < response.length; i++){        
                 $("#editarcantonempresas").append('<option value="'+response[i]["idcantones"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
              }

            },

    })

          // $("#editarcantoncliente").val(response["canton"]);
  const option2 = document.querySelector('#editarcantonempresas');
  const valor2 = response["canton"];
  option2.value = valor2;


// console.log("valor2", valor2);


      var varCantones =response["canton"];
      
      //console.log(varCantones);

  var data = new FormData();

    data.append("varCantones",varCantones);
    data.append("var_provincia",varProvincia);
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async:false,
            dataType: "json",

            success: function(response){
            $("#editardistritoempresas").empty();
            $("#editardistritoempresas").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
            for(var i = 0; i < response.length; i++){        
                 $("#editardistritoempresas").append('<option value="'+response[i]["iddistritos"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
              }

            },

    })


       const option3 = document.querySelector('#editardistritoempresas');
  const valor3 = response["distrito"];
  option3.value = valor3;

// console.log("valor3", valor3);
          // $("#editardistritocliente").val(response["distrito"]);

          $("#editartelefonocliente").val(response["telefono"]);

          $("#editarcorreocliente").val(response["email"]);

          $("#editarlatitudcliente").val(response["latitud"]);

          $("#editarlongitudcliente").val(response["longitud"]);

          $("#editarregimencliente").val(response["regimen"]);

          $("#editarpin_p12").val(response["pin_p12"]);

          $("#editarusuario_token").val(response["usuario_token"]);

          $("#editarcontrasena_token").val(response["contrasena_token"]);

          $("#editarpin_p12_prueba").val(response["pin_p12_prueba"]);

          $("#editarusuario_token_prueba").val(response["usuario_token_prueba"]);
         
         $("#editarcontrasena_token_prueba").val(response["contrasena_token_prueba"]);
        }, 
           error: function(response, err){console.log('my message ' + err + " " + response + " " + ClientId );}



      });

     })







function capitalizarPrimeraLetra(str) {
  return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

// capitalizarPrimeraLetra(string);




       /*=============================================
    =              ACTIVATE USER                 =
     ==========================================*/

$(document).on("click", ".btnActivatarClientes", function(){

     var userId = $(this).attr("userId");

     var userStatus = $(this).attr("userStatus");

   

     var data = new FormData();

     data.append("userId",userId);

     data.append("userStatus",userStatus);

     $.ajax({

          url:"ajax/clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
            // console.log("response", response);

         Swal.fire(
      "Actualización exitosa!",
      "El usuario ha sido actualizado",
      "success"
    ).then((result) => {

  window.location = "clientes";
    })    

        



               },
           error: function(response, err){ console.log('my message ' + err + " " + response + " " + userStatus );}


     })


if(userStatus == "No"){

     $(this).removeClass("btn-success");

     $(this).addClass("btn-danger");

     $(this).html("Desactivado");

     $(this).attr("userStatusMasivo","Si");

}else {

     $(this).removeClass("btn-danger");

     $(this).addClass("btn-success");

     $(this).html("Activado");

     $(this).attr("userStatusMasivo","No");


}



})

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}




$(".validarcorreo").change(function(){
$(".alert").remove();

  const email = $(this).val();

  if (validateEmail(email)) {
   
  } else {
      $(this).val("");  
      $(this).parent().after('<div class="alert alert-warning">Formato de correo no válido! </div>');

  }
  return false;
  })

   /*=============================================
    =              VALIDAR CEDULAS DUPLICADAS                =
     ==========================================*/
 
$("#agregarcedulacliente").change(function(){
 
$(".alert").remove();

var cedula = $(this).val();

var data = new FormData();

data.append("cedula",cedula); 

     $.ajax({

          url:"ajax/clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",  

          success: function(response){
            // console.log("response", response);


            if (typeof response !== 'undefined' && response.length > 0) {
      $("#agregarcedulacliente").parent().after('<div class="alert alert-warning">Esta cédula ya existe en la base de datos </div>');

                        $("#agregarcedulacliente").val("");    
}else{

}
 
           

               },
           error: function(response, err){ console.log('my message ' + err + " " + response + " " + cedula );}
     })
})



    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
    $("#agregarlatitudcliente").val(position.coords.latitude);  

   $("#agregarlongitudcliente").val(position.coords.longitude);  
        },
  
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }



$(document).ready(function() {

let Rol = sessionStorage.getItem('rol');
let empresa;

if(Rol == "Administrador"){

  empresa = "%";

}else{

  empresa = sessionStorage.getItem('empresa');

}

// $.ajax({

         
//           url:'ajax/datatable-clients.ajax.php?idEmpresa='+empresa,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });


console.log(Rol);
console.log(empresa);

 var table = $("#tablaclientes").DataTable({

       "ajax": 'ajax/datatable-clients.ajax.php?idEmpresa='+empresa,  
       "async": "false",

      "responsive": true, "lengthChange": false, 
      "autoWidth": true,
   "deferRender": true,
  "retrieve": true,
  "processing": true,
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

  },
  initComplete: function () {
                table.buttons().container()
                    .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
            }

    })
  

});

   


//  Rol = sessionStorage.getItem('rol'); 

// $.ajax({

         
//           url:'ajax/datatable-clients.ajax.php?Rol='+Rol,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });


      

      //CARGAR TODOS LOS CANTONES DONDE LA PROVINCIA SEA LA QUE TRAE EL PARAMETRO
$(".tipocedula").change(function(){
      
     

  var tipo = $(this).val();
  if(tipo=="Cédula Física"){
    $('.cedula').attr('maxlength', 9);
    $('.cedula').attr('minlength', 9);
  }else  if(tipo=="Pasaporte"){
    $('.cedula').attr('maxlength', 12);
    $('.cedula').attr('minlength', 9);
  }else  if(tipo=="Cédula Jurídica"){
    $('.cedula').attr('maxlength', 10);
    $('.cedula').attr('minlength', 10);
    }else  if(tipo=="DIMEX"){
    $('.cedula').attr('maxlength', 12);
    $('.cedula').attr('minlength', 11);
  }



})


//CARGAR TODOS LOS CANTONES DONDE LA PROVINCIA SEA LA QUE TRAE EL PARAMETRO
$("#editarprovinciaempresas").change(function(){
      

 //  var combo = document.getElementById("editarprovinciaempresas");
 // var varProvincia = combo.options[combo.selectedIndex].text;

let varProvincia = $(this).val();


 console.log("varProvincia", varProvincia);

      

    var data = new FormData();

    data.append("varProvincia",varProvincia);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function(response){
              // console.log("response", response);
            $("#editarcantonempresas").empty();
            $("#editardistritoempresas").empty();
            $("#editardistritoempresas").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                         $("#editarcantonempresas").append('<option disabled selected value="">Seleccionar Canton</option>');             
            for(var i = 0; i < response.length; i++){        
                 $("#editarcantonempresas").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
              }

            },

    })

})
//CARGAR TODOS LOS DISTRITOS DONDE EL CANTON SEA EL QUE TRAE EL PARAMETRO
$("#editarcantonempresas").change(function(){
      
 //  var combo = document.getElementById("editarcantonempresas");
 // var varCantones = combo.options[combo.selectedIndex].text;

  let varCantones =   $(this).val();
      //console.log(varCantones);
let varProvincia =  $('option:selected', '#editarprovinciaempresas').val();

  var data = new FormData();

    data.append("varCantones",varCantones);
    data.append("var_provincia",varProvincia);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function(response){
            $("#editardistritoempresas").empty();
            $("#editardistritoempresas").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
            for(var i = 0; i < response.length; i++){        
                 $("#editardistritoempresas").append('<option value="'+response[i]["iddistritos"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
              }

            },

    })
})

//CARGAR TODOS LOS CANTONES DONDE LA PROVINCIA SEA LA QUE TRAE EL PARAMETRO
$("#agregarprovinciaempresas").change(function(){
      
  // var combo = document.getElementById("agregarprovinciacliente");
 // var varProvincia = combo.options[combo.selectedIndex].text;
var varProvincia =  $(this).val();
     

    var data = new FormData();

    data.append("varProvincia",varProvincia);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            dataType: "json",

            success: function(response){
              // console.log("response", response);
            $("#agregarcantonempresas").empty();
            // $("#agregardistritocliente").empty();
            // $("#agregardistritocliente").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                         $("#agregarcantonempresas").append('<option disabled selected value="">Seleccionar Canton</option>');             
            for(var i = 0; i < response.length; i++){    

                 $("#agregarcantonempresas").append('<option value="'+response[i][0]+'">'+response[i][1]+'</option>');
              }

            },
            error: function(response, err){ console.log('my message ' + err + " " + response);}
    })

})

//CARGAR TODOS LOS DISTRITOS DONDE EL CANTON SEA EL QUE TRAE EL PARAMETRO
$("#agregarcantonempresas").change(function(){
   
  // var combo = document.getElementById("agregarcantoncliente");
 var varCantones = $(this).val();
var provincia = $('option:selected', '#agregarprovinciaempresas').val();
    
      //console.log(varCantones);


  var data = new FormData();

    data.append("varCantones",varCantones);
    data.append("var_provincia",provincia);
    
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            dataType: "json",

            success: function(response){
              console.log("response", response);
            $("#agregardistritoempresas").empty();
            $("#agregardistritoempresas").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
            for(var i = 0; i < response.length; i++){        
                 $("#agregardistritoempresas").append('<option value="'+response[i]["iddistritos"]+'">'+response[i]["nombre"]+'</option>');
              }

            },
error: function(response, err){ console.log('my message ' + err + " " + response);}
    })
})



//! realizarn este proceso de forma dimanica 

$("#servicio_contratado").change(function(){

    if($(this).val() == "Facturacion-api"){

        $("#txt_empresa").removeAttr("hidden");
        $("#datos_empresa").removeAttr("hidden");
        $("#txt_pruebas").removeAttr("hidden");
        $("#datos_empresa_prueba").removeAttr("hidden");
        $("#pin_p12").attr("required",true);
        $("#usuario_token").attr("required",true);
        $("#contrasena_token").attr("required",true);
        $("#documento_p12").attr("required",true);

    }else if($(this).val() == "Facturacion-web"){

        $("#txt_empresa").removeAttr("hidden");
        $("#datos_empresa").removeAttr("hidden");
        $("#txt_pruebas").removeAttr("hidden");
        $("#datos_empresa_prueba").removeAttr("hidden");

    }else if($(this).val() == "Recaudacion"){

        $("#txt_empresa").attr("hidden",true);
        $("#datos_empresa").attr("hidden",true);
        $("#txt_pruebas").attr("hidden",true);
        $("#datos_empresa_prueba").attr("hidden",true);
        $("#pin_p12").removeAttr("required");
        $("#usuario_token").removeAttr("required");
        $("#contrasena_token").removeAttr("required");
        $("#documento_p12").removeAttr("required");

    }

 
})


// $("#frmClientes").on("click", "input.chkUsuarioExistente", function(){
// $(".chkUsuarioExistente").click(function(){
// $('#chkUsuarioExistente').on('click', function () {

// console.log("Yes you are following ");


// // var chkItem = $("#chkUsuarioExistente");



//     // if($(chkItem).is("checked"))
//     // {
//     //     console.log("Yes you are following ");
//     // }
//     // else{console.log("No you are not following");}
// });



$(".chkUsuarioExistente").on('ifChecked', function(event){

$("#idnombre").attr("hidden",true);
$("#agregarnombre").removeAttr("required");
$("#agregarnombre").val("");

$("#idusuario").attr("hidden",true);
$("#agregarusuario").removeAttr("required");
$("#agregarusuario").val("");

$("#idcontrasena").attr("hidden",true);
$("#agregarcontrasena").removeAttr("required");
$("#agregarcontrasena").val("");

$("#idprivilegio").attr("hidden",true);
$("#privilegio").removeAttr("required");
$("#privilegio").val("");

$("#usuarioExistente").removeAttr("hidden");
$("#Usuarioempresas").attr("required",true);


});


$(".chkUsuarioExistente").on('ifUnchecked', function(event){

$("#usuarioExistente").attr("hidden",true);
$("#Usuarioempresas").removeAttr("required");



$("#idnombre").removeAttr("hidden");
$("#agregarnombre").attr("required",true);

$("#idusuario").removeAttr("hidden"); 
$("#agregarusuario").attr("required",true); 

$("#idcontrasena").removeAttr("hidden");
$("#agregarcontrasena").attr("required",true);

$("#idprivilegio").removeAttr("hidden");
$("#privilegio").attr("required",true);


});


// $("#servicio_contratado").select2({ 

//     width : 'resolve',
//     theme: "classic",
//     placeholder: 'Seleccionar Usuario'

// });

 



/*=============================================
=            Previsualizar fotos            =
=============================================*/

$(".logoempresa").change(function(){

  var image = this.files[0];
  //console.log("image", image);

/*=============================================
=FILTER FORMAT PICTURE ONLY PNG - JPG        =
=============================================*/

if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

  $(".logoempresa").val("");

  swal({

        type: "error",
        text: "La imagen debe estar en formato JPG o PNG",
        title: "¡Error al subir la imagen!",
        confirmButtonText: "Cerrar"

      }); 

} else if(image["size"] > 4000000){

  $(".logoempresa").val("");

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

    $("#logoempresa_vista").attr("src",ImageRoute);



  })

}

})

//! realizarn este proceso de forma dimanica 
$("#editarservicio_contratado").change(function(){

    if($(this).val() == "Facturacion-api"){

        $("#txt_empresa_editar").removeAttr("hidden");
        $("#datos_empresa_editar").removeAttr("hidden");
        $("#txt_pruebas_editar").removeAttr("hidden");
        $("#datos_empresa_prueba_editar").removeAttr("hidden");
        $("#editarpin_p12").attr("required",true);
        $("#editarusuario_token").attr("required",true);
        $("#editarcontrasena_token").attr("required",true);
        $("#editardocumento_p12").attr("required",true);

    }else if($(this).val() == "Facturacion-web"){

        $("#txt_empresa_editar").removeAttr("hidden");
        $("#datos_empresa_editar").removeAttr("hidden");
        $("#txt_pruebas_editar").removeAttr("hidden");
        $("#datos_empresa_prueba_editar").removeAttr("hidden");

    }else if($(this).val() == "Recaudacion"){

        $("#txt_empresa_editar").attr("hidden",true);
        $("#datos_empresa_editar").attr("hidden",true);
        $("#txt_pruebas_editar").attr("hidden",true);
        $("#datos_empresa_prueba_editar").attr("hidden",true);
        $("#editarpin_p12").removeAttr("required");
        $("#editarusuario_token").removeAttr("required");
        $("#editarcontrasena_token").removeAttr("required");
        $("#editardocumento_p12").removeAttr("required");

    }


    $("#editarservicio_contratado").val();
    
    let servicios = $("#editarservicio_contratado").val();

    $("#servContratado").val("");
    
    $("#servContratado").val(servicios);

    console.log($("#servContratado").val());
})

 

$("#servicio_contratado").change(function(){

let planes = $(this).val();


for(var i = 0; i < planes.length; i++){

    for(var j = 0; j < planes.length; j++){

      if(planes[i] == "Facturacion-api" && planes[j] == "Facturacion-web"){

        Swal.fire(
          '¡Planes Incorrectos!',
          'Imposible Seleccionar Facturacion-API y Facturacion-WEB en el mismo cliente',
          'error'
        ); 

        $("#servicio_contratado option:selected").prop("selected", false);
        

      }


    }


}


});



$("#editarservicio_contratado").change(function(){

  let planes = $(this).val();
  
  
  for(var i = 0; i < planes.length; i++){
  
      for(var j = 0; j < planes.length; j++){
  
        if(planes[i] == "Facturacion-api" && planes[j] == "Facturacion-web"){
  
          Swal.fire(
            '¡Planes Incorrectos!',
            'Imposible Seleccionar Facturacion-API y Facturacion-WEB en el mismo cliente',
            'error'
          ); 
  
          $("#editarservicio_contratado option:selected").prop("selected", false);
          
  
        }
  
  
      }
  
  
  }
  
  
  });