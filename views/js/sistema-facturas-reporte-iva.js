const queryStringReportIva = window.location.search;

const urlparamReportIva = new URLSearchParams(queryStringReportIva);

const paramReportIva = urlparamReportIva.get("startDate");

if (paramReportIva == null) {
  localStorage.removeItem("captureRange-daterange-btn-ReportIva");
  localStorage.clear();
  $("#daterange-btn-ReportGastos span").html(
    '<i class="fa fa-calendar"></i> Rango de Fecha'
  );
} else {
}

/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if (localStorage.getItem("captureRange-daterange-btn-ReportIva") != null) {
  $("#daterange-btn-ReportIva span").html(
    localStorage.getItem("captureRange-daterange-btn-ReportIva")
  );
} else {
  $("#daterange-btn-ReportIva span").html(
    '<i class="fa fa-calendar"></i> Rango de fecha'
  );
}

/*=============================================
RANGO DE FECHAS
=============================================*/
$("#daterange-btn-ReportIva").daterangepicker(
  {
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    startDate: moment(),
    endDate: moment(),
  },
  function (start, end) {
    $("#daterange-btn-ReportIva span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var startDate = start.format("YYYY-MM-DD");

    var endDate = end.format("YYYY-MM-DD");

    var capturarRango = $("#daterange-btn-ReportIva span").html();

    localStorage.setItem("captureRange-daterange-btn-ReportIva", capturarRango);

    window.location =
      "index.php?route=sistema-facturas-reporte-iva&startDate=" +
      startDate +
      "&endDate=" +
      endDate;
  }
);

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$("#daterange-btn-ReportIva").on(
  "cancel.daterangepicker",
  function (ev, picker) {
    //do something, like clearing an input
    $("#daterange-btn-ReportIva").val("");

    localStorage.removeItem("captureRange-daterange-btn-ReportIva");
    localStorage.clear();

    window.location = "sistema-facturas-reporte-iva";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$("#daterange-btn-ReportIva").on(
  "apply.daterangepicker",
  function (ev, picker) {
    var textoHoy = $("#daterange-btn-ReportIva").data("daterangepicker");
    /*  console.log("drp", drp["chosenLabel"]);
     */
    if (textoHoy["chosenLabel"] == "Hoy") {
      var d = new Date();

      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();

      if (mes < 10) {
        var startDate = año + "-0" + mes + "-" + dia;
        var endDate = año + "-0" + mes + "-" + dia;
      } else if (dia < 10) {
        var startDate = año + "-" + mes + "-0" + dia;
        var endDate = año + "-" + mes + "-0" + dia;
      } else if (mes < 10 && dia < 10) {
        var startDate = año + "-0" + mes + "-0" + dia;
        var endDate = año + "-0" + mes + "-0" + dia;
      } else {
        var startDate = año + "-" + mes + "-" + dia;
        var endDate = año + "-" + mes + "-" + dia;
      }

      localStorage.setItem("captureRange-daterange-btn-ReportIva", "Hoy");

      window.location =
        "index.php?route=sistema-facturas-reporte-iva&startDate=" +
        startDate +
        "&endDate=" +
        endDate;
    }
  }
);

$(document).ready(function () {
  let FechaInicio = urlparamReportGastos.get("startDate");
  let FechaFin = urlparamReportGastos.get("endDate");
  let fecha = new Date();

  if (FechaInicio == "" || FechaInicio == null) {
    FechaInicio = now = moment(fecha).format("YYYY/MM/DD");
    FechaFin = now = moment(fecha).format("YYYY/MM/DD");
    // console.log(fecha);
  } else {
    FechaInicio = urlparamReportGastos.get("startDate");
    FechaFin = urlparamReportGastos.get("endDate");
  }

  CargarDatosIva(FechaInicio, FechaFin);
  CargarDatosCompras(FechaInicio, FechaFin);
  CargarDatosResumenIva(FechaInicio, FechaFin);
  CargarDatosResumenGastos(FechaInicio, FechaFin);
});



$(".btnExport").click(function() {


let valorIvaFvor = 0;

  Swal.fire({
    title: "Ingrese un monto",
    text: "Impuesto a favor de periodos anteriores",
    input: 'number',
    showCancelButton: true        
}).then((result) => {
    if (result.value) {
        // console.log("Result: " + result.value);
        valorIvaFvor = result.value;
        let FechaInicio = urlparamReportGastos.get("startDate");
        let FechaFin = urlparamReportGastos.get("endDate");
        let fecha = new Date();
      
        if (FechaInicio == "" || FechaInicio == null) {
          FechaInicio = now = moment(fecha).format("YYYY/MM/DD");
          FechaFin = now = moment(fecha).format("YYYY/MM/DD");
          // console.log(fecha);
        } else {
          FechaInicio = urlparamReportGastos.get("startDate");
          FechaFin = urlparamReportGastos.get("endDate");
        }
    
        tablesToExcel(FechaInicio, FechaFin, valorIvaFvor) ;
    }else{

      Swal.fire(
        "Error",
        "!Ingrese un monto para continuar¡",
        "error"
      ).then((result) => {
       
    // window.location = "reporte-sistema-facturacion";
      }) 
    }
});

// return false;

    

});

$(".btnRekognition").click(function() {

  window.open("extensions/AWS/vendor/reconocimientoFacial2.php?");


});


function CargarDatosIva(fechaDesde, fechaHasta) {
  var datos = [];

  datos.push({ FechaInicio: fechaDesde, FechaFin: fechaHasta });

  datos = JSON.stringify(datos);

  //     $.ajax({

  //         url:'ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas1='+datos,
  //         async: false,
  //         success: function(response){

  //       console.log("respuesta",response);

  //            },

  // });

  if ($.fn.DataTable.isDataTable("#tablaReportIva")) {
    $("#tablaReportIva").DataTable().destroy();
  }
  var table = $("#tablaReportIva").DataTable({
    dom: "Bfrtip",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "Todos"],
    ],
    buttons: ["pageLength", "colvis", "copy", "excel", "pdf"],

    ajax:
      "ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas1=" + datos,
    async: "false",

    deferRender: true,
    retrieve: true,
    processing: true,

    columns: [
      //   null,
    //   null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      //   null,
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },

      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      null,
    ],

    language: {
      buttons: {
        colvis: "Columnas Visibles",
        copy: "Copiar",
        pageLength: "Mostrar",
      },

      sProcessing:
        "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords:
        "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(),
        data;

      // Remove the formatting to get integer data for summation
      var intVal = function (i) {
        return typeof i === "string"
          ? i.replace(/[\$,]/g, "") * 1
          : typeof i === "number"
          ? i
          : 0;
      };

      // Total over all pages
      total = api
        .column(7, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(7).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(8, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(8).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(9, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(9).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(10, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(10).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      //  Number(total)  total.number(',', '.', 2, '₡')
      // '₡'+ Number(total).toLocaleString("en-US") +''
      /*'₡'+ Number(total).toLocaleString("en-US") +''*/
    },
  });
}

function CargarDatosCompras(fechaDesde, fechaHasta) {
  var datos = [];

  datos.push({ FechaInicio: fechaDesde, FechaFin: fechaHasta });

  datos = JSON.stringify(datos);

//       $.ajax({

//           url:'ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas2='+datos,
//           async: false,
//           success: function(response){

//         console.log("respuesta",response);

//              },

//   });

  if ($.fn.DataTable.isDataTable("#tablaReportCompras")) {
    $("#tablaReportCompras").DataTable().destroy();
  }
  var table = $("#tablaReportCompras").DataTable({
    dom: "Bfrtip",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "Todos"],
    ],
    buttons: ["pageLength", "colvis", "copy", "excel", "pdf"],

    ajax:
      "ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas2=" + datos,
    async: "false",

    deferRender: true,
    retrieve: true,
    processing: true,

    columns: [
      null,
      null,
      null,
      null,
      null,
      null,
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },

      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
      {
        render: function (data, type, row, meta) {
          if (type === "display") {
            var symbol = "";

            symbol = "";

            // console.log(data);
            var num = $.fn.dataTable.render
              .number(",", ".", 2, symbol)
              .display(data);
            return num;
          } else {
            return data;
          }
        },
      },
    ],

    language: {
      buttons: {
        colvis: "Columnas Visibles",
        copy: "Copiar",
        pageLength: "Mostrar",
      },

      sProcessing:
        "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords:
        "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    footerCallback: function (row, data, start, end, display) {
      var api = this.api(),
        data;

      // Remove the formatting to get integer data for summation
      var intVal = function (i) {
        return typeof i === "string"
          ? i.replace(/[\$,]/g, "") * 1
          : typeof i === "number"
          ? i
          : 0;
      };

      // Total over all pages
      total = api
        .column(7, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(7).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(8, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(8).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(9, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(9).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );

      // Total over all pages
      total = api
        .column(10, { search: "applied" })
        .data()
        .reduce(function (a, b) {
          return intVal(a) + intVal(b);
        }, 0);

      // Update footer
      $(api.column(10).footer()).html(
        Number(total).toLocaleString("en-US") + ""
      );
      //  Number(total)  total.number(',', '.', 2, '₡')
      // '₡'+ Number(total).toLocaleString("en-US") +''
      /*'₡'+ Number(total).toLocaleString("en-US") +''*/
    },
  });
}



function CargarDatosResumenIva(fechaDesde, fechaHasta) {
    var datos = [];
  
    datos.push({ FechaInicio: fechaDesde, FechaFin: fechaHasta });
  
    datos = JSON.stringify(datos);
  
    //     $.ajax({
  
    //         url:'ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas3='+datos,
    //         async: false,
    //         success: function(response){
  
    //       console.log("respuesta",response);
  
    //            },
  
    // });
  
    if ($.fn.DataTable.isDataTable("#tablaReportRiva")) {
      $("#tablaReportRiva").DataTable().destroy();
    }
    var table = $("#tablaReportRiva").DataTable({
      dom: "Bfrtip",
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"],
      ],
      buttons: ["pageLength", "colvis", "copy", "excel", "pdf"],
  
      ajax:
        "ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas3=" + datos,
      async: "false",
  
      deferRender: true,
      retrieve: true,
      processing: true,
  
      columns: [
        null,
        null,
        {
          render: function (data, type, row, meta) {
            if (type === "display") {
              var symbol = "";
  
              symbol = "";
  
              // console.log(data);
              var num = $.fn.dataTable.render
                .number(",", ".", 2, symbol)
                .display(data);
              return num;
            } else {
              return data;
            }
          },
        },
        {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
      ],
  
      language: {
        buttons: {
          colvis: "Columnas Visibles",
          copy: "Copiar",
          pageLength: "Mostrar",
        },
  
        sProcessing:
          "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords:
          "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
      footerCallback: function (row, data, start, end, display) {
        var api = this.api(),
          data;
  
        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
          return typeof i === "string"
            ? i.replace(/[\$,]/g, "") * 1
            : typeof i === "number"
            ? i
            : 0;
        };
  
        // Total over all pages
        total = api
          .column(2, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(2).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(3, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(3).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(4, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(4).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(5, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(5).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

        // Total over all pages
        total = api
        .column(6, { search: "applied" })
        .data()
        .reduce(function (a, b) {
        return intVal(a) + intVal(b);
        }, 0);

        // Update footer
        $(api.column(6).footer()).html(
        Number(total).toLocaleString("en-US") + ""
        );

 // Total over all pages
        total = api
          .column(7, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(7).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(8, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(8).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        // Total over all pages
        total = api
          .column(9, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(9).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(10, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(10).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        // Total over all pages
        total = api
          .column(11, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(11).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
        total = api
          .column(12, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(12).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(13, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(13).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        //  Number(total)  total.number(',', '.', 2, '₡')
        // '₡'+ Number(total).toLocaleString("en-US") +''
        /*'₡'+ Number(total).toLocaleString("en-US") +''*/
      },
    });
  }


  function CargarDatosResumenGastos(fechaDesde, fechaHasta){
    var datos = [];
  
    datos.push({ FechaInicio: fechaDesde, FechaFin: fechaHasta });
  
    datos = JSON.stringify(datos);
  
    //     $.ajax({
  
    //         url:'ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas4='+datos,
    //         async: false,
    //         success: function(response){
  
    //       console.log("respuesta",response);
  
    //            },
  
    // });
  
    if ($.fn.DataTable.isDataTable("#tablaReportRgastos")) {
      $("#tablaReportRgastos").DataTable().destroy();
    }
    var table = $("#tablaReportRgastos").DataTable({
      dom: "Bfrtip",
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"],
      ],
      buttons: ["pageLength", "colvis", "copy", "excel", "pdf"],
  
      ajax:
        "ajax/datatable-sistema-facturas-reporte-iva.ajax.php?fechas4=" + datos,
      async: "false",
  
      deferRender: true,
      retrieve: true,
      processing: true,
  
      columns: [
        null,
        null,
        {
          render: function (data, type, row, meta) {
            if (type === "display") {
              var symbol = "";
  
              symbol = "";
  
              // console.log(data);
              var num = $.fn.dataTable.render
                .number(",", ".", 2, symbol)
                .display(data);
              return num;
            } else {
              return data;
            }
          },
        },
        {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
          {
            render: function (data, type, row, meta) {
              if (type === "display") {
                var symbol = "";
    
                symbol = "";
    
                // console.log(data);
                var num = $.fn.dataTable.render
                  .number(",", ".", 2, symbol)
                  .display(data);
                return num;
              } else {
                return data;
              }
            },
          },
      ],
  
      language: {
        buttons: {
          colvis: "Columnas Visibles",
          copy: "Copiar",
          pageLength: "Mostrar",
        },
  
        sProcessing:
          "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords:
          "<div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div>",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
      footerCallback: function (row, data, start, end, display) {
        var api = this.api(),
          data;
  
        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
          return typeof i === "string"
            ? i.replace(/[\$,]/g, "") * 1
            : typeof i === "number"
            ? i
            : 0;
        };
  
        // Total over all pages
        total = api
          .column(2, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(2).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(3, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(3).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(4, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(4).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );
  
        // Total over all pages
        total = api
          .column(5, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(5).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

        // Total over all pages
        total = api
        .column(6, { search: "applied" })
        .data()
        .reduce(function (a, b) {
        return intVal(a) + intVal(b);
        }, 0);

        // Update footer
        $(api.column(6).footer()).html(
        Number(total).toLocaleString("en-US") + ""
        );

 // Total over all pages
        total = api
          .column(7, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(7).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(8, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(8).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        // Total over all pages
        total = api
          .column(9, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(9).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(10, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(10).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        // Total over all pages
        total = api
          .column(11, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(11).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
        total = api
          .column(12, { search: "applied" })
          .data()
          .reduce(function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);
  
        // Update footer
        $(api.column(12).footer()).html(
          Number(total).toLocaleString("en-US") + ""
        );

         // Total over all pages
         total = api
         .column(13, { search: "applied" })
         .data()
         .reduce(function (a, b) {
           return intVal(a) + intVal(b);
         }, 0);
 
       // Update footer
       $(api.column(13).footer()).html(
         Number(total).toLocaleString("en-US") + ""
       );

        //  Number(total)  total.number(',', '.', 2, '₡')
        // '₡'+ Number(total).toLocaleString("en-US") +''
        /*'₡'+ Number(total).toLocaleString("en-US") +''*/
      },
    });
  }


function tablesToExcel(fechaDesde, fechaHasta, valorIvaFvor) {
   
    window.open("extensions/Excel/vendor/reporteIva.php?fechaDesde="+ fechaDesde +"&fechaHasta="+fechaHasta+"&ivaFavor="+valorIvaFvor);
    // window.open("extensions/Excel/vendor/reporteIva.php?consecutivo="+consecutivo+"&key="+clave+"&nombre_cliente=Cliente Contado");

}




