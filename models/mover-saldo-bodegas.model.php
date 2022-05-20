<?php

require_once "connexion.php";

class MoverSaldoModel{

/*=============================================
=       CARGAR BODEGAS X CLIENTE              =
=============================================*/

static public function MdlBodegasCliente($table,$table2, $value) { 


	$stmt = Connexion::connect()->prepare("SELECT idtbl_bodegas, a.nombre, a.codigo, sede, a.activo, centrocosto, ubicacion, cuenta, cliente, saldo, b.nombre as cliente FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes");  

		   $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;

}


/*=============================================
=       CARGAR BODEGAS X CLIENTE              =
=============================================*/

static public function MdlCargarBodegasxusuario($table,$table2, $value) { 


	$stmt = Connexion::connect()->prepare("SELECT idtbl_bodegas, a.nombre, a.codigo, sede, a.activo, centrocosto, ubicacion, cuenta, cliente, saldo  FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.id_usuario = '$value'");  


		   $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;

}



/*=============================================
=       CARGAR CLIENTE X USUARIO             =
=============================================*/

static public function MdlCargarClientesXusuario($table,$table2, $value) { 


	$stmt = Connexion::connect()->prepare("SELECT b.cedula  FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.id_usuario = '$value'");  


		   $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;

}


/*=============================================
=       CARGAR CLIENTE X ID             =
=============================================*/

static public function MdlCargarClientesXid($table,$table2, $value){ 

	$stmt = Connexion::connect()->prepare("SELECT b.cedula  FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.idtbl_clientes = '$value'");  

		   $stmt -> execute();

      return $stmt-> fetchAll();

      $stmt -> close();

    $stmt =null;

}


/*=============================================
=       CARGAR BODEGAS X CLIENTE              =
=============================================*/

static public function MdlCargarSalarioBodega($table, $value) { 

	$stmt = Connexion::connect()->prepare("SELECT saldo FROM $table  where idtbl_bodegas = '$value'");  


		   $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

    $stmt =null;

}
 


 /*=============================================
=       CARGAR BODEGAS X CLIENTE              =
=============================================*/

static public function MdlCargarBodegasxcliente($table,$table2, $value) { 


	$stmt = Connexion::connect()->prepare("SELECT idtbl_bodegas, a.nombre, a.codigo, sede, a.activo, centrocosto, ubicacion, cuenta, cliente, saldo  FROM $table a inner join $table2 b on a.cliente = b.idtbl_clientes where b.idtbl_clientes = '$value'");  

		   $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

    $stmt =null;

}



static public function MdlCargarultimototal($table, $cedula) {


$stmt = Connexion::connect()->prepare("SELECT total,movimiento_numero FROM $table where bodega = '$cedula' ORDER BY idtbl_inventario DESC LIMIT 1");

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
=                 AGREGAR MOVIMIENTO SALDO                =
=============================================*/

  static public function MdlAgregarmovimiento($table, $data_inventario) {

   $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(movimiento_numero, consecutivo, tipo_movimiento, codigo, producto, stock, cantidad, origen, destino, total, usuario, estado, bodega, cedula_cliente) VALUES (:movimiento_numero, :consecutivo, :tipo_movimiento, :codigo, :producto, :stock, :cantidad, :origen, :destino, :total, :usuario, :estado, :bodega, :cedula_cliente)");

    $stmt->bindParam(":movimiento_numero",$data_inventario["movimiento_numero"], PDO::PARAM_STR); 
    $stmt->bindParam(":consecutivo",$data_inventario["consecutivo"], PDO::PARAM_STR); 
    $stmt->bindParam(":tipo_movimiento",$data_inventario["tipo_movimiento"], PDO::PARAM_STR); 
    $stmt->bindParam(":codigo",$data_inventario["codigo"], PDO::PARAM_STR); 
    $stmt->bindParam(":producto",$data_inventario["producto"], PDO::PARAM_STR); 
    $stmt->bindParam(":stock",$data_inventario["stock"], PDO::PARAM_STR);                 
    $stmt->bindParam(":cantidad",$data_inventario["cantidad"], PDO::PARAM_STR); 
    $stmt->bindParam(":origen",$data_inventario["origen"], PDO::PARAM_STR); 
    $stmt->bindParam(":destino",$data_inventario["destino"], PDO::PARAM_STR); 
    $stmt->bindParam(":total",$data_inventario["total"], PDO::PARAM_STR); 
    $stmt->bindParam(":usuario",$data_inventario["usuario"], PDO::PARAM_STR); 
    $stmt->bindParam(":estado",$data_inventario["estado"], PDO::PARAM_STR); 
    $stmt->bindParam(":bodega",$data_inventario["bodega"], PDO::PARAM_STR);
    $stmt->bindParam(":cedula_cliente",$data_inventario["cedula_cliente"], PDO::PARAM_STR); 

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
=                 AGREGAR MOVIMIENTO                 =
=============================================*/

  static public function Mdleditarsaldo($table, $data_bodegas) {

   $db = Connexion::connect();

    $stmt = $db->prepare("UPDATE $table SET saldo = :saldo WHERE idtbl_bodegas = :idtbl_bodegas");

    $stmt->bindParam(":saldo",$data_bodegas["saldo"], PDO::PARAM_STR); 
    $stmt->bindParam(":idtbl_bodegas",$data_bodegas["idtbl_bodegas"], PDO::PARAM_STR); 
    

   if($stmt->execute()){


    return "OK";
    

    }else{


    return $stmt->errorInfo()[2];
    // return $stmt;

    }

    $stmt -> close();

    $stmt =null;

}




static public function MdlCargarSaldoBodegas($table, $value_bodega) {

$stmt = Connexion::connect()->prepare("SELECT saldo FROM $table where idtbl_bodegas = '$value_bodega'");

if($stmt->execute()){


  return $stmt -> fetch();
    

  }else{


  return $stmt->errorInfo()[2];
    // return $stmt;


  }


      $stmt -> close();

    $stmt =null;


}









}