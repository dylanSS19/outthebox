var val;

val = "ok";

 
//  Rol = sessionStorage.getItem('rol'); 

// $.ajax({

         
//           url:"ajax/datatable-planes-clientes.ajax.php?val=" + val,
//           async: false,
//           success: function(response){

       
//        console.log("respuesta",response);
              
//              },

//       });


$(document).ready(function () {


	// $.ajax({

	         
	//           url:'ajax/datatable-planes-clientes.ajax.php?val=' + val,
	//           async: false,
	//            // dataType: "json",
	//           success: function(response){

	       
	//        console.log("respuesta",response);
	              
	//              },

	//       });


  var table = $("#tablaPlanesClientes").DataTable({
    ajax: "ajax/datatable-planes-clientes.ajax.php?val=" + val,
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





var stepper = new Stepper($('.bs-stepper')[0])
  var stepper = new Stepper(document.querySelector('.bs-stepper'));
  // console.log(stepper);



  $(".btnPlanCliente").click(function () {

    $('#modalAgregarPlanCliente').modal('show'); // abrir
    //$('#myModalExito').modal('hide'); // cerrar
    let empresa = $("option:selected", "#empresaheader").val();
    $(".global").empty();
    var data = new FormData();

    data.append("paquetes", "ok");
    data.append("IdEmp", empresa);
    

     $.ajax({

          url:"ajax/planes-clientes.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          async: false,
          dataType: "json",
          success: function(response){

            //  console.log("response", response);


             for(var i = 0; i < response.length; i++){ 

let moneda = response[i]["moneda"];
let simbolo = "";
let modulos = JSON.parse(response[i]["modulos"])
if (moneda == "CRC"){

    simbolo = "₡";

}else{

    simbolo = "$";


}





             $(".global").append('<div class="col-lg-12">' +
                '<div class="card card-info shadow-sm collapsed-card">'+
                    '<div class="card-header">'+
                        '<h3 class="card-title">Paquete: '+ response[i]["nombre"] +'  (Precio: '+ simbolo + ' '+ formatter.format(response[i]["precio"]) +' + IVA)</h3>'+

                        '<div class="card-tools">'+
                            '<button type="button" class="btn btn-tool" '+
                              '  data-card-widget="collapse">'+
                                '<i class="fas fa-minus"></i>'+
                            '</button>'+
                        '</div>'+
                        
                    '</div>'+
                    
                    '<div class="card-body">'+
                    '<div class="row">'+ 
                       
                    '<h4>Modulos de Paquete </h4>'+
                                          
                                                                                             
                            '<div class="col-lg-12 divsModulos'+ i +'">'+                                                   

                                

                            '</div>'+

                            '<div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">'+
                            '<button type="button" '+
                               ' class="btn btn-primary justify-content-end btnAgregarPaquete" idDiv="'+ response[i]["idtbl_categoria_planes"] +'" pre="'+ response[i]["precio"] +'" id="btnAgregarPaquete'+ response[i]["idtbl_categoria_planes"] +'" nombre ="'+ response[i]["nombre"] +'">Agregar</button>'+
                            '</div>'+
                            '<div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">'+
                            '<button type="button" '+
                               ' class="btn btn-danger justify-content-end btnQuitarPaquete " idDiv="'+ response[i]["idtbl_categoria_planes"] +'" pre="'+ response[i]["precio"] +'" id="btnQuitarPaquete'+ response[i]["idtbl_categoria_planes"] +'" nombre ="'+ response[i]["nombre"] +'" hidden>Quitar</button>'+
                            '</div>'+

                    '</div>'+
                                                                                                               
                   '</div>'+
                    
                '</div>'+

                '</div>');

                for(var j = 0; j < modulos.length; j++){

                    $(".divsModulos"+i).append(

                         
                        '<blockquote>'+

                        '<p>'+modulos[j]+'</p>'+

                        '</blockquote>'
                
                        
                );

                }

               

             }      

        },

        error: function(response, err){ console.log('my message ' + err + " " + response );}

  })



  });

  $(".global").on("click", "button.btnAgregarPaquete", function(){

 

    let ID = $(this).attr("idDiv");

    $(this).prop('hidden', "true");
    $("#btnQuitarPaquete"+ID).removeAttr('hidden');

    let nombre = $(this).attr("nombre");
    let precioMod = $(this).attr("pre");
    let total = $("#totalPagarMo").val();
    let newTotal = parseFloat(precioMod) + parseFloat(total);

    AgregarModulos(ID, nombre, precioMod);


    let montoPagar = 0; 

    for (var i =0; i < listaPaquetes.length; i++){
                
        montoPagar = parseFloat(listaPaquetes[i].precioIva) + parseFloat(montoPagar);

     }

    $("#totalPagarMu").val(formatter.format(montoPagar));
    $("#totalPagarMo").val(montoPagar);

 

  });


  $(".global").on("click", "button.btnQuitarPaquete", function(){

    let ID = $(this).attr("idDiv");

    $(this).prop('hidden', "true");
    $("#btnAgregarPaquete"+ID).removeAttr('hidden');

    let nombre = $(this).attr("nombre");
    let precioMod = $(this).attr("pre");
    let total = $("#totalPagarMo").val();
    
    let newTotal = parseFloat(total) - parseFloat(precioMod);
    
    EliminarModulos(listaPaquetes, ID, nombre, precioMod);

    let montoPagar = 0; 

    for (var i =0; i < listaPaquetes.length; i++){
                
        montoPagar = parseFloat(listaPaquetes[i].precioIva) + parseFloat(montoPagar);

     }

    $("#totalPagarMu").val(formatter.format(montoPagar));
    $("#totalPagarMo").val(montoPagar);
    
    
});


      var listaPaquetes = [];
    function AgregarModulos(idPaquete, nombre, precio){
 
        var data = new FormData();

        data.append("paquetesId", idPaquete);
    
         $.ajax({
    
              url:"ajax/planes-clientes.ajax.php",
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              dataType: "json",
              success: function(response){

                console.log(response);

                let precioIva = parseFloat(precio) * parseFloat(response[0].tarifaIva) / 100  + parseFloat(precio);
                let montoIva = parseFloat(precio) * parseFloat(response[0].tarifaIva) / 100;
                listaPaquetes.push({"IdPquete": idPaquete,
                "nombre": nombre,                         
                "precio": precio,
                "cabys": response[0].cabys,
                "codigoIva": response[0].codigoIva,
                "codigoTarifa": response[0].codigoTarifa,           
                "tarifaIva": response[0].tarifaIva,
                "cantidadDocumentos": response[0].cantidadDocumentos,
                "sku": response[0].sku,
                "moneda": response[0].moneda,
                "dias": response[0].dias,
                "precioIva": precioIva,
                "montoIva": montoIva
               });

            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}
        })


           
 
   
        return listaPaquetes;
               
        }


        function EliminarModulos(arr, idPaquete, nombre, precio){
 
            
            for (var i =0; i < arr.length; i++){
                if (arr[i].IdPquete == idPaquete) {
                    arr.splice(i,1);
                }             
             }

        
    return listaPaquetes;

    }


    $("#btnSiguienteModel").click(function () {
     
        let montoPagar = 0; 

        for (var i =0; i < listaPaquetes.length; i++){
                    
            montoPagar = parseFloat(listaPaquetes[i].precioIva) + parseFloat(montoPagar);

         }
       
         $("#totalPagarFinal").val(formatter.format(montoPagar));

        stepper.next();

      });



      $(".btnGuardaPaquetes").click(function () {

        let empresa = $("option:selected", "#empresaheader").val();
        let nombre = $("#frmpagoNombre").val();
        let tipo_cedula = $("option:selected","#frmpagoTced").val();
        let cedula = $("#frmpagocedula").val();
        let correo = $("#frmpagocorreo").val();
        let telefono = $("#frmpagotelefono").val();

        if(empresa == ""){

            Swal.fire(
                "Aviso",
                "Seleccione una empresa antes de realizar el tramite.",
                "warning"
              ).then((result) => {
            //window.location = "reporte-sistema-facturacion";
              })    
              return false;      
        }

        var imagen = $("#comptransferencia");
    
        imagen = imagen[0].files[0];

        if(imagen == undefined || imagen == "undefined" || imagen == ""){
    
        imagen = $("#compSinpe");
        
        imagen = imagen[0].files[0];

            if(imagen == undefined || imagen == "undefined" || imagen == ""){


                Swal.fire(
                    "Aviso",
                    "Ingrese foto del comprobante antes de registrar los datos.",
                    "warning"
                ).then((result) => {
                //window.location = "reporte-sistema-facturacion";
                })     

                return false;      

            }


        }


if(nombre == "" || tipo_cedula == "" || cedula == "" || correo == "" || telefono == "" ){

    Swal.fire(
        "Aviso",
        "Ingrese los datos del formulario antes de registrar los datos.",
        "warning"
    ).then((result) => {
    //window.location = "reporte-sistema-facturacion";
    })     

    return false; 

}

        //let Clave = enviarFacturaPaquetes(empresa);
        let Clave = "3";

        let rutaFoto = enviarFotoPaquetes(empresa, Clave);
        insertPaquetes(empresa, Clave, rutaFoto);
         
      });
      



function insertPaquetes(empresa, Clave, rutaFoto) {
    
    let fecha = new Date();
    
    // fecha = moment(fecha).format('YYYY-MM-DD h:mm:ss');
 
    // return false;


console.log(rutaFoto);
// return false;

    for (var i =0; i < listaPaquetes.length; i++){

       let diasExt = parseInt(listaPaquetes[i].dias) + 2;
        let fechaFin = moment().add(listaPaquetes[i].dias, 'd');
        fechaFin =  moment(fechaFin).format('YYYY-MM-DD 23:59:59');

        let fechaExtension = moment().add(diasExt, 'd');
        fechaExtension =  moment(fechaExtension).format('YYYY-MM-DD 23:59:59');
 
        var data = new FormData();

        data.append("clientes", empresa);
        data.append("fecha_fin", fechaFin);
        data.append("fecha_extencion", fechaExtension);
        data.append("idPlan", listaPaquetes[i].IdPquete);
        data.append("nombrePlan", listaPaquetes[i].nombre);
        data.append("precioPlan", listaPaquetes[i].precio);
        data.append("cantDocumentos", listaPaquetes[i].cantidadDocumentos);
        data.append("total_pagar", listaPaquetes[i].precioIva);
        data.append("estado", "Pendiente");
        data.append("ClaveHacienda", Clave);
        data.append("RutFoto", rutaFoto);

        $.ajax({

            url:"ajax/planes-clientes.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            // dataType: "json",
            success: function(response){

                console.log(response);

                if(!isNaN(response)){

                    Swal.fire(
                        "Aviso",
                        "Tramite realizado exitosamente, por favor espere la confirmación del pago y activacion del plan.",
                        "success"
                    ).then((result) => {
                    window.location = "planes-clientes";
                    })     
                
                    return false; 
                
                }else{

                    Swal.fire(
                        "Aviso",
                        "Error al ingresar los datos, por favor intente nuevamente.",
                        "error"
                    ).then((result) => {
                    // window.location = "planes-clientes";
                    })     
                
                    return false;

                }

               

            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}
        })

    }




}


function enviarFacturaPaquetes(empresa) {

    let nombre = $("#frmpagoNombre").val();
    let tipo_cedula = $("option:selected","#frmpagoTced").val();
    let cedula = $("#frmpagocedula").val();
    let correo = $("#frmpagocorreo").val();
    let telefono = $("#frmpagotelefono").val();
    let tipoDocumento = "01";
    let detalleFactura;
    let factura;
    let arrayFactura = [];
    let sucursal = "001";
    let caja = "001";
    let tipo_pago = "04";
    let actividadEconomica = "123456";
    let moneda = "USD";
    for (var i = 0; i < listaPaquetes.length; i++){

        detalleFactura = {                            
            "numeroLinea":""+ (i + 1) +"",
            "cabys":""+ listaPaquetes[i]["cabys"] +"",
            "unidadMedida":"Sp",
            "tipoCodigoProducto":"01",
            "Codigo":""+ listaPaquetes[i]["sku"] +"",
            "descripcionProducto":""+ listaPaquetes[i]["nombre"] +"",
            "cantidad":"1",
            "precioUnitario":""+ listaPaquetes[i]["precio"] +"",
            "costo":"0",
            "descuento":"0",
            "motivoDescuento":"Descuento",
            "subTotal":""+ listaPaquetes[i]["precio"] +"",              
            "totalDetalle":""+ listaPaquetes[i]["precioIva"] +"",                                  
            "tipoImpuesto":""+listaPaquetes[i]["codigoIva"]+"",
            "codTasaImpuesto":""+listaPaquetes[i]["codigoTarifa"]+"",
            "tasaImpuesto":""+listaPaquetes[i]["tarifaIva"]+"",
            "montoImpuesto":""+ listaPaquetes[i]["montoIva"] +""                                              
            }

          arrayFactura.push(detalleFactura);

    }


  let datosempresa = AgregarDatosEmpresa();

      factura  = {
        "fileContent":{
      
                    "datosEmisor":{
                        "usuario": ""+datosempresa[0].usuario+"",
                        "password": ""+datosempresa[0].password+"",
                        "cedula":""+datosempresa[0].cedula+"",
                        "id_empresa":""+datosempresa[0].id_empresa+""   
                    },     
                    "datosReceptor":{
                        "nombre":""+ nombre +"",
                        "tipoCedula":""+tipo_cedula+"",
                        "cedula":""+cedula+"",
                        "direccion": "LOCAL COMERCIAL",
                        "correo":""+correo+"",
                        "telefono":""+telefono+"",
                        "provincia": "",
                        "canton": "01",
                        "distrito": "01",
                        "senas": "LOCAL COMERCIAL"
                    },          
                    "datosFactura":{
                            "sucursal":""+sucursal+"",
                            "caja":""+caja+"",
                            "tipoDoc":""+ tipoDocumento +"",
                            "moneda":""+ moneda +"",                                                                     
                            "condicionVenta":"01",
                            "plazoCredito":"0",
                            "medioPago":""+ tipo_pago +"",
                            "tipoCambio":"1",
                            "actividadEconomica":""+ actividadEconomica +"",
                            "api":"Si",
                            "detalleFactura":
                            arrayFactura                                                                       
                    }
        }       
      }

      console.log("Factura", JSON.stringify(factura));

      var data = new FormData();
      data.append("DatosFactura",JSON.stringify(factura)); 
       
         $.ajax({
       
                url:"ajax/sistema-facturas-facturacion.ajax.php", 
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                // dataType: "json",  
      
                success: function(response){
      
                  console.log(response);
                var respt  =  JSON.parse(response);
                  if(respt["success"] == "true"){
      
                    Swal.fire(
                      "Exelente",
                      "Factura realizada con exito.",
                      "success"
                    ).then((result) => {
                  window.location = "sistema-facturas-facturacion";
                    }) 
      
      
      
                  }else{
      
                    Swal.fire(
                      "Error",
                      "Error al realizar la factura, intente nuevamente.",
                      "error"
                    ).then((result) => {
                  window.location = "sistema-facturas-facturacion";
                    }) 
      
                  }
      
                },
      
                error: function(response, err){ console.log('my message ' + err + " " + response );}
      
          }) 

}


function enviarFotoPaquetes(empresa, Clave) {

let ruta = "";
    var imagen = $("#comptransferencia");
    
    imagen = imagen[0].files[0];
if(imagen == undefined || imagen == "undefined" || imagen == ""){

    imagen = $("#compSinpe");
    
    imagen = imagen[0].files[0];

}


console.log(imagen);

// return false;

    var data = new FormData();
    data.append("DatosEmpresa", empresa); 
    data.append("FotoComprovante", imagen); 
    data.append("Clave", Clave); 
       $.ajax({
     
              url:"ajax/planes-clientes.ajax.php", 
              method: "POST",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              async: false,
            //   dataType: "json",  
    
              success: function(response){
    
                console.log(response);
                ruta = response;
    
              },
    
              error: function(response, err){ console.log('my message ' + err + " " + response );}
    
        }) 

return ruta;

}




function AgregarDatosEmpresa(){


    var listaDatosEmpresa = [];
    
    
    let empresa = $('option:selected','#empresaheader').val();

  
    var data = new FormData();

    data.append("DatosEmpresa", empresa); 

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
for (var i = 0; i < response.length; i++){
    
  listaDatosEmpresa.push({"usuario": response[i].usuario_facturacion,
                       "password": response[i].contrasena_facturacion,                         
                       "cedula": response[i].cedula,
                       "id_empresa": response[i].idtbl_clientes,
                       "actividadEconomica" : response[i].cod_actividad
                        
                      });
  }

              },
                
            })
    
  //  console.log("empresa", listaDatosEmpresa);
    return listaDatosEmpresa;
           
    }      







 



    $(".comptransferencia").change(function(){

        var image = this.files[0];
        //console.log("image", image);
      
      /*=============================================
      =FILTER FORMAT PICTURE ONLY PNG - JPG        =
      =============================================*/
      
      if(image["type"] != "image/jpeg" && image["type"] != "image/png"){
      
        $(".comptransferencia").val("");
      
        swal({
      
              type: "error",
              text: "La imagen debe estar en formato JPG o PNG",
              title: "¡Error al subir la imagen!",
              confirmButtonText: "Cerrar"
      
            }); 
      
      } else if(image["size"] > 4000000){
      
        $(".comptransferencia").val("");
      
        swal({
      
              type: "error",
              text: "La imagen no debe pesar más de 4MB",
              title: "¡Error al subir la imagen!",
              confirmButtonText: "Cerrar"
      
            }); 
      } else {
      
        var ImageData = new FileReader;
      
        ImageData.readAsDataURL(image);
      
        $(ImageData).on("load", function(event){
       
          var ImageRoute = event.target.result;
      
          $("#comptransferencia_vista").attr("src",ImageRoute);
      
      
      
        })
      
      }
      
      });


      $(".compSinpe").change(function(){

        var image = this.files[0];
        //console.log("image", image);
      
      /*=============================================
      =FILTER FORMAT PICTURE ONLY PNG - JPG        =
      =============================================*/
      
      if(image["type"] != "image/jpeg" && image["type"] != "image/png"){
      
        $(".compSinpe").val("");
      
        swal({
      
              type: "error",
              text: "La imagen debe estar en formato JPG o PNG",
              title: "¡Error al subir la imagen!",
              confirmButtonText: "Cerrar"
      
            }); 
      
      } else if(image["size"] > 4000000){
      
        $(".compSinpe").val("");
      
        swal({
      
              type: "error",
              text: "La imagen no debe pesar más de 4MB",
              title: "¡Error al subir la imagen!",
              confirmButtonText: "Cerrar"
      
            }); 
      } else {
      
        var ImageData = new FileReader;
      
        ImageData.readAsDataURL(image);
      
        $(ImageData).on("load", function(event){
       
          var ImageRoute = event.target.result;
      
          $("#compSinpe_vista").attr("src",ImageRoute);
      
      
      
        })
      
      }
      
      });



