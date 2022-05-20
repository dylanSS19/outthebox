 <?php

  
 
class ProductosController{

    /*=============================================
    =                   CARGAR CLIENTES EDITAR              =
    =============================================*/

    static public function ctrCargarUnidadMedida(){

       $table = "empresas.tbl_unidades_medida_hacienda";    
      
        $response = ProductosModel::MdlCargarUnidadMedida($table); 

        return $response;


    } 



    /*=============================================
    =         CARGAR CABYS             =
    =============================================*/

    static public function ctrCargarCabys($Producto){

      $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.hacienda.go.cr/fe/cabys?q='.$Producto,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: TS01d94531=0120156b2892ca22057f867b9d4cf28e52f7180053c821bbd00e76faa950e90965b365220a86919942a673839030efc9e5039a9876'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response; 

        return $response;


    } 


    /*=============================================
    =        AGREGAR PRODUCTOS                    =
    =============================================*/

    static public function ctrAgregarProductos($cabys, $codigo, $unidad, $tarifa, $cantidad, $descripcion, $codImpuesto, $categoria){

      $table = "empresas.tbl_productos";    
      $id_empresa = $_SESSION['id_empresa'];
      $response = ProductosModel::MdlAgregarProductos($table, $id_empresa, $cabys, $codigo, $unidad, $tarifa, $cantidad, $descripcion, $codImpuesto, $categoria); 

      return $response;


    } 


    /*=============================================
    =        AGREGAR PRODUCTOS              =
    =============================================*/

    static public function ctrCargarProductos(){

       $table = "empresas.tbl_productos";   
       $id_empresa = $_SESSION['id_empresa'];
      
        $response = ProductosModel::MdlCargarProductos($table, $id_empresa); 

        return $response;


    } 

  /*=============================================
    =        AGREGAR X ID PRODUCTOS              =
    =============================================*/

    static public function ctrCargarProductosXid($id_proucto){

       $table = "empresas.tbl_productos";    
      
        $response = ProductosModel::MdlCargarProductosXid($table, $id_proucto); 

        return $response;


    }  


 /*=============================================
    =        AGREGAR X ID PRODUCTOS              =
    =============================================*/

    static public function ctrEditarProductos($Id_producto, $CodCabys, $Codigo_comercial, $Unidad_Medida, $Tarifa, $Cantidad, $Descripcion,  $impuesto, $categoria){

       $table = "empresas.tbl_productos";    
      
        $response = ProductosModel::MdlEditarProductos($table, $Id_producto, $CodCabys, $Codigo_comercial, $Unidad_Medida, $Tarifa, $Cantidad, $Descripcion,  $impuesto, $categoria); 

        return $response;


    } 


    static public function ctrCargarTimpuestos(){

      $table = "empresas.tbl_impuestos";    
     
       $response = ProductosModel::MdlCargarTimpuestos($table); 

       return $response;


   } 

   static public function ctrCargarTarifaImpuesto(){

    $table = "empresas.tbl_tarifa_impuestos";    
   
     $response = ProductosModel::MdlCargarTarifaImpuesto($table); 

     return $response;


 } 


  /*===================================
  =      CARGAR LISTAS DE PRECIOS     =
  =====================================*/ 
  static public function ctrCargarListasPrecios ($idProducto) {

    $table1 = "empresas.tbl_listas_precio";
    $table2 = "empresas.tbl_listas_precios_equipos";
    $table3 = "empresas.tbl_productos";
    $idProducto = intval($idProducto);
    $id_empresa = $_SESSION['id_empresa'];



    $response = ProductosModel::MdlCargarListasPrecios($table1, $table2, $table3, $idProducto, $id_empresa);
    return $response;

  }


  /*=====================================
	=       INSERTAR LISTA DE PRECIOS     =
	=======================================*/
  static public function ctrInsertarListaPrecios($idProducto,$nombreLista,$precio,$costo,$margen,$porcentaje) {

    $table1 = "empresas.tbl_listas_precios_equipos";
    $table2 = "empresas.tbl_listas_precio";
    $idEmpresa = $_SESSION['id_empresa'];
    $response = ProductosModel::MdlInsertarListaPrecios($table1,$table2,$idEmpresa,$idProducto,$nombreLista,$precio,$costo,$margen,$porcentaje);

    return $response;
  }

  /*===================================
  =    ACTUALIZAR LISTAS DE PRECIOS   =
  =====================================*/ 
  static public function ctrActualizarListaPrecios($id,$nombre,$precio,$costo,$margen,$porcentaje) {

    $table = "empresas.tbl_listas_precios_equipos";

    $response = ProductosModel::MdlActualizarListaPrecios($table,$id,$nombre,$precio,$costo,$margen,$porcentaje);
    return $response;
  }


  /*===================================
  =    CARGAR COSTOS PROMEDIO/ULTIMO  =
  =====================================*/ 
  static public function ctrCargarCostos($sku,$tipoCosto) {

    $table1 = "empresas.tbl_productos";
    $table2 = "empresas.tbl_inventario";

    $idEmpresa = $_SESSION['id_empresa'];

    $response = ProductosModel::MdlCargarCostos($table1,$table2,$sku, $idEmpresa, $tipoCosto);
    return $response;
  }


  /*==================================
	=       CARGAR TIPO DE COSTO       =
	====================================*/
  static public function ctrCargarTipoCosto($sku) {
    $table = "empresas.tbl_productos";
    $idEmpresa = $_SESSION['id_empresa'];

    $response = ProductosModel::MdlCargarTipoCostos($table, $idEmpresa, $sku);

    return $response;
  }

 /*=================================
  =      CAMBIAR TIPO DE COSTO      =
  ==================================*/

  static public function ctrCambiarTipoCosto($sku,$tipoCosto) {
    $table = "empresas.tbl_productos";
    $idEmpresa = $_SESSION['id_empresa'];

    $response = productosModel::MlCambiarTipoCostos($table, $idEmpresa, $sku, $tipoCosto);
    return $response;
  }

  /*================================
  =    VERIFICAR CODIGO PRODUCTO   =
  =================================*/

  static public function ctrVerificarCodProductos($codProducto) {

    $table = "empresas.tbl_productos";
    $idEmpresa = $_SESSION['id_empresa'];

    $response = productosModel::MdlVerificarCodProductos($table, $idEmpresa, $codProducto);

    return $response;
  }

  	/*==================================
    =    VERIFICAR LISTAS DE PRECIOS   =
    ====================================*/
  static public function ctrVerificarListasPrecios(){
    $table = "empresas.tbl_listas_precio";
    $idEmpresa = $_SESSION['id_empresa'];

    $response = ProductosModel::MdlVerificarListasPrecios($table, $idEmpresa);

    return $response;
  }

  /*=================================
  =    GUARDAR LISTA DE PRODUCTOS   =
  ==================================*/
  static public function ctrRegistroListaProductos($listaProductos) {
    $idEmpresa = $_SESSION['id_empresa'];
    $table1 = "empresas.tbl_productos";

    $response = ProductosModel::MdlInsertarListaProductos($idEmpresa, $table1, $listaProductos);

    return $response;

  }
}