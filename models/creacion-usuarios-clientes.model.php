<?php

require_once "connexion.php";

class  UsuariosClienteModel{
 

	/*=============================================
	=       AGREGAR SUB USUARIO DE UN CLIENTE    =
	=============================================*/

	static public function MdlAgregarUsuario($table, $data) { 


		 $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(nombre, pass, privilegios, status, usuario, id_usuario, lat, lon) VALUES (:nombre, :pass, :privilegios, :status, :usuario, :id_usuario, :lat, :lon)");

    $stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR); 
    $stmt->bindParam(":pass",$data["pass"], PDO::PARAM_STR); 
    $stmt->bindParam(":privilegios",$data["privilegios"], PDO::PARAM_STR); 
    $stmt->bindParam(":status",$data["status"], PDO::PARAM_STR); 
    $stmt->bindParam(":usuario",$data["usuario"], PDO::PARAM_STR); 
    $stmt->bindParam(":id_usuario",$data["id_usuario"], PDO::PARAM_STR);                 
    $stmt->bindParam(":lat",$data["lat"], PDO::PARAM_STR); 
    $stmt->bindParam(":lon",$data["lon"], PDO::PARAM_STR); 
    

   if($stmt->execute()){


     return $db->lastInsertId();
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;


	}



	/*=============================================
	=       AGREGAR UNION INGRESADO CON CLIENTE    =
	=============================================*/

	static public function MdlAgregarUsuarioCliente($table, $data) { 


		 $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(nombre_usuario, contrasena, bodega, id_usuario, id_cliente) VALUES (:nombre_usuario, :contrasena, :bodega, :id_usuario, :id_cliente)");

    $stmt->bindParam(":nombre_usuario",$data["nombre_usuario"], PDO::PARAM_STR); 
    $stmt->bindParam(":contrasena",$data["contrasena"], PDO::PARAM_STR); 
    $stmt->bindParam(":bodega",$data["bodega"], PDO::PARAM_STR); 
    $stmt->bindParam(":id_usuario",$data["id_usuario"], PDO::PARAM_STR); 
    $stmt->bindParam(":id_cliente",$data["id_cliente"], PDO::PARAM_STR); 
    
    
   if($stmt->execute()){


     return "OK";
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;


	}


/*=============================================
=      CARGAR BODEGAS POR USUARIOS              =
=============================================*/

	static public function MdlCargarBodegas($table, $table2, $value) {

			
			$stmt = Connexion::connect()->prepare("SELECT idtbl_bodegas, a.nombre, a.codigo, sede, a.activo, centrocosto, ubicacion, cuenta, cliente, saldo  FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.id_usuario = '$value'");

			$stmt -> execute();

			return $stmt -> fetchAll();

// return $stmt;	


		$stmt -> close();

		$stmt =null;

}

/*=============================================
=      CARGAR BODEGAS POR USUARIOS              =
=============================================*/

	static public function MdlCargarUsuarioClientes($table, $table2, $IDempresa) {
		
			$stmt = Connexion::connect()->prepare("SELECT 
			a.idtbluser_2, a.nombre, a.status
			FROM
				$table a
			INNER JOIN
				$table2 b ON a.idtbluser_2 = b.id_usuario
			WHERE
				 b.id_empresa = '$IDempresa' and a.nombre not in ('dsalazar','hcastro','jsegurac')");

			if($stmt->execute()){


			     return $stmt -> fetchAll();
			        // return $stmt ;

			    }else{


			    return $stmt->errorInfo()[2];
			    // return $stmt;

			    }


			// $stmt -> execute();

			// return $stmt -> fetchAll();

// return $stmt;	


		$stmt -> close();

		$stmt =null;

}


/*=============================================
=      CARGAR DATOS USUARIO SELECCIONADO              =
=============================================*/

	static public function MdlCargarUsuarioSeleccionado($table, $value) {

			
			$stmt = Connexion::connect()->prepare("SELECT nombre_usuario, id_usuario FROM  $table WHERE idtbl_usuarios_cliente = '$value'");

			$stmt -> execute();

			return $stmt -> fetch();

// return $stmt;	


		$stmt -> close();

		$stmt =null;

}



/*=============================================
=      CARGAR DATOS USUARIO SELECCIONADO              =
=============================================*/

	static public function MdlEditarEstadoUsuario($table, $value, $estado) {
			


if($estado == "Desabilitado" || $estado == "desabilitado"){


			$stmt = Connexion::connect()->prepare("UPDATE $table SET status='Disponible' WHERE idtbluser_2 = '$value'");


}else{

			$stmt = Connexion::connect()->prepare("UPDATE $table SET status='Desabilitado' WHERE idtbluser_2 = '$value'");


}


			if($stmt->execute()){


     return "OK";
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;


}



//!  nuevos agregados



static public function MdlCargarModulos($table, $IdEmpresa) { 

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table order by secuencia asc");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}

static public function MdlCargarsubModulos($table, $table2, $modulos) { 

	$stmt = Connexion::connect()->prepare("SELECT 
    b.*
FROM
	$table a
        INNER JOIN
	$table2 b ON a.idtbl_modulos_outthebox = b.idModulo
WHERE
    a.nombre = '$modulos'
ORDER BY b.secuencia ASC");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}


static public function MdlBuscarUsuario($table, $table2, $usuarios, $empresaSelected3) { 

	$stmt = Connexion::connect()->prepare("SELECT 
    a.idtbluser_2, a.nombre, b.modulos
FROM
$table a
        INNER JOIN
		$table2 b ON a.idtbluser_2 = b.id_usuario
WHERE
    a.nombre = '$usuarios'
        AND b.id_empresa = '$empresaSelected3'");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}


static public function MdlBuscarUsuario2($table, $usuarios, $empresaSelected2) { 

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table where id_usuario = '$usuarios' and id_empresa='$empresaSelected2'");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}


static public function MdlAgregarPermisosUsiuario($table, $user, $privilegio, $empresaSelected) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table SET modulos='$privilegio' WHERE id_usuario = '$user' and id_empresa = '$empresaSelected'");

	if($stmt->execute()){

		return "ok";
	   
	}else{
   
   
	   return $stmt->errorInfo()[2];
	   // return $stmt;
   
	   }
   
	   $stmt -> close();
   
	   $stmt =null;

}

static public function MdlAgregarUsuarioEmpresa($table, $id_usuario, $id_empresa, $Nombre, $privilegios) { 


	$db = Connexion::connect();

$stmt = $db->prepare("INSERT IGNORE INTO $table(id_usuario, id_empresa, Nombre, privilegios) VALUES (:id_usuario, :id_empresa, :Nombre, privilegios)");

$stmt->bindParam(":id_usuario",$id_usuario, PDO::PARAM_STR); 
$stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR); 
$stmt->bindParam(":Nombre",$Nombre, PDO::PARAM_STR); 
$stmt->bindParam(":privilegios",$privilegios, PDO::PARAM_STR); 
 
	if($stmt->execute()){

	return "ok";

	}else{

	return $stmt->errorInfo()[2];
	// return $stmt;

	}

	$stmt -> close();

	$stmt =null;


}
 

static public function MdlCargarsubModulosMultiple($table, $modulos) { 

	$stmt = Connexion::connect()->prepare("SELECT * FROM $table WHERE idModulo = '$modulos' ORDER BY secuencia ASC");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}

static public function MdlCargarIdUser($table, $nombreUser) { 

	$stmt = Connexion::connect()->prepare("SELECT idtbluser_2 FROM $table where nombre = '$nombreUser'");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}


static public function MdlCargarsubModulosEditar($table, $modulos) { 

	$stmt = Connexion::connect()->prepare("SELECT nombre, idtbl_subModulos_outthebox FROM $table WHERE idtbl_subModulos_outthebox = '$modulos'  ORDER BY nombre ASC");

	$stmt -> execute();

	return $stmt -> fetchAll();
	// return $stmt;

	$stmt -> close();

	$stmt =null;

}


static public function MdlSubModulosEditar($table, $modulosEdit, $UserEdit, $empresaEdit) { 

	$stmt = Connexion::connect()->prepare("UPDATE $table SET modulos='$modulosEdit' WHERE id_usuario = '$UserEdit' and id_empresa = '$empresaEdit'");

	if($stmt->execute()){

		return "ok";
	   
	}else{
   
   
	   return $stmt->errorInfo()[2];
	   // return $stmt;
   
	   }
   
	   $stmt -> close();
   
	   $stmt =null;

}


}