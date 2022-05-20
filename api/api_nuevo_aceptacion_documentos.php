<?php

ini_set('memory_limit', '1024M');

$servername = "midigitalsat.com";
$username = "admin";
$password = "Heriberto9109";

try {
$conn = new PDO("mysql:host=$servername;dbname=empresas", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
$data = json_decode(file_get_contents('php://input'), true);


            $idEmpresa = $data["id_compania"];
            $Clave_Factura = $data["clave"];

 /*           echo "idEmpresa:" .$idEmpresa . "         Clave_Factura:" .$Clave_Factura;

            exit();
*/

            $stmt = $conn->prepare("SELECT usuario_token,contrasena_token,usuario_token_prueba,contrasena_token_prueba FROM empresas.tbl_clientes where idtbl_clientes = '$idEmpresa'");

                              $stmt -> execute();

                        $response =  $stmt ->fetch(\PDO::FETCH_ASSOC);

                        $stmt =null;

               



            $data = "client_id=api-prod&username=".$response["usuario_token"]."&password=".urlencode($response["contrasena_token"])."&grant_type=password"; 



            $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 
            //$ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token"); //ambiente pruebas
            //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");

            // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // curl_setopt($ch, CURLOPT_USERPWD, "163928b0-fc2b-485d-9cc9-de6c3b853d5f:ba58b332fad04e0"); 
            //Your credentials goes here

                  //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
                  //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
                  //a true, obtendremos una respuesta de la url, en otro caso,
                  //true si es correcto, false si no lo es
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  // Se define el tipo de metodo de envio de datos
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
                  //establecemos el verbo http que queremos utilizar para la petición
                  
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                  //enviamos el array data

                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                  
                  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                  //obtenemos la respuesta
                  $response = curl_exec($ch);
                  // Se cierra el recurso CURL y se liberan los recursos del sistema
                  curl_close($ch);

                     $token = json_decode($response);

                  $token =  $token->{'access_token'};

          $authorization = "Authorization: Bearer ".$token."";

          /*echo $authorization;

                  exit();*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.comprobanteselectronicos.go.cr/recepcion/v1/recepcion/".$Clave_Factura."",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json', $authorization
  ),
));


if(curl_exec($curl) === false)
{
    $responseapi . curl_error($curl);
}
else
{
    $responseapi = curl_exec($curl);
}

//$responseapi = curl_exec($curl);

/*$responseapi= json_decode($responseapi);
echo '<pre>'; print_r($responseapi); echo '</pre>';*/


curl_close($curl);     
	
$responseapi= json_decode($responseapi);

                  if(isset($responseapi->{'ind-estado'})){  

                 
 				 $fecha= date("Y-m-d H:i:s", strtotime($responseapi->{"fecha"}));
                 $estado=ucfirst($responseapi->{"ind-estado"});
                 $xml_string=base64_decode($responseapi->{"respuesta-xml"});

             

                  $json = json_encode(simplexml_load_string($xml_string, "SimpleXMLElement", LIBXML_NOCDATA));

                  $json= json_decode($json, true);

                   $msg=$json["DetalleMensaje"];

              /* */
              $msg= str_replace("\"","",$msg);
              $msg= str_replace ("\n", "", $msg);
             

              if(empty($msg)){
                $msg="";

              }else{
                 $msg=  stripslashes($msg);
              }

        
header("HTTP/1.1 200 OK");
header('Content-Type: application/json');
echo '{"success": "true","Fecha":"'. $fecha.'", "Clave":"'.$Clave_Factura.'", "Estado":"'.$estado.'", "Comentarios": "'.$msg.'"}';

                }else{
                		echo "NO EXISTE";
                }
              
               
             
                 

              



  } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
}
    





   


  
