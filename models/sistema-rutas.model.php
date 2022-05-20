<?php

require_once "connexion.php";

class RutasModel{

        static public function mdlCargarClientesRuta($table, $idRuta, $diaVis) {
        
            $stmt = Connexion::connect()->prepare("SELECT * from $table where ruta = '$idRuta' and diaVisita like '%$diaVis%' order by secuencia asc");
            
            $stmt -> execute();

            /*return $stmt;*/

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt =null;

    }

    static public function mdlCargarIDruta($table, $idusuario) {
        
        $stmt = Connexion::connect()->prepare("SELECT * FROM empresas.tbl_rutas where usuario = '$idusuario'");
        
        $stmt -> execute();

        /*return $stmt;*/

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt =null;

}

 
static public function mdlInsertNocompraRuta($table, $comentario, $ruta, $cliente, $longitud, $latitud) {

    $db = Connexion::connect();

    $stmt = $db->prepare("INSERT INTO $table(cliente, ruta, latitud, longitud, comentario) VALUES (:cliente, :ruta, :latitud, :longitud, :comentario)");

    $stmt->bindParam(":cliente",$cliente, PDO::PARAM_STR);
    $stmt->bindParam(":ruta",$ruta, PDO::PARAM_STR);
    $stmt->bindParam(":latitud",$latitud, PDO::PARAM_STR);
    $stmt->bindParam(":longitud",$longitud, PDO::PARAM_STR);
    $stmt->bindParam(":comentario",$comentario, PDO::PARAM_STR);
   
    if($stmt->execute()){

        return $db->lastInsertId();
    }else{
 
        return $stmt->errorInfo()[2];
    }

    $stmt -> close();

    $stmt =null;


}


}