<?php
 
require_once "../controllers/calendario.controller.php";
require_once "../controllers/correo-invitacion.controller.php";
require_once "../models/calendario.model.php";

class AjaxCalendario{

	/*=============================================
	=                 ACTUALIZAR FECHAS                =
	=============================================*/

	public $eventUpdateFecha;
	public $inicioUpdateFecha;
	public $finUpdateFecha;
	public $IDUpdateFecha;
	
	public function ajaxActualizarFechas(){

		$table = "empresas.tbl_calendario";
		$id = $this->IDUpdateFecha;
		$inicio = $this->inicioUpdateFecha;
		$fin = $this->finUpdateFecha;

		$response = CalendarioModel::MdlUpdateFechaCalendario($table, $id, $inicio, $fin);

		echo $response;

		/*echo "HOLA";*/

	}

		/*=============================================
	=                 AGREGAR FECHAS                =
	=============================================*/

	public $eventAddFecha;
	public $inicioAddFecha;
	public $finAddFecha;
	public $tituloAddFecha;
    public $alldayAddFecha;
	public $backgroundColorAddFecha;
	public $borderColorAddFecha;

	
	
	public function ajaxAgregarFechas(){

		$table = "empresas.tbl_calendario";	
		$inicio = $this->inicioAddFecha;
		$fin = $this->finAddFecha;
		$titulo=$this->tituloAddFecha;
		$allday = $this->alldayAddFecha;
		$backgroundColor = $this->backgroundColorAddFecha;
		$borderColor=$this->borderColorAddFecha;	

		session_start();
  		 $empresa = $_SESSION['empresa'];
  		  $user = $_SESSION['user_name'];

		$response = CalendarioModel::MdlInsertFechaCalendario($table, $titulo, $inicio, $fin,$allday ,$backgroundColor ,$borderColor, $empresa,$user );

		echo $response;
	

	}


			/*=============================================
	=                 AGREGAR FECHAS                =
	=============================================*/

	public $eventsLoad;	
	
	public function ajaxCargarFechas(){

	
		session_start();
  		 $empresa = $_SESSION['empresa'];

		 $response = CalendarioController::ctrCargarCalendario($empresa); 

		 $JsonData = '[';

		  for($i =0; $i < count($response); $i++){

		  	$inicio =  new DateTime($response[$i]["inicio"]);
		  	$inicio = date_format($inicio,'Y-m-d\TH:i:s');

		  	$fin =  new DateTime($response[$i]["fin"]);
		  	$fin = date_format($fin,'Y-m-d\TH:i:s');


		  	$JsonData .= '{
		  "id"             : "'.$response[$i]["idtbl_calendario"].'",
          "title"          : "'.$response[$i]["titulo"].'",
          "start"          : "'.$inicio.'",
          "end"            : "'.$fin.'",
          "backgroundColor": "'.$response[$i]["backgroundColor"].'",
          "borderColor"    : "'.$response[$i]["borderColor"].'",
          "allDay"         : "'.$response[$i]["allday"].'",
          "editable"       : "'.$response[$i]["editable"].'"
		    },';

	}


	          $JsonData = substr($JsonData, 0, -1);

     		$JsonData .=   ']';

	echo $JsonData	;


	/*echo json_encode($response);*/

	
}


public $contador;
public $idEvento;
public $fotoEvento;
public function ajaxAgregarFotos(){

	$evento = $this->idEvento;
	// $cont = $this->contador;
	$foto = $this->fotoEvento;
	$cont = "";
	$ipremoteserver='backup.midigitalsat.com';
	$urlremoteserver='https://backup.midigitalsat.com';
	$username = 'root';
	$password = 'Heriberto9109';
	$rutaFotos = "";
	$table = "empresas.tbl_calendario_fotos_evento";
	$cont = CalendarioModel::MdlCargarUltimaFoto($table, $evento);

	if($cont[0] == "" || $cont[0] == "undefined"){

		$cont[0] =  1;

	}else{

		$cont = $cont[0] + 1;

	}


	// Make our connection
$connection = ssh2_connect($ipremoteserver, 6060);

// Authenticate
if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

// Create our SFTP resource
if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');
	session_start();
	$empresa = $_SESSION["empresa"];


	if(isset($foto["tmp_name"]) && $foto["tmp_name"]!=""){

		list($weight,$height) = getimagesize($foto["tmp_name"]);

		$newWeight = 500;
		$newHeight = 500;

		$nombre_fichero = "../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento;
		$nombre_fichero2 = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento;
		$group="www-data";
		$owner ="www-data";
		exec("chown -R ".$owner.":".$group." /var/www/outthebox/apiHacienda/clientes/".$empresa."img/imgEvento");
		if (file_exists($nombre_fichero)) {
				

		} else {
			
			mkdir("../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento, 0777,true);

		}

		if (file_exists($nombre_fichero2)) {
				

		} else {
			
			ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento, 0777, true);

		}

		
		if($foto["type"] == "image/jpeg" || $foto["type"] == "image/jpg"){
			
			$route = "../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".jpg";

			$source = imagecreatefromjpeg($foto["tmp_name"]);

			$destination = imagecreatetruecolor($newWeight, $newHeight);

			//imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

			imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

			imagejpeg($destination, $route);

			$remotefile  = "/mnt/blockstorage/html/private/apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".jpg";
			$localfile = "../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".jpg";
			$rutaFotos  = "/private/apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".jpg";
			 ssh2_scp_send($connection, $localfile, $remotefile, 0644);
			 unlink($route);
		}

		if($foto["type"] == "image/png"){

			$route = "../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".png";

			$source = imagecreatefrompng($foto["tmp_name"]);						

			$destination = imagecreatetruecolor($newWeight, $newHeight);

			imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

			imagepng($destination, $route);

			$remotefile  = '/mnt/blockstorage/html/private/apiHacienda/clientes/'.$empresa.'/img/imgEvento/'.$evento.'/fotoEvento'.$cont.'.png';
			$localfile = "../apiHacienda/clientes/".$empresa."/img/imgEvento/".$evento."/fotoEvento".$cont.".png";
			$rutaFotos = '/private/apiHacienda/clientes/'.$empresa.'/img/imgEvento/'.$evento.'/fotoEvento'.$cont.'.png';
			ssh2_scp_send($connection, $localfile, $remotefile, 0644);
			unlink($route);
		}

		ssh2_exec($connection, 'exit');

	}

	$response = CalendarioModel::MdlAgregarFotos($table, $rutaFotos, $evento);

	echo $response;

	// echo '<pre>'; print_r($foto["tmp_name"]); echo '</pre>';

}

public $envent;
public function ajaxCargarFotosEventos(){

	$table = "empresas.tbl_calendario_fotos_evento";	

	$idevent= $this->envent;	

	$response = CalendarioModel::MdlCargarFotosEventos($table, $idevent);

	echo json_encode($response);


}

public $nombre;
public $comentario;
public $evenid;
public function ajaxAgregarComentarios(){

	$table = "empresas.tbl_calendario_comentarios_evento";	

	$nombres= $this->nombre;
	$comentarios= $this->comentario;
	$id_eventos = $this->evenid;	

	$response = CalendarioModel::MdlAgregarComentarios($table, $nombres, $comentarios, $id_eventos);

	echo $response;


}

public $id_even;
public function ajaxCargarComentarios(){

	$table = "empresas.tbl_calendario_comentarios_evento";	

	$id_eventos = $this->id_even;	

	$response = CalendarioModel::MdlCargarComentarios($table, $id_eventos);

	echo json_encode($response);


}

public $even;
public function ajaxCargarReacciones(){

	$table2 = "empresas.tbl_calendario_comentarios_evento";	
	$table = "empresas.tbl_calendario";
	$id_eventos = $this->even;	

	$response = CalendarioModel::MdlCargarReacciones($table, $table2, $id_eventos);

	echo json_encode($response);


}

public $event;
public function ajaxCargarDatosEvento(){
	
	$table = "empresas.tbl_calendario";
	$id_eventos = $this->event;	

	$response = CalendarioModel::MdlCargarDatosEvento($table, $id_eventos);

	echo json_encode($response);


}


public $idEV;
public $nombreEV;
public $detalle;
public $fecha_inicio;
public $fecha_fin;
public $tipo;
public $allday;
public $latitud;
public $longitud;
public function ajaxModificarDatosEvento(){
	
	$table = "empresas.tbl_calendario";
	$id_eventos = $this->idEV;	
	$nombre = $this->nombreEV;	
	$detalle = $this->detalle;	
	$inicio = $this->fecha_inicio;	
	$fin = $this->fecha_fin;	
	$tipo = $this->tipo;	
	$allday = $this->allday;	
	$ubicacion = $this->ubicacion;	
	$limite = $this->limite;
	$lat = $this->latitud;	
	$lon = $this->longitud;
	$response = CalendarioModel::MdlModificarDatosEvento($table, $id_eventos, $nombre, $detalle, $inicio, $fin, $tipo, $allday, $ubicacion, $limite, $lat, $lon);

	echo $response;


}

public $eventid;
public $userid;
public function ajaxEnviarCorreo(){
	

	$evento = $this->eventid;	
	$usuario = $this->userid;	

	$response = CorreoInvitadosController::ctrEnviarCorreo($evento, $usuario);

	// echo json_encode($response);
	echo $response;

}


}


if(isset($_GET["eventid"])){

	$var = new AjaxCalendario();

	$var -> eventid = $_GET["eventid"];
	$var -> userid = $_GET["userid"];

	$var -> ajaxEnviarCorreo();

}

	/*=============================================
	=                  CARGAR FECHAS  OBJECT                =
	=============================================*/
if(isset($_GET["eventsLoad"])){

	$var = new AjaxCalendario();

	$var -> eventsLoad = $_GET["eventsLoad"];

	$var -> ajaxCargarFechas();

}


	/*=============================================
	=                  AGREGAR FECHAS  OBJECT                =
	=============================================*/
if(isset($_POST["eventAddFecha"])){

	$var = new AjaxCalendario();

	$var -> eventAddFecha = $_POST["eventAddFecha"];

	$var -> inicioAddFecha = $_POST["inicioAddFecha"];

	$var -> finAddFecha = $_POST["finAddFecha"];

	$var -> tituloAddFecha = $_POST["tituloAddFecha"];

	$var -> alldayAddFecha = $_POST["alldayAddFecha"];

	$var -> backgroundColorAddFecha = $_POST["backgroundColorAddFecha"];

	$var -> borderColorAddFecha = $_POST["borderColorAddFecha"];

	$var -> ajaxAgregarFechas();

}

	/*=============================================
	=  ACTUALIZAR FECHAS  OBJECT                =
	=============================================*/
if(isset($_POST["eventUpdateFecha"])){

	$var = new AjaxCalendario();

	$var -> eventUpdateFecha = $_POST["eventUpdateFecha"];

	$var -> inicioUpdateFecha = $_POST["inicioUpdateFecha"];

	$var -> finUpdateFecha = $_POST["finUpdateFecha"];

	$var -> IDUpdateFecha = $_POST["IDUpdateFecha"];

	$var -> ajaxActualizarFechas();

}

if(isset($_POST["idEvento"])){

	$var = new AjaxCalendario();

	$var -> idEvento = $_POST["idEvento"];

	$var -> contador = $_POST["contador"];

	$var -> fotoEvento = $_FILES["fotoEvento"];

	$var -> ajaxAgregarFotos();

}


if(isset($_POST["eventID"])){

	$var = new AjaxCalendario();

	$var -> envent = $_POST["eventID"];

	$var -> ajaxCargarFotosEventos();

}

if(isset($_POST["nombre"])){

	$var = new AjaxCalendario();

	$var -> nombre = $_POST["nombre"];
	$var -> comentario = $_POST["comentario"];
	$var -> evenid = $_POST["evenid"];

	$var -> ajaxAgregarComentarios();

}

if(isset($_POST["idE"])){

	$var = new AjaxCalendario();

	$var -> id_even = $_POST["idE"];

	$var -> ajaxCargarComentarios();

}

if(isset($_POST["evento"])){

	$var = new AjaxCalendario();

	$var -> even = $_POST["evento"];

	$var -> ajaxCargarReacciones();

}


if(isset($_POST["IDEvento"])){

	$var = new AjaxCalendario();

	$var -> event = $_POST["IDEvento"];

	$var -> ajaxCargarDatosEvento();

}


if(isset($_POST["idEV"])){

	$var = new AjaxCalendario();

	$var -> idEV = $_POST["idEV"];
	$var -> nombreEV = $_POST["nombreEV"];
	$var -> detalle = $_POST["detalle"];
	$var -> fecha_inicio = $_POST["fecha_inicio"];
	$var -> fecha_fin = $_POST["fecha_fin"];
	$var -> tipo = $_POST["tipo"];
	$var -> allday = $_POST["allday"];
	$var -> ubicacion = $_POST["ubicacion"];
	$var -> limite = $_POST["limite"];
	$var -> latitud = $_POST["lat"];
	$var -> longitud = $_POST["lon"];

	$var -> ajaxModificarDatosEvento();

}
