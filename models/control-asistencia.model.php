<?php

require_once "connexion.php";

class ControlAsistenciaModel{


	/*=============================================
=                 CARGAR ID EMPLEADOS                =
=============================================*/

	static public function MdlCargarIDEmpleados($table,$table2,$item, $value,$id_empresa) {

		
	$stmt = Connexion::connect()->prepare("SELECT idtbl_empleados, idtbl_clientes, nombre_completo, $table2.id_empresa FROM  $table,$table2 WHERE $table.id_empresa = '$id_empresa' and $table.$item = '$value' and $table.id_empresa=$table2.id_empresa ");

			$stmt -> execute();

			return $stmt -> fetch();

			//return $stmt 

		$stmt -> close();

		$stmt =null;

}

 
static public function MdlValidarRegistros($table, $empresa, $idempleado) {

		
	$stmt = Connexion::connect()->prepare("SELECT 
     ifnull(id_empleado, 0) 
FROM
$table
WHERE
    id_empresa = '$empresa'
        AND id_empleado = '$idempleado'
        AND DATE(fecha) = CURDATE()");

			$stmt -> execute();

			return $stmt -> fetch();

			// return $stmt;

		$stmt -> close();

		$stmt =null;

} 

static public function MdlAgregarControlAsistencia($table, $idempleado, $codigo, $idempresa) { 


	$db = Connexion::connect();

$stmt = $db->prepare("INSERT INTO $table(id_empleado, codigo, id_empresa) VALUES (:id_empleado, :codigo, :id_empresa)");

$stmt->bindParam(":id_empleado",$idempleado, PDO::PARAM_STR); 
$stmt->bindParam(":codigo",$codigo, PDO::PARAM_STR); 
$stmt->bindParam(":id_empresa",$idempresa, PDO::PARAM_STR); 

if($stmt->execute()){


return $db->lastInsertId();


}else{


return $stmt->errorInfo()[2];


}

$stmt -> close();

$stmt =null;


}





}





