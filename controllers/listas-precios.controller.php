<?php

class ListasPreciosController
{

    public static function CtrCargarListaPrecios()
    {
        $table = "empresas.tbl_listas_precio";
        $idEmpresa = $_SESSION['id_empresa'];

        $response = ListasPreciosModel::MdlCargarListaPrecios($table,$idEmpresa);

        return $response;
    }

    public static function CtrlModificar()
    {

        if (isset($_POST["nombreModal"])) {
            $table = "empresas.tbl_listas_precio";
            $idLista = $_POST["idModal"];
            $nombreLista = $_POST["nombreModal"];
            $codigoLista = $_POST["codigoModal"];
            $response = ListasPreciosModel::MdlModificarLista($table, $idLista, $nombreLista, $codigoLista);
            
            if ($response == "ok") {
                echo '<script>
                    Swal.fire(
                    "Ingreso exitoso!",
                    "¡Se ha registrado la actualizacion correctamente!",
                    "success"
                    ).then((result) => {

                    window.location = "listas-precios";
                    })

                </script>';

                $response = "";
            } else {

                echo '<script>

                Swal.fire(
                "Ingreso fallido!",
                "¡No se ha actualizado correctamente! ' . $response . '",
                "error"
                ).then((result) => {

                window.location = "listas-precios";
                })

                </script>';
                $response = "";
            }

        }

    }

    public static function CtrUpdateState($id, $estado) {
        $table = "empresas.tbl_listas_precio";

        if($estado == "Si"){
            $estado = "No";
        } else if($estado == "No") {
            $estado = "Si";
        }

        $response = ListasPreciosModel::MdlUpdateState($table, $id, $estado);
        return $response;
    }

    public static function CtrInsertarLista() {
        if (isset($_POST["newNombreModal"])) {
            $table = "empresas.tbl_listas_precio";

            $nombreLista = $_POST["newNombreModal"];
            $codigoLista = $_POST["newCodigoModal"];

            $idEmpresa = $_SESSION['id_empresa'];

            $response = ListasPreciosModel::MdlInsertarLista($table, $nombreLista, $codigoLista, $idEmpresa);
            
            if ($response == "ok") {
                echo '<script>
                    Swal.fire(
                    "Ingreso exitoso!",
                    "¡Se ha registrado la actualizacion correctamente!",
                    "success"
                    ).then((result) => {

                    window.location = "listas-precios";
                    })

                </script>';

                $response = "";
            } else {

                echo '<script>

                Swal.fire(
                "Ingreso fallido!",
                "¡No se ha actualizado correctamente! ' . $response . '",
                "error"
                ).then((result) => {

                window.location = "listas-precios";
                })

                </script>';
                $response = "";
            }

        }
    }
}
