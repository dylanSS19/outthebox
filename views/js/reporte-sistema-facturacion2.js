const queryStringfacturas = window.location.search;

const urlparamfacturas = new URLSearchParams(queryStringfacturas);

const paramfacturas = urlparamfacturas.get('startDate');

if(paramrecargas==null){

       localStorage.removeItem("captureRange-daterange-btn-SistemaFacturas");
         localStorage.clear();
         $("#daterange-btn-SistemaFacturas span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{

 
}
  
   
/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-daterange-btn-SistemaFacturas") != null){

  $("#daterange-btn-SistemaFacturas span").html(localStorage.getItem("captureRange-daterange-btn-SistemaFacturas"));


}else{

  $("#daterange-btn-SistemaFacturas span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}
 
/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-SistemaFacturas').daterangepicker(
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
    $('#daterange-btn-SistemaFacturas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-SistemaFacturas span").html();
   
    localStorage.setItem("captureRange-daterange-btn-SistemaFacturas", capturarRango);


    window.location = "index.php?route=reporte-sistema-facturacion&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-SistemaFacturas').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-SistemaFacturas').val('');


  localStorage.removeItem("captureRange-daterange-btn-SistemaFacturas");
  localStorage.clear();


 window.location = "reporte-sistema-facturacion";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-SistemaFacturas').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-SistemaFacturas').data('daterangepicker');
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

      localStorage.setItem("captureRange-daterange-btn-SistemaFacturas", "Hoy");


          
       window.location = "index.php?route=reporte-sistema-facturacion&startDate="+startDate+"&endDate="+endDate;
    
  

  }
});



 $(".buscarFacturas").click(function() {

  var datos = [];

  let params = new URLSearchParams(location.search);
  let FechaInicio = params.get('startDate');
  let FechaFin = params.get('endDate');
  let estado = $('option:selected', '.estadoFactura').val();
  let tipodocumento = $('option:selected', '.tipodocumento').val();

    datos.push({"FechaInicio": FechaInicio,  
                       "FechaFin": FechaFin,  
                       "cedula": $("#cedulaBuscar").val(),
                       "consecutivo": $("#consecutivoBuscar").val(),
                       "clave": $("#claveBuscar").val(),                 
                       "tipoDoc": tipodocumento,
                       "estado": estado
                     });


  datos = JSON.stringify(datos);


// $.ajax({

         
//           url:'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });

// if ( $.fn.DataTable.isDataTable('#tablaSistemaFacturas') ) {
//   $('#tablaSistemaFacturas').DataTable().destroy();
// }

// var table = $('#tablaSistemaFacturas').removeAttr('width').DataTable( {
//        // var table = $("#tablaSistemaFacturas").DataTable({

//              "ajax": 'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,  
//              "async": "false",
//              "columnDefs": [
//     { "width": "10%", "targets": 0 }
//   ],
//   "fixedColumns": true,
//         "responsive": true, 
//         "lengthChange": true, 
//         "autoWidth": false,
//          "deferRender": true,
//         "retrieve": true,
//         "processing": true,
//        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

           

//         "language": {

//           "sProcessing":     "Procesando...",
//           "sLengthMenu":     "Mostrar _MENU_ registros",
//           "sZeroRecords":    "No se encontraron resultados",
//           "sEmptyTable":     "Ningún dato disponible en esta tabla",
//           "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//           "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//           "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//           "sInfoPostFix":    "",
//           "sSearch":         "Buscar:",
//           "sUrl":            "",
//           "sInfoThousands":  ",",
//           "sLoadingRecords": "Cargando...",
//           "oPaginate": {
//           "sFirst":    "Primero",
//           "sLast":     "Último", 
//           "sNext":     "Siguiente",
//           "sPrevious": "Anterior"
//           },
//           "oAria": {
//             "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//           }

//         },
//         initComplete: function customEvent(e){
//      table.search(e.value).draw(table.responsive.recalc());  ///Must trigger the draw event, but move on to the next line while it's being processed/
//        // Essentially has no effect.
// }



//           })


$(function() {
    /* Populate table of Regulatory Information */
    var regulatoryInformationTable = $('#tablaSistemaFacturas').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ajax" : 'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,
                
        "columnDefs": [
            {"width": "25px", "targets": 0},
            {"width": "100px", "targets": 1},
            {"orderable": false, "targets": [0,1]} // Can't order
        ],
        "paging": false, // no pagination
        "language": {
            "zeroRecords": "Sorry we no data for this substance",
            "infoFiltered": "",
            "infoEmpty": "",
            "processing": '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>'
        }
    });   
});

});


$("#tablaSistemaFacturas").on("click", "button.btnFactura", function(){

//$('#myModalExito').modal('show'); // abrir
//$('#myModalExito').modal('hide'); // cerrar


// console.log("this", $(this).attr("idFactura"));

let idfac = $(this).attr("idFactura");
let claveF =  $(this).attr("claveF");
let comp = $(this).attr("comp");

$('.btnCorreo').attr('idFactura',idfac);
$('.btnImprimir').attr('idFactura',claveF);
$('.btnImprimir').attr('comp',comp);
$('.descargar').attr('idF',claveF);
$('.descargar').attr('Clv',comp);
$('.btnEliminar').attr('idFactura',idfac);




var data = new FormData();

    data.append("IdFactura",idfac); 

         $.ajax({
     
              url:"ajax/reporte-sistema-facturas.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
                // console.log("response", response);
          
if ( $.fn.DataTable.isDataTable('#tblDetalleFac') ) {
  $('#tblDetalleFac').DataTable().destroy();
}

$("#tblDetalle").empty("");



    var cont = 1;

      for(var i=0; i < response.length; i++){

        var tr = `<tr>
          <td>`+ cont +`</td>
          <td>`+response[i].nombre+`</td>
          <td>`+response[i].codigo+`</td>
          <td>`+response[i].cantidad+`</td>
          <td>`+response[i].precio_unidad+`</td>
          <td>`+ (parseFloat(response[i].cantidad) * parseFloat(response[i].precio_unidad))+`</td>
          <td>`+response[i].descuento+`</td>
          <td>`+response[i].impuesto+`</td>
          <td>`+response[i].total+`</td>
        </tr>`;
        $("#tblDetalle").append(tr)

        cont = cont + 1;
      }

  var table = $("#tblDetalleFac").DataTable({

            "responsive": true, "lengthChange": false, 
            "autoWidth": false,
         "deferRender": true,
        "retrieve": true,
        "processing": true,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

           

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

          }) 
                },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })


var simbolo = "";

var data = new FormData();

    data.append("IdFacturaF",idfac); 

         $.ajax({
     
              url:"ajax/reporte-sistema-facturas.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
                console.log("response", response);
       
       if(response[0].codigo_moneda == "CRC"){

        simbolo = "₡";

       }else{

        simbolo = "$";


       }         

if(response[0].tipo_documento == "03"){

$('.btnEliminar').attr('disabled', true);
$('.clvNotas').removeAttr('hidden');
$('#clvDocumento').val(response[0].referencia);

 }else if (response[0].estado_anulacion == "Total"){

$('.btnEliminar').attr('disabled', true);

}else{

$('.clvNotas').attr('hidden', true);
$('.btnEliminar').removeAttr('disabled');
}

       $('#nomReceptor').val(response[0].nombre_cliente);
       $('#cedReceptor').val(response[0].cedula_cliente);
       $('#mailReceptor').val(response[0].correo_cliente);
        document.querySelector('.Mneto').innerText = simbolo +" "+response[0].subtotal;
        document.querySelector('.Mdescuento').innerText = simbolo +" "+response[0].descuento;
        document.querySelector('.Miva').innerText = simbolo +" "+response[0].impuesto;
        document.querySelector('.Mtotal').innerText = simbolo +" "+response[0].total;
                },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })



$('#modalDfacturas').modal('show');




 });

 

// $("#tablaSistemaFacturas").on("click", "a.btnImprimir", function(){
 $(".btnImprimir").click(function() {

let clave = $(this).attr("idFactura");
let empresa = $(this).attr("comp");
// console.log("empresa", empresa);


var a = document.createElement('A');
var filePath = 'https://backup.midigitalsat.com/private/apiHacienda/clientes/'+ empresa +'/facturaPDF/Documento'+ clave +'.pdf';
a.href = filePath;
a.target = "_blank";
// a.download = filePath.substr(filePath.lastIndexOf('/') + 1);
document.body.appendChild(a);
a.click();
document.body.removeChild(a);


 });

// $("#tablaSistemaFacturas").on("click", "a.descargar", function(){
 $(".descargar").click(function() {


let clave = $(this).attr("idF");
let empresa = $(this).attr("Clv");
var urls = [];

let documento_1 = '';

let documento_2 = ''; 

let documento_3 = ''; 


 for(var i=1; i <= 3; i++){

let urldom = '';

if(i == 1){

urldom = 'https://backup.midigitalsat.com/private/apiHacienda/clientes/'+ empresa +'/facturaPDF/Documento'+ clave +'.pdf';

}else if(i == 2){

urldom = 'https://backup.midigitalsat.com/private/apiHacienda/clientes/'+ empresa +'/DocumentosFirmados/documento'+ clave +'.xml';

}else if(i == 3){

urldom = 'https://backup.midigitalsat.com/private/apiHacienda/clientes/'+ empresa +'/DocumentosRespuesta/documento'+ clave +'.xml';

}


if(UrlExists(urldom) == true){

urls.push(urldom);

}else{



}


 }


// console.log("urls", urls);


// 'https://backup.midigitalsat.com/private/apiHacienda/clientes/2505/DocumentosFirmados/documento50627082100310173144800800101040000000010100000010.xml';
// 'https://backup.midigitalsat.com/private/apiHacienda/clientes/2505/DocumentosFirmados/documento50631082100310173144800700101040000000002100000002.xml';
// var urls = [
//         documento_1,
//         documento_2
//     ];
    var zip = new JSZip();
    var count = 0;
    var count2 = 0;
    var zipFilename = 'Documentos'+ clave +'.zip';
    var nameFromURL = [];

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


 });




function UrlExists(url)
{

try {

    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;

} catch (err) {

    return false;

}


}



// $("#tablaSistemaFacturas").on("click", "button.btnEliminar", function(){
 $(".btnEliminar").click(function() {

var DetalleFactura = [];
var Factura = "";


  let idfact = $(this).attr("idFactura");
  let cont = 1;

    var data = new FormData();

        data.append("IdFactura",idfact); 

             $.ajax({
         
                  url:"ajax/reporte-sistema-facturas.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
                    // console.log("response", response);

                    for(var i=0; i < response.length; i++){



                        if(response[i].impuesto == 0){

                            var detalle_fac = {                            
                            "numeroLinea":""+ cont +"",
                            "cabys":""+ response[i].cabys +"",
                            "unidadMedida":"Unid",
                            "tipoCodigoProducto":"01",
                            "Codigo":""+ response[i].codigo +"",
                            "descripcionProducto":""+ response[i].nombre +"",
                            "cantidad":""+ response[i].cantidad +"",
                            "precioUnitario":""+ response[i].precio_unidad +"",
                            "costo":"0",
                            "descuento":""+ response[i].descuento +"",
                            "motivoDescuento":"Descuento",
                            "subTotal":""+ response[i].subtotal +"",              
                            "totalDetalle":""+ response[i].total +"",                                  
                            "tipoImpuesto":"0",
                            "codTasaImpuesto":"0",
                            "tasaImpuesto":"0",
                            "montoImpuesto":"0"                                              
                            }

                        }else{


        let monto = parseFloat(response[i].precio_unidad) * parseFloat(response[i].cantidad) ;
        let monto_impuesto = parseFloat(monto) * parseFloat(response[i].tasa_Impuesto);

                            var detalle_fac = {                            
                            "numeroLinea":""+ cont +"",
                            "cabys":""+ response[i].cabys +"",
                            "unidadMedida":"Unid",
                            "tipoCodigoProducto":"01",
                            "Codigo":""+ response[i].codigo +"",
                            "descripcionProducto":""+ response[i].nombre +"",
                            "cantidad":""+ response[i].cantidad +"",
                            "precioUnitario":""+ response[i].precio_unidad +"",
                            "costo":"0",
                            "descuento":""+ response[i].descuento +"",
                            "motivoDescuento":"Descuento",
                            "subTotal":""+ response[i].subtotal +"",              
                            "totalDetalle":""+ response[i].total +"",                                  
                            "tipoImpuesto":""+ response[i].codTasaImp +"",
                            "codTasaImpuesto":""+ response[i].codImpuesto +"",
                            "tasaImpuesto":""+ response[i].tasa_Impuesto +"",
                            "montoImpuesto":""+ monto_impuesto +""                                              
                            }
            

                        }

            cont = cont + 1;
            DetalleFactura.push(detalle_fac);

                    }

             },

                   error: function(response, err){ console.log('my message ' + err + " " + response );}

             })




 var data = new FormData();

        data.append("IdFacturaF",idfact); 

             $.ajax({
         
                  url:"ajax/reporte-sistema-facturas.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  dataType: "json",  
                  success: function(response){
                    // console.log("response", response);


                    var fecha_factura = new Date(response[0].fecha_factura).toLocaleString("es-CR", {month: "2-digit", year: "numeric", day: "2-digit", hour12: false }.timeZone ='UTC');

                      fecha_factura = moment(fecha_factura,'DD/MM/YYYY').format('YYYY-MM-DD', 'es-CR');

                    var hora_factura = moment(fecha_factura,'hh:mm:ss').format('hh:mm:ss', 'es-CR');

                    Factura = {
                    "fileContent":{

                                "datosEmisor":{
                                    "usuario": "oNEeKO7R4nmwhU9qHyDs",
                                    "password": "2rLDI2Gkhgk9s34Xhj2a",
                                    "cedula":"3101731448",
                                    "id_empresa":"2505"   
                                } ,     
                                "datosReceptor":{
                                    "nombre":""+ response[0].nombre_cliente +"",
                                    "tipoCedula":""+response[0].tipo_personeria+"",
                                    "cedula":""+response[0].cedula_cliente+"",
                                    "direccion": "LOCAL COMERCIAL",
                                    "correo":""+response[0].correo_cliente+"",
                                    "telefono":"11111111",
                                    "provincia": "",
                                    "canton": "",
                                    "distrito": "",
                                    "senas": "LOCAL COMERCIAL"
                                },
                                "refenciaNota":{
                                "tipoDoc":""+ response[0].tipo_documento +"",
                                "clave":""+response[0].clave+"",
                                "fechaEmision":""+ fecha_factura +"",
                                "horaEmision":""+ hora_factura +"",
                                "codigo":"01",
                                "razon":"Aplicación Nota de Credito"
                                },          
                                "datosFactura":{
                                        "sucursal":""+response[0].sucursal+"",
                                        "caja":""+response[0].caja+"",
                                        "tipoDoc":"03",
                                        "moneda":"CRC",                                                                     
                                        "condicionVenta":"01",
                                        "plazoCredito":"0",
                                        "medioPago":"01",
                                        "tipoCambio":"1",
                                        "actividadEconomica":""+response[0].codigo_actividad+"",
                                        "detalleFactura":
                                        DetalleFactura                                                                       
                                }
                          }       
                      }




                  },

                   error: function(response, err){ console.log('my message ' + err + " " + response );}

            })



    console.log("Datos", JSON.stringify(Factura));

let DatosFactura = JSON.stringify(Factura)


     var data = new FormData();

            data.append("DatosFactura",DatosFactura); 

                 $.ajax({
             
                      url:"ajax/reporte-sistema-facturas.ajax.php",
                      method: "POST",
                      data: data,
                      cache: false,
                      contentType: false,
                      processData: false,
                      async: false,
                      // dataType: "json",  
                      success: function(response){
                        // console.log("response", response);
              var responsejson = JSON.parse(response);

              if(responsejson["success"]== "true"){

              Swal.fire(
                    "Exito",
                    "Nota crédito aplicada correctamente.",
                    "success"
                  ).then((result) => {

                window.location = "reporte-sistema-facturacion";
                  }) 


              }else{

              Swal.fire(
                    "Error",
                    "Error al realizar Nota crédito.",
                    "error"
                  ).then((result) => {

                window.location = "reporte-sistema-facturacion";
                  }) 

              }                                
                      },

                       error: function(response, err){ console.log('my message ' + err + " " + response );}

                })



 });



 $(".btnCorreo").click(function() {


$('#modalDfacturas').modal('hide'); // cerrar

let idFactura = $(this).attr("idFactura");

var data = new FormData();

    data.append("IdFacturaF",idFactura); 

         $.ajax({
     
              url:"ajax/reporte-sistema-facturas.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){

                // console.log("response", response);

                if(response[0].estado_correo == 'COREEO OK'){

                  $('.callout').removeClass("callout-danger");

                  $('.callout').addClass("callout-success");

                 $('.estadoCorreo').html('Correo Enviado'); 

                }else{

                  $('.callout').removeClass("callout-success");

                  $('.callout').addClass("callout-danger");

                  $('.estadoCorreo').html('Error de envio'); 

                }

     
                 $('#mailReenvioReceptor').val(response[0].correo_cliente);   
                 

                },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })




$('#modalCorreo').modal('show'); // abrir


 });




 $("#mailReenvio").keypress(function(e) {

let iChars = "!#$%^&*()+=[]\\\';/{}|\":<>?¿/°";
/*=============================================
=         PERMITE EL INGRESO DE - , @           =
=============================================*/
    if (iChars.indexOf(e.key) != -1) {
        // alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
        return false;
    }

 });


 $(".btnEnviarCorreo").click(function() {

let clave = $('.descargar').attr("idF");

let empresa = $('.descargar').attr("Clv");

let correos = $('#mailReenvio').val();


let datos = {
    "clave": ""+clave+"",
    "id_compania": ""+empresa+"",
    "receptor": ""+correos+""
}


 datos = JSON.stringify(datos);

 // console.log("datos", datos);

var data = new FormData();

    data.append("apiCorreo",datos); 

         $.ajax({
     
              url:"ajax/reporte-sistema-facturas.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",  
              success: function(response){
                // console.log("response", response);

            if(response['estado'] == "COREEO OK"){

                Swal.fire(
                    "Exito",
                    "Correo distribuido exitosamente.",
                    "success"
                  ).then((result) => {

                // window.location = "reporte-sistema-facturacion";
                  }) 
              
              $('#mailReenvio').val('');

            }else{

                Swal.fire(
                    "Error",
                    "Error en la distribución",
                    "error"
                  ).then((result) => {

                // window.location = "reporte-sistema-facturacion";
                  }) 


            }

                },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })


 });

