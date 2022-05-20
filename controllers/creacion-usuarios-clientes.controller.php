 <?php

class UsuariosClienteController{

 
	static public function ctrCargarBodegas(){

	       $table = "empresas.tbl_bodegas"; 	
	       $table2 = "empresas.tbl_clientes";
	       $value = $_SESSION["id"];

			$response = UsuariosClienteModel::MdlCargarBodegas($table, $table2, $value);	

			return $response;


	}  


	static public function ctrCargarUsuarioClientes($IDempresa){

		   $table2 = "empresas.tbl_empresas_usuarios";
		   $table = "empresas.tbluser_2";

			$response = UsuariosClienteModel::MdlCargarUsuarioClientes($table, $table2, $IDempresa);	

			return $response;


	}  


/*=============================================
=      CARGAR DATOS USUARIO SELECCIONADO            =
=============================================*/

	static public function ctrCargarUsuarioSeleccionado($value){

		   $table = "empresas.tbl_usuarios_cliente";
		
			$response = UsuariosClienteModel::MdlCargarUsuarioSeleccionado($table, $value);	

			return $response;


	} 


/*=============================================
=      EDITAR DATOS USUARIO SELECCIONADO            =
=============================================*/

	static public function ctrEditarEstadoUsuario($value, $estado){


		   $table = "empresas.tbluser_2";
		
			$response = UsuariosClienteModel::MdlEditarEstadoUsuario($table, $value, $estado);	

			return $response;



	} 


	static public function ctrAgregarUsuario(){

	       	


			if(isset($_POST["nom_usuario"])) {

$table = "empresas.tbluser_2"; 

			$data = array("nombre" => $_POST["nom_usuario"],
							       "pass" => $_POST["contrasena"],		                 
							       "privilegios" => $_POST["privilegios"],
							       "status" => "Disponible",
							       "usuario" => "N/A",
							       "id_usuario" => "0",
							       "lat" => "0",
							       "lon" => "0");


			$response = UsuariosClienteModel::MdlAgregarUsuario($table, $data);



$table = "empresas.tbl_usuarios_cliente"; 

			$data = array("nombre_usuario" => $_POST["nom_usuario"],
							       "contrasena" => $_POST["contrasena"],		                 
							       "id_usuario" => $response,
							       "bodega" => $_POST["bodega_usuario"],
							       "id_cliente" => $_SESSION["id"]);





$response = UsuariosClienteModel::MdlAgregarUsuarioCliente($table, $data);



 if($response == "OK"){

		    	echo '<script>
				 Swal.fire(
      "Actualización exitosa!",
      "¡Información Ingresada Exitosamente.",
      "success"
    ).then((result) => {

	 window.location = "creacion-usuarios-clientes";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡Error al ingresar los datos, intente nuevamente.",
      "error"
    ).then((result) => {

	 window.location = "creacion-usuarios-clientes";
    })		

				

			</script>';


		   }




			}




	}

//!  nuevos agregados

    static public function ctrCargarModulos($IdEmpresa){

		$table = "empresas.tbl_modulos_outthebox";    
	   
		 $response = UsuariosClienteModel::MdlCargarModulos($table, $IdEmpresa); 
 
		 return $response;
 
 
	 }

	 static public function ctrCargarsubModulos($modulos){

		$table = "empresas.tbl_modulos_outthebox";    
		$table2 = "empresas.tbl_subModulos_outthebox";    
	   
		 $response = UsuariosClienteModel::MdlCargarsubModulos($table, $table2, $modulos); 
 
		 return $response;
 
 
	 }


	 static public function ctrBuscarUsuario($usuarios, $empresaSelected3){

		$table = "empresas.tbluser_2";   
		$table2 = "empresas.tbl_empresas_usuarios";  
	     
		 $response = UsuariosClienteModel::MdlBuscarUsuario($table, $table2, $usuarios, $empresaSelected3); 
 
		 return $response;
 
 
	 }


	 static public function ctrBuscarUsuario2($usuarios, $empresaSelected2){

		$table = "empresas.tbl_empresas_usuarios";    
	     
		 $response = UsuariosClienteModel::MdlBuscarUsuario2($table, $usuarios, $empresaSelected2); 
 
		 return $response;
 
 
	 }

	 static public function ctrAgregarPermisosUsiuario($user, $privilegio, $empresaSelected){

		$table = "empresas.tbl_empresas_usuarios";    
	     
		 $response = UsuariosClienteModel::MdlAgregarPermisosUsiuario($table, $user, $privilegio, $empresaSelected); 
 
		 return $response;
 
 
	 }
 

	 static public function ctrAgregarUsuarioEmpresa($id_usuario, $id_empresa, $Nombre, $privilegios){

		$table = "empresas.tbl_empresas_usuarios";    
	     
		 $response = UsuariosClienteModel::MdlAgregarUsuarioEmpresa($table, $id_usuario, $id_empresa, $Nombre, $privilegios); 
 
		 return $response;
 
 
	 }

	 static public function ctrCargarsubModulosMultiple($modulos){

		$table = "empresas.tbl_subModulos_outthebox";    
	     
		 $response = UsuariosClienteModel::MdlCargarsubModulosMultiple($table, $modulos); 
 
		 return $response;
 
 
	 }

	 static public function ctrCargarIdUser($nombreUser){

		$table = "empresas.tbluser_2";    
	     
		 $response = UsuariosClienteModel::MdlCargarIdUser($table, $nombreUser); 
 
		 return $response;
 
 
	 }


	 static public function ctrCargarsubModulosEditar($modulos){

		$table = "empresas.tbl_subModulos_outthebox";    
	     
		 $response = UsuariosClienteModel::MdlCargarsubModulosEditar($table, $modulos); 
 
		 return $response;
 
 
	 }

	 static public function ctrSubModulosEditar($modulosEdit, $UserEdit, $empresaEdit){

		$table = "empresas.tbl_empresas_usuarios";    
	     
		 $response = UsuariosClienteModel::MdlSubModulosEditar($table, $modulosEdit, $UserEdit, $empresaEdit); 
 
		 return $response;
 
 
	 }

}

