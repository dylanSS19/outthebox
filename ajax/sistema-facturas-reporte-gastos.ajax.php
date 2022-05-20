<?php

require_once "../controllers/sistema-facturas-reporte-gastos.controller.php";
require_once "../models/sistema-facturas-reporte-gastos.model.php";

class ajaxReportGastos{
 

    public $idFact;

    public function ajaxCargarDatosFacturaGasto(){

    $idFactura = $this->idFact;
  

        $response = ReporteGastosController::ctrCargarDatosFacturaGasto($idFactura);

        echo json_encode($response);

    }

    public $DatosIdFactura;

    public function ajaxCargarDatosFactura(){

        $idFactura = $this->DatosIdFactura;
  
        $response = ReporteGastosController::ctrCargarDatosFactura($idFactura);

        echo json_encode($response);

    }

/*=============================================
=        CONECTAR CON API HD           =
=============================================*/

public $DatosFactura;

public function ajaxEnviarFacturaApi(){
  
     $data = $this->DatosFactura;
    // echo '<pre>'; print_r( $data); echo '</pre>';
   $ch = curl_init("https://outthebox-cr.com/api/api-aceptacion-facturas.controller.php");
//    $ch = curl_init("http://localhost/outthebox/api/api-aceptacion-facturas.controller.php");

      //$ch = curl_init("https://posfacturar.com/pos_digitalsat/public/api/v5/sale/getBillSearch");

          //URL de Produccion http://wcf.facturoporti.com.mx/Timbrado/Servicios.svc/ApiTimbrarCFDI
         //curl_setopt($ch, CURLOPT_URL, "http://posfacturar.com/pos_digitalsat/public/api/v5/sale/add");
        //a true, obtendremos una respuesta de la url, en otro caso,
       //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Se define el tipo de metodo de envio de datos
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
        //establecemos el verbo http que queremos utilizar para la petición
       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);

        echo $response;
            
  

}



}

if(isset($_POST["IdFacGasto"])){

    $edit = new ajaxReportGastos();
  
    $edit -> idFact = $_POST["IdFacGasto"];
 
    
    $edit -> ajaxCargarDatosFacturaGasto();
  
  }


  if(isset($_POST["DatosIdFactura"])){

    $edit = new ajaxReportGastos();
  
    $edit -> DatosIdFactura = $_POST["DatosIdFactura"];
 
    
    $edit -> ajaxCargarDatosFactura();
  
  }


  if(isset($_POST["DatosFactura"])){

    $edit = new ajaxReportGastos();
  
   $edit -> DatosFactura = $_POST["DatosFactura"];

    $edit -> ajaxEnviarFacturaApi();
  
  }