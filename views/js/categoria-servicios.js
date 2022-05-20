

     
  /*=============================================
    =                   EDIT USER                 =
     =============================================*/

     $(document).on("click", ".btnEditCategoriaServicio", function(){

      var CategoriaServicioId = $(this).attr("CategoriaServicioId");

  var data = new FormData();

      data.append("CategoriaServicioId",CategoriaServicioId);

      $.ajax({

        url:"ajax/categoria-servicios.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async:false,
        dataType: "json",
        success: function(response){
          console.log("response",response);

          $("#editarcodigocategoriaservicio").val(response["codigo"]);
          $("#editarnombrecategoriaservicio").val(response["nombre"]);
          $("#editarpalabraclavecategoriaservicio").val(response["palabra_clave"]);

 



    
        }, 
           error: function(response, err){console.log('my message ' + err + " " + response + " " + ClientId );}



      });

     })



       /*=============================================
    =              ACTIVATE USER                 =
     ==========================================*/

$(document).on("click", ".btnActivatarCategoriaServicios", function(){

     var userId = $(this).attr("userId");

     var userStatus = $(this).attr("userStatus");

   

     var data = new FormData();

     data.append("userId",userId);

     data.append("userStatus",userStatus);

     $.ajax({

          url:"ajax/categoria-servicios.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success: function(response){
/*            console.log("response", response);
*/
         Swal.fire(
      "Actualización exitosa!",
      "El usuario ha sido actualizado",
      "success"
    ).then((result) => {

  window.location = "categoria-servicios";
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



   /*=============================================
    =              VALIDAR CEDULAS DUPLICADAS                =
     ==========================================*/

$("#agregarnombrecategoriaservicio").change(function(){
 
$(".alert").remove();

var varcategoriaservicio = $(this).val();

var data = new FormData();

data.append("varcategoriaservicio",varcategoriaservicio); 

     $.ajax({

          url:"ajax/categoria-servicios.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",  

          success: function(response){
/*            console.log("response", response);
*/

            if (typeof response !== 'undefined' && response.length > 0) {
      $("#agregarnombrecategoriaservicio").parent().after('<div class="alert alert-warning">Esta categoria de servicios ya existe en la base de datos </div>');

                        $("#agregarnombrecategoriaservicio").val("");    
}else{

}
 
           

               },
           error: function(response, err){ console.log('my message ' + err + " " + response + " " + cedula );}
     })
})





var Rol ; 

Rol = sessionStorage.getItem('rol'); 


$(document).ready(function() {
 var table = $("#tablacategoriadeservicios").DataTable({

       "ajax": 'ajax/datatable-categoria-servicios.ajax.php?Rol='+Rol,  
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

   


/* Rol = sessionStorage.getItem('rol'); 

$.ajax({

         
          url:'ajax/datatable-categoria-servicios.ajax.php?Rol='+Rol,
          async: false,
          success: function(response){

       
       console.log("respuesta",response);
              
             },

      });
*/

      

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
$("#editarprovinciacliente").change(function(){
      
 

  var combo = document.getElementById("editarprovinciacliente");
 var varProvincia = combo.options[combo.selectedIndex].text;

      

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
              //console.log("response", response);
            $("#editarcantoncliente").empty();
            $("#editardistritocliente").empty();
            $("#editardistritocliente").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                         $("#editarcantoncliente").append('<option disabled selected value="">Seleccionar Canton</option>');             
            for(var i = 0; i < response.length; i++){        
                 $("#editarcantoncliente").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
              }

            },

    })

})
//CARGAR TODOS LOS DISTRITOS DONDE EL CANTON SEA EL QUE TRAE EL PARAMETRO
$("#editarcantoncliente").change(function(){


      
  var combo = document.getElementById("editarcantoncliente");
 var varCantones = combo.options[combo.selectedIndex].text;

     
      //console.log(varCantones);


  var data = new FormData();

    data.append("varCantones",varCantones);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function(response){
            $("#editardistritocliente").empty();
            $("#editardistritocliente").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
            for(var i = 0; i < response.length; i++){        
                 $("#editardistritocliente").append('<option value="'+response[i]["iddistritos"]+'">'+response[i]["nombre"]+'</option>');
              }

            },

    })
})

//CARGAR TODOS LOS CANTONES DONDE LA PROVINCIA SEA LA QUE TRAE EL PARAMETRO
$("#agregarprovinciacliente").change(function(){
      
 

  var combo = document.getElementById("agregarprovinciacliente");
 var varProvincia = combo.options[combo.selectedIndex].text;

      

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
              console.log("response", response);
            $("#agregarcantoncliente").empty();
            $("#agregardistritocliente").empty();
            $("#agregardistritocliente").append('<option disabled selected value="">Seleccionar Distrito</option>');   
                         $("#agregarcantoncliente").append('<option disabled selected value="">Seleccionar Canton</option>');             
            for(var i = 0; i < response.length; i++){        
                 $("#agregarcantoncliente").append('<option value="'+response[i]["idcantones"]+'">'+response[i]["nombre"]+'</option>');
              }

            },

    })

})
//CARGAR TODOS LOS DISTRITOS DONDE EL CANTON SEA EL QUE TRAE EL PARAMETRO
$("#agregarcantoncliente").change(function(){


      
  var combo = document.getElementById("agregarcantoncliente");
 var varCantones = combo.options[combo.selectedIndex].text;

     
      //console.log(varCantones);


  var data = new FormData();

    data.append("varCantones",varCantones);
  
     $.ajax({
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function(response){
            $("#agregardistritocliente").empty();
            $("#agregardistritocliente").append('<option disabled selected value="">Seleccionar Distrito</option>');                     
            for(var i = 0; i < response.length; i++){        
                 $("#agregardistritocliente").append('<option value="'+response[i]["iddistritos"]+'">'+response[i]["nombre"]+'</option>');
              }

            },

    })
})