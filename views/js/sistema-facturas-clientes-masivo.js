

// $(document).ready(function() {
//     if ( $.fn.DataTable.isDataTable('#tablaClientesMasivo') ) {
//     $('#tablaClientesMasivo').DataTable().destroy();
//   }

//   var datos = "ok";

// $.ajax({

           
//            url:'ajax/datatable-sistema-facturas-clientes-masivo.ajax.php?dato='+datos,
//            async: false,
//            success: function(response){
    
//         console.log("respuesta",response);
                
//               },

//        });



//    var table = $("#tablaClientesMasivo").DataTable({
  
//     "ajax": 'ajax/datatable-sistema-facturas-clientes-masivo.ajax.php?dato='+datos,  
//     "async": "false",
//     "responsive": true, 
//     "lengthChange": false, 
//     "autoWidth": true,
//     "deferRender": true,
//     "retrieve": true,
//     "processing": true,
//     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
//     "language": {
  
//       "sProcessing":     '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
//       "sLengthMenu":     "Mostrar _MENU_ registros",
//       "sZeroRecords":    "No se encontraron resultados",
//       "sEmptyTable":     "Ningún dato disponible en esta tabla",
//       "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//       "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//       "sInfoPostFix":    "",
//       "sSearch":         "Buscar:",
//       "sUrl":            "",
//       "sInfoThousands":  ",",
//       "sLoadingRecords": '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
//       "oPaginate": {
//       "sFirst":    "Primero",
//       "sLast":     "Último", 
//       "sNext":     "Siguiente",
//       "sPrevious": "Anterior"
//       },
//       "oAria": {
//         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//       }
//     },
//     initComplete: function () {
//                   table.buttons().container()
//                       .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
//               }
  
//       })
    
//   });




var input = document.getElementById('csvClients');
var infoArea = document.getElementById('labelCsvClientes');

input.addEventListener('change', showFileName);

function showFileName(event) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'Archivo: ' + fileName;
}

$('.btnAddClientM').on("click",function(e){
	// fileValidation();

    $("#overlay2").fadeIn();
    let documento = $('#csvClients');

    if(documento.val() == ""){
        $("#overlay2").fadeOut();
        Swal.fire(
            "Aviso",
            "Ingrese un documento antes de continuar, favor utilizar el machote dado.",
            "warning"
        ).then((result) => {
        
        })

        return false;
    }
//    console.log(documento[0].files[0].name);
   getFileExtension2(documento[0].files[0].name);

});

function getFileExtension2(filename) {

    let extencion = filename.split('.').pop();

    if(extencion.toLowerCase() != "csv"){
        $("#overlay2").fadeOut();
        Swal.fire(
            "Aviso",
            "Formato del Archivo no es valido, favor utilizar el machote dado.",
            "warning"
        ).then((result) => {
        window.location = "sistema-facturas-clientes";
        })

    return false;

    }else{

        $('#csvClients').parse({
            config: {
                header: true,
         dynamicTyping: true,
         complete: function(results) {
         
            data = results.data;           
            ingresarClientes(data);
          }
    
            },
            
        });

    }
    
}

function ingresarClientes(Datos){

let empresa = $("option:selected", ".empresaheader").val();

for (let index = 0; index < Datos.length; index++) {
console.log(String(Datos[index]["TIPOCEDULA"]).padStart(2, 0));
if((Datos[index]["NOMBRE"] != undefined || Datos[index]["NOMBRE"] != "undefined") && (Datos[index]["NOMBRE"] != "null" || Datos[index]["NOMBRE"] != null) && (Datos[index]["TIPOCEDULA"] != "null" || Datos[index]["TIPOCEDULA"] != null || Datos[index]["TIPOCEDULA"] != undefined) && (Datos[index]["CEDULA"] != "null" || Datos[index]["CEDULA"] != null || Datos[index]["CEDULA"] != undefined) && (Datos[index]["CORREO"] != "null" || Datos[index]["CORREO"] != null || Datos[index]["CORREO"] != undefined) && (Datos[index]["TELEFONO"] != "null" || Datos[index]["TELEFONO"] != null || Datos[index]["TELEFONO"] != undefined) && (Datos[index]["PROVINCIA"] != "null" || Datos[index]["PROVINCIA"] != null || Datos[index]["PROVINCIA"] != undefined) && (Datos[index]["CANTON"] != "null" || Datos[index]["CANTON"] != null || Datos[index]["CANTON"] != undefined) && (Datos[index]["DISTRITO"] != "null" || Datos[index]["DISTRITO"] != null || Datos[index]["DISTRITO"] != undefined) && (Datos[index]["DIRECCION"] != "null" || Datos[index]["DIRECCION"] != null || Datos[index]["DIRECCION"] != undefined) && (Datos[index]["TIPOLISTA"] != "null" || Datos[index]["TIPOLISTA"] != null || Datos[index]["TIPOLISTA"] != undefined) && (Datos[index]["NOMBRECOMERCIAL"] != "null" || Datos[index]["NOMBRECOMERCIAL"] != null || Datos[index]["NOMBRECOMERCIAL"] != undefined)){

    var data = new FormData();

    data.append("id_empresa", empresa);
    data.append("Nombre", Datos[index]["NOMBRE"]);
    data.append("tipo_cedula", String(Datos[index]["TIPOCEDULA"]).padStart(2, 0));
    data.append("cedula", Datos[index]["CEDULA"]);
    data.append("correo", Datos[index]["CORREO"]);
    data.append("telefono", Datos[index]["TELEFONO"]);
    data.append("provincia", Datos[index]["PROVINCIA"]);
    data.append("canton", Datos[index]["CANTON"]);
    data.append("distrito", Datos[index]["DISTRITO"]);
    data.append("direccion", Datos[index]["DIRECCION"]);
    data.append("Tipo_lista", Datos[index]["TIPOLISTA"]);
    data.append("nombre_fantasia", Datos[index]["NOMBRECOMERCIAL"]);
         
    $.ajax({

        url:"ajax/sistema-facturas-clientes-masivo.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        // dataType: "json", 
        success: function(response){

            // console.log(response);
          
        },

        error: function(response, err){ console.log('my message ' + err + " " + response );}
    })

}else{
    $("#overlay2").fadeOut();
    Swal.fire(
        "Error al procesar",
        "Documento no cuenta con los parametros necesarios, valide la información e intente nuevamente.",
        "error"
    ).then((result) => {
    window.location = "sistema-facturas-clientes";
    })

return false;

}

}
$("#overlay2").fadeOut();
Swal.fire(
    "Exitoso",
    "Datos ingresados exitosamente",
    "success"
).then((result) => {
window.location = "sistema-facturas-clientes";
})

}


$(".documentacion").click(function() {
   
    let empresa = $("option:selected","#empresaheader").val();
    // var openedWindow =  window.open("extensions/Excel/vendor/reporteListaPrecio.php?empresa="+empresa);
    // DescargarArchivos();
    eliminarArchivos(empresa);  
// openedWindow.close();
});


 function DescargarArchivos(){

    var zip = new JSZip();
    var count = 0;
    var count2 = 0;
    var zipFilename = 'GuiaCreacionClientes.zip';
    var nameFromURL = [];
    var urls = [];
    let urldom1 = './extensions/DocumentacionClientes/Reporte Lista Precio.xlsx';
    urls.push(urldom1);
    let urldom2 = './extensions/DocumentacionClientes/Machote Clientes.csv';
    urls.push(urldom2);
    let urldom3 = './extensions/DocumentacionClientes/Provincia_Canton_Distrito.xlsx';
    urls.push(urldom3);
    let urldom4 = './extensions/DocumentacionClientes/Ejemplo Creacion de Cliente.xlsx';
    urls.push(urldom4);
    let urldom5 = './extensions/DocumentacionClientes/Tipos Cedula.xlsx';
    urls.push(urldom5);


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

    
}


 function eliminarArchivos(empresa){

    var data = new FormData();

    data.append("empresa", empresa);
         
    $.ajax({

        url:"extensions/Excel/vendor/reporteListaPrecio.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        // dataType: "json", 
        success: function(response){

            console.log(response);
            DescargarArchivos()
          
        },

        error: function(response, err){ console.log('my message ' + err + " " + response );}
    })

}