<?php

require '../extensions/AWS/vendor/autoload.php';
// require  '../extensions/PHPMailer-master/src/Exception.php' ;


use Aws\Rekognition\RekognitionClient;
use Aws\Credentials\Credentials;

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
       
       
        break;

    case 'POST':
           
        $data = json_decode(file_get_contents('php://input'), true);
        if (api_AWSReconocimeinto::is_json(json_encode($data["fileContent"])) == "true"){

            $ResultComparacion = api_AWSReconocimeinto::AWSCompararRostros($data);
           
            header("HTTP/1.1 200 OK");
            echo '{"success": "true", "Clave":"'.$ResultComparacion.'"}';
            
        }else{
            header("HTTP/1.1 403 Forbidden");

            echo '{"success": "false", "reason": "CREDENCIALES INCORRECTAS"}';
      
        }

        break;
           
    case 'PUT':
    


        break;

}


class api_AWSReconocimeinto{

    public static function AWSCompararRostros($Datos) {
   
 
        try {


            $credentials = new Credentials('AKIASHEWYAFKISRUX7XS', 'JBqc2iKLLiQAd4BIUkeCrHvAWbBptMCQsc4mvYRI');
        
            $rekognitionClient = RekognitionClient::factory(array(
                'region'	=> "us-west-2",
                'version'	=> 'latest',
            'credentials' => $credentials
        ));
        
        $foto1 = $Datos["fileContent"]["datosRutas"]["ruta1"];
        $foto2 = $Datos["fileContent"]["datosRutas"]["ruta2"];
            
        $data = file_get_contents($foto1);
        $data2 = file_get_contents($foto2);
                
        // $args = [
        // 'Image' => [
        // 'Bytes' => $data
        // ]];
        
        // $result = $rekognitionClient->recognizeCelebrities($args);
        
        $result = $rekognitionClient->compareFaces([
            'QualityFilter' => 'HIGH',
            'SimilarityThreshold' => 80,
            'SourceImage' => [ // REQUIRED
                'Bytes' => $data
                
            ],
            'TargetImage' => [ // REQUIRED
                'Bytes' => $data2
                
            ],
        ]);
        
        // echo '<pre>'; print_r($result); echo '</pre>';        
        
           } catch (S3Exception $e) {
            // Catch an S3 specific exception.

            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "FALSE", "Error":"'.$e->getMessage().'""}';
            exit();
            // echo $e->getMessage();

           } catch (AwsException $e) {
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            
            header("HTTP/1.1 400 Bad Request");
            echo '{"success": "FALSE", "Error":"'.$e->getAwsErrorType().'""}';
            exit();
            // echo $e->getAwsRequestId() . "\n";
            // echo $e->getAwsErrorType() . "\n";
            // echo $e->getAwsErrorCode() . "\n";

            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            // var_dump($e->toArray());
           }
        
      
          return $result;
      
      }

      public static function is_json($string,$return_data = false) {

        $data = json_decode($string);
          return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
     }

}




   






