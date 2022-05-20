let valcookie = "cookie_empresa";
let idempresa =   leerCookie(valcookie);
// let ListaPrecio = 'precio_d'
// let ListaTope = 'precio_d'
//  $.ajax({

           
//            url:'ajax/datateble-sistema-facturas-crearFactura.ajax.php?dato='+idempresa+'&listPrecio='+ListaPrecio+'&listTope='+ListaTope,
//            async: false,
//            success: function(response){

         
//         console.log("respuesta",response);
                
//               },

//        }); 

$(document).ready(function() {

    CargarTabla();
  
});

var numeroPC = 0;
$("#tblProdCreFact").on("click", "button.btnProdCrear", function(){

    numeroPC = numeroPC + 1;  
let listaP = $( "option:selected" , "#frmCrearFactLista").val();

console.log(listaP);

let precio; 
let tope;

    if(listaP == "A"){

        precio = "precio_a";
        tope= "tope_a";
        
    }else if(listaP == "B"){

        precio = "precio_b";
        tope= "tope_a";

    }else if(listaP == "C"){

        precio = "precio_c";
        tope= "tope_a";

    }else if(listaP == "D"){

        precio = "precio_d";
        tope= "tope_d";

    }else if(listaP == "E"){

        precio = "precio_e";
        tope= "tope_e";

    }else{

        precio = "precio_d";
        tope= "tope_d";

    }

    let id_producto =   $(this).attr('idprod');


    var data = new FormData();

    data.append("IdProducto", id_producto); 
    data.append("listPrecio", precio); 
    data.append("listTope", tope); 
    
         $.ajax({
     
              url:"ajax/sistema-facturas-crearFatura.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
    
                console.log(response);
    
                $(".Addproductos").append( 
    
                  '<div class="row ">'+
                  '<div class="col-xs-12 col-md-12">'   +                                  
                    '<div class="input-group" style=" width: 100%;">'+
                      '<div class="input-group-prepend">'+
                        '<span style="font-size:15px; height: 35px;"  class="input-group-prepend"><button type="button" class="btn btn-outline-danger btn-sm frmCrearDeleteP"><i class="far fa-times-circle"></i></button></span>'+
                      '</div>'+
                    '<select  class="custom-select frmCrearProdSelect" style="font-size:15px; height: 35px;"  id="frmCrearProdSelect'+ numeroPC +'" name="frmCrearProdSelect" idDiv="'+ numeroPC +'" required>'+
                      '<option selected disabled value="'+response[0].idtbl_equipos+'" nombre_equipo="'+response[0].nombre+'" tipo_impuesto="'+response[0].codigo_tarifa+'" Cod_impuesto="'+response[0].codigo_impuesto+'"  SKU="'+response[0].sku+'" CABIS="'+response[0].cabys+'" PRECIO_UNIDAD="'+response[0].precio_unidad+'" unidad_medida ="'+response[0].unidad_medida+'" tarifa_iva="'+response[0].tarifa_iva+'" TopDesc = "'+ response[0].tope_descuento +'">'+response[0].nombre+'</option> ' +
                    '</select> '+
                    '</div>'+
                      '<br>'+
                  '</div>'+
      
                  '<div class="col-6 col-sm-6 col-md-6">'  +                            
                  '<div class="input-group mb-6" style=" width: 100%;">'+
                  '<div class="input-group-prepend">'+
                      '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
                  '</div>'+
                  '<input type="number" style="font-size:100%;"  class="form-control frmCrearCant" autocomplete="off"  id="frmCrearCant'+ numeroPC +'" idDiv="'+ numeroPC +'"  required placeholder="Cantidad" >'+
                  '</div> '+
                  '<br>'+
              '</div>'+
      
              '<div class="col-6 col-sm-6 col-md-6">'  +                            
              '<div class="input-group mb-6" style=" width: 100%;">'+
              '<div class="input-group-prepend">'+
                  '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
              '</div>'+
              '<input type="number" style="font-size:100%;"  class="form-control frmCrearDesc" autocomplete="off" id="frmCrearDesc'+ numeroPC +'" idDiv="'+ numeroPC +'"  required placeholder="Descuento" tope="'+response[0].tope_descuento+'">'+
              '</div> '+
              '<br>'+
          '</div>'+
      
          '<div class="col-6 col-sm-6 col-md-6" style="margin: 0px 50%;">'  +                            
          '<div class="input-group mb-6" style=" width: 100%;">'+
          '<div class="input-group-prepend">'+
              '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>'+
          '</div>'+
          '<input type="text" style="font-size:100%;"  class="form-control frmCrearTotalProd" id="frmCrearTotalProd'+ numeroPC +'" idDiv="'+ numeroPC +'" name="frmCrearTotalProd" required placeholder="Total" disabled hidden>'+
          '<input type="text" style="font-size:100%;"  class="form-control frmCrearTotalProd2" id="frmCrearTotalProd2'+ numeroPC +'" idDiv="'+ numeroPC +'" name="frmCrearTotalProd2" required placeholder="Total" disabled>'+
          '</div> '+
          '<br>'+
          '</div>'+
          '</div>'
        
            );
    
            $('.frmfactProd:last').select2({ 
    
              width : 'resolve',
              theme: "classic",
              placeholder: 'Selecionar Producto',
              selectionCssClass: 'font-size:15px; height: 50px; '
          });
    
    
          },
          
          error: function(response, err){ console.log('my message ' + err + " " + response );}

    })
    
          ListProdTabla();
    

});

var numeroId = 0;
$(".btnAgregar_Prods").click(function() {

    numeroId = numeroId + 1;

    let listaP = $("#frmCrearFactLista", "option:selected").val();

    let precio; 
    let tope;

    if(listaP == "A"){

        precio = "precio_a";
        tope= "tope_a";
        
    }else if(listaP == "B"){

        precio = "precio_b";
        tope= "tope_a";

    }else if(listaP == "C"){

        precio = "precio_c";
        tope= "tope_a";

    }else if(listaP == "D"){

        precio = "precio_d";
        tope= "tope_d";

    }else if(listaP == "E"){

        precio = "precio_e";
        tope= "tope_e";

    }else{

        precio = "precio_d";
        tope= "tope_d";

    }

    var data = new FormData();

    data.append("listPrecio2", precio); 
    data.append("listTope2", tope); 
    
         $.ajax({
     
              url:"ajax/sistema-facturas-crearFatura.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){

                console.log(response);

                $(".Addproductos").append( 
    
                    '<div class="row ">'+
                    '<div class="col-xs-12 col-md-12">'   +                                  
                      '<div class="input-group" style=" width: 100%;">'+
                        '<div class="input-group-prepend">'+
                          '<span style="font-size:15px; height: 35px;"  class="input-group-prepend"><button type="button" class="btn btn-outline-danger btn-sm frmCrearDeleteP"><i class="far fa-times-circle"></i></button></span>'+
                        '</div>'+
                      '<select  class="custom-select frmCrearProdSelect select2" style="font-size:15px; height: 35px;"  id="frmCrearProdSelect'+ numeroId +'" name="frmCrearProdSelect" idDiv="'+ numeroId +'" required>'+
                        '<option selected disabled value="" >Seleccionar Productos</option> ' +
                      '</select> '+
                      '</div>'+
                        '<br>'+
                    '</div>'+
        
                    '<div class="col-6 col-sm-6 col-md-6">'  +                            
                    '<div class="input-group mb-6" style=" width: 100%;">'+
                    '<div class="input-group-prepend">'+
                        '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
                    '</div>'+
                    '<input type="number" style="font-size:100%;"  class="form-control frmCrearCant" autocomplete="off"  id="frmCrearCant'+ numeroId +'" idDiv="'+ numeroId +'"  required placeholder="Cantidad" >'+
                    '</div> '+
                    '<br>'+
                '</div>'+
        
                '<div class="col-6 col-sm-6 col-md-6">'  +                            
                '<div class="input-group mb-6" style=" width: 100%;">'+
                '<div class="input-group-prepend">'+
                    '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
                '</div>'+
                '<input type="number" style="font-size:100%;"  class="form-control frmCrearDesc" autocomplete="off" id="frmCrearDesc'+ numeroId +'" idDiv="'+ numeroId +'"  required placeholder="Descuento" tope="">'+
                '</div> '+
                '<br>'+
            '</div>'+
        
            '<div class="col-6 col-sm-6 col-md-6" style="margin: 0px 50%;">'  +                            
            '<div class="input-group mb-6" style=" width: 100%;">'+
            '<div class="input-group-prepend">'+
                '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>'+
            '</div>'+
            '<input type="text" style="font-size:100%;"  class="form-control frmCrearTotalProd" id="frmCrearTotalProd'+ numeroId +'" idDiv="'+ numeroId +'" name="frmCrearTotalProd" required placeholder="Total" disabled hidden>'+
            '<input type="text" style="font-size:100%;"  class="form-control frmCrearTotalProd2" id="frmCrearTotalProd2'+ numeroId +'" idDiv="'+ numeroId +'" name="frmCrearTotalProd2" required placeholder="Total" disabled>'+
            '</div> '+
            '<br>'+
            '</div>'+
            '</div>'
          
              );
      
              $('.frmCrearProdSelect:last').select2({ 
      
                width : 'resolve',
                theme: "classic",
                placeholder: 'Selecionar Producto',
                selectionCssClass: 'font-size:15px; height: 50px; '
            });


            for(var i = 0; i < response.length; i++){

                $(".frmCrearProdSelect").append('<option class="listProductos" value="'+response[i]["idtbl_equipos"]+'" nombre_equipo="'+response[i]["nombre"]+'" tipo_impuesto="'+response[i]["codigo_tarifa"]+'" Cod_impuesto="'+response[i]['codigo_impuesto']+'" SKU="'+response[i]["sku"]+'" CABIS="'+response[i]["cabys"]+'" PRECIO_UNIDAD="'+response[i]["precio_unidad"]+'" tarifa_iva="'+response[i]["tarifa_iva"]+'" unidad_medida ="'+response[i]["unidad_medida"]+'" TopDesc = "'+ response[i]["tope_descuento"] +'">'+response[i]["nombre"]+'</option>')
          
         
                
              }
                            
            },
                    
        })

});


$(".Addproductos").on("change", "select.frmCrearProdSelect", function(){


let idDiv = $(this).attr("idDiv");

let tope = $("option:selected", ".frmCrearProdSelect").attr("TopDesc");

    $("#frmCrearDesc"+ idDiv).attr("tope", tope);

});





$("#frmCrearFactClient").change(function() {

    let cliente = $(this).val();

    $(".Addproductos").empty();

    cargarDatosCliente(cliente);
    CargarTabla();

});

$(".Addproductos").on("change", "input.frmCrearCant", function(){

    let bodega = $("option:selected","#frmCrearFacTbodega").val();
    let valInventario = $("option:selected","#frmCrearFacRuta").attr("inventario");
    let cantidad = $(this).val();
    let id_div =  $(this).attr('idDiv');
    let precio_unitario = $('option:selected', "#frmCrearProdSelect" + id_div).attr('PRECIO_UNIDAD');
    let producto = $('option:selected', "#frmCrearProdSelect" + id_div).attr('sku');

console.log(precio_unitario);

if(precio_unitario == "" || precio_unitario == null){

    Swal.fire(
        "Aviso",
        "Seleccione un Producto.",
        "warning"
      ).then((result) => {

      }) 
      $(this).val("");
      
    return;

}



if(bodega == "" || bodega == null){

    Swal.fire(
        "Aviso",
        "Seleccione una bodega.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 

      $(this).val("");

    return;
}

if(valInventario == "Si"){

 let disponible = validarInventario(producto, bodega);

if(Number(cantidad) > Number(disponible)){

    Swal.fire(
        "Aviso",
        "La cantidad ingresada es mayor al inventario actual "+disponible,
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 

      $(this).val("");

      $("#frmCrearTotalProd"+ id_div).val(0);
      
    //   total = formatter.format(total);
      
      $("#frmCrearTotalProd2"+ id_div).val(0);


}else{

    let total = parseFloat(precio_unitario) * parseFloat(cantidad);

    $("#frmCrearTotalProd"+ id_div).val(total);
    
    total = formatter.format(total);
    
    $("#frmCrearTotalProd2"+ id_div).val(total);

}


}else{

    let total = parseFloat(precio_unitario) * parseFloat(cantidad);

    $("#frmCrearTotalProd"+ id_div).val(total);
    
    total = formatter.format(total);
    
    $("#frmCrearTotalProd2"+ id_div).val(total);

}

sumaPrecios();
sumarImpuestos();
ListProdTabla();

});


$(".Addproductos").on("change", "input.frmCrearDesc", function(){

    // $(this).prop('disabled', "true");
    let id_div =  $(this).attr('idDiv');
    let total_producto = $('option:selected', "#frmCrearProdSelect" + id_div).attr('PRECIO_UNIDAD'); 
    let descuento =  $(this).val();
    let tope_desc = $(this).attr('tope');
    let cantidad = $("#frmCrearCant"+id_div).val();

if(cantidad == ""){

    Swal.fire(
        "Aviso",
        "Cantidad se encuentra vacia.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 

    
    return;
}

if(Number(descuento) > Number(tope_desc)){

    Swal.fire(
        "Aviso",
        "El descuento ingresado es mayor al tope del producto.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 

      $(this).val("0");

}else{


    let port_descuento = descuento / 100;
    let totaldesc =  parseFloat(total_producto * cantidad) * parseFloat(port_descuento);
    let precioFinal = parseFloat(total_producto * cantidad) - parseFloat(totaldesc);
    
    $("#frmCrearTotalProd"+id_div).val(precioFinal);
    precioFinal = formatter.format(precioFinal);
    $("#frmCrearTotalProd2"+id_div).val(precioFinal);

    sumaPrecios();
    sumarImpuestos();
    ListProdTabla();



}


});


$(".Addproductos").on("click", "button.frmCrearDeleteP", function(){

    $(this).parent().parent().parent().parent().parent().remove();
    ListProdTabla();
    // AgregarProductos();
    sumarImpuestos();
    sumaPrecios();
});



$(".EmitFactura").click(function(){

let fecha = new Date();
fecha = moment(fecha).format('YYYY-MM-DD hh:mm:ss', 'es-CR');
let subtotal = 0;
let total = 0;
let total_iva = 0;
let descuento_Total = 0;
let tipo_pago =  $("option:selected","#frmCrearConVenta").text().trim();
let tipo_documento = $("option:selected","#frmCrearFactTipCed").val();
let cedula = $("#frmCrearFactCedula").val();
let nombre = $("option:selected","#frmCrearFactClient").text().trim();
let nombreid = $("option:selected","#frmCrearFactClient").val();
let correo = $("#frmCrearFactMail").val();
let telefono =  "11111111";
let direccion = "Local comercial";
let usuario = $(".frmCrearFactFecha").attr("iduser");
let estado = "PENDIENTE EMISION";
let numero_consecutivo = "";
let clave = "";
let estado_hacienda = "Pendiente";
let id_empresa =  idempresa;
let ruta = $("option:selected","#frmCrearFacRuta").val();
let tipo = document.querySelector('#frmCrearFactTiquete').checked;
let fecha_emision = fecha;
let nomBodega = $("option:selected","#frmCrearFacTbodega").text().trim(); 
let idBodega = $("option:selected","#frmCrearFacTbodega").val(); 
var arrayFactura = [];
var factura;
let medios_pago = $(".frmCrearFacttipo_pago").val();

console.log(medios_pago);


if(tipo_documento == "01"){

    tipo_documento = "Fisico";

}else if(tipo_documento == "02"){

    tipo_documento = "Juridico";

}else if(tipo_documento == "03"){

    tipo_documento = "Dimex";

}else if(tipo_documento == "Pasaporte"){

    tipo_documento = "Pasaporte";

}
if(tipo){

    tipo = "04";

}else{
    
    tipo = "01";

}

let idFactura = ingresarFactura(fecha, tipo_pago, tipo_documento, cedula, nombre, correo, telefono, direccion, usuario, estado, numero_consecutivo, clave, estado_hacienda, id_empresa, ruta, tipo, fecha_emision);

let listP = ListProdTabla();

 for (var i = 0; i < listP.length; i++) {

    let descripcion = listP[i].nombre;
    let cantidad = listP[i].cantidad;
    let precio_unitario = listP[i].precio_unidad;  
    let descuento_aplicado = listP[i].descuento;
    let Tarifa_impuesto = listP[i].tarifa_iva;
    let cabys = listP[i].cabys;
    let sku = listP[i].SKU;
    let descuento = parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(descuento_aplicado / 100);
    let tasa_cambio = "0";
    let impuesto = parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(Tarifa_impuesto / 100);
    let total  = parseFloat(precio_unitario) * parseFloat(cantidad) - descuento + impuesto ;
    subtotal = parseFloat(subtotal) + parseFloat(precio_unitario) * parseFloat(cantidad) - parseFloat(descuento_aplicado / 100);
    total_iva = parseFloat(total_iva) + parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(Tarifa_impuesto / 100);
    descuento_Total = descuento_Total + parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(descuento_aplicado / 100);

    ingresarDetalleFacturas(idFactura, descripcion, cantidad, precio_unitario, descuento, descuento_aplicado, impuesto, total, tasa_cambio, cabys, sku);


    let listStock =  cargarStockActual(idBodega, sku);

    let consecutivoMov = idFactura + "-VENTA-" + nomBodega;
    let tipo_movimiento = "VENTA";
    let codigo = sku;
    let producto = descripcion;
    let costo_promedio = precio_unitario;
    let origen = idBodega;
    let destino = nombreid;
    let total_prod = parseInt(listStock[0].Total) - parseInt(cantidad);
    let stock = listStock[0].Total;
    let estadoMov = "Aceptado";
    let comentario = "VENTA PRODUCTO";
    let bodega = idBodega;
    let fecha_ingresoMov = fecha;
    InsertarMovimientoInvent(idFactura, consecutivoMov, tipo_movimiento, codigo, producto, stock, cantidad, costo_promedio, origen, destino, total_prod, usuario, estadoMov, comentario, bodega, fecha_ingresoMov);
 
let subT = parseFloat(cantidad) * parseFloat(precio_unitario) - parseFloat(descuento);
let TotalD = parseFloat(subT) + parseFloat(impuesto);


    if(listP[i].tipo_impuesto != "0"){
        
        detalleFactura = {                            
            "numeroLinea":""+ (i + 1) +"",
            "cabys":""+ listP[i].cabys +"",
            "unidadMedida":""+listP[i].medida+"",
            "tipoCodigoProducto":"01",
            "Codigo":""+ listP[i].SKU +"",
            "descripcionProducto":""+ listP[i].nombre +"",
            "cantidad":""+ listP[i].cantidad +"",
            "precioUnitario":""+ listP[i].precio_unidad +"",
            "costo":"0",
            "descuento":""+ descuento +"",
            "motivoDescuento":"Descuento",
            "subTotal":""+ subT +"",              
            "totalDetalle":""+ TotalD +"",                                  
            "tipoImpuesto":""+listP[i].tipo_impuesto+"",
            "codTasaImpuesto":""+listP[i].impuesto+"",
            "tasaImpuesto":""+listP[i].tipo_impuesto+"",
            "montoImpuesto":""+ impuesto.toFixed(2) +""                                              
            }
        arrayFactura.push(detalleFactura);


    }else{

        detalleFactura = {                            
            "numeroLinea":""+ (i + 1) +"",
            "cabys":""+ listP[i].cabys +"",
            "unidadMedida":""+listP[i].medida+"",
            "tipoCodigoProducto":"01",
            "Codigo":""+ listP[i].SKU +"",
            "descripcionProducto":""+ listP[i].nombre +"",
            "cantidad":""+ listP[i].cantidad +"",
            "precioUnitario":""+ listP[i].precio_unidad  +"",
            "costo":"0",
            "descuento":""+ descuento +"",
            "motivoDescuento":"Descuento",
            "subTotal":""+ subT +"",              
            "totalDetalle":""+ TotalD +"",                                  
            "tipoImpuesto":"0",
            "codTasaImpuesto":"0",
            "tasaImpuesto":"0",
            "montoImpuesto":"0"                                              
            }
    
            arrayFactura.push(detalleFactura);

    }



}

let datosEmpresa = LoadDatosEmpresa();
let datosSucursal = LoadDatosSucursal();


factura  = {
    "fileContent":{
  
                "datosEmisor":{
                    "usuario": ""+datosEmpresa[0].usuario+"",
                    "password": ""+datosEmpresa[0].password+"",
                    "cedula":""+datosEmpresa[0].cedula+"",
                    "id_empresa":""+datosEmpresa[0].id_empresa+""   
                },     
                "datosReceptor":{
                    "nombre":""+ nombre +"",
                    "tipoCedula":""+tipo_documento+"",
                    "cedula":""+cedula+"",
                    "direccion": "LOCAL COMERCIAL",
                    "correo":""+correo+"",
                    "telefono":"11111111",
                    "provincia": "",
                    "canton": "",
                    "distrito": "",
                    "senas": "LOCAL COMERCIAL"
                },          
                "datosFactura":{
                        "sucursal":""+datosSucursal[0].sucursal+"",
                        "caja":""+datosSucursal[0].caja+"",
                        "tipoDoc":""+ tipo +"",
                        "moneda":"CRC",                                                                     
                        "condicionVenta":"01",
                        "plazoCredito":"0",
                        "medioPago":""+ medios_pago +"",
                        "tipoCambio":"1",
                        "actividadEconomica":""+ datosEmpresa[0].actividadEconomica +"",
                        "api":"No",
                        "detalleFactura":
                        arrayFactura                                                                       
                }
    }       
  }
  
  EnviarFacturasApi(factura);


 ModificarTotalesFactura(idFactura, subtotal, total, total_iva, descuento_Total);

if(tipo_pago == "Credito"){

    let consecutivo = "";
    let claveHacie = "";
    tipo_documento = "Credito";
     descripcion = "Compra credito";
    let monto_exento = subtotal;
    let monto_base = total;
    let porcentaje_iva = "0.13";
    let dias_credito = $("option:selected","#frmCrearFactClient").attr("dCred");
    let fecha_vencimiento = moment(fecha).add(dias_credito, 'days').format('YYYY-MM-DD hh:mm:ss', 'es-CR');
    let saldo = total;
    estado = "Pendiente";
    
     InsertarCuentaCobrar(numero_consecutivo, clave, tipo_documento, fecha, cedula, descripcion, monto_exento, monto_base, porcentaje_iva, total_iva, descuento_Total, total, dias_credito, fecha_vencimiento, usuario, saldo, estado, idFactura, id_empresa);

}else{


}


});


$(".CreaFacturar").click(function(){

let fecha = new Date();
fecha = moment(fecha).format('YYYY-MM-DD hh:mm:ss', 'es-CR');
let subtotal = 0;
let total = 0;
let total_iva = 0;
let descuento_Total = 0;
let tipo_pago =  $("option:selected","#frmCrearConVenta").text().trim();
let tipo_documento = $("option:selected","#frmCrearFactTipCed").val();
let cedula = $("#frmCrearFactCedula").val();
let nombre = $("option:selected","#frmCrearFactClient").text().trim();
let nombreid = $("option:selected","#frmCrearFactClient").val();
let correo = $("#frmCrearFactMail").val();
let telefono =  "11111111";
let direccion = "Local comercial";
let usuario = $(".frmCrearFactFecha").attr("iduser");
let estado = "PENDIENTE EMISION";
let numero_consecutivo = "";
let clave = "";
let estado_hacienda = "Pendiente";
let id_empresa =  idempresa;
let ruta = $("option:selected","#frmCrearFacRuta").val();
let tipo = document.querySelector('#frmCrearFactTiquete').checked;
let fecha_emision = fecha;
let nomBodega = $("option:selected","#frmCrearFacTbodega").text().trim(); 
let idBodega = $("option:selected","#frmCrearFacTbodega").val(); 

if(tipo_documento == "01"){

    tipo_documento = "Fisico";

}else if(tipo_documento == "02"){

    tipo_documento = "Juridico";

}else if(tipo_documento == "03"){

    tipo_documento = "Dimex";

}else if(tipo_documento == "Pasaporte"){

    tipo_documento = "Pasaporte";

}
if(tipo){

    tipo = "04";

}else{
    
    tipo = "01";

}

let idFactura = ingresarFactura(fecha, tipo_pago, tipo_documento, cedula, nombre, correo, telefono, direccion, usuario, estado, numero_consecutivo, clave, estado_hacienda, id_empresa, ruta, tipo, fecha_emision);

let listP = ListProdTabla();

 for (var i = 0; i < listP.length; i++) {

    let descripcion = listP[i].nombre;
    let cantidad = listP[i].cantidad;
    let precio_unitario = listP[i].precio_unidad;  
    let descuento_aplicado = listP[i].descuento;
    let Tarifa_impuesto = listP[i].tarifa_iva;
    let cabys = listP[i].cabys;
    let sku = listP[i].SKU;
    let descuento = parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(descuento_aplicado / 100);
    let tasa_cambio = "0";
    let impuesto = parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(Tarifa_impuesto / 100);
    let total  = parseFloat(precio_unitario) * parseFloat(cantidad) - descuento + impuesto ;
   subtotal = parseFloat(subtotal) + parseFloat(precio_unitario) * parseFloat(cantidad) - parseFloat(descuento_aplicado / 100);
   total_iva = parseFloat(total_iva) + parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(Tarifa_impuesto / 100);
   descuento_Total = descuento_Total + parseFloat(precio_unitario) * parseFloat(cantidad) * parseFloat(descuento_aplicado / 100);
    ingresarDetalleFacturas(idFactura, descripcion, cantidad, precio_unitario, descuento, descuento_aplicado, impuesto, total, tasa_cambio, cabys, sku);

  let listStock =  cargarStockActual(idBodega, sku);

    let consecutivoMov = idFactura + "-VENTA-" + nomBodega;
    let tipo_movimiento = "VENTA";
    let codigo = sku;
    let producto = descripcion;
    let costo_promedio = precio_unitario;
    let origen = idBodega;
    let destino = nombreid;
    let total_prod = parseInt(listStock[0].Total) - parseInt(cantidad);
    let stock = listStock[0].Total;
    let estadoMov = "Aceptado";
    let comentario = "VENTA PRODUCTO";
    let bodega = idBodega;
    let fecha_ingresoMov = fecha;
    InsertarMovimientoInvent(idFactura, consecutivoMov, tipo_movimiento, codigo, producto, stock, cantidad, costo_promedio, origen, destino, total_prod, usuario, estadoMov, comentario, bodega, fecha_ingresoMov);
 }



 ModificarTotalesFactura(idFactura, subtotal, total, total_iva, descuento_Total);


// let consecutivo = "";
// let claveHacie = "";
// tipo_documento = "Credito";
//  descripcion = "Compra credito";
// let monto_exento = subtotal;
// let monto_base = total;
// let porcentaje_iva = "0.13";
// let dias_credito = $("option:selected","#frmCrearFactClient").attr("dCred");
// let fecha_vencimiento = moment(fecha).add(dias_credito, 'days').format('YYYY-MM-DD hh:mm:ss', 'es-CR');
// let saldo = total;
// estado = "Pendiente";


//  InsertarCuentaCobrar(numero_consecutivo, clave, tipo_documento, fecha, cedula, descripcion, monto_exento, monto_base, porcentaje_iva, total_iva, descuento_Total, total, dias_credito, fecha_vencimiento, usuario, saldo, estado, idFactura, id_empresa);


});



function validarInventario(producto, bodega){

    let disponible;
    var data = new FormData();

    data.append("bodega_ID", bodega); 
    data.append("product", producto); 

        $.ajax({
    
            url:"ajax/sistema-facturas-crearFatura.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
            success: function(response){

                console.log(response);
                disponible = response[0].stock;
              
            },
        
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })

return disponible;


}



function sumaPrecios() {

    var precioItem = $(".frmCrearTotalProd");
        
        var arraySumaPrecio = [];
          
        for (var i = 0; i < precioItem.length; i++) {
          
            arraySumaPrecio.push(parseFloat($(precioItem[i]).val()));   

        }
    
        function sumaArrayPrecios(total, numero) {
    
            return total + numero;
    
        }
    
    if (arraySumaPrecio.length <= 0){
        $("#frmCrearFacttoSiniva").val(0); 
        $("#frmCrearFacttoSiniva2").val(0); 
    }else {
    
        var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
    
        $("#frmCrearFacttoSiniva").val(sumaTotalPrecio);
        sumaTotalPrecio = formatter.format(sumaTotalPrecio);
        $("#frmCrearFacttoSiniva2").val(sumaTotalPrecio);

    }
    
    
    }
  

    

    $("#frmCrearFactLista").change(function() {


    $(".Addproductos").empty();

    CargarTabla();

    ListProdTabla();
    sumarImpuestos();
    sumaPrecios();

    });


    $("#frmCrearFacRuta").change(function() {

        let idbodega = $("option:selected", this).attr("idBodega");
        let factura = $("option:selected", this).attr("Factura");

        if(factura == "Si"){
           
            $(".EmitFactura").prop('hidden', "true");
            $(".CreaFacturar").removeAttr("hidden");
            $(".divPrevent").removeAttr('hidden');
            $(".divDirect").removeAttr('hidden');
    
        }else{

            $(".EmitFactura").removeAttr('hidden');
            $(".CreaFacturar").prop('hidden', "true");
            $(".divPrevent").prop('hidden', "true");
            $(".divDirect").prop('hidden', "true");
           
        }





        var data = new FormData();

        data.append("idbodega", idbodega); 
        
            $.ajax({
        
                url:"ajax/sistema-facturas-crearFatura.ajax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                dataType: "json",  
                success: function(response){

                    console.log(response);

                    // $("#frmCrearFacTbodega").val(response[0].idtbl_bodegas).trigger('change');
                    $("#frmCrearFacTbodega").append('<option Selected value="'+response[0].idtbl_bodegas+'" Inventario="'+response[0].valida_inventario+'">'+response[0]["nombre"]+'</option>');
                },
            
                error: function(response, err){ console.log('my message ' + err + " " + response );}
            
                })
       
    });

    $('#frmCrearFactDirect').on('ifChecked', function(event){
 
        $('#frmCrearFactPrevent').iCheck('uncheck'); 

        $("option:selected","#frmCrearFacRuta").attr("inventario", "Si");

        $(".Addproductos").empty();

        $(".EmitFactura").removeAttr("hidden");
        $(".CreaFacturar").prop('hidden', "true");


        // ListProdTabla();
        // sumarImpuestos();
        // sumaPrecios();
    });





    $('#frmCrearFactPrevent').on('ifChecked', function(event){
        
        $('#frmCrearFactDirect').iCheck('uncheck'); 
        $("option:selected","#frmCrearFacRuta").attr("inventario", "No");

        $(".CreaFacturar").removeAttr("hidden");
        $(".EmitFactura").prop('hidden', "true");

        $(".Addproductos").empty();

        // ListProdTabla();
        // sumarImpuestos();
        // sumaPrecios();

    });


    function sumarImpuestos() {

        var precioItem = $(".frmCrearTotalProd");
    
        
        var impuestoItem = $("option:selected", ".frmCrearProdSelect");
                
            var arraySumaPrecio = [];
             var arraySumaPrecioIVA = []
            
            for (var i = 0; i < precioItem.length; i++) {
        
    
                arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * Number($(impuestoItem[i]).attr("tarifa_iva") / 100) + parseFloat($(precioItem[i]).val()));  
          
        }
        
            function sumaArrayimpuestos(total, numero) {
        
                return total + numero;                   
        }
        
              if (arraySumaPrecioIVA.length <= 0){
                  $("#frmCrearFacttoIva").val(0);
                  $("#frmCrearFacttoIva2").val(0);
              }else {
        
                  var sumaTotalPrecio = arraySumaPrecioIVA.reduce(sumaArrayimpuestos);
          
                  $("#frmCrearFacttoIva").val(sumaTotalPrecio);
                  sumaTotalPrecio = formatter.format(sumaTotalPrecio);
                  $("#frmCrearFacttoIva2").val(sumaTotalPrecio);                
                  
              } 
        }   


function cargarDatosCliente (cliente){

        var data = new FormData();

        data.append("idCliente", cliente); 
        
            $.ajax({
        
                url:"ajax/sistema-facturas-crearFatura.ajax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                dataType: "json",  
                success: function(response){
        
                    console.log(response);

                    if(response[0].tipo_personeria == "Fisica"){

                        $("#frmCrearFactTipCed").val("01").trigger('change');

                    }else if(response[0].tipo_personeria == "Juridica"){

                        $("#frmCrearFactTipCed").val("02").trigger('change');

                    }else if(response[0].tipo_personeria == "Dimex" || response[0].tipo_personeria == "Nite"){

                        $("#frmCrearFactTipCed").val(03).trigger('change');
                        
                    }else if(response[0].tipo_personeria == "Pasaporte"){

                        $("#frmCrearFactTipCed").val(Pasaporte).trigger('change');
                    }

                    $("#frmCrearFactCedula").val(response[0].cedula);
                    $("#frmCrearFactMail").val(response[0].email);
                    $("#frmCrearFactLista").val(response[0].Tipo_lista).trigger('change');

                    if(response[0].id_forma_pago == "1"){

                        // $("option:selected","#frmCrearConVenta").val("01");
                        $("#frmCrearConVenta").val("01").trigger('change');
                        $("#frmCrearConVenta").prop('disabled', "true");
                    }else{

                        $("#frmCrearConVenta").val("02").trigger('change');
                        $("#frmCrearConVenta").removeAttr('disabled');
                    }
                    
                    let Rol =  sessionStorage.getItem('rol');

                    if(Rol == "Administrador"){

                        $("#frmCrearFactLista").removeAttr('disabled');

                    }else{

                        $("#frmCrearFactLista").prop('disabled', "true");

                    }
                    
    },
            
    error: function(response, err){ console.log('my message ' + err + " " + response );}

    })

let Cedula =  $("#frmCrearFactCedula").val();
let estadoCredito = ValidarCreditos(Cedula);

if(estadoCredito == 1){

    Swal.fire(
        "Aviso",
        "Cliente con facturas pendientes.",
        "warning"
      ).then((result) => {
    window.location = "sistema-facturas-crearFactura";
      })

      $(".CreaFacturar").prop('disabled', "true");
      $(".EmitFactura").prop('disabled', "true");

}else{

    $(".CreaFacturar").removeAttr('disabled');
    $(".EmitFactura").removeAttr('disabled');
    
}

}




function ListProdTabla(){


    var listaProductos_2 = [];
    
    
    /*=============================================
    = OPTENGO EL ATRIBUTO DEL OPTION  SELECT          =
    =============================================*/
    
    
    var selectProd = $('option:selected', '.frmCrearProdSelect');
    
    
    
    var cantidad = $(".frmCrearCant");
    
    
    
    var descuento = $(".frmCrearDesc");  
    
    
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
                          "tarifa_iva": $(selectProd[i]).attr('tarifa_iva'),
                        });
    
    }
    
    
console.log(listaProductos_2);
    return listaProductos_2;
    
    
    
    
    }



function CargarTabla(){

    let listaP = $("option:selected", "#frmCrearFactLista").val();
    
    let precio; 
    let tope;
    
        if(listaP == "A"){
    
            precio = "precio_a";
            tope= "tope_a";
            
        }else if(listaP == "B"){
    
            precio = "precio_b";
            tope= "tope_a";
    
        }else if(listaP == "C"){
    
            precio = "precio_c";
            tope= "tope_a";
    
        }else if(listaP == "D"){
    
            precio = "precio_d";
            tope= "tope_d";
    
        }else if(listaP == "E"){
    
            precio = "precio_e";
            tope= "tope_e";
    
        }else{
    
            precio = "precio_d";
            tope= "tope_d";
    
        }

    if ( $.fn.DataTable.isDataTable('#tblProdCreFact') ) {
        $('#tblProdCreFact').DataTable().destroy();
      }
       var table = $("#tblProdCreFact").DataTable({
      
        "ajax": 'ajax/datateble-sistema-facturas-crearFactura.ajax.php?dato='+idempresa+'&listPrecio='+precio+'&listTope='+tope,  
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
                      // table.buttons().container()
                      //     .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
                  }
      
          })


}


function ingresarFactura (fecha, tipo_pago, tipo_documento, cedula, nombre, correo, telefono, direccion, usuario, estado, numero_consecutivo, clave, estado_hacienda, id_empresa, ruta, tipo, fecha_emision){

var idFactura;

var data = new FormData();

data.append("fecha", fecha);
data.append("tipo_pago", tipo_pago); 
data.append("tipo_documento", tipo_documento); 
data.append("cedula", cedula); 
data.append("nombre", nombre); 
data.append("correo", correo); 
data.append("telefono", telefono); 
data.append("direccion", direccion); 
data.append("usuario", usuario); 
data.append("estado", estado); 
data.append("numero_consecutivo", numero_consecutivo); 
data.append("clave", clave); 
data.append("estado_hacienda", estado_hacienda); 
data.append("id_empresa", id_empresa); 
data.append("ruta", ruta); 
data.append("tipo", tipo); 
data.append("fecha_emision", fecha_emision); 

    $.ajax({

        url:"ajax/sistema-facturas-crearFatura.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        // dataType: "json",  
        success: function(response){

        console.log(response);
        idFactura = response;

        },
            
        error: function(response, err){ console.log('my message ' + err + " " + response );}
    
        })

return idFactura;

}

function ingresarDetalleFacturas(id_factura, descripcion, cantidad, precio_unitario, descuento, descuento_aplicado, impuesto, total, tasa_cambio, cabys, sku){

    var data = new FormData();
    
    data.append("id_factura", id_factura);
    data.append("descripcion", descripcion); 
    data.append("cantidad", cantidad); 
    data.append("precio_unitario", precio_unitario); 
    data.append("descuento", descuento); 
    data.append("descuento_aplicado", descuento_aplicado); 
    data.append("impuesto", impuesto); 
    data.append("total", total); 
    data.append("tasa_cambio", tasa_cambio); 
    data.append("cabys", cabys); 
    data.append("sku", sku); 
     
        $.ajax({
    
            url:"ajax/sistema-facturas-crearFatura.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
    
            console.log(response);
     
            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })

}


function ModificarTotalesFactura(id_factura, subtotal, total, total_iva, descuento){

    var data = new FormData();
    data.append("EditFactId", id_factura);
    data.append("Edisubtotal", subtotal.toFixed(2)); 
    data.append("Editotal", total.toFixed(2)); 
    data.append("Editotal_iva", total_iva.toFixed(2)); 
    data.append("Edidescuento", descuento.toFixed(2)); 
    

        $.ajax({
    
            url:"ajax/sistema-facturas-crearFatura.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
    
            console.log(response);
            if(response == "ok"){

                Swal.fire(
                    "Error",
                    "Error al realizar la factura, intente nuevamente.",
                    "error"
                ).then((result) => {
                window.location = "sistema-facturas-crearFactura";
                }) 

            }else{

                Swal.fire(
                    "Error",
                    "Error al realizar la factura, intente nuevamente.",
                    "error"
                ).then((result) => {
                window.location = "sistema-facturas-crearFactura";
                }) 

            }
            

     
            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })


}


function InsertarMovimientoInvent(idFactura, consecutivoMov, tipo_movimiento, codigo, producto, stock, cantidad, costo_promedio, origen, destino, total_prod, usuario, estado, comentario, bodega, fecha_ingresoMov){


    var data = new FormData();
    data.append("idFacturaMov", idFactura);
    data.append("consecutivoMov", consecutivoMov); 
    data.append("tipo_movimientoMov", tipo_movimiento); 
    data.append("codigoMov", codigo); 
    data.append("productoMov", producto); 
    data.append("stockMov", stock);
    data.append("cantidadMov", cantidad); 
    data.append("costo_promedioMov", costo_promedio); 
    data.append("origenMov", origen); 
    data.append("destinoMov", destino); 
    data.append("total_prodMov", total_prod);
    data.append("usuarioMov", usuario); 
    data.append("estadoMov", estado); 
    data.append("comentarioMov", comentario); 
    data.append("bodegaMov", bodega); 
    data.append("fecha_ingresoMov", fecha_ingresoMov); 
 
        $.ajax({
    
            url:"ajax/sistema-facturas-crearFatura.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
    
            console.log(response);
     
            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })


}


function InsertarCuentaCobrar(numero_consecutivo, clave, tipo_documento, fecha, cedula_proveedor, descripcion, monto_exento, monto_base, porcentaje_iva, iva, descuento, total, dias_credito, fecha_vencimiento, usuario, saldo, estado, id_factura, id_empresa){

    var data = new FormData();
    data.append("numero_consecutivo", numero_consecutivo);
    data.append("clave_Hacienda", clave); 
    data.append("tipo_Factura", tipo_documento); 
    data.append("fecha", fecha); 
    data.append("cedula_proveedor", cedula_proveedor); 
    data.append("descripcion", descripcion);
    data.append("monto_exento", monto_exento); 
    data.append("monto_base", monto_base); 
    data.append("porcentaje_iva", porcentaje_iva); 
    data.append("iva", iva); 
    data.append("descuento", descuento);
    data.append("total", total); 
    data.append("dias_credito", dias_credito); 
    data.append("fecha_vencimiento", fecha_vencimiento); 
    data.append("usuario", usuario); 
    data.append("saldo", saldo);
    data.append("estado", estado); 
    data.append("factura", id_factura); 
    data.append("empresa", id_empresa); 


        $.ajax({
    
            url:"ajax/sistema-facturas-crearFatura.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
    
            console.log(response);
     
            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })


}



function cargarStockActual(idBodega, sku){

var listUltStock = [];
    var data = new FormData();

    data.append("bodegaStock", idBodega);
    data.append("skuProd", sku);

    $.ajax({

        url:"ajax/sistema-facturas-crearFatura.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",  
        success: function(response){
            
            console.log(response);
           
            listUltStock = [];
            listUltStock.push({"Stock": response[0].stock,
            "Total": response[0].total
            });

     
 
        },
            
        error: function(response, err){ console.log('my message ' + err + " " + response );}
    
        })


        return listUltStock;
}

function ValidarCreditos(Cedula){

let estadoCredito;

    var data = new FormData();

    data.append("cedulaProv", Cedula);
    data.append("empresaID", idempresa);

    $.ajax({

        url:"ajax/sistema-facturas-crearFatura.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",  
        success: function(response){

            estadoCredito = response[0][0];
 
        },
            
        error: function(response, err){ console.log('my message ' + err + " " + response );}
    
        })

        return estadoCredito;

}

function LoadDatosEmpresa(){

    var listaDatosEmpresa = [];
      
    let empresa = sessionStorage.getItem('empresa');

  
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
    
console.log(response);
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
    
//    console.log("empresa", listaDatosEmpresa);
    return listaDatosEmpresa;
           
    } 


    function LoadDatosSucursal(){

        var listaSucursal = [];
          
        let empresa = sessionStorage.getItem('empresa');
    
      
        var data = new FormData();
    
        data.append("empresaSucursal", empresa); 
    
             $.ajax({
         
                  url:"ajax/sistema-facturas-crearFatura.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
        
    console.log(response);
  
        
    listaSucursal.push({"sucursal": response[0].Sucursal,
                           "caja": response[0].Caja                    
                          });
      
    
                  },
                    
                })
        
    //    console.log("empresa", listaDatosEmpresa);
        return listaSucursal;
               
        } 



function EnviarFacturasApi(factura){

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
    
                  Swal.fire(
                    "Exelente",
                    "Factura realizada con exito.",
                    "success"
                  ).then((result) => {
                window.location = "sistema-facturas-crearFactura";
                  }) 
    
    
    
                }else{
    
                  Swal.fire(
                    "Error",
                    "Error al realizar la factura, intente nuevamente.",
                    "error"
                  ).then((result) => {
                window.location = "sistema-facturas-crearFactura";
                  }) 
    
                }
    
              },
    
              error: function(response, err){ console.log('my message ' + err + " " + response );}
    
        }) 


}


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





