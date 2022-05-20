<?php
 
require_once "../controllers/calendario-invitados.controller.php";
require_once "../models/calendario-invitados.model.php";
 

class AjaxEventos{

    public function ajaxCargarEventos(){

        session_start();

        $id_usuario = $_SESSION["id"];

		$response = CalendarioEventosController::ctrCargarEventos($id_usuario);

		echo json_encode($response);


    }


   
    public $id_evento;

    public function ajaxCargarDisponibilidad(){

        $evento = $this->id_evento;

		$response = CalendarioEventosController::ctrCargarDisponibilidad($evento);

		echo json_encode($response);


    }


    public $invitados;

    public function ajaxCargarCantInvitados(){

        $evento = $this->invitados;

		$response = CalendarioEventosController::ctrCargarCantInvitados($evento);

		echo json_encode($response);


    }


    public $AddAcepEvent;
    public $Addestado;
    public $Addusuario;
    public function ajaxIngresarEvento(){

        $acept = $this->AddAcepEvent;
        $estado = $this->Addestado;
        $usuario = $this->Addusuario;

		$response = CalendarioEventosController::ctrIngresarEvento($acept, $estado,  $usuario);

		echo $response;

    }

    public $UpdAcepEvent;
    public $Updestado; 
    public $Updusuario;
    public function ajaxModificarEvento(){

        $acept = $this->UpdAcepEvent;
        $estado = $this->Updestado;
        $usuario = $this->Updusuario;

		$response = CalendarioEventosController::ctrModificarEvento($acept, $estado, $usuario);

		echo $response;


    }

    public $validevento;
    public $username;
    public function ajaxValUsuarioEvento(){

        $evento = $this->validevento;
        $usuario = $this->username;

		$response = CalendarioEventosController::ctrValUsuarioEvento($evento, $usuario);

		echo json_encode($response);


    }

    public $userSearch;
    public function ajaxBuscarUsuario(){

        $user = $this->userSearch;

		$response = CalendarioEventosController::ctrBuscarUsuario($user);

		echo json_encode($response);


    }

    public $empresaEvento;
    public function ajaxBuscarEmpresa(){

        $empresa = $this->empresaEvento;

		$response = CalendarioEventosController::ctrBuscarEmpresa($empresa);

		echo json_encode($response);


    }

}

if(isset($_POST["empresaEvento"])){

	$var = new AjaxEventos();

	$var -> empresaEvento = $_POST["empresaEvento"];

	$var -> ajaxBuscarEmpresa();

}

if(isset($_POST["userSearch"])){

	$var = new AjaxEventos();

	$var -> userSearch = $_POST["userSearch"];

	$var -> ajaxBuscarUsuario();

}

if(isset($_POST["event"])){

	$var = new AjaxEventos();

	$var -> event = $_POST["event"];

	$var -> ajaxCargarEventos();

}


if(isset($_POST["idEvento"])){

	$var = new AjaxEventos();

	$var -> id_evento = $_POST["idEvento"];

	$var -> ajaxCargarDisponibilidad();

}

if(isset($_POST["invitados"])){

	$var = new AjaxEventos();

	$var -> invitados = $_POST["invitados"];

	$var -> ajaxCargarCantInvitados();

}


if(isset($_POST["AddAcepEvent"])){

	$var = new AjaxEventos();

	$var -> AddAcepEvent = $_POST["AddAcepEvent"];
	$var -> Addestado = $_POST["Addestado"];
    $var -> Addusuario = $_POST["Addusuario"];

	$var -> ajaxIngresarEvento();

}


if(isset($_POST["UpdAcepEvent"])){

	$var = new AjaxEventos();

	$var -> UpdAcepEvent = $_POST["UpdAcepEvent"];
	$var -> Updestado = $_POST["Updestado"];
    $var -> Updusuario = $_POST["Updusuario"];

	$var -> ajaxModificarEvento();

}

if(isset($_POST["username"])){

	$var = new AjaxEventos();

	$var -> validevento = $_POST["validevento"];
	$var -> username = $_POST["username"];

	$var -> ajaxValUsuarioEvento();

}