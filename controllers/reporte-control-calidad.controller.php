<?php

class controladorReporteControlCalidad {

    /*================================
    =    CARGAR LISTA DEL REPORTE    =
    =================================*/
    static public function ctrGetReporte() {
        $schemaTiendas = $_COOKIE['tabla_tiendas'];
        $schemaDth = $_COOKIE['tabla_dth'];
   
        $table1 = $schemaDth.".tbl_informe_internet";
        $table2 = $schemaDth.".tblinforme_gpon";
        $table3 = $schemaDth.".tbl_ventas_calle_dth";
        $table4 = $schemaTiendas.".tblinforme";
        $table5 = $schemaTiendas.".tbldth";
        $table6 = $schemaTiendas.".tbl_actualizacion_pagos";
        $table7 = $schemaTiendas.".tbl_historial_control_calidad";

		$response = ReporteControlCalidadModel::MdlGetReporte($table1,$table2,$table3,$table4,$table5,$table6,$table7);		

		return $response;
        
    }

    /*================================
    =    CARGAR LISTA DEL REPORTE    =
    =================================*/
    static public function ctrGetReportePagos() {
        $schemaTiendas = $_COOKIE['tabla_tiendas'];
        $schemaDth = $_COOKIE['tabla_dth'];

        $table1 = $schemaDth.".tbl_informe_internet";
        $table2 = $schemaDth.".tblinforme_gpon";
        $table3 = $schemaDth.".tbl_ventas_calle_dth";
        $table4 = $schemaTiendas.".tblinforme";
        $table5 = $schemaTiendas.".tbldth";
        $table6 = $schemaTiendas.".tbl_actualizacion_pagos";		

		$response = ReporteControlCalidadModel::MdlGetReportePagos($table1, $table2, $table3, $table4, $table5,$table6);		

		return $response;
        
    }
}

?>