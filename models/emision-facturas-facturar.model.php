<?php
 
require_once "connexion.php";

class emitirFacturasFactModel{

        static public function MdlCargarDetalleFactura($table, $idFactura) {
        
            $stmt = Connexion::connect()->prepare("SELECT * from $table where numeroFactura = '$idFactura'");
            
            $stmt -> execute();

            /*return $stmt;*/

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt =null;

    }

    static public function MdlCargarFactura($table, $idFactura) {
        
        $stmt = Connexion::connect()->prepare("SELECT * from $table where id_factura = '$idFactura'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

}

    static public function MdlModificarDatosFactura($table,  $conse, $clave, $estado, $idfact) { 

        $stmt = Connexion::connect()->prepare("UPDATE $table set consecutivo='$conse', clave='$clave', estado_factura='$estado'  where idtbl_facturacion_emitir_facturas = '$idfact'");


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