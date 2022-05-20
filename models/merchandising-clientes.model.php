<?php
 
require_once "connexion.php";

class MerchandisingClientesModel{

    

    static public function MdlAgregarCliente($table, $id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud) { 

        $db = Connexion::connect();

        $stmt = $db->prepare("INSERT INTO $table(id_empresa, Nombre, tipo_cedula, cedula, correo, telefono, provincia, canton, distrito, direccion, diaVisita, longitud, latitud, nombre_fantasia) VALUES(:id_empresa, :Nombre, :tipo_cedula, :cedula, :correo, :telefono, :provincia, :canton, :distrito, :direccion, :diaVisita, :longitud, :latitud, :nombre_fantasia)");
    
    $stmt->bindParam(":id_empresa",$id_empresa, PDO::PARAM_STR);
    $stmt->bindParam(":Nombre",$nombreC, PDO::PARAM_STR);
    $stmt->bindParam(":tipo_cedula",$tipo_CedulaC, PDO::PARAM_STR);
    $stmt->bindParam(":cedula",$cedulaC, PDO::PARAM_STR);
    $stmt->bindParam(":correo",$correoC, PDO::PARAM_STR);
    $stmt->bindParam(":telefono",$telefonoC, PDO::PARAM_STR);
    $stmt->bindParam(":provincia",$provinciaC, PDO::PARAM_STR);
    $stmt->bindParam(":canton",$CantonC, PDO::PARAM_STR);
    $stmt->bindParam(":distrito",$distritoC, PDO::PARAM_STR);
    $stmt->bindParam(":direccion",$direccionC, PDO::PARAM_STR);
    $stmt->bindParam(":diaVisita",$diasVisita, PDO::PARAM_STR);
    $stmt->bindParam(":longitud",$longitud, PDO::PARAM_STR);
    $stmt->bindParam(":latitud",$latitud, PDO::PARAM_STR);
    $stmt->bindParam(":nombre_fantasia",$nombreC, PDO::PARAM_STR);

    //return $stmt;
    if($stmt->execute()){

        return $db->lastInsertId();;
    }

    else{

        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;

    }


}