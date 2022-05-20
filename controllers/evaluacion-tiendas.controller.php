<?php

class ControladorEvaluacionTiendas {

    static public function CtrCargarEvaluacion($fechaInicio, $fechaAntier, $fechaAyer, $fechaHoy){

        $schemaTiendas = $_COOKIE['tabla_tiendas'];
        $schemaDth = $_COOKIE['tabla_dth'];

        $tabla1 = $schemaTiendas.".tbl_tiendas";
        $tabla2 = $schemaTiendas.".tbl_horarios_tiendas";
        $tabla3 = $schemaTiendas.".tblinforme";
        $tabla4 = $schemaTiendas.".tbldth";
        $tabla5 = $schemaTiendas.".tbldth2 ";
        $tabla6 = $schemaDth.".tbl_detalle_encomiendas";



        $response = EvaluacionTiendasModel::MdlEvaluacionTiendas($fechaInicio, $fechaAntier, $fechaAyer, $fechaHoy, $tabla1, $tabla2, $tabla3, $tabla4, $tabla5, $tabla6);

        return $response;
    }
}


?>