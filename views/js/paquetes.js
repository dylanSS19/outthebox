    $("#combo-paquete-paquetes").change(function(){


      $("#descripcionpaquetes").val("Descripción: " + $(this).val());

      var monto=1000.00

      $(".totalpagarpaquetes").text("TOTAL PAGAR:₡"+ Number(monto).toLocaleString("en-US")+"");



    });


    $("#btn-pagar-paquetes").submit(function(e) {
    e.preventDefault();


var paquete =  $("#combo-paquete-paquetes").val();
var numero = document.getElementsByName("recarga-paquete-numero")[0].value;

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Realizar recarga?',
  text: '', html: '<h1>Recarga  al ' + numero +' el paquete: ' + paquete +'</h1>',
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

window.location = "paquetes";

    })






  }else{

window.location = "paquetes";

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
