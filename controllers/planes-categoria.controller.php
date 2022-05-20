<?php

class PlanesCategoriasController{ 

			/*=============================================
=                   CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarPlanes(){

       $table = "empresas.tbl_modulos_outthebox"; 	
      
		$response = PlanesCategoriasModel::MdlCargarPlanes($table);	

		return $response;


	} 
 

    static public function ctrAgregarCategoria($modulosPaquete, $nombrePaquete, $skuPaquete, $cabysPaquete, $planesPaquete, $diasPaquete, $precioPaquete , $ivaPaquete, $codTarifaPaquete, $tarifaPaquete, $moneda){

        $table = "empresas.tbl_categoria_planes"; 	
       
         $response = PlanesCategoriasModel::MdlAgregarCategoria($table, $modulosPaquete, $nombrePaquete, $skuPaquete, $cabysPaquete, $planesPaquete, $diasPaquete, $precioPaquete , $ivaPaquete, $codTarifaPaquete, $tarifaPaquete, $moneda);	
 
         return $response;
 
 
     } 

     static public function ctrCargarCategorias(){

        $table = "empresas.tbl_categoria_planes"; 	
         
         $response = PlanesCategoriasModel::MdlCargarCategorias($table);	
 
         return $response;
 
 
     } 


     static public function ctrValidarPaquetes($plan, $paquete){

        $table = "empresas.tbl_categoria_planes"; 	
        	 
         $response = PlanesCategoriasModel::MdlValidarPaquetes($table, $plan, $paquete);	
 
         return $response;
 
 
     } 


     static public function ctrCargarCategoriaEditar($categorias){

        $table = "empresas.tbl_categoria_planes"; 	
	
        	 
         $response = PlanesCategoriasModel::MdlCargarCategoriaEditar($table, $categorias);	
 
         return $response;
 
 
     }

     static public function ctrModificarCategoria($editaridPaquete, $editarNombre, $editarSku, $editarCabys, $editarCantDocumentos, $editarDias, $editarPrecio, $editarMoneda){

        $table = "empresas.tbl_categoria_planes"; 	
       
         $response = PlanesCategoriasModel::MdlModificarCategoria($table, $editaridPaquete, $editarNombre, $editarSku, $editarCabys, $editarCantDocumentos, $editarDias, $editarPrecio, $editarMoneda);	
 
         return $response;
 
 
     } 

     static public function ctrModificarEstado($fecha, $estado, $IdPaq){

        $table = "empresas.tbl_categoria_planes"; 	
       
         $response = PlanesCategoriasModel::MdlModificarEstado($table, $fecha, $estado, $IdPaq);	
 
         return $response;
 
 
     } 

     
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


}