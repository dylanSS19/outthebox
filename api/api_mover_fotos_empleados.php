<?php

ini_set('memory_limit', '1024M');
ini_set('user_agent', 'My-Application/2.5');


  
$data = json_decode(file_get_contents('php://input'), true);


   $idEmpresa = $data["idEmpresa"];

   $idEmpleado = $data["idEmpleado"];

  

//ENVIA ARCHIVOS


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




 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_hoja_delincuencia.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_hoja_delincuencia.jpg';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);
 /**/

$localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia2_atras.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia2_atras.jpg';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

 /**/

 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia2_frente.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia2_frente.jpg';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

/**/

 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia1_atras.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia1_atras.jpg';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

 /**/

 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia1_frente.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_licencia1_frente.jpg';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);


 /**/

 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_cedula_atras.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_cedula_atras.jpg';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

 /**/

 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_cedula_frente.jpg';


$remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_cedula_frente.jpg';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);



 $localfile  = 'apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_empleado.jpg';


 $remotefile = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$idEmpresa.'/FotoTrabajadores/'.$idEmpleado.'/foto_empleado.jpg';
 
 
  ssh2_scp_send($connection, $localfile, $remotefile, 0644);

/*echo '<pre>'; print_r($envioCorreo); echo '</pre>';

exit();
*/



header("HTTP/1.1 200 OK");
header('Content-Type: application/json');
echo '{"success": "true","estado":"OK"}';
