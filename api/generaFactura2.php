<?php

 
	require_once('/bot_aceptacion_docs_produccion/pdf/vendor/autoload.php');
// require_once('../pdf/vendor/autoload.php');

	use Dompdf\Dompdf;

class generarPdf{


	 function crearPDF($clave, $idcliente){

		ob_start();
				  
			$id = $clave;		
		  include('machoteFactura.php');
		  


				    $html = ob_get_clean();
				
				 /*   return $html;

				    exit();*/

					// instantiate and use the dompdf class
					$dompdf = new Dompdf();

					$dompdf->loadHTML($html);

					// (Optional) Setup the paper size and orientation
					$dompdf->setPaper('letter', 'portrait');

					// Render the HTML as PDF
					$dompdf->render();
					
         if (file_exists('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf')) {
             unlink('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf');
    
} 

					$content = $dompdf->output();
					file_put_contents('/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf', $content);
			
					if(ob_get_length() > 0) {
    					ob_end_clean();
    				};


}
}
	
	

?>