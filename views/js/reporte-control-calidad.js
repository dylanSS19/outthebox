

    $('#tblControlCalidad').DataTable( {
        dom: 'Bfrtip',
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
buttons: [
'pageLength','colvis',
'copy', 'excel', 'pdf'
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
.column( 5, { search: 'applied'} )
.data()
.reduce( function (a, b) {
 return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 5 ).footer() ).html(
''+total+''
);

// Total over all pages
total = api
.column( 2, { search: 'applied'} )
.data()
.reduce( function (a, b) {
 return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 2 ).footer() ).html(
''+ total +''
);

// Total over all pages
total = api
.column( 3, { search: 'applied'} )
.data()
.reduce( function (a, b) {
 return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 3 ).footer() ).html(
''+ total +''
);

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





} ,
'columns': [
null,
null,
null,
null,
null,
null

],
/*      "responsive": true, "lengthChange": false, "autoWidth": true,
"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],*/

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
"sPrevious": "Anterior",
"decimal": ",",
"thousands": "."
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}

}

} ).buttons().container().appendTo('#tblControlCalidad_wrapper .col-md-6:eq(0)');



/*-------     REPORTE CONTROL DE PAGOS     -----------*/



$('#tblControlPagos').DataTable( {
    dom: 'Bfrtip',
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
buttons: [
'pageLength','colvis',
'copy', 'excel', 'pdf'
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
.column( 2, { search: 'applied'} )
.data()
.reduce( function (a, b) {
return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 2 ).footer() ).html(
''+total+''
);

// Total over all pages
total = api
.column( 3, { search: 'applied'} )
.data()
.reduce( function (a, b) {
return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 3 ).footer() ).html(
''+ total +''
);

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

// Total over all pages
total = api
.column( 6, { search: 'applied'} )
.data()
.reduce( function (a, b) {
return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 6 ).footer() ).html(
''+ total +''
);

// Total over all pages
total = api
.column(7, { search: 'applied'} )
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


// Total over all pages
total = api
.column( 9, { search: 'applied'} )
.data()
.reduce( function (a, b) {
return intVal(a) + intVal(b);
}, 0 );

// Update footer
$( api.column( 9 ).footer() ).html(
''+ total +''
);



} ,
'columns': [
null,
null,
null,
null,
null,
null,
null,
null,
null,
null

],
/*      "responsive": true, "lengthChange": false, "autoWidth": true,
"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],*/

"language": {

buttons: {
colvis: 'Columnas Visibles',
copy: 'Copiar',
pageLength:'Mostrar'
},

//"order": [],
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
"sPrevious": "Anterior",
"decimal": ",",
"thousands": "."
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}

}

} ).buttons().container().appendTo('#tblControlPagos_wrapper .col-md-6:eq(0)');
