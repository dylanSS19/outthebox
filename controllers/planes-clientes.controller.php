<?php

class PlanesClientesController{


	static public function ctrCargarClientes(){

       $table = "empresas.view_clientes"; 	
      
		$response = PlanesClientesModel::MdlCargarClientes($table);	

		return $response;


	} 
 

    static public function ctrCargarCategorias($categoria){

        $table = "empresas.tbl_categoria_planes"; 	
       
         $response = PlanesClientesModel::MdlCargarCategorias($table, $categoria);	
 
         return $response;
 
 
     } 


     static public function ctrCargarDatosCategoria($categoria){

        $table = "empresas.tbl_categoria_planes"; 	
       
         $response = PlanesClientesModel::MdlCargarDatosCategoria($table, $categoria);	
 
         return $response;
 
 
     } 

     static public function ctrAgregarPrivilegio($privilegio, $Cliente){

        $table = "empresas.tbl_clientes"; 	
       
         $response = PlanesClientesModel::MdlAgregarPrivilegio($table, $privilegio, $Cliente);	
 
         return $response;
 
     } 

     static public function ctrAgregarPlanesClientes($clientes, $fecha_fin, $fecha_extencion, $idPlan, $nombrePlan, $precioPlan, $cantDocumentos, $total_pagar, $estado, $Clave, $RutFoto){

        $table = "empresas.tbl_clientes_planes"; 	
       
         $response = PlanesClientesModel::MdlAgregarPlanesClientes($table, $clientes, $fecha_fin, $fecha_extencion, $idPlan, $nombrePlan, $precioPlan, $cantDocumentos, $total_pagar, $estado, $Clave, $RutFoto);	
 
         return $response;
 
 
     } 

     static public function ctrEditarPlanesClientes($Editarclientes, $EditardiaPago, $EditardiaMax, $EditarplanSelect, $EditarcatSelect, $Editartotal){

        $table = "empresas.tbl_clientes_planes"; 	
       
         $response = PlanesClientesModel::MdlEditarPlanesClientes($table, $Editarclientes, $EditardiaPago, $EditardiaMax, $EditarplanSelect, $EditarcatSelect, $Editartotal);	
 
         return $response;
 
 
     } 
 
     static public function ctrCargarPlanesClientes($idEmpresa){

        $table = "empresas.tbl_clientes_planes"; 

         $response = PlanesClientesModel::MdlCargarPlanesClientes($table, $idEmpresa);	
 
         return $response;
 
 
     } 


     static public function ctrCargarDatosPaquetes($PackSelect, $IdEmp){

        $table1 = "empresas.tbl_clientes_planes"; 
        $table2 = "empresas.tbl_modulos_outthebox"; 
        $table3 = "empresas.tbl_categoria_planes";  

         $response = PlanesClientesModel::MdlCargarDatosPaquetes($table1, $table2, $table3, $PackSelect, $IdEmp);	
 
         return $response;
 
 
     } 

     static public function ctrElimianrPaquete($deletePack){

        $table = "empresas.tbl_clientes_planes"; 

        
         $response = PlanesClientesModel::MdlElimianrPaquete($table, $deletePack);	
 
         return $response;
 
 
     } 

     static public function ctrCargarPaquetes($IdEmp){

        $table = "empresas.tbl_categoria_planes"; 

         $response = PlanesClientesModel::MdlCargarPaquetes($table, $IdEmp);	
 
         return $response;
 
 
     } 

     static public function ctrCargarPaquetesID($idPaquete){

        $table = "empresas.tbl_categoria_planes"; 

         $response = PlanesClientesModel::MdlCargarPaquetesID($table, $idPaquete);	
 
         return $response;
 
 
     }

     

     static public function ctrCargarDatosPago($tipoPago){

        $table = "empresas.tbl_datosPago"; 

         $response = PlanesClientesModel::MdlCargarDatosPago($table, $tipoPago);	
 
         return $response;
 
 
     }
 

     static public function ctrIngresarComprobante($FotoComprobante, $DatosEmpresa, $Clave){



        //ASIGNAMOS PERMISOS A LA CARPETA PARA INGRESAR ELEMENTOS
        $group="www-data";
        $owner ="www-data";
        exec("chown -R ".$owner.":".$group." /mnt/blockstorage/html/private/apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago");
        $directorio = "../apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave;

        if (!file_exists($directorio)) {

            mkdir($directorio, 0777,true);
        
        }
        if($FotoComprobante["type"] == "image/jpeg"){

            $ruta_destino_archivo = "../apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave."/comprobante.jpg";


        }else{

            $ruta_destino_archivo = "../apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave."/comprobante.png";

        }

        
        
        $archivo = $FotoComprobante;
        
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
        
         $directorioRemoto = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave;

        if (!file_exists($directorioRemoto)) {

         ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave,0777,true);
  
        }

        if($FotoComprobante["type"] == "image/jpeg"){

            $remotefile  = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave."/comprobante.jpg";

        }else{


            $remotefile  = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$DatosEmpresa."/ComprobantePago/".$Clave."/comprobante.png";

        }


         //$remotefile  = "/mnt/blockstorage/html/private/apiHacienda/clientes/'.$DatosEmpresa.'/ComprobantePago/produccion.p12";
         $localfile = $ruta_destino_archivo;
                
          ssh2_scp_send($connection, $localfile, $remotefile, 0644);
 
          return $ruta_destino_archivo;
 
     }



}