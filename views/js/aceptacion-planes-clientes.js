$(document).ready(function() {


    let datos = "ok";

    // $.ajax({
    
             
    //           url:'ajax/datatable-aceptacion-planes-clientes.ajax.php?datos='+datos,
    //           async: false,
    //           success: function(response){
         
    //         console.log("respuesta",response);
                  
    //              },
    
    //       });
    
        
     var table = $("#tablaAceptacionPlanes").DataTable({
    
           "ajax": 'ajax/datatable-aceptacion-planes-clientes.ajax.php?datos='+datos,  
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



$("#tablaAceptacionPlanes").on("click", "button.btnAcepPlan", function () {

    let idPlanCliente = $(this).attr("clientid");
    cargarDatosCliente(idPlanCliente);

$('#modalPlanesAcep').modal('show'); // abrir


});



$(".btnGuardarAcepPlan").click(function () {

    let idPlanCliente = $("#frmAceptPLcliente").attr("idplan");
AceptarSuscrip(idPlanCliente);

});

var modulosContratados;

function cargarDatosCliente(idPlanCliente){

        // console.log(idPlanCliente);

// return false;

    let data = new FormData();

  data.append("idPlanCliente",idPlanCliente);
  //console.log("idaceptacioncargo", idaceptacioncargo);

   $.ajax({


     url:"ajax/aceptacion-planes-clientes.ajax.php",
     method: "POST",
     data: data,
      async: true,
      beforeSend :function(){
                 $('#overlay').fadeIn() ;
             },
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(response){

        // console.log("response", response);

let foto = response[0].fotoComprobante;

foto = foto.replace('..', '.');
// console.log("response", foto);


$("#frmAceptNcliente").val(response[0].nombre);
$("#frmAceptCEcliente").val(response[0].cedula);
$("#frmAceptCOcliente").val(response[0].email);
$("#frmAceptTEcliente").val(response[0].telefono);
$("#frmAceptDIcliente").val(response[0].direccion);
$("#frmAceptPLcliente").val(response[0].nombrePlan);
$("#frmAceptPLcliente").attr("idplan", response[0].idtbl_clientes_planes);
$("#frmAceptPLcliente").attr("privi", response[0].privilegio);
$("#frmAceptPLcliente").attr("emp", response[0].idtbl_clientes);
$("#frmAceptMPcliente").val(response[0].total_pagar);
$("#frmAceptimgComp").attr("src", foto);

 modulosContratados = JSON.parse(response[0].modulos);

$('#overlay').fadeOut();


    },
        error: function(response, err){console.log('my message ' + err + " " + response + " ");}



   });

}



function AceptarSuscrip(idPlanCliente){

    // console.log(idPlanCliente);

let Privilegios = $("#frmAceptPLcliente").attr("privi");
let empresa = $("#frmAceptPLcliente").attr("emp");

Privilegios = JSON.parse(Privilegios);

let listaModulosActuales = [];

console.log(Privilegios);
console.log(modulosContratados);

let agregar = 0;


for(var i = 0; i < Privilegios.length; i++){

    listaModulosActuales.push(Privilegios[i]);

}


    for(var i = 0; i < modulosContratados.length; i++){

        for(var j = 0; j < listaModulosActuales.length; j++){

            if(listaModulosActuales[j] == modulosContratados[i]){

                // agregar = "No";
            // listaModulosActuales.push(Privilegios[i]);

        
            }else{
        
                existencia = 1;
                break;
           
        
            }

           

        }

        if(existencia == 0){

            listaModulosActuales.push(modulosContratados[i]);

          }
      

    }
    
// console.log(listaModulosActuales);
// return false;

let data = new FormData();

data.append("AceptarSuscrip", idPlanCliente);
data.append("modulos", JSON.stringify(listaModulosActuales));
data.append("empresa", empresa);


$.ajax({


 url:"ajax/aceptacion-planes-clientes.ajax.php",
 method: "POST",
 data: data,
 async: true,
 cache: false,
 contentType: false,
 processData: false,
//  dataType: "json",
 success: function(response){

console.log(response);

    if(response.trim() == "ok"){

        Swal.fire(
          "Aviso",
          "Datos modificados exitosamente",
          "success"
        ).then((result) => {
      
        window.location = "aceptacion-planes-clientes";
      
      })   

      }else{

        Swal.fire(
          "Aviso",
          "Error al modificar los datos, intente nuevamente.",
          "warning"
        ).then((result) => {
      
        window.location = "aceptacion-planes-clientes";
      
      })  

    }


},
    error: function(response, err){console.log('my message ' + err + " " + response + "");}

});

}