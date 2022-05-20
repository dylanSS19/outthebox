<?php
  
$nameTech="";

class UserController{

/*=============================================
=                   LOGGIN USER                  =
=============================================*/

static public function ctrLogginUser(){ 

	if(isset($_POST["user"])){

//a-zA-Z0-9ñÑáéíóúÁÉÍÉÓÚ

		if(preg_match('/^[a-zA-Z0-9.*]+$/', $_POST["user"])){

			$table = "empresas.tbluser_2";

		// $encrypt = crypt($_POST["password"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');

		 //  $encrypt = $_POST["password"];

			$item = "nombre";

			$value = $_POST["user"];

			//echo("<script>console.log('PHP: USER ".$value .  "');</script>");

			$response = UsersModel::MdlShowUsers($table, $item, $value);
			

		
if($response[10] >= 3){

echo '<br> <div class="alert alert-danger">Usuario bloqueado, se han superado los intentos requeridos, realizar cambio de contraseña</div>';

}else{

			if(is_array($response) && $response["nombre"] == $_POST["user"] && $response["pass"] == $_POST["password"]){

					if($response["status"] == "Disponible"){					

					$_SESSION["login"] = "ok";

					$_SESSION["id"] = $response["idtbluser_2"];

					$_SESSION["rol"] = $response["privilegios"];

					$_SESSION["user_name"] = $response["nombre"];

					echo '<script> sessionStorage.setItem("id", "' . $_SESSION['id'] . '");</script>';
				
					echo '<script> sessionStorage.setItem("rol", "' . $_SESSION['rol'] . '");</script>';
		
			// 		if($_SESSION["rol"]=="Vendedor"){

		    // $table = "digitalsat.tblvendedores";

			// $item = "user";

			// $value = $_SESSION["id"];

			// echo("<script>console.log('PHP: SUBTYPE ".$value .  "');</script>");

			// $response = UsersModel::MdlShowSaleManRole($table, $item, $value);


            //       $_SESSION["sub_tipo"] = $response["sub_tipo"];

            //       	echo '<script> sessionStorage.setItem("subtype", "' . $_SESSION['sub_tipo'] . '");</script>';

			// 		};

					date_default_timezone_set('America/Costa_Rica');

					

					echo '<script>

					window.location ="home";
					

					</script>';
 
					

					}else {

						echo '<br> <div class="alert alert-danger"> Error el usuario esta desactivo </div>';

					}


			} else{

				$table = "empresas.tbluser_2";
				$value =  $_POST["user"];

				$response = UsersModel::MdlLoadvalidusers($table, $value);
				

					if($response[0] == 0){

					echo '<br> <div class="alert alert-danger"> El usuario ingresado no existe, vuelve a intentarlo.</div>';


					}else{

									$table = "empresas.tbluser_2";
									$value =  $_POST["user"];

									$intentos = UsersModel::MdlLoadusers($table, $value);
									

					if($intentos[0] >= 3){


									$table = "empresas.tbluser_2";
									$user =  $_POST["user"];		
									$desacticvar_usuario = UsersModel::Mdlupdatestatussuser($table, $user);
									echo '<pre>'; print_r($desacticvar_usuario); echo '</pre>';

					echo '<br> <div class="alert alert-danger">El usuario se encientra bloqueado, por favor proceda con el cambio de la contraseña.</div>';



					}else{
									$table = "empresas.tbluser_2";
									$user =  $_POST["user"];
									$newintentos = $intentos[0] + 1;
								
									$aumentar_intentos = UsersModel::MdlupdateAttemptsuser($table, $newintentos, $user);



					}



									// $table = "empresas.tbluser_2";
									// $value =  $_POST["user"];

									// $aumentar_intentos = UsersModel::MdlupdateAttemptsuser($table, $intentos, $user);





					}

			}

	}

		}else{echo '<br> <div class="alert alert-danger"> Error de caracteres</div>';	}

	}else{
			}


 

 
} 


/*=============================================
=                  SHOW GPS LOCATION          =
=============================================*/

	static public function ctrShowGPSLocation(){

        $table = "empresas.tbluser_2";

		$response = UsersModel::MdlShowGPSLocation($table);

		return $response;

//return $value . $value2 . $value3 . $table;
	} 

/*=============================================
=                  UPDATE GPS LOCATION          =
=============================================*/

	static public function ctrUpdateGPSLocation($value, $value2,  $value3 , $currentDate){

        $table = "empresas.tbluser_2";

		$response = UsersModel::MdlUpdateGPSLocation($table, $value, $value2,  $value3,  $currentDate);

		return $response;

//return $value . $value2 . $value3 . $table;
	} 


/*=============================================
=                   SHOW SALES MAN            =
=============================================*/

	static public function ctrShowSalesMan($item, $value){

        $table = "digitalsat.tblvendedores";

		$response = UsersModel::MdlShowSalesManm($table, $item, $value);

		return $response;

	} 


/*=============================================
=                   SHOW SALES MAN 2        =
=============================================*/

	static public function ctrShowSalesMan2($item, $value){

        $table = "digitalsat.tblvendedores";

		$response = UsersModel::MdlShowSalesManm2($table, $item, $value);

		return $response;

	} 

/*=============================================
=                   SHOW TECHNICIAN NAME             =
=============================================*/

	static public function ctrShowtechnicians($item, $value){

        $table = "digitalsat.tbltecnicos";

		$response = UsersModel::MdlShowTechnicians($table, $item, $value);

		return $response;

	} 

	/*=============================================
=                   LOAD TECHNICIAN NAME ADMIN            =
=============================================*/

	static public function ctrLoadtechniciansAdmin($item, $value){

        $table = "empresas.tbluser_2";

		$response = UsersModel::MdlLoadTechniciansAdmin($table, $item, $value);

		return $response;

	} 

		/*=============================================
=                   LOAD TECHNICIAN NAME             =
=============================================*/

	static public function ctrLoadtechnicians($item, $value){

        $table = "digitalsat.tbltecnicos";

		$response = UsersModel::MdlLoadTechnicians($table, $item, $value);

		return $response;

	} 

	/*=============================================
=                   LOAD TECHNICIAN NAME             =
=============================================*/

	static public function ctrLoadtechniciansHome($item, $value){

       $table = "digitalsat.tbltecnicos";

/*       //echo("<script>console.log('PHP: " . $table . $item . $value . "');</script>");
echo("<script>console.log('ITEM: " . $item . "');</script>");

echo("<script>console.log('value: " . $value . "');</script>");*/

		$response = UsersModel::MdlShowTechniciansHome($table, $item, $value);

		//echo json_encode($response);

		return $response;


	}   

		/*=============================================
=                   UPDATE USER USER            =
=============================================*/

	static public function ctrUpdateUserUser($value, $value1, $value2){

       $table = "empresas.tbluser_2";


		$response = UsersModel::MdlUpdateUserUser($table, $value, $value1, $value2);

		
		return $response;


	}   

/*=============================================
=                   CREATE USER                  =
=============================================*/

static public function ctrCreateUser(){

	if(isset($_POST["newUser"])) {

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÉÓÚ ]+$/', $_POST["newName"]) &&
		   preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) && 
		   preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])) {

/*=============================================
=                   VALIDATE IMAGE                  =
=============================================*/

			$route = "";

		if(isset($_FILES["newPicture"]["tmp_name"]) && $_FILES["newPicture"]["tmp_name"]!=""){

				 list($weight,$height) = getimagesize($_FILES["newPicture"]["tmp_name"]);

				$newWeight = 500;
				$newHeight = 500;

/*=============================================
=        CREATE DIRECTORY  FOR IMAGE          =
=============================================*/

				$directory = "views/img/users/".$_POST["newUser"];

				mkdir($directory,0755);

/*=============================================
=        ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS     =
=============================================*/
		
				if($_FILES["newPicture"]["type"] == "image/jpeg"){


/*=============================================
=        SAVE IMAGE IN DIRECTORY JPG         =
=============================================*/

				$random = mt_rand(100,999);

				$route = "views/img/users/".$_POST["newUser"]."/".$random.".jpg";

				$source = imagecreatefromjpeg($_FILES["newPicture"]["tmp_name"]);

				$destination = imagecreatetruecolor($newWeight, $newHeight);

				//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

				imagejpeg($destination, $route);


				}

				if($_FILES["newPicture"]["type"] == "image/png"){


/*=============================================
=        SAVE IMAGE IN DIRECTORY PNG        =
=============================================*/

				$random = mt_rand(100,999);

				$route = "views/img/users/".$_POST["newUser"]."/".$random.".png";

				$source = imagecreatefrompng(filename)($_FILES["newPicture"]["tmp_name"]);

				$destination = imagecreatetruecolor($newWeight, $newHeight);

				//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

				imagepng($destination, $route);


				}




			}

		   	$table = "tbl_users";

		   	$encrypt = crypt($_POST["newPassword"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');





		    $data = array("name" => $_POST["newName"],
		                  "user_name" => $_POST["newUser"],
		                  "password" => $encrypt,
		                  "profile" => $_POST["newProfile"],
		                  "route" => $route);

		    $response = UsersModel::MdlAddUser($table , $data);

		    if($response == "ok"){

		    	echo '<script>

			swal({

				type: "success",
				title: "¡El usuario a sido guardado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});				

			</script>'	;

		    } else {

		    		echo '<script>

			swal({

				type: "error",
				title: "¡ERROR AL GUARDAR DATOS!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});

				

			</script>'	;


		   }

		} else {

			echo '<script>

			swal({

				type: "error",
				title: "!El usuario no debe estar en blanco o llevar caracteres especiales!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});

				

			</script>'	;


		}


	}


}



/*=============================================
=                   LOAD USERS                =
=============================================*/

	static public function ctrLoadUsers($item, $value){

       $table = "tbl_users";

       //echo("<script>console.log('PHP: " . $table . $item . $value . "');</script>");

		

		$response = UsersModel::MdlShowUsers($table, $item, $value);

		

		return $response;


	}

	static public function ctrExistencia($correo){

		$table = "tbluser_2";
  
		 $response = UsersModel::MdlExistencia($table, $correo);

		 if($response[0] == "1" || $response[0] == 1){

			$table = "empresas.tbluser_2";

 
			 $item = "nombre";
 
			 $value = $correo;
 
			 //echo("<script>console.log('PHP: USER ".$value .  "');</script>");
 
			 $response = UsersModel::MdlShowUsers($table, $item, $value);

			 if(is_array($response) && $response["nombre"] == $correo){

				if($response["status"] == "Disponible"){

					$_SESSION["login"] = "ok";

					$_SESSION["id"] = $response["idtbluser_2"];
	
					$_SESSION["rol"] = $response["privilegios"];
	
					$_SESSION["user_name"] = $response["nombre_perfil"];

					$_SESSION["foto_user"]= $response["img_perfil"];
	
					// setcookie("foto_user", $response["img_perfil"]);

					// $_COOKIE["foto_user"] = $response["img_perfil"];
	
					echo '<script> sessionStorage.setItem("id", "' . $_SESSION['id'] . '");</script>';
				
					echo '<script> sessionStorage.setItem("rol", "' . $_SESSION['rol'] . '");</script>';
		
					date_default_timezone_set('America/Costa_Rica');
		
					echo '<script>
	
					window.location ="home";
					
	
					</script>';


				}else{
					echo '<br> <div class="alert alert-danger"> Error el usuario esta desactivo </div>';

				}

			 }

		 }else{




		 }
 
		 return $response;
 
 
	 }
 
	 static public function ctrAgregarUsuario($id, $foto, $nombre, $correo){

		$table = "tbluser_2";
  
		 $response = UsersModel::MdlAgregarUsuario($table, $id, $foto, $nombre, $correo);

		 $table = "empresas.tbluser_2";

		 // $encrypt = crypt($_POST["password"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');
 
		  //  $encrypt = $_POST["password"];
 
			 $item = "nombre";
 
			 $value = $correo;
 
			 //echo("<script>console.log('PHP: USER ".$value .  "');</script>");
 
			 $response = UsersModel::MdlShowUsers($table, $item, $value);

			 if(is_array($response) && $response["nombre"] == $correo && $response["pass"] == $id){

				if($response["status"] == "Disponible"){

					$_SESSION["login"] = "ok";

					$_SESSION["id"] = $response["idtbluser_2"];
	
					$_SESSION["rol"] = $response["privilegios"];
	
					$_SESSION["user_name"] = $response["nombre_perfil"];
	
					$_SESSION["foto_user"]= $response["img_perfil"];
					// setcookie("foto_user", $response["img_perfil"]);
					// $_COOKIE["foto_user"] = $response["img_perfil"];
	
					echo '<script> sessionStorage.setItem("id", "' . $_SESSION['id'] . '");</script>';
				
					echo '<script> sessionStorage.setItem("rol", "' . $_SESSION['rol'] . '");</script>';
		
					date_default_timezone_set('America/Costa_Rica');
	
					
	
					echo '<script>
	
					window.location ="home";
					
	
					</script>';


				}else{
					echo '<br> <div class="alert alert-danger"> Error el usuario esta desactivo </div>';

				}

			 }

 
		 return $response;
 
 
	 }

}
