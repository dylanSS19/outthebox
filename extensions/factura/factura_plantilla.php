<?php 

 // $factura = HomeController::CargarDatosFactura($clave);
$factura = api_facturacioncontroller::CargarDatosFactura($clave);


$cantCeros = 10;
$num_factura = substr(str_repeat(0, $cantCeros).$factura[0][0], - $cantCeros);


// $Detallefactura = HomeController::CargarDetalleFactura($num_factura);
$Detallefactura = api_facturacioncontroller::CargarDetalleFactura($num_factura);

if($factura[0]['codigo_moneda'] == "CRC"){

$simMoneda = '¢';


}else{

$simMoneda = '$';

}

$id_empresa = $factura[0]['id_compania'];
// echo '<pre>'; print_r($id_empresa); echo '</pre>';
// $DatosEmpresa = HomeController::CargarDatosEmpresa($id_empresa);
$DatosEmpresa = api_facturacioncontroller::CargarDatosEmpresa($id_empresa);

if($DatosEmpresa[0]["logo"] == ""){

}else{


$logo = $DatosEmpresa[0]["logo"];


}



if($factura[0]['tipo_documento'] == '01'){

	$tipoDocumento = 'Factura Electronica';

}elseif($factura[0]['tipo_documento'] == '02') {

	$tipoDocumento = 'Nota Debito Electronica';

}elseif($factura[0]['tipo_documento'] == '03') {

	$tipoDocumento = 'Nota Crédito Electronica';

}elseif($factura[0]['tipo_documento'] == '04') {

	$tipoDocumento = 'Tiquete Electronico';

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
    <link rel="stylesheet" href="../extensions/factura/style.css">
</head>
<body>
<!-- <img class="anulada" src="../extensions/factura/img/anulado.png" alt="Anulada"> -->

<div id="page_pdf">
	<table id="factura_head">
		<tr>
 
			<?php 

				if($DatosEmpresa[0]["logo"] == ""){

				}else{ 	?>

			<td class="logo_factura">

				<div>
				
				<img src='<?php echo $logo ?>' style="width: 150px; height: 100px;">
			
				</div>

			</td>

			<?php } ?>
		
			<td class="info_empresa">
				<div>				
 
   			<span class="h2"><?php  echo $tipoDocumento; ?></span>
   					<p><?php  echo $DatosEmpresa[0]["nombre_ficticio"]; ?></p>
   					<p>Cédula: <?php  echo $DatosEmpresa[0]["cedula"]; ?></p>
					<p>Dirección: <?php  echo $DatosEmpresa[0]["direccion"]; ?></p>
					<p>Teléfono: +(506) <?php  echo $DatosEmpresa[0]["telefono"]; ?></p>
					<p>Email: <?php  echo $DatosEmpresa[0]["email"]; ?></p>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3"><?php  echo $tipoDocumento; ?></span>
					<!-- <p>No Factura: <strong><?php  echo $factura[0][7]; ?></strong></p>					 -->
					<p>Fecha: <?php  echo date("Y-m-d", strtotime($factura[0]['fecha_factura'])); ?></p>
					<p>Hora: <?php  echo date("h:i:s", strtotime($factura[0]['fecha_factura'])); ?></p>
					<p>Código Actividad: <?php  echo $factura[0]['codigo_actividad']; ?></p>
					<p>Condición Venta: <?php  echo $condVenta; ?></p>
					<p>Plazo Crédito: <?php  echo $factura[0]['plazo_credito']; ?></p>
					<p>Moneda:<?php echo ' '.$factura[0]['codigo_moneda'].' / Tipo Cambio: '.$factura[0]['tipo_cambio']; ?></p>
					<!-- <p>Sucursal: Jorge Pérez Hernández Cabrera</p> -->
				</div>
			</td>
		</tr>
	</table>


	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="rounds">
					<span class="h3">Información Documento</span>
					<table class="datos_cliente">
						
						<tr>
							<td><label>Clave:</label><p><?php  echo $factura[0]['clave']; ?></p></td>									
						</tr>

						<tr>
							<td><label>Consecutivo:</label> <p><?php  echo $factura[0]['consecutivo']; ?></p></td>					
						</tr>

						<tr>
							<td><label>Cédula:</label><p><?php  echo $factura[0]['cedula_cliente']; ?></p></td>								
						</tr>

						<tr>
							<td><label>Nombre:</label> <p><?php  echo $factura[0]['nombre_cliente']; ?></p></td>					
						</tr>

						<tr>
							<td><label>Correo:</label><p><?php  echo $factura[0]['correo_cliente']; ?></p></td>				
						</tr>

					</table>
				</div>
			</td>

		</tr>
	</table>


	<table id="factura_detalle">


			<thead>
				<tr>
					<th class="textcenter" style="width: 20px;">Cantidad</th>
					<th class="textcenter" style="width: 40px;">Descripción</th>
					<th class="textcenter" style="width: 40px;">Precio Unitario</th>
					<th class="textcenter" style="width: 40px;">Descuento</th>
					<th class="textcenter" style="width: 40px;">IVA</th>
					<th class="textcenter" style="width: 40px;"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">


<?php 

	 foreach ($Detallefactura as $key => $value) {
	 
	 		echo '<tr>
					<td class="textcenter">'.$value[4].'</td>
					<td class="textcenter">'.$value[3].'</td>
					<td class="textcenter">'.$formatted = $simMoneda.' ' . number_format( (float) $value[5], 2, '.', ',' ).'</td>
					<td class="textcenter">'.$formatted = $simMoneda.' ' . number_format( (float) $value[7], 2, '.', ',' ).'</td>
					<td class="textcenter">'.$formatted = $simMoneda.' ' . number_format( (float) $value[8], 2, '.', ',' ).'</td>
					<td class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[9], 2, '.', ',' ).'</td>
				</tr>';

	}

 ?>
<tr>
					<td class="textcenter"></td>
					<td class="textcenter"></td>
					<td class="textcenter">---- Última Linea  ----</td>
					<td class="textcenter"></td>
					<td class="textcenter"></td>
					<td class="textright"></td>
</tr>
			</tbody>

			<tfoot id="detalle_totales">
			
				<tr>
					<td colspan="5" class="textright"><span> </span></td>
					<td class="textright"><span> </span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['subtotal'], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>DESCUENTO</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['descuento'], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>IVA</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['impuesto'], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>TOTAL</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0]['total'], 2, '.', ',' ); ?></span></td>
				</tr>
		</tfoot>

	</table>


	<div>

		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Outthebox-cr, <br> info@Outthebox-cr.com</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>	
		<br>
		<p style=" text-align: center;"><img  src="../public/SistemaFacturacion/logo.jpg" width="200px" height="100px"></p>
		
	</div>

</div>

</body>
</html>