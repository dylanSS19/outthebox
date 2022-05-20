/*var Rol ; 

Rol = sessionStorage.getItem('rol'); */


// $(document).ready(function() {
//  var table = $("#tablapagodeservicios").DataTable({


//       "responsive": true, "lengthChange": false, 
//       "autoWidth": true,
//    "deferRender": true,
//   "retrieve": true,
//   "processing": true,
//  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

     

//   "language": {

//     "sProcessing":     "Procesando...",
//     "sLengthMenu":     "Mostrar _MENU_ registros",
//     "sZeroRecords":    "No se encontraron resultados",
//     "sEmptyTable":     "Ningún dato disponible en esta tabla",
//     "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//     "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//     "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//     "sInfoPostFix":    "",
//     "sSearch":         "Buscar:",
//     "sUrl":            "",
//     "sInfoThousands":  ",",
//     "sLoadingRecords": "Cargando...",
//     "oPaginate": {
//     "sFirst":    "Primero",
//     "sLast":     "Último", 
//     "sNext":     "Siguiente",
//     "sPrevious": "Anterior"
//     },
//     "oAria": {
//       "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//       "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//     }

//   },
//   initComplete: function () {
//                 table.buttons().container()
//                     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
//             }

//     })
  

// });
var table

$(document).ready(function() {







/* var divsToHide = document.getElementsByClassName("datos-cliente"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

  

           divsToHide[i].style.display = "none"; // depending on what you're doing
         
}} */







  $("#btn-buscar-pospago").on('click',function() {


  if($("#pagoservicios-pospago").val()==""){

  

Swal.fire({
  title: 'Favor digite un valor!',
/*  text: 'Do you want to continue',*/
  icon: 'error',
  confirmButtonText: 'Ok'
})

  return;
    
  }else{




  var isCheckedrd_pospago_cedula = document.getElementById('rd_pospago_cedula').checked;
  var isCheckedrd_pospago_contrato = document.getElementById('rd_pospago_contrato').checked;
  var isCheckedrd_pospago_telefono = document.getElementById('rd_pospago_telefono').checked;

if(isCheckedrd_pospago_cedula){
  


}else if(isCheckedrd_pospago_contrato){


}else if(isCheckedrd_pospago_telefono){

}

  var divsToHide = document.getElementsByClassName("datos-cliente"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

      if( divsToHide[i].style.display== "none"){
    divsToHide[i].style.display = "flex";

      }else{

           divsToHide[i].style.display = "none"; // depending on what you're doing
      }    
}}

};

  table =   $("#tablaspendientes").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,



     

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

    }).buttons().container().appendTo('#tablaspendientes_wrapper .col-md-6:eq(0)');

     


});
 

 

 
} );




const queryStringpagoservicios = window.location.search;

const urlparampagoservicios = new URLSearchParams(queryStringpagoservicios);

const parampagoservicio = urlparampagoservicios.get('startDate')

if(parampagoservicio==null){

       localStorage.removeItem("captureRange-pago-servicios");
         localStorage.clear();
         $("#daterange-btn-reporte-ventas-pago-servicios span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{


}


/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-pago-servicios") != null){

  $("#daterange-btn-reporte-ventas-pago-servicios span").html(localStorage.getItem("captureRange-pago-servicios"));


}else{

  $("#daterange-btn-reporte-ventas-pago-servicios span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-reporte-ventas-pago-servicios').daterangepicker(
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
    $('#daterange-btn-reporte-ventas-pago-servicios span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-reporte-ventas-pago-servicios span").html();
   
    localStorage.setItem("captureRange-pago-servicios", capturarRango);


    window.location = "index.php?route=pago-servicios&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-reporte-ventas-pago-servicios').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-reporte-ventas-pago-servicios').val('');


  localStorage.removeItem("captureRange-pago-servicios");
  localStorage.clear();


 window.location = "pago-servicios";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-reporte-ventas-pago-servicios').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-reporte-ventas-pago-servicios').data('daterangepicker');
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

      localStorage.setItem("captureRange-pago-servicios", "Hoy");


          
       window.location = "index.php?route=pago-servicios&startDate="+startDate+"&endDate="+endDate;
    
  

  }
});





$("#btn-pagar").on('click',function() {


const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Realizar pago?',
/*  text: "You won't be able to revert this!",
*/  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Si, continuar!',
  cancelButtonText: 'No, cancelar!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {



Swal.fire({
  title: 'Desea imprimir una copia?',
/*  text: "You won't be able to revert this!",
*/  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, imprimir!',
    cancelButtonText: 'No, imprimir!'

}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Imprimir',
      'Su comprobante impreso correctamente.',
      'success'
    ).then((result) => {

window.location = "pago-servicios";

    })






  }else{

window.location = "pago-servicios";

  }
  
})
 

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      /*'Your imaginary file is safe :)',*/
      'error'
    )
  }
})

});
/*window.location = "sales-dth";*/

/*var myFunction = function() {

 var divsToHide = document.getElementsByClassName("datos-cliente"); 
if(divsToHide.length>0){
        for(var i = 0; i < divsToHide.length; i++){

      if( divsToHide[i].style.display== "none"){
    divsToHide[i].style.display = "flex";

      }else{

           divsToHide[i].style.display = "none"; // depending on what you're doing
      }    
}} }*/

$('#rd_pospago_contrato').on('ifChecked', function(event){
 $('#pagoservicios-pospago').attr("placeholder", "# Contrato");
});

$('#rd_pospago_cedula').on('ifChecked', function(event){
 $('#pagoservicios-pospago').attr("placeholder", "# Cédula");
});

$('#rd_pospago_telefono').on('ifChecked', function(event){
 $('#pagoservicios-pospago').attr("placeholder", "# Télefono");
});

$('#rd_internet_contrato').on('ifChecked', function(event){
 $('#pagoservicios-internet').attr("placeholder", "# Contrato");
});

$('#rd_internet_cedula').on('ifChecked', function(event){
 $('#pagoservicios-internet').attr("placeholder", "# Cédula");
});

$('#rd_internet_telefono').on('ifChecked', function(event){
 $('#pagoservicios-internet').attr("placeholder", "# Télefono");
});


$('#rd_dth_contrato').on('ifChecked', function(event){
 $('#pagoservicios-dth').attr("placeholder", "# Contrato");
});

$('#rd_dth_cedula').on('ifChecked', function(event){

 $('#pagoservicios-dth').attr("placeholder", "# Cédula");
});

$('#rd_dth_telefono').on('ifChecked', function(event){
 $('#pagoservicios-dth').attr("placeholder", "# Télefono");
});


$('#rd_gpon_contrato').on('ifChecked', function(event){
 $('#pagoservicios-gpon').attr("placeholder", "# Contrato");
});

$('#rd_gpon_cedula').on('ifChecked', function(event){
 $('#pagoservicios-gpon').attr("placeholder", "# Cédula");
});

$('#rd_gpon_telefono').on('ifChecked', function(event){
 $('#pagoservicios-gpon').attr("placeholder", "# Télefono");
});