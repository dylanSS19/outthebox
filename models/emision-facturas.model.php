<?php

require_once "connexion.php";


class  EmisionFacturasModel{

	static public function MdlCargarFacturas($table, $data) { 

        $where = "";

        if($data["ruta"] == ""){

            $where .= 'fecha_factura between "'.$data["fechaInicio"].' 00:00:00" and "'.$data["FechaFin"].' 23:59:59" and id_compania = "'.$data["empresa"].'" and estado_factura = "Pendiente"';

        }else{

            $where .= 'fecha_factura between "'.$data["fechaInicio"].' 00:00:00" and "'.$data["FechaFin"].' 23:59:59" and ruta = "'.$data["ruta"].'" and id_compania = "'.$data["empresa"].'" and estado_factura = "Pendiente"';

        }

        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $where");

        $stmt -> execute();
    
        return $stmt -> fetchAll();
    
    // return $stmt;	

    
    $stmt -> close();
    
    $stmt =null;


    }


    static public function MdlCargarFacturasXruta($table, $data) { 


        $where = "";
        
        $where .= 'fecha_factura between "'.$data["fechaInicio"].' 00:00:00" and "'.$data["FechaFin"].' 23:59:59" and ruta = "'.$data["ruta"].'" and id_compania = "'.$data["empresa"].'" and estado_factura = "Pendiente"';


        $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE $where");

        $stmt -> execute();
 
        return $stmt -> fetchAll();
    
        // return $stmt;	
        
        
        $stmt -> close();
        
        $stmt =null;


    }
 

    static public function MdlCargarrutasXusuario($table, $idUsuario) { 

    $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE id_usuario = '$idUsuario'");

    $stmt -> execute();

    // return $stmt -> fetchAll();

    return $stmt;	


    $stmt -> close();

    $stmt =null;


}



static public function MdlCargarrutas($table) { 

    $stmt = Connexion::connect()->prepare("SELECT * FROM  $table");

    $stmt -> execute();

    return $stmt -> fetchAll();

    /*return $stmt;	
    */

    $stmt -> close();

    $stmt =null;


}



static public function MdlCargarusuariorutas($table, $idUsuario) { 

    $stmt = Connexion::connect()->prepare("SELECT * FROM  $table WHERE id_usuario = '$idUsuario'");

    $stmt -> execute();

    return $stmt -> fetchAll();

    // return $stmt;	


    $stmt -> close();

    $stmt =null;


}


static public function MdlModificarEstadoFactura($table, $idFactura) { 

    $stmt = Connexion::connect()->prepare("UPDATE $table set estado_factura='Cancelado'  where idtbl_facturacion_emitir_facturas = '$idFactura'");


if($stmt->execute()){

    return "ok";
}

else{

    return $stmt->errorInfo()[2];
}

$stmt -> close();

$stmt =null;

}


    static public function MdlAgregarFactura($table, $data) { 


        $db = Connexion::connect();

        $stmt = $db->prepare("INSERT INTO $table(id_compania, sucursal, caja, fecha_factura, tipo_documento, codigo_actividad, tipo_personeria, cedula_cliente, nombre_cliente, correo_cliente, tipo_cambio, codigo_moneda, estado_factura, plazo_credito, medios_pago, numeroFactura, ruta, vendedor) VALUES (:id_compania, :sucursal, :caja, :fecha_factura, :tipo_documento, :codigo_actividad, :tipo_personeria, :cedula_cliente, :nombre_cliente, :correo_cliente, :tipo_cambio, :codigo_moneda, :estado_factura, :plazo_credito, :medios_pago, :numeroFactura, :ruta, :vendedor)");

        $stmt->bindParam(":id_compania",$data["empresa"], PDO::PARAM_STR); 
        $stmt->bindParam(":sucursal",$data["sucursal"], PDO::PARAM_STR); 
        $stmt->bindParam(":caja",$data["caja"], PDO::PARAM_STR); 
        $stmt->bindParam(":fecha_factura",$data["fecha_factura"], PDO::PARAM_STR); 
        $stmt->bindParam(":tipo_documento",$data["tipo_documento"], PDO::PARAM_STR); 
        $stmt->bindParam(":codigo_actividad",$data["codigo_actividad"], PDO::PARAM_STR);                 
        $stmt->bindParam(":tipo_personeria",$data["tipo_personeria"], PDO::PARAM_STR); 
        $stmt->bindParam(":cedula_cliente",$data["cedulaCliente"], PDO::PARAM_STR); 
        $stmt->bindParam(":nombre_cliente",$data["nombreCliente"], PDO::PARAM_STR); 
        $stmt->bindParam(":correo_cliente",$data["CorreoCliente"], PDO::PARAM_STR);                 
        $stmt->bindParam(":tipo_cambio",$data["tipo_cambio"], PDO::PARAM_STR); 
        $stmt->bindParam(":codigo_moneda",$data["codigo_moneda"], PDO::PARAM_STR); 
        $stmt->bindParam(":estado_factura",$data["estado_factura"], PDO::PARAM_STR); 
        $stmt->bindParam(":plazo_credito",$data["plazo_credito"], PDO::PARAM_STR);                 
        $stmt->bindParam(":medios_pago",$data["medios_pago"], PDO::PARAM_STR); 
        $stmt->bindParam(":numeroFactura",$data["numFactura"], PDO::PARAM_STR); 
        $stmt->bindParam(":ruta",$data["Agente_Reparto"], PDO::PARAM_STR); 
        $stmt->bindParam(":vendedor",$data["vendedor"], PDO::PARAM_STR); 


        


        if($stmt->execute()){

            return $db->lastInsertId();

        }else{
            return $stmt->errorInfo()[2];
        // return $stmt;

        }

    $stmt -> close();

    $stmt =null;


    }



    static public function MdlAgregarDetalleFactura($table, $data) { 


        $db = Connexion::connect();

        $stmt = $db->prepare("INSERT INTO $table(id_factura, codigo, nombre, cantidad, precio_unidad, subtotal, descuento, impuesto, total, costo, cabys, tasa_Impuesto, codImpuesto, codTasaImp, porcentaje_descuento) VALUES (:id_factura, :codigo, :nombre, :cantidad, :precio_unidad, :subtotal, :descuento, :impuesto, :total, :costo, :cabys, :tasa_Impuesto, :codImpuesto, :codTasaImp, :porcentaje_descuento)");

        $stmt->bindParam(":id_factura",$data["id_factura"], PDO::PARAM_STR); 
        $stmt->bindParam(":codigo",$data["codigo"], PDO::PARAM_STR); 
        $stmt->bindParam(":nombre",$data["nombre"], PDO::PARAM_STR); 
        $stmt->bindParam(":cantidad",$data["cantidad"], PDO::PARAM_STR); 
        $stmt->bindParam(":precio_unidad",$data["precio_unidad"], PDO::PARAM_STR); 
        $stmt->bindParam(":subtotal",$data["subtotal"], PDO::PARAM_STR);                 
        $stmt->bindParam(":descuento",$data["descuento"], PDO::PARAM_STR); 
        $stmt->bindParam(":impuesto",$data["impuesto"], PDO::PARAM_STR); 
        $stmt->bindParam(":total",$data["total"], PDO::PARAM_STR); 
        $stmt->bindParam(":costo",$data["costo"], PDO::PARAM_STR);                 
        $stmt->bindParam(":cabys",$data["cabys"], PDO::PARAM_STR); 
        $stmt->bindParam(":tasa_Impuesto",$data["tasa_Impuesto"], PDO::PARAM_STR); 
        $stmt->bindParam(":codImpuesto",$data["codImpuesto"], PDO::PARAM_STR); 
        $stmt->bindParam(":codTasaImp",$data["codTasaImp"], PDO::PARAM_STR);     
        $stmt->bindParam(":porcentaje_descuento",$data["porcentaje_descuento"], PDO::PARAM_STR);     

                      

        if($stmt->execute()){

            return $db->lastInsertId();

        }else{
            return $stmt->errorInfo()[2];
        // return $stmt;

        }

    $stmt -> close();

    $stmt =null;


    }


    static public function MdlCargarDatosFactura($table, $idFactura) {
        
            $stmt = Connexion::connect()->prepare("SELECT * from $table where idtbl_facturacion_emitir_facturas = '$idFactura'");
            
            $stmt -> execute();

            // return $stmt;

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt =null;

    }

    static public function MdlCargarDatosDetalleFactura($table, $idFactura) {
        
        $stmt = Connexion::connect()->prepare("SELECT * from $table where id_factura = '$idFactura'");
        
        $stmt -> execute();

        // return $stmt;

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

}

}