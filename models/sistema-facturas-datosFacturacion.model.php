<?php
 
require_once "connexion.php";

class DatosFacturacionModel{

   
		static public function MdlAgregarDatosFacturacion($table, $data) { 

			$stmt = Connexion::connect()->prepare("UPDATE $table SET ruta_12 = :ruta_12, pin_p12 = :pin_p12, usuario_token = :usuario_token, contrasena_token = :contrasena_token where idtbl_clientes = :idtbl_clientes");

            $stmt->bindParam(":ruta_12",$data["ruta_12"], PDO::PARAM_STR); 
            $stmt->bindParam(":pin_p12",$data["pin_p12"], PDO::PARAM_STR); 
            $stmt->bindParam(":usuario_token",$data["usuario_token"], PDO::PARAM_STR); 
            $stmt->bindParam(":contrasena_token",$data["contrasena_token"], PDO::PARAM_STR); 
            $stmt->bindParam(":idtbl_clientes",$data["idtbl_clientes"], PDO::PARAM_STR); 
                                                       
			if($stmt->execute()){

                return "ok";
            }
        
            else{
        
                return $stmt->errorInfo()[2];
            }
        
            $stmt -> close();
        
            $stmt =null;

		}

        static public function MdlAgregarDatosFacturacionP($table, $data) { 

			$stmt = Connexion::connect()->prepare("UPDATE $table SET ruta_12_prueba = :ruta_12_prueba, pin_p12_prueba = :pin_p12_prueba, usuario_token_prueba = :usuario_token_prueba, contrasena_token_prueba = :contrasena_token_prueba where idtbl_clientes = :idtbl_clientes");

            $stmt->bindParam(":ruta_12_prueba",$data["ruta_12"], PDO::PARAM_STR); 
            $stmt->bindParam(":pin_p12_prueba",$data["pin_p12"], PDO::PARAM_STR); 
            $stmt->bindParam(":usuario_token_prueba",$data["usuario_token"], PDO::PARAM_STR); 
            $stmt->bindParam(":contrasena_token_prueba",$data["contrasena_token"], PDO::PARAM_STR); 
            $stmt->bindParam(":idtbl_clientes",$data["idtbl_clientes"], PDO::PARAM_STR); 
                                                       
			if($stmt->execute()){

                return "ok";
            }
        
            else{
        
                return $stmt->errorInfo()[2];
            }
        
            $stmt -> close();
        
            $stmt =null;

		}


		static public function MdlCargarDatosFacturacion($table, $empresa) { 

			$stmt = Connexion::connect()->prepare("SELECT idtbl_clientes, pin_p12, usuario_token, contrasena_token, pin_p12_prueba, usuario_token_prueba, contrasena_token_prueba FROM $table where idtbl_clientes = '$empresa'");

			$stmt -> execute();

			return $stmt -> fetchAll();
			// return $stmt;

			$stmt -> close();

		$stmt =null;

		}


}
