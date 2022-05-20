<?php

 
 
class FacturacionController{


    static public function ctrCargarClientes($ID_empresa){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = FacturacionModel::MdlCargarClientes($table, $ID_empresa); 

        return $response;


    }  


    static public function ctrCargarProductos($ID_empresa,$idCliente){

        $table = "empresas.tbl_productos";    
        $table2 = "empresas.tbl_impuestos";   
        $table3 = "empresas.tbl_tarifa_impuestos"; 
        $response = FacturacionModel::MdlCargarProductos($table, $table2, $table3, $ID_empresa,$idCliente); 
 
         return $response;
 
 
     } 

     static public function ctrCargarProductosXId($id_producto, $idCliente){

        $table = "empresas.tbl_productos";    
        $table2 = "empresas.tbl_impuestos";   
        $table3 = "empresas.tbl_tarifa_impuestos";   
        $table4 = "empresas.tbl_empresas_clientes";

        $response = FacturacionModel::MdlCargarProductosXId($table, $table2, $table3,$table4,$id_producto,$idCliente); 
 
        return $response;
  
     } 

     static public function ctrCargarClienteXId($id_cliente){

        $table = "empresas.tbl_empresas_clientes";    
       
         $response = FacturacionModel::MdlCargarClienteXId($table, $id_cliente); 
 
         return $response;
  
     } 


     static public function ctrCargarSucursales($ID_empresa){

        $table = "empresas.tbl_sucursal_".$ID_empresa;    
       
         $response = FacturacionModel::MdlCargarSucursales($table); 
 
         return $response;
  
     } 

     static public function ctrCargarCajas($ID_empresa, $idSucursal){

        $table = "empresas.tbl_cajas_".$ID_empresa;    
       
         $response = FacturacionModel::MdlCargarCajas($table, $idSucursal); 
 
         return $response;
  
     } 

     static public function ctrCargarDatosEmpresa($Dtosempresa){

        $table = "empresas.tbl_clientes";    
       
         $response = FacturacionModel::MdlCargarDatosEmpresa($table, $Dtosempresa); 
 
         return $response;
  
     } 

     static public function ctrCargarUnidadMedida($unidadM){

        $table = "empresas.tbl_unidades_medida_hacienda";    
       
         $response = FacturacionModel::MdlCargarUnidadMedida($table, $unidadM); 
 
         return $response;
  
     } 

     static public function ctrCargarActividadE($ID_empresa){

        $table = "empresas.tbl_actividad_economica_clientes";    
       
         $response = FacturacionModel::MdlCargarActividadE($table, $ID_empresa); 
 
         return $response;
  
     } 
     

    /*=================================
	=      CARGAR TIPOS DE MONEDA     =
	===================================*/
    static public function ctrCargarTipoMoneda(){

        $table = "empresas.tbl_monedas";    
       
         $response = FacturacionModel::MdlCargarTipoMoneda($table); 
 
         return $response;
  
     } 

    /*=================================
	=      CARGAR DATOS IMPRIMIR FACTURA   =
	===================================*/
    static public function CtrImprimirDatosFactura($clave){

        $table1 = "empresas.tbl_sistema_facturacion_facturas";   
        $table2 = "empresas.tbl_clientes";    
       
         $response = FacturacionModel::MdlImprimirDatosFactura($table1, $table2, $clave); 
 
         return $response;
  
     }

 
     static public function CtrImprimirDatosIva($idFact){

        $table1 = "empresas.tbl_tarifa_impuestos";   
        $table2 = "empresas.tbl_sistema_facturacion_detalle_facturas";    
       
         $response = FacturacionModel::MdlImprimirDatosIva($table1, $table2, $idFact); 
 
         return $response;
  
     } 

     static public function CtrImprimirDatosDetalle($idFact){

        $table = "empresas.tbl_sistema_facturacion_detalle_facturas";   
       
       
         $response = FacturacionModel::MdlImprimirDatosDetalle($table, $idFact); 
 
         return $response;
  
     }
      
     static public function ctrIngresarCliente($addCedula, $addNombre, $addTpCedula, $addempresa, $addListPrecio, $addCorreo){

        $table = "empresas.tbl_empresas_clientes";   
       
         $response = FacturacionModel::MdlIngresarCliente($table, $addCedula, $addNombre, $addTpCedula, $addempresa, $addListPrecio, $addCorreo); 
 
         return $response;
  
     }

     static public function ctrFormasPago(){

        $table = "empresas.tbl_forma_pago";   
       
         $response = FacturacionModel::MdlFormasPago($table); 
 
         return $response;
  
     }

     
}