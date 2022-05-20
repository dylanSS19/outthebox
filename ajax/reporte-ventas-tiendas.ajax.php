<?php



require_once "../controllers/reporte-ventas-tiendas.controller.php";
require_once "../models/reporte-ventas-tiendas-model.php";


class AjaxSalesDetailsTiendas{


	  /*=============================================
  =                  LOAD SALES DATAILS POSPAGO                =
  =============================================*/

  public $vargestor;

   public $vartienda;

  public $startDate;

   public $endDate;
   

  public function AjaxSalesDetailsTiendasPospago(){

    $item = "gestor";

    $value = $this->vargestor;

     $item2 = "tienda";

     $value2 = $this->vartienda;

     $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasPospago($item, $value, $item2, $value2,$startDate, $endDate);


/*echo $value;
*/
    echo json_encode($response);

  } 


      /*=============================================
  =                  LOAD SALES DATAILS KITS DIGITAL                =
  =============================================*/

  public $vargestorkitsdigital;

   public $vartiendakitsdigital;

  public function AjaxSalesDetailsTiendaKitsDigital(){

    $item = "gestor";

    $value = $this->vargestorkitsdigital;

     $item2 = "tienda";

        $value2 = $this->vartiendakitsdigital;

      $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasKitsDigital($item, $value, $item2, $value2,$startDate, $endDate);


/*echo $value;
*/
    echo json_encode($response);

  } 

        /*=============================================
  =                  LOAD SALES DATAILS KITS CLARO                =
  =============================================*/

  public $vargestorkitsclaro;

   public $vartiendakitsclaro;

  public function AjaxSalesDetailsTiendaKitsClaro(){

    $item = "gestor";

    $value = $this->vargestorkitsclaro;

     $item2 = "tienda";

        $value2 = $this->vartiendakitsclaro;

              $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasKitsClaro($item, $value, $item2, $value2,$startDate, $endDate);


/*echo $value;
*/
    echo json_encode($response);

  } 

          /*=============================================
  =                  LOAD SALES DATAILS ACCESORIOS               =
  =============================================*/

  public $vargestoraccesorios;

   public $vartiendaaccesorios;

  public function AjaxSalesDetailsTiendaAccesorios(){

    $item = "gestor";

    $value = $this->vargestoraccesorios;

     $item2 = "tienda";

        $value2 = $this->vartiendaaccesorios;

                  $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasAccesorios($item, $value, $item2, $value2,$startDate, $endDate);


/*echo $value;
*/
    echo json_encode($response);

  } 

            /*=============================================
  =                  LOAD SALES DATAILS RECAUDACIONES               =
  =============================================*/

  public $vargestorrecaudaciones;

   public $vartiendarecaudaciones;

  public function AjaxSalesDetailsTiendaRecaudaciones(){

    $item = "gestor";

    $value = $this->vargestorrecaudaciones;

     $item2 = "tienda";

        $value2 = $this->vartiendarecaudaciones;

                          $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasRecaudaciones($item, $value, $item2, $value2,$startDate, $endDate);


/*echo $value2;
*/
    echo json_encode($response);

  } 


           /*=============================================
  =                  LOAD SALES DATAILS ACTIVACIONES               =
  =============================================*/

  public $vargestoractivaciones;

   public $vartiendaactivaciones;

  public function AjaxSalesDetailsTiendaActivaciones(){

    $item = "gestor";

    $value = $this->vargestoractivaciones;

     $item2 = "tienda";

        $value2 = $this->vartiendaactivaciones;

             $startDate = $this->startDate;

     $endDate = $this->endDate;

                           if(!isset($endDate) || $endDate == "null"){

                           date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }

 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasActivaciones($item, $value, $item2, $value2,$startDate,$endDate);


/*echo $value2;
*/
    echo json_encode($response);

  } 

           /*=============================================
  =                  LOAD SALES DATAILS TAE               =
  =============================================*/

  public $vargestortae;

   public $vartiendatae;

  public function AjaxSalesDetailsTiendasTae(){

    $item = "gestor";

    $value = $this->vargestortae;

    $item2 = "tienda";

    $value2 = $this->vartiendatae;

    $startDate = $this->startDate;

     $endDate = $this->endDate;

              if(!isset($endDate) || $endDate == "null"){

              date_default_timezone_set('America/Costa_Rica');

              $today = date('Y-m-d');

               $startDate = date('Y-m-01', strtotime($today));

               $endDate = date('Y-m-t', strtotime($today));



                   }


 $response = controladorVentasTiendas::ctrCargarDatosDetalleVentasTae($item, $value, $item2, $value2,$startDate,$endDate);


/*echo $value2;
*/
    echo json_encode($response);

  } 


           /*=============================================
  =                  LOAD SALES DATAILS TAE               =
  =============================================*/

 

  public $idtienda;

  public function AjaxEstadoTiendas(){

    $item = "reporte-tiendas";

    $value = $this->idtienda;

 
 $response = controladorVentasTiendas::ctrCargarDatosDetalleEstadoTienda($item, $value);


/*echo $value2;
*/
    echo json_encode ($response);

  } 









}

    /*=============================================
  =       TABLE DETALLE ESTADO TIENDAS               =
  =============================================*/

  if(isset($_POST["idtienda"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> idtienda = $_POST["idtienda"];

    $valOrder -> AjaxEstadoTiendas();
  }

    /*=============================================
  =       TABLE TAE OBJECT                =
  =============================================*/

  if(isset($_POST["vartiendatae"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestortae = $_POST["vargestortae"];

     $valOrder -> vartiendatae = $_POST["vartiendatae"];

          $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendasTae();
  }



    /*=============================================
  =       TABLE POSPAGO OBJECT                =
  =============================================*/

  if(isset($_POST["vartienda"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestor = $_POST["vargestor"];

     $valOrder -> vartienda = $_POST["vartienda"];

     $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendasPospago();
  }

      /*=============================================
  =       TABLE KITS DIGITAL OBJECT                =
  =============================================*/

  if(isset($_POST["vargestorkitsdigital"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestorkitsdigital = $_POST["vargestorkitsdigital"];

     $valOrder -> vartiendakitsdigital = $_POST["vartiendakitsdigital"];

       $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendaKitsDigital();
  }

        /*=============================================
  =       TABLE KITS CLARO OBJECT                =
  =============================================*/

  if(isset($_POST["vargestorkitsclaro"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestorkitsclaro = $_POST["vargestorkitsclaro"];

     $valOrder -> vartiendakitsclaro = $_POST["vartiendakitsclaro"];

        $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendaKitsClaro();
  }
     
        /*=============================================
  =       TABLE ACCESORIOS OBJECT                =
  =============================================*/

  if(isset($_POST["vargestoraccesorios"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestoraccesorios = $_POST["vargestoraccesorios"];

     $valOrder -> vartiendaaccesorios = $_POST["vartiendaaccesorios"];

          $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendaAccesorios();
  }

          /*=============================================
  =       TABLE RECAUDACIONES OBJECT                =
  =============================================*/

  if(isset($_POST["vargestorrecaudaciones"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestorrecaudaciones = $_POST["vargestorrecaudaciones"];

     $valOrder -> vartiendarecaudaciones = $_POST["vartiendarecaudaciones"];

               $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];


    $valOrder -> AjaxSalesDetailsTiendaRecaudaciones();
  }
     

              /*=============================================
  =       TABLE ACTIVACIONES OBJECT                =
  =============================================*/

  if(isset($_POST["vargestoractivaciones"])){

    $valOrder= new AjaxSalesDetailsTiendas();

    $valOrder -> vargestoractivaciones = $_POST["vargestoractivaciones"];

     $valOrder -> vartiendaactivaciones = $_POST["vartiendaactivaciones"];

       $valOrder -> endDate = $_POST["endDate"];

     $valOrder -> startDate = $_POST["startDate"];

    $valOrder -> AjaxSalesDetailsTiendaActivaciones();
  }
     