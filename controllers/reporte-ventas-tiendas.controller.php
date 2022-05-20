 
 <?php 



 
     
class controladorVentasTiendas {


 

  /*=============================================
=            LOAD TIENDAS SALES           =
=============================================*/

static public function ctrventastiendas($startDate, $endDate,$supervisor){

    $schema = $_COOKIE['tabla_tiendas'];

        $table = $schema.".tblinforme";   

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos"; 
 
       $table9="callcenter.tbl_fechas"; 

       $table5=$schema.".tbl_usuarios_tiendas"; 

      
    $response = reporteVentasTiendasModel::Mdlventastiendas($table,$table2,$table3,$table4, $startDate, $endDate, $table9,$supervisor,$table5); 



    return $response;

  }


/*=============================================
= CARGAR COORDINADRES POR VENDEDOR       =
=============================================*/


static public function ctrTiendasReporteVentas(){

$schema = $_COOKIE['tabla_tiendas'];

       $table = $schema.".tbl_tiendas";   		

		$response = reporteVentasTiendasModel::MdlTiendasReporteVentas($table);		

		return $response;


	}


	static public function ctrCargarDatosDetalleVentasPospago($item, $value, $item2, $value2,$startDate, $endDate){

$schema = $_COOKIE['tabla_tiendas'];

       $table = $schema.".tblinforme";  		

		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasPospago($table,$item, $value, $item2, $value2,$startDate, $endDate);		

		return $response;


	}

		static public function ctrCargarVentasPospago($startDate, $endDate,$supervisor){

       $schema = $_COOKIE['tabla_tiendas'];
       $table = $schema.".tblinforme";  
       $table2 = $schema.".tbl_usuarios_tiendas";   		

		$response = reporteVentasTiendasModel::MdlCargarVentasPospago($table,$table2,$startDate, $endDate,$supervisor);		

		return $response;


	}

	static public function ctrCargarVentasPrepagoDigital($startDate, $endDate,$supervisor){

$schema = $_COOKIE['tabla_tiendas'];

       $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos";   	

        $table4 = $schema.".tbl_usuarios_tiendas"; 


    
		$response = reporteVentasTiendasModel::MdlCargarVentasPrepagoDigital($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	} 

		static public function ctrCargarVentasPrepagoClaro($startDate, $endDate){

        $schema = $_COOKIE['tabla_tiendas'];

       $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos";   	

  $table4 = $schema.".tbl_usuarios_tiendas"; 
    
		$response = reporteVentasTiendasModel::MdlCargarVentasPrepagoClaro($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}


		static public function ctrCargarVentasTotales($startDate, $endDate, $supervisor){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tblinforme";   

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos"; 

       $table5 = $schema.".tbl_tiendas";  

       $table6 = $schema.".tbl_usuarios_tiendas";   	
    
		$response = reporteVentasTiendasModel::MdlCargarVentasTotales($table,$table2,$table3,$table4,$table5,$startDate, $endDate,$supervisor,$table6);		

		return $response;


	}

			static public function ctrCargarEstadoTiendas($supervisor){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_tiendas";   

       $table2 = $schema.".tbl_horarios_tiendas";   

       $table3 = $schema.".tbl_motivos_horarios";

       $table4 = $schema.".tbl_usuarios_tiendas";   
	    
		$response = reporteVentasTiendasModel::MdlCargarEstadoTiendas($table,$table2,$table3, $table4, $supervisor);		

		return $response;


	}

				static public function ctrCargarDatosDetalleEstadoTienda($item, $value){

     $schema = $_COOKIE['tabla_tiendas'];

 	$table = $schema.".tbl_tiendas";   

       $table2 = $schema.".tbl_horarios_tiendas";   

       $table3 = $schema.".tbl_motivos_horarios";  

        $table4 = $schema.".tblgestor"; 
	    
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleEstadoTienda($table,$table2,$table3,$table4,$item, $value);		

		return $response;


	}

					static public function ctrCargarContratosIndexados($startDate,$endDate){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_tiendas";   

       $table2 = $schema.".tblinforme";   

       $table3 = $schema.".tbldth";  

        $table4 = $schema.".tbldth2"; 
	    
		$response = reporteVentasTiendasModel::MdlCargarContratosIndexados($table,$table2,$table3,$table4,$startDate,$endDate);		

		return $response;


	}


					static public function ctrCargarCriticasxBO($startDate,$endDate){

        $schema = $_COOKIE['tabla_dth'];

 		$table = $schema.".tbl_criticas";   
       	    
		$response = reporteVentasTiendasModel::MdlCargarCriticasxBO($table,$startDate,$endDate);		

		return $response;


	}

						static public function ctrCargarPendientesEncomiendas($supervisor){

         $schema = $_COOKIE['tabla_tiendas'];

         $schemadth = $_COOKIE['tabla_dth'];

 		$table = $schema.".tbl_tiendas";   

       $table2 = $schema.".tblinforme";   

       $table3 = $schema.".tbldth";  

        $table4 = $schema.".tbldth2"; 

        $table5 = $schemadth.".tbl_detalle_encomiendas"; 

        $table6 = $schema.".tbl_usuarios_tiendas";
       	    
		$response = reporteVentasTiendasModel::MdlCargarPendientesEncomiendas($table,$table2,$table3,$table4,$table5,$supervisor,$table6);		

		return $response;


	}


      static public function ctrCargarVentasTotalesCompararTablas($Vardesde1, $Varhasta1,$Vardesde2, $Varhasta2){

          
$schema = $_COOKIE['tabla_tiendas'];

    $table = $schema.".tblinforme";   

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos"; 

       $table5 = $schema.".tbl_tiendas";    

       $table6 = $schema.".tbl_supervisores";

       $table7 = $schema.".tbl_supervisores_tiendas";
    
    $response = reporteVentasTiendasModel::MdlCargarVentasTotalesCompararTablas($table,$table2,$table3,$table4,$table5, $table6, $table7 ,$Vardesde1, $Varhasta1,$Vardesde2, $Varhasta2);   

    return $response;


  }

		static public function ctrCargarDatosDetalleVentasKitsDigital($item, $value, $item2, $value2,$startDate, $endDate){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_equipos"; 

 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

     
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasKitsDigital($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}


		static public function ctrCargarDatosDetalleVentasKitsClaro($item, $value, $item2, $value2,$startDate, $endDate){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_equipos"; 

 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

 
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasKitsClaro($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}

			static public function ctrCargarDatosDetalleVentasAccesorios($item, $value, $item2, $value2,$startDate, $endDate){
$schema = $_COOKIE['tabla_tiendas'];
         	
 		$table = $schema.".tbl_equipos"; 

 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  
     
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasAccesorios($table,$table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}

		static public function ctrCargarDatosDetalleVentasRecaudaciones($item, $value, $item2, $value2,$startDate, $endDate){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_recaudacion"; 

 		$table2 = $schema.".tbl_tipos_recuadacion"; 

     
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasRecaudaciones($table,$table2,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}

		static public function ctrCargarDatosDetalleVentasActivaciones($item, $value, $item2, $value2,$startDate,$endDate){

         	$schema = $_COOKIE['tabla_tiendas'];
 		$table = $schema.".tbl_activacion"; 

      
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasActivaciones($table,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}


	static public function ctrCargarDatosDetalleVentasTae($item, $value, $item2, $value2,$startDate,$endDate){

         	$schema = $_COOKIE['tabla_tiendas'];
 		$table2 = $schema.".tbl_facturas"; 

 		$table3 = $schema.".tbl_detalle_facturas"; 

 	
 	    

     
		$response = reporteVentasTiendasModel::MdlCargarDatosDetalleVentasTae($table2,$table3,$startDate, $endDate,$item, $value, $item2, $value2);		

		return $response;


	}

			static public function ctrCargarVentasTablaPospago($startDate, $endDate){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tblinforme";   

     
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaPospago($table,$startDate, $endDate);		

		return $response;


	}

		static public function ctrCargarVentasArpuPospago($startDate, $endDate,$supervisor){
$schema = $_COOKIE['tabla_tiendas'];
         	

 		$table = $schema.".tblinforme";   

 		$table4 = $schema.".tbl_usuarios_tiendas"; 

     
		$response = reporteVentasTiendasModel::MdlCargarVentasArpuPospago($table,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

				static public function ctrCargarVentasArpuPrepagoDigital($startDate, $endDate,$supervisor){
$schema = $_COOKIE['tabla_tiendas'];
         	
 		$table = $schema.".tbl_equipos"; 

 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_usuarios_tiendas"; 
 

     
		$response = reporteVentasTiendasModel::MdlCargarVentasArpuPrepagoDigital($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

			static public function ctrCargarVentasArpuPrepagoClaro($startDate, $endDate,$supervisor){
$schema = $_COOKIE['tabla_tiendas'];
         	
 		$table = $schema.".tbl_equipos"; 

 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  
 
  $table4 = $schema.".tbl_usuarios_tiendas"; 
     
		$response = reporteVentasTiendasModel::MdlCargarVentasArpuPrepagoClaro($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}


			static public function ctrCargarVentasTAE($startDate, $endDate){

         	$schema = $_COOKIE['tabla_tiendas'];
 		$table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

		$response = reporteVentasTiendasModel::MdlCargarVentasTAE($table2,$table3,$startDate, $endDate);		

		return $response;


	}

			static public function ctrCargarVentasActivaciones($startDate, $endDate, $supervisor){
$schema = $_COOKIE['tabla_tiendas'];
         	
 		$table = $schema.".tbl_activacion";   

 		$table4 = $schema.".tbl_usuarios_tiendas"; 
            
		$response = reporteVentasTiendasModel::MdlCargarVentasActivaciones($table,$startDate, $endDate, $supervisor,$table4);		

		return $response;


	}

			static public function ctrCargarVentasRecaudaciones($startDate, $endDate,$supervisor){
 
         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_recaudacion";   

   $table4 = $schema.".tbl_usuarios_tiendas"; 
     
		$response = reporteVentasTiendasModel::MdlCargarVentasRecaudaciones($table,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

			static public function ctrCargarVentasTablaRecaudaciones($startDate, $endDate,$supervisor){

         	$schema = $_COOKIE['tabla_tiendas'];

 		$table = $schema.".tbl_recaudacion";   
 $table4 = $schema.".tbl_usuarios_tiendas"; 
     
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaRecaudaciones($table,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

		static public function ctrCargarVentasTablaTae($startDate, $endDate,$supervisor){

         	$schema = $_COOKIE['tabla_tiendas'];

 	   $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";

       $table4 = $schema.".tbl_usuarios_tiendas";    

     
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaTae($table,$table2,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

			static public function ctrCargarVentasTablaActivaciones($startDate, $endDate,$supervisor){
$schema = $_COOKIE['tabla_tiendas'];
         	
 	   $table = $schema.".tbl_activacion"; 

 	        $table4 = $schema.".tbl_usuarios_tiendas";     
       
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaActivaciones($table,$startDate, $endDate,$supervisor,$table4);		

		return $response;


	}

			static public function ctrCargarVentasTablaKitsDigital($startDate, $endDate,$supervisor){

         	
$schema = $_COOKIE['tabla_tiendas'];
 	

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos";  

       $table5 = $schema.".tbl_usuarios_tiendas"; 	
    
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaKitsDigital($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5);		

		return $response;


	}

				static public function ctrCargarVentasTablaAccesorios($startDate, $endDate,$supervisor){

         	
$schema = $_COOKIE['tabla_tiendas'];
 	

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos";  

       $table5 = $schema.".tbl_usuarios_tiendas"; 	 	
    
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaAccesorios($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5);		

		return $response;


	}


		static public function ctrCargarVentasTablaKitsClaro($startDate, $endDate,$supervisor){

         	
$schema = $_COOKIE['tabla_tiendas'];
 	

       $table2 = $schema.".tbl_facturas";   

       $table3 = $schema.".tbl_detalle_facturas";  

       $table4 = $schema.".tbl_equipos"; 

        $table5 = $schema.".tbl_usuarios_tiendas";   	
    
		$response = reporteVentasTiendasModel::MdlCargarVentasTablaKitsClaro($table2,$table3,$table4,$startDate, $endDate,$supervisor,$table5);		

		return $response;


	}

	

			static public function ctrCargarVentasAccesorios($startDate, $endDate,$supervisor){ 
      $schema = $_COOKIE['tabla_tiendas'];

	   $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos"; 

         $table4 = $schema.".tbl_usuarios_tiendas"; 


    
		$response = reporteVentasTiendasModel::MdlCargarVentasAccesorios($table,$table2,$table3,$startDate, $endDate,$supervisor,$table4);		

		return $response;

 
	}

static public function ctrCargarTiendas($supervisor){
			
			$schema = $_COOKIE['tabla_tiendas'];   

            $table = $schema.".tbl_tiendas";   

            $table2 = $schema.".tbl_usuarios_tiendas";  
        
            $response = reporteVentasTiendasModel::MdlCargarTiendas($table, $table2, $supervisor);    

            return $response;
     
  }

 
static public function ctrCargarMetasTiendas($startDate, $endDate,$tienda,$supervisor){

$schema = $_COOKIE['tabla_tiendas'];
    $table1 = "empresas.tbl_metas_tiendas";   
    $table2 = $schema.".tbl_usuarios_tiendas"; 
    $table3= $schema.".tbl_tiendas"; 
     
    $response = reporteVentasTiendasModel::MdlCargarMetasTiendas($table1,$table2,$table3, $startDate, $endDate,$tienda,$supervisor);    
    
    return $response;

     
  }


      static public function ctrCargarVentasAccesoriosTienda($startDate, $endDate, $tienda){
$schema = $_COOKIE['tabla_tiendas'];

     $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos"; 


    
    $response = reporteVentasTiendasModel::MdlCargarVentasAccesoriosTienda($table,$table2,$table3,$startDate, $endDate, $tienda);    

    return $response;

 
  }

      static public function ctrCargarVentasActivacionesTiendas($startDate, $endDate, $supervisor){

$schema = $_COOKIE['tabla_tiendas'];
$table = $schema.".tbl_activacion";  

    
    $response = reporteVentasTiendasModel::MdlCargarVentasActivacionesTiendas($table, $startDate, $endDate, $supervisor);    

    return $response;

 
  }

    static public function ctrCargarVentasArpuPospagoTiendas($startDate, $endDate, $tienda){
       
       $schema = $_COOKIE['tabla_tiendas'];
    $table = $schema.".tblinforme";   

    $response = reporteVentasTiendasModel::MdlCargarVentasArpuPospagoTiendas($table,$startDate, $endDate, $tienda);   

    return $response;


  }

   static public function ctrCargarVentasDTHTiendas($startDate, $endDate, $tienda){
       $schema = $_COOKIE['tabla_tiendas'];
    $table = $schema.".tbldth";   
    $table2 = $schema.".tbldth2"; 

    $response = reporteVentasTiendasModel::MdlCargarVentasDTHTiendas($table, $table2, $startDate, $endDate, $tienda);   

    return $response;
 

  }


  static public function ctrCargarVentasPrepagoDigitalTiendas($startDate, $endDate, $tienda){
$schema = $_COOKIE['tabla_tiendas'];
       $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos";    
   
  $response = reporteVentasTiendasModel::MdlCargarVentasPrepagoDigitalTiendas($table,$table2,$table3,$startDate, $endDate, $tienda);    

    return $response;

  }

    static public function ctrCargarVentasPrepagoClaroTiendas($startDate, $endDate, $tienda){
$schema = $_COOKIE['tabla_tiendas'];
       $table = $schema.".tbl_facturas";   

       $table2 = $schema.".tbl_detalle_facturas";  

       $table3 = $schema.".tbl_equipos";    
   
  $response = reporteVentasTiendasModel::MdlCargarVentasPrepagoClaroTiendas($table,$table2,$table3,$startDate, $endDate, $tienda);    

    return $response;

  }

    static public function ctrCargarVentasPospagoTiendas($startDate, $endDate, $tienda){
$schema = $_COOKIE['tabla_tiendas'];
       $table = $schema.".tblinforme";      

    $response = reporteVentasTiendasModel::MdlCargarVentasPospagoTiendas($table,$startDate, $endDate, $tienda);   

    return $response;


  }


  static public function ctrCargarVentasRecaudacionesTiendas($startDate, $endDate, $tienda){
    $schema = $_COOKIE['tabla_tiendas'];
    $table = $schema.".tbl_recaudacion";   

    $response = reporteVentasTiendasModel::MdlCargarVentasRecaudacionesTiendas($table, $startDate, $endDate, $tienda);   
    return $response;



  }

    static public function ctrCargarVentasMetaLlaveTiendas($startDate, $endDate, $tienda){
    $schema = $_COOKIE['tabla_tiendas'];
    $table = $schema.".tblinforme";   

    $response = reporteVentasTiendasModel::MdlCargarVentasMetaLlaveTiendas($table, $startDate, $endDate, $tienda);   
    return $response;



  }



/*=============================================
= CARGAR VENTAS TOTALES, TODOS LOS SUPERVISORES =
=============================================*/

static public function ctrCargarVentasTotalesXSupervisortiendas($startDate, $endDate){
$schema = $_COOKIE['tabla_tiendas'];
       $table = $schema.".tbl_supervisores_tiendas";
       $table1 = $schema.".tbl_supervisores";
       $table2 = $schema.".tblinforme";
       $table3 = $schema.".tbl_tiendas";
       $table4 = $schema.".tbl_detalle_facturas"; 
       $table5 = $schema.".tbl_facturas";
       $table6 = $schema.".tbl_equipos";


$response = reporteVentasTiendasModel::MdlCargarVentasTotalesXSupervisortiendas($table,$table1,$table2,$table3,$table4,$table5,$table6,$startDate, $endDate);   

    return $response;


}







}