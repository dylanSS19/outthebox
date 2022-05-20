<?php
 
require_once "connexion.php";

class ConsultaEmpleadosModel{


	/*=============================================
=                 CARGAR EMPLEADOS                =
=============================================*/

	static public function MdlCargarEmpleados($table,$id_empresa,$supervisor) {

			if($supervisor==""){
$stmt = Connexion::connect()->prepare("SELECT idtbl_empleados,nombre_completo FROM  $table WHERE id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");

			}else{

$stmt = Connexion::connect()->prepare("SELECT idtbl_empleados,nombre_completo FROM  $table WHERE departamento in(SELECT idtbl_departamento FROM empresas.tbl_departamento where id_empresa = '$id_empresa' and nombre like '$supervisor%') and id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");
			}

			

			$stmt -> execute();

			return $stmt -> fetchAll();

/*return $stmt;	
*/

		$stmt -> close();

		$stmt =null;

}



	/*============================================= 
=                 CARGAR DATOS EMPLEADOS                =
=============================================*/

	static public function MdlCargarDatosEmpleados($table,$table2,$table3,$item, $value) {

	
$stmt = Connexion::connect()->prepare("SELECT activo,cedula,nombre_completo,fecha_nacimiento,telefono,direccion,fecha_ingreso,$table2.nombre as departamento,$table3.nombre as puesto,cuenta,motivo_salida, idtbl_empleados FROM  $table,$table2,$table3 WHERE departamento=idtbl_departamento and puesto=idtbl_puestos and $table.$item = '$value'");

			$stmt -> execute();

			return $stmt -> fetch();

/*return $stmt;	
*/

		$stmt -> close();

		$stmt =null;

}
	




}





