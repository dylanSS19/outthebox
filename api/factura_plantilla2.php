<?php 

$servername = "midigitalsat.com";
$username = "admin";
$password = "Heriberto9109";

        $conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_sistema_facturacion_facturas where clave = '$clave'");

                        $stmt -> execute();

                        $factura =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);

                        $stmt =null;

//$factura = api_facturacioncontroller::CargarDatosFactura($clave);
                        $idnum_factura=$factura[0]['idtbl_sistema_facturacion_facturas'];


$cantCeros = 10;
$num_factura = substr(str_repeat(0, $cantCeros).$factura[0]['idtbl_sistema_facturacion_facturas'], - $cantCeros);

   		$conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_sistema_facturacion_detalle_facturas where id_factura = '$num_factura'");

                        $stmt -> execute();
                       
						$Detallefactura= $stmt->fetchAll();


                        $stmt =null;


     $conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_factura_Compra_emisor where idFactura = '$idnum_factura'");

        $stmt -> execute();
                       
$DetalleEmisor= $stmt->fetchAll();

        $stmt =null;

        $conn =  new PDO("mysql:host=$servername;dbname=empresas", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT IF(a.tarifa_iva = '0','IVA 0%',IF(a.tarifa_iva = '1','IVA 1%',IF(a.tarifa_iva = '2','IVA 2%',IF(a.tarifa_iva = '4','IVA 4%',IF(a.tarifa_iva = '8','IVA 8%',IF(a.tarifa_iva = '13','IVA 13%','')))))) as 'Tipo_iva',ifnull(b.impuesto, 0) as totalIva						
	FROM
		(SELECT 
			nombre, codigo_tarifa, tarifa_iva
		FROM
		empresas.tbl_tarifa_impuestos) AS a
			LEFT JOIN
		(SELECT 
			sum(impuesto) as impuesto, tasa_Impuesto, codImpuesto
		FROM
		empresas.tbl_sistema_facturacion_detalle_facturas
		WHERE
			id_factura = '$idnum_factura'
		GROUP BY codImpuesto) AS b ON a.codigo_tarifa = b.codImpuesto
	GROUP BY a.tarifa_iva");

		$stmt -> execute();

		$DetalleIva = $stmt->fetchAll();

		$stmt =null;


// $Detallefactura = HomeController::CargarDetalleFactura($num_factura);
//$Detallefactura = api_facturacioncontroller::CargarDetalleFactura($num_factura);

if($factura[0]['codigo_moneda'] == "CRC"){

$simMoneda = '¢';

}else if($factura[0]['codigo_moneda'] == "USD"){

	$simMoneda = '$';

}else if($factura[0]['codigo_moneda'] == "EUR"){

	$simMoneda = '€';

}else{

$simMoneda = '';

}

$id_empresa = $factura[0]['id_compania'];
// echo '<pre>'; print_r($id_empresa); echo '</pre>';
// $DatosEmpresa = HomeController::CargarDatosEmpresa($id_empresa);
//$DatosEmpresa = api_facturacioncontroller::CargarDatosEmpresa($id_empresa);


   		$conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_clientes where idtbl_clientes = '$id_empresa'");

                        $stmt -> execute();

                        $DatosEmpresa =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);

                        $stmt =null;

if($DatosEmpresa[0]["logo"] == ""){

}else{


$logo = $DatosEmpresa[0]["logo"];
$logo = substr($logo, 2); 
$logo = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$id_empresa.'/img/logo.png';

}



if($factura[0]['tipo_documento'] == '01'){

	$tipoDocumento = 'Factura Electronica';

}elseif($factura[0]['tipo_documento'] == '02') {

	$tipoDocumento = 'Nota Debito Electronica';

}elseif($factura[0]['tipo_documento'] == '03') {

	$tipoDocumento = 'Nota Crédito Electronica';

}elseif($factura[0]['tipo_documento'] == '04') {

	$tipoDocumento = 'Tiquete Electronico';

}elseif($factura[0]['tipo_documento'] == '08') {

	$tipoDocumento = 'Factura Compra Electronica';


}

$condVenta = "";

if($factura[0]['condicion_venta'] == '01'){

$condVenta = "Contado";


}else if($factura[0]['condicion_venta']  == '02'){


$condVenta = "Crédito";

}else if($factura[0]['condicion_venta']  == '03'){

$condVenta = "Consignación";

}else if($factura[0]['condicion_venta']  == '04'){


$condVenta = "Apartado";

}else if($factura[0]['condicion_venta']  == '05'){


$condVenta = "Arrendamiendo con opción de compra";



}else if($factura[0]['condicion_venta']  == '06'){



$condVenta = "Arrendamiento con función financiera";


}else if($factura[0]['condicion_venta']  == '07'){


$condVenta = "Cobro a favor de un tercero";



}else if($factura[0]['condicion_venta']  == '08'){


$condVenta = "Servicios Prestado al estado";

}else if($factura[0]['condicion_venta']  == '09'){


$condVenta = "Pago servicio prestado al estado";

}else if($factura[0]['condicion_venta']  == '99'){


$condVenta = "Otros";

}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Factura</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <style type="text/css">
    /* @import url('fonts/BrixSansRegular.css');
    @import url('fonts/BrixSansBlack.css'); */

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
 
    p,
    label,
    span,
    table {
        font-family: 'arial';
        font-size: 9pt;
    }

    /* header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

               
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }*/

    /* footer {
        position: absolute;
        bottom: 170px !important;
        left: 0px;
        right: 0px;
        height: 50px;
    } */



    .h2 {
        font-family: 'Arial';
        font-size: 16pt;

    }

    .h3 {
        font-family: 'Arial';
        font-size: 12pt;
        display: block;
        background: #9f9fa2;
        color: #050505;
        text-align: center;
        padding: 3px;
        margin-bottom: 5px;
    }

    #page_pdf {
        width: 95%;
        margin: 15px auto 10px auto;
    }

    #factura_head,
    #factura_cliente {
        width: 100%;
        margin-bottom: 10px;
        font-weight: bold;
    }

    #factura_detalle {
        width: 100%;
        margin-bottom: 10px;
        /*table-layout: fixed*/
    }

    .logo_factura {
        width: 25%;

    }

    .info_empresa {
        width: 50%;
        text-align: center;
        font-weight: bold;
    }

    .info_factura {
        width: 25%;
        font-weight: bold;
    }

    .info_cliente {
        width: 100%;
    }

    .datos_cliente {
        width: 100%;
    }

    .datos_cliente tr td {
        width: 50%;
    }

    .datos_cliente {
        padding: 10px 10px 0 10px;
    }

    .datos_cliente label.lbldatos_cliente {
        width: 75px;
        display: inline-block;
    }

    .datos_cliente p {
        display: inline-block;
    }

    .textright {
        text-align: right;
    }

    .textleft {
        text-align: left;
    }

    .textcenter {
        text-align: center;
    }

    .round {
        border-radius: 10px;
        border: 1px solid #9f9fa2;
        overflow: hidden;
        padding-bottom: 15px;
    }

    .round p {
        padding: 0 15px;
    }

    #factura_detalle {
        border-collapse: collapse;
    }

    #factura_detalle thead th {
        font-family: 'Arial';
        background: #9f9fa2;
        color: #050505;
        padding: 2px;
    }

    #detalle_productos tr:nth-child(even) {
        background: #e0e0e1;
    }

    #detalle_totales span {
        font-family: 'Arial';
        font-weight: bold;
    }

    .nota {
        font-size: 8pt;
    }

    .label_gracias {
        font-family: verdana;
        font-weight: bold;
        font-style: italic;
        text-align: center;
        margin-top: 20px;
    }

    .anulada {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
    }
    #ResuTotales table{     
        width: 100%;
        font-family: 'Arial'; 
        font-size: 20px;  
        /* text-align: left; */
        /* border-collapse: collapse; */
        /* margin: 0 0 1em 0;
        caption-side: top; */
    
    }

    #ResuTotales td {
   border-bottom: 1px solid #F1F1F1;
   width: 50%;
   padding: 0.3em;
}

    @page {
        margin-bottom: 20px !important;
        padding-bottom: 20px !important;
    }
    </style>

</head>

<body>
    <?php 
	if($factura[0]['estado_anulacion'] == 'Total'){

     echo'<img class="anulada" src="/bot_aceptacion_docs_produccion/factura/img/anulado.png" alt="Anulada">';

	}

?>

<div id="contenedor1" style = 'height: 100px; width: 800px; border: 1px solid rgba(255, 255, 255); margin-top: 10px;'>

    <div style = 'height: 100px; width: 250px; float: left;'>

        <?php 

            if($DatosEmpresa[0]["logo"] == ""){

            }else{ 	?>

                <div>

                    <img src='<?php echo $logo ?>' style="width: 200px; height: 90px;">

                </div>

        <?php } ?>

    </div>
    
    <div style = 'height: 100px; width: 250px; float: left;  margin-left: 30px; margin-right: 2px;'>

    <h2><?php  echo $tipoDocumento; ?></h2>

    </div>

   

</div>

<!-- border: 3px solid black; rgba(255, 255, 255)-->
<div id="contenedor2" style = 'height: 130px; width: 800px; margin-top: 10px;'>

 <div style = 'height: 130px; width: 250px; float: left; margin-left: 15px;'>

        <h4>Datos Emisor</h4>   
         
            <?php if($factura[0]['tipo_documento'] == '08'){?>

            <p>Cédula: <?php  echo $DetalleEmisor[0]["cedula"]; ?></p> 
                
            <p>Nombre: <?php  echo $DetalleEmisor[0]["nombre"]; ?></p>
                
            <p>Correo: <?php  echo $DetalleEmisor[0]['correo']; ?></p>
         
         <?php }else{ ?>

            <p><?php  echo $DatosEmpresa[0]["nombre"]; ?></p>
            <p>Cédula: <?php  echo $DatosEmpresa[0]["cedula"]; ?></p>
            <p>Dirección: <?php  echo $DatosEmpresa[0]["direccion"]; ?></p>
            <p>Teléfono: +(506) <?php  echo $DatosEmpresa[0]["telefono"]; ?></p>
            <p>Email: <?php  echo $DatosEmpresa[0]["email"]; ?></p>
       
            <?php } ?>  
    </div>

    <div style = 'height: 130px; width: 250px; float: left; margin-left: 25px;'>

        <h4>Datos Receptor</h4>
        <?php if($factura[0]['tipo_documento'] == '08'){?>   

            <p><?php  echo $DatosEmpresa[0]["nombre"]; ?></p>
            <p>Cédula: <?php  echo $DatosEmpresa[0]["cedula"]; ?></p>
            <p>Dirección: <?php  echo $DatosEmpresa[0]["direccion"]; ?></p>
            <p>Teléfono: +(506) <?php  echo $DatosEmpresa[0]["telefono"]; ?></p>
            <p>Email: <?php  echo $DatosEmpresa[0]["email"]; ?></p>

        <?php }else{ ?>  

            <p>Cédula: <?php  echo $factura[0]['cedula_cliente']; ?></p>       
            <p>Nombre: <?php  echo $factura[0]['nombre_cliente']; ?></p>                 
            <p>Correo: <?php  echo $factura[0]['correo_cliente']; ?></p>

        <?php } ?> 					
    </div>
    <div style = 'height: 130px; width: 250px; float: right; margin-right: 4px;'>
        <div style = 'margin-left: 30px;'>

            
            <h4><?php  echo $tipoDocumento; ?></h4>
            <p>Fecha: <?php  echo date("d-m-Y h:i:s", strtotime($factura[0]['fecha_factura'])); ?></p>
            <p>Código Actividad: <?php  echo $factura[0]['codigo_actividad']; ?></p>
            <p>Condición Venta: <?php  echo $condVenta; ?></p>
            <p>Plazo Crédito: <?php  echo $factura[0]['plazo_credito']; ?></p>
            <p>Moneda: <?php echo ' '.$factura[0]['codigo_moneda']; ?></p>
            <p>Tipo Cambio: <?php echo ' '.$factura[0]['tipo_cambio']; ?></p>

        </div>   

    </div> 


</div>


<div id="contenedor6" style = 'height: 25px; width: 800px; margin-top: 5px;'>

<div style = 'height: 25px; width: 400px; float: left; margin-left: 15px;'>

        
        <p>Consecutivo: <?php  echo $factura[0]["consecutivo"]; ?></p>
        <p>Clave: <?php  echo $factura[0]["clave"]; ?></p>

    </div>


</div>
<!-- <?php if($factura[0]['tipo_documento'] == '08'){?>

<td class="textcenter"><label>DATOS EMISOR</label></td>

<?php }	

?>
<?php if($factura[0]['tipo_documento'] == '08'){?>

<td class="textcenter"><label>Cédula: <?php  echo $DetalleEmisor[0]["cedula"]; ?></label> 
    
</td>
<?php }	

?>
<?php if($factura[0]['tipo_documento'] == '08'){?>

<td class="textcenter"><label>Nombre: <?php  echo $DetalleEmisor[0]["nombre"]; ?></label>
    
</td>


<?php }	

?>
<?php if($factura[0]['tipo_documento'] == '08'){?>

<td class="textcenter"><label>Correo: <?php  echo $DetalleEmisor[0]['correo']; ?></label>
    
</td>


<?php }	

?> -->

<!-- <div id="contenedor3" style = 'height: 100px; width: 800px; border: 1px solid rgba(255, 255, 255); margin: auto;'> -->
    <div id="page_pdf">

        <table id="factura_detalle">

            <thead>
                <tr>
                    <th class="textcenter" style="width: 20px;">Cantidad</th>
                    <th class="textcenter" style="width: 360px;">Descripción</th>
                    <th class="textcenter" style="width: 80px;">Precio Unitario</th>
                    <th class="textcenter" style="width: 80px;">Descuento</th>
                    <th class="textcenter" style="width: 80px;">IVA</th>
                    <th class="textcenter" style="width: 80px;"> Precio Total</th>
                </tr>
            </thead>
            <tbody id="detalle_productos">

                <?php      
                        
                    foreach ($Detallefactura as $key => $value) {
   
                            echo '<tr>
                                    <td style="width: 20px;" class="textcenter">'.$value[4].'</td>
                                    <td style="width: 360px;" class="textcenter">'.$value[3].'</td>
                                    <td style="width: 80px;" class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[5], 2, '.', ',' ).'</td>
                                    <td style="width: 80px;" class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[7], 2, '.', ',' ).'</td>
                                    <td style="width: 80px;" class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[8], 2, '.', ',' ).'</td>
                                    <td style="width: 80px;" class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[9], 2, '.', ',' ).'</td>
                                </tr>';

                        }

                ?>
                <tr>
                    <!-- <td style="width: 20px;"  class="textcenter"></td>
					<td style="width: 360px;" class="textcenter"></td> -->
                    <td colspan="6" class="textcenter">---- Última Linea ----</td>
                    <!-- 	<td style="width: 80px;" class="textcenter"></td>
					<td style="width: 80px;" class="textcenter"></td>
					<td style="width: 80px;" class="textcenter"></td> -->
                </tr>
            </tbody>

        </table>

    <!-- </div> -->

</div>
<!-- rgba(255, 255, 255) -->
<div id="contenedor3" style = 'height: 170px; width: 800px; border: 1px solid rgba(255, 255, 255); margin-top: 10px;'>

    <div style = 'height: 170px; width: 250px; float: left; margin-left: 15px;'>

    <!-- <h4>Detalle iva</h4>       -->

<!-- <div style = 'margin-left: 50px;'> -->
            <table id="ResuTotales">
                <thead>
                    
                    <tr>
                        
                        <th colspan="2" class="textcenter">Detalle Iva</th>
                        
                    </tr>

                </thead>

                <tbody>
                    
                    
                    <?php      
                        
                        foreach ($DetalleIva as $key => $value) {
       
                                echo '<tr>
                                <td><span>'.  $value[0] .'</span></td>
                                <td class="textright">
                                    <span>'. $formatted = $simMoneda.' '. number_format( (float) $value[1], 2, '.', ',' ) .'</span>
                                </td>
                            </tr>';
    
                            }
    
                    ?>
                   

                </tbody>

            </table>
        
        <!-- </div> -->

    </div>

    <div style = 'height: 170px; width: 250px; float: right; margin-right: 4px;'>
        <div style = 'margin-left: 50px;'>
            <table id="ResuTotales">
                <thead>
                    
                    <tr>
                        
                        <th colspan="2" class="textcenter">Resumen Totales</th>
                        
                    </tr>

                </thead>

                <tbody>
                    
                    <tr>
                        <td><span>SUBTOTAL</span></td>
                        <td>
                            <span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['subtotal'], 2, '.', ',' ); ?></span>
                        </td>
                    </tr>

                    <tr>
                        <td><span>DESCUENTO</span></td>
                        <td>
                            <span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['descuento'], 2, '.', ',' ); ?></span>
                        </td>
                    </tr>

                    <tr>
                        <td><span>IVA</span></td>
                        <td>
                            <span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['impuesto'], 2, '.', ',' ); ?></span>
                        </td>
                    </tr>

                    <tr>
                        <td><span>TOTAL</span></td>
                        <td>
                            <span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['total'], 2, '.', ',' ); ?></span>
                        </td>
                    </tr>

                </tbody>

            </table>
        
        </div>
    
    </div>

</div>

<div id="contenedor4" style = 'height: 50px; width: 800px; border: 1px solid rgba(255, 255, 255); margin-top: 5px;'>

    <div style = 'height: 50px; width: 300px; float: left; margin-left: 15px;'>
        
        <h4>Observaciones:</h4>
        <p><?php  echo $factura[0]['comentarios']; ?></p>
    
    </div>

    <div style = 'height: 50px; width: 300px; float: right; margin-left: 15px;'>
        <div style = 'margin-left: 50px;'>

            <h4>Referencia:</h4>
            <p><?php  echo $factura[0]['referencia']; ?></p>
       
        </div>
   </div>

</div>

<!-- rgba(255, 255, 255) -->
<div id="contenedor5" style = 'position: absolute; bottom: 0px !important; left: 0; right: 0; height: 200px; width: 800px; border: 1px solid rgba(255, 255, 255)'>
    
   
    <div style = 'margin-top: 10px;'>  
     
        <footer>
            <!-- 	<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Outthebox-cr, <br> info@Outthebox-cr.com</p>
            <h4 class="label_gracias">¡Gracias por su compra!</h4>	
            <br> -->
            <p style=" text-align: center;"><img src="/bot_aceptacion_docs_produccion/factura/logo.png" width="90%"
                    height="150px"></p>

        </footer>
       
    </div> 
 

</div>

    


</body>

</html>