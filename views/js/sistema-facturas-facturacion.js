$("#frmFactClient").select2({ 

    width : 'resolve',
    theme: "classic",
    placeholder: 'Selecionar Cliente'

});

 
$("#frmFactActividad").select2({ 

  width : 'resolve',
  theme: "classic",
  placeholder: 'Selecionar Actividad Economica'

});
 

// $(".tipo_pago").select2({ 

//   width : 'resolve',
//   theme: "classic",
//   placeholder: 'tipos pago',
//   allowClear: true

// });


var Productosclientes ; 

Productosclientes = "ok"; 

let variable = "cookie_empresa";
let empresa =   leerCookie(variable);

//  $.ajax({

           
//            url:'ajax/datateble-sistema-facturas-facturacion.ajax.php?dato='+empresa,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        }); 







/* 

AGREGAR PRODUCTOS CELULARES

*/
  
var num = 0; 
$(".btnAgregar_producto").click(function() {

  num = num + 1;
// let empresa = $('option:selected','#empresaheader').val();

let variable = "cookie_empresa";
let empresa =   leerCookie(variable);
let id_cliente = $('option:selected', '#frmFactClient').val();
console.log("cliente " + id_cliente);
if (id_cliente == "") {
  Swal.fire(
    "Aviso",
    "Favor, seleccione primero un cliente para mostrar los productos.",
    "warning"
  ).then((result) => {
  }) 
} else {
  // console.log(empresa);
    var data = new FormData();

    data.append("ID_empresa", empresa); 
    data.append("ID_cliente", id_cliente);

    
        $.ajax({
    
              url:"ajax/sistema-facturas-facturacion.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
        
                console.log(response);
                $(".Agregar_Producto").append( 

            '<div class="row">' + 
              '<div class="col-xs-12 col-md-12">'   +                                  
                '<div class="input-group" style=" width: 100%;">'+
                  '<div class="input-group-prepend">'+
                  '<span style="font-size:15px; height: 35px;"  class="input-group-prepend"><button type="button" class="btn btn-primary btn-sm editDetalleMovil" idDiv="'+ num +'"><i class="far fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm quitarProd"><i class="far fa-times-circle"></i></button></span>'+
                  '</div>'+
                '<select  class="custom-select frmfactProd" style="font-size:15px; height: 35px;" class=""  id="frmfactProdSelect'+num+'" idDiv="'+ num +'" name="frmfactProdSelect" required>'+
                  '<option selected disabled value="" >Seleccionar Productos</option> ' +
                '</select> '+
                '</div>'+
                  '<br>'+
              '</div>'+

              '<div class="col-12 col-sm-12 col-md-6">'  +                            
              '<div class="input-group mb-6" style=" width: 100%;">'+
              '<div class="input-group-prepend">'+
                  '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-cart-arrow-down"></i></span>'+
              '</div>'+
              '<input type="text" style="font-size:100%;"  class="form-control frmFactCantidad" value="1" autocomplete="off" id="frmFactCantidad'+num+'" idDiv="'+ num +'" name="frmFactCantidad" required placeholder="Cantidad" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Agrega una cantidad de producto mayor a 0"  title="Agrega una cantidad de producto mayor a 0">'+
              '</div> '+
              '<br>'+
          '</div>'+

          '<div class="col-12 col-sm-12 col-md-6">'  +                            
          '<div class="input-group mb-6" style=" width: 100%;">'+
          '<div class="input-group-prepend">'+
              '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-percentage"></i></span>'+
          '</div>'+
          '<input type="text" style="font-size:100%;"  class="form-control frmFactdescuento"  value="0" autocomplete="off" id="frmFactdescuento'+num+'" idDiv="'+ num +'" name="frmFactdescuento'+num+'" required placeholder="Descuento" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Agrega un descuento entre 0 y 100" title="Agrega un descuento entre 0 y 100">'+
          '</div> '+
          '<br>'+
      '</div>'+

      '<div class="col-12 col-sm-12 col-md-6">'  +                            
      '<div class="input-group mb-6" style=" width: 100%;">'+
      '<div class="input-group-prepend">'+
          '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-caret-right"></i></span>'+
      '</div>'+
      '<input type="text" style="font-size:100%;"  class="form-control frmFactPreUnidmovil" autocomplete="off" id="frmFactPreUnidmovil'+num+'" idDiv="'+ num +'" name="frmFactPreUnidmovil'+num+'" value = "0" required placeholder="Precio unidad" >'+
      '</div> '+
      '<br>'+
  '</div>'+


      '<div class="col-12 col-sm-12 col-md-6" >'  +                            
      '<div class="input-group mb-6" style=" width: 100%;">'+
      '<div class="input-group-prepend">'+
          '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>'+
      '</div>'+
      '<input type="text" style="font-size:100%;"  class="form-control frmFactTotalProd" id="frmFactTotalProd'+num+'" name="frmFactTotalProd'+num+'" idDiv="'+ num +'" required placeholder="Total" disabled>'+
      '<input type="text" style="font-size:100%;"  class="form-control frmFactTotalProd2" id="frmFactTotalProd2'+num+'" name="frmFactTotalProd2'+num+'" idDiv="'+ num +'" required placeholder="Total" disabled hidden>'+
      '</div> '+
      '<br>'+
      '</div>'+
      '</div>'

        );

       

      //   $('.frmfactProd:last').select2({ 

      //     width : 'resolve',
      //     theme: "classic",
      //     placeholder: 'Selecionar Producto',
      //     selectionCssClass: 'font-size:15px; height: 50px; '
      // });

      for(var i = 0; i < response.length; i++){

        $(".frmfactProd").append('<option class="listProductos" value="'+response[i]["idtbl_equipos"]+'" nombre_equipo="'+response[i]["nombre"]+'" tipo_impuesto="'+response[i]["codigo_tarifa"]+'" Cod_impuesto="'+response[i]['codigo_impuesto']+'" SKU="'+response[i]["sku"]+'" CABIS="'+response[i]["cabys"]+'" PRECIO_UNIDAD="'+response[i]["precio_unidad"]+'" unidad_medida ="'+response[i]["unidad_medida"]+'" categoria ="'+response[i]["tipo"]+'">'+response[i]["nombre"]+'</option>')
      
      }

      },
          
      })
  
      AgregarProductos()
      calculoCantidadMovil("#frmFactCantidad"+num);
  }
});


var numPC = 0;
$("#tblProductosFacturacion").on("click", "button.btnProducto", function(){

  numPC = numPC + 1;  

let id_producto =   $(this).attr('idprod');

let id_cliente = $(this).attr('idCliente');


var data = new FormData();
data.append("id_client", id_cliente); 
data.append("id_producto", id_producto); 

     $.ajax({
 
          url:"ajax/sistema-facturas-facturacion.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  
          success: function(response){

            // console.log(response);

            $(".Agregar_Producto").append( 

              '<div class="row ">'+
              '<div class="col-xs-12 col-md-12">'   +                                  
                '<div class="input-group" style=" width: 100%;">'+
                  '<div class="input-group-prepend">'+
                    '<span style="font-size:15px; height: 35px;"  class="input-group-prepend"><button type="button" class="btn btn-outline-primary btn-sm editDetalle" idDiv="'+ numPC +'"><i class="far fa-edit"></i></button><button type="button" class="btn btn-outline-danger btn-sm quitarProd"><i class="far fa-times-circle"></i></button></span>'+
                  '</div>'+
                '<select  class="custom-select frmfactProd" style="font-size:15px; height: 35px;"  id="frmfactProdSelect'+ numPC +'" name="frmfactProdSelect" idDiv="'+ numPC +'" required>'+
                  '<option selected disabled value="'+response[0].idtbl_equipos+'" nombre_equipo="'+response[0].nombre+'" tipo_impuesto="'+response[0].codigo_tarifa+'" Cod_impuesto="'+response[0].codigo_impuesto+'"  SKU="'+response[0].sku+'" CABIS="'+response[0].cabys+'" PRECIO_UNIDAD="'+response[0].precio_unidad+'" unidad_medida ="'+response[0].unidad_medida+'" categoria="'+response[0].tipo+'">'+response[0].nombre+'</option> ' +
                '</select> '+
                '</div>'+
                  '<br>'+
              '</div>'+
  
              '<div class="col-6 col-sm-6 col-md-6">'  +                            
              '<div class="input-group mb-6" style=" width: 100%;">'+
              '<div class="input-group-prepend">'+
                  '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-cart-arrow-down"></i></span>'+
              '</div>'+
              '<input type="text"  style="font-size:100%;"  class="form-control frmFactcant" value="1" autocomplete="off" id="frmFactcant'+ numPC +'" idDiv="'+ numPC +'" name="frmFactcant" required placeholder="Cantidad" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Agrega una cantidad de producto mayor a 0"  title="Agrega una cantidad de producto mayor a 0">'+
              '</div> '+
              '<br>'+
          '</div>'+
  
          '<div class="col-6 col-sm-6 col-md-6">'  +                            
          '<div class="input-group mb-6" style=" width: 100%;">'+
          '<div class="input-group-prepend">'+
              '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-percentage"></i></span>'+
          '</div>'+
          '<input type="text" style="font-size:100%;"  class="form-control frmFactdesc" value="0" autocomplete="off" id="frmFactdesc'+ numPC +'" idDiv="'+ numPC +'" name="frmFactdesc" required placeholder="Descuento" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Agrega un descuento entre 0 y 100" title="Agrega un descuento entre 0 y 100" >'+
          '</div> '+
          '<br>'+
      '</div>'+

      '<div class="col-6 col-sm-6 col-md-6">'  +                            
      '<div class="input-group mb-6" style=" width: 100%;">'+
      '<div class="input-group-prepend">'+
          '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-caret-right"></i></span>'+
      '</div>'+
      '<input type="number" style="font-size:100%;"  class="form-control frmFactPreUnid" id="frmFactPreUnid'+ numPC +'" idDiv="'+ numPC +'" name="frmFactPreUnid" value="'+response[0].precio_unidad+'" required placeholder="Precio unidad">'+
      '</div> '+
      '<br>'+
  '</div>'+
  
      '<div class="col-6 col-sm-6 col-md-6">'  +                            
      '<div class="input-group mb-6" style=" width: 100%;">'+
      '<div class="input-group-prepend">'+
          '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>'+
      '</div>'+
      '<input type="text" style="font-size:100%;"  class="form-control frmFactTotalProd" id="frmFactTotalProd'+ numPC +'" idDiv="'+ numPC +'" name="frmFactced" required placeholder="Total" disabled hidden>'+
      '<input type="text" style="font-size:100%;"  class="form-control frmFactTotalProd2" id="frmFactTotalProd2'+ numPC +'" idDiv="'+ numPC +'" name="frmFactced2" required placeholder="Total" disabled>'+
      '</div> '+
      '<br>'+
      '</div>'+
      '</div>'
    
        );
      

        // style="margin: 0px 50%;"

      //   $('.frmfactProd:last').select2({ 

      //     width : 'resolve',
      //     theme: "classic",
      //     placeholder: 'Selecionar Producto',
      //     selectionCssClass: 'font-size:15px; height: 50px; '
      // });



      },
              
      })

      AgregarProductos_tabla();

     

        calculoCantidadDesktop("#frmFactcant"+numPC);
      

});


$("#frmFactClient").change(function() {

  let id_cliente = $('option:selected', this).val();
  
  $('#tblProductosFacturacion').fadeIn();

  var data = new FormData();

  data.append("id_cliente", id_cliente); 
  
       $.ajax({
   
            url:"ajax/sistema-facturas-facturacion.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
            success: function(response){
  

              $("#frmFactClientNombre").val(response[0].Nombre);
              $('#frmFactTced').val(response[0].tipo_cedula);
              $('#frmFactced').val(response[0].cedula);
              $('#frmFactced').attr('prov',response[0].provincia);
              $('#frmFactced').attr('cant',response[0].canton);
              $('#frmFactced').attr('dist',response[0].distrito);
              $('#frmFactmail').val(response[0].correo);

              //CARGAR TABLA DE PRODUCTOS DISPONIBLES


              $(document).ready(function() {
                if ( $.fn.DataTable.isDataTable('#tblProductosFacturacion') ) {
                $('#tblProductosFacturacion').DataTable().destroy();
              }
               var table = $("#tblProductosFacturacion").DataTable({
              
                "ajax": 'ajax/datatable-sistema-facturas-facturacion.ajax.php?dato='+empresa+'&idCliente='+id_cliente,  
                "async": "false",
                "responsive": true, 
                "lengthChange": false, 
                "autoWidth": true,
                "deferRender": true,
                "retrieve": true,
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
                              // table.buttons().container()
                              //     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
                          }
              
                  })
                
              });

            },
              
          })

});

$(".frmFactsucursal").change(function() {

  
  let sucursal = $('option:selected', this).attr('idSucursal');
  let empresa = $('option:selected','#empresaheader').val();
  
    var data = new FormData();
  
    data.append("sucursal", sucursal); 
    data.append("empresa", empresa); 
         $.ajax({
     
              url:"ajax/sistema-facturas-facturacion.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
    
// console.log(response);
$("#frmFactcaja").empty();
$("#frmFactcaja").append('<option disabled selected value="">Seleccionar Caja</option>');   
for(var i = 0; i < response.length; i++){  

  $("#frmFactcaja").append('<option value="'+response[i]["idcaja"]+'" >'+response[i]["nombre"]+'</option>');

}
              },
                
            })
  
  });


 
  
  $(".Agregar_Producto").on("click", "button.editDetalle", function(){

// console.log("hola"+ $(this).attr("idDiv"));
let idDiv = $(this).attr("idDiv");
// 

Swal.fire({
  title: "Ingrese un nuevo detalle",
  text: "Nombre del Producto",
  input: 'text',
  showCancelButton: true        
}).then((result) => {
  if (result.value) {
     
// console.log($("option:selected", "#frmfactProdSelect"+idDiv).attr("nombre_equipo"));
$("option:selected", "#frmfactProdSelect"+idDiv).attr("nombre_equipo", result.value);
$("option:selected", "#frmfactProdSelect"+idDiv).text(result.value);
$("option:selected","#frmfactProdSelect"+idDiv).html(result.value);

// $("#selector option[value=0]").html("Nuevo texto");

// $("option:selected", ".frmfactProd").val();

AgregarProductos_tabla();
AgregarProductos();

  }else{

   
  }
});




    });
    
$(".Agregar_Producto").on("click", "button.editDetalleMovil", function(){

let idDiv = $(this).attr("idDiv");
  
console.log("hola");

  Swal.fire({
    title: "Ingrese un nuevo detalle",
    text: "Nombre del Producto",
    input: 'text',
    showCancelButton: true        
  }).then((result) => {
    if (result.value) {
      
  // console.log($("option:selected", "#frmfactProdSelect"+idDiv).attr("nombre_equipo"));
  $("option:selected", "#frmfactProdSelect"+idDiv).attr("nombre_equipo", result.value);
  $("option:selected", "#frmfactProdSelect"+idDiv).text(result.value);
  $("option:selected","#frmfactProdSelect"+idDiv).html(result.value);

  // $("#selector option[value=0]").html("Nuevo texto");

  // $("option:selected", ".frmfactProd").val();

  AgregarProductos_tabla();
  AgregarProductos();

    }else{

    
    }
  });

});

$(".Agregar_Producto").on("click", "button.quitarProd", function(){

$(this).parent().parent().parent().parent().parent().remove();
AgregarProductos_tabla();
AgregarProductos();
sumarTotalimpuestos();
sumarTotalPrecios();
});


$(".Agregar_Producto").on("change", "input.frmFactcant", function(){

  calculoCantidadDesktop($(this));
//$(this).val();
  
});



$(".Agregar_Producto").on("change", "input.frmFactdesc", function(){

  calculoDescuentoDesktop($(this));
  
});

$(".Agregar_Producto").on("change", "input.frmFactPreUnid", function(){

  // calculoCantidadDesktop();
  let idDiv = $(this).attr('idDiv');

  calculoPrecioUnidadDesktop($(this));
  calculoDescuentoDesktop("#frmFactdesc"+idDiv);

//$(this).val();
  
});


/**************************
 *      VISTA MOVIL       *
 ***************************/
$(".Agregar_Producto").on("change", "input.frmFactCantidad", function(){
  calculoCantidadMovil("#frmFactCantidad"+$(this).attr('idDiv'));
})


$(".Agregar_Producto").on("change", "input.frmFactdescuento", function(){
  calculoDescuentoMovil("#frmFactdescuento"+$(this).attr('idDiv'));  
})

$(".Agregar_Producto").on("change", "select.frmfactProd", function(){
  
  let idDiv = $(this).attr('idDiv');

  let precioUni = $("option:selected", "#frmfactProdSelect"+idDiv).attr('PRECIO_UNIDAD');

  $("#frmFactPreUnidmovil"+idDiv).val(precioUni);

  calculoCantidadMovil("#frmFactCantidad"+$(this).attr('idDiv'));
})

$(".Agregar_Producto").on("change", "input.frmFactPreUnidmovil", function(){

  let idDiv = $(this).attr('idDiv');

  $("option:selected", "#frmfactProdSelect"+idDiv).attr("PRECIO_UNIDAD", $(this).val());


  calculoCantidadMovil("#frmFactCantidad"+idDiv);
  calculoDescuentoMovil("#frmFactdescuento"+idDiv);  
  sumarTotalPrecios();
  sumarTotalimpuestos();

//$(this).val();
  
});


/*********************************
*                               *
*          CALCULOS             *
*                               *
**********************************/

function calculoCantidadDesktop (cambio) {
  console.log(cambio);
  if ($(cambio).val() > 0) {
    //$(this).prop('disabled', "true");
    let id_div =  $(cambio).attr('idDiv');
    let precio_unitario = $('option:selected', "#frmfactProdSelect" + id_div).attr('PRECIO_UNIDAD');
    let cantidad = $(cambio).val();
    let impuesto = $('option:selected', "#frmfactProdSelect" + id_div).attr('tipo_impuesto');
    let total = parseFloat(precio_unitario) * parseFloat(cantidad);

    // console.log("hola",id_div);
    // console.log("hola",precio_unitario);

    // console.log("hola",total);

    $("#frmFactTotalProd"+ id_div).val(total);

    total = formatter.format(total);

    $("#frmFactTotalProd2"+ id_div).val(total);
    // $("#frmFactTotalProd2"+ id_div).formatter({format:"#,###", locale:"us"});

    sumarTotalPrecios();
    sumarTotalimpuestos();
    AgregarProductos_tabla();
  } else {
    Swal.fire(
      "Aviso",
      "La cantidad del producto debe ser un número mayor a 0.",
      "warning"
    ).then((result) => {
      $(cambio).val("");
    }) 
  }
}

const formatter = new Intl.NumberFormat('en-US', {
  //style: 'currency',
  style: "decimal",
  currency: 'USD',
minimumFractionDigits: 2
});


function calculoDescuentoDesktop(cambio) {
  console.log(cambio);
  if ($(cambio).val() >= 0  && $(cambio).val() <= 100) {
    //$(cambio).prop('disabled', "true");
    let id_div =  $(cambio).attr('idDiv');
    let total_producto = $('option:selected', "#frmfactProdSelect" + id_div).attr('PRECIO_UNIDAD'); 
    let descuento =  $(cambio).val();
    let cantidad = $("#frmFactcant"+id_div).val();
    let port_descuento = descuento / 100;
    let totaldesc =  parseFloat(total_producto * cantidad) * parseFloat(port_descuento);
    let precioFinal = parseFloat(total_producto * cantidad) - parseFloat(totaldesc);

    $("#frmFactTotalProd"+id_div).val(precioFinal);
    precioFinal = formatter.format(precioFinal);
    $("#frmFactTotalProd2"+id_div).val(precioFinal);
    // $("#frmFactTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
    sumarTotalPrecios();
    sumarTotalimpuestos();
    AgregarProductos_tabla();
  } else {
    Swal.fire(
      "Aviso",
      "El descuento debe ser un número entre 0 y 100.",
      "warning"
    ).then((result) => {
      $(cambio).val("");
    }) 
  }
}


function calculoPrecioUnidadDesktop (cambio) {
  console.log(cambio);
  if ($(cambio).val() > 0) {
    //$(this).prop('disabled', "true");
    let id_div =  $(cambio).attr('idDiv');

    $("option:selected", "#frmfactProdSelect"+id_div).attr("PRECIO_UNIDAD", $(cambio).val());

    calculoCantidadDesktop ("#frmFactcant"+id_div);
    calculoDescuentoDesktop("#frmFactdesc"+id_div);

    sumarTotalPrecios();
    sumarTotalimpuestos();
    AgregarProductos_tabla();
  } else {
    Swal.fire(
      "Aviso",
      "La precio del producto debe ser mayor a 0.",
      "warning"
    ).then((result) => {
      $(cambio).val("");
    }) 
  }
}




function calculoCantidadMovil(cambio) {
  if ($(cambio).val() > 0) {
    //$(cambio).prop('disabled', "true");
    let id_div = $(cambio).attr('idDiv');
    let precio_unidad = $("option:selected", "#frmfactProdSelect"+id_div).attr('PRECIO_UNIDAD');
    let cantidad = $(cambio).val();
    let total = parseFloat(cantidad * precio_unidad);

    $("#frmFactTotalProd"+id_div).val(total);
    total = formatter.format(total);
    $("#frmFactTotalProd2"+id_div).val(total);
    // $("#frmFactTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
    sumarTotalPrecios();
    sumarTotalimpuestos();
    AgregarProductos();
  } else {
    Swal.fire(
      "Aviso",
      "El descuento debe ser un número entre 0 y 100.",
      "warning"
    ).then((result) => {
      $(cambio).val("");
    }) 
  }
}

function calculoDescuentoMovil(cambio) {

console.log($(cambio).val());

  if ($(cambio).val() >= 0 && $(cambio).val() <= 100 ) {
    //$(cambio).prop('disabled', "true");
    let id_div = $(cambio).attr('idDiv');
    let precio_unidad = $("option:selected", "#frmfactProdSelect"+id_div).attr('PRECIO_UNIDAD');
    let cantidad = $("#frmFactCantidad"+id_div).val();
    let descuento = $(cambio).val();
    let port_descuento = descuento / 100;
    let totaldesc =  parseFloat(precio_unidad * cantidad) * parseFloat(port_descuento);
    let precioFinal = parseFloat(precio_unidad * cantidad) - parseFloat(totaldesc);

    $("#frmFactTotalProd"+id_div).val(precioFinal);
    precioFinal = formatter.format(precioFinal);
    $("#frmFactTotalProd2"+id_div).val(precioFinal);
    // $("#frmFactTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
    sumarTotalPrecios();
    sumarTotalimpuestos();
    AgregarProductos();
  } else {
    Swal.fire(
      "Aviso",
      "El descuento debe ser un número igual o mayor a 0.",
      "warning"
    ).then((result) => {
      $(cambio).val("");
    }) 
  }
}

function sumarTotalPrecios() {

  var precioItem = $(".frmFactTotalProd");
  
  // console.log(precioItem.val());
  //var impuestoItem = $(".tipo_impuesto").val();
  
      var arraySumaPrecio = [];
    
      // var arraypreciosImpuestos = [];
  
      for (var i = 0; i < precioItem.length; i++) {
        
          arraySumaPrecio.push(parseFloat($(precioItem[i]).val()));   
          // console.log(parseFloat($(precioItem[i]).val()));
      }
  
      function sumaArrayPrecios(total, numero) {
  
          return total + numero;
  
      }
  
  
  if (arraySumaPrecio.length <= 0){
      $("#frmFacttoSiniva").val(0); 
      $("#frmFacttoSiniva2").val(0); 
  }else {
  
      var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
      // console.log(sumaTotalPrecio);
  
      $("#frmFacttoSiniva").val(sumaTotalPrecio);
      sumaTotalPrecio = formatter.format(sumaTotalPrecio);
      $("#frmFacttoSiniva2").val(sumaTotalPrecio);

      // $("#frmFacttoSiniva2").formatNumber({format:"#,###", locale:"us"});
  }
  
  //  $(".frmFacttoSiniva").number(true , 2);
  
  }

  function sumarTotalimpuestos() {

    var precioItem = $(".frmFactTotalProd");
    // console.log("precioItem", precioItem);
    
    
    var impuestoItem = $("option:selected", ".frmfactProd");
    
    
    // var impuestoItem = $('option:selected', '.DescripcionProducto');
    // console.log("impuestoItem", impuestoItem);
    
        var arraySumaPrecio = [];
         var arraySumaPrecioIVA = []
        
        for (var i = 0; i < precioItem.length; i++) {
    
        if ($(impuestoItem[i]).attr("tipo_impuesto") == "08"){

            arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.13 + parseFloat($(precioItem[i]).val()));
    
            }else if($(impuestoItem).attr("tipo_impuesto") == "07"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.08 + parseFloat($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "06"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.04 + parseFloat($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "05"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "04"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.04 + parseFloat($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "03"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.02 + parseFloat($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "02"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.01 + parseFloat($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "01"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()));

            }
            else {
    
               arraySumaPrecio.push(Number($(precioItem[i]).val())); 
    
            }
    }
    
        function sumaArrayimpuestos(total, numero) {
    
            return total + numero;                   
    }
    
          if (arraySumaPrecioIVA.length <= 0){
              $("#frmFacttoIva").val(0);
              $("#frmFacttoIva2").val(0);
          }else {
    
              var sumaTotalPrecio = arraySumaPrecioIVA.reduce(sumaArrayimpuestos);
              // console.log(sumaTotalPrecio);
              $("#frmFacttoIva").val(sumaTotalPrecio);
              sumaTotalPrecio = formatter.format(sumaTotalPrecio);
              $("#frmFacttoIva2").val(sumaTotalPrecio);                
              // $("#frmFacttoIva2").formatNumber({format:"#,###", locale:"us"});
          } 
    }   
    

    function AgregarProductos_tabla(){


      var listaProductos_2 = [];
      
      
      /*=============================================
      = OPTENGO EL ATRIBUTO DEL OPTION  SELECT          =
      =============================================*/
      
      
      var selectProd = $('option:selected', '.frmfactProd');
      
      
      
      var cantidad = $(".frmFactcant");
      
      
      
      var descuento = $(".frmFactdesc");  
      
      
      for (var i = 0; i < selectProd.length; i++){
      
      listaProductos_2.push({"nombre": $(selectProd[i]).attr('nombre_equipo'),
                          "tipo_impuesto": $(selectProd[i]).attr('Cod_impuesto'),                         
                           "impuesto": $(selectProd[i]).attr('tipo_impuesto'),
                           "cantidad": $(cantidad[i]).val(),
                            "SKU": $(selectProd[i]).attr("SKU"),
                            "cabys":  $(selectProd[i]).attr("CABIS"),
                            "precio_unidad": $(selectProd[i]).attr("PRECIO_UNIDAD"),
                            "descuento":  $(descuento[i]).val(),
                            "medida": $(selectProd[i]).attr('unidad_medida'),
                            "categoria": $(selectProd[i]).attr('categoria')
                          });
      
      }
      
      
     console.log("listaProductos_2", listaProductos_2);
      return listaProductos_2;
      
      
      
      
      }

      function AgregarProductos(){


        var listaProductos = [];
        
        
        var selectProd = $('option:selected', '.frmfactProd');
        
        
        
        var cantidad = $(".frmFactCantidad");
        
        
        
        var descuento = $(".frmFactdescuento");  
      
        for (var i = 0; i < selectProd.length; i++){
        
        listaProductos.push({"nombre": $(selectProd[i]).attr('nombre_equipo'),
                             "tipo_impuesto": $(selectProd[i]).attr('Cod_impuesto'),                         
                             "impuesto": $(selectProd[i]).attr('tipo_impuesto'),
                             "cantidad": $(cantidad[i]).val(),
                              "SKU": $(selectProd[i]).attr("SKU"),
                              "cabys":  $(selectProd[i]).attr("CABIS"),
                              "precio_unidad": $(selectProd[i]).attr("PRECIO_UNIDAD"),
                              "descuento":  $(descuento[i]).val(),
                              "medida": $(selectProd[i]).attr('unidad_medida'),
                              "categoria": $(selectProd[i]).attr('categoria')
                            });
        
        }
        
        
       console.log("listaProductos", listaProductos);
        return listaProductos;
               
        }

      
        function AgregarDatosEmpresa(){


          var listaDatosEmpresa = [];
          
          
          let empresa = $('option:selected','#empresaheader').val();

        
          var data = new FormData();
  
          data.append("DatosEmpresa", empresa); 

               $.ajax({
           
                    url:"ajax/sistema-facturas-facturacion.ajax.php",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    dataType: "json",  
                    success: function(response){
          
      // console.log(response);
      for (var i = 0; i < response.length; i++){
          
        listaDatosEmpresa.push({"usuario": response[i].usuario_facturacion,
                             "password": response[i].contrasena_facturacion,                         
                             "cedula": response[i].cedula,
                             "id_empresa": response[i].idtbl_clientes,
                             "actividadEconomica" : response[i].cod_actividad
                              
                            });
        }
 
                    },
                      
                  })
          
        //  console.log("empresa", listaDatosEmpresa);
          return listaDatosEmpresa;
                 
          }      


function CargarUnidadMedida(id_unidad){

  var unidad = "";
  var data = new FormData();
  
  data.append("id_unidad", id_unidad); 

       $.ajax({
   
            url:"ajax/sistema-facturas-facturacion.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
            success: function(response){

              unidad = response[0].unidad;
            // console.log(response);

            },
                      
          })

return unidad;

}

  


$("#frmFactCondVenta").change(function() {

  console.log($(this).val());
if($(this).val() != "01"){

  $("#frmFactPlazoCred").removeAttr('readOnly');

}else{

  $("#frmFactPlazoCred").prop('readOnly', "true");
  $("#frmFactPlazoCred").val("0");
}



});

$(".Facturar3").click(function() {

console.log($('.tipo_pago').val());
console.log(JSON.stringify($('.tipo_pago').val()));

});



$(".Facturar").click(function() {
 
  $("#overlay2").fadeIn();

  setTimeout(function () { 

    $(this).prop('disabled', "true");

    var list = AgregarProductos_tabla();

    var datosempresa = AgregarDatosEmpresa();



  if(list == [] || list.length == 0 || list[0]['cantidad'] == "" || list[0]['cantidad'] == "undefined" || list[0]['cantidad'] == undefined){

    list = AgregarProductos();

  }
 
  //console.log("LISTA= " + list);

  if(list.length == 0){
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "Todos los datos son necesarios, por favor ingrese productos  a la lista.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;

  }


  /* 


  DECLARACION DE VARIABLES

  */
  var tipo_doc;
  var nombre;
  var tipo_cedula;
  var cedula;
  var correo;
  var tipos_pago;
  var tipoDocumento = document.querySelector('#radioTiquete').checked;
  var detalleFactura;
  var factura;
  var arrayFactura = [];
  var provincia ;
  var canton;
  var distrito;
  var sucursal;
  var caja;
  var tipo_pago;
  var medios_pago = [];
  var actividadEconomica;

  tipo_pago = $('.tipo_pago').val();
var condVenta = $('#frmFactCondVenta').val();
var plazoCred = $('#frmFactPlazoCred').val();



  {  for (var index = 0; index <= tipo_pago.length; index++) {
      
      console.log(index);
      if(tipo_pago[index] == "Efectivo"){

        medios_pago.push("01");
      }else if(tipo_pago[index] == "Tarjeta"){

        medios_pago.push("02");

      }else if(tipo_pago[index] == "Transferencia"){

        medios_pago.push("04");

      }else if(tipo_pago[index] == "Cheque"){

        medios_pago.push("03");

      }

      
    } 
  }

  // console.log(tipo_pago);
  // console.log(medios_pago);

  // return ;
 
  sucursal = $('option:selected','#frmFactsucursal').val();
  caja = $('option:selected','#frmFactcaja').val();
  provincia = $('#frmFactced').attr('prov');
  canton = $('#frmFactced').attr('cant');
  distrito = $('#frmFactced').attr('dist');
  // nombre = $('option:selected','#frmFactClient').text();
  nombre = $('#frmFactClientNombre').val();
  tipo_cedula = $('option:selected','#frmFactTced').val();
  cedula = $('#frmFactced').val();
  correo = $('#frmFactmail').val();
  actividadEconomica = $('option:selected','#frmFactActividad').val();
  ComentariosFactura = $('#frmFactComent').val();

if(provincia == "" || provincia == undefined){

  provincia = "0";
  canton = "0";
  distrito = "0";
}

  if(nombre == "" || tipo_cedula == "" || cedula == "" ){
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "Datos del cliente incompletos, favor actualizar los datos e intentar nuevamente.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;

  }else if(sucursal == "" || caja == "" || actividadEconomica == "" || condVenta == null || plazoCred == ""){
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "Seleccione una  sucursal / caja / actividad economica / Condición de Venta / Plazo de credito.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;

  } else if($("#frmFactMoneda").val() == "" || $("option:selected","#frmFactTipoMoneda").val() == "") {
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "Debes ingresar el tipo de moneda y su valor.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;
  } else if(tipo_pago.length == 0) {
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "Debes seleccionar el método de pago.",
      "warning"
    ).then((result) => {
      //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;
  }else if(ComentariosFactura.length > 450) {
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "El tamaño del comentario es mayor al permitido.",
      "warning"
    ).then((result) => {
      //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;
  }

  

  if(tipoDocumento){

    tipo_doc = "04";

  }else{

    tipo_doc = "01";

  }

  var tipoMoneda = $("#frmFactTipoMoneda").val();
  var tipoCambio = $("#frmFactMoneda").val();

  for (var i = 0; i < list.length; i++){
  /* 

  DECLARACIÓN DE VARIABLES

  */

  //console.log("lista cantidad: " + list[i]["cantidad"])
  if (list[i]["cantidad"] == "" || list[i]["cantidad"] == 0 || list[i]["cantidad"] == "undefined" || list[i]["cantidad"] == undefined ) {
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "La cantidad del producto debe ser un número mayor a 0.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;
  } 

  if(list[i]["descuento"] == "" || list[i]["descuento"] == "undefined" || list[i]["descuento"] == undefined) {
    $("#overlay2").fadeOut();
    Swal.fire(
      "Aviso",
      "El descuento del debe ser un número igual o mayor a 0.",
      "warning"
    ).then((result) => {
  //window.location = "reporte-sistema-facturacion";
    }) 
    $(this).removeAttr('disabled');
    return false;
  }


  var descuento = 0;
  var subTotal = 0;
  var totalDetalle = 0;
  var montoIVA = 0;
  var tasaIva = 0;
  var porDescuento = 0;
  let unidadMedida = CargarUnidadMedida(list[i]["medida"]);
  if(list[i]["tipo_impuesto"] != "0"){

  if(list[i]["impuesto"] == "02"){

    tasaIva = "1";

  }else if(list[i]["impuesto"] == "03"){

    tasaIva = "2";
  }else if(list[i]["impuesto"] == "04"){

    tasaIva = "4";
  }else if(list[i]["impuesto"] == "05"){
    tasaIva = "0";

  }else if(list[i]["impuesto"] == "06"){
    tasaIva = "4";

  }else if(list[i]["impuesto"] == "07"){

    tasaIva = "8";
  }else if(list[i]["impuesto"] == "08"){

    tasaIva = "13";
  }

  porDescuento = parseFloat(list[i]["descuento"]) / 100;

  descuento = parseFloat(list[i]["precio_unidad"] * list[i]["cantidad"]) * parseFloat(porDescuento);



        detalleFactura = {                            
          "numeroLinea":""+ (i + 1) +"",
          "cabys":""+ list[i]["cabys"] +"",
          "unidadMedida":""+unidadMedida+"",
          "tipoCodigoProducto":"01",
          "Codigo":""+ list[i]["SKU"] +"",
          "descripcionProducto":""+ list[i]["nombre"] +"",
          "cantidad":""+ list[i]["cantidad"] +"",
          "precioUnitario":""+ list[i]["precio_unidad"] +"",
          "costo":"0",
          "descuento":""+ descuento +"",
          "motivoDescuento":"Descuento",
          "subTotal":""+ subTotal +"",              
          "totalDetalle":""+ totalDetalle +"",                                  
          "tipoImpuesto":""+list[i]["tipo_impuesto"]+"",
          "codTasaImpuesto":""+list[i]["impuesto"]+"",
          "tasaImpuesto":""+tasaIva+"",
          "montoImpuesto":""+ montoIVA +"",
          "categoria":""+ list[i]["categoria"] +""

          }
        arrayFactura.push(detalleFactura);
        

  }else{

    porDescuento = parseFloat(list[i]["descuento"]) / 100;

    descuento = parseFloat(list[i]["precio_unidad"] * list[i]["cantidad"]) * parseFloat(porDescuento);

    detalleFactura = {                            
          "numeroLinea":""+ (i + 1) +"",
          "cabys":""+ list[i]["cabys"] +"",
          "unidadMedida":""+unidadMedida+"",
          "tipoCodigoProducto":"01",
          "Codigo":""+ list[i]["SKU"] +"",
          "descripcionProducto":""+ list[i]["nombre"] +"",
          "cantidad":""+ list[i]["cantidad"] +"",
          "precioUnitario":""+ list[i]["precio_unidad"] +"",
          "costo":"0",
          "descuento":""+ descuento +"",
          "motivoDescuento":"Descuento",
          "subTotal":""+ subTotal +"",              
          "totalDetalle":""+ totalDetalle +"",                                  
          "tipoImpuesto":"0",
          "codTasaImpuesto":"0",
          "tasaImpuesto":"0",
          "montoImpuesto":"0",
          "categoria":""+ list[i]["categoria"] +""                                              
          }

          arrayFactura.push(detalleFactura);

      }

  }

  factura  = {
    "fileContent":{

                "datosEmisor":{
                    "usuario": ""+datosempresa[0].usuario+"",
                    "password": ""+datosempresa[0].password+"",
                    "cedula":""+datosempresa[0].cedula+"",
                    "id_empresa":""+datosempresa[0].id_empresa+""   
                },     
                "datosReceptor":{
                    "nombre":""+ nombre.trimStart() +"",
                    "tipoCedula":""+tipo_cedula+"",
                    "cedula":""+cedula+"",
                    "direccion": "LOCAL COMERCIAL",
                    "correo":""+correo.trimStart()+"",
                    "telefono":"11111111",
                    "provincia": ""+provincia+"",
                    "canton": ""+canton+"",
                    "distrito": ""+distrito+"",
                    "senas": "LOCAL COMERCIAL"
                },          
                "datosFactura":{
                        "sucursal":""+sucursal+"",
                        "caja":""+caja+"",
                        "tipoDoc":""+ tipo_doc +"",
                        "moneda":""+tipoMoneda+"",                                                                     
                        "condicionVenta":""+ condVenta +"",
                        "plazoCredito":""+ plazoCred +"",
                        "medioPago":""+ tipo_pago +"",
                        "tipoCambio":""+tipoCambio+"",
                        "actividadEconomica":""+ actividadEconomica.padStart(6, "0") +"",
                        "api":"No",
                        "estadoAnulacion":"",
                        "comentario":""+ ComentariosFactura +"",
                        "detalleFactura":
                        arrayFactura                                                                       
                }
    }       


  }
 
  // console.log("Factura", factura);
  console.log("Factura", JSON.stringify(factura));


// return false;

  var data = new FormData();
  data.append("DatosFactura",JSON.stringify(factura)); 
  
    $.ajax({
  
            url:"ajax/sistema-facturas-facturacion.ajax.php", 
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  

            success: function(response){

              console.log(response);
        var respt  =  JSON.parse(response);
              if(respt["success"] == "true"){
                $("#overlay2").fadeOut();
                
                Swal.fire({
                  title: '¿Desea imprimir la factura?',
                  showDenyButton: true,
                  showCancelButton: false,
                  confirmButtonText: 'Imprimir',
                  denyButtonText: `No Imprimir`,
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                    // Swal.fire('Saved!', '', 'success')
                    window.open('machoteFactura?clave='+ respt["Clave"] +'');
                  } else if (result.isDenied) {
                    window.location = "sistema-facturas-facturacion";
                  }
                })

                setTimeout(function () { 

                location.reload();
            
              },7000)
              }else{
                
                $("#overlay2").fadeOut();
                Swal.fire(
                  "Error",
                  "Error al enviar el documento, favor revisar el estado.",
                  "error"
                ).then((result) => {
              window.location = "sistema-facturas-facturacion";
                }) 

              }

            }, 

            error: function(response, err){ console.log('my message ' + err + " " + response );}

    }) 
  },350)
});



function leerCookie(nombre) {
  var lista = document.cookie.split(";");
  for (i in lista) {
      var busca = lista[i].search(nombre);
      if (busca > -1) {micookie=lista[i]}
      }
  var igual = micookie.indexOf("=");
  var valor = micookie.substring(igual+1);
  return valor;
}


$("#frmFactTipoMoneda").change(function () {
  $(".monedaTotal").text($("#frmFactTipoMoneda").val());

  let date = new Date()

  let day = date.getDate()
  let month = date.getMonth() + 1
  let year = date.getFullYear()
  let fecha = "";
  if(month < 10){
    if (day < 10){
      fecha = (`0${day}/0${month}/${year}`);
    }else {
      fecha = (`${day}/0${month}/${year}`);
    }
  }else{
    if (day < 10){
      fecha = (`0${day}/${month}/${year}`);
    }else {
      fecha = (`${day}/${month}/${year}`);
    }
  }

  

      
  if ($("#frmFactTipoMoneda").val() == "USD") {
    $("#frmFactMoneda").attr("readonly", true);

    var data = new FormData();
    data.append("fechaMoneda",fecha);

    $.ajax({
      url:"ajax/sistema-facturas-facturacion.ajax.php", 
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  

      success: function(response){
      tipoCambio = response['Venta'];
       $("#frmFactMoneda").val(round(tipoCambio));

    },
      error: function(response, err){ console.log('my message ' + err + " " + response );}
    }) 


    
  } else if ($("#frmFactTipoMoneda").val() == "CRC") {
    $("#frmFactMoneda").val("1");
    $("#frmFactMoneda").attr("readonly", true);
  } else {
    $("#frmFactMoneda").attr("readonly", false); 
    $("#frmFactMoneda").val("");

    Swal.fire(
      "Aviso",
      "Favor, indicar el valor del tipo de cambio de moneda.",
      "warning"
    ).then((result) => {
  
    }) 
  }
})

function round(num) {
  var m = Number((Math.abs(num) * 100).toPrecision(15));
  return Math.round(m) / 100 * Math.sign(num);
}

$("#btnNewClient").click( function() {
  Swal.fire({
    title: "¡Atención!",
    text: "¿Deseas agregar o actualizar un cliente?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar'
  }).then((result)=>{
    if (result.isConfirmed) {
      window.location = "sistema-facturas-clientes";
    }
  })
});

$("#btnAgregarProducto").click( function() {
  Swal.fire({
    title: "¡Atención!",
    text: "¿Deseas agregar un producto?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar'
  }).then((result)=>{
    if (result.isConfirmed) {
      window.location = "sistema-facturas-productos";
    }
  })
});




$(".btnGuardardtsClient").click(function() {


let cedula = $("#frmAddCedulaCliente").val();
let nombre = $("#frmAddNombreCliente").val();
let tipo_cedula = $('option:selected','#frmAddTpCedula').val();
let lista_precio = $('option:selected','#frmAddListPrecio').val();
let empresa = $('option:selected','#empresaheader').val();
let correo = $("#frmAddCorreoCliente").val();
let exist = validarCedulaCliente(cedula, empresa);

console.log(exist);

if(exist == 1){

  return false;

}


if(cedula == "" || nombre == "" || tipo_cedula == "" || lista_precio == "" || empresa == ""){

  Swal.fire(
    "Aviso",
    "Todos los datos son requeridos, favor completar la información.",
    "warning"
  ).then((result) => {

  })

  return false;

}


  var data = new FormData();
  data.append("addCedula",cedula.trim());
  data.append("addNombre",nombre.trim());
  data.append("addTpCedula",tipo_cedula);
  data.append("addempresa", empresa);
  data.append("addListPrecio",lista_precio);
  data.append("addCorreo",correo.trim());
  

    $.ajax({
      url:"ajax/sistema-facturas-facturacion.ajax.php", 
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",  

      success: function(response){
    
        console.log(response);

        if(response.trim() == "ok"){

          Swal.fire(
            "Exelente",
            "Datos ingresados exitosamente.",
            "success"
          ).then((result) => {
        
          // Window.location = "sistema-facturas-facturacion";
          window.location = "sistema-facturas-facturacion";


          })

        }else{
          Swal.fire(
            "Error",
            "Error al ingresar los datos, favor validar informacion e intentar nuevamente.",
            "warning"
          ).then((result) => {
        
            // Window.location = "sistema-facturas-facturacion";
            window.location = "sistema-facturas-facturacion";


          })

        }

    },
      error: function(response, err){ console.log('my message ' + err + " " + response );}
    }) 

});


$("#frmAddCedulaCliente").change(function () {

  $(".alert").remove();

let cedula = $(this).val();

  var data = new FormData();
  data.append("CedulaSearch",cedula);

  $.ajax({
    url:"ajax/sistema-facturas-facturacion.ajax.php", 
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",  

    success: function(response){

      // console.log(response);
  //     console.log(response["results"][0].fullname);
  // console.log(response["results"][0].guess_type);

if(!response){

return false;

}else{

  if(response["results"][0].guess_type == "FISICA"){

    $('#frmAddTpCedula').val("01");

  }else if (response["results"][0].guess_type == "JURIDICA"){

    $('#frmAddTpCedula').val("02");

  }else if (response["results"][0].guess_type == "DIMEX/NITE"){

    $('#frmAddTpCedula').val("03");

  }

  $('#frmAddNombreCliente').val(response["results"][0].fullname);
  

}



  },
    error: function(response, err){ console.log('my message ' + err + " " + response );}
  }) 



});



function validarCedulaCliente(cedula, idmpresa){

let resp = 0;

    $(".alert").remove();
        
    var data = new FormData();
    
        data.append("empresaVal",idmpresa); 
        data.append("cedulaVal",cedula.trim());
       
    
             $.ajax({
         
                  url:"ajax/sistema-facturas-clientes.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
    
    // console.log(response);
    
                if(response[0] == "1"){
    
                $('#frmAddCedulaCliente').parent().after('<div class="alert alert-warning">Cliente ya existe en Sistema! </div>');
    
                resp = 1;

               
    
                }else{

                  resp = 0;
                }
    
            },
    
                   error: function(response, err){ console.log('my message ' + err + " " + response );}
    
             })
    
             return resp;
}


$("#frmFactced").change(function () {

    let cedula = $(this).val();

    var data = new FormData();
    data.append("CedulaSearch",cedula);

    $.ajax({
      url:"ajax/sistema-facturas-facturacion.ajax.php", 
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      dataType: "json",  

      success: function(response){

        // console.log(response);
    //     console.log(response["results"][0].fullname);
    // console.log(response["results"][0].guess_type);

  if(!response){

  return false;

  }else{

    if(response["results"][0].guess_type == "FISICA"){

      $('#frmFactTced').val("01");

    }else if (response["results"][0].guess_type == "JURIDICA"){

      $('#frmFactTced').val("02");

    }else if (response["results"][0].guess_type == "DIMEX/NITE"){

      $('#frmFactTced').val("03");

    }

    $('#frmFactClientNombre').val(response["results"][0].fullname);
    

  }


    },
      error: function(response, err){ console.log('my message ' + err + " " + response );}
    }) 


});

