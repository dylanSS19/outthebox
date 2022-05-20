<?php

	include('../extensions/pdf/vendor/autoload.php');
// require_once('../pdf/vendor/autoload.php');

	use Dompdf\Dompdf;

class generarFctura{


	 function crearpdf($id_factura){

		ob_start();
				  
	
		  include('factura_plantilla_2.php');

				    $html = ob_get_clean();
				    

					// instantiate and use the dompdf class
					$dompdf = new Dompdf();

					$dompdf->loadHTML($html);

					// (Optional) Setup the paper size and orientation
					$dompdf->setPaper('letter', 'portrait');

					// Render the HTML as PDF
					$dompdf->render();

					$content = $dompdf->output();
					// file_put_contents('../apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf', $content);
					//Guardar facturas en un directorio

					ob_end_clean();

					// Output the generated PDF to Browser
					$dompdf->stream('factura.pdf',array('Attachment'=>0));
					exit;


		}


}
	
	

?>