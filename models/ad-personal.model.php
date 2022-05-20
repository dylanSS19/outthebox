<?php

require_once "connexion.php";

class AdPersonalModel{
 

	/*=============================================
=                 CARGAR EMPLEADOS                =
=============================================*/

	static public function MdlCargarEmpleados($table,$id_empresa,$supervisor) {

			if($supervisor==""){
$stmt = Connexion::connect()->prepare("SELECT cedula,nombre_completo FROM  $table WHERE id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");

			}else{

$stmt = Connexion::connect()->prepare("SELECT cedula,nombre_completo FROM  $table WHERE departamento in(SELECT idtbl_departamento FROM empresas.tbl_departamento where id_empresa = '$id_empresa' and nombre like '$supervisor%') and id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");
			}

			

			$stmt -> execute();

			return $stmt -> fetchAll();

return $stmt;	


		$stmt -> close();

		$stmt =null;

}


	/*=============================================
=                 CARGAR SALARIOS EMPLEADOS                =
=============================================*/

	static public function MdlCargarSalariosEmpleados($table,$item, $value,$id_empresa) {

		
$stmt = Connexion::connect()->prepare("SELECT salario_base FROM  $table WHERE id_empresa = '$id_empresa' and $item = '$value' ");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

}



	/*=============================================
=                 CARGAR FECHAS NOMINAS                =
=============================================*/

	static public function MdlCargarFechasNominas($table,$item, $value,$id_empresa) {

$stmt = Connexion::connect()->prepare("SELECT fecha_desde,fecha_hasta FROM  $table WHERE id_empresa = '$id_empresa' and $item = '$value' ");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

}


	/*=============================================
=                 CARGAR CONCEPTOS AD PERSONAL                =
=============================================*/

	static public function MdlCargarConceptosADPersonal($table,$id_empresa) {

		
$stmt = Connexion::connect()->prepare("SELECT idtbl_conceptos,concat(nombre,' - ', tipo) as nombre FROM  $table WHERE id_empresa = '$id_empresa' and nomina_web='Si'");

			$stmt -> execute();

			return $stmt -> fetchAll();

 		$stmt -> close();

		$stmt =null;

}

	/*=============================================
=                 CARGAR NOMINAS AD PERSONAL                =
=============================================*/

	static public function MdlCargarNominas($table,$id_empresa) {

		
$stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE estado='Pendiente' and id_empresa = '$id_empresa' order by fecha_desde");

			$stmt -> execute();

			return $stmt -> fetchAll();

 		$stmt -> close();

		$stmt =null;

}


	/*=============================================
=                 CARGAR VARIABLES CONCEPTOS AD PERSONAL                =
=============================================*/

	static public function MdlCargarVariablesConceptos($table,$item, $value,$id_empresa) {

		
$stmt = Connexion::connect()->prepare("SELECT aplica_para,formula,variable,codigo FROM  $table WHERE id_empresa = '$id_empresa' and $item = '$value'");

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt =null;

}


/*=============================================
=                 ADD AD PERSONAL                =
=============================================*/

	static public function MdlAgregarNomina($table, $data) {

		$stmt = Connexion::connect()->prepare("INSERT INTO $table(cedula,concepto,nomina_aplica,aplicacion_ordinaria,periodo_nomina,tipo_nomina,modo_aplicacion,aplicacion_especial,horas_extras,dias,monto, fecha_desde, fecha_hasta, comentarios, user,  id_empresa,id_nomina) VALUES (:cedula,:concepto,:nomina_aplica,:aplicacion_ordinaria,:periodo_nomina,:tipo_nomina,:modo_aplicacion,:aplicacion_especial,:horas_extras,:dias,:monto,:fecha_desde,:fecha_hasta,:comentarios,:user,:id_empresa,:id_nomina)");

		$stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto",$data["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":nomina_aplica",$data["nomina_aplica"], PDO::PARAM_STR);
		$stmt->bindParam(":aplicacion_ordinaria",$data["aplicacion_ordinaria"], PDO::PARAM_STR);
		$stmt->bindParam(":periodo_nomina",$data["periodo_nomina"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_nomina",$data["tipo_nomina"], PDO::PARAM_STR);
		$stmt->bindParam(":modo_aplicacion",$data["modo_aplicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":aplicacion_especial",$data["aplicacion_especial"], PDO::PARAM_STR);
	    $stmt->bindParam(":horas_extras",$data["horas_extras"], PDO::PARAM_STR);
		$stmt->bindParam(":dias",$data["dias"], PDO::PARAM_STR);
		$stmt->bindParam(":monto",$data["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_desde",$data["fecha_desde"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_hasta",$data["fecha_hasta"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios",$data["comentarios"], PDO::PARAM_STR);
		$stmt->bindParam(":user",$data["user"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empresa",$data["id_empresa"], PDO::PARAM_STR);	
		$stmt->bindParam(":id_nomina",$data["id_nomina"], PDO::PARAM_STR);

		if($stmt->execute()){


		return "ok";
		

		}else{


		return $stmt->errorInfo()[2];


		}

		$stmt -> close();

		$stmt =null;


}




}





