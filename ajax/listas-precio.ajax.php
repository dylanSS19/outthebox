<?php

require_once "../controllers/listas-precios.controller.php";
require_once "../models/listas-precios.model.php";

class AjaxListasPrecios {

    /**
     * Cambiar estado 
     */
    public $idListas = "";
    public $estado = "";
    public function ajaxUpdateState($id, $estado) {
        session_start();

       // $id = $this->idListas;
        //$estado = $this->estado;

        $response = ListasPreciosController::CtrUpdateState($id,$estado);

        echo $response;

    }
}

if(isset($_POST["idListasEstado"])) {
    $ajx = new AjaxListasPrecios();

   // $ajx -> $idListas = $_POST["idListasEstado"];
    //$ajx -> $estado = $_POST["estado"];

    $ajx -> ajaxUpdateState($_POST["idListasEstado"],$_POST["estado"]);
}