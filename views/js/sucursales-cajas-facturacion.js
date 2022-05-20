// var idempresa = $('option:selected', '.empresaheader').val();  
// Rol = sessionStorage.getItem('rol'); 

// $.ajax({
 
         
//           url:'ajax/datatable-sucursal-caja-facturacion.ajax.php?IdEmpresa='+idempresa,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });
 
$(document).ready(function() {
var idempresa = $('option:selected', '.empresaheader').val();

 var table = $("#tablaSucursales").DataTable({

       "ajax": 'ajax/datatable-sucursal-caja-facturacion.ajax.php?IdEmpresa='+idempresa,  
       "async": "false",

      "responsive": true, "lengthChange": false, 
      "autoWidth": true,
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

  },
  initComplete: function () {
                table.buttons().container()
                    .appendTo( $('.col-md-6:eq(0)', table.table().container() ) );
            }

    })
  

});

 
     $('.idsucursal').keyup(function () {
         this.value = (this.value + '').replace(/[^0-9]/g, '');

     });



$("#tablaSucursales").on("click", "button.btnAddconse", function(){

      // (this).attr("idsucursalId");
      // (this).attr("idcajaId");
      
      $("#sucursal").val($(this).attr("idsucursalId"));
      $("#caja").val($(this).attr("idcajaId"));
      
   
    let ambiente = "Prod";
    $("#frmSucursalAmbiente").val(ambiente).trigger('change');
      // CargarUltComsecutivo(idSucursal, idCaja, empresa, ambiente);
      
      $('#modalUltConse').modal('show'); // abrir

      
     });



$(".btnAddUltConse").click(function() {

let conseFe = $("#conseFE").val();
let consete = $("#conseTE").val();
let consenc = $("#conseNC").val();
let consend = $("#conseND").val();
let conseFc = $("#conseFC").val();
let consemr = $("#conseMR").val();

let ambiente = $("option:selected","#frmSucursalAmbiente").val();
let idCaja = $("#caja").val();
let idSucursal = $("#sucursal").val();
let empresa = $("option:selected","#empresaheader ").val();
let resp = "";


if(ambiente == ""){

  Swal.fire(
    "Aviso",
    "Seleccione el ambiente antes de ingresar los consecutivos",
    "warning"
  ).then((result) => {
   
  }) 

return false;

}



if(conseFe.trim() == "" || String(conseFe).trim() == 'N/A'){

}else{

  let tipo = "FE";

  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, conseFe, ambiente);
}

if(consete.trim() == "" || String(consete).trim() == 'N/A'){

}else{

  let tipo = "TE";

  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, consete, ambiente);

}

if(consenc.trim() == "" || String(consenc).trim() == 'N/A'){

}else{

  let tipo = "NC";

  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, consenc, ambiente);

}

if(consend.trim() == "" || String(consend).trim() == 'N/A'){

}else{

  let tipo = "ND";
  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, consend, ambiente);

}
 
if(conseFc.trim() == "" || String(conseFc).trim() == 'N/A'){

}else{

  let tipo = "FC";

  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, conseFc, ambiente);

}


if(consemr.trim() == "" || String(consemr).trim() == 'N/A'){

}else{

  let tipo = "MR";
  resp = ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, consemr, ambiente);

}

  Swal.fire(
    "Exelente",
    "Datos ingresados correctamente.",
    "success"
  ).then((result) => {
   
  window.location = "sucursal-cajas-facturacion";
  
  })


});



function ingresarConsecutivos(idSucursal, idCaja, empresa, tipo, consecutivo, ambiente){

let tabla = "";
let respuesta;
if(ambiente == "Prod"){

  tabla = "empresas.tbl_ultimo_consecutivo"

}else{

  tabla = "empresas.tbl_ultimo_consecutivo_P"

}

  var data = new FormData();
  
  data.append("id_factura", "0"); 
  data.append("ultimo_consecutivo", consecutivo); 
  data.append("sucursal", idSucursal); 
  data.append("caja", idCaja); 
  data.append("tipo", tipo); 
  data.append("id_empresa", empresa); 
  data.append("tabla", tabla); 

       $.ajax({
   
            url:"ajax/sucursales-caja-facturacion.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",  
            success: function(response){
              
              respuesta = response
              
            // console.log(response);

            },
                      
          })

return respuesta;

}


$("#frmSucursalAmbiente").change(function() {

  let ambiente = $("option:selected", this).val();
  let idCaja = $("#caja").val();
  let idSucursal = $("#sucursal").val();
  let empresa = $("option:selected","#empresaheader").val();

  CargarUltComsecutivo(idSucursal, idCaja, empresa, ambiente);

});


var arrayTipos = ["FE","TE","ND","NC","FC","MR"];
function CargarUltComsecutivo(idSucursal, idCaja, empresa, ambiente) {
  $("#overlay2").fadeIn();

  // setTimeout(function () { 

    let tabla = "";

    if(ambiente == "Prod"){
  
      tabla = "empresas.tbl_ultimo_consecutivo";
     
    }else{
    
      tabla = "empresas.tbl_ultimo_consecutivo_P";
      // $("#frmSucursalAmbiente").val(ambiente).trigger('change');
    }
  
  for (let i = 0; i < arrayTipos.length; i++) {
   
    // console.log(arrayTipos[i]);
    data.append("SearchTabla", tabla); 
    data.append("Searchtipo", arrayTipos[i]); 
    data.append("SearchSucursal", idSucursal); 
    data.append("SearchCaja", idCaja); 
    data.append("Searchempresa", empresa); 
  
    $.ajax({
  
         url:"ajax/sucursales-caja-facturacion.ajax.php",
         method: "POST",
         data: data,
         cache: false,
         contentType: false,
         processData: false,
         async: false,
         dataType: "json",  
         success: function(response){
           
          if(response[0][0] == 0 || response[0][0] == "0"){
  
            $("#conse"+arrayTipos[i]).val("N/A");
  
          }else{
  
          $("#conse"+arrayTipos[i]).val(response[0][0].padStart(3, 0));
  
  
          }
           
          // console.log(response);
  
         },
                   
       })
   
  
  
  }

  $("#overlay2").fadeOut();
  //   },1)


}