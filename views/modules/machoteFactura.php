<style type="text/css" media="print">
    @page 
    {
        size: A4;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
    @page :footer {color: #fff }
    @page :header {color: #fff}

    #myBtn{
  display: none;
}

    #whatsappbtn{
  display: none;
}

 @media all,print, screen {
 
    div #divFooter {
    font-weight: bold;
    /* position: fixed;
    bottom: 0; */
  }

  table #factura_detalle {
        width: 100%!important;
        margin-bottom: 10px!important;
        border-collapse: collapse!important;
        /*table-layout: fixed*/
    }

    table #factura_detalle thead th {
        font-family: 'Arial'!important;
        /* background: #9f9fa2!important;
        color: #050505!important; */
        padding: 2px!important;
    }

    #itemsFact tr:nth-child(even) {
        background-color: #DEDADA!important;
    }

    #itemsFact tr {
        background-color: #DEDADA!important;
    } 
  
} 

#TablaresumenT table{     
        width: 100%;
        font-family: 'Arial'; 
        font-size: 20px;  
        /* text-align: left; */
        /* border-collapse: collapse; */
        /* margin: 0 0 1em 0;
        caption-side: top; */
    
    }

#TablaresumenIVA table{
    width: 100%;
    font-family: 'Arial'; 
    font-size: 20px; 
}

    #TablaresumenT td {
   border-bottom: 1px solid #F1F1F1;
   width: 50%;
   padding: 0.3em;
}


#factura_detalle {
        width: 100%;
        margin-bottom: 10px;
        border-collapse: collapse;
        /*table-layout: fixed*/
    }

#factura_detalle table thead th {
        font-family: 'Arial';
        /* background: #9f9fa2;
        color: #050505; */
        padding: 2px;
    }

#itemsFact tr:nth-child(even) {
        background: #DEDADA;
    }


table {
  break-after: page;
}


</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Productos</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">Facturas</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <!-- <div class="card-header">


                        </div> -->

                        <div class="card-body">
                       
                            <!-- title row -->
                            <div class="row">
                                <div class="col-4">
                                    <h2 class="page-header">
                                    <img  src="" id="logoEmpresa" width="200px" height="100px"> 
                                        <!-- <div class="float-right">

                                        </div> -->                                      
                                    </h2>
                                </div>
                                <div class="col-4">
                                    <div class="justify-content-center">
                                        <h2 id="tipoDocFacts" style="margin-top: 10px;"></h2>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            

                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 col-lg-4 invoice-col">
                                   
                                    <address id="dtsEmpresaFact">
                                        
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-lg-4 invoice-col">
                                   
                                    <address id="dtsClientFact">
                                        
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-lg-4 invoice-col">
                                    <address id="dtsFactura">    
                                        
                                    </address>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->


                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <address id="dtsClaveFact" style="font-size: 15px;">
                                                
                                    </address>
                                </div>
                            </div>



                            <!-- TABLA DE PRODUCTOS -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table-striped" id="factura_detalle">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Cantidad</th>
                                                <th style="text-align: center;">Descripción</th>
                                                <th style="text-align: center;">Precio Unitario</th>
                                                <th style="text-align: center;">Descuento</th>
                                                <th style="text-align: center;">IVA</th>
                                                <th style="text-align: center;">Total</th>

                                            </tr>
                                        </thead>
                                        <tbody id="itemsFact">
                                                                                  
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->


                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    
                                    <p class="lead">Resumen Iva</p>
                                    
                                            <!-- <div class="row" id="TablaresumenIVA" >

                                            </div> -->
                                      
                                    <div class="table-responsive">
                                        <table class="" id="TablaresumenIVA" >
                                            
                                        </table>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                                <div class="col-6 float-right">
                                <div class="float-right">
                                    <p class="lead">Resumen Totales</p>

                                    <div class="table-responsive ">
                                        <table class="" id="TablaresumenT">
                                            
                                        </table>
                                    </div>
                                </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">

                                <div class="col-6">

                                <p class="lead">Observaciones:</p>

                                    <p class="text-muted well well-sm shadow-none" id="observacionesFact" style="margin-top: 10px;"></p>
                                
                                </div>
                                    <br>

                                <div class="col-6">
                                    <p class="lead">Referencia:</p>


                                    <p class="text-muted well well-sm shadow-none" id="referenciaFact" style="margin-top: 10px;"></p>

                                </div>

                            </div>


                        </div>


                        <div class="card-footer" id="divFooter">

                        <footer>
                            <!-- 	<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Outthebox-cr, <br> info@Outthebox-cr.com</p>
                            <h4 class="label_gracias">¡Gracias por su compra!</h4>	
                            <br> -->
                            <p style=" text-align: center;"><img src="views/img/logo.png" width="90%"
                                    height="150px"></p>
                        </footer>

                        </div>


                    </div>

                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


<!-- <script>
  window.addEventListener("load", window.print());
</script> -->



<script>

$(document).ready(function() {

    const urlfacturas = window.location.search;

    const urlparamfactura = new URLSearchParams(urlfacturas);

    const clave = urlparamfactura.get('clave');

  let datosFact = cargarDatosFact(clave);

  console.log(datosFact);
 let logo = datosFact[0].logo;
 logo = logo.substr(3);
  
$("#logoEmpresa").attr("src", logo);

$("#dtsClaveFact").append('<strong>Consecutivo: </strong> '+ datosFact[0].consecutivo +'<br>'+
                        '<strong>Clave: </strong> '+ datosFact[0].clave +'');

$("#dtsEmpresaFact").append('<strong>Datos Emisor</strong><br>'+
                            'Nombre: '+ datosFact[0].nombreComercial +'</strong><br>'+
                            'Cédula: '+ datosFact[0].cedula +'<br>'+
                            'Dirección: '+ datosFact[0].direccion +' <br>'+                                      
                            'Teléfono: '+ datosFact[0].telefono +'<br>'+
                            'Correo: '+ datosFact[0].correo +''
);

$("#dtsClientFact").append('<strong>Datos Receptor</strong><br>'+
                           'Nombre: '+ datosFact[0].nombreCliente +'<br>'+
                           'Cédula: '+ datosFact[0].cedulaCliente +'<br>'+
                           'Correo: '+ datosFact[0].correoCliente +'');

$("#dtsFactura").append('<strong>Datos Documento</strong><br>'+                      
                        '<b>Fecha: </b><?php  echo date("Y/m/d"); ?> <br>'+
                        '<b>Moneda: </b> '+ datosFact[0].moneda +' <b>/  Tipo Cambio: </b> '+ datosFact[0].tipoCambio +'<br>'+
                        '<b>Tipo Venta: </b> '+ datosFact[0].tipoVenta +'<br>' +
                        '<b>Plazo Credito: </b> '+ datosFact[0].plazoCredito +'');

$("#tipoDocFacts").append('<strong>'+ datosFact[0].tipoDocumento +'</strong>');     

$("#observacionesFact").append(''+ datosFact[0].comentarios +''); 

$("#referenciaFact").append(''+ datosFact[0].referencia +'');  


cargarDatosDetalle(datosFact[0].idFactura, datosFact[0].moneda);
cargarDatosIva(datosFact[0].idFactura, datosFact[0].moneda);
cargartotales(datosFact[0].subtotal, datosFact[0].descuento, datosFact[0].impuesto, datosFact[0].total, datosFact[0].moneda);

    window.print();


});


window.addEventListener("afterprint", function(event) {

    window.close();
    window.location="sistema-facturas-facturacion";
});


function cargarDatosFact(clave){

    var listaDatosFacts = [];
    var data = new FormData();
  data.append("ClaveFact",clave); 
  
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

            //   console.log(response);

              listaDatosFacts.push({"clave": response[0].clave,
                             "consecutivo": response[0].consecutivo,                         
                             "actividad": response[0].codigo_actividad,
                             "moneda": response[0].codigo_moneda,
                             "comentarios" : response[0].comentarios,
                             "tipoVenta" : response[0].condicion_venta,
                             "cedula" : response[0].cedula,
                             "descuento" : response[0].descuento,
                             "direccion" : response[0].direccion,
                             "correo" : response[0].email,
                             "fechaFactura" : response[0].fecha_factura,
                             "impuesto" : response[0].impuesto,
                             "logo" : response[0].logo,
                             "nombre" : response[0].nombre,
                             "nombreComercial" : response[0].nombre_ficticio,
                             "plazoCredito" : response[0].plazo_credito,
                             "referencia" : response[0].referencia,
                             "subtotal" : response[0].subtotal,
                             "total" : response[0].total,
                             "tipoDocumento" : response[0].tipo_documento,
                             "telefono" : response[0].telefono,
                             "nombreCliente" : response[0].nombre_cliente,
                             "cedulaCliente" : response[0].cedula_cliente,
                             "correoCliente" : response[0].correo_cliente,
                             "tipoCambio" : response[0].tipo_cambio,
                             "idFactura" : response[0].idtbl_sistema_facturacion_facturas                       
                            });


            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}

    }) 

return listaDatosFacts;
}


function cargartotales(subtotal, descuento, impuesto, total, moneda){

    $("#TablaresumenT").append('<tr>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">Subtotal:</td>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ Number(subtotal,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">Descuento:</td>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ Number(descuento,2).toLocaleString("en-US", {
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>');

                                            $("#TablaresumenT").append('<tr>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">Impuesto:</td>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ Number(impuesto,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">Total:</td>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ Number(total,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>');

}


function cargarDatosIva(idFactura, moneda){

 
    var data = new FormData();
    data.append("ivasFact",idFactura); 

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
                for (let i = 0; i < response.length; i++) {
                    $("#TablaresumenIVA").append('<tr>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ response[i].Tipo_iva +'</td>'+
                                            '<td style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+ Number(response[i].totalIva ,2).toLocaleString("en-US",{ style: "currency", currency: moneda}) +'</td>'+
                                            '</tr>');                     
                }

            },
            
            error: function(response, err){ console.log('my message ' + err + " " + response );}

    }) 

}


function cargarDatosDetalle(idFactura, moneda){

    var data = new FormData();
    data.append("DetalleFact",idFactura); 

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

                for (let i = 0; i < response.length; i++) {

                    
                    // background: #e8f2fd; border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;
                    if(i %2==0){
                        // background-color: #e0e0e1;
                        $("#itemsFact").append('<tr style="background-color: #DEDADA;">'+
                                            '<td style="text-align: center;">'+ response[i].cantidad +'</td>'+
                                            '<td style="text-align: center;">'+ response[i].nombre +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].precio_unidad,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].descuento,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].impuesto,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].total,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>');

                    }else{

                        $("#itemsFact").append('<tr style="border-bottom: 1px solid #F1F1F1; width: 50%; padding: 0.3em;">'+
                                            '<td style="text-align: center;">'+ response[i].cantidad +'</td>'+
                                            '<td style="text-align: center;">'+ response[i].nombre +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].precio_unidad,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].descuento,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].impuesto,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '<td style="text-align: right;">'+ Number(response[i].total,2).toLocaleString("en-US",{
                                            style: "currency",
                                            currency: moneda
                                        }) +'</td>'+
                                            '</tr>');

                    }

                    

                                            
                    
                }

            },

            error: function(response, err){ console.log('my message ' + err + " " + response );}

    }) 

}


</script>


