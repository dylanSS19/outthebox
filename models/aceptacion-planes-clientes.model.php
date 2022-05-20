<?php

require_once "connexion.php";

class AceptacionPlanesModel{
 

/*=============================================
=                 CARGAR PLANES CLIENTES     =
=============================================*/

	static public function MdlCargarPlanes($table, $table2) {    

        $stmt = Connexion::connect()->prepare("SELECT idtbl_clientes_planes, b.nombre, nombrePlan, total_pagar, estado,fotoComprobante, clave FROM $table a inner join empresas.tbl_clientes b on a.cliente = b.idtbl_clientes WHERE estado = 'Pendiente' ");
                            
            $stmt -> execute();

            return $stmt -> fetchAll();

            return $stmt;	


            $stmt -> close();

            $stmt =null;

        }

        static public function MdlCargarCargarPlanesID($table, $table2, $table3, $idPlanCliente) {    

            $stmt = Connexion::connect()->prepare("SELECT b.nombre, cedula, email, telefono, direccion, privilegio, nombrePlan, total_pagar, fotoComprobante, clave, idtbl_clientes_planes, modulos, idtbl_clientes FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes inner join $table3 c on a.idPlan = c.idtbl_categoria_planes where idtbl_clientes_planes = '$idPlanCliente'");
                                
                $stmt -> execute();
    
                return $stmt -> fetchAll();
    
                return $stmt;	
    
    
                $stmt -> close();
    
                $stmt =null;
    
            }

            static public function MdlCargarDatosEmpresa($table, $IdEmpresa, $Idplan) {    

                $stmt = Connexion::connect()->prepare("SELECT b.nombre, cedula, email, telefono, direccion, privilegio, nombrePlan, fecha_fin, cantDocumentos, precio, total_pagar, fotoComprobante, clave, idtbl_clientes_planes, modulos FROM empresas.tbl_clientes_planes a inner join empresas.tbl_clientes b on a.cliente = b.idtbl_clientes inner join empresas.tbl_categoria_planes c on a.idPlan = c.idtbl_categoria_planes where idtbl_clientes_planes = '$Idplan'");
                                    
                    $stmt -> execute();
        
                    return $stmt -> fetchAll();
        
                    return $stmt;	
        
        
                    $stmt -> close();
        
                    $stmt =null;
        
                }

        static public function MdlAceptarSuscripcion($table, $idPlanCliente, $Acept) {

				$stmt = Connexion::connect()->prepare("UPDATE $table SET estado=:estado WHERE idtbl_clientes_planes=:idtbl_clientes_planes");				

			$stmt->bindParam(":estado",$Acept, PDO::PARAM_STR);
			$stmt->bindParam(":idtbl_clientes_planes",$idPlanCliente, PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";
		}

		else{

			return $stmt->errorInfo()[2];
		}

		$stmt -> close();

		$stmt =null;


	}

    static public function MdlModificarPrivilegios($table, $modulos, $IdEmpresa) {

        $stmt = Connexion::connect()->prepare("UPDATE $table SET privilegio=:privilegio WHERE idtbl_clientes=:idtbl_clientes");				

    $stmt->bindParam(":privilegio",$modulos, PDO::PARAM_STR);
    $stmt->bindParam(":idtbl_clientes",$IdEmpresa, PDO::PARAM_STR);


if($stmt->execute()){

    return "ok";
}

else{

    return $stmt->errorInfo()[2];
}

$stmt -> close();

$stmt =null;


}

}