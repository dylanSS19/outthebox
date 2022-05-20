var productos;

productos = "ok";
 


// $.ajax({


// 	          url:'ajax/datatable-sistema-facturas-productos.ajax.php?dato='+productos,
// 	          async: false,
// 	          success: function(response){


// 	       console.log("respuesta",response);

// 	             },

// 	      });


// $(document).ready(function() {
if ($.fn.DataTable.isDataTable('#tablaReportProductos')) {
  $('#tablaReportProductos').DataTable().destroy();
}
var table = $("#tablaReportProductos").DataTable({

  "ajax": 'ajax/datatable-sistema-facturas-productos.ajax.php?dato=' + productos,
  "async": "false",
  "responsive": true,
  "lengthChange": false,
  "autoWidth": true,
  "deferRender": true,
  "retrieve": true,
  // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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
  initComplete: function () {
    // table.buttons().container()
    //     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
  }

})

// });







$("#frmProductounidadMedidaProducto").select2({

  width: 'resolve',
  theme: "classic",
  placeholder: 'Selecionar Unidad Medida'

});



$("#frmProductotarifaIva").select2({

  width: 'resolve',
  theme: "classic",
  placeholder: 'Selecionar Tarifa IVA'

});

$("#frmProductoCodImpuesto").select2({

  width: 'resolve',
  theme: "classic",
  placeholder: 'Selecionar Impuesto'

});

// $("#frmProductoEditunidadMedidaProducto").select2({

//     width : 'resolve',
//     heigth: '100%',
//     theme: "classic",
//     placeholder: 'Selecionar Unidad Medida'

// });



// $("#frmProductoEdittarifaIva").select2({

//     width : 'resolve',
//     heigth: '100%',
//     theme: "classic",
//     placeholder: 'Selecionar Tarifa IVA'

// });





$("#frmProductosearch").click(function () {

  $('#modalCabys').modal('show'); // abrir

  $("#frmProductoCabysSearch").val($("#frmProductolblsearch").val());

  CargarApiCabysprod($("#frmProductolblsearch").val())

});


$("#frmEditProductosearch").click(function () {

  $('#modalCabys').modal('show'); // abrir

  $("#frmProductoCabysSearch").val($("#frmProductolblsearch").val());

  CargarApiCabysprod($("#frmProductoCabysSearch").val())
});


$(".BuscarCabys").click(function () {

  let nombreProducto = $('#frmProductoCabysSearch').val();

  CargarApiCabysprod(nombreProducto);

});



function CargarApiCabysprod(nombreProducto) {

  // $.ajax({


  //           url:'ajax/datatable-sistema-facturas-cabys.ajax.php?cabysSearch='+nombreProducto,
  //           async: false,
  //            // dataType: "json",
  //           success: function(response){


  //        console.log("respuesta",response);

  //              },

  //       });

  if ($.fn.DataTable.isDataTable('#tablaProductos')) {
    $('#tablaProductos').DataTable().destroy();
  }


  // var table = $('#tablaProductos').removeAttr('width').DataTable( {
  var table = $("#tablaProductos").DataTable({

    "ajax": 'ajax/datatable-sistema-facturas-cabys.ajax.php?cabysSearch=' + nombreProducto,
    "async": "false",
    "columnDefs": [{
      "width": "10%",
      "targets": 0
    }],
    "fixedColumns": true,
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

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
    initComplete: function customEvent(e) {
      // table.search(e.value).draw(table.responsive.recalc());  ///Must trigger the draw event, but move on to the next line while it's being processed/
      // Essentially has no effect.
    }



  })

}




$("#tablaProductos").on("click", "button.btnAddNunCabys", function () {
  // $(".btnAddNunCabys").click(function() {

  // $(this).attr('desc');
  console.log("$(this).attr('desc')", $(this).attr('desc'));

  let descripcion = $(this).attr('desc');

  let cabys = $(this).attr('cod');

  if ($('#modalProductos').is(':visible')) {

    $("#frmProductolblsearch").val("");
    $("#frmProductolblsearch").val(cabys);
    $("#frmProductodescripcion").val(descripcion);
    $('#frmProductolblsearch').attr('readonly', true);

    $("#frmProductoCabysSearch").val("");


    $('#modalCabys').modal('hide');


  } else {

    $("#frmProductoEditlblsearch").val("");
    $("#frmProductoEditlblsearch").val(cabys);
    $("#frmProductoEditdescripcion").val(descripcion);
    $('#frmProductoEditlblsearch').attr('readonly', true);

    $("#frmProductoCabysSearch").val("");


    $('#modalCabys').modal('hide'); // abrir

  }


})



$("#frmProductolblsearch").keypress(function (e) {

  let iChars = "!#$%^&*()+=[]\\\';/{}|\":<>?¿/°";
  /*=============================================
  =         PERMITE EL INGRESO DE - , @           =
  =============================================*/
  if (iChars.indexOf(e.key) != -1) {
    // alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
    return false;
  }

});


$("#frmProductoCodComercial").change(function() {
  let codProducto = $("#frmProductoCodComercial").val();

  var data = new FormData();

  data.append("codProducto", codProducto.trim());

  $.ajax({

    url: "ajax/sistema-facturas-productos.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {

      console.log("response", response);

      if (response != false) {

        Swal.fire(
          "ERROR",
          "Este código del comercial ya existe.",
          "error"
        ).then((result) => {
          $("#frmProductoCodComercial").val("");
        }) 
      } 
    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response);
    }

  })
});

 
//GUARDAR LOS PRODUCTOS

$(".btnGuardarProductos").click(function () {
  $.ajax({

    url: "ajax/sistema-facturas-productos.ajax.php?verificarListasPrecios=ok",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {

      //console.log("response", response);

      if (response == false) {

        Swal.fire({
            title: "AVISO",
            text: "No puedes agregar un producto sin antes haber creado una lista de precio, ¿Desea crear una lista de precios?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#f7505a',
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
      
          }).then(function(isConfirm) {
            if(isConfirm.value){
              window.location = "listas-precios";
            }
          });
        
      
        
      } else {
        // console.log(idClienteEmpresa);
  // return false;

  // let id_empresa =  $('option:selected', '#empresaheader').val();
  
  
  let cabys = $('#frmProductolblsearch').val();
  let codigo_comercial = $('#frmProductoCodComercial').val();
  let id_unidad_medida = $('option:selected', '#frmProductounidadMedidaProducto').val();
  let tarifa_iva = $('option:selected', '#frmProductotarifaIva').val();
  let cantidad = $('#frmProductocant').val();
  let descripcion = $('#frmProductodescripcion').val();
  let codigo_impuesto = $('option:selected', '#frmProductoCodImpuesto').val();
  let categoria = $('option:selected','#frmProductoCategoria').val();

  
if(descripcion.length > 200){

  Swal.fire(
    "Aviso",
    "Longitud de la descripción es mayor a lo permitido por hacienda (200 caracteres).",
    "warning"
  ).then((result) => {

    window.location = "sistema-facturas-productos";
  })
  return false;

}

  if (cabys == "" || codigo_comercial == "" || id_unidad_medida == "" || tarifa_iva == "" || cantidad == "" || descripcion == "" || codigo_impuesto == "" || categoria == "") {

    Swal.fire(
      "Aviso",
      "Todos los datos son necesario, no dejar campos vacios.",
      "warning"
    ).then((result) => {

      window.location = "sistema-facturas-productos";
    })


    return false;


  } else {

 
    var data = new FormData();

    data.append("cabys", cabys.trim());
    data.append("codigo", codigo_comercial.trim());
    data.append("unidad", id_unidad_medida);
    data.append("tarifa", tarifa_iva);
    data.append("cantidad", cantidad.trim());
    data.append("descripcion", descripcion.trim());
    data.append("codImpuesto", codigo_impuesto);
    data.append("categoria", categoria);
  
    $.ajax({

      url: "ajax/sistema-facturas-productos.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",
      success: function (response) {

        console.log("response", response);

        if (response.trim() == "ok") {

          Swal.fire(
            "Aviso",
            "Datos ingresados correctamente.",
            "success"
          ).then((result) => {

            window.location = "sistema-facturas-productos";
          })



        } else {


          Swal.fire(
            "Fallo",
            "Error al ingresar los datos intente nuevamente.",
            "error"
          ).then((result) => {

            window.location = "sistema-facturas-productos";
          })

        }


      },

      error: function (response, err) {
        console.log('my message ' + err + " " + response);
      }

    })



  }


      }
    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response);
    }

  })
  
})






$("#tablaReportProductos").on("click", "button.btnProducto", function () {

  let id_empresa = $(this).attr('idprod');

  var data = new FormData();

  data.append("producto", id_empresa);

  $.ajax({

    url: "ajax/sistema-facturas-productos.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {

      console.log("response", response);
      $('#id_cliente').val(response[0].idtbl_equipos);
      $('#frmProductoEditlblsearch').val(response[0].cabys);
      $('#frmProductoEditCodComercial').val(response[0].sku);
      $('#frmProductoEditcant').val(response[0].cantidad);
      $('#frmProductoEditdescripcion').val(response[0].nombre);
      $('#frmProductoEditCodImpuesto').val(response[0].impuestos);

      const option = document.querySelector('#frmProductoEditunidadMedidaProducto');
      const valor = response[0].unidad_medida;
      option.value = valor;

      const option2 = document.querySelector('#frmProductoEdittarifaIva');
      const valor2 = response[0].tarifa_iva;
      option2.value = valor2;


      const option3 = document.querySelector('#frmProductoEditCategoria');
      const valor3 = response[0].tipo;
      option3.value = valor3;


    },

    error: function (response, err) {
      console.log('my message ' + err + " " + response);
    }

  })


  $('#modalEditarProductos').modal('show'); // abrir


});


$(".btneditarProductos").click(function () {

  let id_producto = $('#id_cliente').val();
  let cabys = $('#frmProductoEditlblsearch').val();
  let codigo_comercial = $('#frmProductoEditCodComercial').val();
  let id_unidad_medida = $('option:selected', '#frmProductoEditunidadMedidaProducto').val();
  let tarifa_iva = $('option:selected', '#frmProductoEdittarifaIva').val();
  let cantidad = $('#frmProductoEditcant').val();
  let descripcion = $('#frmProductoEditdescripcion').val();
  let Cod_impuesto = $('option:selected', '#frmProductoEditCodImpuesto').val();
  let categoria = $('option:selected', '#frmProductoEditCategoria').val();


  if (cabys.length < 13 || cabys.length > 13) {

    Swal.fire(
      "Aviso",
      "El código cabys ingresado no cuenta con el formato correcto (13 digitos).",
      "warning"
    ).then((result) => {
      
    })

  }

  if (cabys == "" || codigo_comercial == "" || id_unidad_medida == "" || tarifa_iva == "" || cantidad == "" || descripcion == "" || Cod_impuesto == "" || categoria == "") {

    Swal.fire(
      "Aviso",
      "Todos los datos son necesario, no dejar campos vacios.",
      "warning"
    ).then((result) => {


      // window.location = "reporte-sistema-facturacion";
    })


    return false;

  } else {


    var data = new FormData();

    data.append("Idproducto", id_producto);
    data.append("Editcabys", cabys.trim());
    data.append("Editcodigo", codigo_comercial.trim());
    data.append("Editunidad", id_unidad_medida);
    data.append("Edittarifa", tarifa_iva);
    data.append("Editcantidad", cantidad.trim());
    data.append("Editdescripcion", descripcion.trim());
    data.append("Editcodigo_impuesto", Cod_impuesto);
    data.append("Editcategoria", categoria);

    $.ajax({

      url: "ajax/sistema-facturas-productos.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",
      success: function (response) {

        console.log("response", response);


        if (response.trim() == "ok") {

          Swal.fire(
            "Aviso",
            "Datos ingresados correctamente.",
            "success"
          ).then((result) => {

            window.location = "sistema-facturas-productos";
          })



        } else {


          Swal.fire(
            "Fallo",
            "Error al ingresar los datos intente nuevamente.",
            "error"
          ).then((result) => {

            window.location = "sistema-facturas-productos";
          })




        }

      },

      error: function (response, err) {
        console.log('my message ' + err + " " + response);
      }

    })


  }


});




$("#frmProductoEditlblsearch").click(function () {

  let cabys = ""

  cabys = $(this).val();


  if (cabys.length < 13 || cabys.length > 13) {

    Swal.fire(
      "Aviso",
      "El código cabys ingresado no cuenta con el formato correcto (13 digitos).",
      "warning"
    ).then((result) => {

      window.location = "sistema-facturas-productos";
    })

  } else {}





});

function leerCookie(nombre) {
  var lista = document.cookie.split(";");
  for (i in lista) {
    var busca = lista[i].search(nombre);
    if (busca > -1) {
      micookie = lista[i]
    }
  }
  var igual = micookie.indexOf("=");
  var valor = micookie.substring(igual + 1);
  return valor;
}

$("#tablaReportProductos").on("click", "button.btnListaPrecio", function () {

  if ($.fn.DataTable.isDataTable('#tablaListaPrecios')) {
    $('#tablaListaPrecios').DataTable().destroy();
    $('#tablaListaPrecios').DataTable().destroy().MakeCellsEditable("destroy");
  }
  
  $("#idProductoModal").val($(this).attr("idprod"));

  $("#sku").val($(this).attr("sku"));
  $('#modalListaPrecios').modal('show');

  
  var idprod = $("#idProductoModal").val();
  var table = $("#tablaListaPrecios").DataTable({

    "ajax": 'ajax/datatable-sistema-facturas-productos.ajax.php?idprod=' + idprod,
    "async": "false",
    "responsive": true,
    "lengthChange": false,
    "autoWidth": true,
    "deferRender": true,
    "retrieve": true,
    "order":[],
    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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
        "sPrevious": "Anterior",
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }

  });

  table.MakeCellsEditable({
    "columns": [3],
    "onUpdate": update
  });

  cargarTipoCosto();
  

});

function cargarTipoCosto() {
  var data = new FormData();
  data.append("sku",$("#sku").val());
  $.ajax({
    url: "ajax/datatable-sistema-facturas-productos.ajax.php?chkTipoCosto=ok",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",

    success: function (response) {

      if (response[0]["tipo_costo"] == "ultimo"){
        $('#ultimo').iCheck('check');
      } else if (response[0]["tipo_costo"] == "promedio") {
        $('#promedio').iCheck('check');
      }
    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response.data);
    }
  });
}

function update(updatedCell,updatedRow ) {
  var data = new FormData();
  datos = calcular(updatedRow.data());
  console.log(datos);
  //console.log(datos['id']);
  if("id",datos['id']) {
    data.append("id",datos['id']);
    data.append("nombre",datos['nombre']);
    data.append("precio",datos['precio']);
    data.append("costo",datos['costo']);
    data.append("margen",datos['margen']);
    data.append("porcentaje",datos['porcentaje']);

  $.ajax({
    url: "ajax/datatable-sistema-facturas-productos.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",

    success: function (response) {
      //console.log("response", response);

      //console.log("response: " + response);
      if (response == "ok") {
       refreshTableListaPrecio();
        
        
      }
    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response.data);
    }
  })

  } else {
    data.append("idProducto", $("#idProductoModal").val());
    data.append("nombre",datos['nombre']);
    data.append("precio",datos['precio']);
    data.append("costo",datos['costo']);
    data.append("margen",datos['margen']);
    data.append("porcentaje",datos['porcentaje']);
  }
  $.ajax({
    url: "ajax/datatable-sistema-facturas-productos.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",

    success: function (response) {
      //console.log("response", response);

      //console.log("response: " + response);
      if (response == "ok") {
       refreshTableListaPrecio();
      }
    },
    error: function (response, err) {
      console.log('my message ' + err + " " + response.data);
    }
  })

}

function calcular(result) {
  //console.log(result);

  precio = result[3].replace('₡','');
  costo = result[4].replace('₡','');
  margen = precio-costo;
  porcentaje = ((precio-costo)/precio)*100;


  lista =  {id: `${result[1]}`,
            nombre: `${result[2]}`,
            precio: `${precio}`,
            costo: `${costo}`,
            margen: `${margen}`,
            porcentaje: `${porcentaje}`};

  return lista;
}


$('input[type=radio][name=chkCostos]').on('ifClicked', function(event){


  if ($('input[type=radio][name=chkCostos]:checked').val()) {
    sku = $("#sku").val();
    if ($('input[type=radio][name=chkCostos]:checked').val() == "ultimo"){
      tipoCosto = "promedio";
    } else if ($('input[type=radio][name=chkCostos]:checked').val() == "promedio") {
      tipoCosto = "ultimo";
    }

    var datos= new FormData();

    datos.append("skuChange", sku);
    datos.append("costoChange", tipoCosto);

    //CAMBIAR TIPO DE COSTO EN BASE DE DATOS
    $.ajax({
      url: "ajax/datatable-sistema-facturas-productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",

      success: function (response) {
        console.log(response);
      },
      error: function (response, err) {
        console.log('my message ' + err + " " + response.data);
      }
    })


    var data = new FormData();
    data.append("sku",sku);
    data.append("tipoCosto",tipoCosto);

    $.ajax({
      url: "ajax/datatable-sistema-facturas-productos.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",

      success: function (response) {
        var rows = [];
        var row = [];
        if(response != ''){

          /* OBTENER TODAS LAS FILAS DE LA TABLA */
          $("#tablaListaPrecios").each(function() {
            $(this).find('tr').each(function() {
              row = [];
              $(this).find('td').each(function() {

                if($(this).html()){
                  row.push($(this).html());
                }

              })
              if(row.length > 0) {
                rows.push(row.join());
              }
            })
          });

          var count = 0;
          rows.forEach(fila => {
            lista = fila.split(',');
            
              precio = lista[3].replace('₡','');
              costo = response[0]["ultimoCosto"];
              margen = precio-costo;
              porcentaje = ((precio-costo[1])/precio)*100;
      
              
            
            

            

            var data = new FormData();
            data.append("id",lista[1]);
            data.append("nombre",lista[2]);
            data.append("precio",precio);
            data.append("costo",costo);
            data.append("margen",margen);
            data.append("porcentaje",porcentaje);

            $.ajax({
              url: "ajax/datatable-sistema-facturas-productos.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",
          
              success: function (response) {
                // alert("ok")
              }

            })

            count++;
          })

         refreshTableListaPrecio();

        } else {

          /* OBTENER TODAS LAS FILAS DE LA TABLA */
          $("#tablaListaPrecios").each(function() {
            $(this).find('tr').each(function() {
              row = [];
              $(this).find('td').each(function() {

                if($(this).html()){
                  row.push($(this).html());
                }
              })
              if(row.length > 0) {
                rows.push(row.join());
              }
            })
          });

          var count = 0;
          rows.forEach(fila => {
            lista = fila.split();

            precio = lista[count][3].split(' ');
            costo = 0;
            margen = precio[0][1]-costo;
            porcentaje = ((precio[1]-costo)/precio[1])*100;

            

            var data = new FormData();
            data.append("id",lista[count][1]);
            data.append("nombre",lista[count][2]);
            data.append("precio",precio[1]);
            data.append("costo",costo);
            data.append("margen",margen);
            data.append("porcentaje",porcentaje);

            $.ajax({
              url: "ajax/datatable-sistema-facturas-productos.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",

              success: function (response) {
                // alert("ok")
              }

            })

            count++;
          })

          refreshTableListaPrecio();
        }

      },
      error: function (response, err) {
        console.log('my message ' + err + " " + response.data);
      }
    })

  }

})

function refreshTableListaPrecio() {
  if ($.fn.DataTable.isDataTable('#tablaListaPrecios')) {
    var idprod = $("#idProductoModal").val();
    $('#tablaListaPrecios').DataTable().destroy();
    $('#tablaListaPrecios').DataTable().destroy().MakeCellsEditable("destroy");
  }
  

  table = $("#tablaListaPrecios").DataTable({

    "ajax": 'ajax/datatable-sistema-facturas-productos.ajax.php?idprod=' + idprod,
    "async": "false",
    "responsive": true,
    "lengthChange": false,
    "autoWidth": true,
    "deferRender": true,
    "retrieve": true,
    "order":[],
    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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
        "sPrevious": "Anterior",
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },




  });

  table.MakeCellsEditable({
    "columns": [3],
    "onUpdate": update
  });

}

//CAMBIO DE NOMBRE ARCHIVO EN EL INPUT 
var input = document.getElementById('inputCsvProductos');
var infoArea = document.getElementById('labelCsvProductos');

input.addEventListener('change', showFileName);

function showFileName(event) {
  var input2 = event.srcElement;
  //console.log("input2", input2);
  var fileName2 = input2.files[0].name;
  //console.log("fileName2", fileName2);
  document.getElementById('labelCsvProductos').innerHTML = 'Archivo: ' + fileName2;
}


$("#btnGuardarListaProductos").click(function () {
  $("#overlay2").fadeIn();
  console.log($("#inputCsvProductos").val())
  const fileName = $("#inputCsvProductos").val();
  let data = "";
  if (getExtension(fileName)) {

    $('#inputCsvProductos').parse({
      config: {
              header: true,
              dynamicTyping: true,
              complete: function(results) {
                console.log(results);

                data = JSON.stringify(results.data);
 

                let formData = new FormData();

                formData.append("listaProductos", data);

                $.ajax({
                  url: "ajax/sistema-facturas-productos.ajax.php",
                  method: "POST",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  //dataType: "json",

                  success: function (response) {
                    response = response.replace(' ', '');
                    $("#overlay2").fadeOut();
                    if(response == 'ok'){
                      Swal.fire(
                        "¡Éxito!",
                        "Se han registrado correctamente los productos.",
                        "success"
                      ).then((result) => {
                      window.location = "sistema-facturas-productos";
                    })
                    } else {
                      Swal.fire(
                        "¡Error!",
                        "Lo sentimos, ha ocurrido un error, por favor intente de nuevo.",
                        "error"
                    ).then((result) => {
                      window.location = "sistema-facturas-productos";
              
                    })
                    }
                  }

                })
              }
      },
    
    });

    

    

  }

  
});

$("#inputCsvProductos").change(function () {
  var archivo = this.files[0];

  console.log(archivo)
  if(archivo["type"] != "application/vnd.ms-excel") {
    //this.val("");
    Swal.fire(
      "Atención",
      "Formato del Archivo no es valido, favor utilizar el machote dado.",
      "warning"
    )
  }
})


function getExtension(filename) {

  let extencion = filename.split('.').pop();

  if(extencion.toLowerCase() != "csv"){

      Swal.fire(
          "Aviso",
          "Formato del Archivo no es valido, favor utilizar el machote dado.",
          "warning"
      ).then((result) => {
        $("#inputCsvProductos").empty();

      })

  return false;

  } return true;

}   


$(".btnDocumentacionProductos").click(function() {



var data = new FormData();

    data.append("datos", "empresa");
         
    $.ajax({

        url:"extensions/Excel/vendor/unidadMedida.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        // dataType: "json", 
        success: function(response){

             var zip = new JSZip();
  var count = 0;
  var count2 = 0;
  var zipFilename = 'GuiaCreacionProductos.zip';
  var nameFromURL = [];
  var urls = [];
  let urldom1 = './extensions/DocumentacionProductos/GUIA ESTRUCTURA BASICA.xlsx';
  urls.push(urldom1);
  let urldom2 = './extensions/DocumentacionProductos/MACHOTE PARA AGREGAR PRODUCTOS.csv';
  urls.push(urldom2);
  let urldom3 = './extensions/DocumentacionProductos/DOCUMENTACION-CODIGOS.xlsx';
  urls.push(urldom3);


  var the_arr = "";
  for (var i = 0; i< urls.length; i++){
      the_arr = urls[i].split('/');
      nameFromURL[i] = the_arr.pop();
  }

  urls.forEach(function(url){
      var filename = nameFromURL[count2];
      count2++;
      // loading a file and add it in a zip file
      JSZipUtils.getBinaryContent(url, function (err, data) {
          if(err) {
              throw err; // or handle the error
          }
          zip.file(filename, data, {binary:true});
          count++;
          if (count === urls.length) {
              zip.generateAsync({type:'blob'}).then(function(content) {
                  saveAs(content, zipFilename);
              });
          }
      });
  });

 // windowOpened.close();
          
        },

        error: function(response, err){ console.log('my message ' + err + " " + response );}
    })



  //let windowOpened = window.open("extensions/Excel/vendor/unidadMedida.php");


});