<?php

require_once "connexion.php";

class SalidaEmpleadosModel
{

    /*=============================================
    =                 CARGAR EMPLEADOS                =
    =============================================*/

    public static function MdlCargarEmpleados($table, $id_empresa, $supervisor)
    {

        if ($supervisor == "") {
            $stmt = Connexion::connect()->prepare("SELECT cedula,nombre_completo FROM  $table WHERE id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");

        } else {

            $stmt = Connexion::connect()->prepare("SELECT cedula,nombre_completo FROM  $table WHERE departamento in
			(SELECT idtbl_departamento FROM empresas.tbl_departamento where id_empresa = '$id_empresa' and nombre like 'Tiend%')
			and id_empresa = '$id_empresa' and activo = 'Si' order by nombre_completo");
        }

        $stmt->execute();

        return $stmt->fetchAll();

/*return $stmt;
 */

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    =                 CARGAR PUESTOS                =
    =============================================*/

    public static function MdlCargarMotivos($table, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("SELECT idtbl_motivos_despido,nombre FROM $table where  id_empresa = '$id_empresa' and activo = 'Si' order by nombre asc");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    =                 CARGAR CORREOS                =
    =============================================*/

    public static function MdlCargarCorreo($table, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("SELECT correo FROM $table where  id_empresa = '$id_empresa' and modulo = 'planilla'");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    =            CARGAR CORREOS EMPLEADOS           =
    =============================================*/

    public static function MdlCargarCorreoEmpleado($item, $value, $table, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("SELECT mail FROM $table where cedula = '$value' AND id_empresa = '$id_empresa';");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=                 ADD SALIDA PERSONAL                =
=============================================*/

    public static function MdlSalidaEmpleado($table, $estado, $idtbl_empleados, $motivo_salida, $fecha_salida, $comentarios_salida, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("UPDATE $table SET activo = :activo, motivo_salida = :motivo_salida,fecha_salida = :fecha_salida,comentarios_salida = :comentarios_salida where cedula = :cedula AND id_empresa = :id_empresa");

        $stmt->bindParam(":activo", $estado, PDO::PARAM_STR);

        $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_STR);

        $stmt->bindParam(":cedula", $idtbl_empleados, PDO::PARAM_STR);

        $stmt->bindParam(":motivo_salida", $motivo_salida, PDO::PARAM_STR);

        $stmt->bindParam(":fecha_salida", $fecha_salida, PDO::PARAM_STR);

        $stmt->bindParam(":comentarios_salida", $comentarios_salida, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return $stmt->errorInfo()[2];

        }

        $stmt->close();

        $stmt = null;

    }

}
