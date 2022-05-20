<?php



require_once "../controllers/reporte-ventas-dth.controller.php";
require_once "../models/reporte-ventas-dth.model.php";


class AjaxSalesDetailsCalle{


	  /*=============================================
  =                  LOAD SALES DATAILS                 =
  =============================================*/

  public $varidzona;

  public function AjaxSalesDetails(){

    $item = "idzona";

    $value = $this->varidzona;

 $response = ControladorVentasDth::ctrCargarDatosDetalleVentasXGrupo($item, $value);


 echo json_encode($response);
    

  } 


    public $varaño;

  public function AjaxSalesAnual(){

    
    $año = $this->varaño;

 $response = reporteVentasDthModel::MdlCargarVentasAnuales($año);


              $JsonData = '{
               "data": [';

              
                for($i =0; $i < count($response); $i++){

                  


    $JsonData .= '[
                   "'.$response[$i]["mes"].'",
                   "'.$response[$i]["dth"].'",                   
                   "'.$response[$i]["internet"].'",
                   "'.$response[$i]["pospago"].'",                   
                   "'.$response[$i]["gpon"].'",
                   "'.$response[$i]["total"].'"

                   ],';

}
        

                $JsonData = substr($JsonData, 0, -1);

     $JsonData .=   '] 

     }';

        if(count($response) == 0) {
   $JsonData = '{
               "data": [] }';

             };


    
    echo $JsonData;


   // echo json_encode($response);

   /* echo $value;*/

  } 









}




    /*=============================================
  =       VALIDATE CODE OBJECT                =
  =============================================*/

  if(isset($_POST["varidzona"])){

    $valOrder= new AjaxSalesDetailsCalle();

    $valOrder -> varidzona = $_POST["varidzona"];

    $valOrder -> AjaxSalesDetails();
  }

    if(isset($_GET["varaño"])){

    $valOrder= new AjaxSalesDetailsCalle();

    $valOrder -> varaño = $_GET["varaño"];

    $valOrder -> AjaxSalesAnual();
  }

     