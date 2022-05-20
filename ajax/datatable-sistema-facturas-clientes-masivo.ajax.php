<?php

require_once "../controllers/sistema-facturas-clientes-masivo.controller.php";
require_once "../models/sistema-facturas-clientes-masivo.model.php";
 

class TableClienteMasivo{


    public $clientes;

    public function showTableClientesMasivo(){


    session_start();


    $ID_empresa = $_SESSION['empresa'];

    $response = controladorClientesMasivos::ctrCargarClientesMasivo($ID_empresa);

    // echo '<pre>'; print_r($response); echo '</pre>';


    $JsonData = '{
                "data": [';


    for($i =0; $i < count($response); $i++){

        // $buttons = "<div class='btn-group'><button class='btn btn-outline-primary btnClient'  idclient='".$response[$i]['idtbl_empresas_clientes']."' data-toggle='modal' data-target='#modalEditClientes'><i class='fas fa-info-circle'></i></button></div>";

            $JsonData .= '[

                        "'.($i + 1).'",         
                        "'.$response[$i]['Nombre'].'",              
                        "'.$response[$i]['tipo_cedula'].'",
                        "'.$response[$i]['cedula'].'",    
                        "'.$response[$i]['correo'].'"
                        ],';

        }


                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


// echo '<pre>'; print_r($response); echo '</pre>';
echo $JsonData;



	  }


}




if(isset($_GET["dato"])){

  $load = new TableClienteMasivo();

  $load -> clientes = $_GET["dato"];

  $load -> showTableClientesMasivo();

}