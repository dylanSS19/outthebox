
 
$(document).ready(function () {


 
  var val = "ok";

// $.ajax({

         
//           url:'ajax/datatable-planes-categoria.ajax.php?val=' + val,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });

  var table = $("#tablaPlanes").DataTable({
    ajax: "ajax/datatable-planes-categoria.ajax.php?val=" + val,
    async: "false",

    responsive: true,
    lengthChange: false,
    autoWidth: true,
    deferRender: true,
    retrieve: true,
    processing: true,
    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

    language: {
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
    initComplete: function () {
      table
        .buttons()
        .container()
        .appendTo($(".col-md-6:eq(0)", table.table().container()));
    },
  });
});



$(".btnGuardarCat").click(function () {
  let plan = $("#frmplanes option:selected").text();
  let plan2 = $("#frmplanes option:selected").val();
  let categoria = $("#frmcategorias").val();
  let monto = $("#frmprecio").val();
  let documentos = $("#frmdocumentos").val();
  let facExtra = $("#frmfacextra").val();

  if (
    (plan.includes("Facturacion") && documentos == "0") ||
    (plan.includes("Facturacion") && documentos == "")
  ) {
    Swal.fire(
      "Aviso",
      "Ingrese la cantidad de documetos para este paquete",
      "warning"
    );

    return;
  } else {
    let exist = validarPaquetes(plan2, categoria);

    if (exist == "1") {

      Swal.fire(
        "Aviso!",
        "El paquete ya existe.",
        "warning"
      ).then((result) => {
        // window.location = "planes-categoria";
      });

      return;

    } else {

        var data = new FormData();

        data.append("plan", plan2);
        data.append("categoria", categoria);
        data.append("costo", monto);
        data.append("documentos", documentos);
        data.append("FactExtra", facExtra);

         $.ajax({

              url:"ajax/planes-categoria.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              // dataType: "json",
              success: function(response){

                //  console.log("response", response);

                 if(response == "ok"){

                    Swal.fire(
                        "Ingreso Exitoso!",
                        "Paquete creado correctamente.",
                        "success"
                      ).then((result) => {

                        window.location = "planes-categoria";

                      })

                 }else{

                    Swal.fire(
                        "Error",
                        "Error al ingresar los datos intente nuevamente.",
                        "error"
                      ).then((result) => {

                        window.location = "planes-categoria";

                      })

                 }

            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}

      })

    }

    
  }
});

function validarPaquetes(plan, paquete) {
  var resp = "";

  var data = new FormData();

  data.append("Validplan", plan);
  data.append("Validcategoria", paquete);

  $.ajax({
    url: "ajax/planes-categoria.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {
      //  console.log("response", response[0]);
      resp = response[0];
    },

    error: function (response, err) {
      console.log("my message " + err + " " + response);
    },
  });

  return resp;
}

$("#tablaPlanes").on("click", "button.btnEditpaquete", function(){

$('#modaleditarPlanes').modal('show'); // abrir
//$('#myModalExito').modal('hide'); // cerrar

let paquete = $(this).attr("paquete");

$(".btneditarCat").attr("idPaquete", paquete);


var data = new FormData();

  data.append("loadCategoria", paquete);

  $.ajax({
    url: "ajax/planes-categoria.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    dataType: "json",
    success: function (response) {
      
        console.log("response", response);

        var values = new Array();

        let privilegios = JSON.parse(response[0]["modulos"]);

        var x;

        for (x of privilegios) {

          values.push(x);

        }


$("#frmeditplanes").val(values).trigger('change');
$("#frmeditcategorias").val(response[0].nombre);
$("#frmeditPlanessku").val(response[0].sku);
$("#frmeditPlanescabys").val(response[0].cabys);
$("#frmeditdocumentos").val(response[0].cantidadDocumentos);
$("#frmeditPlanesdias").val(response[0].dias);
$("#frmeditprecio").val(response[0].precio);
$("#frmeditMoneda").val(response[0].moneda).trigger('change');

    },

    error: function (response, err) {
      console.log("my message " + err + " " + response);
    },
  });



});


$(".btneditarCat").click(function () {

    let idPaquete = $(this).attr("idPaquete");
    let nombre = $("#frmeditcategorias").val();
    let sku = $("#frmeditPlanessku").val();
    let cabys = $("#frmeditPlanescabys").val();
    let cantDocumentos = $("#frmeditdocumentos").val();
    let diasPaquete = $("#frmeditPlanesdias").val();
    let precio = $("#frmeditprecio").val();
    let moneda = $("#frmeditMoneda").val();

// console.log(factExtra);

            var data = new FormData();

            data.append("editarNombre",nombre);
            data.append("editarSku",sku);
            data.append("editarCabys",cabys);
            data.append("editarCantDocumentos",cantDocumentos);
            data.append("editarDias",diasPaquete);
            data.append("editarPrecio",precio);
            data.append("editarMoneda",moneda);
            data.append("idPaquete",idPaquete);

             $.ajax({
    
                  url:"ajax/planes-categoria.ajax.php",
                  method: "POST",
                  data: data,
                  cache: false,
                  contentType: false,
                  processData: false,
                  async: false,
                  // dataType: "json",
                  success: function(response){
    
                     console.log("response", response);
    
                     if(response == "ok"){
    
                        Swal.fire(
                            "Ingreso Exitoso!",
                            "Paquete creado correctamente.",
                            "success"
                          ).then((result) => {
    
                            window.location = "planes-categoria";
    
                          })
    
                     }else{
    
                        Swal.fire(
                            "Error",
                            "Error al ingresar los datos intente nuevamente.",
                            "error"
                          ).then((result) => {
    
                            window.location = "planes-categoria";
    
                          })
    
                        }
    
                },
    
                error: function(response, err){ console.log('my message ' + err + " " + response );}
    
          })


      


});

// frmPlaneseditsearchCabys


$("#ModulosPaquetes").change(function(){

  let planes = $(this).val();
  
  
  for(var i = 0; i < planes.length; i++){
  
      for(var j = 0; j < planes.length; j++){
  
        if(planes[i] == "Facturacion-api" && planes[j] == "Facturacion-web"){
  
          Swal.fire(
            '¡Planes Incorrectos!',
            'Imposible Seleccionar Facturacion-API y Facturacion-WEB en el mismo cliente',
            'error'
          ); 
  
          // $("option:selected","#ModulosPaquetes").prop("selected", false);
          // $("option:selected","#ModulosPaquetes").detach();
          $("#ModulosPaquetes").val(null).trigger("change");
  
        }
  
  
      }
  
  
  }
  
  
  });




  //$('#myModalExito').modal('show'); // abrir
//$('#myModalExito').modal('hide'); // cerrar




$("#frmPlanessearchCabys").click(function () {


  $('#modalCabys').modal('show'); // abrir

})


$("#frmPlaneseditsearchCabys").click(function () {


  $('#modalCabys').modal('show'); // abrir

})


$(".frmPanesBuscarCabys").click(function () {


  let nombreProducto = $("#frmPanesCabysSearch").val();

  if(nombreProducto == ""){


    Swal.fire(
      "warning",
      "Datos incompletos, favor validar que no deje espacios vacios.",
      "error"
    ).then((result) => {

      // window.location = "planes-categoria";

    })

    
  }else{


    CargarApiCabys(nombreProducto);


  }

})

$("#frmPanestablaCabys").on("click", "button.frmPlanesNunCabys", function(){

  let codigo = "";

 codigo = $(this).attr("cod");


if($('#modaleditarPlanes').is(':visible')){


  $("#frmeditPlanescabys").val(codigo);

}else{

  $("#frmPlanescabys").val(codigo);  

}




});



function CargarApiCabys(nombreProducto){

	// $.ajax({

	         
	//           url:'ajax/datatable-planes-categoria.ajax.php?cabysSearch='+nombreProducto,
	//           async: false,
	//            // dataType: "json",
	//           success: function(response){

	       
	//        console.log("respuesta",response);
	              
	//              },

	//       });

if ( $.fn.DataTable.isDataTable('#frmPanestablaCabys') ) {
  $('#frmPanestablaCabys').DataTable().destroy();
}
 
	// var table = $('#tablaProductos').removeAttr('width').DataTable( {
	       var table = $("#frmPanestablaCabys").DataTable({

	             "ajax": 'ajax/datatable-planes-categoria.ajax.php?cabysSearch='+nombreProducto,  
	             "async": "false",
	             "columnDefs": [
	    { "width": "10%", "targets": 0 }
	  ],
	  "fixedColumns": true,
	        "responsive": true, 
	        "lengthChange": true, 
	        "autoWidth": false,
	         "deferRender": true,
	        "retrieve": true,
	        "processing": true,
	       // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

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
	        initComplete: function customEvent(e){
	     // table.search(e.value).draw(table.responsive.recalc());  ///Must trigger the draw event, but move on to the next line while it's being processed/
	       // Essentially has no effect.
	}



	          })

}	


$(".frmPlanesbtnGuardarCat").click(function (){

let modulos = $("#ModulosPaquetes").val();
let nombre = $("#frmPlanescategorias").val();
let sku = $("#frmPlanessku").val();
let cabys = $("#frmPlanescabys").val();
let cantidadDocumentos = $("#frmPlanesdocumentos").val();
let dias = $("#frmPlanesdias").val();
let precio = $("#frmPlanesprecio").val();
let codtarifa = $("option:selected","#frmPlanestarifaIva").val();
let tarifaIva = $("option:selected","#frmPlanestarifaIva").attr("tarifa");
let ivaPaquete = "01";
let moneda = $("#frmPlanesMoneda").val();

// return false;

var data = new FormData();

data.append("modulosPaquete",JSON.stringify(modulos));
data.append("nombrePaquete",nombre);
data.append("skuPaquete",sku);
data.append("cabysPaquete",cabys);
data.append("planesPaquete",cantidadDocumentos);
data.append("diasPaquete",dias);
data.append("precioPaquete",precio);
data.append("ivaPaquete",ivaPaquete);
data.append("codTarifaPaquete",codtarifa);
data.append("tarifaPaquete",tarifaIva);
data.append("moneda",moneda);


 $.ajax({

      url:"ajax/planes-categoria.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",
      success: function(response){

         console.log("response", response);

         if(response == "ok"){

            Swal.fire(
                "Ingreso Exitoso!",
                "Paquete creado correctamente.",
                "success"
              ).then((result) => {

                window.location = "planes-categoria";

              })

         }else{

            Swal.fire(
                "Error",
                "Error al ingresar los datos intente nuevamente.",
                "error"
              ).then((result) => {

                window.location = "planes-categoria";

              })

         }

    },

    error: function(response, err){ console.log('my message ' + err + " " + response );}

})




});


$("#tablaPlanes").on("click", "button.btnEstadoPaquete", function(){


let estado = $(this).attr("estado");
let idPaquete = $(this).attr("paquete");
let fecha = new Date();

if(estado == "Activo"){

  estado = "Desactivo"

}else{

  estado = "Activo"

}



fecha = moment(fecha).format('YYYY-MM-DD h:mm:ss');

data.append("fecha",fecha);
data.append("estado",estado);
data.append("IdPaq",idPaquete);

 $.ajax({

      url:"ajax/planes-categoria.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      // dataType: "json",
      success: function(response){

         console.log("response", response);

         if(response == "ok"){

            Swal.fire(
                "Ingreso Exitoso!",
                "Datos Actualizados Correctamente",
                "success"
              ).then((result) => {

                window.location = "planes-categoria";

              })

         }else{

            Swal.fire(
                "Error",
                "Error al ingresar los datos intente nuevamente.",
                "error"
              ).then((result) => {

                window.location = "planes-categoria";

              })

         }

    },

    error: function(response, err){ console.log('my message ' + err + " " + response );}

})

});
