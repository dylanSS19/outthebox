var añoActual = new Date()
var añoActual = añoActual.getFullYear()
/* $.ajax({

         
          url:'ajax/reporte-ventas-calle.ajax.php?varaño='+añoActual,
          async: false,
          success: function(response){

       
       console.log("respuesta",response);
              
             },

      });*/


$('.tablasventasreporteventasanuales').DataTable().clear().destroy();

var table = $('.tablasventasreporteventasanuales').DataTable({
    dom: 'Bfrtip',
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "Todos"]
    ],
    "iDisplayLength": -1,
    buttons: [
        'pageLength', 'colvis',
        'copy', 'excel', 'pdf'
    ],

    "ajax": 'ajax/reporte-ventas-calle.ajax.php?varaño=' + añoActual,
    "async": "false",
    "paging": "false",
    "order": [],
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        buttons: {
            colvis: 'Columnas Visibles',
            copy: 'Copiar',
            pageLength: 'Mostrar'
        },

        "sProcessing": "Procesando...",
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
        "sLoadingRecords": "Cargando...",
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
    'columnDefs': [{
            targets: 1,
            className: 'bg-gray  color-palette'
        },
        {
            targets: 3,
            className: 'bg-gray  color-palette'
        },
        {
            targets: 5,
            className: 'bg-gray  color-palette'
        },


    ],
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api(),
            data;

        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '') * 1 :
                typeof i === 'number' ?
                i : 0;
        };




        // Total over all pages
        total = api
            .column(4, {
                search: 'applied'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(4).footer()).html(
            '' + total + ''
        );



        // Total over all pages
        total = api
            .column(5, {
                search: 'applied'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(5).footer()).html(
            '' + total + ''
        );





        // Total over all pages
        total = api
            .column(3, {
                search: 'applied'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(3).footer()).html(
            '' + total + ''
        );


        // Total over all pages
        total = api
            .column(2, {
                search: 'applied'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(2).footer()).html(
            '' + total + ''
        );


        // Total over all pages
        total = api
            .column(1, {
                search: 'applied'
            })
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(1).footer()).html(
            '' + total + ''
        );






    },
});

table.page(0).draw('page')

table.ajax.reload();






$('.rangoanualcalle').datepicker({
    format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years"
}, {
    endDate: new Date(),
    autoclose: true,
}).on('changeDate', function (e) {

    var añoActual = e.format(0, "yyyy");

    $('#rangoanualcalle span').html(añoActual);



    /*
    $.ajax({

             
              url:'ajax/reporte-ventas-calle.ajax.php?varaño='+añoActual,
              async: false,
              success: function(response){

           
           console.log("respuesta",response);
                  
                 },

          });*/

    $('.tablasventasreporteventasanuales').DataTable().clear().destroy();

    var table = $('.tablasventasreporteventasanuales').DataTable({
        dom: 'Bfrtip',
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        "iDisplayLength": -1,
        buttons: [
            'pageLength', 'colvis',
            'copy', 'excel', 'pdf'
        ],

        "ajax": 'ajax/reporte-ventas-calle.ajax.php?varaño=' + añoActual,
        "async": "false",
        "paging": "false",
        "order": [],
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {
            buttons: {
                colvis: 'Columnas Visibles',
                copy: 'Copiar',
                pageLength: 'Mostrar'
            },

            "sProcessing": "Procesando...",
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
            "sLoadingRecords": "Cargando...",
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
        'columnDefs': [{
                targets: 1,
                className: 'bg-gray  color-palette'
            },
            {
                targets: 3,
                className: 'bg-gray  color-palette'
            },
            {
                targets: 5,
                className: 'bg-gray  color-palette'
            },


        ],
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };




            // Total over all pages
            total = api
                .column(4, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(
                '' + total + ''
            );



            // Total over all pages
            total = api
                .column(5, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                '' + total + ''
            );





            // Total over all pages
            total = api
                .column(3, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(3).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(2, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(2).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(1, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(1).footer()).html(
                '' + total + ''
            );






        },
    });

    table.page(0).draw('page')

    table.ajax.reload();



});




$('#rango1').daterangepicker({

        startDate: moment(),
        endDate: moment()

    },
    function (start, end) {
        $('#rango1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');

        $("#dtdesde1").val(startDate);
        $("#dthasta1").val(endDate);




    }


)

$('#rango2').daterangepicker({

        startDate: moment(),
        endDate: moment()

    },
    function (start, end) {

        $('#rango2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));


        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');

        $("#dtdesde2").val(startDate);
        $("#dthasta2").val(endDate);




    }

)


/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if (localStorage.getItem("captureRange-reporte-ventas-dth") != null) {

    $("#daterange-btn-reporte-ventas-dth span").html(localStorage.getItem("captureRange-reporte-ventas-dth"));


} else {

    $("#daterange-btn-reporte-ventas-dth span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}



/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn-reporte-ventas-dth').daterangepicker({
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()

    },
    function (start, end) {
        $('#daterange-btn-reporte-ventas-dth span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var startDate = start.format('YYYY-MM-DD');

        var endDate = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn-reporte-ventas-dth span").html();

        localStorage.setItem("captureRange-reporte-ventas-dth", capturarRango);



        let params = new URLSearchParams(location.search);
        var vendedor = params.get('vendedor');
        var coordinador = params.get('coordinador');
        var nombre = params.get('nombre');

        window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "&coordinador=" + coordinador + "&vendedor=" + vendedor + "&nombre=" + nombre + "";


    }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$('#daterange-btn-reporte-ventas-dth').on('cancel.daterangepicker', function (ev, picker) {
    //do something, like clearing an input

    $('#daterange-btn-reporte-ventas-dth').val('');

    localStorage.removeItem("captureRange-reporte-ventas-dth");

    localStorage.clear();

    window.location = "reporte-ventas-dth";

});


/*=============================================
CAPTURAR HOY
=============================================*/

$('#daterange-btn-reporte-ventas-dth').on('apply.daterangepicker', function (ev, picker) {



    var textoHoy = $('#daterange-btn-reporte-ventas-dth').data('daterangepicker');
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

        localStorage.removeItem("captureRange-reporte-ventas-dth");



        let params = new URLSearchParams(location.search);
        var vendedor = params.get('vendedor');
        var coordinador = params.get('coordinador');
        var nombre = params.get('nombre');

        window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "&coordinador=" + coordinador + "&vendedor=" + vendedor + "&nombre=" + nombre + "";


    }
});




$(".Ventas_DTH").change(function () {



    let params = new URLSearchParams(location.search);
    var startDate = params.get('startDate');
    var endDate = params.get('endDate');

    var nombre = $(".Ventas_DTH option:selected").text();
    var vendedor = $(this).val();



    window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "&vendedor=" + vendedor + "&nombre=" + nombre + "";


})


$(".Coordinador_DTH").change(function () {


    let params = new URLSearchParams(location.search);
    var startDate = params.get('startDate');
    var endDate = params.get('endDate');

    var coordinador = $(this).val();


    window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "&coordinador=" + coordinador + "";


})

/*=============================================
  =                   EDIT CATEGORY                 =
   =============================================*/

$(document).on("click", ".btnVentasCalleDetail", function () {


    $("#tbodyid_tableVentasCalleDetails").empty();
    $("#tfootid_tableVentasCalleDetails").empty();

    var idzona = $(this).attr("zona");

    var data = new FormData();

    data.append("varidzona", idzona);

    $.ajax({


        url: "ajax/reporte-ventas-calle.ajax.php",
        method: "POST",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            /*          console.log("response", response);
             */



            var total_dth = 0
            var total_internet = 0
            var total_pospago = 0
            var total_gpon = 0
            var total_total = 0

            $(response).each(function (index, item) {


                $('#tableVentasCalleDetails tbody').append(
                    '<tr><td>' + item.nombre +
                    '</td><td>' + item.representante +
                    '</td><td>' + item.sub_tipo +
                    '</td><td>' + item.zona +
                    '</td><td>' + item.dth +
                    '</td><td>' + item.internet +
                    '</td><td>' + item.pospago +
                    '</td><td>' + item.gpon +
                    '</td><td>' + item.total +
                    '</td></tr>'
                )

                total_dth = Number(total_dth) + Number(item.dth);
                total_internet = Number(total_internet) + Number(item.internet);
                total_pospago = Number(total_pospago) + Number(item.pospago);
                total_gpon = Number(total_gpon) + Number(item.gpon);
                total_total = Number(total_total) + Number(item.total);

            });


            $('#tableVentasCalleDetails tfoot').append(
                '<tr><td style="font-weight: bold;">' + "" +
                '</td><td style="font-weight: bold;">' + "" +
                '</td><td style="font-weight: bold;">' + "" +
                '</td><td style="font-weight: bold;">' + "TOTAL" +
                '</td><td style="font-weight: bold;">' + total_dth +
                '</td><td style="font-weight: bold;">' + total_internet +
                '</td><td style="font-weight: bold;">' + total_pospago +
                '</td><td style="font-weight: bold;">' + total_gpon +
                '</td><td style="font-weight: bold;">' + total_total +
                '</td></tr>'
            )

        },
        error: function (response, err) {
            console.log('my message ' + err + " " + response + " " + idzona);
        }



    });



})








$(document).ready(function () {


    $('#TablaConvenios').DataTable({
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages


            // Total over all pages
            total = api
                .column(4, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(
                '₡' + Number(total).toLocaleString("en-US") + ''
            );
        },

        "language": {

            "sProcessing": "Procesando...",
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
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
                "decimal": ",",
                "thousands": "."
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "order": [],

        }

    });



    $('#tablasventasXcoordinadorreporteventascalle').DataTable({
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(6, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(6).footer()).html(
                '' + total + ''
            );

            // Total over all pages
            total = api
                .column(5, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                '' + total + ''
            );

            // Total over all pages
            total = api
                .column(9, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(9).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(8, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(8).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(7, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(7).footer()).html(
                '' + total + ''
            );
        },

        "language": {

            "sProcessing": "Procesando...",
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
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
                "decimal": ",",
                "thousands": "."
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "order": [],

        }

    });

    ////////////////////



    $('#tablasventasXsupervisorreporteventascalle').DataTable({
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(2, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(2).footer()).html(
                '' + total + ''
            );

            // Total over all pages
            total = api
                .column(3, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(3).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(4, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(4).footer()).html(
                '' + total + ''
            );


            // Total over all pages
            total = api
                .column(5, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                '' + total + ''
            );

            // Total over all pages
            total = api
                .column(6, {
                    search: 'applied'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(6).footer()).html(
                '' + total + ''
            );


        },

        "language": {

            "sProcessing": "Procesando...",
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
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
                "decimal": ",",
                "thousands": "."
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }

    });



});








$("#btnbuscartablacomparativacalle").click(function () {



    var desde1 = $("#dtdesde1").val();
    var hasta1 = $("#dthasta1").val();


    var desde2 = $("#dtdesde2").val();
    var hasta2 = $("#dthasta2").val();

    if (desde1 == "" || desde2 == "") {
        swal({

            type: "error",
            title: "¡Favor seleccionar ambos campos de fechas!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        })
        return;
    } else {


        /*$.ajax({

                 
                  url:'ajax/datatable-compara-tablas-calle.ajax.php?desde1='+desde1+'&hasta1='+hasta1+'&desde2='+desde2+'&hasta2='+hasta2,
                  async: false,
                  success: function(response){

               
               console.log("respuesta",response);
                      
                     },

              });
        */
        $('.TablaComparativaCalle').DataTable().clear().destroy();

        var table = $('.TablaComparativaCalle').DataTable({
            dom: 'Bfrtip',
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            buttons: [
                'pageLength', 'colvis',
                'copy', 'excel', 'pdf'
            ],

            "ajax": 'ajax/datatable-compara-tablas-calle.ajax.php?desde1=' + desde1 + '&hasta1=' + hasta1 + '&desde2=' + desde2 + '&hasta2=' + hasta2,
            "async": "false",

            "deferRender": true,
            "retrieve": true,
            "processing": true,
            "language": {
                buttons: {
                    colvis: 'Columnas Visibles',
                    copy: 'Copiar',
                    pageLength: 'Mostrar'
                },

                "sProcessing": "Procesando...",
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
                "sLoadingRecords": "Cargando...",
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
            /* rowCallback: function( row, data, dataIndex ) {
 
      $(row).find('td:eq(4)').css('background-color','#B2B0B0');  

      $(row).find('td:eq(5)').css('background-color','#B2B0B0');  

      $(row).find('td:eq(8)').css('background-color','#B2B0B0');  

      $(row).find('td:eq(9)').css('background-color','#B2B0B0');  

       $(row).find('td:eq(12)').css('background-color','#B2B0B0');  

      $(row).find('td:eq(13)').css('background-color','#B2B0B0');  
    
  },*/
            'columnDefs': [{
                    targets: 4,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 5,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 6,
                    visible: false,
                    className: 'bg-gray  color-palette'
                },

                {
                    targets: 9,
                    visible: false
                },

                {
                    targets: 10,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 11,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 12,
                    visible: false,
                    className: 'bg-gray  color-palette'
                },

                {
                    targets: 15,
                    visible: false
                },

                {
                    targets: 16,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 17,
                    className: 'bg-gray  color-palette'
                },
                {
                    targets: 18,
                    visible: false
                }

            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };




                // Total over all pages
                total = api
                    .column(4, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    '' + total + ''
                );



                // Total over all pages
                total = api
                    .column(5, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(5).footer()).html(
                    '' + total + ''
                );




                // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
                total = api
                    .column(4, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total2 = api
                    .column(5, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                if (((total2 - total) / total) * 100 > 0) {

                    // Update footer
                    $(api.column(6).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else if (((total2 - total) / total) * 100 < 0) {

                    // Update footer
                    $(api.column(6).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else {

                    // Update footer
                    $(api.column(6).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                }







                // Total over all pages
                total = api
                    .column(7, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(7).footer()).html(
                    '' + total + ''
                );


                // Total over all pages
                total = api
                    .column(8, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(8).footer()).html(
                    '' + total + ''
                );





                // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
                total = api
                    .column(7, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total2 = api
                    .column(8, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                if (((total2 - total) / total) * 100 > 0) {

                    // Update footer
                    $(api.column(9).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else if (((total2 - total) / total) * 100 < 0) {

                    // Update footer
                    $(api.column(9).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else {

                    // Update footer
                    $(api.column(9).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                }






                // Total over all pages
                total = api
                    .column(10, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(10).footer()).html(
                    '' + total + ''
                );

                // Total over all pages
                total = api
                    .column(11, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(11).footer()).html(
                    '' + total + ''
                );


                // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
                total = api
                    .column(10, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total2 = api
                    .column(11, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                if (((total2 - total) / total) * 100 > 0) {

                    // Update footer
                    $(api.column(12).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else if (((total2 - total) / total) * 100 < 0) {

                    // Update footer
                    $(api.column(12).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else {

                    // Update footer
                    $(api.column(12).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                }





                // Total over all pages
                total = api
                    .column(13, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(13).footer()).html(
                    '' + total + ''
                );

                // Total over all pages
                total = api
                    .column(14, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(14).footer()).html(
                    '' + total + ''
                );



                // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
                total = api
                    .column(13, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total2 = api
                    .column(14, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                if (((total2 - total) / total) * 100 > 0) {

                    // Update footer
                    $(api.column(15).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else if (((total2 - total) / total) * 100 < 0) {

                    // Update footer
                    $(api.column(15).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else {

                    // Update footer
                    $(api.column(15).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                }

                // Total over all pages
                total = api
                    .column(16, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(16).footer()).html(
                    '' + total + ''
                );

                // Total over all pages
                total = api
                    .column(17, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(17).footer()).html(
                    '' + total + ''
                );





                // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
                total = api
                    .column(16, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                total2 = api
                    .column(17, {
                        search: 'applied'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                if (((total2 - total) / total) * 100 > 0) {

                    // Update footer
                    $(api.column(18).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else if (((total2 - total) / total) * 100 < 0) {

                    // Update footer
                    $(api.column(18).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                } else {

                    // Update footer
                    $(api.column(18).footer()).html(

                        '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> ' + (((total2 - total) / total) * 100).toFixed(2) + '%</span><h5 class="description-header">' + (total2 - total) + '</h5></div>'

                    );


                }






            },
        });

        table.page(0).draw('page')

        table.ajax.reload();

    }

});








$("#btnbuscartablacomparativacalle").click(function () {



    var desde1 = $("#dtdesde1").val();


    if (desde1 == "" || desde2 == "") {
        swal({

            type: "error",
            title: "¡Favor seleccionar ambos campos de fechas!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        })
        return;
    } else {


        $.ajax({


            url: 'ajax/datatable-compara-tablas-calle.ajax.php?desde1=' + desde1 + '&hasta1=' + hasta1 + '&desde2=' + desde2 + '&hasta2=' + hasta2,
            async: false,
            success: function (response) {


                console.log("respuesta", response);

            },

        });

        /*    $('.tablasventasreporteventasanuales').DataTable().clear().destroy();

var table =  $('.tablasventasreporteventasanuales').DataTable( {
       dom: 'Bfrtip',
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        buttons: [
            'pageLength','colvis',
             'copy', 'excel', 'pdf'
        ],

  "ajax": 'ajax/datatable-compara-tablas-calle.ajax.php?desde1='+desde1+'&hasta1='+hasta1+'&desde2='+desde2+'&hasta2='+hasta2,
  "async": "false",

        "deferRender": true,
  "retrieve": true,
  "processing": true,
   "language": {
       buttons: {
                colvis: 'Columnas Visibles',
                 copy: 'Copiar',
                 pageLength:'Mostrar'
            },

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

  },
         'columnDefs': [
       { targets: 4, className: 'bg-gray  color-palette'},
       { targets: 5, className: 'bg-gray  color-palette'},
       { targets: 6, visible: false, className: 'bg-gray  color-palette'},

       { targets: 9, visible: false },

        { targets: 10, className: 'bg-gray  color-palette'},
       { targets: 11, className: 'bg-gray  color-palette'},
       { targets: 12, visible: false, className: 'bg-gray  color-palette' },

       { targets: 15, visible: false },

        { targets: 16, className: 'bg-gray  color-palette'},
       { targets: 17, className: 'bg-gray  color-palette'},
       { targets: 18, visible: false }
  
    ],
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
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+ total +''
            );



     // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ total +''
            );




                    // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 4, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 6 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 6 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 6 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }
 
    




         
                    // Total over all pages
            total = api
                .column( 7, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 7 ).footer() ).html(
 ''+ total +''  
       );


                       // Total over all pages
            total = api
                .column( 8, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                ''+ total +''
            );





           // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 7, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 8, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 9 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 9 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 9 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }


   
             


                    // Total over all pages
            total = api
                .column( 10, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 10 ).footer() ).html(
  ''+ total +'' 
       );

              // Total over all pages
            total = api
                .column( 11, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 11 ).footer() ).html(
                  ''+ total +''
            );


         // Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 10, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 11, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 12 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 12 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 12 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }





                    // Total over all pages
            total = api
                .column( 13, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 13 ).footer() ).html(
  ''+ total +''      
       );

                    // Total over all pages
            total = api
                .column( 14, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 14 ).footer() ).html(
  ''+ total +''      
       );



// Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 13, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 14, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 15 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 15 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 15 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }

                           // Total over all pages
            total = api
                .column( 16, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 16 ).footer() ).html(
  ''+ total +''      
       );

                    // Total over all pages
            total = api
                .column( 17, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 17 ).footer() ).html(
  ''+ total +''      
       );


     


// Total over all pages ''+ ((total2 - total)/total)*100 +'' &&
            total = api
                .column( 16, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                   total2 = api
                .column( 17, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                if(((total2 - total)/total)*100>0) {

            // Update footer
            $( api.column( 18 ).footer() ).html(

                 '<div class="description-block border-right"><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               } else if (((total2 - total)/total)*100<0){

            // Update footer
            $( api.column( 18 ).footer() ).html(

            '<div class="description-block border-right"><span class="description-percentage text-red"><i class="fa fa-caret-down"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
           
            );


               }else{
         
                     // Update footer
            $( api.column( 18 ).footer() ).html(

                          '<div class="description-block border-right"><span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> '+ (((total2 - total)/total)*100).toFixed(2) +'%</span><h5 class="description-header">'+ (total2 - total) +'</h5></div>'
              
            );


               }


      


        
        } ,
  });

table.page(0).draw('page')

table.ajax.reload();
*/
    }

});



/*$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
    } );
} );*/


/*$(document).ready(function(){
 var table = $('#WayFinderStatusTable').DataTable( {      
   ordering: false,
   paging: false,
   searching: false,
   bInfo : false,
   responsive: true,
   fixedHeader: true,
   scrollX: false,
   pageResize: true,
   ajax: {
      url: 'check_wayfinder_status.php', 
      dataSrc: ''
   },
    columns: [
      { data: 'DisplayDescription' },
      { data: 'DeviceName' },
      { data: 'MessageCount' },
    ],

   // rowCallback: function( row, data, dataIndex ) {
      //if ( data[2] != 0" ) {        
        //$(row).addClass('red');
     // } else {
        //$(row).addClass('green');
      //}
    //},

  rowCallback: function( row, data, dataIndex ) {
    if ( data[2] === "normal" ) {        
      $(row).find('td:eq(0)').css('background-color','green');
    } else {
      $(row).find('td:eq(0)').css('background-color','red');  
    }
  },
    columnDefs: [
    { className: "WayFinderOverrideStatusTable", "targets": [ 0 ] },
    { "visible": false, "targets": 1 },
    { "visible": false, "targets": 2 },
    ],

   fnRowCallback: function( nRow, aData, iDisplayIndex ) {
     $('td', nRow).attr('nowrap','nowrap');
     return nRow;
   }
  });
  setInterval( function () {
    table.ajax.reload();
  }, 30000 );
});
*/



/*$(function () {
    $(".tablasbtn").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
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

    }).buttons().container().appendTo('#tablasbtn_wrapper .col-md-6:eq(0)');
  });
*/



/*******************************************
 * 
 *          INICIO CIERRE DE RUTAS         *
 * 
 * ****************************************/


$("#tbl-apertura-rutas").DataTable({
    "language": {

        "sProcessing": "Procesando...",
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
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior",
            "decimal": ",",
            "thousands": "."
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
});

$(document).ready(function () {

    $("#frm-inicio-ruta").on("submit", function () {
        $('#overlay2').fadeIn();
    });


    $("#frm-cierre-ruta").on("submit", function () {
        $('#overlay2').fadeIn();
    });

});

const queryString1 = window.location.search;

const urlParams1 = new URLSearchParams(queryString1);


const startDateinicioruta = urlParams1.get('startDate')
//console.log("startDateinicioruta", startDateinicioruta);

if (startDateinicioruta == null) {

    $(".date").datepicker().datepicker("setDate", new Date());

} else {
    var parsedDate = $.datepicker.parseDate('yy-mm-dd', startDateinicioruta);

    $('.date').datepicker('setDate', parsedDate);
};












$(".date").datepicker({
    onSelect: function (dateText) {
        $(this).change();
    }
}).on("change", function (dateText) {

    var startDate = moment(this.value).format("YYYY-MM-DD");

    var endDate = moment(this.value).format("YYYY-MM-DD");


    window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "";

    /*console.log("Selected date: " + startDate + ", Current Selected Value= " + startDate);*/
});






getLocationMasivo_noCompra();


function getLocationMasivo_noCompra() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}



function showPosition(position) {
    /* console.log("Latitude: " + position.coords.latitude + 
      " Longitude: " + position.coords.longitude);*/

    if (position.coords.latitude == "") {
        console.log("NO GPS");
    }

    $(".latitud_cierre").val(position.coords.latitude);

    $(".longitud_cierre").val(position.coords.longitude);


}


/*=============================================
=            Previsualizar fotos            =
=============================================*/

var listafotos = [];

$(".foto_kilometraje").change(function () {

    var image = this.files[0];
    // console.log("image", image);

    /*=============================================
    =FILTER FORMAT PICTURE ONLY PNG - JPG        =
    =============================================*/

    if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

        $(".foto_kilometraje").val("");

        swal({

            type: "error",
            text: "La imagen debe estar en formato JPG o PNG",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });

    } else if (image["size"] > 4000000) {

        $(".foto_kilometraje").val("");

        swal({

            type: "error",
            text: "La imagen no debe pesar más de 4MB",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });
    } else {

        var ImageData = new FileReader;

        ImageData.readAsDataURL(image);

        $(ImageData).on("load", function (event) {

            var ImageRoute = event.target.result;

            $(".foto_kilometraje_vista").attr("src", ImageRoute);








        })


    }

})



$(".foto_kilometraje_editar_apertura").change(function () {

    var image = this.files[0];
    // console.log("image", image);

    /*=============================================
    =FILTER FORMAT PICTURE ONLY PNG - JPG        =
    =============================================*/

    if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

        $(".foto_kilometraje_editar_apertura").val("");

        swal({

            type: "error",
            text: "La imagen debe estar en formato JPG o PNG",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });

    } else if (image["size"] > 4000000) {

        $(".foto_kilometraje_editar_apertura").val("");

        swal({

            type: "error",
            text: "La imagen no debe pesar más de 4MB",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });
    } else {

        var ImageData = new FileReader;

        ImageData.readAsDataURL(image);

        $(ImageData).on("load", function (event) {

            var ImageRoute = event.target.result;

            $(".foto_kilometraje_editar_apertura_vista").attr("src", ImageRoute);








        })


    }

})

$(".foto_kilometraje_editar_cierre").change(function () {

    var image = this.files[0];
    // console.log("image", image);

    /*=============================================
    =FILTER FORMAT PICTURE ONLY PNG - JPG        =
    =============================================*/

    if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

        $(".foto_kilometraje_editar_cierre").val("");

        swal({

            type: "error",
            text: "La imagen debe estar en formato JPG o PNG",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });

    } else if (image["size"] > 4000000) {

        $(".foto_kilometraje_editar_cierre").val("");

        swal({

            type: "error",
            text: "La imagen no debe pesar más de 4MB",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });
    } else {

        var ImageData = new FileReader;

        ImageData.readAsDataURL(image);

        $(ImageData).on("load", function (event) {

            var ImageRoute = event.target.result;

            $(".foto_kilometraje_editar_cierre_vista").attr("src", ImageRoute);








        })


    }

})


$(".foto_kilometraje_cierre").change(function () {

    var image = this.files[0];
    // console.log("image", image);

    /*=============================================
    =FILTER FORMAT PICTURE ONLY PNG - JPG        =
    =============================================*/

    if (image["type"] != "image/jpeg" && image["type"] != "image/png") {

        $(".foto_kilometraje_cierre").val("");

        swal({

            type: "error",
            text: "La imagen debe estar en formato JPG o PNG",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });

    } else if (image["size"] > 4000000) {

        $(".foto_kilometraje_cierre").val("");

        swal({

            type: "error",
            text: "La imagen no debe pesar más de 4MB",
            title: "¡Error al subir la imagen!",
            confirmButtonText: "Cerrar"

        });
    } else {

        var ImageData = new FileReader;

        ImageData.readAsDataURL(image);

        $(ImageData).on("load", function (event) {

            var ImageRoute = event.target.result;

            $(".foto_kilometraje_cierre_vista").attr("src", ImageRoute);








        })


    }

})



$('#btn-guardar-inicio-ruta').on('click', function () {

    $(this).addClass('disabled');
    $(this).html("Cargando");

});




$('#btn-editar-ruta').on('click', function () {

    /*        $(this).attr("disabled","disabled"); 
     */

    $(this).addClass('disabled');
    $(this).html("Cargando");

});


$('#btn-guardar-cierre-ruta').on('click', function () {


    $(this).addClass('disabled');
    $(this).html("Cargando");

});




$('#btnagregarinicio-cierre-rutas').on('click', function () {


    var usuario = $(this).attr("idusuario");

    var rol = $(this).attr("rol");

    var data = new FormData();

    data.append("id_usuario_vehiculo", usuario);

    data.append("rol", rol);

    $.ajax({

        url: "ajax/inicio-cierre-rutas.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",

        success: function (response) {

            console.log("response", response);

            $(".placa_inicio_rutas").val(response["placa"]);
            $("#idvehiculo_inicio_rutas").val(response["idtbl_vehiculos"]);

            $('#modalInicioRuta').modal('show');

        },

        error: function (response, err) {
            console.log('my message ' + err + " " + response);
        }

    })





});

var kilometraje_inicial;
/*$('.btn-cierre-ruta').on('click', function() {
 */
$(".tbl-apertura-rutas tbody").on("click", "button.btn-cierre-ruta", function () {




    var usuario = $(this).attr("usuario");
    /* console.log("usuario", usuario);
     */
    kilometraje_inicial = 0;

    var data = new FormData();

    data.append("id_usuario", usuario);

    $.ajax({

        url: "ajax/inicio-cierre-rutas.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",

        success: function (response) {
            /*            console.log("response", response);
             */
            if (response) {

                $("#placa_cierre_rutas").val(response["placa"]);

                $("#idvehiculo_cierre_rutas").val(response["idplaca"]);

                kilometraje_inicial = response["kilometraje"];


            } else {


                $("#btn-guardar-cierre-ruta").addClass('disabled');


            }


        },

        error: function (response, err) {
            console.log('my message ' + err + " " + response);
        }

    })



});


$("#kilometraje_cierre").change(function () {

    var kilometros_final = $(this).val();
    /* console.log("kilometros_final", kilometros_final);

     console.log("kilometraje_inicial", kilometraje_inicial);
    */
    var kilometros_recorridos = kilometros_final - kilometraje_inicial;
    /*console.log("kilometros_recorridos", kilometros_recorridos);*/


    if (kilometros_recorridos <= 0) {


        swal({
            type: "warning",
            text: "Los kilometros iniciales son menores a los kilometros recorridos",
            title: "¡Cuidado!",
            confirmButtonText: "Cerrar",
            showConfirmButton: true,
            closeOnConfirm: false
        })
        $("#kilometraje_cierre").val("");
    }


    if (kilometros_recorridos >= 300) {

        swal({

            type: "warning",
            text: "Los kilometros recorridos son muchos",
            title: "¡Cuidado!",
            confirmButtonText: "Cerrar",
            showConfirmButton: true,
            closeOnConfirm: false
        })




    }
    $("#kilometraje_cierre_rutas").val(kilometros_recorridos);




});


var lati;
var long;
var kilometraje_inicial;

$(".tbl-apertura-rutas tbody").on("click", "button.btn-info-ruta", function () {

    // Loop through markers and set map to null for each
    for (var i = 0; i < markers.length; i++) {

        markers[i].setMap(null);
    }

    // Reset the markers array
    markers = [];

    addMarker({
        coordinates: {
            lat: 9.89294,
            lng: -84.0351837
        },
        draggable: false,
        raiseOnDrag: true,
        iconImage: "https://midigitalsat.com/public/icons/building-solid.png",
        content: "<h4>CEDI</h4>",
    });


    var lat_lng_cedi = {
        lat: 9.8929039,
        lng: -84.0351837
    };
    map.setCenter(lat_lng_cedi);

    map.setZoom(7);




    var placa = $(this).attr("placa");
    var fecha = $(this).attr("fecha");


    $(".kg-cierre").val("");

    var x = document.getElementById("mensaje_advertencia");
    x.style.display = "none";
    var data = new FormData();

    $('.carousel-inner,.carousel-indicators,.carousel-control-prev,.carousel-control-next').empty();


    data.append("placa", placa);
    data.append("fecha", fecha);

    $.ajax({

        url: "ajax/inicio-cierre-rutas.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: "json",

        success: function (response) {
            console.log("response", response);

            $(".usuario-ruta").val(response["usuario"]);
            $(".id-inicio").val(response["idtbl_apertura_rutas"]);
            $(".placa-ruta").val(response["placa"]);
            $(".kg-inicio").val(response["kilometraje"]);
            $(".fecha-inicio").val(response["fecha"]);
            $("#currentfoto_kilometraje_editar_apertura").val("https://midigitalsat.com/"+response["foto_kilometraje"]);

            lati = response["latitud"];
            long = response["longitud"];
            kilometraje_inicial = response["kilometraje"];





            addMarker({
                coordinates: {
                    lat: parseFloat(lati),
                    lng: parseFloat(long)
                },
                draggable: false,
                raiseOnDrag: true,
                iconImage: "https://midigitalsat.com/public/icons/car.png",
                content: "<h4>Apertura</h4>",
            });





            if ("https://midigitalsat.com/"+response["foto_kilometraje"] != "") {

                $('#carousel-foto-inicio-ruta .carousel-inner').append($('<div class="item active"><img src=' + "https://midigitalsat.com/"+response["foto_kilometraje"] + '></div>'));



            } else {

                $('#carousel-foto-inicio-ruta .carousel-inner').append($('<div class="item"><img src=' + "https://midigitalsat.com/"+response["foto_kilometraje"] + '></div>'));
            }




            $('.carousel-foto-inicio-ruta .carousel-inner').carousel();


            var data = new FormData();

            data.append("placa_cierre", response["placa"]);
            data.append("fecha_cierre", response["fecha"]);

            $.ajax({

                url: "ajax/inicio-cierre-rutas.ajax.php",
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

                        $('#btn-editar-ruta').removeAttr("disabled", "disabled");

                        var element = document.getElementById("btn-guardar-inicio-ruta");
                        element.classList.remove("disabled");

                        $(".fecha-cierre").val(response["fecha"]);
                        $("#currentfoto_kilometraje_editar_cierre").val("https://midigitalsat.com/"+response["foto_kilometraje"]);
                        $(".id-cierre").val(response["idtbl_apertura_rutas"]);

                        var latitud = response["latitud"];
                        var longitud = response["longitud"];
                        addMarker({
                            coordinates: {
                                lat: parseFloat(latitud),
                                lng: parseFloat(longitud)
                            },
                            draggable: false,
                            raiseOnDrag: true,
                            iconImage: "https://midigitalsat.com/public/icons/micro-car.png",

                            content: "<h4>Cierre</h4>",
                        });



                        $(".kg-cierre").val(response["kilometraje"]);

                        /*console.log("response", response["foto_kilometraje"]);
                         */
                        if (response["foto_kilometraje"] != "") {

                            $('#carousel-foto-cierre-ruta .carousel-inner').append($('<div class="item active"><img src=' + "https://midigitalsat.com/"+response["foto_kilometraje"] + '></div>'));



                        } else {

                            $('#carousel-foto-cierre-ruta .carousel-inner').append($('<div class="item "><img src=' + "https://midigitalsat.com/"+response["foto_kilometraje"] + '></div>'));
                        }


                        $('.carousel-foto-cierre-ruta .carousel-inner').carousel();

                    } else {


                        $('#btn-editar-ruta').attr("disabled", "disabled");

                        if (x.style.display == "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";

                        }



                    }


                    // var diferencia = calcCrow(lati, long, latitud, longitud);
                    var diferencia = Number(response["kilometraje"], 2) - Number(kilometraje_inicial, 2);
                    var abreviatuta;

                    if (isNaN(diferencia)) {
                        diferencia = 0;
                    };


                    var abreviatuta = "Kilometros";




                    $('.kg-recorridos-cierre').val(diferencia + " " + abreviatuta);


                },

                error: function (response, err) {
                    console.log('my message ' + err + " " + response);
                }

            })

        },

        error: function (response, err) {
            console.log('my message ' + err + " " + response);
        }

    })




})


$("#pasajeros_inicio_rutas").change(function () {

    var cantidad = $(this).val();

    if (cantidad >= 5) {

        swal({

            type: "error",
            text: "La cantidad de personas permitidas en el vehículo es erronea",
            title: "¡Error!",
            confirmButtonText: "Cerrar"

        });


        $("#btn-guardar-inicio-ruta").addClass('disabled');

    } else {

        var element = document.getElementById("btn-guardar-inicio-ruta");
        element.classList.remove("disabled");


    }


})



var markers = [];

function initMap() {


    var lati;
    var long;
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                lati = position.coords.latitude
                long = position.coords.longitude

            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }


    var lat_lng_cedi = {
        lat: 9.8929039,
        lng: -84.0351837
    };

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: lat_lng_cedi,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });

    const trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);


    addMarker({
        coordinates: {
            lat: 9.89294,
            lng: -84.0351837
        },
        draggable: false,
        raiseOnDrag: true,
        iconImage: "https://midigitalsat.com/public/icons/building-solid.png",
        content: "<h4>CEDI</h4>",
    });


    // Bind event listener on button to reload markers
    /* document.getElementById('reloadMarkers').addEventListener('click', reloadMarkers);*/
}

function addMarker(prop) {
    var marker = new google.maps.Marker({
        position: prop.coordinates, // Passing the coordinates
        map: map, //Map that we need to add
        draggarble: false // If set to true you can drag the marker

    });
    if (prop.iconImage) {
        marker.setIcon(prop.iconImage);
    }
    if (prop.content) {
        var information = new google.maps.InfoWindow({
            content: prop.content
        });

        marker.addListener('click', function () {
            information.open(map, marker);
        });
    }

    markers.push(marker);
}




function calcCrow(lat1, lon1, lat2, lon2) {

    var R = 6371; // km
    var dLat = toRad(lat2 - lat1);
    var dLon = toRad(lon2 - lon1);
    var lat1 = toRad(lat1);
    var lat2 = toRad(lat2);

    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
}

// Converts numeric degrees to radians
function toRad(Value) {

    return Value * Math.PI / 180;

}

$("#tablaKmRecorridos").DataTable({
    "language": {

        "sProcessing": "Procesando...",
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
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior",
            "decimal": ",",
            "thousands": "."
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
});

$("#datepickerKmRecorridos").datepicker({
    onSelect: function (dateText) {
        $(this).change();
    }
}).on("change", function (dateText) {

    var mes = moment(this.value).format("YYYY-MM-DD");

    window.location = "index.php?route=reporte-ventas-dth&startDate=" + startDate + "&endDate=" + endDate + "";
});