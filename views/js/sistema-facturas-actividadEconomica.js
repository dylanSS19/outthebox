var act = "ok";

//   $.ajax({

           
//             url:'ajax/datatable-sistema-facturas-Reporte-actividad.ajax.php?dato='+act,
//             async: false,
//             success: function(response){
   
//        console.log("respuesta",response);
                
//                },

//         });

$(document).ready(function() {
  if ( $.fn.DataTable.isDataTable('#tablaActividadesClientes') ) {
  $('#tablaActividadesClientes').DataTable().destroy();
}
 var table = $("#tablaActividadesClientes").DataTable({

  "ajax": 'ajax/datatable-sistema-facturas-Reporte-actividad.ajax.php?dato='+act,  
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
                 table.buttons().container()
                     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
            }

    })
  
}); 

$(".btn_actividadEconomica").click(function(){

    cargarTablaActividades();

    $('#modalAddActividad').modal('show'); // abrir
});



function cargarTablaActividades(){

    var actividad ; 

    actividad = "ok"; 

    if ( $.fn.DataTable.isDataTable('#tablaActividades') ) {
        $('#tablaActividades').DataTable().destroy();
      }
       var table = $("#tablaActividades").DataTable({
      
        "ajax": 'ajax/datatable-sistema-facturas-actividadEconomica.ajax.php?dato='+actividad,  
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
                       table.buttons().container()
                           .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
                  }
      
          })



}

$("#tablaActividades").on("click", "button.btnAddActividad", function(){

  let codigo = $(this).attr('act');
  let nombreAct = $(this).attr('nomAct');
  let empresa = $('option:selected','#empresaheader').val();

    Swal.fire({
        title: '<strong>Actividad Economica</strong>',
        text: "¿Desea agregar actividad economica?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Agregar'
      }).then((result) => {
        if (result.isConfirmed) {
            agregarActividadesClientes(codigo, nombreAct, empresa);
        }
      })

});

function agregarActividadesClientes(codigo, nombreAct, empresa){

    var data = new FormData();

    data.append("codigo",codigo); 
    data.append("nombre",nombreAct);
    data.append("empresa",empresa);

         $.ajax({
     
              url:"ajax/sistema-facturas-Actividad-Economica.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              // dataType: "json",  
              success: function(response){

                 console.log("response", response);

            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}

      })

console.log('Actividad', codigo);
console.log('Actividad', nombreAct);
console.log('Actividad', empresa);

}


/* agregar botones que cierran los modales y recarggar la pagina  */
$(".btnCerrarModal").click(function(){

    $('#modalAddActividad').modal('hide'); 

    window.location = "sistema-facturas-actividadEconomica";

});