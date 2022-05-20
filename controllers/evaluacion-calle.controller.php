<?php

class EvaluacionCalleController {

    /**************************************
     *    CARGAR DATOS KILOMETROS META    *
     *************************************/

   public static function ctrCargarKmMetas($fechaInicio,$fechaAyer,$fechaDia){

      $table1 = "digitalsat.tbl_vehiculos";
      $table2 = "digitalsat.tbl_apertura_rutas";
      $table3 = "empresas.tbl_metas_dth";
      
      $response = EvaluacionCalleModel::MdlCargarKmMeta($fechaInicio,$fechaAyer,$fechaDia, $table1,$table2,$table3);
      
      return $response;
   } 

     /*************************************
     *    CARGAR DATOS VENDIDOS Y METAS  *
     ************************************/
   public static function ctrCargarMetas ($fechaInicio,$fechaAyer,$fechaDia) {

      $table1 = "digitalsat.tbl_vehiculos";
      $table2 = "empresas.tbl_metas_dth";
      $table3 = "digitalsat.tbl_codigo_validacion";

      $response = EvaluacionCalleModel::MdlCargarMetas($table1,$table2,$table3,$fechaInicio,$fechaAyer,$fechaDia);
      
      return $response;
   }
   
}
?>