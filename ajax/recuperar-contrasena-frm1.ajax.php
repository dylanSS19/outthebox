<?php

require_once "../controllers/recuperar-contrasena-frm1.controller.php";
require_once "../models/recuperar-contrasena-frm1.model.php";
 
class ajaxRecuperarContrasenaFrm1{

    	/*=============================================
      =    VALIDAR TELEFONO INGRESAOD               =
      =============================================*/
      
      public $num_telefono;
      
      public function ajaxCargarTelefonoCliente(){

   
        $value = $this->num_telefono;

        $response = RecuperarContrasenaFrm1Controller::ctrCargarTelefonoCliente($value);

        echo json_encode($response);

        

      }



    /*=============================================
      =    VALIDAR TELEFONO INGRESAOD               =
      =============================================*/
      
      public $nom_usuario;
      
      public function ajaxCargarUsuarioCliente(){

   
        $value = $this->nom_usuario;

        $response = RecuperarContrasenaFrm1Controller::ctrCargarUsuarioCliente($value);

        echo json_encode($response);

      }


    /*=============================================
      =    INGRESAR CODIGO VALIDACION             =
      =============================================*/
      
      public $codigo_validacion;
      public $usuario_validacion;
      
      public function ajaxAgregarCodigoValidacion(){

        $usuario = $this->usuario_validacion;
        $codigo = $this->codigo_validacion;

        $response = RecuperarContrasenaFrm1Controller::ctrAgregarCodigoValidacion($usuario, $codigo);

        echo json_encode($response);

        

      }


      public $correoValid;
      public $user;
  
      public function ajaxValidarCorreo(){

        $correoValid = $this->correoValid;
        $usuario = $this->user;

        $response = RecuperarContrasenaFrm1Controller::ctrValidarCorreo($usuario, $correoValid);

        echo json_encode($response);

        

      }

      public $userVal;
      
      public function ajaxValidarCorreoVacio(){
   
        $userVal = $this->userVal;

        $response = RecuperarContrasenaFrm1Controller::ctrValidarCorreoVacio($userVal);

        echo json_encode($response);

      }

      public $addusuario;
      public $addCorreo;
     
      public function ajaxModificarCorreo(){
   
        $addusuario = $this->addusuario;
        $addCorreo = $this->addCorreo;

        $response = RecuperarContrasenaFrm1Controller::ctrModificarCorreo($addusuario, $addCorreo);

        echo $response;

      }

      public $Sendcodigo;
      public $SendCorreo;
      public $SendUser;

     
      public function ajaxEnviarCorreo(){
   
        $Sendcodigo = $this->Sendcodigo;
        $SendCorreo = $this->SendCorreo;
        $SendUser = $this->SendUser;

        $response = RecuperarContrasenaFrm1Controller::ctrEnviarCorreo($Sendcodigo, $SendCorreo, $SendUser);

        echo $response;

      }

}


 /*=============================================
  =  VALIDAR TELEFONO INGRESADO              =
  =============================================*/
if(isset($_POST["validacion"])){

  $edit = new ajaxRecuperarContrasenaFrm1();

  $edit -> num_telefono = $_POST["validacion"];

  $edit -> ajaxCargarTelefonoCliente();

}


 /*=============================================
  =  VALIDAR USUARIO INGRESADO                =
  =============================================*/
if(isset($_POST["validar_usuario"])){

  $edit = new ajaxRecuperarContrasenaFrm1();

  $edit -> nom_usuario = $_POST["validar_usuario"];

  $edit -> ajaxCargarUsuarioCliente();

}

 /*=============================================
  = INGRESAR CODIGO VALIDACION =
  =============================================*/
if(isset($_POST["codigo_validacion"])){

  $edit = new ajaxRecuperarContrasenaFrm1();

  $edit -> codigo_validacion = $_POST["codigo_validacion"];
  $edit -> usuario_validacion = $_POST["usuario_validacion"];

  $edit -> ajaxAgregarCodigoValidacion();

}

if(isset($_POST["correoValid"])){

  $load = new ajaxRecuperarContrasenaFrm1();

  $load -> correoValid = $_POST["correoValid"];
  $load -> user = $_POST["user"];

  $load -> ajaxValidarCorreo();

}


if(isset($_POST["UsuarioValid"])){

  $load = new ajaxRecuperarContrasenaFrm1();

  $load -> userVal = $_POST["UsuarioValid"];

  $load -> ajaxValidarCorreoVacio();

}

if(isset($_POST["addusuario"])){

  $add = new ajaxRecuperarContrasenaFrm1();

  $add -> addusuario = $_POST["addusuario"];
  $add -> addCorreo = $_POST["addCorreo"];


  $add -> ajaxModificarCorreo();

}

if(isset($_POST["Sendcodigo"])){

  $add = new ajaxRecuperarContrasenaFrm1();

  $add -> Sendcodigo = $_POST["Sendcodigo"];
  $add -> SendCorreo = $_POST["SendCorreo"];
  $add -> SendUser = $_POST["SendUser"];

  $add -> ajaxEnviarCorreo();

}