<?php

class ReporteVentasBodegaController {

     /***************************************
     *                                     *
     *         INICIO CARGAR BODEGAS       *
     *                                     *
     **************************************/

    static public function CtrCargarBodega() {
        $table = "masivos.tbl_bodegas";
        $table1 = "masivos.tbl_rutas";
        $table2 = "masivos.tbl_cedes";
        $table3 = "digitalsat.tbl_supervisores";

        $response = ReporteVentasBodegaModel::MdlCargarBodega($table, $table1, $table2, $table3);
        return $response;

    }

    /***************************************
     *                                     *
     *           FIN CARGAR BODEGAS        *
     *                                     *
     **************************************/


     /***************************************
     *                                     *
     *         INICIO VISITA DIARIA        *
     *                                     *
     **************************************/


    static public function CtrVisitaDiaria($fechaInicio, $fechaDia) {
        
        date_default_timezone_set('America/Costa_Rica');
        $dia_hoy="";
        $hoy = date('l',strtotime($fechaDia));
        $dia_español='';

        if($hoy == "Monday"){

        $dia_hoy = "L";
        $dia_español = "LUNES";

        }elseif ($hoy == "Tuesday"){

        $dia_hoy = "K";
        $dia_español = "MARTES";

        }elseif ($hoy == "Wednesday"){

        $dia_hoy = "M";
        $dia_español = "MIERCOLES"; 

        }elseif ($hoy == "Thursday"){

        $dia_hoy = "J";
        $dia_español = "JUEVES";

        }elseif ($hoy == "Friday"){

        $dia_hoy = "V";
        $dia_español = "VIERNES";

        }elseif ($hoy == "Saturday"){

        $dia_hoy = "S";
        $dia_español = "SABADO";

        }elseif ($hoy == "Sunday"){

        $dia_hoy = "D";
        $dia_español = "DOMINGO";

        }

      
        $response = ReporteVentasBodegaModel::MdlVisitadiaria($fechaInicio,$fechaDia,$dia_hoy); 

        return $response;
    }

     /***************************************
     *                                     *
     *           FIN VISITA DIARIA         *
     *                                     *
     **************************************/

    /***************************************
     *                                     *
     *            INICIO METAS             *
     *                                     *
     **************************************/

    static public function CtrMetas( $fechaInicial,$fechaFin, $fechaDia,$fechaAyer) {

        $response = ReporteVentasBodegaModel::MdlMetas($fechaInicial,$fechaFin, $fechaDia,$fechaAyer);
        return $response;
    }

    /***************************************
     *                                     *
     *              FIN METAS              *
     *                                     *
     **************************************/

    static public function CtrVisitaCliente($fechaInicio,$fechaDia) {
        date_default_timezone_set('America/Costa_Rica');
        $dia_hoy="";
        $hoy = date('l',strtotime($fechaDia));
        $dia_español = "";

        if($hoy == "Monday"){

        $dia_hoy = "L";
        $dia_español = "LUNES";

        }elseif ($hoy == "Tuesday"){

        $dia_hoy = "K";
        $dia_español = "MARTES";

        }elseif ($hoy == "Wednesday"){

        $dia_hoy = "M";
        $dia_español = "MIERCOLES"; 

        }elseif ($hoy == "Thursday"){

        $dia_hoy = "J";
        $dia_español = "JUEVES";

        }elseif ($hoy == "Friday"){

        $dia_hoy = "V";
        $dia_español = "VIERNES";

        }elseif ($hoy == "Saturday"){

        $dia_hoy = "S";
        $dia_español = "SABADO";

        }elseif ($hoy == "Sunday"){

        $dia_hoy = "D";
        $dia_español = "DOMINGO";

        }

        $response = ReporteVentasBodegaModel::MdlVisitaCliente($fechaInicio,$fechaDia,$dia_hoy);

        return $response;
    }

    static public function CtrMetaNuevosClientes($fechaInicio,$fechaFin,$fechaAyer,$fechaHoy) {

        $response = ReporteVentasBodegaModel::MdlMetaNuevoCliente($fechaInicio,$fechaFin,$fechaAyer,$fechaHoy);
        return $response;
    }


}


?>