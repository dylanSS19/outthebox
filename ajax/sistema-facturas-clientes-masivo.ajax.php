<?php

require_once "../controllers/sistema-facturas-clientes-masivo.controller.php";
require_once "../models/sistema-facturas-clientes-masivo.model.php";
// require_once "../models/sistema-facturas-clientes-masivo.model.php";

class ajaxClientesMasivos{
  
  public $empresa;
  public $codigo;
  public $nombre;



  public function ajaxIngresarClientesMasivo(){

    $id_empresa = $this->id_empresa;
    $Nombre = $this->Nombre;
    $tipo_cedula = $this->tipo_cedula;
    $cedula = $this->cedula;
    $correo = $this->correo;
    $telefono = $this->telefono;
    $provincia = $this->provincia;
    $canton = $this->canton;
    $distrito = $this->distrito;
    $direccion = $this->direccion;
    $Tipo_lista = $this->Tipo_lista;
    $nombre_fantasia = $this->nombre_fantasia;

    $response = controladorClientesMasivos::ctrIngresarClientesMasivo($id_empresa, $Nombre, $tipo_cedula, $cedula, $correo, $telefono, $provincia, $canton, $distrito, $direccion, $Tipo_lista, $nombre_fantasia);

    echo $response;

    
  }


  public function ajaxEliminarArchivo(){

    if (file_exists('../extensions/DocumentacionClientes/Reporte Lista Precio.xlsx')) {
      unlink('../extensions/DocumentacionClientes/Reporte Lista Precio.xlsx');
       echo "Eliminado";     
   } else {

    echo "No Eliminado";
   }

    
  }


}

if(isset($_POST["id_empresa"])){

    $add = new ajaxClientesMasivos();
  
        $add -> id_empresa = $_POST["id_empresa"];
        $add -> Nombre = $_POST["Nombre"];
        $add -> tipo_cedula = $_POST["tipo_cedula"];
        $add -> cedula = $_POST["cedula"];
        $add -> correo = $_POST["correo"];
        $add -> telefono = $_POST["telefono"];
        $add -> provincia = $_POST["provincia"];
        $add -> canton = $_POST["canton"];
        $add -> distrito = $_POST["distrito"];
        $add -> direccion = $_POST["direccion"];
        $add -> Tipo_lista = $_POST["Tipo_lista"];
        $add -> nombre_fantasia = $_POST["nombre_fantasia"];

    $add -> ajaxIngresarClientesMasivo();
  
  }


  if(isset($_POST["archivo"])){

    $delete = new ajaxClientesMasivos();
  
      $delete -> elimianr = $_POST["archivo"];

    $delete -> ajaxEliminarArchivo();
  
  }