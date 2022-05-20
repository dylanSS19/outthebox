

var Rol ; 

Rol = "ok"; 





// $.ajax({

         
//           url:'ajax/datatable-mover-saldo-bodegas.ajax.php?Rol='+Rol,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });


$(document).ready(function() {
 var table = $("#tablamoversaldobodegas").DataTable({

       "ajax": 'ajax/datatable-mover-saldo-bodegas.ajax.php?Rol='+Rol,  
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






$ ( ".bodega_inicial" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});


$ ( ".bodega_final" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});

$ ( ".cliente" ). select2 ({ 

    width : 'resolve',
    theme: "classic"

});



$(".bodega_inicial").change(function(){


var var_bodega_inicial = $(this).val()

var data = new FormData();


data.append("var_bodega_inicial",var_bodega_inicial);  

$.ajax({

            url:"ajax/mover-saldo-bodegas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  

          success: function(response){

        $(".saldo").val(response[0])

         
          },
                error: function(response, err){ console.log('my message ' + err + " " + response );}
           })





 });




$(".saldo_transferir").change(function(){


if (Number($(this).val()) <= Number($(".saldo").val())){


}else{

if(Number($(this).val()) >  Number($(".saldo").val())){
  console.log("if($(this).val() >  $(\".saldo\").val())", $(this).val() >  $(".saldo").val());


Swal.fire(
      "Error!",
      "El monto a transferir no puede ser mayor al monto en bodega.",
      "error"
    ).then((result) => {

  // window.location = "clientes";
    }); 

$(this).val("0");

}else{




}

}


 });





$(".bodega_final").change(function(){


if($(this).val() == $(".bodega_inicial").val()){


Swal.fire(
      "Error!",
      "No se puede transferir saldo a la misma bodega.",
      "error"
    ).then((result) => {

  // window.location = "clientes";
    }); 

$(".btn_guardar_movimiento").prop('disabled', true);

}else{

$(".btn_guardar_movimiento").removeAttr("disabled");
// $(".btn_guardar_movimiento").remov("disabled", "");

}


});



$(".cliente").change(function(){

var var_bodegas = $(this).val()

 $("#bodega_inicial").empty();
 $("#bodega_final").empty();
 $("#bodega_inicial").append("<option selected disabled value=''>Seleccionar...</option>");
 $("#bodega_final").append("<option selected disabled value=''>Seleccionar...</option>");

var data = new FormData();

data.append("var_bodegas",var_bodegas);

$.ajax({

          url:"ajax/mover-saldo-bodegas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
             async: false,
          dataType: "json",  

          success: function(response){

for( var i = 0; i<response.length; i++){


  $("#bodega_inicial").append("<option  value='"+response[i][0]+"'>"+response[i][1]+"</option>");
  $("#bodega_final").append("<option value='"+response[i][0]+"'>"+response[i][1]+"</option>");

}


          },

           error: function(response, err){ console.log('my message ' + err + " " + response);}
     })

});