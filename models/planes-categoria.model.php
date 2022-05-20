<?php
 
require_once "connexion.php";
 
class  PlanesCategoriasModel{


        static public function MdlCargarPlanes($table) {

                
            $stmt = Connexion::connect()->prepare("SELECT * from $table");

            $stmt -> execute();

            return $stmt -> fetchAll();

        // return $stmt;	


            $stmt -> close();

            $stmt =null;

    }

    static public function MdlAgregarCategoria($table, $modulosPaquete, $nombrePaquete, $skuPaquete, $cabysPaquete, $planesPaquete, $diasPaquete, $precioPaquete , $ivaPaquete, $codTarifaPaquete, $tarifaPaquete, $moneda) { 

        $stmt = Connexion::connect()->prepare("INSERT INTO $table(nombre, sku, cabys, cantidadDocumentos, dias, modulos, precio, codigoIva, codigoTarifa, tarifaIva, moneda) VALUES(:nombre, :sku, :cabys, :cantidadDocumentos, :dias, :modulos, :precio, :codigoIva, :codigoTarifa, :tarifaIva, :moneda)");

        $stmt->bindParam(":nombre",$nombrePaquete, PDO::PARAM_STR);
        $stmt->bindParam(":sku",$skuPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":cabys",$cabysPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":cantidadDocumentos",$planesPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":dias",$diasPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":modulos",$modulosPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":precio",$precioPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":codigoIva",$ivaPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":codigoTarifa",$codTarifaPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":tarifaIva",$tarifaPaquete, PDO::PARAM_STR);
        $stmt->bindParam(":moneda",$moneda, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";
        }

        else{

            return $stmt->errorInfo()[2];
        }

        $stmt -> close();

        $stmt =null;

    }

    static public function MdlCargarCategorias($table) {
         
        $stmt = Connexion::connect()->prepare("SELECT * from $table order by idtbl_categoria_planes asc");

        $stmt -> execute();

        return $stmt -> fetchAll();

    // return $stmt;	


        $stmt -> close();

        $stmt =null;

}


static public function MdlValidarPaquetes($table, $plan, $paquete) {
               
    $stmt = Connexion::connect()->prepare("SELECT IF( EXISTS(
        SELECT *
        FROM $table
        WHERE nombre =  '$paquete' AND plan = '$plan'), 1, 0)");

    $stmt -> execute();

    return $stmt -> fetch();

// return $stmt;	


    $stmt -> close();

    $stmt =null;

}

static public function MdlCargarCategoriaEditar($table, $categorias) {

                
    $stmt = Connexion::connect()->prepare("SELECT * from $table  where idtbl_categoria_planes = '$categorias'");

    $stmt -> execute();

    return $stmt -> fetchAll();

// return $stmt;	


    $stmt -> close();

    $stmt =null;

}


static public function MdlModificarCategoria($table, $editaridPaquete, $editarNombre, $editarSku, $editarCabys, $editarCantDocumentos, $editarDias, $editarPrecio, $editarMoneda) { 

    $stmt = Connexion::connect()->prepare("UPDATE $table SET nombre='$editarNombre', sku='$editarSku', cabys='$editarCabys', cantidadDocumentos='$editarCantDocumentos', dias='$editarDias', precio='$editarPrecio', moneda='$editarMoneda'  where idtbl_categoria_planes = '$editaridPaquete'");

    if($stmt->execute()){

        return "ok";
    }

    else{

        // return $stmt;

        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;

}


static public function MdlModificarEstado($table, $fecha, $estado, $IdPaq) { 

    $stmt = Connexion::connect()->prepare("UPDATE $table SET estado='$estado', fechaFinalizacion='$fecha'  where idtbl_categoria_planes = '$IdPaq'");

    if($stmt->execute()){

        return "ok";
    }

    else{

        // return $stmt;

        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;

}


}