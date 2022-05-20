<?php

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {


    case 'GET':

// compra = 317
// venta = 318

date_default_timezone_set('America/Costa_Rica');

       
        $hoy = date("d/m/Y H:i:s");
      


    header("HTTP/1.1 200 OK");
    
    echo '{"Success": "true", "Fecha": "'.$hoy.'"}';




}

