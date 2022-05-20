$(document).ready(function() {
    if ( $.fn.DataTable.isDataTable('#tablaMercadoClientes') ) {
    $('#tablaMercadoClientes').DataTable().destroy();
  }
   var table = $("#tablaMercadoClientes").DataTable({
  
    "ajax": 'ajax/datatable-merchandising-clientes.ajax.php?dato='+clientesEmpresas,  
    "async": "false",
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": true,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    "language": {
  
      "sProcessing":     '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
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
      "sLoadingRecords": '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
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
                  // table.buttons().container()
                  //     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
              }
  
      })
    
  });


$("#frmclientProvinciaMerc").change(function(){
      

    let varProvincia = $(this).val();
    
    cargarComboCantones(varProvincia);
          
    
    })


$("#frmclientCantonMerc").change(function(){
      
    let varCantones =   $(this).val();
  
    let provincia = $('option:selected', '#frmclientProvinciaMerc').val();
   
   
    cargarComboDistritos(varCantones,provincia);
  
  })


  $("#frmclientCorreoMerc").change(function(){
    $(".alert").remove();
    
      const email = $(this).val();
    
      if (validateEmail(email)) {
       
      } else {
          $(this).val("");  
          $(this).parent().after('<div class="alert alert-warning">Formato de correo no válido! </div>');
    
      }
      return false;
      })

      

$("#frmclientcedulasearchMerc").click(function(){
    $('#overlay').fadeIn() 
let cedula = $("#frmclientlblcedulasearchMerc").val();

    var data = new FormData();
    
        data.append("CedulaSearch", cedula); 

            $.ajax({
        
                  url:"ajax/merchandising-clientes.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
                    $('#overlay').fadeOut();
    
                    // console.log("response", response);
                if(response != ""){
                    
                    
                    $("#frmclientNombreMerc").val(response["results"][0].fullname);
                    $("#frmclientCedulaMerc").val(response["results"][0].cedula);

                    if(response["results"][0].guess_type == "FISICA"){

                        $('#frmclientTcedulaMerc').val("01");
                  
                      }else if (response["results"][0].guess_type == "JURIDICA"){
                  
                        $('#frmclientTcedulaMerc').val("02");
                  
                      }else if (response["results"][0].guess_type == "DIMEX/NITE"){
                  
                        $('#frmclientTcedulaMerc').val("03");
                  
                      }
                    
                }
    
    
            },
    
        error: function(response, err){ console.log('my message ' + err + " " + response );}
    
    })


});

$(".btnGuardarClienteMerc").click(function(){

//ingresar datos del cliente 
$('#overlay').fadeIn() ;
// setTimeout(function(){
  $(this).attr('disabled','disabled');

let id_empresa =  $('option:selected', '#empresaheader').val();
let nombre = $('#frmclientNombreMerc').val();
let cedula = $('#frmclientCedulaMerc').val();
let tipo_cedula = $('option:selected', '#frmclientTcedulaMerc').val();
let correo = $('#frmclientCorreoMerc').val();
let telefono = $('#frmclientTelefonoMerc').val();
let provincia = $('option:selected', '#frmclientProvinciaMerc').val();
let canton = $('option:selected', '#frmclientCantonMerc').val();
let distrito = $('option:selected', '#frmclientDistritoMerc').val();
let direccion = $('#frmclientDireccionMerc').val();
let diasVisita = JSON.stringify($('#diaVisitaMerc').val());
let latitud = $('#frmclientLatitudMerc').val();
let longitud = $('#frmclientLongitudMerc').val();


if(id_empresa == "" || id_empresa == null){

  $('#overlay').fadeOut();
    Swal.fire(
                    "Aviso",
                    "Seleccione la empresa  que desea asignar el producto",
                    "warning"
                  ).then((result) => {

                    
                // window.location = "reporte-sistema-facturacion";
                  }) 


          return false;

  }



if(validarCedula(cedula, id_empresa) == "1"){
  $('#overlay').fadeOut();
return false;

}


if(nombre == "" || cedula == "" || tipo_cedula == "" || correo == "" || telefono =="" || provincia =="" || canton =="" || distrito =="" || diasVisita == ""){
  $('#overlay').fadeOut();
    Swal.fire(
        "Aviso",
        "Todos los datos son necesario, no dejar campos vacios.",
        "warning"
    ).then((result) => {                   
    // window.location = "reporte-sistema-facturacion";
    }) 

          return false;

}else{

  if(cedula.length > 9 && tipo_cedula == "01"){

    Swal.fire(
      "Aviso",
      "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 9 digitos maximo",
      "warning"
    ).then((result) => {
  
    }) 
    return false;
  }else if(cedula.length > 11 && tipo_cedula == "02"){
  
    Swal.fire(
      "Aviso",
      "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 10 digitos maximo",
      "warning"
    ).then((result) => {
  
    })
    return false;
  }else if(cedula.length > 13 && tipo_cedula == "03"){
  
    Swal.fire(
      "Aviso",
      "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 12 digitos maximo",
      "warning"
    ).then((result) => {
  
    })
    return false;
  }


var data = new FormData();
$('#overlay').fadeOut();

    data.append("empresa",id_empresa); 
    data.append("nombre",nombre.trim());
    data.append("cedula",cedula.trim());
    data.append("tipo_cedula",tipo_cedula);
    data.append("correo",correo.trim());
    data.append("telefono",telefono.trim());
    data.append("provincia",provincia);
    data.append("canton",canton);       
    data.append("distrito",distrito);
    data.append("direccion",direccion);
    data.append("diasVisita",diasVisita);
    data.append("latitud",latitud);
    data.append("longitud",longitud);
 
        $.ajax({
    
              url:"ajax/merchandising-clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              // dataType: "json",  
              success: function(response){

                console.log("response", response);

            if(response.trim() == "ok"){
            $('#overlay').fadeOut();

            Swal.fire(
                "Aviso",
                "Datos ingresados correctamente.",
                "success"
                ).then((result) => {
                                
                window.location = "merchandising-clientes";
                }) 



            }else{

            $('#overlay').fadeOut();

            Swal.fire(
                "Fallo",
                "Error al ingresar los datos intente nuevamente.",
                "error"
                ).then((result) => {
                                
                window.location = "merchandising-clientes";
                }) 

            }


            },

                        error: function(response, err){ console.log('my message ' + err + " " + response );}

                    })


            }

            // },350)

});



  function cargarComboCantones(Provincia){



    var data = new FormData();
  
    data.append("varProvincia",Provincia);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            async: false,
            success: function(response){
              
              if($('#modalClientes').is(':visible')){
  
                $("#frmclientCanton").empty();
                $("#frmclientDistrito").empty();
                $("#frmclientDistrito").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                             $("#frmclientCanton").append('<option disabled selected value="">Seleccionar Canton</option>');             
                for(var i = 0; i < response.length; i++){        
                     $("#frmclientCanton").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
                  }
  
              }else{
  
                $("#frmclientCantonMerc").empty();
                $("#frmclientDistritoMerc").empty();
                $("#frmclientDistritoMerc").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                             $("#frmclientCantonMerc").append('<option disabled selected value="">Seleccionar Canton</option>');             
                for(var i = 0; i < response.length; i++){        
                     $("#frmclientCantonMerc").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
                  }
  
              }
  
  
  
            },
  
    })
  
   
  }



  function cargarComboDistritos(canton, provincia){


    var data = new FormData();
  
      data.append("varCantones",canton);
      data.append("var_provincia",provincia);
       $.ajax({
              url:"ajax/clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              async: false,
              success: function(response){
  
                // console.log(response);
  
                if($('#modalClientes').is(':visible')){
              
                  $("#frmclientDistrito").empty();
                  $("#frmclientDistrito").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
                  for(var i = 0; i < response.length; i++){        
                   $("#frmclientDistrito").append('<option value="'+response[i]["iddistritos"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
                  }
  
                }else{
  
                  $("#frmclientDistritoMerc").empty();
                  $("#frmclientDistritoMerc").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
                  for(var i = 0; i < response.length; i++){        
                       $("#frmclientDistritoMerc").append('<option value="'+response[i]["iddistritos"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
                    }
  
                } 
             
  
              },
  
      })
  
  
  }




  function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  
  getLocationMerchandising();
  
  function getLocationMerchandising() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}



function showPosition(position) {
    /* console.log("Latitude: " + position.coords.latitude + 
      " Longitude: " + position.coords.longitude);*/

    if (position.coords.latitude == "") {
        console.log("NO GPS");
    }

    $("#frmclientLatitudMerc").val(position.coords.latitude);

    $("#frmclientLongitudMerc").val(position.coords.longitude);


}  


function  validarCedula(cedula, idmpresa){

    $(".alert").remove();
    
    var respuesta;
    
    var data = new FormData();
    
        data.append("empresaVal",idmpresa); 
        data.append("cedulaVal",cedula.trim());
       
    
             $.ajax({
         
                  url:"ajax/sistema-facturas-clientes.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
    
                if(response[0] == "1"){
    
              $('#frmclientCedulaMerc').parent().after('<div class="alert alert-warning">Cliente ya existe en Sistema! </div>');
    
    
                respuesta =  "1";
    
                }else{
    
                respuesta =  "0";
    
                }
        
            },
    
                error: function(response, err){ console.log('my message ' + err + " " + response );}
    
             })
    
        return respuesta;
    
        
    }