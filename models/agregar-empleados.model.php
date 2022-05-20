<?php

require_once "connexion.php";

class AgregarEmpleadosModel
{

    /*=============================================
    =                 CARGAR EMPLEADOS                =
    =============================================*/

    public static function MdlCargarEmpleados($table, $item, $value, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("SELECT cedula,nombre_completo FROM $table where  id_empresa = '$id_empresa' and $item = '$value'");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    =                 CARGAR PUESTOS                =
    =============================================*/

    public static function MdlCargarPuestos($table, $item, $value, $id_empresa)
    {

        $stmt = Connexion::connect()->prepare("SELECT idtbl_puestos,nombre FROM $table where  id_empresa = '$id_empresa' and $item = '$value'");

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
    =                 CARGAR DEPARTAMENTOS                =
    =============================================*/

    public static function MdlCargarDepartamentos($table, $id_empresa, $supervisor)
    {

        if ($supervisor == "") {
            $stmt = Connexion::connect()->prepare("SELECT idtbl_departamento,nombre FROM $table where  id_empresa = '$id_empresa'");

        } else {
            $stmt = Connexion::connect()->prepare("SELECT idtbl_departamento,nombre FROM $table where nombre like '$supervisor%' and  id_empresa = '$id_empresa'");

        }

        $stmt->execute();

        //return $stmt;

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

/*=============================================
=                 ADD AD PERSONAL                =
=============================================*/

    public static function MdlAgregarEmpleado($table, $data)
    {

        $stmt = Connexion::connect()->prepare("INSERT INTO $table(cedula,nombre,1_apellido,2_apellido,telefono,mail,cuenta,id_empresa,nombre_completo,
                                                fecha_nacimiento,direccion, fecha_ingreso, activo) VALUES (:cedula,:nombre,:1_apellido,:2_apellido,:telefono,:mail,
                                                :cuenta,:id_empresa,:nombre_completo,:fecha_nacimiento,:direccion,:fecha_ingreso, 'si')");

        $stmt->bindParam(":cedula", $data["cedula"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":1_apellido", $data["1_apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":2_apellido", $data["2_apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":mail", $data["mail"], PDO::PARAM_STR);
        $stmt->bindParam(":cuenta", $data["cuenta"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $data["id_empresa"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_completo", $data["nombre_completo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $data["fecha_nacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $data["fecha_ingreso"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return $stmt->errorInfo()[2];

        }

        $stmt->close();

        $stmt = null;

    }

}
