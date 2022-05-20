<?php

ini_set('memory_limit', '1024M');
ini_set('user_agent', 'My-Application/2.5');


  
$data = json_decode(file_get_contents('php://input'), true);


   $idEmpresa = $data["idEmpresa"];

   $idEmpleado = $data["idEmpleado"];


$origen ="/mnt/blockstorage/html/private/apiHacienda/clientes/".$idEmpresa."/FotoTrabajadores/".$idEmpleado."";

$destino="/mnt/blockstorage/html/public/fotos/".$idEmpleado."";


exec("cp -R ".$origen." " .$destino. "");