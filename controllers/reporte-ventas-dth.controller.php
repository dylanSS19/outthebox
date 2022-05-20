<?php

class ControladorVentasDth
{

    /*=============================================
    = CARGAR COORDINADRES POR VENDEDOR       =
    =============================================*/

    public static function ctrCargarConvenios()
    {

        $table = "callcenter.tbl_convenio_pagos";

        $response = reporteVentasDthModel::MdlCargarConvenios($table);

        return $response;

    }

/*=============================================
= CARGAR COORDINADRES POR VENDEDOR       =
=============================================*/

    public static function ctrCargarVentas($id_usuario)
    {

        $table = " digitalsat.tblvendedores";

        $response = reporteVentasDthModel::MdlCargarCoordinador($table, $id_usuario);

        return $response;

    }

/*=============================================
= CARGAR totales de las ventas =
=============================================*/

    public static function ctrCargarDatosVentas($startDate, $endDate, $coordinador)
    {

        $table = "callcenter.tbl_fechas";
        $table1 = "digitalsat.tbl_codigo_validacion";

        $response = reporteVentasDthModel::MdlCargarVentas($table, $table1, $startDate, $endDate, $coordinador);

        return $response;

    }

    /*=============================================
    = CARGAR DETALLE de las ventas  X COORDINADOR =
    =============================================*/

    public static function ctrCargarDatosDetalleVentasXGrupo($item, $value)
    {

        $table1 = "digitalsat.tblvendedores";
        $table2 = "digitalsat.tbl_coordinadores";
        $table3 = "empresas.tbluser_2";
        $table4 = "digitalsat.tbl_ventas_calle_dth";
        $table5 = "digitalsat.tbl_informe_internet";
        $table6 = "callcenter.tblinforme";
        $table7 = "masivos.tbl_activaciones";
        $table8 = "digitalsat.tblinforme_gpon";
        $table9 = "digitalsat.tbl_zonas";

        $response = reporteVentasDthModel::MdlcargarDatosDetalleVentasXGrupo($table1, $table2, $table3, $table4, $table5, $table6, $table7, $table8, $table9, $item, $value);

        return $response;

    }

/*=============================================
= CARGAR totales de las ventas dth=
=============================================*/

    public static function ctrCargarVentasDTH($usuario, $startDate, $endDate, $vendedor)
    {

        $table1 = "digitalsat.tblvendedores";

        $table4 = "digitalsat.tbl_ventas_calle_dth";

        $response = reporteVentasDthModel::MdlCargarVentasDTH($table1, $table4, $usuario, $startDate, $endDate, $vendedor);

        return $response;

    }

/*=============================================
= CARGAR totales de las ventas dth x coordinador =
=============================================*/

    public static function ctrCargarVentasDTHCoordinador($startDate, $endDate, $coordinador)
    {

        $table1 = "digitalsat.tbl_codigo_validacion";

        $response = reporteVentasDthModel::MdlCargarVentasDTHCoordinador($table1, $startDate, $endDate, $coordinador);

        return $response;

    }

    /*=============================================
    = CARGAR totales de las ventas internet=
    =============================================*/

    public static function ctrCargarVentasInternet($usuario, $startDate, $endDate, $vendedor)
    {

        $table1 = "digitalsat.tblvendedores";

        $table5 = "digitalsat.tbl_informe_internet";

        $response = reporteVentasDthModel::MdlCargarVentasInternet($table1, $table5, $usuario, $startDate, $endDate, $vendedor);

        return $response;

    }

/*=============================================
= CARGAR totales de las ventas internet=
=============================================*/

    public static function ctrCargarVentasInternetcoordinador($startDate, $endDate, $coordinador)
    {

        $table1 = "digitalsat.tbl_codigo_validacion";

        $response = reporteVentasDthModel::MdlCargarVentasInternetcoordinador($table1, $startDate, $endDate, $coordinador);

        return $response;

    }

    /*=============================================
    = CARGAR totales de las ventas pospago=
    =============================================*/

    public static function ctrCargarVentasPospago($usuario, $startDate, $endDate, $vendedor)
    {

        $table1 = "digitalsat.tblvendedores";

        $table6 = "callcenter.tblinforme";

        $response = reporteVentasDthModel::MdlCargarVentaspospago($table1, $table6, $usuario, $startDate, $endDate, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR totales de las ventas pospago por coordinador=
    =============================================*/

    public static function ctrCargarVentasPospagocoordinador($startDate, $endDate, $coordinador)
    {

        $table1 = "digitalsat.tbl_codigo_validacion";

        $response = reporteVentasDthModel::MdlCargarVentasPospagocoordinador($table1, $startDate, $endDate, $coordinador);

        return $response;

    }

    /*=============================================
    = CARGAR totales de las ventas activaciones=
    =============================================*/

    public static function ctrCargarActivaciones($usuario, $startDate, $endDate, $vendedor)
    {

        $table1 = "digitalsat.tblvendedores";

        $table7 = "digitalsat.tblinforme_gpon";

        $response = reporteVentasDthModel::MdlCargarVentaactivaciones($table1, $table7, $usuario, $startDate, $endDate, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR totales de las ventas activaciones=
    =============================================*/
    public static function ctrCargarVentaGPONcoordinadores($startDate, $endDate, $coordinador)
    {

        $table1 = "digitalsat.tbl_codigo_validacion";
        $response = reporteVentasDthModel::MdlCargarVentaGPONcoordinadores($table1, $startDate, $endDate, $coordinador);

        return $response;

    }

    /*=============================================
    = CARGAR METAS DTH=
    =============================================*/

    public static function ctrmetasdth($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "empresas.tbl_metas_dth";
        $table2 = "digitalsat.tbl_zonas";
        $table3 = "digitalsat.tblvendedores";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlmetasdth($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    =CARGAR VENTYAS DTH 1 PLAY =
    =============================================*/

    public static function ctrventas_DTH_metas($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "digitalsat.tbl_ventas_calle_dth";
        $table2 = "digitalsat.tblvendedores";
        $table3 = "digitalsat.tbl_zonas";
        $table4 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_DTH_metas($table, $table2, $table3, $table4, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH 2 PLAY=
    =============================================*/

    public static function ctrventas_2play($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');
        $table = "digitalsat.tbl_ventas_calle_dth";
        $table2 = "digitalsat.tblinforme";
        $table3 = "digitalsat.tblplanes";
        $table4 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_2play($table, $table2, $table3, $table4, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH 3 PLAY=
    =============================================*/

    public static function ctrventas_3play($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "digitalsat.tbl_ventas_calle_dth";
        $table2 = "digitalsat.tblinforme";
        $table3 = "digitalsat.tblplanes";
        $table4 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_3play($table, $table2, $table3, $table4, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH INTERNET INDIVIDUAL=
    =============================================*/

    public static function ctrventas_internet_individual($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "digitalsat.tbl_informe_internet";
        $table2 = "digitalsat.tblvendedores";
        $table3 = "digitalsat.tbl_zonas";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_internet_individual($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH 3 PLAY=
    =============================================*/

    public static function ctrventas_cambio_plan($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = " digitalsat.tblinforme";
        $table2 = " digitalsat.tblinforme2";
        $table3 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_cambio_plan($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH 3 PLAY=
    =============================================*/

    public static function ctrventas_instalaciones_proyecto($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = " digitalsat.tblinforme";
        $table2 = " digitalsat.tblinforme2";
        $table3 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_instalaciones_proyecto($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH 3 PLAY=
    =============================================*/

    public static function ctrventas_instalaciones_propias($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = " digitalsat.tblinforme";
        $table2 = " digitalsat.tblinforme2";
        $table3 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_instalaciones_propias($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH reparaciones=
    =============================================*/

    public static function ctrventas_reparaciones($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = " digitalsat.tblinforme";
        $table2 = " digitalsat.tblinforme2";
        $table3 = "empresas.tbluser_2";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_reparaciones($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH POSPAGO=
    =============================================*/

    public static function ctrventas_pospago($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "callcenter.tblinforme";

        $table2 = "digitalsat.tblvendedores";

        $table3 = "digitalsat.tbl_zonas";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_pospago($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

    /*=============================================
    = CARGAR VENTYAS DTH GPON=
    =============================================*/

    public static function ctrventas_GPON($vendedor)
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "digitalsat.tblinforme_gpon";

        $table2 = "digitalsat.tblvendedores";

        $table3 = "digitalsat.tbl_zonas";

        $today = date('Y-m-d');

        $firstday = date('Y-m-01', strtotime($today));

        $lastday = date('Y-m-t', strtotime($today));

        $response = reporteVentasDthModel::Mdlventas_gpon($table, $table2, $table3, $firstday, $lastday, $vendedor);

        return $response;

    }

/*=============================================
=                 CARGAR COORDINADRES    =
=============================================*/

    public static function ctrCargarCoordinadores()
    {

        $table = "digitalsat.tblvendedores";

        $response = reporteVentasDthModel::MdlCargarCoordinadores($table);

        return $response;

    }

/*=============================================
=                 CARGAR COORDINADRES    =
=============================================*/

    public static function ctrCargarCoordinadoresXusuario($usuario)
    {

        $table = "digitalsat.tblvendedores";

        $response = reporteVentasDthModel::MdlCargarCoordinadoresXusuario($table, $usuario);

        return $response;

    }

/*=============================================
= CARGAR VENTAS TOTALES, TODOS LOS COORDINADORES =
=============================================*/

    public static function ctrCargarVentasTotales($startDate, $endDate)
    {

        /* $table = "digitalsat.tbl_zonas";
        $table1 = "digitalsat.tbl_ventas_calle_dth";
        $table2 = "digitalsat.tblvendedores";
        $table3 = "digitalsat.tbl_informe_internet";
        $table4 = "callcenter.tblinforme";
        $table5 = "digitalsat.tblinforme_gpon";
        $table6="digitalsat.tbl_coordinadores";

        $response = reporteVentasDthModel::MdlCargarVentasTotales($table,$table1,$table2,$table3,$table4,$table5,$table6,$startDate, $endDate);
         */

        $table = "digitalsat.tbl_vehiculos";
        $table1 = "digitalsat.tbl_codigo_validacion";
        $response = reporteVentasDthModel::MdlCargarVentasTotales($table, $table1, $startDate, $endDate);
        return $response;

    }

/*=============================================
= CARGAR VENTAS TOTALES, TODOS LOS COORDINADORES =
=============================================*/

    public static function ctrCargarVentasTotalesCompararTablas($Vardesde1, $Varhasta1, $Vardesde2, $Varhasta2)
    {

        $table = "digitalsat.tbl_zonas";
        $table1 = "digitalsat.tbl_ventas_calle_dth";
        $table2 = "digitalsat.tblvendedores";
        $table3 = "digitalsat.tbl_informe_internet";
        $table4 = "callcenter.tblinforme";
        $table5 = "digitalsat.tblinforme_gpon";
        $table6 = "digitalsat.tbl_coordinadores";

        $response = reporteVentasDthModel::MdlCargarVentasTotalesCompararTablas($table, $table1, $table2, $table3, $table4, $table5, $table6, $Vardesde1, $Varhasta1, $Vardesde2, $Varhasta2);

        return $response;

    }

/*=============================================
= CARGAR VENTAS TOTALES, TODOS LOS SUPERVISORES =
=============================================*/

    public static function ctrCargarVentasTotalesXSupervisor($startDate, $endDate)
    {

        $table = "digitalsat.tbl_supervisores ";
        $table1 = "digitalsat.tbl_codigo_validacion";

        $response = reporteVentasDthModel::MdlCargarVentasTotalesXSupervisores($table, $table1, $startDate, $endDate);

        return $response;

    }

/*=============================================
=    CARGAR VENDEDORES    =
=============================================*/

    public static function ctrCargarVendedores($usuario)
    {

        if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Administrativo" || $_SESSION["rol"] == "Supervisor") {

            $table = "digitalsat.tblvendedores";

            $response = reporteVentasDthModel::MdlCargarVendedores($table);

            return $response;

        } else if ($_SESSION["sub_tipo"] == "1. Coordinador") {

            $table2 = "digitalsat.tbl_coordinadores";

            $table = "digitalsat.tblvendedores";

            $response = reporteVentasDthModel::MdlCargarCoordinadores_2($table, $usuario);
            // $respuesta = solicitud_codigo_Model:: MdlValidarCoordinador($table2, $usuario);

        } else {

            $table = "digitalsat.tblvendedores";
            $response = reporteVentasDthModel::MdlCargarVendedor($table, $usuario);

        }

        return $response;

    }

    /*=====================================
    =         INICIO USUARIOS RUTAS       =
    ====================================== */
    public static function ctrCargarinicioUsuarioRutas()
    {

        date_default_timezone_set('America/Costa_Rica');

        $table = "digitalsat.tbl_apertura_rutas";
        $usuario = $_SESSION["id"];
        $fecha = date("Y-m-d");

        $response = reporteVentasDthModel::MdlCargarinicioUsuarioRutas($table, $usuario, $fecha);

        return $response;

    } 

	/*======================================
	=    CARGAR INICIO Y CIERRE DE RUTAS   =
	=======================================*/

	static public function ctrCargarInicioCierreRutas($startDate, $endDate){

		$table = "digitalsat.tbl_apertura_rutas";
		$table2 = "digitalsat.tblvendedores";
		$table3 = "digitalsat.tbltecnicos";
		
		$response = reporteVentasDthModel::MdlCargarInicioCierreRutas($table, $table2,$table3, $startDate, $endDate);		
		return $response;
	}

	/*====================================
	=     INSERTAR APERTURA DE RUTAS     =
	=====================================*/
	
	static public function ctrInsertarAperturaRuta(){

		if(isset($_POST["placa_inicio_rutas"])) {
		
			$table = "digitalsat.tbl_apertura_rutas";
		
		
		
			$data = array("placa" => $_POST["placa_inicio_rutas"],
							"kilometraje" => $_POST["kilometraje_inicio"],
							"tipo" => "Inicio",
	  						"fecha" => $_POST["fecha_inicio_ruta"],
	  						"latitud" => $_POST["latitud_inicio"],
	  						"longitud" => $_POST["longitud_inicio"],
							"personas" => $_POST["pasajeros_inicio_rutas"],
							"usuario" => $_SESSION["id"],
							"idplaca" => $_POST["idvehiculo_inicio_rutas"],
							"kilometros_recorridos" => "0");
		
		
			$response = reporteVentasDthModel::MdlInsertarAperturaRuta($table, $data);	
			
			//echo '<pre>'; print_r($response); echo '</pre>';
		
		 /*=============================================
		 = CREAR UNA CARPETA DENTRO DEL PROYECTO     =
		 =============================================*/
			$ipremoteserver='backup.midigitalsat.com';
			$urlremoteserver='https://backup.midigitalsat.com';
		
			$id = $response;
		
			$directory = "public/apertura_rutas/fotos/apertura".$id;
		
			mkdir($directory,0777);
		
		
		
			$username = 'root';
			$password = 'Heriberto9109';
			// Make our connection
			$connection = ssh2_connect($ipremoteserver, 6060);
			
			// Authenticate
			if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');
			
			// Create our SFTP resource
			if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
			
			ssh2_sftp_rmdir($sftp, "/mnt/blockstorage/html/public/apertura_rutas/fotos/apertura".$id);
			
			ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/public/apertura_rutas/fotos/apertura".$id,0777);
		
			$route = "";
		
		
			if(isset($_FILES["foto_kilometraje"]["tmp_name"]) && $_FILES["foto_kilometraje"]["tmp_name"]!=""){
		
				list($weight,$height) = getimagesize($_FILES["foto_kilometraje"]["tmp_name"]);
			
				$newWeight = 900;
				$newHeight = 900;
				
				if($_FILES["foto_kilometraje"]["type"] == "image/jpeg"){
			
			
					/*=============================================
					=        SAVE IMAGE IN DIRECTORY JPG         =
					=============================================*/
			
					$route = "public/apertura_rutas/fotos/apertura".$id."/foto_kilometraje.jpg";
			
					$source = imagecreatefromjpeg($_FILES["foto_kilometraje"]["tmp_name"]);
			
					$destination = imagecreatetruecolor($newWeight, $newHeight);
			
					//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
			
					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);
			
					imagejpeg($destination, $route);
			
			
				}
			
				if($_FILES["foto_kilometraje"]["type"] == "image/png"){
			
					
					/*=============================================
					=        SAVE IMAGE IN DIRECTORY PNG        =
					=============================================*/
			
					$route = "public/apertura_rutas/fotos/apertura".$id."/foto_kilometraje.png";
									
					$source = imagecreatefrompng($_FILES["foto_kilometraje"]["tmp_name"]);						
					$destination = imagecreatetruecolor($newWeight, $newHeight);
			
					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);
			
					imagepng($destination, $route);
			
				}
			
				date_default_timezone_set('America/Costa_Rica');
			
				$headerArray = array();
				$headerArray = get_headers($route, 1);
			
				$external_route = $urlremoteserver ."/".$route;
					
			
				$table = "digitalsat.tbl_apertura_rutas";
			
			
			
				$data = array("foto_kilometraje" => $route,
								"ruta_externa" => $external_route,
								"id_ruta" => $id
				);
			
				$response = reporteVentasDthModel::MdlInsertarFotoRuta($table, $data);
			
			
				$username = 'root';
				$password = 'Heriberto9109';
				// Make our connection
				$connection = ssh2_connect($ipremoteserver, 6060);
				
				// Authenticate
				if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');
				
				// Create our SFTP resource
				if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
				$remoteDir  = "/mnt/blockstorage/html/public/apertura_rutas/fotos/apertura".$id."/";
				$localDir = "./public/apertura_rutas/fotos/apertura".$id;
				// download all the files
				/*$files    = scandir($localDir);*/
				
				$files = array_diff(scandir($localDir), array('..', '.'));
				
				
				if (!empty($files)) {
					foreach ($files as $file) {
						if ($file != '.' && $file != '..') {
						ssh2_scp_send($connection, $localDir."/".$file, $remoteDir."/".$file, 0644);
					
						}
					}
				}
				
				
				
				if($response == "ok"){
			
						echo '<script>
			
						swal({
			
							type: "success",
							title: "¡Datos ingresados Correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
			
						}).then((result)=>{
			
							if(result.value){
			
						window.location = "inicio-cierre-rutas-calle";
							
							}
			
							});				
			
						</script>'	;
			
				}else{
			
			
					echo '<script>
					
								swal({
					
									type: "error",
									title: "¡ERROR AL GUARDAR DATOS!", 
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
					
								}).then((result)=>{
					
									if(result.value){
					
										window.location = "rutas-auditoria";
					
										
									}
					
									});
					
									
								</script>'	;
					
				}
			}
		}
	}


	/*====================================
	=       INSERTAR CIERRE DE RUTA      = 
	=====================================*/

	static public function ctrInsertarCierreRuta(){

		if(isset($_POST["placa_cierre_rutas"])) {

    		$table = "digitalsat.tbl_apertura_rutas";

	    	$data = array("placa" => $_POST["placa_cierre_rutas"],
		              "kilometraje" => $_POST["kilometraje_cierre"],
		              "tipo" => "Cierre",
		          	  "fecha" => $_POST["fecha_cierre_ruta"],
		          	  "latitud" => $_POST["latitud_cierre"],
		          	  "longitud" => $_POST["longitud_cierre"],	
		          	   "personas" =>"0",	          	 
		          	  "usuario" => $_SESSION["id"],
		          	  "idplaca" => $_POST["idvehiculo_cierre_rutas"],
		          	  "kilometros_recorridos"=>$_POST["kilometraje_cierre_rutas"]);


			$response = reporteVentasDthModel::MdlInsertarAperturaRuta($table, $data);



			/*=============================================
			= CREAR UNA CARPETA DENTRO DEL PROYECTO     =
			=============================================*/

 			$ipremoteserver='backup.midigitalsat.com';
    
    		$urlremoteserver='https://backup.midigitalsat.com';

			$id = $response;

			$directory = "public/cierre_rutas/fotos/cierre".$id;

			mkdir($directory,0777);



			$username = 'root';
			$password = 'Heriberto9109';
			// Make our connection
			$connection = ssh2_connect($ipremoteserver, 6060);

			// Authenticate
			if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

			// Create our SFTP resource
			if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');

			ssh2_sftp_rmdir($sftp, "/mnt/blockstorage/html/public/cierre_rutas/fotos/cierre".$id);

			ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/public/cierre_rutas/fotos/cierre".$id,0777);

			$route = "";


			if(isset($_FILES["foto_kilometraje_cierre"]["tmp_name"]) && $_FILES["foto_kilometraje_cierre"]["tmp_name"]!=""){


				list($weight,$height) = getimagesize($_FILES["foto_kilometraje_cierre"]["tmp_name"]);

				$newWeight = 900;
				$newHeight = 900;

				if($_FILES["foto_kilometraje_cierre"]["type"] == "image/jpeg"){


					/*=============================================
					=        SAVE IMAGE IN DIRECTORY JPG         =
					=============================================*/

					$route = "public/cierre_rutas/fotos/cierre".$id."/foto_kilometraje.jpg";

					$source = imagecreatefromjpeg($_FILES["foto_kilometraje_cierre"]["tmp_name"]);

					$destination = imagecreatetruecolor($newWeight, $newHeight);

					//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagejpeg($destination, $route);


				}


				if($_FILES["foto_kilometraje_cierre"]["type"] == "image/png"){

					
					/*=============================================
					=        SAVE IMAGE IN DIRECTORY PNG        =
					=============================================*/

					$route = "public/cierre_rutas/fotos/cierre".$id."/foto_kilometraje.png";
						
					$source = imagecreatefrompng($_FILES["foto_kilometraje_cierre"]["tmp_name"]);						
				
					$destination = imagecreatetruecolor($newWeight, $newHeight);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagepng($destination, $route);

				}


				date_default_timezone_set('America/Costa_Rica');

				$headerArray = array();
				$headerArray = get_headers($route, 1);
				$external_route = $urlremoteserver ."/".$route;

   				$table = "digitalsat.tbl_apertura_rutas";

		    	$data = array("foto_kilometraje" => $route,
		              	"ruta_externa" => $external_route,
		          		"id_ruta" => $id);


				$response = reporteVentasDthModel::MdlInsertarFotoRuta($table, $data);

				$usuario_id = $_SESSION["id"];

				date_default_timezone_set('America/Costa_Rica');

				$fecha = date('Y-m-d');

				$DATOS_APERTURA = reporteVentasDthModel::MdlCargarDatosApertura($table, $usuario_id, $fecha);

				$total_personas = $DATOS_APERTURA[0]["personas"];

				$kilometros_recorridos = $_POST["kilometraje_cierre"] - $DATOS_APERTURA[0]["kilometraje"];

				$table1 = "digitalsat.tbl_codigo_validacion";
				$table2 = "digitalsat.tblvendedores";
				$fecha_nueva = date('Y-m-d');


       			$table1 = "digitalsat.tblvendedores";
 
       			$table2 = "digitalsat.tbl_ventas_calle_dth";
		
       			$table3 = "digitalsat.tblinforme_gpon";
 
       			$table4 = "callcenter.tblinforme";

       			$table5 = "digitalsat.tbl_informe_internet";

       			$tableZona = "digitalsat.tbl_zonas";

				$ventas_dth = reporteVentasDthModel::MdlCargarDatosVentas_dth($table1, $table2, $tableZona, $usuario_id, $fecha_nueva);
				$ventas_internet = reporteVentasDthModel::MdlCargarDatosVentas_internet($table1, $table5, $tableZona, $usuario_id, $fecha_nueva);
				$ventas_pospago = reporteVentasDthModel::MdlCargarDatosVentas_pospago($table1, $table4, $tableZona, $usuario_id, $fecha_nueva);
				$ventas_gpon = reporteVentasDthModel::MdlCargarDatosVentas_gpon($table1, $table3, $tableZona, $usuario_id, $fecha_nueva);

				$username = 'root';
				$password = 'Heriberto9109';
				// Make our connection
				$connection = ssh2_connect($ipremoteserver, 6060);

				// Authenticate
				if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

				// Create our SFTP resource
				if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
				$remoteDir  = "/mnt/blockstorage/html/public/cierre_rutas/fotos/cierre".$id."/";
				$localDir = "./public/cierre_rutas/fotos/cierre".$id;
				// download all the files
				/*$files    = scandir($localDir);*/

				$files = array_diff(scandir($localDir), array('..', '.'));


				if (!empty($files)) {
				  foreach ($files as $file) {
				    if ($file != '.' && $file != '..') {
				      ssh2_scp_send($connection, $localDir."/".$file, $remoteDir."/".$file, 0644);
					
				    }
				  }
				}



				if($response == "ok"){
				
				
				echo '<script type="text/javascript">
				
				swal("Ingresado Correctamente.", 
				"Cantidad de personas: '.$total_personas.'<br> Total de Kilometros: '.$kilometros_recorridos.' <br> Ventas DTH: '.$ventas_dth[0].'<br> Ventas Pospago: '.$ventas_pospago[0].' <br> Ventas Internet: '.$ventas_internet[0].' <br> Ventas GPON: '.$ventas_gpon[0].'  ","success").then((result)=>{
				
								if(result.value){
								
							window.location = "inicio-cierre-rutas-calle";
								
								}
							
								});
							
				</script>';
							
				}else{
				
				
				echo '<script>
				
							swal({
							
								type: "error",
								title: "¡ERROR AL GUARDAR DATOS!", 
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							
							}).then((result)=>{
							
								if(result.value){
								
									window.location = "rutas-auditoria";
								

								}
							
								});
							

							</script>'	;
							
				}
			}
		}
	}


	/*===================================
	=         ACTUALIZAR RUTAS          =
	====================================*/

	static public function ctrActualizarRuta() {

		if(isset($_POST["id-cierre"])) {

			date_default_timezone_set('America/Costa_Rica');

     
       		$fecha = date("Y-m-d H:i:s");

    		$table = "digitalsat.tbl_apertura_rutas";

			$idapertura =$_POST["id-inicio"];
			$idcierre =$_POST["id-cierr		e"];

       		$data = array( "kilometraje" => $_POST["kg-inicio"],
		              "idtbl_apertura_rutas" => $idapertura,		          	
		          	   "fecha_actualizacion" => $fecha,		          	            	 
		          	  "usuario_actualizacion" => $_SESSION["id"]);


			$response = reporteVentasDthModel::MdlActualizarRuta($table, $data);

		  	$data = array( "kilometraje" => $_POST["kg-cierre"],
		         	"idtbl_apertura_rutas" => $idcierre,	
		          	"fecha_actualizacion" => $fecha,		          	            	 
		          	"usuario_actualizacion" => $_SESSION["id"]);


			$response = reporteVentasDthModel::MdlActualizarRuta($table, $data);

			/*APERTURA*/

			if(isset($_FILES["foto_kilometraje_editar_apertura"]["tmp_name"]) && $_FILES["foto_kilometraje_editar_apertura"]["tmp_name"]!=""){


				/*=============================================
				= CREAR UNA CARPETA DENTRO DEL PROYECTO     =
				=============================================*/


				$id = $idapertura;

				$ipremoteserver='backup.midigitalsat.com';
				$urlremoteserver='https://backup.midigitalsat.com';

				$directory = "public/apertura_rutas/fotos/apertura".$id;


				/*===================================================
				=        FIRST ASK IF PICTURE EXISTS IN BD          =
				====================================================*/

				if(!empty($_POST["currentfoto_kilometraje_editar_apertura"])){

					unlink($_POST["currentfoto_kilometraje_editar_apertura"]);

				}else{

					mkdir($directory,0777);

				}

		 		list($weight,$height) = getimagesize($_FILES["foto_kilometraje_editar_apertura"]["tmp_name"]);

				$newWeight = 900;
				$newHeight = 900;

				if($_FILES["foto_kilometraje_editar_apertura"]["type"] == "image/jpeg"){


					/*=============================================
					=        SAVE IMAGE IN DIRECTORY JPG         =
					=============================================*/

					$route = "public/apertura_rutas/fotos/apertura".$id."/foto_kilometraje.jpg";

					$source = imagecreatefromjpeg($_FILES["foto_kilometraje_editar_apertura"]["tmp_name"]);

					$destination = imagecreatetruecolor($newWeight, $newHeight);

					//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagejpeg($destination, $route);

				}


				if($_FILES["foto_kilometraje_editar_apertura"]["type"] == "image/png"){

		 
					/*=============================================
					=        SAVE IMAGE IN DIRECTORY PNG        =
					=============================================*/

					$route = "public/apertura_rutas/fotos/apertura".$id."/foto_kilometraje.png";
							
					$source = imagecreatefrompng($_FILES["foto_kilometraje_editar_apertura"]["tmp_name"]);						
					
					$destination = imagecreatetruecolor($newWeight, $newHeight);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagepng($destination, $route);

				}





				date_default_timezone_set('America/Costa_Rica');

				$headerArray = array();
				$headerArray = get_headers($route, 1);
				$external_route = $urlremoteserver ."/".$route;

   				$table = "digitalsat.tbl_apertura_rutas";



       			$data = array("foto_kilometraje" => $route,
		              	"ruta_externa" => $external_route,
		          		"id_ruta" => $id);


				$response = reporteVentasDthModel::MdlInsertarFotoRuta($table, $data);

			}


			/*/APERTURA*/

			$username = 'root';
			$password = 'Heriberto9109';
			// Make our connection
			$connection = ssh2_connect($ipremoteserver, 6060);

			// Authenticate
			if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

			// Create our SFTP resource
			if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
			$remoteDir  = "/mnt/blockstorage/html/public/apertura_rutas/fotos/apertura".$id."/";
			$localDir = "./public/apertura_rutas/fotos/apertura".$id;
			// download all the files
			/*$files    = scandir($localDir);*/

			$files = array_diff(scandir($localDir), array('..', '.'));


			if (!empty($files)) {
			  foreach ($files as $file) {
			    if ($file != '.' && $file != '..') {
			      ssh2_scp_send($connection, $localDir."/".$file, $remoteDir."/".$file, 0644);
				
			    }
			  }
			}




			/*CIERRE*/




			if(isset($_FILES["foto_kilometraje_editar_cierre"]["tmp_name"]) && $_FILES["foto_kilometraje_editar_cierre"]["tmp_name"]!=""){


				/*=============================================
				= CREAR UNA CARPETA DENTRO DEL PROYECTO     =
				=============================================*/


				$id = $idcierre;

				$directory = "public/cierre_rutas/fotos/cierre".$id;


				/*===================================================
				=        FIRST ASK IF PICTURE EXISTS IN BD          =
				====================================================*/

				if(!empty($_POST["currentfoto_kilometraje_editar_cierre"])){

				unlink($_POST["currentfoto_kilometraje_editar_cierre"]);

				}else{

					mkdir($directory,0777);

				}

		 		list($weight,$height) = getimagesize($_FILES["foto_kilometraje_editar_cierre"]["tmp_name"]);

				$newWeight = 900;
				$newHeight = 900;

				if($_FILES["foto_kilometraje_editar_cierre"]["type"] == "image/jpeg"){


					/*=============================================
					=        SAVE IMAGE IN DIRECTORY JPG         =
					=============================================*/

					$route = "public/cierre_rutas/fotos/cierre".$id."/foto_kilometraje.jpg";

					$source = imagecreatefromjpeg($_FILES["foto_kilometraje_editar_cierre"]["tmp_name"]);

					$destination = imagecreatetruecolor($newWeight, $newHeight);

					//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagejpeg($destination, $route);


				}


				if($_FILES["foto_kilometraje_editar_cierre"]["type"] == "image/png"){

		 
					/*=============================================
					=        SAVE IMAGE IN DIRECTORY PNG        =
					=============================================*/

					$route = "public/cierre_rutas/fotos/cierre".$id."/foto_kilometraje.png";
							
					$source = imagecreatefrompng($_FILES["foto_kilometraje_editar_cierre"]["tmp_name"]);						
					
					$destination = imagecreatetruecolor($newWeight, $newHeight);

					imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

					imagepng($destination, $route);

				}


				date_default_timezone_set('America/Costa_Rica');

				$headerArray = array();
				$headerArray = get_headers($route, 1);
				$external_route = $urlremoteserver ."/".$route;

   				$table = "digitalsat.tbl_apertura_rutas";

				$data = array("foto_kilometraje" => $route,
		            	"ruta_externa" => $external_route,
		          		"id_ruta" => $id);


				$response = reporteVentasDthModel::MdlInsertarFotoRuta($table, $data);

			}




			$username = 'root';
			$password = 'Heriberto9109';
			// Make our connection
			$connection = ssh2_connect($ipremoteserver, 6060);

			// Authenticate
			if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

			// Create our SFTP resource
			if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
			$remoteDir  = "/mnt/blockstorage/html/public/cierre_rutas/fotos/cierre".$id."/";
			$localDir = "./public/cierre_rutas/fotos/cierre".$id;
			// download all the files
			/*$files    = scandir($localDir);*/

			$files = array_diff(scandir($localDir), array('..', '.'));


			if (!empty($files)) {
			  foreach ($files as $file) {
			    if ($file != '.' && $file != '..') {
			      ssh2_scp_send($connection, $localDir."/".$file, $remoteDir."/".$file, 0644);
				
			    }
			  }
			}



			/*/CIERRE*/



			if($response == "ok"){


						echo '<script>

						swal({

							type: "success",
							title: "Actualizacion ingresada Correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

						window.location = "inicio-cierre-rutas-calle";
							
							}

							});				

						</script>'	;

			}else{


			echo '<script>

						swal({

							type: "error",
							title: "¡ERROR AL ACTUALIZAR DATOS!", 
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

							window.location = "inicio-cierre-rutas-calle";

								
							}

							});

							
						</script>'	;

			}

		}

	}


	/*====================================
	=     CARGAR INFORMACION DE RUTAS    =  
	====================================*/
	static public function ctrCargarInformacionRutas($placa, $fecha){

		$table = "digitalsat.tbl_apertura_rutas";
		$table2 = "digitalsat.tblvendedores";
		
		$response = reporteVentasDthModel::MdlCargarInformacionRutas($table, $table2, $placa, $fecha);		
 
		return $response;
 	}


	/*================================
	=     CARGAR INICIO DE RUTAS     =
	=================================*/
	
	static public function ctrCargarInicioRutas($id_usuario){
 
		date_default_timezone_set('America/Costa_Rica'); 
		
		$table = "digitalsat.tbl_apertura_rutas";
		$fecha = date('Y-m-d');
		
		$response = reporteVentasDthModel::MdlCargarInicioRutas($table, $id_usuario, $fecha);		
		
		return $response;
	}



	/*================================
	=  CARGAR INFO CIERRE DE RUTAS   =
	=================================*/
	
	static public function ctrCargarInformacionCierreRutas($placa_cierre, $fecha_cierre){

		$table = "digitalsat.tbl_apertura_rutas";
	   
		$response = reporteVentasDthModel::MdlCargarInformacionCierreRutas($table, $placa_cierre, $fecha_cierre);		

		return $response; 
	}



	/*==================================
	=   CARGAR INFORMACION POR PLACA   =
	===================================*/

	static public function ctrCargarInformacionPlaca($id_usuario_vehiculo,$rol){

    	$table = "digitalsat.tbl_zonas";
    	$table2 = "digitalsat.tblvendedores";
    	$table3 = "digitalsat.tbl_vehiculos";
    	$table4 = "digitalsat.tbltecnicos";

		$response = reporteVentasDthModel::MdlCargarInformacionPlaca($table, $table2,$table3,$table4,$id_usuario_vehiculo,$rol);		

		return $response;


	}

	/*=======================================
    =      CARGAR KILOMETRAJE DE MOVILES    =
    =======================================*/

	static public function ctrCargarKmMoviles($fechaHoy, $fechaInicio, $fechaAyer) {
		$table1 = "digitalsat.tbl_vehiculos";
		$table2 = "digitalsat.tbl_apertura_rutas";

		$response = reporteVentasDthModel::MdlCargarKmMoviles($fechaHoy, $fechaInicio, $fechaAyer, $table1, $table2);

		return $response;


	}

}
