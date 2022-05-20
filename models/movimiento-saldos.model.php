 <?php 
 

require_once "connexion.php";

class Movimiento_saldosModel{


static public function MdlCargarClientes($table) {


      $stmt = Connexion::connect()->prepare("SELECT * FROM $table where activo = 'Si'");


      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;


} 


static public function MdlCargarultimototal($table, $cedula) {


      $stmt = Connexion::connect()->prepare("SELECT total FROM $table where bodega = '$cedula' ORDER BY idtbl_inventario DESC LIMIT 1");

if($stmt->execute()){


  return $stmt -> fetchAll();
    

  }else{


  return $stmt->errorInfo()[2];
    // return $stmt;


  }


      $stmt -> close();

    $stmt =null;


}


/*=============================================
=            CARGAR BANCOS ENPRESAS             =
=============================================*/


static public function MdlCargarbanco($table, $cedula) {


$stmt = Connexion::connect()->prepare("SELECT total FROM $table where bodega = '$cedula' ORDER BY idtbl_movimiento_saldos DESC LIMIT 1");

if($stmt->execute()){


  return $stmt -> fetchAll();
    

  }else{


  return $stmt->errorInfo()[2];
    // return $stmt;


  }


      $stmt -> close();

    $stmt =null;


}

/*=============================================
=                 AGREGAR RECARGA SALDO                =
=============================================*/

  static public function MdlAgregarcargasaldo($table, $data) {

   $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(cedula, banco, cuenta, referencia, monto, fecha) VALUES (:cedula, :banco, :cuenta, :referencia, :monto, :fecha)");


    $stmt->bindParam(":cedula",$data["cedula"], PDO::PARAM_STR); 
    $stmt->bindParam(":banco",$data["banco"], PDO::PARAM_STR); 
    $stmt->bindParam(":cuenta",$data["cuenta"], PDO::PARAM_STR); 
    $stmt->bindParam(":referencia",$data["referencia"], PDO::PARAM_STR); 
    $stmt->bindParam(":monto",$data["monto"], PDO::PARAM_STR); 
    $stmt->bindParam(":fecha",$data["fecha"], PDO::PARAM_STR); 
                    


    if($stmt->execute()){


    return $db->lastInsertId();
    

    }else{


    return $stmt->errorInfo()[2];


    }

    $stmt -> close();

    $stmt =null;


}

/*=============================================
=                 AGREGAR MOVIMIENTO SALDO                =
=============================================*/

  static public function MdlAgregarmovimientosaldo($table, $data) {

   $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(movimiento_numero, consecutivo, tipo_movimiento, codigo, producto, stock, cantidad, origen, destino, total, usuario, estado, bodega, cedula_cliente) VALUES (:movimiento_numero, :consecutivo, :tipo_movimiento, :codigo, :producto, :stock, :cantidad, :origen, :destino, :total, :usuario, :estado, :bodega, :cedula_cliente)");

    $stmt->bindParam(":movimiento_numero",$data["movimiento_numero"], PDO::PARAM_STR); 
    $stmt->bindParam(":consecutivo",$data["consecutivo"], PDO::PARAM_STR); 
    $stmt->bindParam(":tipo_movimiento",$data["tipo_movimiento"], PDO::PARAM_STR); 
    $stmt->bindParam(":codigo",$data["codigo"], PDO::PARAM_STR); 
    $stmt->bindParam(":producto",$data["producto"], PDO::PARAM_STR); 
    $stmt->bindParam(":stock",$data["stock"], PDO::PARAM_STR);                 
    $stmt->bindParam(":cantidad",$data["cantidad"], PDO::PARAM_STR); 
    $stmt->bindParam(":origen",$data["origen"], PDO::PARAM_STR); 
    $stmt->bindParam(":destino",$data["destino"], PDO::PARAM_STR); 
    $stmt->bindParam(":total",$data["total"], PDO::PARAM_STR); 
    $stmt->bindParam(":usuario",$data["usuario"], PDO::PARAM_STR); 
    $stmt->bindParam(":estado",$data["estado"], PDO::PARAM_STR); 
    $stmt->bindParam(":bodega",$data["bodega"], PDO::PARAM_STR);
    $stmt->bindParam(":cedula_cliente",$data["cedula_cliente"], PDO::PARAM_STR); 

   if($stmt->execute()){


    return "OK";
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;

}


static public function MdlCargarbodegas($table, $table2, $cedula) {


      $stmt = Connexion::connect()->prepare("SELECT * FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.cedula = '$cedula'");


      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;


} 

  static public function MdlAgregarsaldobodega($table, $data) {

   $db = Connexion::connect();

    $stmt = $db->prepare("UPDATE  $table SET saldo= :saldo WHERE idtbl_bodegas= :idtbl_bodegas");

    $stmt->bindParam(":idtbl_bodegas",$data["idtbl_bodegas"], PDO::PARAM_STR); 
    $stmt->bindParam(":saldo",$data["saldo"], PDO::PARAM_STR); 


   if($stmt->execute()){


    return "OK";
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;

}



}