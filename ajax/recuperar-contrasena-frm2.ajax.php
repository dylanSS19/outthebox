<?php

require_once "../controllers/recuperar-contrasena-frm2.controller.php";
require_once "../models/recuperar-contrasena-frm2.model.php";

class ajaxRecuperarContrasenaFrm2{

 
    	/*=============================================
      =    VALIDAR TELEFONO INGRESAOD               =
      =============================================*/
      
      public $cod_validacion;
      public $user;
      
      public function ajaxValidarCodigo(){

   
        $value = $this->cod_validacion;
        $usuario = $this->user;

        $response = RecuperarContrasenaFrm2Controller::ctrValidarCodigo($value, $usuario);

        echo json_encode($response);

        
      }



      /*=============================================
      =    MODIFICAR CONTRASEÑA DEL USUARIO                =
      =============================================*/
      
      public $contrasena_modificacion;
      public $codigo_modificar;
      
      public function ajaxModificarContrasena(){

   
        $contrasena_modificacion = $this->contrasena_modificacion;
        $codigo_modificar = $this->codigo_modificar;

        $response = RecuperarContrasenaFrm2Controller::ctrModificarContrasena($contrasena_modificacion, $codigo_modificar);

        echo json_encode($response);

        
      }


}


 /*=============================================
  =          VALIDAR CODIGO               =
  =============================================*/
if(isset($_POST["codigo_validacion"])){

  $edit = new ajaxRecuperarContrasenaFrm2();

  $edit -> cod_validacion = $_POST["codigo_validacion"];
  $edit -> user = $_POST["user_validacion"];

  $edit -> ajaxValidarCodigo();

}


 /*=============================================
  =   MODIFICAR CONTRASEÑA DEL USUARIO         =
  =============================================*/

if(isset($_POST["codigo_modificar"])){

  $edit = new ajaxRecuperarContrasenaFrm2();

  $edit -> contrasena_modificacion = $_POST["contrasena_modificar"];
  $edit -> codigo_modificar = $_POST["codigo_modificar"];

  $edit -> ajaxModificarContrasena();

}