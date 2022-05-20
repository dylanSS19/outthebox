$("#btn-validar-activacion-sim").submit(function(e) {
    e.preventDefault();

    var button =  $("#btn-activacion-sim").text();
    if(button=="Validar"){

     var rdn = Math.round(Math.random() * (1 - 0) + 0);
     console.log("rdn", rdn);

     if(rdn==0){
 Swal.fire(
      'Validacion exitosa!',
      'Se ha validado la información exitosamente.',
      'success'
    ).then((result) => {

 $("#btn-activacion-sim").text("Activar");;

    })


     }else{

 Swal.fire(
      'Validacion fallida!',
      'No se ha validado la información.',
      'error'
    )


     }




    }else{

 Swal.fire(
      'Activación exitosa!',
      'Se ha activado el SIM exitosamente.',
      'success'
    ).then((result) => {

window.location = "activaciones";
    })
    }


/*var monto = document.getElementsByName("recarga-internacional-monto")[0].value;
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
  icon: 'warning',
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
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelado',
      'error'
    )
  }
})*/

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





