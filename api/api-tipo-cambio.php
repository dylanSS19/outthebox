<?php

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {


    case 'GET':

// compra = 317
// venta = 318

date_default_timezone_set('America/Costa_Rica');

        // $Indicador = $_GET['Indicador'];

        $Indicador1 = "317";
        $Indicador2 = "318";
       
        $hoy = date("d/m/Y");
        $hoy = date("d/m/Y", strtotime($hoy));
        
        $fechaInicio = $_GET['Fecha'];
        $fechaInicioVal = date("d/m/Y", strtotime($_GET['Fecha']));    
        $fechaFin =  $_GET['Fecha'];


        $valFecha =  api_TipoCambiocontroller::validateDate($fechaInicio);

        // if ($fechaInicioVal > $hoy) {

        //     header("HTTP/1.1 404 NOT FOUND");

        //     echo '{"Success": "false", "Status":"Error, no se puede realizar busquedas mayores a la fecha actual."}';

        //     exit();
        // }

        if($valFecha == 0){

            header("HTTP/1.1 404 NOT FOUND");

            echo '{"Success": "false", "Status":"Error en Formato de la fecha(dd/mm/yyyy)."}';

            exit();
        }



     $tipoCambioVenta = api_TipoCambiocontroller::ConsultarTipoCambioCompra($Indicador1, $fechaInicio, $fechaFin);

     $tipoCambioCompra = api_TipoCambiocontroller::ConsultarTipoCambioVenta($Indicador2, $fechaInicio, $fechaFin);


     $xmlparser = xml_parser_create();

     xml_parse_into_struct($xmlparser, $tipoCambioVenta, $values1);
    
     xml_parser_free($xmlparser);

     $xmlparser = xml_parser_create();

     xml_parse_into_struct($xmlparser, $tipoCambioCompra, $values2);
    
     xml_parser_free($xmlparser);

if(isset($values1[35]["value"]) || isset($values2[35]["value"])){
    
    header("HTTP/1.1 200 OK");
    
    echo '{"Success": "true", "Venta": "'.number_format($values2[35]["value"] , 5).'","Compra": "'.number_format($values1[35]["value"] , 5).'"}';

break;

}else{

    header("HTTP/1.1 404 NOT FOUND");

    echo '{"Success": "false", "Status":"Error en proceso, validar formato de la fecha (dd/mm/yyyy) o validar que no sea mayor a la fecha actual."}';
   

break;


}

}

class api_TipoCambiocontroller{

public function ConsultarTipoCambioCompra($Indicador, $fechaInicio, $fechaFin){
  
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gee.bccr.fi.cr/Indicadores/Suscripciones/WS/wsindicadoreseconomicos.asmx/ObtenerIndicadoresEconomicos?Indicador='.$Indicador.'&FechaInicio='.$fechaInicio.'&FechaFinal='.$fechaFin.'&Nombre=Heriberto%20Castro%20F&SubNiveles=N&CorreoElectronico=heri9109@gmail.com&Token=COEARBIP1O',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);

       return $response;       
           
 }

 public function ConsultarTipoCambioVenta($Indicador, $fechaInicio, $fechaFin){
  
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gee.bccr.fi.cr/Indicadores/Suscripciones/WS/wsindicadoreseconomicos.asmx/ObtenerIndicadoresEconomicos?Indicador='.$Indicador.'&FechaInicio='.$fechaInicio.'&FechaFinal='.$fechaFin.'&Nombre=Heriberto%20Castro%20F&SubNiveles=N&CorreoElectronico=heri9109@gmail.com&Token=COEARBIP1O',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);

       return $response;       
           
 }


public function validateDate($date, $format = 'd/m/Y'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


}