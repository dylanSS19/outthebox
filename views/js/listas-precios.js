$(document).ready(function () {
  if ($.fn.DataTable.isDataTable('#tablasListaPrecios')) {
    $('#tablaListasPrecios').DataTable().destroy();
  }

  $("#tablaListasPrecios").DataTable({
    "ajax": 'ajax/datatable-listas-precios.ajax.php?cargar=c',
    "async": "false",
    "language": {

      "sProcessing": '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

    },


    "responsive": true,
    "lengthChange": false,
    "autoWidth": false
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});

$("#tablaListasPrecios").on("click", "button.btnListaPrecios", function () {

  let id = $(this).attr('idListasPrecio');
  let nombre = $(this).attr('nombre');
  let codigo = $(this).attr('codigo');

  document.querySelector('#idModal').value = id;
  document.querySelector('#codigoModal').value = codigo;
  document.querySelector('#nombreModal').value = nombre;

  $('#modalEditar').modal('show');

});

$("#header").on("click", "button.btnNuevaLista",function () {
  $("#modalNuevaLista").modal('show');
})


$('#tablaListasPrecios').on("click", "button.btnEstado", function () {

  Swal.fire({
    title: "¡Atención!",
    text: "¿Estas seguro que deseas cambiar el estado?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar'
  }).then((result)=>{
    if (result.isConfirmed) {
      let idListasEstado = $(this).attr('idListasEstado');
      let estado = $(this).attr('estado');
      
      var data = new FormData;
      data.append("idListasEstado", idListasEstado);
      data.append("estado", estado);

      $.ajax({

        url: "ajax/listas-precio.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",
        success: function (response) {
          console.log("response", response);
    /*
          if (response == "ok") {
    
            Swal.fire(
              "Éxito",
              "Se ha modificado el estado.",
              "success"
            ).then((result) => {    
              window.location = "listas-precios";
            })
    
          } else {
            Swal.fire(
              "Error",
              "Error en al actualizar",
              "error"
            ).then((result) => {
    
              $('#modalEditar').modal('hide');
    
              window.location = "listas-precios";
            })
          }*/
          
        }

        
      });
      window.location = "listas-precios";

    }
  })

});

/*
$('#modalEditar').on('click', "button.btnSaveListaPrecios", function () {

  let idLista = document.querySelector('#idModal').value;
  let nombreLista = document.querySelector('#nombreModal').value;
  let codigoLista = document.querySelector('#codigoModal').value;

  // let datos = {
  //   "id": "" + id + "",
  //   "nombre": "" + nombre + "",
  //   "codigo": "" + codigo + ""
  // }

  //datos = JSON.stringify(datos);

  var data = new FormData();

  data.append("idLista", idLista);
  data.append("nombreLista", nombreLista);
  data.append("codigoLista", codigoLista);

  console.log (datos.value);
  $.ajax({

    url: "ajax/listas-precio.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {
      console.log("response", response);

      if (response == "ok") {

        Swal.fire(
          "Éxito",
          "Se ha modifificado la lista de precios.",
          "success"
        ).then((result) => {
          $('#modalEditar').modal('hide');

          // window.location = "listas-precios";
        })

      } else {

        Swal.fire(
          "Error",
          "Error en al guardar",
          "error"
        ).then((result) => {

          $('#modalEditar').modal('hide');

          // window.location = "listas-precios";
        })


      }

    },

    // error: function (response, err) {
    //   console.log('Error ' + err + " " + response);
    // }

  })
});*/