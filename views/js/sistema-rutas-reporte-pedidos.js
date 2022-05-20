
const queryStringreportPedidos = window.location.search;

const urlparamreportPedidos = new URLSearchParams(queryStringreportPedidos);

const paramreportPedidos = urlparamreportPedidos.get('startDate');
 
if(paramrecargas==null){
 
       localStorage.removeItem("captureRange-daterange-btn-reportPedidos");
         localStorage.clear();
         $("#daterange-btn-reportPedidos span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{

 
}
  
      
/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-daterange-btn-reportPedidos") != null){

  $("#daterange-btn-reportPedidos span").html(localStorage.getItem("captureRange-daterange-btn-reportPedidos"));


}else{

  $("#daterange-btn-reportPedidos span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}
 
/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-reportPedidos').daterangepicker(
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
    $('#daterange-btn-reportPedidos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-reportPedidos span").html();
   
    localStorage.setItem("captureRange-daterange-btn-reportPedidos", capturarRango);


    window.location = "index.php?route=sistema-rutas-reporte-pedidos&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-reportPedidos').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-reportPedidos').val('');


  localStorage.removeItem("captureRange-daterange-btn-reportPedidos");
  localStorage.clear();


 window.location = "sistema-rutas-reporte-pedidos";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-reportPedidos').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-reportPedidos').data('daterangepicker');
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

      localStorage.setItem("captureRange-daterange-btn-reportPedidos", "Hoy");


          
       window.location = "index.php?route=sistema-rutas-reporte-pedidos&startDate="+startDate+"&endDate="+endDate;
    
  

  }
});


var  pedido = "ok";
var fechaInicio = urlparamreportPedidos.get('startDate');
var fechaFin = urlparamreportPedidos.get('endDate');


// $.ajax({

           
//            url:'ajax/datatable-sistema-rutas-reporte-pedidos.ajax.php?dato='+pedido+'&StarDate='+fechaInicio+'&EndDate='+fechaFin,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        });


$(document).ready(function() {


  let RolUsuarioSes =  sessionStorage.getItem('rol');
  let idUsuarioSes =  sessionStorage.getItem('id');
  let Ruta = "";
  if(RolUsuarioSes == "Administrador"){

    Ruta = "%";

  }else{

    Ruta = cargarRutaPedidos(idUsuarioSes);
    Ruta = Ruta[0]["IDruta"];

  }

  let fechaActual = moment(fecha).format('YYYY-MM-DD');
  if(fechaInicio == ""){
  
      fechaInicio = fechaActual;
      fechaFin = fechaActual;
  
  }else{
  
  
  }


  CargarTablaFacturas(pedido, fechaInicio, fechaFin, Ruta);
    
  });

  const fecha = new Date();
  $("#FrmRepotPedidoRuta").change(function () {



    let Ruta = $("option:selected","#FrmRepotPedidoRuta").val();
    let fechaActual  = moment(fecha).format('YYYY-MM-DD');
    if(fechaInicio == ""){

        fechaInicio = fechaActual;
        fechaFin = fechaActual;

    }else{


    }

console.log(Ruta);

    CargarTablaFacturas(pedido, fechaInicio, fechaFin, Ruta);

});




  $("#tablareportPedidos").on("click", "button.btnDetPedido", function(){

let idFactura = $(this).attr("idfactura");

console.log(idFactura);

$('#modalreportPedidosDetalle').modal('show'); 

if ( $.fn.DataTable.isDataTable('#tablareportPedidosDetalle') ) {
    $('#tablareportPedidosDetalle').DataTable().destroy();
  }


  $('#tablareportPedidosDetalle').DataTable( {
    dom: 'Bfrtip',
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
     buttons: [
         'pageLength','colvis',
          'copy', 'excel', 'pdf'
     ],
  
  "ajax": 'ajax/datatable-sistema-rutas-reporte-pedidos.ajax.php?idFact='+idFactura,
  "async": "false",
  
     "deferRender": true,
  "retrieve": true,
  "processing": true,
  
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
        
              console.log(data);
            var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
            return num;           
           
         } else {
            return data;
         }
      }
    },{ 
        render: function(data, type, row, meta){
           if(type === 'display'){
            
              var symbol = "";              
          
                symbol = "₡";
          
                console.log(data);
              var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
              return num;           
             
           } else {
              return data;
           }
        }
      },{ 
        render: function(data, type, row, meta){
           if(type === 'display'){
            
              var symbol = "";              
          
                symbol = "₡";
          
                console.log(data);
              var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
              return num;           
             
           } else {
              return data;
           }
        }
      },
    
  
  ],
  
  "language": {
    buttons: {
             colvis: 'Columnas Visibles',
              copy: 'Copiar',
              pageLength:'Mostrar'
         },
  
   "sProcessing":     "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
   "sLoadingRecords": "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
           .column( 6, { search: 'applied'} )
           .data()
           .reduce( function (a, b) {
               return intVal(a) + intVal(b);
           }, 0 );

       // Update footer
       $( api.column( 6 ).footer() ).html(
        '₡'+ Number(total).toLocaleString("en-US") +''
       );

           // Total over all pages
           total = api
           .column( 7, { search: 'applied'} )
           .data()
           .reduce( function (a, b) {
               return intVal(a) + intVal(b);
           }, 0 );

       // Update footer
       $( api.column( 7 ).footer() ).html(
        '₡'+ Number(total).toLocaleString("en-US") +''
       );

     
     } ,
  
     
  });


});



function CargarTablaFacturas(pedido, fechaInicio, fechaFin, Ruta){


// $.ajax({

           
//            url:'ajax/datatable-sistema-rutas-reporte-pedidos.ajax.php?dato='+pedido+'&StarDate='+fechaInicio+'&EndDate='+fechaFin+'&Ruta='+Ruta,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        });

       if ( $.fn.DataTable.isDataTable('#tablareportPedidos') ) {
        $('#tablareportPedidos').DataTable().destroy();
      }


  let table =  $("#tablareportPedidos").DataTable({
  
        "ajax": 'ajax/datatable-sistema-rutas-reporte-pedidos.ajax.php?dato='+pedido+'&StarDate='+fechaInicio+'&EndDate='+fechaFin+'&Ruta='+Ruta,  
        "async": "false",
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": true,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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


function cargarRutaPedidos(idusuario){

    let Ruta = [];
    
        var data = new FormData();
        data.append("idusuario", idusuario);
    
        $.ajax({
          url: "ajax/sistema-rutas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",
          success: function (response) {
            
            Ruta.push({"IDruta": response[0].idtbl_rutas,
          "valCoordenadas": response[0].valida_coordenadas });
    
          
    
      },
                
    error: function(response, err){ console.log('my message ' + err + " " + response );}
    
    })
    
    console.log(Ruta);
    return Ruta;
    
    }