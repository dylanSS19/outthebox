<?php

class MerchandisingClientesController{

/*=============================================
    =        AGREGAR CLIENTES              =
    =============================================*/

    static public function ctrAgregarClientes($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = MerchandisingClientesModel::MdlAgregarCliente($table, $id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud); 



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
        
        ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$id_empresa."/FotoProductos/".$response,0777,true);
           
        // ssh2_scp_send($connection, $localfile, $remotefile, 0644);
         
        ssh2_exec($connection, 'exit');
        
  
        mkdir("apiHacienda/clientes/".$id_empresa."/FotoProductos/".$response, 0777,true);
           
        $group="www-data";
        $owner ="www-data";
        exec("chown -R ".$owner.":".$group." /var/www/outthebox/apiHacienda/clientes/".$id_empresa."/FotoProductos/".$response);
        exec("chown -R ".$owner.":".$group." /mnt/blockstorage/html/private/apiHacienda/clientes/".$id_empresa."/FotoProductos/".$response);


        return $response;


    } 

}