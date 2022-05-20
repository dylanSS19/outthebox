<?php

 
class RecuperarContrasenaFrm2Controller{

				/*=============================================
				=                 VALIDAR CODIGO              =
				=============================================*/

			static public function ctrValidarCodigo($value, $usuario){

				       $table = "empresas.tbluser_2"; 
				           
						$response = RecuperarContrasenaFrm2Model::MdlValidarCodigo($table, $value, $usuario);	
						

						return $response;

			}


				/*=============================================
				=   MODIFICAR CONTRASEÑA DEL USUARIO         =
				=============================================*/

			static public function ctrModificarContrasena($contrasena_modificacion, $codigo_modificar){

				       $table = "empresas.tbluser_2"; 
				           
						$response = RecuperarContrasenaFrm2Model::MdlModificarContrasena($table, $contrasena_modificacion, $codigo_modificar);	
						

						return $response;

			}

}