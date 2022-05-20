const queryStringemision = window.location.search;

const urlparamemision = new URLSearchParams(queryStringemision);

const paramemision = urlparamemision.get('startDate');

if(paramemision==null){

       localStorage.removeItem("captureRange-daterange-btn-emisionFact");
         localStorage.clear();
         $("#daterange-btn-emisionFact span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{

 
}
  
   
/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-daterange-btn-emisionFact") != null){

  $("#daterange-btn-emisionFact span").html(localStorage.getItem("captureRange-daterange-btn-emisionFact"));


}else{

  $("#daterange-btn-emisionFact span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}
 
/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-emisionFact').daterangepicker(
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
    $('#daterange-btn-emisionFact span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-emisionFact span").html();
   
    localStorage.setItem("captureRange-daterange-btn-emisionFact", capturarRango);


    window.location = "index.php?route=emision-facturas&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-emisionFact').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-emisionFact').val('');


  localStorage.removeItem("captureRange-daterange-btn-emisionFact");
  localStorage.clear();


 window.location = "emision-facturas";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-emisionFact').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-emisionFact').data('daterangepicker');
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

      localStorage.setItem("captureRange-daterange-btn-emisionFact", "Hoy");


          
       window.location = "index.php?route=emision-facturas&startDate="+startDate+"&endDate="+endDate;
    

  }
});


 

$("#rutas_vendedores").select2({ 

    width : 'resolve',
    theme: "classic",
    placeholder: 'Selecionar Ruta'

}); 

// let params = new URLSearchParams(location.search);

var Rol = sessionStorage.getItem('rol'); 



$(document).ready(function() {

// if(Rol == "AllMarket-Vendedor"){
    var fechaInicio = urlparamemision.get('startDate');
    var fechaFin = urlparamemision.get('endDate');
    var Ruta = urlparamemision.get('ruta');

    // var Ruta = ""; 
if(fechaInicio == "" || fechaInicio == null){
  fechaInicio = "n"
}

if(fechaFin == "" || fechaFin == null){
  fechaInicio = "n"
}

if(Ruta == "" || Ruta == null){
  Ruta = "n"
}

 console.log(fechaInicio);

    // Ruta = cargarRuta();

    cargarTabla(Ruta, fechaInicio, fechaFin);

// }else{

//     var Ruta = ""; 
//     var fechaInicio = urlparamemision.get('startDate');
//     var fechaFin = urlparamemision.get('endDate');

//     cargarTabla(Ruta, fechaInicio, fechaFin);

// }

});



function cargarTabla(Ruta, fechaInicio, fechaFin){

//   $.ajax({

         
//     url:'ajax/datatable-emision-facturas-ajax.php?Ruta='+ Ruta +'&startDate='+ fechaInicio +'&endDate='+ fechaFin,
//     async: false,
//     success: function(response){

//  console.log("respuesta",response);
        
//        },

// });


    var table = $("#tablaEmisionFacturas").DataTable({

        "ajax": 'ajax/datatable-emision-facturas-ajax.php?Ruta='+ Ruta +'&startDate='+ fechaInicio +'&endDate='+ fechaFin,  
        "async": "false",
       "responsive": true, "lengthChange": false, 
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
 
   error: function(response, err){ console.log('my message ' + err + " " + response );}
 
 
     })
   

}


//  Rol = sessionStorage.getItem('rol'); 
$("#rutas_vendedores").change(function() {

  var fechaInicio = urlparamemision.get('startDate');
  var fechaFin = urlparamemision.get('endDate');
  var ruta = $("option:selected",this).val();
 
  window.location = "index.php?route=emision-facturas&startDate="+fechaInicio+"&endDate="+fechaFin+"&ruta="+ruta;


});





function cargarRuta(){

    let ruta ;
 let user = sessionStorage.getItem('id'); 

    var data = new FormData();

    data.append("usuarioRuta", user);

    $.ajax({
            url:"ajax/emision-facturas.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",

            success: function(response){
            
                // console.log("response", response);
                ruta = response[0][2];
            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}
    })

    return ruta;

}

$("#tablaEmisionFacturas").on("click", "button.btnemitir", function(){

  Swal.fire({
    icon: "question",
    title: '¿Desea Realizar la factura?',
    cancelButtonColor: "#A0A0A0",
    confirmButtonColor: "#3498DB",
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Facturar',
    denyButtonText: 'Cancelar',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
  
      let idFactura = $(this).attr('idFactura');
      let NumFactura = $(this).attr('numFact');

      window.location = "index.php?route=emision-facturas-facturar&factura="+idFactura+"&numFact="+NumFactura;
  
    } else if (result.isDenied) {
      
  
  
    }else if (result.isCancel) {
      
  
  
    }
  
  })

});


$("#tablaEmisionFacturas").on("click", "button.btnanular", function(){

  Swal.fire({
    icon: "question",
    title: '¿Desea Anular la factura?',
    cancelButtonColor: "#A0A0A0",
    confirmButtonColor: "#FF0000",
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Anular',
    denyButtonText: 'Cancelar',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
  
      let idFactura = $(this).attr('idFactura');

      CancelarDocumento(idFactura);
  
    } else if (result.isDenied) {
      
  
  
    }else if (result.isCancel) {
      
  
  
    }
  
  })



});

 
function CancelarDocumento(idFactura){

  var data = new FormData();

  data.append("FactId", idFactura);

  $.ajax({
          url:"ajax/emision-facturas.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          // dataType: "json",

          success: function(response){
          
            if(response == "ok"){

              Swal.fire(
                "Existo",
                "Anulada correctamente.",
                "success"
            ).then((result) => {

            window.location = "emision-facturas";

            })

            }else{

            Swal.fire(
                "Aviso",
                "Anulada correctamente.",
                "success"
            ).then((result) => {

            window.location = "emision-facturas";
            
            })

            }
 
              console.log("response", response);
             
          },

          error: function(response, err){ console.log('my message ' + err + " " + response );}
  })

}





var input = document.getElementById('csvFacturas');
var infoArea = document.getElementById('labelCsvFacturas');

input.addEventListener('change', showFileName);

function showFileName(event) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'Archivo: ' + fileName;
}


$('.btnAddFacturas').on("click",function(e){
 
  $("#overlay2").fadeIn();
  let empresa = $("option:selected", ".empresaheader").val();
  let sucursal = $("option:selected", ".frmFactEmisucursal").val();;
  let caja = $("option:selected", "#frmFactEmicaja").val();
  let actividad = $("option:selected", "#frmFactEmiActividad").val();

// console.log(sucursal);
//   return false;
if(sucursal == ""){
  $("#overlay2").fadeOut();
  Swal.fire(
    "Aviso",
    "Seleccione una sucursal antes de procesar las Facturas.",
    "error"
    ).then((result) => {

    // window.location = "emision-facturas";

    })
    return false;
}

if(caja == ""){
  $("#overlay2").fadeOut();
  Swal.fire(
    "Aviso",
    "Seleccione una caja antes de procesar las Facturas.",
    "error"
    ).then((result) => {

    // window.location = "emision-facturas";

    })
  return false;
}

if(actividad == ""){
  $("#overlay2").fadeOut();
  Swal.fire(
    "Aviso",
    "Seleccione una actividad antes de procesar las Facturas.",
    "error"
    ).then((result) => {

    // window.location = "emision-facturas";

    })
  return false;
}


    var data = new FormData();

    data.append("xlsxFacturas", input.files[0]);
    data.append("xlsxEmpresa", empresa);

    $.ajax({
            url:"ajax/emision-facturas.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",

            success: function(response){

              console.log("response", response);
            
              if(response != "false"){
                
                GuardarDatos(empresa, response, sucursal, caja, actividad)

              }else{

                Swal.fire(
                    "Aviso",
                    "Documento No Procesado Correctamente, Intente Nuevamente.",
                    "error"
                ).then((result) => {

                window.location = "emision-facturas";
                
                })

              }
  
                
              
            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}
    })


});


function GuardarDatos(empresa, documento, sucursal, caja, actividad){

 var data = new FormData();

 data.append("empresa", empresa);
 data.append("Documento", documento);
 data.append("sucursal", sucursal);
 data.append("caja", caja);
 data.append("actividad", actividad);

 $.ajax({
         url:"extensions/Excel/vendor/leerExcelFacturas.php",
         method: "POST",
         data: data,
         cache: false,
         contentType: false,
         processData: false,
         async: false,
        //  dataType: "json",

         success: function(response){
          $("#overlay2").fadeOut();
          if(response == "ok"){

            Swal.fire(
              "Aviso",
              "Facturas Procesadas.",
              "success"
            ).then((result) => {
      
                window.location = "emision-facturas";
              
            })

          }
          
                     
         },

         error: function(response, err){ console.log('my message ' + err + " " + response );}
 })
  
  
}


$(".frmFactEmisucursal").change(function() {

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
                $("#frmFactEmicaja").empty();
                $("#frmFactEmicaja").append('<option disabled selected value="">Seleccionar Caja</option>');   
                for(var i = 0; i < response.length; i++){  

                  $("#frmFactEmicaja").append('<option value="'+response[i]["idcaja"]+'" >'+response[i]["nombre"]+'</option>');

                }
        },
                    
    })
  
});



$("#btnSelectAll").click(function() {
  // $(".chkFacturar").attr('checked', true);

  $('input[type="checkbox"]').each(function() {
    
    let idDiv = $(this).attr("id");

    if($("#"+ idDiv).is(':checked')){

      $("#"+ idDiv).removeAttr("checked");
      // $("#"+ idDiv).prop("checked", false);
     console.log()
    }else{
     
      $("#"+idDiv).attr('checked', true);  
    
    }

   });
})



$("#btnFacturarAll").click(function() {
  // $(".chkFacturar").attr('checked', true);
  $('input[type="checkbox"]').each(function() {
    
    // console.log($(this).val());
  
    if($(this).is(':checked')){
      $("#overlay2").fadeIn();
    // listaSubMods2.push();   
    let Id_factura =  $(this).attr("id");
    let numFactura =  $(this).attr("numFact");
    let arrayDetallesFactura = [];
    console.log($(this).attr("id"));        
    console.log($(this).attr("numFact"));   
   let datosFactura =  AgregarDatosFactura(Id_factura);
   let datosDetalleFactura = AgregarDetalleFactura(numFactura);
   let datosEmpresa = AgregarDatosEmpresaEmisionFactura(datosFactura[0]["idcompania"])
   console.log(datosFactura);   
   console.log(datosDetalleFactura);  
   console.log(datosEmpresa);   

      for (var i = 0; i < datosDetalleFactura.length; i++){

        if(datosDetalleFactura[i]["tasaImpuesto"] != "0"){

          let Descuento = parseFloat(datosDetalleFactura[i]["descuento"]);
          let subTotal = parseFloat(datosDetalleFactura[i]["precioUnidad"]) * parseFloat(datosDetalleFactura[i]["cantidad"]) - Descuento;
          let montoIVA = (subTotal * parseFloat(datosDetalleFactura[i]["tasaImpuesto"])) / 100;
          let totalDetalle = subTotal + montoIVA;


          detalleFactura = {                            
            "numeroLinea":""+ (i + 1) +"",
            "cabys":""+ datosDetalleFactura[i]["cabys"] +"",
            "unidadMedida":"Unid",
            "tipoCodigoProducto":"01",
            "Codigo":""+ datosDetalleFactura[i]["codigo"] +"",
            "descripcionProducto":""+ datosDetalleFactura[i]["producto"] +"",
            "cantidad":""+ datosDetalleFactura[i]["cantidad"] +"",
            "precioUnitario":""+ datosDetalleFactura[i]["precioUnidad"] +"",
            "costo":""+ datosDetalleFactura[i]["costo"] +"",
            "descuento":""+ Descuento +"",
            "motivoDescuento":"Descuento",
            "subTotal":""+ subTotal +"",              
            "totalDetalle":""+ totalDetalle +"",                                  
            "tipoImpuesto":""+datosDetalleFactura[i]["codImpuesto"]+"",
            "codTasaImpuesto":""+datosDetalleFactura[i]["codTasaImp"]+"",
            "tasaImpuesto":""+datosDetalleFactura[i]["tasaImpuesto"]+"",
            "montoImpuesto":""+ montoIVA +"" ,
            "categoria":"Bien"	                                                  
            }

            arrayDetallesFactura.push(detalleFactura);

        }else{

          let Descuento = parseFloat(datosDetalleFactura[i]["descuento"]);
          let subTotal = parseFloat(datosDetalleFactura[i]["precioUnidad"]) * parseFloat(datosDetalleFactura[i]["cantidad"]) - Descuento;
          let montoIVA = (subTotal * parseFloat(datosDetalleFactura[i]["tasaImpuesto"])) / 100;
          let totalDetalle = subTotal + montoIVA;

          detalleFactura = {                            
            "numeroLinea":""+ (i + 1) +"",
            "cabys":""+ datosDetalleFactura[i]["cabys"] +"",
            "unidadMedida":"Unid",
            "tipoCodigoProducto":"01",
            "Codigo":""+ datosDetalleFactura[i]["codigo"] +"",
            "descripcionProducto":""+ datosDetalleFactura[i]["producto"] +"",
            "cantidad":""+ datosDetalleFactura[i]["cantidad"] +"",
            "precioUnitario":""+ datosDetalleFactura[i]["precioUnidad"] +"",
            "costo":""+ datosDetalleFactura[i]["costo"] +"",
            "descuento":""+ Descuento +"",
            "motivoDescuento":"Descuento",
            "subTotal":""+ subTotal +"",              
            "totalDetalle":""+ totalDetalle +"",                                  
            "tipoImpuesto":"0",
            "codTasaImpuesto":"0",
            "tasaImpuesto":"0",
            "montoImpuesto":"0" ,
            "categoria":"Bien"		                                             
            }
    
            arrayDetallesFactura.push(detalleFactura);

        }

console.log(arrayDetallesFactura);

        factura  = {
          "fileContent":{
        
                      "datosEmisor":{
                          "usuario": ""+datosEmpresa[0].usuario+"",
                          "password": ""+datosEmpresa[0].password+"",
                          "cedula":""+datosEmpresa[0].cedula+"",
                          "id_empresa":""+datosEmpresa[0].id_empresa+""   
                      },     
                      "datosReceptor":{
                          "nombre":""+ datosFactura[0].nombre +"",
                          "tipoCedula":""+datosFactura[0].tipoPersoneria+"",
                          "cedula":""+datosFactura[0].cedula+"",
                          "direccion": "LOCAL COMERCIAL",
                          "correo":""+datosFactura[0].correo+"",
                          "telefono":"11111111",
                          "provincia": "",
                          "canton": "",
                          "distrito": "",
                          "senas": "LOCAL COMERCIAL"
                      },          
                      "datosFactura":{
                              "sucursal":""+datosFactura[0].sucursal+"",
                              "caja":""+datosFactura[0].caja+"",
                              "tipoDoc":""+ datosFactura[0].tipoDocumento +"",
                              "moneda":""+ datosFactura[0].moneda +"",                                                                     
                              "condicionVenta":"01",
                              "plazoCredito":""+ datosFactura[0].plazoCredito +"",
                              "medioPago":""+ datosFactura[0].mediosPago +"",
                              "tipoCambio":""+ datosFactura[0].tipoCambio +"",
                              "actividadEconomica":""+ datosFactura[0].actividad +"",
                              "api":"No",
                              "estadoAnulacion":"",
                              "comentario":"",
                              "detalleFactura":
                              arrayDetallesFactura                                                                       
                      }
          }       
        }

console.log(JSON.stringify(factura));
// ENVIAR FACTURAS AL API
      var data = new FormData();
        data.append("DatosFactura",JSON.stringify(factura)); 
        
          $.ajax({
        
                  url:"ajax/emision-facturas.ajax.php", 
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
                      
                      let consecutivo = respt["Consecutivo"];
                      let clave = respt["Clave"];
                      let estado = "Emitido";

                      // modificarDatosFactura(consecutivo, clave, estado);
                      modificarDatosFactura(consecutivo, clave, estado, Id_factura);

                     
        
        
        
                    }else{
                      
                      
                      let consecutivo = respt["Consecutivo"];
                      let clave = respt["Clave"];
                      let estado = "Pendiente";

                      // modificarDatosFactura(consecutivo, clave, estado);
                      modificarDatosFactura(consecutivo, clave, estado, Id_factura);
                      
        
                    }
        
                  },
        
                  error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            }) 

      }



    }
  
  });

  $("#overlay2").fadeOut();

  Swal.fire(
    "Exelente",
    "Factura realizada con exito.",
    "success"
  ).then((result) => {
window.location = "emision-facturas";
  }) 

})


function modificarDatosFactura(consecutivo, clave, estado, Id_factura){

  // var Id_factura = urlparams.get('factura');

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


function AgregarDatosFactura(Id_factura){

  var listaFactura = [];

  /*=============================================
  = OPTENGO EL ATRIBUTO DEL OPTION  SELECT          =
  =============================================*/
  
  var data = new FormData();

  data.append("loadidFact", Id_factura); 

   $.ajax({

        url:"ajax/emision-facturas.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",  
        success: function(response){

          // console.log(response);
        

          listaFactura.push({"nombre": response[0].nombre_cliente,
                        "cedula": response[0].cedula_cliente,                         
                         "correo": response[0].correo_cliente,
                         "actividad": response[0].codigo_actividad,
                          "moneda": response[0].codigo_moneda,
                          "idcompania":  response[0].id_compania,
                          "mediosPago": response[0].medios_pago,
                          "numeroFactura":  response[0].numeroFactura,
                          "plazoCredito": response[0].plazo_credito,
                          "sucursal": response[0].sucursal,
                          "caja":  response[0].caja,
                          "tipoCambio": response[0].tipo_cambio,
                          "tipoDocumento": response[0].tipo_documento,
                          "tipoPersoneria": response[0].tipo_personeria
                        });

      },
                  
  });
  
  return listaFactura;
  
}


function AgregarDetalleFactura(numFactura){

  var listaDetalleFactura = [];

  /*=============================================
  = OPTENGO EL ATRIBUTO DEL OPTION  SELECT          =
  =============================================*/
  
  var data = new FormData();

  data.append("loadnumFactura", numFactura); 

   $.ajax({

        url:"ajax/emision-facturas.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",  
        success: function(response){

          // console.log(response);
        

          listaDetalleFactura.push({"producto": response[0].nombre,
                        "cabys": response[0].cabys,                         
                         "cantidad": response[0].cantidad,
                         "precioUnidad": response[0].precio_unidad,
                          "codigo": response[0].codigo,
                          "costo":  response[0].costo,
                          "porcentajeDescuento": response[0].porcentaje_descuento,
                          "descuento":  response[0].descuento,
                          "tasaImpuesto": response[0].tasa_Impuesto,
                          "codTasaImp": response[0].codTasaImp,
                          "codImpuesto":  response[0].codImpuesto,
                          "impuesto": response[0].impuesto,
                          "subtotal": response[0].subtotal,
                          "total": response[0].total
                        });

      },
                  
  });
  
  return listaDetalleFactura;
  
}

function AgregarDatosEmpresaEmisionFactura(idempresa){


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