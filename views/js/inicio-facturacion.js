const queryStringdashboardFact = window.location.search;

const urlparamdashboardFact = new URLSearchParams(queryStringdashboardFact);

const paramdashboardFact = urlparamdashboardFact.get("startDate");

if (paramdashboardFact == null) {
  localStorage.removeItem("captureRange-daterange-btn-dashboardFact");
  localStorage.clear();
  $("#daterange-btn-dashboardFact span").html(
    '<i class="fa fa-calendar"></i> Rango de Fecha'
  );
} else {
}

/**/
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if (localStorage.getItem("captureRange-daterange-btn-dashboardFact") != null) {
  $("#daterange-btn-dashboardFact span").html(
    localStorage.getItem("captureRange-daterange-btn-dashboardFact")
  );
} else {
  $("#daterange-btn-dashboardFact span").html(
    '<i class="fa fa-calendar"></i> Rango de fecha'
  );
}

/*=============================================
RANGO DE FECHAS
=============================================*/
$("#daterange-btn-dashboardFact").daterangepicker(
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
    $("#daterange-btn-dashboardFact span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var startDate = start.format("YYYY-MM-DD");

    var endDate = end.format("YYYY-MM-DD");

    var capturarRango = $("#daterange-btn-dashboardFact span").html();

    localStorage.setItem(
      "captureRange-daterange-btn-dashboardFact",
      capturarRango
    );

    window.location =
      "index.php?route=inicio-facturacion&startDate=" +
      startDate +
      "&endDate=" +
      endDate;
  }
);

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$("#daterange-btn-dashboardFact").on(
  "cancel.daterangepicker",
  function (ev, picker) {
    //do something, like clearing an input
    $("#daterange-btn-dashboardFact").val("");

    localStorage.removeItem("captureRange-daterange-btn-dashboardFact");
    localStorage.clear();

    window.location = "inicio-facturacion";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$("#daterange-btn-dashboardFact").on(
  "apply.daterangepicker",
  function (ev, picker) {
    var textoHoy = $("#daterange-btn-dashboardFact").data("daterangepicker");
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

      localStorage.setItem("captureRange-daterange-btn-dashboardFact", "Hoy");

      window.location =
        "index.php?route=inicio-facturacion&startDate=" +
        startDate +
        "&endDate=" +
        endDate;
    }
  }
);
