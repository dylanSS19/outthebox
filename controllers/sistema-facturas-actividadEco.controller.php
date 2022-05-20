<?php

class ActividadEconomicaController{

    static public function ctrCargarActividad(){

       $table = "`upee-cr`.tbl_actividad_economica";    
      
        $response = ActividadEconomicaModel::MdlCargarActividad($table); 

        return $response;


    }

    static public function ctrCargarActividadesEconomicas($idempresa){

        $table = "empresas.tbl_actividad_economica_clientes";    
       
         $response = ActividadEconomicaModel::MdlCargarActividadesEconomicas($table, $idempresa); 
 
         return $response;
 
 
     }

     static public function ctrIngresarActividadesEconomicas($idempresa, $codigoActividad, $nombreActividad){

        $table = "empresas.tbl_actividad_economica_clientes";    
       
         $response = ActividadEconomicaModel::MdlActividadesEconomicas($table, $idempresa, $codigoActividad, $nombreActividad); 
 
         return $response;
 
 
     }

}