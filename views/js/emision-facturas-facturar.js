

/*=============================================
= DECLARACION DE VARIABLES GLOBALES DEL PROYECTO  =
=============================================*/
const url = window.location.search;

const urlparams = new URLSearchParams(url);

/*=============================================
          = EVENTOS DEL PROYECTO  =
=============================================*/

$(document).ready(function() {


var Id_factura = urlparams.get('numFact');

console.log(Id_factura);

if(Id_factura == "" || Id_factura == undefined || Id_factura == null){


}else{

var Datos = DatosFactura(Id_factura);

// console.log(Datos);
    var data = new FormData();

data.append("idFactura", Id_factura); 

     $.ajax({
 
          url:"ajax/emision-facturas-facturar.ajax.php",
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

    $(".ListProductos").append( 

        '<div class="row">'+
        '<div class="col-xs-12 col-md-12 col-lg-12">'   +                                  
        '<div class="input-group" style=" width: 100%;">'+
            '<div class="input-group-prepend">'+
            '<span style="font-size:15px; height: 35px;"  class="input-group-prepend"><button type="button" class="btn btn-outline-danger btn-sm quitarProductos"><i class="far fa-times-circle"></i></button></span>'+
            '</div>'+
        '<select  class="custom-select frmProd" style="font-size:15px; height: 35px; "  id="frmProdSelect'+ i +'" name="frmProdSelect" idDiv="'+ i +'" required>'+
            '<option selected disabled value="" nombre_equipo="'+ response[i].nombre +'" tipo_impuesto="'+ response[i].codTasaImp +'" tasa_impuesto="'+ response[i].tasa_Impuesto +'" Cod_impuesto="'+ response[i].codImpuesto +'"  SKU="'+ response[i].codigo +'" CABIS="'+ response[i].cabys +'" PRECIO_UNIDAD="'+ response[i].precio_unidad +'" unidad_medida ="Unid">'+ response[i].nombre +'</option> ' +
        '</select> '+
        '</div>'+
            '<br>'+
        '</div>'+

        '<div class="col-6 col-sm-6 col-md-6">'  +                            
        '<div class="input-group mb-6" style=" width: 100%;">'+
        '<div class="input-group-prepend">'+
            '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
        '</div>'+
        '<input type="text" style="font-size:100%;"  class="form-control frmcant" autocomplete="off" id="frmcant'+ i +'" idDiv="'+ i +'" cantReal="'+ response[i].cantidad +'" value="'+ response[i].cantidad +'" name="frmcant" required placeholder="Cantidad" >'+
        '</div> '+
        '<br>'+
        '</div>'+

        '<div class="col-6 col-sm-6 col-md-6">'  +                            
        '<div class="input-group mb-6" style=" width: 100%;">'+
        '<div class="input-group-prepend">'+
            '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-pencil-alt"></i></span>'+
        '</div>'+
        '<input type="text" style="font-size:100%;"  class="form-control frmdesc" autocomplete="off" id="frmdesc'+ i +'" idDiv="'+ i +'" descReal="'+ response[i].descuento +'" value="'+ response[i].descuento +'" disabled name="frmdesc" required placeholder="Descuento" >'+
        '</div> '+
        '<br>'+
    '</div>'+

    '<div class="col-6 col-sm-6 col-md-6" style="margin: 0px 50%;">'  +                            
    '<div class="input-group mb-6" style=" width: 100%;">'+
    '<div class="input-group-prepend">'+
        '<span style="font-size:100%;" class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>'+
    '</div>'+
    '<input type="text" style="font-size:100%;"  class="form-control frmTotalProd" id="frmTotalProd'+ i +'" idDiv="'+ i +'"  value="'+ response[i].total +'" required placeholder="Total" disabled hidden>'+
    '<input type="text" style="font-size:100%;"  class="form-control frmTotalProd2" id="frmTotalProd2'+ i +'" idDiv="'+ i +'"  value="'+ response[i].total +'" required placeholder="Total" disabled>'+
    '</div> '+
    '<br>'+
    '</div>'+
    '</div>'

    );

}

        },
                    
     })

}

sumarTotalPreciosEmision();
sumarTotalimpuestosEmision();
AgregarProductos_tablaEmision();
});


$(".ListProductos").on("click", "button.quitarProductos", function(){

    $(this).parent().parent().parent().parent().parent().remove();

    sumarTotalimpuestosEmision();
    sumarTotalPreciosEmision();
    AgregarProductos_tablaEmision();
    });


$(".ListProductos").on("change", "input.frmcant", function(){

let id_div = $(this).attr('idDiv');
let cantReal = $(this).attr('cantReal');
let cantidad = $(this).val();

if(Number(cantidad) > Number(cantReal)){

    Swal.fire(
        "Aviso",
        "La cantidad no puede ser mayor a la cantidad facturada.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 
      $(this).removeAttr('disabled');
      $(this).val(cantReal)
      let precio_unidad = $("option:selected", "#frmProdSelect"+id_div).attr('PRECIO_UNIDAD');
      
      let total = parseFloat(cantReal * precio_unidad);
    
    $("#frmTotalProd"+id_div).val(total);
    let totalfORMAT = formatter.format(total); 
    $("#frmTotalProd2"+id_div).val(totalfORMAT);
    // $("#frmTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
    sumarTotalPreciosEmision();
    sumarTotalimpuestosEmision();
    AgregarProductos_tablaEmision();

}else if(Number(cantidad) == 0){

    Swal.fire(
        "Aviso",
        "La cantidad no puede ser 0.",
        "warning"
      ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
      }) 

      $(this).val(cantReal)
      
      let precio_unidad = $("option:selected", "#frmProdSelect"+id_div).attr('PRECIO_UNIDAD');
      
      let total = parseFloat(cantReal * precio_unidad);
    
    $("#frmTotalProd"+id_div).val(total);
    let totalfORMAT = formatter.format(total);
    $("#frmTotalProd2"+id_div).val(totalfORMAT);
    // $("#frmTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
    sumarTotalPreciosEmision();
    sumarTotalimpuestosEmision();
    AgregarProductos_tablaEmision();


}else{

    // $(this).prop('disabled', "true");
    // let id_div = $(this).attr('idDiv');
    let precio_unidad = $("option:selected", "#frmProdSelect"+id_div).attr('PRECIO_UNIDAD');
    
    let total = parseFloat(cantidad * precio_unidad);
  
  $("#frmTotalProd"+id_div).val(total);
  let totalfORMAT = formatter.format(total);
  $("#frmTotalProd2"+id_div).val(totalfORMAT);
  // $("#frmTotalProd2"+id_div).formatNumber({format:"#,###", locale:"us"});
  sumarTotalPreciosEmision();
  sumarTotalimpuestosEmision();
  AgregarProductos_tablaEmision();


}

    //   AgregarProductosEmision();
      })



    
$(".btnFacturaProductos").click(function(){


  $("#overlay2").fadeIn();
    var Id_factura = urlparams.get('factura');
    var empresa = AgregarDatosEmpresaEmision(datosFactura[0].id_compania);
    var arrayFactura = [];
    var factura;
    var detalleFactura;
    var descuento = 0;
    var subTotal = 0;
    var totalDetalle = 0;
    var montoIVA = 0;
    var tasaIva = 0;
    var porDescuento = 0;
    $(this).prop('disabled', "true");

    console.log(empresa);

var listProd = AgregarProductos_tablaEmision();

for (var i = 0; i < listProd.length; i++){
   
// console.log(listProd[i]);

    if(listProd[i].nombre == '' ){

      $("#overlay2").fadeOut();
        Swal.fire(
            "Aviso",
            "El producto ingresado no posee nombre",
            "warning"
        ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
        }) 

return;

    }else if(Number(listProd[i].cantidad) == 0){

      $("#overlay2").fadeOut();
        Swal.fire(
            "Aviso",
            "La cantidad de un producto no puede ser 0",
            "warning"
        ).then((result) => {
        //window.location = "reporte-sistema-facturacion";
        }) 

        return;

    }
    
    if(listProd[i]["tipo_impuesto"] != "0"){

        if(listProd[i]["impuesto"] == "01"){

            tasaIva = "0";

        }else if(listProd[i]["impuesto"] == "02"){

            tasaIva = "1";
          
          }else if(listProd[i]["impuesto"] == "03"){
          
            tasaIva = "2";
          }else if(listProd[i]["impuesto"] == "04"){
          
            tasaIva = "4";
          }else if(listProd[i]["impuesto"] == "05"){

            tasaIva = "0";
          
          }else if(listProd[i]["impuesto"] == "06"){
            tasaIva = "4";
          
          }else if(listProd[i]["impuesto"] == "07"){
          
            tasaIva = "8";
          }else if(listProd[i]["impuesto"] == "08"){
          
            tasaIva = "13";
          }


        porDescuento = parseFloat(listProd[i]["descuento"]) / 100;

        descuento = parseFloat(listProd[i]["precio_unidad"] * listProd[i]["cantidad"]) * parseFloat(porDescuento);

        montoIVA = parseFloat(listProd[i]["precio_unidad"] * listProd[i]["cantidad"]) * parseFloat(tasaIva / 100);
        
              detalleFactura = {                            
                "numeroLinea":""+ (i + 1) +"",
                "cabys":""+ listProd[i]["cabys"] +"",
                "unidadMedida":""+listProd[i]['medida']+"",
                "tipoCodigoProducto":"01",
                "Codigo":""+ listProd[i]["SKU"] +"",
                "descripcionProducto":""+ listProd[i]["nombre"] +"",
                "cantidad":""+ listProd[i]["cantidad"] +"",
                "precioUnitario":""+ listProd[i]["precio_unidad"] +"",
                "costo":"0",
                "descuento":""+ descuento +"",
                "motivoDescuento":"Descuento",
                "subTotal":""+ subTotal +"",              
                "totalDetalle":""+ totalDetalle +"",                                  
                "tipoImpuesto":""+listProd[i]["tipo_impuesto"]+"",
                "codTasaImpuesto":""+listProd[i]["impuesto"]+"",
                "tasaImpuesto":""+tasaIva+"",
                "montoImpuesto":""+ montoIVA +"" ,
                "categoria":"Bien"	                                                  
                }

              arrayFactura.push(detalleFactura);

    }else{

        porDescuento = parseFloat(listProd[i]["descuento"]) / 100;

        descuento = parseFloat(listProd[i]["precio_unidad"] * listProd[i]["cantidad"]) * parseFloat(porDescuento);

  detalleFactura = {                            
        "numeroLinea":""+ (i + 1) +"",
        "cabys":""+ listProd[i]["cabys"] +"",
        "unidadMedida":""+listProd[i]['medida']+"",
        "tipoCodigoProducto":"01",
        "Codigo":""+ listProd[i]["SKU"] +"",
        "descripcionProducto":""+ listProd[i]["nombre"] +"",
        "cantidad":""+ listProd[i]["cantidad"] +"",
        "precioUnitario":""+ listProd[i]["precio_unidad"] +"",
        "costo":"0",
        "descuento":""+ descuento +"",
        "motivoDescuento":"Descuento",
        "subTotal":""+ subTotal +"",              
        "totalDetalle":""+ totalDetalle +"",                                  
        "tipoImpuesto":"0",
        "codTasaImpuesto":"0",
        "tasaImpuesto":"0",
        "montoImpuesto":"0" ,
        "categoria":"Bien"		                                             
        }

        arrayFactura.push(detalleFactura);

    }



    // console.log(detalleFactura);

}


// console.log(datosFactura);

factura  = {
    "fileContent":{
  
                "datosEmisor":{
                    "usuario": ""+empresa[0].usuario+"",
                    "password": ""+empresa[0].password+"",
                    "cedula":""+empresa[0].cedula+"",
                    "id_empresa":""+empresa[0].id_empresa+""   
                },     
                "datosReceptor":{
                    "nombre":""+ datosFactura[0].nombre_cliente +"",
                    "tipoCedula":""+datosFactura[0].tipo_personeria+"",
                    "cedula":""+datosFactura[0].cedula_cliente+"",
                    "direccion": "LOCAL COMERCIAL",
                    "correo":""+datosFactura[0].correo_cliente+"",
                    "telefono":"11111111",
                    "provincia": "",
                    "canton": "",
                    "distrito": "",
                    "senas": "LOCAL COMERCIAL"
                },          
                "datosFactura":{
                        "sucursal":""+datosFactura[0].sucursal+"",
                        "caja":""+datosFactura[0].caja+"",
                        "tipoDoc":""+ datosFactura[0].tipo_documento +"",
                        "moneda":"CRC",                                                                     
                        "condicionVenta":"01",
                        "plazoCredito":"0",
                        "medioPago":""+ datosFactura[0].medios_pago +"",
                        "tipoCambio":"1",
                        "actividadEconomica":""+ datosFactura[0].codigo_actividad +"",
                        "api":"No",
                        "estadoAnulacion":"",
                        "comentario":"",
                        "detalleFactura":
                        arrayFactura                                                                       
                }
    }       
  }


// console.log(factura);

  var data = new FormData();
  data.append("DatosFactura",JSON.stringify(factura)); 
   
     $.ajax({
   
            url:"ajax/emision-facturas-facturar.ajax.php", 
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
                let consecutivo = respt["Consecutivo"];
                let clave = respt["Clave"];
                let estado = "Emitido";

                modificarDatosFactura(consecutivo, clave, estado);

                Swal.fire(
                  "Exelente",
                  "Factura realizada con exito.",
                  "success"
                ).then((result) => {
              window.location = "emision-facturas";
                }) 
  
  
  
              }else{
                
                $("#overlay2").fadeOut();
                let consecutivo = respt["Consecutivo"];
                let clave = respt["Clave"];
                let estado = "Pendiente";

                modificarDatosFactura(consecutivo, clave, estado);
  
                Swal.fire(
                  "Error",
                  "Error al realizar la factura, intente nuevamente.",
                  "error"
                ).then((result) => {
              window.location = "emision-facturas";
                }) 
  
              }
  
            },
  
            error: function(response, err){ console.log('my message ' + err + " " + response );}
  
      }) 


    // console.log("Factura", JSON.stringify(factura));
    // console.log(empresa);
    // console.log(arrayFactura);
    // console.log(factura);
    // console.log(listProd);

})

/*=============================================
          = FUNCIONES DEL PROYECTO  =
=============================================*/

function sumarTotalPreciosEmision() {

    var precioItem = $(".frmTotalProd");
    
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
        $("#frmtoSiniva").val(0); 
        $("#frmtoSiniva2").val(0); 
    }else {
    
        var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
        // console.log(sumaTotalPrecio);
    
        $("#frmtoSiniva").val(sumaTotalPrecio);
        let totalfORMAT = formatter.format(sumaTotalPrecio);
        $("#frmtoSiniva2").val(totalfORMAT);
        // $("#frmtoSiniva2").formatNumber({format:"#,###", locale:"us"});
    }
    
    //  $(".frmFacttoSiniva").number(true , 2);
    
    }

function sumarTotalimpuestosEmision() {

    var precioItem = $(".frmTotalProd");
    console.log("precioItem", precioItem);
    console.log("precioItem", precioItem);
    var impuestoItem = $("option:selected", ".frmProd");
    
    // var impuestoItem = $('option:selected', '.DescripcionProducto');
    // console.log("impuestoItem", impuestoItem);
    
        var arraySumaPrecio = [];
         var arraySumaPrecioIVA = []
        
        for (var i = 0; i < precioItem.length; i++) {
    
        if ($(impuestoItem[i]).attr("tipo_impuesto") == "08"){

            arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.13);
    
            }else if($(impuestoItem).attr("tipo_impuesto") == "07"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.08 );

            }else if($(impuestoItem).attr("tipo_impuesto") == "06"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.04 );

            }else if($(impuestoItem).attr("tipo_impuesto") == "05"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()));

            }else if($(impuestoItem).attr("tipo_impuesto") == "04"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.04 );

            }else if($(impuestoItem).attr("tipo_impuesto") == "03"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.02 );

            }else if($(impuestoItem).attr("tipo_impuesto") == "02"){

              arraySumaPrecioIVA.push(Number($(precioItem[i]).val()) * 0.01 );

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
              $("#frmtoIva").val(0);
              $("#frmtoIva2").val(0);
          }else {
    
              var sumaTotalPrecio = arraySumaPrecioIVA.reduce(sumaArrayimpuestos);
              // console.log(sumaTotalPrecio);
              $("#frmtoIva").val(sumaTotalPrecio);
              let totalIV = formatter.format(sumaTotalPrecio);      
              $("#frmtoIva2").val(totalIV);                
              // $("#frmtoIva2").formatNumber({format:"#,###", locale:"us"});
          } 
    }  

function AgregarProductos_tablaEmision(){


    var listaProductos_2 = [];
    
    
    /*=============================================
    = OPTENGO EL ATRIBUTO DEL OPTION  SELECT          =
    =============================================*/
    
    
    var selectProd = $('option:selected', '.frmProd');
    
    
    
    var cantidad = $(".frmcant");
        
    var descuento = $(".frmdesc");  
      
    for (var i = 0; i < selectProd.length; i++){
    
    listaProductos_2.push({"nombre": $(selectProd[i]).attr('nombre_equipo'),
                        "tipo_impuesto": $(selectProd[i]).attr('Cod_impuesto'),                         
                         "impuesto": $(selectProd[i]).attr('tipo_impuesto'),
                         "cantidad": $(cantidad[i]).val(),
                          "SKU": $(selectProd[i]).attr("SKU"),
                          "cabys":  $(selectProd[i]).attr("CABIS"),
                          "precio_unidad": $(selectProd[i]).attr("PRECIO_UNIDAD"),
                          "descuento":  $(descuento[i]).val(),
                          "medida": $(selectProd[i]).attr('unidad_medida')
                        });
    
    }
    
    
//    console.log("listaProductos_2", listaProductos_2);
    return listaProductos_2;
    
    
    
    
    }

    var datosFactura = [];
function DatosFactura(Id_factura){




    var data = new FormData();

    data.append("Factura", Id_factura); 

     $.ajax({
 
          url:"ajax/emision-facturas-facturar.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",  
          success: function(response){

            // console.log(response);

            $('#frmnombreC').val(response[0].nombre_cliente);
            $('#frmced').val(response[0].cedula_cliente);
            $('#frmCorreo').val(response[0].correo_cliente);
            $('#frmActEconomica').val(response[0].codigo_actividad);
            $('#frmsucursal').val(response[0].sucursal);
            $('#frmCaja').val(response[0].caja);
            $('#frmtipoPago').val(response[0].medios_pago);
            $('#frmtipoDoc').val(response[0].tipo_documento);


            datosFactura.push({"id_compania": response[0].id_compania,
                          "sucursal": response[0].sucursal,                         
                           "caja": response[0].caja,
                           "tipo_documento": response[0].tipo_documento,
                            "codigo_actividad": response[0].codigo_actividad,
                            "tipo_personeria":  response[0].tipo_personeria,
                            "cedula_cliente": response[0].cedula_cliente,
                            "nombre_cliente":  response[0].nombre_cliente,
                            "correo_cliente": response[0].correo_cliente,
                            "tipo_cambio": response[0].tipo_cambio,
                            "codigo_moneda":  response[0].codigo_moneda,
                            "medios_pago": response[0].medios_pago
                          });


        },
                    
    });

return datosFactura;

}


function AgregarDatosEmpresaEmision(idempresa){


    var listaDatosEmpresa = [];
    
    let empresa = idempresa;
    
    // let empresa = $('option:selected','#empresaheader').val();

  
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



function modificarDatosFactura(consecutivo, clave, estado){

    var Id_factura = urlparams.get('factura');

    var data = new FormData();

    data.append("conse", consecutivo); 
    data.append("clave", clave); 
    data.append("estado", estado); 
    data.append("facId", Id_factura); 
     $.ajax({
 
          url:"ajax/emision-facturas-facturar.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
        //   dataType: "json",  
          success: function(response){

            // console.log(response);


        },
                    
    });





}