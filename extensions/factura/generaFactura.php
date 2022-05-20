<?php


	require_once('../extensions/pdf/vendor/autoload.php');
		// require_once('./extensions/pdf/vendor/autoload.php');
// require_once('../pdf/vendor/autoload.php');

	use Dompdf\Dompdf;

class generarPdf{


	 function crearPDF($clave, $idcliente){

		ob_start();
				  
			$id = $clave;		
		  include('factura_plantilla.php');

				    $html = ob_get_clean();
				    

					// instantiate and use the dompdf class
					$dompdf = new Dompdf();

					$dompdf->loadHTML($html);

					// (Optional) Setup the paper size and orientation
					$dompdf->setPaper('letter', 'portrait');

					// Render the HTML as PDF
					$dompdf->render();


					$content = $dompdf->output();
					file_put_contents('../apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf', $content);
					// Guardar facturas en un directorio
					$ipremoteserver='backup.midigitalsat.com';
        			$urlremoteserver='https://backup.midigitalsat.com';

        			$username = 'root';
					$password = 'Heriberto9109';
					// Make our connection
					$connection = ssh2_connect($ipremoteserver, 6060);

					// Authenticate
					if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

					// Create our SFTP resource
					if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
					$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf';
					$localfile = '../apiHacienda/clientes/'.$idcliente.'/facturaPDF/Documento'.$clave.'.pdf';
					// download all the files
		

					 ssh2_scp_send($connection, $localfile, $remotefile, 0644);
					 ssh2_exec($connection, 'exit');

		              // ssh2_exec($connection, 'exit');
					// if (!empty($files)) {
					//   foreach ($files as $file) {
					//     if ($file != '.' && $file != '..') {
					     

					//     }
					//   }
					// }




					ob_end_clean();

					// Output the generated PDF to Browser
					// $dompdf->stream('factura.pdf',array('Attachment'=>0));
					// exit;


		}




}
	
	

?>