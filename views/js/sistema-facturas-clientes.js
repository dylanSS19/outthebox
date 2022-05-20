var clientesEmpresas ; 

clientesEmpresas = "ok"; 

// $.ajax({ 

           
//            url:'ajax/datatable-sistema-facturas-clientes.ajax.php?dato='+clientesEmpresas,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        });

$(document).ready(function() {
  if ( $.fn.DataTable.isDataTable('#tablaReportClientes') ) {
  $('#tablaReportClientes').DataTable().destroy();
}
 var table = $("#tablaReportClientes").DataTable({

  "ajax": 'ajax/datatable-sistema-facturas-clientes.ajax.php?dato='+clientesEmpresas,  
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




function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}



$("#frmclientCorreoE").change(function(){
$(".alert").remove();

  const email = $(this).val();

  if (validateEmail(email)) {
   
  } else {
      $(this).val("");  
      $(this).parent().after('<div class="alert alert-warning">Formato de correo no válido! </div>');

  }
  return false;
  })


  $("#frmclientCorreo").change(function(){
    $(".alert").remove();
    
      const email = $(this).val();
    
      if (validateEmail(email)) {
       
      } else {
          $(this).val("");  
          $(this).parent().after('<div class="alert alert-warning">Formato de correo no válido! </div>');
    
      }
      return false;
      })


//CARGAR TODOS LOS CANTONES DONDE LA PROVINCIA SEA LA QUE TRAE EL PARAMETRO
$("#frmclientProvincia").change(function(){
      

let varProvincia = $(this).val();

cargarComboCantones(varProvincia);
      

})


$("#frmclientCanton").change(function(){
      
  let varCantones =   $(this).val();

  let provincia = $('option:selected', '#frmclientProvincia').val();
 
 
  cargarComboDistritos(varCantones,provincia);

})

$("#frmclientProvinciaE").change(function(){
      

  let varProvincia = $(this).val();
  
  cargarComboCantones(varProvincia);
        
  
  })
  
  
  $("#frmclientCantonE").change(function(){
        
    let varCantones =   $(this).val();
    let provincia = $('option:selected', '#frmclientProvinciaE').val();
 
 
    cargarComboDistritos(varCantones,provincia);
  
  })

$("#frmclientcedulasearch").click(function(){

let cedula = $('#frmclientlblcedulasearch').val();

$('#frmclientcedulaSearch2').val(cedula);

buscarClintesCedula(cedula);


$('#modalBuscarCliente').modal('show'); // abrir

 
})

$("#frmclientcedulasearchE").click(function(){

  let cedula = $('#frmclientlblcedulasearchE').val();
  
  $('#frmclientcedulaSearch2').val(cedula);
  
  buscarClintesCedula(cedula);
  
  
  $('#modalBuscarCliente').modal('show'); // abrir
  
   
  })


function  buscarClintesCedula(cedulaBuscar){


if ( $.fn.DataTable.isDataTable('#tablaclientessearch') ) {
  $('#tablaclientessearch').DataTable().destroy();
}


  // var table = $('#tablaProductos').removeAttr('width').DataTable( {
         var table = $("#tablaclientessearch").DataTable({

               "ajax": 'ajax/datatable-sistema-facturas-search-cedula.ajax.php?cedulaSearch='+cedulaBuscar,  
               "async": "false",
               "columnDefs": [
      { "width": "10%", "targets": 0 }
    ],
    "fixedColumns": true,
          "responsive": true, 
          "lengthChange": true, 
          "autoWidth": false,
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
          initComplete: function customEvent(e){
       // table.search(e.value).draw(table.responsive.recalc());  ///Must trigger the draw event, but move on to the next line while it's being processed/
         // Essentially has no effect.
  }



            })

$(".alert").remove();

}





$(".BuscarCliente").click(function(){

  let cedulaBuscar = $('#frmclientcedulaSearch2').val();


buscarClintesCedula(cedulaBuscar);

  // $.ajax({

           
  //           url:'ajax/datatable-sistema-facturas-search-cedula.ajax.php?cedulaSearch='+cedulaBuscar,
  //           async: false,
  //            // dataType: "json",
  //           success: function(response){

         
  //        console.log("respuesta",response);
                
  //              },

  //       });


// $('#modalBuscarCliente').modal('show'); // abrir

 
})

$("#tablaclientessearch").on("click", "button.btnCedulaSearch", function(){

let cedula = $(this).attr('ced');
let nombre = $(this).attr('nom');
let tipo_cedula = $(this).attr('idtipo');


if($('#modalClientes').is(':visible')){

  $('#frmclientCedula').val(cedula);
  $('#frmclientNombre').val(nombre);
  
  if(tipo_cedula == "FISICA"){
  
   const option = document.querySelector('#frmclientTcedula');
    const valor = "01";
    option.value = valor;
  
  
  }else if(tipo_cedula == "JURIDICA"){
  
   const option = document.querySelector('#frmclientTcedula');
    const valor = "02";
    option.value = valor;
  
  }else if(tipo_cedula == "DIMEX/NITE"){
  
   const option = document.querySelector('#frmclientTcedula');
    const valor = "03";
    option.value = valor;
  
  
  }
  
  $('#frmclientcedulaSearch2').val('');
  if ( $.fn.DataTable.isDataTable('#tablaclientessearch') ) {
    $('#tablaclientessearch').DataTable().destroy();
  }


}else{

  $('#frmclientCedulaE').val(cedula);
  $('#frmclientNombreE').val(nombre);
  
  if(tipo_cedula == "FISICA"){
  
   const option = document.querySelector('#frmclientTcedulaE');
    const valor = "01";
    option.value = valor;
  
  
  }else if(tipo_cedula == "JURIDICA"){
  
   const option = document.querySelector('#frmclientTcedulaE');
    const valor = "02";
    option.value = valor;
  
  }else if(tipo_cedula == "DIMEX/NITE"){
  
   const option = document.querySelector('#frmclientTcedulaE');
    const valor = "03";
    option.value = valor;
  
  
  }
  
  $('#frmclientcedulaSearch2').val('');
  if ( $.fn.DataTable.isDataTable('#tablaclientessearch') ) {
    $('#tablaclientessearch').DataTable().destroy();
  }

}


$('#modalBuscarCliente').modal('hide'); 

});




$("#frmclientlblcedulasearch").keypress(function(e) {

let iChars = "abcdefghijklmnñopqrsABCDEGGHIJKLMNÑOPQRS!#$%^&*()+=[]\\\';/{}|\":<>?¿/°";
/*=============================================
=         PERMITE EL INGRESO DE - , @           =
=============================================*/
    if (iChars.indexOf(e.key) != -1) {
        // alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
        return false;
    }

 });


$(".btnGuardarCliente").click(function(){

  $('#overlay').fadeIn() ;
  setTimeout(function(){
    $(this).attr('disabled','disabled');

  let id_empresa =  $('option:selected', '#empresaheader').val();
  let nombre = $('#frmclientNombre').val();
  let cedula = $('#frmclientCedula').val();
  let tipo_cedula = $('option:selected', '#frmclientTcedula').val();
  let correo = $('#frmclientCorreo').val();
  let telefono = $('#frmclientTelefono').val();
  let provincia = $('option:selected', '#frmclientProvincia').val();
  let canton = $('option:selected', '#frmclientCanton').val();
  let distrito = $('option:selected', '#frmclientDistrito').val();
  let direccion = $('#frmclientDireccion').val();
  let listaPrecio = $('option:selected','#listaPrecio').val();
  console.log("listaCliente: ",listaPrecio.trim());

  // console.log("tipo_cedula", tipo_cedula);
  //  return false;


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


  console.log("validarCedula(cedula, id_empresa)", validarCedula(cedula, id_empresa));
  if(validarCedula(cedula, id_empresa) == "1"){
    $('#overlay').fadeOut();
  return false;

  }



  if(nombre == "" || cedula == "" || tipo_cedula == "" || correo == "" || telefono =="" || provincia =="" || canton =="" || distrito =="" || listaPrecio == ""){
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
      data.append("listaPrecio",listaPrecio);
          $.ajax({
      
                url:"ajax/sistema-facturas-clientes.ajax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                // dataType: "json",  
                success: function(response){

                  // console.log("response", response);

  if(response.trim() == "ok"){
    $('#overlay').fadeOut();

  Swal.fire(
        "Aviso",
        "Datos ingresados correctamente.",
        "success"
        ).then((result) => {
                      
      window.location = "sistema-facturas-clientes";
      }) 



  }else{

    $('#overlay').fadeOut();

  Swal.fire(
        "Fallo",
        "Error al ingresar los datos intente nuevamente.",
        "error"
        ).then((result) => {
                      
      window.location = "sistema-facturas-clientes";
      }) 




  }






  },

                error: function(response, err){ console.log('my message ' + err + " " + response );}

          })


  }


},350)
});





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

          $('#frmclientCedula').parent().after('<div class="alert alert-warning">Cliente ya existe en Sistema! </div>');


            respuesta =  "1";

            }else{

            respuesta =  "0";

            }



        },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })

return respuesta;



}


$("#tablaReportClientes").on("click", "button.btnClient", function(){


let cliente = $(this).attr('idclient');

var data = new FormData();

    data.append("idcliente",cliente); 

   

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
// console.log(response);
cargarComboCantones(response[0]['provincia']);
cargarComboDistritos(response[0]['canton'], response[0]['provincia']);
$('#frmclientNombreE').val(response[0]['Nombre']);
$('#frmclientTcedulaE').val(response[0]['tipo_cedula']);
$('#frmclientCedulaE').val(response[0]['cedula']);
$('#frmclientCorreoE').val(response[0]['correo']);
$('#frmclientTelefonoE').val(response[0]['telefono']);
$('#frmclientProvinciaE').val(response[0]['provincia']);
$('#frmclientCantonE').val(response[0]['canton']);
$('#frmclientDistritoE').val(response[0]['distrito']);
$('#frmclientDireccionE').val(response[0]['direccion']);
$('#id_clienteE').val(response[0]['idtbl_empresas_clientes']);
$('#editarListaPrecio').val(response[0]['Tipo_lista']);

        },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })

});

$(".btnEditarCliente").click(function(){
  $('#overlay').fadeIn() ;
  setTimeout(function(){
    $(this).attr('disabled','disabled');
    let id_cliente =  $('#id_clienteE').val();
    let nombre = $('#frmclientNombreE').val();
    let cedula = $('#frmclientCedulaE').val();
    let tipo_cedula = $('option:selected', '#frmclientTcedulaE').val();
    let correo = $('#frmclientCorreoE').val();
    let telefono = $('#frmclientTelefonoE').val();
    let provincia = $('option:selected', '#frmclientProvinciaE').val();
    let canton = $('option:selected', '#frmclientCantonE').val();
    let distrito = $('option:selected', '#frmclientDistritoE').val();
    let direccion = $('#frmclientDireccionE').val();
    let tipoLista = $('#editarListaPrecio').val();
    
    // console.log(id_cliente);

    if(cedula.length > 9 && tipo_cedula == "01"){
      $('#overlay').fadeOut() ;
      Swal.fire(
        "Aviso",
        "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 9 digitos maximo",
        "warning"
      ).then((result) => {
    
      }) 
      return false;
    }else if(cedula.length > 11 && tipo_cedula == "02"){
      $('#overlay').fadeOut() ;
      Swal.fire(
        "Aviso",
        "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 10 digitos maximo",
        "warning"
      ).then((result) => {
    
      })
      return false;
    }else if(cedula.length > 13 && tipo_cedula == "03"){
      $('#overlay').fadeOut() ;
      Swal.fire(
        "Aviso",
        "El tipo de cédula no coincide con la longitud digitada en el campo (cédula), tipo Fisico 12 digitos maximo",
        "warning"
      ).then((result) => {
    
      })
      
      return false;
    }


    var data = new FormData();

    data.append("idclienteE",id_cliente); 
    data.append("nombreE",nombre.trim());
    data.append("cedulaE",cedula.trim());
    data.append("tipo_cedulaE",tipo_cedula);
    data.append("correoE",correo.trim());
    data.append("telefonoE",telefono.trim());
    data.append("provinciaE",provincia);
    data.append("cantonE",canton);       
    data.append("distritoE",distrito);
    data.append("direccionE",direccion.trim());
    data.append("tipoListaE",tipoLista);

        $.ajax({
    
              url:"ajax/sistema-facturas-clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              // dataType: "json",  
              success: function(response){

                // console.log(response);

                $('#overlay').fadeOut() ;
                if(response.trim() == "ok"){

                  Swal.fire(
                        "Aviso",
                        "Datos ingresados correctamente.",
                        "success"
                        ).then((result) => {
                                      
                      window.location = "sistema-facturas-clientes";
                      }) 
                  
                  
                  
                  }else{
                  
                  
                  Swal.fire(
                        "Fallo",
                        "Error al ingresar los datos intente nuevamente.",
                        "error"
                        ).then((result) => {
                                      
                      window.location = "sistema-facturas-clientes";
                      }) 
                  
                  
                  
                  
                  }

              },

              error: function(response, err){ console.log('my message ' + err + " " + response );}

        })
      },350)

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

              $("#frmclientCantonE").empty();
              $("#frmclientDistritoE").empty();
              $("#frmclientDistritoE").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                           $("#frmclientCantonE").append('<option disabled selected value="">Seleccionar Canton</option>');             
              for(var i = 0; i < response.length; i++){        
                   $("#frmclientCantonE").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
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

                $("#frmclientDistritoE").empty();
                $("#frmclientDistritoE").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
                for(var i = 0; i < response.length; i++){        
                     $("#frmclientDistritoE").append('<option value="'+response[i]["iddistritos"]+'">'+capitalizarPrimeraLetra(response[i]["nombre"])+'</option>');
                  }

              } 
           

            },

    })


}


$("#btnNewListPrices").click(function(){
  $("#modalNuevaListaCliente").modal('show');
});

$("#btnNewListPricesModificar").click(function(){
  $("#modalNuevaListaCliente").modal('show');
})


$("#btnGuardarListaCliente").click(function () {
  $('#overlay').fadeIn() ;
  setTimeout(function () {

  
    let nombre = $("#nombreLista").val();
    let codigo = $("#codigoLista").val();

    if (nombre != "" && codigo != "") {
      var data = new FormData();

      data.append("nombreLista",nombre);
      data.append("codigoLista",codigo);
      $.ajax({
              url:"ajax/listas-precio.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
            // dataType: "json",
              async: false,
              success: function(response){
                $('#overlay').fadeOut() ;
                if(response =="ok") {
                  
                  $("#modalNuevaListaCliente").modal('hide');
                  
                  Swal.fire(
                      "Excelente",
                      "Se ha crado con éxito la nueva lista de precio.",
                      "success"
                  ).then((result) => { 
                    //Recargar el select y cerrar modal


                    $.ajax({
                      url:"ajax/listas-precio.ajax.php?cargaListas=cargar",
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType: "json",
                      async: false,
                      success: function(response){

                        $("#listaPrecio").empty();
                        $("#editarListaPrecio").empty();
                        

                        $(".listaPrecio").append('<option disabled selected value="">Seleccionar Lista De Precio</option>');                     
                        for(var i = 0; i < response.length; i++){        
                          $(".listaPrecio").append('<option value="'+response[i]["idtbl_listas_precio"]+'">'+response[i]["nombre"]+'</option>');
                        }

                      } 
                    
          
              })

                  }) 
                } else {
                  $('#overlay').fadeOut() ;
                  Swal.fire(
                    "Aviso",
                    "Error al crear la lista de precios, intente de nuevo.",
                    "error"
                  ).then((result) => {

                  
                  }) 
                }

              } 
            

      })
    } else {
      Swal.fire(
        "Error",
        "Todos los campos son requeridos, por favor, completa el formulario.",
        "error"
    ).then((result) => { 

    }) 
    }
  }, 350)
});

$("#frmclientCedula").keypress(function(e){

let tipoCed = $("option:selected", "#frmclientTcedula").val();

if(tipoCed == ""){

  Swal.fire(
    "Error",
    "Seleccione el tipo de personeria",
    "warning"
).then((result) => { 

})

$(this).val("");

return false;
}

if(tipoCed == "01"){

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;

  
}else if(tipoCed == "02"){

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;

}else if(tipoCed == "03"){

  patron = /[0-9]/;

}else if(tipoCed == "Pasaporte"){

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;

}

  tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final)

});  
