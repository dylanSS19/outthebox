
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

/*CRAGR EN INICIO*/


     var datos = [];

  let params = new URLSearchParams(location.search);
  let FechaInicio = params.get('startDate');
  let FechaFin = params.get('endDate');
  let estado = "Aceptado";
  let tipodocumento = $('option:selected', '.tipodocumento').val();

      datos.push({"FechaInicio": FechaInicio,  
                       "FechaFin": FechaFin,  
                       "cedula": $("#cedulaBuscar").val(),
                       "consecutivo": $("#consecutivoBuscar").val(),
                       "tipoDoc": tipodocumento,
                       "estado": estado
                     });


  datos = JSON.stringify(datos);
  
  
    if ( $.fn.DataTable.isDataTable('#tablaSistemaFacturas') ) {
  $('#tablaSistemaFacturas').DataTable().destroy();
}


var table =  $('#tablaSistemaFacturas').DataTable( {
  dom: 'Bfrtip',
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
   buttons: [
       'pageLength','colvis',
        'copy', 'excel', 'pdf'
   ],

"ajax": 'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,
"async": "false",

   "deferRender": true,
"retrieve": true,
"processing": true,

// 'columnDefs': [
//   { targets: 2, className: 'bg-light  color-palette'},
//   { targets: 3, className: 'bg-light  color-palette'},
//   { targets: 4, visible: false, className: 'bg-light  color-palette'},

//   { targets: 7, visible: false },

//    { targets: 8, className: 'bg-light  color-palette'},
//   { targets: 9, className: 'bg-light  color-palette'},
//   { targets: 10, visible: false, className: 'bg-light  color-palette' },

//   { targets: 13, visible: false },


// ],
'columns': [
null,
null,
null,
null,
null,  
null,
null,
null,
        { 
    render: function(data, type, row, meta){
       if(type === 'display'){
        
      
            // console.log(data);
          var num = $.fn.dataTable.render.number(',', '.', 2).display(data);              
          return num;           
         
       } else {
          return data;
       }
    }
  },

],

"language": {
  buttons: {
           colvis: 'Columnas Visibles',
            copy: 'Copiar',
            pageLength:'Mostrar'
       },

 "sProcessing":     "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
 "sLoadingRecords": "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
"footerCallback": function ( row, data, start, end, display ) {
       var api = this.api(), data;

       // Remove the formatting to get integer data for summation
       var intVal = function ( i ) {
           return typeof i === 'string' ?
               i.replace(/[\$,]/g, '')*1 :
               typeof i === 'number' ?
                   i : 0;
       };

         // Total over all pages
       total = api
           .column( 8, { search: 'applied'} )
           .data()
           .reduce( function (a, b) {
               return intVal(a) + intVal(b);
           }, 0 );

       // Update footer
       $( api.column( 8 ).footer() ).html(
        Number(total).toLocaleString("en-US") +''
       );
       
      //  Number(total)  total.number(',', '.', 2, '₡')
      // '₡'+ Number(total).toLocaleString("en-US") +''
/*'₡'+ Number(total).toLocaleString("en-US") +''*/

   
   } ,

   
});


//  $.ajax({

         
//           url:'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,
//           async: false,
//           success: function(response){

       
//         console.log("respuesta",response);
              
//              },

// });


 $(".buscarFacturas").click(function() {

  if ( $.fn.DataTable.isDataTable('#tablaSistemaFacturas') ) {
  $('#tablaSistemaFacturas').DataTable().destroy();
}

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
                       "tipoDoc": tipodocumento,
                       "estado": estado
                     });


  datos = JSON.stringify(datos);


  $('#tablaSistemaFacturas').DataTable( {
    dom: 'Bfrtip',
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
     buttons: [
         'pageLength','colvis',
          'copy', 'excel', 'pdf'
     ],
  
  "ajax": 'ajax/datatable-reporte-sistema-facturas.ajax.php?Filtros='+datos,
  "async": "false",
  
     "deferRender": true,
  "retrieve": true,
  "processing": true,
  
  // 'columnDefs': [
  //   { targets: 2, className: 'bg-light  color-palette'},
  //   { targets: 3, className: 'bg-light  color-palette'},
  //   { targets: 4, visible: false, className: 'bg-light  color-palette'},
  
  //   { targets: 7, visible: false },
  
  //    { targets: 8, className: 'bg-light  color-palette'},
  //   { targets: 9, className: 'bg-light  color-palette'},
  //   { targets: 10, visible: false, className: 'bg-light  color-palette' },
  
  //   { targets: 13, visible: false },
  
  
  // ],
  'columns': [
  null,
  null,
  null,
  null,
  null,  
  null,
  null,
  null,
          { 
      render: function(data, type, row, meta){
         if(type === 'display'){
          
            
        
              // console.log(data);
            var num = $.fn.dataTable.render.number(',', '.', 2).display(data);              
            return num;           
           
         } else {
            return data;
         }
      }
    },
  
  ],
  
  "language": {
    buttons: {
             colvis: 'Columnas Visibles',
              copy: 'Copiar',
              pageLength:'Mostrar'
         },
  
   "sProcessing":     "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
   "sLoadingRecords": "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
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
  "footerCallback": function ( row, data, start, end, display ) {
         var api = this.api(), data;
  
         // Remove the formatting to get integer data for summation
         var intVal = function ( i ) {
             return typeof i === 'string' ?
                 i.replace(/[\$,]/g, '')*1 :
                 typeof i === 'number' ?
                     i : 0;
         };
  
  
  
           // Total over all pages
         total = api
             .column( 8, { search: 'applied'} )
             .data()
             .reduce( function (a, b) {
                 return intVal(a) + intVal(b);
             }, 0 );
  
         // Update footer
         $( api.column( 8 ).footer() ).html(
               Number(total).toLocaleString("en-US") +''
         );
  
  
  /*'₡'+ Number(total).toLocaleString("en-US") +''*/
  
     
     } ,
  
     
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



 $.ajax({

         
          url:'ajax/datatable-reporte-sistema-facturas.ajax.php?IDfactura='+idfac,
          async: false,
          success: function(response){

       
       console.log("respuesta",response);
              
             },

      });





  if ( $.fn.DataTable.isDataTable('#tblDetalleFac') ) {
  $('#tblDetalleFac').DataTable().destroy();
}

  


    $("#tblDetalleFac").DataTable({
      "ajax": 'ajax/datatable-reporte-sistema-facturas.ajax.php?IDfactura='+idfac,
      "async": "false",
   "language": {

      "sProcessing":     '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>',
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
      "sLoadingRecords": '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>',
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


      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tblDetalleFac_wrapper .col-md-6:eq(0)');


/*qwqweqwewqeqwewwqewqeqeqweqweqwqwe*/





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
                // console.log("response", response);
          

if(response[0].tipo_documento == "03"){

$('.btnEliminar').attr('disabled', true);
$('.clvNotas').removeAttr('hidden');
$('#clvDocumento').val(response[0].referencia);

 }else if (response[0].estado_anulacion == "Total"){

$('.btnEliminar').attr('disabled', true);

}else if(response[0].api == "Si"){

  $('.btnEliminar').attr('disabled', true);
  
}else if($('.btnEliminar').attr('vencido') == "Si"){


}else{

  console.log("hola");

$('.clvNotas').attr('hidden', true);
$('.btnEliminar').removeAttr('disabled');
}

if(response[0].estado_factura == "enviado"){

  $('.btnImprimir').attr('disabled', true);
  $('.descargar').attr('disabled', true);
}else{


  $('.btnImprimir').removeAttr('disabled');
  $('.descargar').removeAttr('disabled');

}


       $('#nomReceptor').val(response[0].nombre_cliente);
       $('#cedReceptor').val(response[0].cedula_cliente);
       $('#mailReceptor').val(response[0].correo_cliente);
       $('#observaciones').val(response[0].detalle_estado_hacienda);
       
        document.querySelector('.Mneto').innerText = Number(response[0].subtotal,2).toLocaleString("en-US", {
          style: "currency",
          currency: response[0].codigo_moneda
      });
        document.querySelector('.Mdescuento').innerText = Number(response[0].descuento).toLocaleString("en-US", {
          style: "currency",
          currency: response[0].codigo_moneda
      });
        document.querySelector('.Miva').innerText = Number(response[0].impuesto).toLocaleString("en-US", {
          style: "currency",
          currency: response[0].codigo_moneda
      });
        document.querySelector('.Mtotal').innerText = Number(response[0].total).toLocaleString("en-US", {
          style: "currency",
          currency: response[0].codigo_moneda
      });
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
    
     var data = new FormData();
    
            data.append("UrlPdf",'/mnt/blockstorage/html/private/apiHacienda/clientes/'+ empresa +'/facturaPDF/Documento'+ clave +'.pdf'); 
            data.append("UrlPdfclave",clave); 
            data.append("UrlPdfempresa",empresa); 
    
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
                         console.log("response", response);
                      },
    
                       error: function(response, err){ console.log('my message ' + err + " " + response );}
    
                })
    
    
    
    
    var a = document.createElement('A');
    var filePath = '../documento/documento'+clave+'.pdf';
    
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

 var data = new FormData();

        data.append("UrlZipclave",clave); 
        data.append("UrlZipempresa",empresa); 

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
                     console.log("response", response);
                  },

                   error: function(response, err){ console.log('my message ' + err + " " + response );}

            })







var urls = [];

let documento_1 = '';

let documento_2 = ''; 

let documento_3 = ''; 


 for(var i=1; i <= 3; i++){

let urldom = '';

if(i == 1){

urldom = '../documento/DocumentoRespuesta'+clave+'.xml';

}else if(i == 2){

urldom = '../documento/DocumentoFirmado'+clave+'.xml';

}else if(i == 3){

urldom = '../documento/Documento'+clave+'.pdf';

}


if(UrlExists(urldom) == true){

urls.push(urldom);

}else{



}


 }

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




Swal.fire({
  title: '¿Desea anular la factura?',
  showDenyButton: false,
  showCancelButton: true,
  confirmButtonText: 'Anular',
  denyButtonText: 'Cancelar',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $("#overlay2").fadeIn();
    let idfact = $(this).attr("idFactura");
    eliminarFactura(idfact);

  } else if (result.isDenied) {
    


  }else if (result.isCancel) {
    


  }

})


 });




function eliminarFactura(idfact){

  let cont = 1;
  var DetalleFactura = [];
  var Factura = "";
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
              console.log("response", response);
              

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
                      "montoImpuesto":"0",
                      "categoria":""+ response[i].categoria +""                                              
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
                      "montoImpuesto":""+ monto_impuesto +"",
                      "categoria":""+ response[i].categoria +""                                           
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

         let empresa = CargarDtosCliente(response[0].id_compania);

              var fecha_factura = new Date(response[0].fecha_factura).toLocaleString("es-CR", {month: "2-digit", year: "numeric", day: "2-digit", hour12: false }.timeZone ='UTC');

                fecha_factura = moment(fecha_factura,'DD/MM/YYYY').format('YYYY-MM-DD', 'es-CR');

              var hora_factura = moment(fecha_factura,'hh:mm:ss').format('hh:mm:ss', 'es-CR');

              Factura = {
              "fileContent":{

                          "datosEmisor":{
                              "usuario": ""+ empresa[0].usuario_facturacion +"",
                              "password": ""+ empresa[0].contrasena_facturacion +"",
                              "cedula":""+ empresa[0].cedula +"",
                              "id_empresa":""+ empresa[0].idtbl_clientes +""   
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
                                  "moneda":""+response[0].codigo_moneda+"",                                                                     
                                  "condicionVenta":""+response[0].condicion_venta+"",
                                  "plazoCredito":""+response[0].plazo_credito+"",
                                  "medioPago":""+response[0].medios_pago+"",
                                  "tipoCambio":""+response[0].tipo_cambio+"",
                                  "actividadEconomica":""+response[0].codigo_actividad+"",
                                  "api":"No",
                                  "estadoAnulacion":"Total",
                                  "detalleFactura":
                                  DetalleFactura                                                                       
                          }
                    }       
                }


 

            },

             error: function(response, err){ console.log('my message ' + err + " " + response );}

      })

console.log("Datos", JSON.stringify(Factura));
// return;
//console.log("Datos", JSON.stringify(Factura));

let DatosFactura = JSON.stringify(Factura)

// return false;
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
                  console.log("response", response);
        var responsejson = JSON.parse(response);

        if(responsejson["success"]== "true"){
          $("#overlay2").fadeOut();
        Swal.fire(
              "Exito",
              "Nota crédito aplicada correctamente.",
              "success"
            ).then((result) => {

          window.location = "reporte-sistema-facturacion";
            }) 
  

        }else if(responsejson["success"] == "false" && responsejson["error"] == "P12"){
          $("#overlay2").fadeOut();

          Swal.fire(
            "Error",
            "Error en el Archivo o datos del P12, Actualizar los datos del P12 e intentar nuevamente.",
            "error"
          ).then((result) => {
        window.location = "reporte-sistema-facturacion";
          }) 

        }else{

          $("#overlay2").fadeOut();
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


}


function CargarDtosCliente(idEmpresa){

var datos = [];
var detalleEmpresa;

var data = new FormData();

    data.append("idEmpresa",idEmpresa); 

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
                 detalleEmpresa = {
                  "idtbl_clientes":""+ response[0].idtbl_clientes +"",
                  "cedula":""+ response[0].cedula +"",
                  "usuario_facturacion":""+ response[0].usuario_facturacion +"",
                  "contrasena_facturacion":""+ response[0].contrasena_facturacion +""
                 }
                 datos.push(detalleEmpresa);

                },

                error: function(response, err){ console.log('my message ' + err + " " + response );}
 
          })

return datos;

}




 $(".btnCorreo").click(function() {


//$('#modalDfacturas').modal('hide'); // cerrar

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

                 //(console.log("response", response);

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

 //console.log("datos", datos);

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
                 //console.log("response", response);

            if(response['estado'] == "COREEO OK"){

                Swal.fire(
                    "Exito",
                    "Correo distribuido exitosamente.",
                    "success"
                  ).then((result) => {
                    $('#modalCorreo').modal('hide');

                // window.location = "reporte-sistema-facturacion";
                  }) 
              
              $('#mailReenvio').val('');

            }else{

                Swal.fire(
                    "Error",
                    "Error en la distribución",
                    "error"
                  ).then((result) => {

                    $('#modalCorreo').modal('hide');

                // window.location = "reporte-sistema-facturacion";
                  }) 


            }

                },

               error: function(response, err){ console.log('my message ' + err + " " + response );}

         })


 });

