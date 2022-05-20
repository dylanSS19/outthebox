<?php
 
ini_set('memory_limit', '1024M');
ini_set('user_agent', 'My-Application/2.5');

define('ROOT', '/bot_aceptacion_docs_produccion/');

require_once(ROOT . "enviarCorreo2.php");

  
$data = json_decode(file_get_contents('php://input'), true);


   $idEmpresa = $data["id_compania"];

   $Clave_Factura = $data["clave"];

   $receptor = $data["receptor"];


  

//ENVIA CORREO


$envioCorreo = ClsenviarCorreo::EnviarCorreo($Clave_Factura, $idEmpresa,$receptor);
/*echo '<pre>'; print_r($envioCorreo); echo '</pre>';

exit();*/



header("HTTP/1.1 200 OK");
header('Content-Type: application/json');
echo '{"success": "true","estado":"'. $envioCorreo.'"}';

            






   


  
