$(".tablaEstadoTiendas").DataTable({
  
 
        "columnDefs": [       
            {
                "targets": [ 3 ],
                "visible": false
            }
        ]
    ,
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
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-reporte-ventas-tiendas") != null){

	$("#daterange-btn-reporte-ventas-tiendas span").html(localStorage.getItem("captureRange-reporte-ventas-tiendas"));


}else{

	$("#daterange-btn-reporte-ventas-tiendas span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}
 


/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn-reporte-ventas-tiendas').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
    
  },
  function (start, end) {
    $('#daterange-btn-reporte-ventas-tiendas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-reporte-ventas-tiendas span").html();
   
   	localStorage.setItem("captureRange-reporte-ventas-tiendas", capturarRango);



let params = new URLSearchParams(location.search);
var tienda = params.get('tienda');

        window.location = "index.php?route=reporte-tiendas&startDate="+startDate+"&endDate="+endDate+"&tienda="+tienda+""; 


  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$('#daterange-btn-reporte-ventas-tiendas').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input

  $('#daterange-btn-reporte-ventas-tiendas').val('');

  localStorage.removeItem("captureRange-reporte-ventas-tiendas");

  localStorage.clear();

  window.location = "reporte-tiendas";

});


/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-reporte-ventas-tiendas').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-reporte-ventas-tiendas').data('daterangepicker');
/*  console.log("drp", drp["chosenLabel"]);
*/
  if(textoHoy["chosenLabel"] == "Hoy"){

    var d = new Date();
    
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if(mes < 10){

      var startDate = año+"-0"+mes+"-"+dia;
      var endDate = año+"-0"+mes+"-"+dia;

    }else if(dia < 10){

      var startDate = año+"-"+mes+"-0"+dia;
      var endDate = año+"-"+mes+"-0"+dia;

    }else if(mes < 10 && dia < 10){

      var startDate = año+"-0"+mes+"-0"+dia;
      var endDate = año+"-0"+mes+"-0"+dia;

    }else{

      var startDate = año+"-"+mes+"-"+dia;
        var endDate = año+"-"+mes+"-"+dia;

    } 

          localStorage.removeItem("captureRange-reporte-ventas-tiendas");

          

let params = new URLSearchParams(location.search);
var tienda = params.get('tienda');

        window.location = "index.php?route=reporte-tiendas&startDate="+startDate+"&endDate="+endDate+"&tienda="+tienda+""; 
  

  }
});




$("#tiendas-reporte-ventas").change(function(){


let params = new URLSearchParams(location.search);
var startDate = params.get('startDate');
var endDate = params.get('endDate');

var tienda = $("[name='tiendas-reporte-ventas'] option:selected").text();

window.location = "index.php?route=reporte-tiendas&startDate="+startDate+"&endDate="+endDate+"&tienda="+tienda+"";


})


 
$(document).ready(function() {



         $('#tablasventasreporteventastiendas').DataTable( {
                           dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );

             // Total over all pages
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+ total +''
            );

              // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );


              // Total over all pages
            total = api
                .column( 2, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+ total +''
            );


        
        } ,
         'columns': [
       null,
       null,
       null,
       null,
       null,       
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       }
       
     ],
     /*      "responsive": true, "lengthChange": false, "autoWidth": true,
 "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],*/

        "language": {
            
             buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },

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

    } ).buttons().container().appendTo('#tablasventasreporteventastiendas_wrapper .col-md-6:eq(0)');




           $('#tablasventastaereporteventastiendas').DataTable( {
               dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
          
            


              // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
        '₡'+ Number(total).toLocaleString("en-US") +''            );


        
        } ,
                 'columns': [
       null,
       null,
       null,       
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
       null
       
     ],

        "language": {
             buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },

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

    } ).buttons().container().appendTo('#tablasventastaereporteventastiendas_wrapper .col-md-6:eq(0)');


                    $('#tablasventaskitsdigitalreporteventastiendas').DataTable( {

                                               dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
               '₡'+ Number(total).toLocaleString("en-US") +''
            );


      total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
               '₡'+ Number(total).toLocaleString("en-US") +''
            );

             


              // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );


        
        } ,
                   'columns': [
       null,
       null,
       null,
       null,       
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
               { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
       null
       
     ],

        "language": {
                  buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },
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

    } ).buttons().container().appendTo('#tablasventaskitsdigitalreporteventastiendas_wrapper .col-md-6:eq(0)');


                                        $('#tablasventaskitsclaroreporteventastiendas').DataTable( {
                                                         dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],
                              
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );


      total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );

             


              // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );


        
        } ,
                   'columns': [
       null,
       null,
       null,
       null,       
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
               { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
       null
       
     ],

        "language": {
        buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },
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

    } ).buttons().container().appendTo('#tablasventaskitsclaroreporteventastiendas_wrapper .col-md-6:eq(0)');

 $('#tablasventasaccesoriosreporteventastiendas').DataTable( {
    dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );

                // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );


             


              // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );


        
        } ,
                   'columns': [
       null,
       null,
       null,
       null,       
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
               { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
       null
       
     ],

        "language": {
  buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },
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

    } ).buttons().container().appendTo('#tablasventasaccesoriosreporteventastiendas_wrapper .col-md-6:eq(0)');

  $('#tablasventasrecaudacionesreporteventastiendas').DataTable( {
      dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                '₡'+ Number(total).toLocaleString("en-US") +''
            );

             


      


        
        } ,
                   'columns': [
       null,
       null,
       null,
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },          
       null
       
     ],
        "language": {
              buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },
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

    } ).buttons().container().appendTo('#tablasventasrecaudacionesreporteventastiendas_wrapper .col-md-6:eq(0)');


  

  
            $('#tablasventaskitsclarodigitalreporteventastiendas').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );

                  // Total over all pages
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+ total +''
            );

                  // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ total +''
            );

             


      


        
        } ,

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
    



            $('#tablasventasactivacionesreporteventastiendas').DataTable( {
                             dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );

             


      


        
        } ,

        "language": {
                   buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },

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

    } ).buttons().container().appendTo('#tablasventasactivacionesreporteventastiendas_wrapper .col-md-6:eq(0)');


                        $('#tablasventaspospagoreporteventastiendas').DataTable( {
                                    dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],
                   
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ total +''
            );

                    // Total over all pages
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+ total +''
            );

                    // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ total +''
            );

                    // Total over all pages
            total = api
                .column( 6, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
               ''+ total +''           );

                            // Total over all pages
            total = api
                .column( 7, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 7 ).footer() ).html(
                   ''+ total +''
            );

             


      


        
        } ,

        "language": {
                        buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },
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

    } ).buttons().container().appendTo('#tablasventaspospagoreporteventastiendas_wrapper .col-md-6:eq(0)');

          } );

/*function myFunction() {
  var elmnt = document.getElementById("content");
  elmnt.scrollIntoView();
}*/

$('#moreinfopospago').on('click', function() {

        var elmnt = document.getElementById("boxtablasventaspospagoreporteventastiendas");
  elmnt.scrollIntoView();
  
});


$('#moreinfokitsdigital').on('click', function() {

        var elmnt = document.getElementById("boxtablasventaskitsdigitalreporteventastiendas");
  elmnt.scrollIntoView();
  
});

$('#moreinfokitsclaro').on('click', function() {

        var elmnt = document.getElementById("boxtablasventaskitsclaroreporteventastiendas");
  elmnt.scrollIntoView();
  
});

$('#moreinfoaccesorios').on('click', function() {

        var elmnt = document.getElementById("boxtablasventasaccesoriosreporteventastiendas");
  elmnt.scrollIntoView();
  
});

$('#moreinforecaudacion').on('click', function() {

        var elmnt = document.getElementById("boxtablasventasrecaudacionesreporteventastiendas");
  elmnt.scrollIntoView();
  
});

$('#moreinfotae').on('click', function() {

        var elmnt = document.getElementById("boxtablasventastaereporteventastiendas");
  elmnt.scrollIntoView();
  
});

$('#moreinfoactivaciones').on('click', function() {

        var elmnt = document.getElementById("boxtablasventasactivacionesreporteventastiendas");
  elmnt.scrollIntoView();
  
});


/*$('.toTop ').click(function(){
  $("html, body").animate({ scrollTop: 0 }, 600);
  return false;
});*/






$('.btnVentasTiendasActivacionesDetail').on('click', function() {

$('#tableVentasTiendaDetailsActivaciones').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsActivaciones").empty();

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

                      var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");

        var data = new FormData();

     data.append("vargestoractivaciones",gestor);

     data.append("vartiendaactivaciones",tienda);

            data.append("endDate",endDate);

     data.append("startDate",startDate);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
/*            console.log("response", response);
*/          

 




   $(response).each(function (index, item) {
/*    console.log("item", item.tienda);
*/                   

                    $('#tableVentasTiendaDetailsActivaciones tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.tipo_operacion +
                        '</td><td>' + item.fecha +
                        '</td><td>' + item.cedula +
                        '</td><td>' + item.nombre +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailsActivaciones').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});


    $("#tablaEstadoTiendas").on("click", "button.btnEstadoTiendas", function(){
//    console.log("click");

         $('#tableDetalleEstadoTiendas').DataTable().destroy();

$("#tbodyid_tableDetalleEstadoTiendas").empty();

          
 var tienda = $(this).attr("idtienda");
//$('#modalEstadoTiendas').modal('show'); 
//console.log("tiendaSSS", tienda);

  

       var data = new FormData();

     data.append("idtienda",tienda);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
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
                 

                    $('#tableDetalleEstadoTiendas tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.motivo +
                        '</td><td>' + item.hora +
                        '</td></tr>'
                    )

                 

                });

    $('#tableDetalleEstadoTiendas').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });
$('#modalEstadoTiendas').modal('show');
  
});


$('.btnVentasTiendasTaeDetail').on('click', function() {

$('#tableVentasTiendaDetailsTae').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsTae").empty();

           var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

        var data = new FormData();

     data.append("vargestortae",gestor);

     data.append("vartiendatae",tienda);

       data.append("endDate",endDate);

     data.append("startDate",startDate);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
/*            console.log("response", response);
*/          

   $(response).each(function (index, item) {
                 

                    $('#tableVentasTiendaDetailsTae tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.fecha +
                        '</td><td>' + item.producto +
                        '</td><td>₡' + Number(item.total).toLocaleString("en-US")  +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailsTae').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});

$('.btnVentasTiendasPospagoDetail').on('click', function() {

$('#tableVentasTiendaDetailsPospago').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsPospago").empty();

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

           var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");



        var data = new FormData();

     data.append("vargestor",gestor);

     data.append("vartienda",tienda);

     data.append("endDate",endDate);

     data.append("startDate",startDate);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
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
/*    console.log("item", item.tienda);
*/                   

                    $('#tableVentasTiendaDetailsPospago tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.tipo_venta +
                        '</td><td>' + item.fecha_venta +
                        '</td><td>' + item.cedula +
                        '</td><td>' + item.nombre +
                        '</td></tr>'
                    )

                 

                });

    $('.tableVentasTiendaDetailsPospago').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + gestor );}



      });

  
});


$('.btnVentasTiendasKitsDigitalDetail').on('click', function() {


$('#tableVentasTiendaDetailsKitsDigital').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsKitsDigital").empty();

/*$("#tfootid_tableVentasCalleDetails").empty();*/

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");


                var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");



        var data = new FormData();

     data.append("vargestorkitsdigital",gestor);

     data.append("vartiendakitsdigital",tienda);

     data.append("endDate",endDate);

     data.append("startDate",startDate);



      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
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
/*    console.log("item", item.tienda);
*/                   

                    $('#tableVentasTiendaDetailsKitsDigital tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.cantidad +
                        '</td><td>' + item.producto +
                        '</td><td>₡' + Number(item.total).toLocaleString("en-US")  +
                        '</td><td>₡' + Number(item.promedio).toLocaleString("en-US") +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailsKitsDigital').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});


$('.btnVentasTiendasKitsClaroDetail').on('click', function() {


$('#tableVentasTiendaDetailsKitsClaro').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsKitsClaro").empty();

/*$("#tfootid_tableVentasCalleDetails").empty();*/

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

                           var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");

        var data = new FormData();

     data.append("vargestorkitsclaro",gestor);

     data.append("vartiendakitsclaro",tienda);
  data.append("endDate",endDate);

     data.append("startDate",startDate);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
          

 




   $(response).each(function (index, item) {
/*    console.log("item", item.tienda);
*/                   

                    $('#tableVentasTiendaDetailsKitsClaro tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.cantidad +
                        '</td><td>' + item.producto +
                        '</td><td>₡' + Number(item.total).toLocaleString("en-US")  +
                        '</td><td>₡' + Number(item.promedio).toLocaleString("en-US") +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailsKitsClaro').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});

$('.btnVentasTiendasAccesoriosDetail').on('click', function() {


$('#tableVentasTiendaDetailsAccesorios').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailsAccesorios").empty();

/*$("#tfootid_tableVentasCalleDetails").empty();*/

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

 var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");
        var data = new FormData();

     data.append("vargestoraccesorios",gestor);

     data.append("vartiendaaccesorios",tienda);

       data.append("endDate",endDate);

     data.append("startDate",startDate);


      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
/*    console.log("response", response);
*/          

 




   $(response).each(function (index, item) {
/*    console.log("item", item.tienda);
*/                   

                    $('#tableVentasTiendaDetailsAccesorios tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.cantidad +
                        '</td><td>' + item.producto +
                        '</td><td>₡' + Number(item.total).toLocaleString("en-US")  +
                        '</td><td>₡' + Number(item.promedio).toLocaleString("en-US") +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailsAccesorios').DataTable( {


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});

$('.btnVentasTiendasRecaudacionesDetail').on('click', function() {


$('#tableVentasTiendaDetailRecaudaciones').DataTable().destroy();

$("#tbodyid_tableVentasTiendaDetailRecaudaciones").empty();

/*$("#tfootid_tableVentasCalleDetails").empty();*/

           var tienda = $(this).attr("tienda");
           var gestor = $(this).attr("gestor");

            var url = new URL(window.location);
var startDate = url.searchParams.get("startDate");
var endDate = url.searchParams.get("endDate");

        var data = new FormData();

     data.append("vargestorrecaudaciones",gestor);

     data.append("vartiendarecaudaciones",tienda);


       data.append("endDate",endDate);

     data.append("startDate",startDate);

      $.ajax({


        url:"ajax/reporte-ventas-tiendas.ajax.php",
        method: "POST",
        data: data,
         async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response){
/*            console.log("response", response);
*/          

 




   $(response).each(function (index, item) {
                   

                    $('#tableVentasTiendaDetailRecaudaciones tbody').append(
                        '<tr><td>' + (index+1) +                  
                        '</td><td>' + item.tienda +                  
                        '</td><td>' + item.gestor +
                        '</td><td>' + item.fecha_ingreso +
                        '</td><td>' + item.cedula +
                        '</td><td>' + item.nombre +
                        '</td><td>' + item.tipo +
                        '</td><td>₡' + Number(item.monto).toLocaleString("en-US")  +
                        '</td></tr>'
                    )

                 

                });

    $('#tableVentasTiendaDetailRecaudaciones').DataTable( {

    /*        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 7, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {


                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 7 ).footer() ).html(
                '₡'+ total.toLocaleString() +''
            );

             


      


        
        } ,*/


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
           error: function(response, err){console.log('my message ' + err + " " + response + " " + tienda );}



      });

  
});

/*let paramstienda = new URLSearchParams(location.search);
var tienda = paramstienda.get('tienda');
//console.log("tienda", tienda);

$("#reporte_tiendas").val(tienda);*/




$(".reporte_tiendas").change(function(){

var idTienda = $(".reporte_tiendas option:selected").val();
var nombre = $(".reporte_tiendas option:selected").text();
let  stringFinal = " "
if(nombre[nombre.length-1] === " ") {
    nombre = nombre.substring(0, nombre.length-1);
}
console.log("nombre", nombre);

let params = new URLSearchParams(location.search);

var startDate = params.get('startDate');
var endDate = params.get('endDate');

if(nombre=="Todas"){
    nombre="%";
    idTienda="%";
}else{
}
window.location = "index.php?route=reporte-tiendas&startDate="+startDate+"&endDate="+endDate+"&tienda="+nombre+"&ID="+idTienda+""; 


//window.location = "index.php?route=reporte-tiendas&startDate="+startDate+"&endDate="+endDate+"&tienda="+tienda+"&ID="+id+""; 




})


$('#rango1tiendas').daterangepicker(
  {
   
    startDate: moment(),
    endDate  : moment()
    
  },
  function (start, end) {
        $('#rango1tiendas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));


    var startDate = start.format('YYYY-MM-DD');
    var endDate = end.format('YYYY-MM-DD');

     $("#dtdesde1tiendas").val(startDate);
     $("#dthasta1tiendas").val(endDate);




  }

)

$('#rango2tiendas').daterangepicker(
  {
   
    startDate: moment(),
    endDate  : moment()
    
  },
  function (start, end) {

   $('#rango2tiendas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));


    var startDate = start.format('YYYY-MM-DD');
    var endDate = end.format('YYYY-MM-DD');

     $("#dtdesde2tiendas").val(startDate);
     $("#dthasta2tiendas").val(endDate);




  }

)




$( "#btnbuscartablacomparativatiendas" ).click(function() {

 
 
 var desde1= $("#dtdesde1tiendas").val();
 var hasta1= $("#dthasta1tiendas").val();


 var desde2= $("#dtdesde2tiendas").val();
 var hasta2= $("#dthasta2tiendas").val();

 if (desde1=="" || desde2=="") {
swal({

        type: "error",
        title: "¡Favor seleccionar ambos campos de fechas!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false

      })
  return;
 }else{


/*$.ajax({

         
          url:'ajax/datatable-compara-tablas-tiendas.ajax.php?desde1='+desde1+'&hasta1='+hasta1+'&desde2='+desde2+'&hasta2='+hasta2,
          async: false,
          success: function(response){

       
       console.log("respuesta",response);
              
             },

      });*/

      $('.TablaComparativaTiendas').DataTable().clear().destroy();

var table =  $('.TablaComparativaTiendas').DataTable( {
       dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],

  "ajax": 'ajax/datatable-compara-tablas-tiendas.ajax.php?desde1='+desde1+'&hasta1='+hasta1+'&desde2='+desde2+'&hasta2='+hasta2,
  "async": "false",

        "deferRender": true,
  "retrieve": true,
  "processing": true,

  'columnDefs': [
       { targets: 2, className: 'bg-light  color-palette'},
       { targets: 3, className: 'bg-light  color-palette'},
       { targets: 4, visible: false, className: 'bg-light  color-palette'},

       { targets: 7, visible: false },

        { targets: 8, className: 'bg-light  color-palette'},
       { targets: 9, className: 'bg-light  color-palette'},
       { targets: 10, visible: false, className: 'bg-light  color-palette' },

       { targets: 13, visible: false },

  
    ],
  'columns': [
       null,
       null,
       null,
       null,
       null,
       null,
       null,
       null,
        null,
         null,
          null,
             { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
       { 
         render: function(data, type, row, meta){
            if(type === 'display'){
             
               var symbol = "";              
           
                 symbol = "₡";
           
                 
               var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
               return num;           
              
            } else {
               return data;
            }
         }
       },
      null
     ],

   "language": {
       buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },

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
  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };





                    // Total over all pages
            total = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
  ''+ total +''      
       );

                    // Total over all pages
            total = api
                .column( 2, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
  ''+ total +''      
       );



// Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 2, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 3, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 4 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 4 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 4 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }

 
            // Total over all pages
            total = api
                .column( 6, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                ''+ total +''
            );



     // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ total +''
            );




                    // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 6, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 7 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 7).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 7 ).footer() ).html(


            '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }
 
    




         
                    // Total over all pages
            total = api
                .column( 9, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 9 ).footer() ).html(
 ''+ total +''  
       );


                       // Total over all pages
            total = api
                .column( 8, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                ''+ total +''
            );





           // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 8, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 9, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 10 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ Number(total2 - total).toLocaleString("en-US") +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 10 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ Number(total2 - total).toLocaleString("en-US") +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 10 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ Number(total2 - total).toLocaleString("en-US") +'</h5></div>'
              
            );


               }


   
             


                    // Total over all pages
            total = api
                .column( 12, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 12 ).footer() ).html(
 '₡'+ Number(total).toLocaleString("en-US") +''
       );

              // Total over all pages
            total = api
                .column( 11, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 11 ).footer() ).html(
                  '₡'+ Number(total).toLocaleString("en-US") +''
            );


         // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 11, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 12, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 13 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">₡'+ Number(total2 - total).toLocaleString("en-US") +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 13 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">₡'+ Number(total2 - total).toLocaleString("en-US")  +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 13 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">₡'+ Number(total2 - total).toLocaleString("en-US")  +'</h5></div>'
              
            );


               }






/*'₡'+ Number(total).toLocaleString("en-US") +''*/


      


        
        } ,






        
  });

table.page(0).draw('page')

table.ajax.reload();

}

});
