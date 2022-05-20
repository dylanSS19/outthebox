    $("#tablaAceptacionCargasInventarios").on("click", "button.btndetalleaceptacioncargo", function(){
          
 var iddetalleaceptacioncargo = $(this).attr("iddetalleaceptacioncargo");
 //console.log("iddetalleaceptacioncargo", iddetalleaceptacioncargo);



         $('#tableDetalleSeriesAceptacionCargosInventarios').DataTable().destroy();

        $("#tbodyid_tableDetalleSeriesAceptacionCargosInventarios").empty();

  

       var data = new FormData();

     data.append("iddetalleaceptacioncargo",iddetalleaceptacioncargo);

      $.ajax({ 


        url:"ajax/reporte-aceptacion-inventarios.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){

   
           console.log("response", response);
          

   $(response).each(function (index, item) {
                 

                    $('#tableDetalleSeriesAceptacionCargosInventarios tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.equipo +                  
                        '</td><td>' + item.serie +                    
                        '</td></tr>'
                    )

                 

                });

    $('#tableDetalleSeriesAceptacionCargosInventarios').DataTable( {


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

    } );



       },
           error: function(response, err){console.log('my message ' + err + " " + response + " " + iddetalleaceptacioncargo );}



      });
$('#modalAceptacionCargoInventarios').modal('show');


});




        $("#tablaAceptacionCargasInventarios").on("click", "button.btnaceptacioncargo", function(){



Swal.fire({
  title: 'Seguro desea aceptar el Cargo?',
  text: "Este proceso NO se puede revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Aceptar Cargo!'
}).then((result) => {
  if (result.isConfirmed) {

 var idaceptacioncargo = $(this).attr("idaceptacioncargo");

       var data = new FormData();

     data.append("idaceptacioncargo",idaceptacioncargo);
     //console.log("idaceptacioncargo", idaceptacioncargo);

      $.ajax({


        url:"ajax/reporte-aceptacion-inventarios.ajax.php",
        method: "POST",
        data: data,
         async: true,
         beforeSend :function(){
                    $('#overlay').fadeIn() ;
                },
        cache: false,
        contentType: false,
        processData: false,
        //dataType: "json",
        success: function(response){


   
           //console.log("response", response);
$('#overlay').fadeOut();

           Swal.fire(
      "Inventario Aceptado Correctamente!",
      "¡Operación exitosa!",
      "success"
    ).then((result) => {

    window.location.reload();
    }) 



       },
           error: function(response, err){console.log('my message ' + err + " " + response + " " + iddetalleaceptacioncargo );}



      });

  }
})





});




            $("#tablaAceptacionMovimientosInventarios").on("click", "button.btndetalleaceptacionmovimiento", function(){
          
 var iddetalleaceptacionmovimiento = $(this).attr("iddetalleaceptacionmovimiento");
 //console.log("iddetalleaceptacioncargo", iddetalleaceptacioncargo);



         $('#tableDetalleSeriesAceptacionCargosInventarios').DataTable().destroy();

        $("#tbodyid_tableDetalleSeriesAceptacionCargosInventarios").empty();

  

       var data = new FormData();

     data.append("iddetalleaceptacionmovimiento",iddetalleaceptacionmovimiento);

      $.ajax({ 


        url:"ajax/reporte-aceptacion-inventarios.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){

   
           //console.log("response", response);
          

   $(response).each(function (index, item) {
                 

                    $('#tableDetalleSeriesAceptacionCargosInventarios tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.equipo +                  
                        '</td><td>' + item.serie +                    
                        '</td></tr>'
                    )

                 

                });

    $('#tableDetalleSeriesAceptacionCargosInventarios').DataTable( {


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

    } );



       },
           error: function(response, err){console.log('my message ' + err + " " + response + " " + iddetalleaceptacioncargo );}



      });
$('#modalAceptacionCargoInventarios').modal('show');


});




                    $("#tablaAceptacionMovimientosInventarios").on("click", "button.btnaceptacionmovimiento", function(){



Swal.fire({
  title: 'Seguro desea aceptar el movimiento?',
  text: "Este proceso NO se puede revertir!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Aceptar Movimiento!'
}).then((result) => {
  if (result.isConfirmed) {

 var idaceptacionmovimiento = $(this).attr("idaceptacionmovimiento");

       var data = new FormData();

     data.append("idaceptacionmovimiento",idaceptacionmovimiento);
     //console.log("idaceptacioncargo", idaceptacioncargo);

      $.ajax({


        url:"ajax/reporte-aceptacion-inventarios.ajax.php",
        method: "POST",
        data: data,
         async: true,
         beforeSend :function(){
                    $('#overlay').fadeIn() ;
                },
        cache: false,
        contentType: false,
        processData: false,
        //dataType: "json",
        success: function(response){


   
           //console.log("response", response);
$('#overlay').fadeOut();

           Swal.fire(
      "Inventario Aceptado Correctamente!",
      "¡Operación exitosa!",
      "success"
    ).then((result) => {

    window.location.reload();
    }) 



       },
           error: function(response, err){console.log('my message ' + err + " " + response + " " + iddetalleaceptacioncargo );}



      });

  }
})





});