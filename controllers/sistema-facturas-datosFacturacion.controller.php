<?php

 
class DatosFacturacionController{


    static public function ctrCargarDatosFacturacion($empresa){

        $table = "empresas.tbl_clientes";    

         $response = DatosFacturacionModel::MdlCargarDatosFacturacion($table, $empresa); 
 
         return $response;

    }

    static public function ctrAgregarDatosFacturacion($empresa, $pin, $usuario, $contrasena, $documento){

        $token = DatosFacturacionController::ctrValidarToken($usuario, $contrasena);

        $token = json_decode($token);

        if(!array_key_exists('access_token', $token)){

            $response = 'Error tk';

            return $response;
        }


            $ruta_destino_archivo = "../apiHacienda/clientes/".$empresa."/key/produccion.p12";
            $ruta = "../apiHacienda/clientes/".$empresa."/key/produccion.p12";
            $archivo = $documento;

            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);

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
    
            $remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$empresa.'/key/produccion.p12';
            $localfile = '../apiHacienda/clientes/'.$empresa.'/key/produccion.p12';
    
            ssh2_scp_send($connection, $localfile, $remotefile, 0644);

            $data = array("ruta_12" => $ruta,
            "pin_p12" => $pin,
            "usuario_token" => $usuario,		                 
            "contrasena_token" => $contrasena,
            "idtbl_clientes" => $empresa
              );

              $table = "empresas.tbl_clientes";

           $response = DatosFacturacionModel::MdlAgregarDatosFacturacion($table, $data);

        return $response;

    } 


    static public function ctrAgregarDatosFacturacionPruebas($empresa, $pin, $usuario, $contrasena, $documento){

        $token = DatosFacturacionController::ctrValidarTokenPrueba($usuario, $contrasena);

        $token = json_decode($token);

        // echo("<script>console.log('DATOS TOKEN ".json_encode($token).  "');</script>");
        // echo("<script>console.log('DATOS TOKEN ".$usuario.  "');</script>");
        // echo("<script>console.log('DATOS TOKEN ".$contrasena.  "');</script>");

        if(!array_key_exists('access_token', $token)){

            $response = 'Error tk';

            return $response;
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

        $ruta_destino_archivo = "../apiHacienda/clientes/".$empresa."/key/prueba.p12";
        $ruta = "../apiHacienda/clientes/".$empresa."/key/prueba.p12";
        $archivo2 = $documento;

        $archivo_ok = move_uploaded_file($archivo2['tmp_name'], $ruta_destino_archivo);

        $remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$empresa.'/key/prueba.p12';
        $localfile = '../apiHacienda/clientes/'.$empresa.'/key/prueba.p12';

        ssh2_scp_send($connection, $localfile, $remotefile, 0644);

        $data = array("ruta_12" => $ruta,
        "pin_p12" => $pin,
        "usuario_token" => $usuario,		                 
        "contrasena_token" => $contrasena,
        "idtbl_clientes" => $empresa
          );

          $table = "empresas.tbl_clientes";

       $response = DatosFacturacionModel::MdlAgregarDatosFacturacionP($table, $data);

    return $response;

} 


static public function ctrValidarToken($usuario, $contrasena){
 
    $data = "client_id=api-prod&username=".$usuario."&password=".urlencode($contrasena)."&grant_type=password";

    $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut/protocol/openid-connect/token"); 

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
      
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");    

       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       
       curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      
       $response = curl_exec($ch);
      
       curl_close($ch);

    return $response;

}



static public function ctrValidarTokenPrueba($usuario, $contrasena){
   
    $data = "client_id=api-stag&username=".$usuario."&password=".urlencode($contrasena)."&grant_type=password"; 
      
    $ch = curl_init("https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token"); //ambiente pruebas
      
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
   
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

    $response = curl_exec($ch);

    // $response_info = curl_getinfo($ch);

    curl_close($ch);

    return $response;

}

}