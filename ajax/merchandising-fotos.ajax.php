<?php

require_once "../controllers/merchandising-clientes.controller.php";
require_once "../models/merchandising-clientes.model.php";

class ajaxMerchandisingFotos{

    public $fotosAnaquel;

    public function ajaxAgregarFotos(){

    $fotosAnaquel = $this->fotosAnaquel;


    //   $response = MerchandisingClientesController::ctrAgregarClientes($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud);

    //   echo  $fotosAnaquel;
      echo '<pre>'; print_r($fotosAnaquel); echo '</pre>';

  }


}


if(isset($_FILES["fotosAnaquel"])){

    $load = new ajaxMerchandisingFotos();
   
    $load -> fotosAnaquel = $_FILES["fotosAnaquel"];
     
    $load -> ajaxAgregarFotos();
   
   }

//    _POST
//    _FILES