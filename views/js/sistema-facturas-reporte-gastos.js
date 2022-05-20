const queryStringReportGastos = window.location.search;

const urlparamReportGastos = new URLSearchParams(queryStringReportGastos);

const paramReportGastos = urlparamReportGastos.get('startDate');
 
if(paramReportGastos==null){
 
       localStorage.removeItem("captureRange-daterange-btn-ReportGastos");
         localStorage.clear();
         $("#daterange-btn-ReportGastos span").html('<i class="fa fa-calendar"></i> Rango de Fecha');

}else{

 
}
  
      
/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("captureRange-daterange-btn-ReportGastos") != null){

  $("#daterange-btn-ReportGastos span").html(localStorage.getItem("captureRange-daterange-btn-ReportGastos"));


}else{

  $("#daterange-btn-ReportGastos span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}
 
/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn-ReportGastos').daterangepicker(
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
    $('#daterange-btn-ReportGastos span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var startDate = start.format('YYYY-MM-DD');

    var endDate = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-ReportGastos span").html();
   
    localStorage.setItem("captureRange-daterange-btn-ReportGastos", capturarRango);


    window.location = "index.php?route=sistema-facturas-reporte-gastos&startDate="+startDate+"&endDate="+endDate;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$('#daterange-btn-ReportGastos').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('#daterange-btn-ReportGastos').val('');


  localStorage.removeItem("captureRange-daterange-btn-ReportGastos");
  localStorage.clear();


 window.location = "sistema-facturas-reporte-gastos";

});

/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-ReportGastos').on('apply.daterangepicker', function(ev, picker) {



  var textoHoy = $('#daterange-btn-ReportGastos').data('daterangepicker');
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

      localStorage.setItem("captureRange-daterange-btn-ReportGastos", "Hoy");


          
       window.location = "index.php?route=sistema-facturas-reporte-gastos&startDate="+startDate+"&endDate="+endDate;
    
  

  }
});





//  var datos = "ok";

//  $.ajax({

        
//          url:'ajax/datatable-sistema-facturas-reporte-gastos.ajax.php?dato='+datos,
//          async: false,
//          success: function(response){

//        console.log("respuesta",response);
             
//             },

// });



$(document).ready(function() {

    var datos = [];
    
    let FechaInicio = urlparamReportGastos.get('startDate');
    let FechaFin = urlparamReportGastos.get('endDate');
    let fecha = new Date();



if(FechaInicio == "" || FechaInicio == null ){

    FechaInicio = now = moment(fecha).format('YYYY/MM/DD');
    FechaFin = now = moment(fecha).format('YYYY/MM/DD');
    // console.log(fecha);

}else{

     FechaInicio = urlparamReportGastos.get('startDate');
     FechaFin = urlparamReportGastos.get('endDate');

}


    datos.push({"FechaInicio": FechaInicio,  
                "FechaFin": FechaFin });
    
    datos = JSON.stringify(datos);
    // console.log(datos);


//     $.ajax({

        
//         url:'ajax/datatable-sistema-facturas-reporte-gastos.ajax.php?dato='+datos,
//         async: false,
//         success: function(response){

//       console.log("respuesta",response);
            
//            },

// });


	if ( $.fn.DataTable.isDataTable('#tablaReportGastos') ) {
        $('#tablaReportGastos').DataTable().destroy();
      }
      var table =  $('#tablaReportGastos').DataTable( {
        dom: 'Bfrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
         buttons: [
             'pageLength','colvis',
              'copy', 'excel', 'pdf'
         ],
      
      "ajax": 'ajax/datatable-sistema-facturas-reporte-gastos.ajax.php?dato='+datos,
      "async": "false",
      
         "deferRender": true,
      "retrieve": true,
      "processing": true,
      
      'columns': [
      null,
      null,
      null,
      null,
      null,  
              { 
          render: function(data, type, row, meta){
             if(type === 'display'){
              
                var symbol = "";              
            
                  symbol = "";
            
                  // console.log(data);
                var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(data);              
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
                 .column( 5, { search: 'applied'} )
                 .data()
                 .reduce( function (a, b) {
                     return intVal(a) + intVal(b);
                 }, 0 );
      
             // Update footer
             $( api.column( 5 ).footer() ).html(
               Number(total).toLocaleString("en-US") +''
             );
             
            //  Number(total)  total.number(',', '.', 2, '₡')
            // '₡'+ Number(total).toLocaleString("en-US") +''
      /*'₡'+ Number(total).toLocaleString("en-US") +''*/
      
         
         } ,
           
      });

 });

 

 

 $("#tablaReportGastos").on("click", "button.btnFacGasto", function(){

    $('#modalDfacturasGastos').modal('show'); // abrir
    //$('#myModalExito').modal('hide'); // cerrar
$(this).val();


let idFactura = $(this).attr("idFactura");
datosFacturaGastos(idFactura);
datosDetalleFacturaGastos(idFactura);

 });



 function datosFacturaGastos(idFactura){


    var data = new FormData();

    data.append("IdFacGasto", idFactura);
  
        $.ajax({
    
            url:"ajax/sistema-facturas-reporte-gastos.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
            success: function(response){
    
            console.log(response);

$("#FrmRepotGastnomEmisor").val(response[0]["nombreComerEmisor"]);
$("#FrmRepotGastcedEmisor").val(response[0]["cedulaEmisor"]);
$("#FrmRepotGastclaveFacts").val(response[0]["clave"]);
$(".btnReportGastAceptacion").attr("IdFactura", idFactura);

document.querySelector('.subGasto').innerText = parseFloat(response[0]["totalComprobante"] - response[0]["totalIva"]).toLocaleString("en-US");
document.querySelector('.Gastodescuento').innerText = parseFloat(response[0]["totalDescuento"]).toLocaleString("en-US");
document.querySelector('.Gastoiva').innerText = parseFloat(response[0]["totalIva"]).toLocaleString("en-US");
document.querySelector('.Gastototal').innerText = parseFloat(response[0]["totalComprobante"]).toLocaleString("en-US");

if (response[0]["procesado"] == "Si"){

    $(".btnReportGastAceptacion").prop('disabled', "true");
    $(".btnReportGastAceptacion").attr("title", "La Factura ya a sido Porcesada");
    
}else{

    $(".btnReportGastAceptacion").removeAttr('disabled');
    $(".btnReportGastAceptacion").removeAttr('title');
}


            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })
    


 }



 
 function datosDetalleFacturaGastos(idFactura){


if ( $.fn.DataTable.isDataTable('#tblDetalleFacGasto') ) {
    $('#tblDetalleFacGasto').DataTable().destroy();
  }
  
    
  
      $("#tblDetalleFacGasto").DataTable({
        "ajax": 'ajax/datatable-sistema-facturas-reporte-gastos.ajax.php?DetalleFac='+idFactura,
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
  
  
 }

 


 $("#FrmRepotGastSucursal").change(function() {

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
  $("#FrmRepotGastCaja").empty();
  $("#FrmRepotGastCaja").append('<option disabled selected value="">Seleccionar Caja</option>');   
  for(var i = 0; i < response.length; i++){  
  
    $("#FrmRepotGastCaja").append('<option value="'+response[i]["idcaja"]+'" >'+response[i]["nombre"]+'</option>');
  
  }
                },
                  
              })
    
    });




 $(".btnReportGastAceptacion").click(function() {

    let estadoAceptacion = $("option:selected", "#FrmRepotGastEstadoDoc").val();
    let comentarios = $("#FrmRepotGastcoment").val();
    let sucursal = $("option:selected", "#FrmRepotGastSucursal").val();
    let caja = $("option:selected", "#FrmRepotGastCaja").val();
    let actividadE = $("option:selected", "#FrmRepotGastActividad").val();
    let idFactura = $(this).attr("idfactura");
    let clave = $("#FrmRepotGastclaveFacts").val();
    let datosF =  datosFactura(idFactura);

console.log(datosF);

if(estadoAceptacion == "" || comentarios == ""  || sucursal == "" || caja == "" || actividadE == "" || clave == ""){

    Swal.fire(
        "Aviso",
        "Validar que la información se encuentre completa antes de procesar la factura.",
        "warning"
      ).then((result) => {

      }) 

    return false;


}




var data = new FormData();

let DatosFactura = 	{
    "fileContent":{
                "datosReceptor":{
                    "usuario": ""+ datosF[0]["usuario"] +"",
                    "password": ""+ datosF[0]["contrasena"] +"",
                    "cedula":""+ datosF[0]["cedulaReceptor"] +"",
                    "id_empresa":""+ datosF[0]["idEmpresa"] +""						
                },		
                "datosEmisor":{						
                    "tipoCedula":""+ datosF[0]["tipocedEmisor"] +"",
                    "cedula":""+ datosF[0]["cedulaEmisor"] +""
                },			
                "datosFactura":{
                        "clave":""+ clave +"",
                        "fechaEmision":""+ datosF[0]["fechaEmision"] +"",
                        "horaEmision":""+ datosF[0]["horaEmision"] +"",
                        "comentario":""+ comentarios +"",
                        "sucursal":""+ sucursal +"",
                        "caja":""+ caja +"",
                        "tipoDoc":""+ estadoAceptacion +"",
                        "actividadEconomica":""+ actividadE +"",
                        "api":"Si",
                        "CondicionImpuesto":"",
                        "MontoTotalImpuestoAcreditar":"",
                        "MontoTotalDeGastoAplicable":"",
                        "MontoTotalImpuesto":""+ datosF[0]["montoIva"] +"",
                        "TotalFactura":""+ datosF[0]["totalFactura"] +"",
                }
        }		
}


console.log("Factura", JSON.stringify(DatosFactura));

DatosFactura = JSON.stringify(DatosFactura);

    data.append("DatosFactura", DatosFactura);


        $.ajax({
    
            url:"ajax/sistema-facturas-reporte-gastos.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
    
        console.log(response);
            try {
                var respt  =  JSON.parse(response);
                
                if(respt["success"] == "true"){

                    Swal.fire(
                      "Exelente",
                      "Reporte de Gasto realizado correctamente.",
                      "success"
                    ).then((result) => {
                  window.location = "sistema-facturas-reporte-gastos";
                    }) 
      
      
      
                  }else{
      
                    Swal.fire(
                      "Error",
                      "Error al realizar el reporte de gasto, intente nuevamente ("+respt["reason"]+")",
                      "error"
                    ).then((result) => {
                  window.location = "sistema-facturas-reporte-gastos";
                    }) 
    
                  }

            }
            catch (error) {
                if(error instanceof SyntaxError) {
                    let mensaje = error.message;
                  
                    Swal.fire(
                        "Error",
                        "Error al realizar el reporte de gasto, intente nuevamente ("+mensaje+")",
                        "error"
                      ).then((result) => {
                    window.location = "sistema-facturas-reporte-gastos";
                      }) 


                } else {

                    Swal.fire(
                        "Error",
                        "Error al realizar el reporte de gasto, intente nuevamente ("+error+")",
                        "error"
                      ).then((result) => {
                    window.location = "sistema-facturas-reporte-gastos";
                      }) 

                    throw error; // si es otro error, que lo siga lanzando
                }
            }


            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })




 });



 function datosFactura(idFactura){

let datosFac = [];
    var data = new FormData();

    data.append("DatosIdFactura", idFactura);
  
        $.ajax({
    
            url:"ajax/sistema-facturas-reporte-gastos.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            dataType: "json",  
            success: function(response){
    
            // console.log(response);

            datosFac.push({"contrasena": response[0]["contrasena_facturacion"],
                    "usuario":  response[0]["usuario_facturacion"],                         
                    "idEmpresa":  response[0]["idtbl_clientes"],
                    "cedulaReceptor":  response[0]["cedula"],
                    "tipocedEmisor":  response[0]["tipoCedEmisor"],
                    "cedulaEmisor":   response[0]["cedulaEmisor"],
                    "fechaEmision":  response[0]["fechaEmision"],
                    "horaEmision":   response[0]["horaEmision"],
                    "montoIva":   response[0]["totalIva"],
                    "totalFactura":  response[0]["totalComprobante"]
           });



            },
                
            error: function(response, err){ console.log('my message ' + err + " " + response );}
        
            })
    
return datosFac;

 }