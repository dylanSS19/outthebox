<?php

require_once "connexion.php";

class ListasPreciosModel
{

    public static function MdlCargarListaPrecios($table, $idEmpresa)
    {
        $stmt = Connexion::connect()->prepare("SELECT * FROM $table where idempresa = $idEmpresa;");

        $stmt->execute();
        return $stmt->fetchAll();
        //return $stmt;
    }

    public static function MdlModificarLista($table, $id, $nombre, $codigo)
    {

        $stmt = Connexion::connect()->prepare("UPDATE $table
                                            SET nombre = '$nombre', codigo = '$codigo'
                                            WHERE idtbl_listas_precio = $id;"
        );

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "fallo";
        }
    }

    public static function MdlUpdateState($table, $id, $estado)
    {
        $stmt = Connexion::connect()->prepare("UPDATE $table
                                            SET activo = '$estado'
                                            WHERE idtbl_listas_precio = $id;"
        );

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "fallo";
        }
    }

    public static function MdlInsertarLista($table, $nombreLista, $codigoLista, $idEmpresa)
    {
        $stmt = Connexion::connect()->prepare("INSERT INTO $table (nombre, codigo, idempresa, activo)
                                                VALUES ('$nombreLista', '$codigoLista', '$idEmpresa', 'Si');
                                            ");

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "fallo";
        }
    }
}
