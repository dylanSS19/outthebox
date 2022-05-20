<?php

require_once "../controllers/creacion-usuarios-clientes.controller.php";
require_once "../models/creacion-usuarios-clientes.model.php";

class ajaxCreacionUsuarios{

/*=============================================
  = CARGAR DATOS USUARIO SELECCIONADO         =
  =============================================*/
  
  public $varidusuario;
  public $varestado;
  
  public function ajaxCargarClientes(){

    $value = $this->varidusuario;
    $estado = $this->varestado;
    
    $response = UsuariosClienteController::ctrEditarEstadoUsuario($value, $estado);

    echo json_encode($response);

    

  }

  public $modulos;
  
  public function ajaxCargarsubModulos(){

    $modulos = $this->modulos;
    
    $response = UsuariosClienteController::ctrCargarsubModulos($modulos);

    echo json_encode($response);

    

  }


  public $modulosSB;
  
  public function ajaxCargarsubModulosMultiple(){

    $modulos = $this->modulosSB;
    
    $response = UsuariosClienteController::ctrCargarsubModulosMultiple($modulos);

    echo json_encode($response);

    

  }


  public $usuarios;
  public $empresaSelected3;
  public function ajaxBuscarUsuario(){

    $usuarios = $this->usuarios;
    $empresaSelected3 = $this->empresaSelected3;

    
    $response = UsuariosClienteController::ctrBuscarUsuario($usuarios, $empresaSelected3);

    echo json_encode($response);

    

  }

  
  public $Searchusuario;
  public $empresaSelected2;

  
  public function ajaxBuscarUsuario2(){

    $Searchusuario = $this->Searchusuario;
    $empresaSelected2 = $this->empresaSelected2;

    
    $response = UsuariosClienteController::ctrBuscarUsuario2($Searchusuario, $empresaSelected2);

    echo json_encode($response);

    

  }


  public $user;
  public $privilegio;
  public $empresaSelected;

  
  public function ajaxAgregarPermisosUsiuario(){

    $user = $this->user;
    $privilegio = $this->privilegio;
    $empresaSelected = $this->empresaSelected;

    
    $response = UsuariosClienteController::ctrAgregarPermisosUsiuario($user, $privilegio, $empresaSelected);

    echo $response;

    

  }
 

  public $IDuser;
  public $IDempresa;
  public $nombreEmpresa;
  // public $privilegios;
  
  public function ajaxAgregarUsuarioEmpresa(){

    $IDuser = $this->IDuser;
    $IDempresa = $this->IDempresa;
    $nombreEmpresa = $this->nombreEmpresa;
    $privilegios = "UsuarioOTB";

    // $DatosUser = UsuariosClienteController::ctrAgregarUsuarioEmpresa($IDuser);

    $response = UsuariosClienteController::ctrAgregarUsuarioEmpresa($IDuser, $IDempresa, $nombreEmpresa, $privilegios);

    echo $response;

    

  }


  public $nombreUser;
  
  public function ajaxCargarIdUser(){

    $nombreUser = $this->nombreUser;

    $response = UsuariosClienteController::ctrCargarIdUser($nombreUser);

    echo json_encode($response);

  }

  public $modulosUser;
  
  public function ajaxCargarsubModulosEditar(){

    $modulosUser = $this->modulosUser;

    $response = UsuariosClienteController::ctrCargarsubModulosEditar($modulosUser);

    echo json_encode($response);

  }
  

  public $modulosEdit;
  public $UserEdit;
  public $empresaEdit;

  
  public function ajaxSubModulosEditar(){

    $modulosEdit = $this->modulosEdit;
    $UserEdit = $this->UserEdit;
    $empresaEdit = $this->empresaEdit;


    $response = UsuariosClienteController::ctrSubModulosEditar($modulosEdit, $UserEdit, $empresaEdit);

    echo $response;

  }


}


  /*=============================================
  =       CARGAR DATOS USUARIO SELECCIONADO                  =
  =============================================*/

    if(isset($_POST["varidusuario_selected"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> varidusuario = $_POST["varidusuario_selected"];
    $valcantones -> varestado = $_POST["estado_usuario"];

    $valcantones -> ajaxCargarClientes();
  }

  if(isset($_POST["modulos"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> modulos = $_POST["modulos"];

    $valcantones -> ajaxCargarsubModulos();
  }

  if(isset($_POST["usuarios"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> usuarios = $_POST["usuarios"];
    $valcantones -> empresaSelected3 = $_POST["empresaSelected3"];
    
    $valcantones -> ajaxBuscarUsuario();
  }


  if(isset($_POST["user"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> user = $_POST["user"];
    $valcantones -> privilegio = $_POST["privilegio"];
    $valcantones -> empresaSelected = $_POST["empresaSelected"];

    
    $valcantones -> ajaxAgregarPermisosUsiuario();
  }

  if(isset($_POST["usuario2"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> Searchusuario = $_POST["usuario2"];
    $valcantones -> empresaSelected2 = $_POST["empresaSelected2"];

    

    $valcantones -> ajaxBuscarUsuario2();
  }



  if(isset($_POST["IDuser"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> IDuser = $_POST["IDuser"];
    $valcantones -> IDempresa = $_POST["IDempresa"];
    $valcantones -> nombreEmpresa = $_POST["nombreEmpresa"];


    $valcantones -> ajaxAgregarUsuarioEmpresa();
  }

  if(isset($_POST["modulosSB"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> modulosSB = $_POST["modulosSB"];

    $valcantones -> ajaxCargarsubModulosMultiple();
  }

  if(isset($_POST["nombreUser"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> nombreUser = $_POST["nombreUser"];

    $valcantones -> ajaxCargarIdUser();
  }

  if(isset($_POST["modulosUser"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> modulosUser = $_POST["modulosUser"];

    $valcantones -> ajaxCargarsubModulosEditar();
  }

  if(isset($_POST["modulosEdit"])){

    $valcantones= new ajaxCreacionUsuarios();

    $valcantones -> modulosEdit = $_POST["modulosEdit"];
    $valcantones -> UserEdit = $_POST["UserEdit"];
    $valcantones -> empresaEdit = $_POST["empresaEdit"];

    $valcantones -> ajaxSubModulosEditar();
  }
