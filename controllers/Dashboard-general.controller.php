<?php

class DashboardGeneralController{


	static public function ctrCargarVActualDth($fechaDesde, $fechaHasta){

     $table = 'digitalsat.tbl_ventas_calle_dth';

     $response = DashboardGeneralModel::MdlCargarVActualDth($table, $fechaDesde, $fechaHasta);		

     return $response;

    }

    static public function ctrCargarVActualInternet($fechaDesde, $fechaHasta){

        $table = 'digitalsat.tbl_informe_internet';
   
        $response = DashboardGeneralModel::MdlCargarVActualInternet($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }
       
    static public function ctrCargarVActualPospago($fechaDesde, $fechaHasta){

        $table = 'callcenter.tblinforme';
   
        $response = DashboardGeneralModel::MdlCargarVActualPospago($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualPospagoTiendas($fechaDesde, $fechaHasta){

        $table = 'callcenter.tblinforme';
   
        $response = DashboardGeneralModel::MdlCargarVActualPospagoTiendas($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualRecaudacionTiendas($fechaDesde, $fechaHasta){

        $table = 'callcenter.tbl_recaudacion';
   
        $response = DashboardGeneralModel::MdlCargarVActualRecaudacionTiendas($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }


       static public function ctrCargarVActualActivacionTiendas($fechaDesde, $fechaHasta){

        $table = 'callcenter.tbl_activacion';
   
        $response = DashboardGeneralModel::MdlCargarVActualActivacionTiendas($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualMetaLLaveTiendas($fechaDesde, $fechaHasta){

        $table = 'callcenter.tblinforme';
   
        $response = DashboardGeneralModel::MdlCargarVActualMetaLLaveTiendas($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualKitsMasivo($fechaDesde, $fechaHasta){

        $table = 'masivos.tbl_bill';
        $table2 = 'masivos.tbl_bill_item_details';
        $table3 = 'callcenter.tbl_equipos';       
   
        $response = DashboardGeneralModel::MdlCargarVActualKitsMasivo($table, $table2, $table3, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }


       static public function ctrCargarVActualTaeMasivo($fechaDesde, $fechaHasta){

        $table = 'masivos.tbl_bill';
        $table2 = 'masivos.tbl_bill_item_details';
        $table3 = 'callcenter.tbl_equipos';       
   
        $response = DashboardGeneralModel::MdlCargarVActualTaeMasivo($table, $table2, $table3, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }


       static public function ctrCargarVActualTaeMetaMensual($fechaDesde, $fechaHasta){

        $table = 'empresas.tbl_metas_masivos';    
   
        $response = DashboardGeneralModel::MdlCargarVActualTaeMetaMensual($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualKitsMetaMensual($fechaDesde, $fechaHasta){

        $table = 'empresas.tbl_metas_masivos';    
   
        $response = DashboardGeneralModel::MdlCargarVActualKitsMetaMensual($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualActivaciones($fechaDesde, $fechaHasta){

        $table = 'masivos.tbl_activaciones';    
   
        $response = DashboardGeneralModel::MdlCargarVActualActivaciones($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

       static public function ctrCargarVActualActivacionesMetaMensual($fechaDesde, $fechaHasta){

        $table = 'empresas.tbl_metas_masivos';    
   
        $response = DashboardGeneralModel::MdlCargarVActualActivacionesMetaMensual($table, $fechaDesde, $fechaHasta);		
   
        return $response;
   
       }

}