
<?php
   
 
   class InicioFacturacionController{
      
    static public function ctrCargarTopClientes($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       
         $response = InicioFacturacionModel::MdlCargarTopClientes($table, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 
 
     static public function ctrCargarTopProductos($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
        $table2 = "empresas.tbl_sistema_facturacion_detalle_facturas"; 
       
         $response = InicioFacturacionModel::MdlCargarTopProductos($table, $table2, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 


     static public function ctrCargarCompVentas($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
        $table2 = "empresas.tbl_sistema_facturacion_detalle_facturas"; 
        $table3 = "empresas.tbl_meses"; 
       
         $response = InicioFacturacionModel::MdlCargarCompVentas($table, $table2, $table3, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 

     static public function ctrCargarPorcentXmes($fechaInicio1, $fechaFin2, $fechaInicio3, $fechaFin4, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
        
         $response = InicioFacturacionModel::MdlCargarPorcentXmes($table, $fechaInicio1, $fechaFin2, $fechaInicio3, $fechaFin4, $empresa);	
 
         return $response;
 
 
     } 

     static public function ctrCargarPorcentXSemanas($empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
        
         $response = InicioFacturacionModel::MdlCargarPorcentXSemanas($table, $empresa);	
 
         return $response;
 
 
     } 

     static public function ctrCargarFacturas($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       
         $response = InicioFacturacionModel::MdlCargarFacturas($table, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 

     static public function ctrCargartiquetes($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       
         $response = InicioFacturacionModel::MdlCargartiquetes($table, $fechaInicio, $fechaFin,  $empresa);	
 
         return $response;
 
 
     } 

         static public function ctrCargarNotasC($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       
         $response = InicioFacturacionModel::MdlCargarNotasC($table, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 

         static public function ctrCargarNotasD($fechaInicio, $fechaFin, $empresa){
   
        $table = "empresas.tbl_sistema_facturacion_facturas"; 	
       
         $response = InicioFacturacionModel::MdlCargarNotasD($table, $fechaInicio, $fechaFin, $empresa);	
 
         return $response;
 
 
     } 

}