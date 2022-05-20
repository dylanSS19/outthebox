<?php 


 
$factura = ReporteFacturasController::ctrCargarFacturaXid($id_factura);


// $cantCeros = 10;
// $num_factura = substr(str_repeat(0, $cantCeros).$factura[0][0], - $cantCeros);


$Detallefactura = ReporteFacturasController::ctrDetalleFactura($id_factura);

if($factura[0][16] == "CRC"){

$simMoneda = '¢';


}else{

$simMoneda = '$';

}

// $id_empresa = $factura[0][1];
// $DatosEmpresa = api_facturacioncontroller::CargarDatosEmpresa($id_empresa);
// $logo = $DatosEmpresa[0]["logo"];


if($factura[0][9] == '01'){

	$tipoDocumento = 'Factura Electronica';

}elseif($factura[0][9] == '02') {

	$tipoDocumento = 'Nota Debito Electronica';

}elseif($factura[0][9] == '03') {

	$tipoDocumento = 'Nota Credito Electronica';

}elseif($factura[0][9] == '04') {

	$tipoDocumento = 'Tiquete Electronico';

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
			<td class="logo_factura">

				<div>
					<img src='<?php $logo; ?>'>
				</div>

			</td>
			<td class="info_empresa">
				<div>				

   			<span class="h2"><?php  echo $tipoDocumento; ?></span>
   					<p><?php  echo $DatosEmpresa[0]["nombre_ficticio"]; ?></p>
   					<p><?php  echo $DatosEmpresa[0]["cedula"]; ?></p>
					<p><?php  echo $DatosEmpresa[0]["direccion"]; ?></p>
					<p>Teléfono: +(506) <?php  echo $DatosEmpresa[0]["telefono"]; ?></p>
					<p>Email: <?php  echo $DatosEmpresa[0]["email"]; ?></p>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No Factura: <strong><?php  echo $factura[0][7]; ?></strong></p>					
					<p>Fecha: <?php  echo date("Y-m-d", strtotime($factura[0][4])); ?></p>
					<p>Hora: <?php  echo date("h:i:s", strtotime($factura[0][4])); ?></p>
					<!-- <p>Sucursal: Jorge Pérez Hernández Cabrera</p> -->
				</div>
			</td>
		</tr>
	</table>


	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="rounds">
					<span class="h3">Información Factura</span>
					<table class="datos_cliente">
						
						<tr>
							<td><label>Clave:</label><p><?php  echo $factura[0][8]; ?></p></td>									
						</tr>

						<tr>
							<td><label>Consecutivo:</label> <p><?php  echo $factura[0][7]; ?></p></td>					
						</tr>

						<tr>
							<td><label>cédula:</label><p><?php  echo $factura[0][12]; ?></p></td>								
						</tr>

						<tr>
							<td><label>Nombre:</label> <p><?php  echo $factura[0][13]; ?></p></td>					
						</tr>

						<tr>
							<td><label>Correo:</label><p><?php  echo $factura[0][14]; ?></p></td>				
						</tr>

					</table>
				</div>
			</td>

		</tr>
	</table>


	<table id="factura_detalle">


			<thead>
				<tr>
					<th width="15px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px">Descuento</th>
					<th class="textright" width="150px">IVA</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">


<?php 


	 foreach ($Detallefactura as $key => $value) {
	 
	 		echo '<tr>
					<td class="textcenter">'.$value[4].'</td>
					<td>'.$value[3].'</td>
					<td class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[5], 2, '.', ',' ).'</td>
					<td class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[7], 2, '.', ',' ).'</td>
					<td class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[8], 2, '.', ',' ).'</td>
					<td class="textright">'.$formatted = $simMoneda.' ' . number_format( (float) $value[9], 2, '.', ',' ).'</td>
				</tr>';
	 
	}


 ?>

			</tbody>

			<tfoot id="detalle_totales">
			
				<tr>
					<td colspan="5" class="textright"><span> </span></td>
					<td class="textright"><span> </span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0][17], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>DESCUENTO</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0][18], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>IVA</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0][19], 2, '.', ',' ); ?></span></td>
				</tr>

				<tr>
					<td colspan="5" class="textright"><span>TOTAL</span></td>
					<td class="textright"><span><?php  echo $formatted = $simMoneda.' '. number_format( (float) $factura[0][21], 2, '.', ',' ); ?></span></td>
				</tr>
		</tfoot>

	</table>


	<div>

		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Dylan Salazar Salguero, <br>(+506) 86365851  y dsalazar@digitalsat-cr.com</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>	
		<br>
		<p style=" text-align: center;"><img  src="../public/SistemaFacturacion/logo.jpg" width="200px" height="100px"></p>
		
	</div>

</div>

</body>
</html>