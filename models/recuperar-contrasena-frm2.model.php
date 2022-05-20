<?php
 
require_once "connexion.php";

class  RecuperarContrasenaFrm2Model{

			/*=============================================
			= CARGAR NUMERO DE TELEFONO DEL CLIENTE             =
			=============================================*/

				static public function MdlValidarCodigo($table, $value, $usuario) {


			$stmt = Connexion::connect()->prepare("SELECT IFNULL(Codigo_recuperacion , 0) FROM $table WHERE Codigo_recuperacion = '$value' and nombre = '$usuario'");

						$stmt -> execute();

						return $stmt -> fetch();
						// return $stmt;	

						$stmt -> close();

						$stmt =null;

			}



						/*=============================================
			= CARGAR NUMERO DE TELEFONO DEL CLIENTE             =
			=============================================*/

				static public function MdlModificarContrasena($table, $contrasena_modificacion, $codigo_modificar) {


			$stmt = Connexion::connect()->prepare("UPDATE $table SET pass = '$contrasena_modificacion', Codigo_recuperacion ='0', status = 'Disponible', intentos_fallidos = '0' WHERE Codigo_recuperacion = '$codigo_modificar'");

						if($stmt->execute()){


						    return "OK";
						    

						    }else{


						    return $stmt->errorInfo()[2];
						    // return $stmt;

						    }

						    $stmt -> close();

						    $stmt =null;

			}



}