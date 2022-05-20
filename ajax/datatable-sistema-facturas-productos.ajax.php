<?php

require_once "../controllers/sistema-facturas-productos.controller.php";
require_once "../models/sistema-facturas-productos.model.php";

class TableProductos
{

    public function showTableProductos()
    {

        session_start();

// $ID_empresa = $_SESSION['empresa'];

//$ID_empresa = $_COOKIE["cookie_empresa"];

        $response = ProductosController::ctrCargarProductos();

        $JsonData = '{
               "data": [';

        for ($i = 0; $i < count($response); $i++) {

            $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnProducto' title='Modificar Producto' idprod='" . $response[$i]['idtbl_equipos'] . "'><i class='fas fa-info-circle'></i></button></div> <div class='btn-group'><button class='btn btn-outline-primary btnListaPrecio' title='Lista de Precios' idprod='" . $response[$i]['idtbl_equipos'] . "' sku='" . $response[$i]['sku'] . "'><i class='fas fa-hand-holding-usd'></i></button></div>";

            $JsonData .= '[
                   "' . ($i + 1) . '",
                   "' . $buttons . '",
                   "' . $response[$i]['sku'] . '",
                   "' . $response[$i]['nombre'] . '",
                   "' . $response[$i]['cabys'] . '"
                   ],';

        }

        $JsonData = substr($JsonData, 0, -1);

        $JsonData .= ']

     }';

        if (count($response) == 0) {
            $JsonData = '{
               "data": [] }';

        };

// echo '<pre>'; print_r( $response); echo '</pre>';
        echo $JsonData;

    }


    /*==========================================
    =         CARGAR LISTAS DE PRECIOS         =
    ===========================================*/
    public $idprod;

    public function ajaxCargarListasPrecios() {

        session_start();

        $idprod = $this->idprod;
        $response = ProductosController::ctrCargarListasPrecios($idprod);

        $JsonData = '{
        "data": [';

        for ($i = 0; $i < count($response); $i++) {
            $JsonData .= '[
                   "' . ($i + 1) . '",
                   "' . $response[$i]['idtbl_listas_precios_equipos'] . '",
                   "' . $response[$i]['nombre'] . '",
                   "₡ ' . number_format((float) $response[$i]['precio'], 2, '.', ',') . '",
                   "₡ ' . number_format((float) $response[$i]['costo'], 2, '.', ',') . '",
                   "₡ '. $response[$i]['margen'] .'",
                   "'. $response[$i]['porcentaje'].' %"
                   ],';
        }

        $JsonData = substr($JsonData, 0, -1);

        $JsonData .= ']

      }';

        if (count($response) == 0) {
            $JsonData = '{
                "data": [] }';
        };
        // echo '<pre>'; print_r( $response); echo '</pre>';
        echo $JsonData;

    }

    /*==========================================
    =       ACTUALIZAR LISTAS DE PRECIO        =
    ===========================================*/
    public function ajaxActualizarListasPrecios($id,$nombre,$precio,$costo,$margen,$porcentaje) {

        session_start();       
       $response = ProductosController::ctrActualizarListaPrecios($id,$nombre,$precio,$costo,$margen,$porcentaje);
           
        // echo '<pre>'; print_r( $response); echo '</pre>';
        //echo $response;
        echo json_encode($response);
    }

    /*======================================
    =             CARGAR COSTO             =
    ========================================*/
    public function ajaxCargarCosto($sku,$tipoCosto) {
        session_start();

        $response = ProductosController::ctrCargarCostos($sku,$tipoCosto);

        echo json_encode($response);
    }

    /*=====================================
    =       INSERTAR LISTA DE PRECIOS     =
    ======================================*/
    public function ajaxInsertarListaPrecio($idProducto,$nombre,$precio,$costo,$margen,$porcentaje) {
        session_start();

        $response = ProductosController::ctrInsertarListaPrecios($idProducto,$nombre,$precio,$costo,$margen,$porcentaje);
       
        echo json_encode($response);
    }


    /*=====================================
    =         CARGAR TIPO DE COSTO        =
    =======================================*/
    public function ajaxCargarTipoCosto($sku) {
        session_start();

        $response = ProductosController::ctrCargarTipoCosto($sku);

        echo json_encode($response);

    }


    /*=================================
    =      CAMBIAR TIPO DE COSTO      =
    ==================================*/
    public function ajaxCambiarTipoCosto($sku,$tipoCosto) {
        session_start();

        $response = ProductosController::ctrCambiarTipoCosto($sku,$tipoCosto);

        echo json_encode($response);
    }

}



/************      FIN AJAX      ****************/




/*=============================================
=            CONSULTAR API CABYS               =
=============================================*/
if (isset($_GET["dato"])) {

    $edit = new TableProductos();

    $edit->CabysSearch = $_GET["dato"];

    $edit->showTableProductos();

}

/*==========================================
=         CARGAR LISTAS DE PRECIOS         =
===========================================*/
if (isset($_GET["idprod"])) {

    $ajx = new TableProductos();
    $ajx->idprod = $_GET["idprod"];
    $ajx->ajaxCargarListasPrecios();

}

/*======================================
=      ACTUALIZAR LISTA DE PRECIOS     =
========================================*/
if (isset($_POST["id"])) {
    $ajx = new TableProductos();
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $costo = $_POST["costo"];
    $margen = $_POST["margen"];
    $porcentaje = $_POST["porcentaje"];
    $ajx->ajaxActualizarListasPrecios($id,$nombre,$precio,$costo,$margen,$porcentaje);
}

/*======================================
=             CARGAR COSTO             =
========================================*/
if (isset($_POST["sku"]) && isset($_POST["tipoCosto"])) {
    $ajx = new TableProductos();
    $sku = $_POST["sku"];
    $tipoCosto = $_POST["tipoCosto"];
    $ajx->ajaxCargarCosto($sku,$tipoCosto);
}

/*=====================================
=       INSERTAR LISTA DE PRECIOS     =
======================================*/
if(isset($_POST["idProducto"])){
    $ajx = new TableProductos();
    $idProducto = $_POST["idProducto"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $costo = $_POST["costo"];
    $margen = $_POST["margen"];
    $porcentaje = $_POST["porcentaje"];
    $ajx->ajaxInsertarListaPrecio($idProducto,$nombre,$precio,$costo,$margen,$porcentaje);
}


/*===================================
=         CARGAR TIPO COSTO         =
=====================================*/
if (isset($_GET["chkTipoCosto"])) {
    $ajx = new TableProductos();
    $sku = $_POST["sku"];
    $ajx->ajaxCargarTipoCosto($sku);
}

/*=================================
=      CAMBIAR TIPO DE COSTO      =
==================================*/
if (isset($_POST["skuChange"])){
    $ajx = new TableProductos();
    $sku = $_POST["skuChange"];
    $tipoCosto = $_POST["costoChange"];
    $ajx->ajaxCambiarTipoCosto($sku,$tipoCosto);
}

