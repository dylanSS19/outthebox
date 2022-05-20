const queryStringrecargas= window.location.search;

const urlparamrecargas= new URLSearchParams(queryStringrecargas);

const paramrecargas = urlparamrecargas.get('startDate')

if(paramrecargas==null){

       localStorage.removeItem("captureRange-daterange-btn-reporte-ventas-recargas");
         localStorage.clear();
         $("#daterange-btn-reporte-ventas-recargas span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{


}


/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-daterange-btn-reporte-ventas-recargas") != null){

  $("#daterange-btn-reporte-ventas-recargas span").html(localStorage.getItem("captureRange-daterange-btn-reporte-ventas-recargas"));


}else{

  $("#daterange-btn-reporte-ventas-recargas span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-reporte-ventas-recargas').daterangepicker(
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
    $('#daterange-btn-reporte-ventas-recargas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-reporte-ventas-recargas span").html();
   
    localStorage.setItem("captureRange-daterange-btn-reporte-ventas-recargas", capturarRango);


    window.location = "index.php?route=recargas&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-reporte-ventas-recargas').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-reporte-ventas-recargas').val('');


  localStorage.removeItem("captureRange-daterange-btn-reporte-ventas-recargas");
  localStorage.clear();


 window.location = "recargas";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-reporte-ventas-recargas').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-reporte-ventas-recargas').data('daterangepicker');
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

      localStorage.setItem("captureRange-daterange-btn-reporte-ventas-recargas", "Hoy");


          
       window.location = "index.php?route=recargas&startDate="+startDate+"&endDate="+endDate;
    
  

  }
});

$("#btn-pagar-recagar-internacional").submit(function(e) {
    e.preventDefault();


var monto = document.getElementsByName("recarga-internacional-monto")[0].value;
var numero = document.getElementsByName("recarga-internacional-numero")[0].value;

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Realizar recarga?',
  text: '', html: '<h1>Recarga ' + monto +' colones al número: ' + numero +'</h1>',
  icon: 'warning',
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
      'Recarga',
      'Su comprobante impreso correctamente.',
      'success'
    ).then((result) => {

window.location = "recargas";

    })






  }else{

window.location = "recargas";

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



$("#btn-pagar-recagar-local").submit(function(e) {
    e.preventDefault();


var monto = document.getElementsByName("recarga-local-monto")[0].value;
var numero = document.getElementsByName("recarga-local-numero")[0].value;

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Realizar recarga?',
  text: '', html: '<h1>Recarga ' + monto +' colones al número: ' + numero +'</h1>',
  icon: 'warning',
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
      'Recarga',
      'Su comprobante impreso correctamente.',
      'success'
    ).then((result) => {

window.location = "recargas";

    })






  }else{

window.location = "recargas";

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





