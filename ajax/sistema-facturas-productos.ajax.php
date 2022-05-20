<?php

require_once "../controllers/sistema-facturas-productos.controller.php";
require_once "../models/sistema-facturas-productos.model.php";
 
class ajaxProductos{

    /*=============================================
    =      AGREGAR PRODUCTOS                =
    =============================================*/
    
     public $cabys;
     public $codigo;
     public $unidad;
     public $tarifa;
     public $cantidad;
     public $precio_unitario;
     public $descripcion;
     public $Cod_Impuesto;
     public $categoria;


    public function ajaxAgregarProductos(){
      session_start();
      $CodCabys = $this->cabys;
      $Codigo_comercial = $this->codigo;
      $Unidad_Medida = $this->unidad;
      $Tarifa = $this->tarifa;
      $Cantidad = $this->cantidad;
      $Descripcion = $this->descripcion;
      $codImpuesto = $this->Cod_Impuesto;
      $categoria = $this->categoria;


      $response = ProductosController::ctrAgregarProductos($CodCabys, $Codigo_comercial, $Unidad_Medida, $Tarifa, $Cantidad, $Descripcion, $codImpuesto, $categoria);

      echo $response;


    }


  /*=============================================
    =      CARGAR X ID PRODUCTOS                =
    =============================================*/

    public $Id_producto;
    public function ajaxCargarProductosXid(){

    $producto = $this->Id_producto;
   
      $response = ProductosController::ctrCargarProductosXid($producto);

      echo json_encode($response);


  }


  /*=============================================
    =      EDITAR PRODUCTOS                =
    =============================================*/

     public $Id_prod;
     public $Editcabys;
     public $Editcodigo;
     public $Editunidad;
     public $Edittarifa;
     public $Editcantidad;
     public $Editprecio_unitario;
     public $Editdescripcion;
     public $Editcodigo_impuesto;
     public $Editcategoria;
      
    public function ajaxEditarProductos(){

    $Id_prod = $this->Id_producto;
    $CodCabys = $this->Editcabys;
    $Codigo_comercial = $this->Editcodigo;
    $Unidad_Medida = $this->Editunidad;
    $Tarifa = $this->Edittarifa;
    $Cantidad = $this->Editcantidad;
    $Descripcion = $this->Editdescripcion;
    $impuesto = $this->Editcodigo_impuesto;
    $categoria = $this->Editcategoria;


      $response = ProductosController::ctrEditarProductos($Id_prod, $CodCabys, $Codigo_comercial, $Unidad_Medida, $Tarifa, $Cantidad, $Descripcion,  $impuesto, $categoria);

      echo $response;


  }

/*==================================
=      VERIFICAR CODIGO DE SKU     =
====================================*/

  public $codProducto;

  public function ajaxVerificarCodigo() {
    session_start();
    $codProducto = $this->codProducto;
    
    $response = ProductosController::ctrVerificarCodProductos($codProducto);

    echo json_encode($response);
  }


  /*==================================
  =    VERIFICAR LISTAS DE PRECIOS   =
  ====================================*/
 public function ajaxVerificarListasPrecios() {
  session_start();
   $response = ProductosController::ctrVerificarListasPrecios();

   echo json_encode($response);
 }


 public $listaProductos;

 public function ajaxRegistrarListaProductos() {
    session_start();
    $listaProductos = $this->listaProductos;
    
    $response = ProductosController::ctrRegistroListaProductos($listaProductos);

    echo trim($response);
  
 }

}
 


  /*=============================================
  =     AGREGAR CLIENTES             =
  =============================================*/
if(isset($_POST["cabys"])){

  $edit = new ajaxProductos();

 $edit -> cabys = $_POST["cabys"];
 $edit -> codigo = $_POST["codigo"];
 $edit -> unidad = $_POST["unidad"];
 $edit -> tarifa = $_POST["tarifa"];
 $edit -> cantidad = $_POST["cantidad"];
 $edit -> descripcion = $_POST["descripcion"];
 $edit -> Cod_Impuesto = $_POST["codImpuesto"];
 $edit -> categoria = $_POST["categoria"];


  $edit -> ajaxAgregarProductos();

}



  /*=============================================
  =     BUSCAR CLIENTES X ID            =
  =============================================*/
if(isset($_POST["producto"])){

  $edit = new ajaxProductos();

 $edit -> Id_producto = $_POST["producto"];

  $edit -> ajaxCargarProductosXid();

}
 

 
 /*=============================================
  =     EDITAR PRODUCTO CLIENTE             =
  =============================================*/
if(isset($_POST["Idproducto"])){

  $edit = new ajaxProductos();

 $edit -> Id_producto = $_POST["Idproducto"];
 $edit -> Editcabys = $_POST["Editcabys"];
 $edit -> Editcodigo = $_POST["Editcodigo"];
 $edit -> Editunidad = $_POST["Editunidad"];
 $edit -> Edittarifa = $_POST["Edittarifa"];
 $edit -> Editcantidad = $_POST["Editcantidad"];
 $edit -> Editdescripcion = $_POST["Editdescripcion"];
 $edit -> Editcodigo_impuesto = $_POST["Editcodigo_impuesto"];
 $edit -> Editcategoria = $_POST["Editcategoria"];


  $edit -> ajaxEditarProductos();

}


/*===========================================
=       VERIFICAR CODIGO DE PRODUCTO        =
============================================*/
if (isset($_POST["codProducto"])) {
  $ajx = new ajaxProductos();

  $ajx->codProducto = $_POST["codProducto"];
  $ajx->ajaxVerificarCodigo();
}


/*==================================
=    VERIFICAR LISTAS DE PRECIOS   =
====================================*/
if(isset($_GET["verificarListasPrecios"])) {
  $ajx = new ajaxProductos();
  $ajx -> ajaxVerificarListasPrecios();
}

/*================================
=    GUARDAR LISTA DE PRODUCTOS  =
==================================*/

if(isset($_POST["listaProductos"])) {
  $ajx = new ajaxProductos();
  $ajx->listaProductos = $_POST["listaProductos"];
  $ajx->ajaxRegistrarListaProductos();
}