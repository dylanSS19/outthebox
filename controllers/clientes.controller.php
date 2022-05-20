
<?php
   
 
class ClientesController{

/*=============================================
=                   CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarClientesEditar($item, $value){

       $table = "empresas.tbl_clientes"; 	
      
		$response = ClientesModel::MdlCargarClientesEditar($table, $item, $value);	

		return $response;


	} 

 
/*=============================================
=                 CARGAR CLIENTES      =
=============================================*/

	static public function ctrCargarClientes($empresa){

        $table1 = "empresas.tbl_clientes";
		$table2 = "empresas.tbl_empresas_usuarios";

		$response = ClientesModel::MdlCargarClientes($table1, $table2, $empresa);

		return $response;

	} 

/*=============================================
=            SEARCH PROVINCIAS      =
=============================================*/

static public function ctrBUSCAR_PROVINCIAS(){

       $table = "empresas.provincias"; 	

		$response = ClientesModel::Mdlprovincias($table);		

		return $response;

	}
 
/*=============================================
=            SEARCH CANTONES      =
=============================================*/
static public function ctrBUSCAR_CANTONES($item,$value){

       $table = "`upee-cr`.cantones"; 	

		$response = ClientesModel::Mdlcantones($table, $item, $value);		

		return $response;

	}

/*=============================================
=            SEARCH DISTRITOS      =
=============================================*/
static public function ctrBUSCAR_Distritos($item,$value,$value2){

       $table = "`upee-cr`.distritos"; 	

		$response = ClientesModel::Mdldistritos($table, $item, $value,$value2);		

		return $response;

	}
 
	/*=============================================
=           CARGAR CEDULAS     =
=============================================*/
static public function ctrCargarCedulas($item,$value){

       $table = "empresas.view_clientes"; 	

		$response = ClientesModel::MdlCargarCedulas($table, $item, $value);		

		return $response;

	}


	/*=============================================
=           CARGAR Usuarios     =
=============================================*/
static public function ctrCargarUsuarios($idusuario){

       $table = "empresas.tbluser_2"; 	

		$response = ClientesModel::MdlCargarUsuarios($table, $idusuario);		

		return $response;

	}


/*=============================================
=                 CARGAR PLANES      =
=============================================*/

static public function ctrCargarPlanes(){

	$table = "empresas.tbl_modulos_outthebox";

	$response = ClientesModel::MdlCargarPlanes($table);

	return $response;

} 



static public function ctrEditarCLiente(){

	if(isset($_POST["editarcedulacliente"])) {

	

		   	$table = "empresas.tbl_clientes";
	   

		              
		   $data = array("idtbl_clientes" => $_POST["editar_idempresa"],
		                  "nombre_ficticio" => $_POST["editarnombrecontactocliente"],
		                  "nombre" => $_POST["editarnombrecliente"],	                 
		                  "tipo_personeria" => $_POST["editartipocedulacliente"],
		                  "cedula" => $_POST["editarcedulacliente"],
		                  "direccion" => $_POST["editarubicacioncliente"],
		                  "regimen" => $_POST["editarregimencliente"],
		                  "telefono" => $_POST["editartelefonocliente"],
		              	  "email" => $_POST["editarcorreocliente"],
		              	  "provincia" => $_POST["editarprovinciaempresas"],
		              	  "canton" => $_POST["editarcantonempresas"], 
		              	  "distrito" =>$_POST["editardistritoempresas"],
		              	  "pin_p12" => $_POST["editarpin_p12"],
		              	  "pin_p12_prueba" => $_POST["editarpin_p12_prueba"],
		              	   "usuario_token" => $_POST["editarusuario_token"],
		              	  "contrasena_token" => $_POST["editarcontrasena_token"], 
		              	  "usuario_token_prueba" =>$_POST["editarusuario_token_prueba"],
		              	  "contrasena_token_prueba" => $_POST["editarcontrasena_token_prueba"],
		              	  "privilegio" => "WEB",
		              	  "ruta_12" => "../apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/produccion.p12",
		              	  "ruta_12_prueba" => "../apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/prueba.p12");
		               

		    $response = ClientesModel::MdlEditarClientes($table , $data);
		   
		
		if(isset($_POST["editardocumento_p12"])) {

$ruta_destino_archivo = "./apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/produccion.p12";
$ruta1 = "../apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/produccion.p12";
$archivo = $_FILES['editardocumento_p12'];

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

$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$_POST["editar_idempresa"].'/key/produccion.p12';
$localfile = './apiHacienda/clientes/'.$_POST["editar_idempresa"].'/key/produccion.p12';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);


$ruta_destino_archivo2 = "./apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/prueba.p12";
$ruta2 = "../apiHacienda/clientes/".$_POST["editar_idempresa"]."/key/prueba.p12";
$archivo2 = $_FILES['editardocumento_p12_prueba'];

$archivo_ok = move_uploaded_file($archivo2['tmp_name'], $ruta_destino_archivo2);

$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$_POST["editar_idempresa"].'/key/prueba.p12';
$localfile = './apiHacienda/clientes/'.$_POST["editar_idempresa"].'/key/prueba.p12';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

}





	    if($response == "OK"){

		    	echo '<script>

		

				 Swal.fire(
      "Actualización exitosa!",
      "¡El cliente a sido actualizado correctamente",
      "success"
    ).then((result) => {

	window.location = "clientes";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡El cliente no a sido actualizado correctamente",
      "error"
    ).then((result) => {

	window.location = "clientes";
    })		

				

			</script>'	;


		   }




	}


}


static public function ctrAgregarCLiente(){

	if(isset($_POST["servicio_contratado"])) {

if($_POST["agregarusuario"] == ""){

$response = $_POST["Usuarioempresas"];

$table = "empresas.tbluser_2";

$data = array("privilegios" => "UsuarioOTB",
"idUsuario" => $_POST["Usuarioempresas"]);

$cambiarPrivilegio = ClientesModel::MdlEditarPrivilegiosUsuario($table , $data);

}else{


$table = "empresas.tbluser_2";

		   $data = array("nombre" => $_POST["agregarusuario"],
		                  "pass" => $_POST["agregarcontrasena"],
		                  "privilegios" => "UsuarioOTB",		                 
		                  "status" => "Disponible",
		                  "usuario" => $_POST["agregarnombrecontactocliente"],
		                  "lat" => $_POST["agregarlatitudcliente"],
		                  "lon" => $_POST["agregarlongitudcliente"],
		                  "nombre_perfil" => $_POST["agregarnombre"],
						  "correo" => $_POST["agregarcorreocliente"]);


 		 $response = ClientesModel::MdlAgregarUsuario($table , $data);

}


$idUsuario = $response;

		   	
$table = "empresas.tbl_clientes";
 

   //Carácteres para la contraseña
 $chars = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
  $count = mb_strlen($chars);
   $password = "";
   //Reconstruimos la contraseña segun la longitud que se quiera
    for ($i = 0; $i < 20; $i++) {

        $index = Rand(0, $count - 1);
        $password .= mb_substr($chars, $index, 1);

    }

   $user = "";
       for ($i = 0; $i < 20; $i++) {

        $index = Rand(0, $count - 1);
        $user .= mb_substr($chars, $index, 1);

    }

 
$dataEmpresas = array("nombre_ficticio" => $_POST["agregarnombrecliente"],
		                  "nombre" => $_POST["agregarnombrecontactocliente"],
		                  "cedula" => $_POST["agregarcedulacliente"],		                 
		                  "telefono" => $_POST["agregartelefonocliente"],
						  "direccion" => $_POST["agregarubicacioncliente"]
		                  );

$tablaEmpresas = "empresas.tbl_empresas";

$idempresa = ClientesModel::MdlAgregarEmpresa($tablaEmpresas , $dataEmpresas);

// $enviarcorreo = api_facturacioncontroller::CorreoDatosEmpresa($user, $password, $idempresa, $_POST["agregarcorreocliente"], $_POST["agregarnombrecontactocliente"]);

		//  $data = array("codigo" => $_POST["agregarcodigocliente"],
		//                   "nombre_ficticio" => $_POST["agregarnombrecliente"],
		//                   "nombre" => $_POST["agregarnombrecontactocliente"],		                 
		//                   "tipo_personeria" => $_POST["agregartipocedulacliente"],
		//                   "cedula" => $_POST["agregarcedulacliente"],
		//                   "direccion" => $_POST["agregarubicacioncliente"],
		//                   "regimen" => $_POST["agregarregimencliente"],
		//               	  "telefono" => $_POST["agregartelefonocliente"],
		//               	  "email" => $_POST["agregarcorreocliente"],
		//               	  "provincia" => $_POST["agregarprovinciaempresas"],
		//               	  "canton" => $_POST["agregarcantonempresas"], 
		//               	  "distrito" =>$_POST["agregardistritoempresas"],
		//               	  "latitud" => $_POST["agregarlatitudcliente"],
		//               	  "longitud" => $_POST["agregarlongitudcliente"],
		//               	  "id_empresa" => $idempresa,
		//               	  "id_usuario" => $response,
		//               	  "activo" =>"Si",
		//               	  "pin_p12" => $_POST["pin_p12"],
		//               	  "pin_p12_prueba" => $_POST["pin_p12_prueba"],
		//               	  "usuario_token" => $_POST["usuario_token"],
		//               	  "contrasena_token" => $_POST["contrasena_token"],
		//               	  "usuario_facturacion" => $user,
		//               	  "contrasena_facturacion" => $password,
 		// 			  "usuario_token_prueba" => $_POST["usuario_token_prueba"],
		//               	  "contrasena_token_prueba" => $_POST["contrasena_token_prueba"],
		//               	  "privilegio" => "WEB"
		//               	  );
		              

							$data = array("codigo" => $_POST["agregarcodigocliente"],
							"nombre_ficticio" => $_POST["agregarnombrecliente"],
							"nombre" => $_POST["agregarnombrecontactocliente"],		                 
							"tipo_personeria" => $_POST["agregartipocedulacliente"],
							"cedula" => $_POST["agregarcedulacliente"],
							"direccion" => $_POST["agregarubicacioncliente"],
							"regimen" => $_POST["agregarregimencliente"],
							  "telefono" => $_POST["agregartelefonocliente"],
							  "email" => $_POST["agregarcorreocliente"],
							  "provincia" => $_POST["agregarprovinciaempresas"],
							  "canton" => $_POST["agregarcantonempresas"], 
							  "distrito" =>$_POST["agregardistritoempresas"],
							  "latitud" => $_POST["agregarlatitudcliente"],
							  "longitud" => $_POST["agregarlongitudcliente"],
							  "id_empresa" => $idempresa,
							  "id_usuario" => $response,
							  "activo" =>"Si",							  							 							 					  
							  "usuario_facturacion" => $user,
							  "contrasena_facturacion" => $password,						 							  
							  "privilegio" => '["Administrativo Web"]',
							  "serviciosInteres" => json_encode($_POST["servicio_contratado"])
							  );

		    $response = ClientesModel::MdlAgregarCLiente($table , $data);
		  
			$updateempresa = ClientesModel::MdlEditarEmpresa($tablaEmpresas , $response, $idempresa);
	
$tablaUsuarioEmpresa = "tbl_empresas_usuarios";

$datos = array("id_usuario" => $idUsuario,
		                  "id_empresa" => $response,
		                  "Nombre" => $_POST["agregarnombrecliente"],
		                  "modulos" => '["31","32"]');
  

$empresasUsuarios = ClientesModel::MdlAgregarUsuarioxEmpresa($tablaUsuarioEmpresa , $datos);


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

ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response,0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/Documentos",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/DocumentosFirmados",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/facturaPDF",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/key",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/img",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/DocumentosRespuesta",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/FacturasGastos",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/ComprobantePago",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/FotoTrabajadores",0777,true);
ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$response."/SAOValidator",0777,true);

 
 // ssh2_scp_send($connection, $localfile, $remotefile, 0644);
 

ssh2_exec($connection, 'exit');

	/*=============================================
	= CREAR TABLAS ULTIMO CONSECUTIVO          =
	=============================================*/

// $Creartabla = ClientesModel::MdlAgregarUltimoConseFacturaEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseTiqueteEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseNcreditoEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseNdebitoEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseFacturaCompraEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseMensReceptorEmpresa($idempresa);
	/*=============================================
	= CREAR TABLAS ULTIMO CONSECUTIVO  AMBIENTE PRUEBAS =
	=============================================*/
// $Creartabla = ClientesModel::MdlAgregarUltimoConseFacturaPEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseTiquetePEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseNcreditoPEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseNdebitoPEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseFacturaCompraPEmpresa($response);
// $Creartabla = ClientesModel::MdlAgregarUltimoConseMensReceptorPempresa($idempresa);

mkdir("apiHacienda/clientes/".$response, 0777,true);
mkdir("apiHacienda/clientes/".$response."/Documentos", 0777,true);
mkdir("apiHacienda/clientes/".$response."/DocumentosFirmados", 0777,true);
mkdir("apiHacienda/clientes/".$response."/facturaPDF", 0777,true);
mkdir("apiHacienda/clientes/".$response."/key", 0777,true);
mkdir("apiHacienda/clientes/".$response."/img", 0777,true);
mkdir("apiHacienda/clientes/".$response."/DocumentosRespuesta", 0777,true);
mkdir("apiHacienda/clientes/".$response."/FacturasGastos", 0777,true);
mkdir("apiHacienda/clientes/".$response."/ComprobantePago", 0777,true);
mkdir("apiHacienda/clientes/".$response."/FotoTrabajadores", 0777,true);
mkdir("apiHacienda/clientes/".$response."/SAOValidator", 0777,true);


$group="www-data";
$owner ="www-data";
exec("chown -R ".$owner.":".$group." /var/www/outthebox/apiHacienda/clientes/".$response);
exec("chown -R ".$owner.":".$group." /mnt/blockstorage/html/private/apiHacienda/clientes/".$response);


$ruta_destino_archivo = "./apiHacienda/clientes/".$response."/key/produccion.p12";
$ruta1 = "../apiHacienda/clientes/".$response."/key/produccion.p12";
$archivo = $_FILES['documento_p12'];

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

$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$response.'/key/produccion.p12';
$localfile = './apiHacienda/clientes/'.$response.'/key/produccion.p12';


 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

 

$ruta_destino_archivo2 = "0";
$ruta2 = "0";

if($_FILES['documento_p12_prueba']['tmp_name'] != ""){

$ruta_destino_archivo2 = "./apiHacienda/clientes/".$response."/key/prueba.p12";
$ruta2 = "../apiHacienda/clientes/".$response."/key/prueba.p12";
$archivo2 = $_FILES['documento_p12_prueba'];

$archivo_ok = move_uploaded_file($archivo2['tmp_name'], $ruta_destino_archivo2);

$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$response.'/key/prueba.p12';
$localfile = './apiHacienda/clientes/'.$response.'/key/prueba.p12';

 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

}


/*=============================================
=           INSERTAR FOTOS           =
=============================================*/


			if(isset($_FILES["logoempresa"]["tmp_name"]) && $_FILES["logoempresa"]["tmp_name"]!=""){



				 list($weight,$height) = getimagesize($_FILES["logoempresa"]["tmp_name"]);

				$newWeight = 500;
				$newHeight = 500;

				/*=============================================
				=        ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS     =
				=============================================*/
		
				if($_FILES["logoempresa"]["type"] == "image/jpeg"){


				/*=============================================
				=        SAVE IMAGE IN DIRECTORY JPG         =
				=============================================*/

				$route = "apiHacienda/clientes/".$response."/img/logo.jpg";

				$source = imagecreatefromjpeg($_FILES["logoempresa"]["tmp_name"]);

				$destination = imagecreatetruecolor($newWeight, $newHeight);

				//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

				imagejpeg($destination, $route);


			$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$response.'/img/logo.jpg';
			$localfile = './apiHacienda/clientes/'.$response.'/img/logo.jpg';


			 ssh2_scp_send($connection, $localfile, $remotefile, 0644);

			 $ruta3 = '../apiHacienda/clientes/'.$response.'/img/logo.jpg';
				
				}

			if($_FILES["logoempresa"]["type"] == "image/png"){

				/*=============================================
				=        SAVE IMAGE IN DIRECTORY PNG        =
				=============================================*/
						$route = "apiHacienda/clientes/".$response."/img/logo.png";

						$source = imagecreatefrompng($_FILES["logoempresa"]["tmp_name"]);						

						$destination = imagecreatetruecolor($newWeight, $newHeight);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

						imagepng($destination, $route);


				$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$response.'/img/logo.png';
				$localfile = './apiHacienda/clientes/'.$response.'/img/logo.png';

				 ssh2_scp_send($connection, $localfile, $remotefile, 0644);


				 $ruta3 = '../apiHacienda/clientes/'.$response.'/img/logo.png';

					}
				}
	  
	$table = "empresas.tbl_clientes";



$cargarruta = ClientesModel::MdlAgregarRuta($table, $response, $ruta1, $ruta2, $ruta3);

  if($response){

   			$table = "`upee-cr`.tbl_clientes";
	   
		    $data = array("cedula" => $_POST["agregarcedulacliente"]);		              

		    $response = ClientesModel::MdlActualizarCodigoCLiente($table , $data);

  }

	    if($response == "ok"){

		    	echo '<script>

		

				 Swal.fire(
      "Ingreso exitoso!",
      "¡El cliente a sido guardado correctamente",
      "success"
    ).then((result) => {

    	window.location = "clientes";
	
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Ingreso fallido!",
      "¡El cliente no a sido guardado correctamente1",
      "error"
    ).then((result) => {

	window.location = "clientes";
    })		

				

			</script>'	;


		   }




	} 


}


static public function ctrPruebaPivilegios(){

	if(isset($_POST["editarservicio_contratado"])) {
	
		$privilegio = $_POST["editarservicio_contratado"];

		echo '<pre>'; print_r($datos); echo '</pre>';

		echo '<pre>'; print_r($privilegio); echo '</pre>';
	
	}


}



}
