<?php

require_once "../controllers/listas-precios.controller.php";
require_once "../models/listas-precios.model.php";

class tableListaFacturas
{

    /**
     * Carga la lista de precios
     */

    public function showListaPrecios()
    {
        session_start();

        $id_empresa = $_SESSION['empresa'];

        $response = ListasPreciosController::CtrCargarListaPrecios();

        $JsonData = '{
                "data":[';

            $buttons="boton";
            $buttons2 = "boton";

        for ($i = 0; $i < count($response); $i++) {

            $id = $response[$i]["idtbl_listas_precio"];

            $nombre = $response[$i]["nombre"];

            $codigo = $response[$i]["codigo"];

           if ($response[$i]["activo"] == "No") {

            $buttons2 = "<button class='btn btn-danger btn-xs btnEstado' idListasEstado='".$response[$i]["idtbl_listas_precio"]."' estado='".$response[$i]["activo"]."'>Desactivado</button>";                

            } else if ($response[$i]["activo"] == "Si") {

                $buttons2 = "<button class='btn btn-success btn-xs btnEstado' idListasEstado='".$response[$i]["idtbl_listas_precio"]."' estado='".$response[$i]["activo"]."'>Activado</button>";

            }

            $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnListaPrecios' title='Editar Lista de precios' idListasPrecio='".$response[$i]["idtbl_listas_precio"]."' nombre='".$response[$i]["nombre"]."' codigo='".$response[$i]["codigo"] ."' > <i class='fas fa-edit'></i></div>";

            $JsonData .= '[
                        "'.($i+1).'",
                        "'.$response[$i]["nombre"].'",
                        "'.$response[$i]["codigo"].'",
                        "'.$buttons2.'",
                        "'.$buttons.'"
            ],';

        }

        $JsonData = substr($JsonData, 0, -1);

        $JsonData .= ']
                    }';

        if (count($response) == 0) {
            $JsonData = '{ 
                "data":[]
            }';

        };

        echo $JsonData;

    }
}

if (isset($_GET['cargar'])) {
    $table = new tableListaFacturas();

    $table->showListaPrecios();
}
