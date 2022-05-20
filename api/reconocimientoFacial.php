<?php

// require 'autoload.php'; 
require '../extensions/AWS/vendor/autoload.php';


use Aws\Rekognition\RekognitionClient;
use Aws\Credentials\Credentials;

header('Acceess-Control-Allow-Origin: *');

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
        
       
        break;

    case 'POST':
           
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (api_AWSReconocimeinto::is_json(json_encode($data["fileContent"])) == "true"){

           
            switch ($data["fileContent"]["datosFuncion"]["numero"]) {

                case '1':
       
                    $ResultComparacion = api_AWSReconocimeinto::AWSCompararRostros($data);
       
                    break;

                case '2':
       
                    $Creacion = api_AWSReconocimeinto::CrearCarpetaEmpleado($data);
       
                    break;

                    case '3':
       
                    $leerTxt = api_AWSReconocimeinto::AWSCapturarTexto($data);
           
                    break;

                    case '4':
              
       
                    $leerTxt = api_AWSReconocimeinto::AWSReconocimientoObjetos($data);
               
                    break;
                    
            }
           
            
        }else{
            header("HTTP/1.1 403 Forbidden");

            echo '{"Success": "false", "reason": "CREDENCIALES INCORRECTAS"}';
      
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
            
        // $foto1 = "/var/www/outthebox/apiHacienda/clientes/2505/FotoTrabajadores/457/foto_cedula_frente.jpg";
        // $foto2 = "/var/www/outthebox/fotosControlAsistencia/457.jpg";
        

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
        
          
        // echo '<pre>'; print_r($result["FaceMatches"][0]["Similarity"]); echo '</pre>';        
 
        unlink($foto1);

        if(!isset($result["FaceMatches"][0]["Similarity"])){

            // echo '<pre>'; print_r($result); echo '</pre>'; 
            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Estado":"Imcompatible","Compatibilidad":"0.0"}';

        }else{

            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Estado":"Compatible","Compatibilidad":"'.$result["FaceMatches"][0]["Similarity"].'"}';

        }
     
        } catch (S3Exception $e) {
            // Catch an S3 specific exception.

            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getMessage().'""}';
            exit();
            // echo $e->getMessage();

           } catch (AwsException $e) {
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            
            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getAwsErrorType().'""}';
            exit();
            // echo $e->getAwsRequestId() . "\n";
            // echo $e->getAwsErrorType() . "\n";
            // echo $e->getAwsErrorCode() . "\n";

            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            // var_dump($e->toArray());
           }
        
      
        //   return $result;
      
      }


      public static function AWSCapturarTexto($Datos) {
   
 
        try {

            $credentials = new Credentials('AKIASHEWYAFKISRUX7XS', 'JBqc2iKLLiQAd4BIUkeCrHvAWbBptMCQsc4mvYRI');
        
            $rekognitionClient = RekognitionClient::factory(array(
                'region'	=> "us-west-2",
                'version'	=> 'latest',
            'credentials' => $credentials
        ));
         
        $foto1 = $Datos["fileContent"]["datosRutas"]["ruta1"];
        if( $foto1 == ""){

            $foto1 = $Datos["fileContent"]["datosRutas"]["ruta2"];

            if($foto1 == ""){

                echo '{"Success": "false", "Error":"Ingrese una ruta para continuar con el proceso."}';
                exit();

            }
        }
        
        // $foto2 = $Datos["fileContent"]["datosRutas"]["ruta2"];
            
        // $foto1 = "./fotoHerick2.jpeg";
        // $foto1 = "./fotoHerick3.jpeg";
        // $foto1 = "./fotoHerick4.jpeg";
        // $foto1 = "./fotoHerick5.jpeg";
        // $foto1 = "../fotosControlAsistencia/fotoHerick6.jpeg";
        // $foto1 = "../fotosControlAsistencia/fotoHerick7.jpeg";

        // $foto1 = "./cedula don carlos.jpeg";

        
        // $foto2 = "/var/www/outthebox/fotosControlAsistencia/457.jpg";
        
if(!file_exists($foto1)){

    echo '{"Success": "false", "Error":"Ruta del archivo no encontrada."}';
    exit();
}


        $data = file_get_contents($foto1);
        // $data2 = file_get_contents($foto2);
                
        $args = [
        'Image' => [
        'Bytes' => $data
        ]];
        
        $result = $rekognitionClient->detectText($args);
        // $result = json_encode($result);   
        // echo '<pre>'; print_r($result["TextDetections"]); echo '</pre>';  
        $nombre1 = "";
        $apellido1 = "";
        $cedula1 = "";
        $nacionalidad = "";

        for ($i = 0; $i < count($result["TextDetections"]); $i++) {

            $pos = strripos($result["TextDetections"][$i]["DetectedText"], "RESIDENTE");

                if ($pos === false) {

                    $nacionalidad = "N";

                }else{

                    $nacionalidad = "R";

                    break;
                }


        }



        for ($i = 0; $i < count($result["TextDetections"]); $i++) {

            

                //    echo '<pre>'; print_r($result["TextDetections"][$i]["DetectedText"]); echo '</pre>';  
               

                // $pos = strripos($result["TextDetections"][$i]["DetectedText"], "RESIDENTE");
                if ($nacionalidad == "N") {
                   
                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "Nombre:");
                

                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $nombre = $result["TextDetections"][$i]["DetectedText"];
                        $nombre =  str_replace(array("Nombre:", "Nombre"), '', $nombre);
                        $nombre = trim($nombre);
        
        
        
                        if($nombre != ""){
        
                           $nombre1 =  $nombre;
        
        
                        }
                        
                    }

                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "1° Apellido:");
        
        
                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $apellido = $result["TextDetections"][$i]["DetectedText"];
                        $apellido =  str_replace(array("Apellido:", "1° Apellido:","1°"), '', $apellido);
                        $apellido = trim($apellido);
        
        
        
                        if($apellido != ""){
        
                           $apellido1 =  $apellido;
        
        
                        }
                        
                    }
 
                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "2° Apellido:");
        
        
                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $apellido = $result["TextDetections"][$i]["DetectedText"];
                        $apellido =  str_replace(array("Apellido:", "2° Apellido:","2°"), '', $apellido);
                        $apellido = trim($apellido);
        
        
        
                        if($apellido != ""){
        
                           $apellido1 =  $apellido1 ." ". $apellido;
        
        
                        }
                        
                    }
                   

                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "Cedula");
        
        
                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $cedula = $result["TextDetections"][3]["DetectedText"];
                        // echo "dato encontrado (".$cedula.")";
                //    echo '<pre>'; print_r($result["TextDetections"][3]["DetectedText"]); echo '</pre>';  

                        // $cedula =  str_replace(array("Cedula de Identidad", "Cedula"), '', $cedula);
                        $cedula = trim($cedula);
        
        
        
                        if($cedula != ""){
        
                           $cedula1 =  $cedula;
        
        
                        }
                        
                    }

                }else{

                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "Nombre:");
                

                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $nombre = $result["TextDetections"][$i]["DetectedText"];
                        $nombre =  str_replace(array("Nombre:", "Nombre"), '', $nombre);
                        $nombre = trim($nombre);
        
        
        
                        if($nombre != ""){
        
                           $nombre1 =  $nombre;
        
        
                        }
                        
                    }
                    
                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "Apellidos:");
        
        
                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $apellido = $result["TextDetections"][$i]["DetectedText"];
                        $apellido =  str_replace(array("Apellidos::", "Apellidos:"), '', $apellido);
                        $apellido = trim($apellido);
        
        
        
                        if($apellido != ""){
        
                           $apellido1 =  $apellido;
        
        
                        }
                        
                    }

                    $pos = strripos($result["TextDetections"][$i]["DetectedText"], "Documento No.:");
        
        
                    if ($pos === false) {
                        // echo "Sorry, we did not find (".$result["TextDetections"][$i]["DetectedText"].") in (Nombre)";
                    }else{
        
                        // echo "dato encontrado (".$result["TextDetections"][$i]["DetectedText"].")";
                        $cedula = $result["TextDetections"][$i]["DetectedText"];
                        $cedula =  str_replace(array("Documento No.:", "Documento No."), '', $cedula);
                        $cedula = trim($cedula);
        
        
        
                        if($cedula != ""){
        
                           $cedula1 =  $cedula;
        
        
                        }
                        
                    }

                    


                }


               


        }

        unlink($foto1);

        if($nombre1 == "" && $apellido1 == "" && $cedula1 == ""){

            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Error":"Formato de cédula no legible"}';


        }else{
        
            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Nombre":"'.$nombre1.'","Apellidos":"'.$apellido1.'", "Cédula":"'.$cedula1.'"}';


        }
        

        // echo '<pre>'; print_r($result); echo '</pre>';        
 
        // exit();

       
     
        } catch (S3Exception $e) {
            // Catch an S3 specific exception.

            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getMessage().'""}';
            exit();
            // echo $e->getMessage();

           } catch (AwsException $e) {
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            
            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getAwsErrorType().'""}';
            exit();
            // echo $e->getAwsRequestId() . "\n";
            // echo $e->getAwsErrorType() . "\n";
            // echo $e->getAwsErrorCode() . "\n";

            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            // var_dump($e->toArray());
           }
        
      
        //   return $result;
      
      }



      public static function CrearCarpetaEmpleado($Datos) {

        $directorio = "../apiHacienda/clientes/".$Datos["fileContent"]["datosFuncion"]["empresa"]."/FotoTrabajadores/".$Datos["fileContent"]["datosFuncion"]["idEmpleado"];

        if (!file_exists($directorio)) {

            mkdir("../apiHacienda/clientes/".$Datos["fileContent"]["datosFuncion"]["empresa"]."/FotoTrabajadores/".$Datos["fileContent"]["datosFuncion"]["idEmpleado"], 0777,true);
        
        }

            
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
            
            ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$Datos["fileContent"]["datosFuncion"]["empresa"]."/FotoTrabajadores/".$Datos["fileContent"]["datosFuncion"]["idEmpleado"],0777,true);

            // ssh2_scp_send($connection, $localfile, $remotefile, 0644);
            $group="www-data";
            $owner ="www-data";
            exec("chown -R ".$owner.":".$group." /var/www/outthebox/apiHacienda/clientes/".$Datos["fileContent"]["datosFuncion"]["empresa"]."/FotoTrabajadores/".$Datos["fileContent"]["datosFuncion"]["idEmpleado"]);
            exec("chown -R ".$owner.":".$group." /mnt/blockstorage/html/private/apiHacienda/clientes/".$Datos["fileContent"]["datosFuncion"]["empresa"]."/FotoTrabajadores/".$Datos["fileContent"]["datosFuncion"]["idEmpleado"]);
       
            ssh2_exec($connection, 'exit');

            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Estado":"Creado exitosamente"}';

      }


      public static function AWSReconocimientoObjetos($Datos){
   
 
        try {

            $credentials = new Credentials('AKIASHEWYAFKISRUX7XS', 'JBqc2iKLLiQAd4BIUkeCrHvAWbBptMCQsc4mvYRI');
        
            $rekognitionClient = RekognitionClient::factory(array(
                'region'	=> "us-east-1",
                'version'	=> 'latest',
            'credentials' => $credentials
        ));
         
        $foto1 = $Datos["fileContent"]["datosRutas"]["ruta1"];
        // $foto2 = $Datos["fileContent"]["datosRutas"]["ruta2"];
            
        // $foto1 = "/var/www/outthebox/apiHacienda/clientes/2505/FotoTrabajadores/457/foto_cedula_frente.jpg";
        // $foto2 = "/var/www/outthebox/fotosControlAsistencia/457.jpg";
        

        $data = file_get_contents($foto1);
        // echo '<pre>'; print_r("hola"); echo '</pre>';        

        // $data2 = file_get_contents($foto2);
                
        // $args = [
        // 'Image' => [
        // 'Bytes' => $data
        // ]];
        
        // $result = $rekognitionClient->recognizeCelebrities($args);
        
        $result = $rekognitionClient->detectCustomLabels([
            'Image' => [ // REQUIRED
                'Bytes' => $data,
                // 'S3Object' => [
                //     'Bucket' => 's3://fotosprueba1/pruebas/',
                //     'Name' => 'fotosprueba1',
                //     'Version' => 'latest',
                // ],
            ],
            'MaxResults' => 1000,
            'MinConfidence' => 0,
            'ProjectVersionArn' => 'arn:aws:rekognition:us-east-1:152787485012:project/flowers_1/version/flowers_1.2022-02-04T11.48.36/1643996916852', // REQUIRED
        ]);
        
        
        echo '<pre>'; print_r($result); echo '</pre>';        
        exit();
        // unlink($foto1);

        if(!isset($result["FaceMatches"][0]["Similarity"])){

            // echo '<pre>'; print_r($result); echo '</pre>'; 
            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Estado":"Imcompatible","Compatibilidad":"0.0"}';

        }else{

            header("HTTP/1.1 200 OK");
            echo '{"Success": "true", "Estado":"Compatible","Compatibilidad":"'.$result["FaceMatches"][0]["Similarity"].'"}';

        }
     
        } catch (S3Exception $e) {
            // Catch an S3 specific exception.

            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getMessage().'""}';
            exit();
            // echo $e->getMessage();

           } catch (AwsException $e) {
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            
            header("HTTP/1.1 400 Bad Request");
            echo '{"Success": "False", "Error":"'.$e->getAwsErrorType().'""}';
            exit();
            // echo $e->getAwsRequestId() . "\n";
            // echo $e->getAwsErrorType() . "\n";
            // echo $e->getAwsErrorCode() . "\n";

            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            // var_dump($e->toArray());
           }
        
      
        //   return $result;
      
      }



      public static function is_json($string,$return_data = false) {

        $data = json_decode($string);
          return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
     }

}




   






