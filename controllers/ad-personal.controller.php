
 <?php

class controladorAdPersonal
{

    /*=============================================
    =            LOAD EMPLEADOS           =
    =============================================*/

    public static function ctrCargarEmpleados($id_empresa, $supervisor)
    {

        $table = "empresas.tbl_empleados";

        $response = AdPersonalModel::MdlCargarEmpleados($table, $id_empresa, $supervisor);

        return $response;

    }

    /*=============================================
    =            LOAD NOMINAS           =
    =============================================*/

    public static function ctrCargarNominas($id_empresa)
    {

        $table = "empresas.tbl_consecutivo_nomina";

        $response = AdPersonalModel::MdlCargarNominas($table, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD CONCEPTOS AD PERSONAL           =
    =============================================*/

    public static function ctrCargarConceptosADPersonal($id_empresa)
    {

        $table = "empresas.tbl_conceptos";

        $response = AdPersonalModel::MdlCargarConceptosADPersonal($table, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD CONCEPTOS VARIABLES           =
    =============================================*/

    public static function ctrCargarVariablesConceptos($item, $value, $id_empresa)
    {

        $table = "empresas.tbl_conceptos";

        $response = AdPersonalModel::MdlCargarVariablesConceptos($table, $item, $value, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD SALARIOS EMPLEADOS           =
    =============================================*/

    public static function ctrCargarSalariosEmpleados($item, $value, $id_empresa)
    {

        $table = "empresas.tbl_empleados";

        $response = AdPersonalModel::MdlCargarSalariosEmpleados($table, $item, $value, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD FECHAS NOMINAS           =
    =============================================*/

    public static function ctrCargarFechasNominas($item, $value, $id_empresa)
    {

        $table = "empresas.tbl_consecutivo_nomina";

        $response = AdPersonalModel::MdlCargarFechasNominas($table, $item, $value, $id_empresa);

        return $response;

    }

/*=============================================
=         INSERT ACTIVACIONES         =
=============================================*/

    public static function ctrAgregarNomina()
    {

        if (isset($_POST["codigo_concepto_ad_personal"])) { //abre i

            $table = "empresas.tbl_ad_personal";

            $cedula = $_POST["empleados_ad_personal"];
            $concepto = $_POST["codigo_concepto_ad_personal"];
            $nomina_aplica = "Ordinaria";
            $aplicacion_ordinaria = "Quincenal";
            $periodo_nomina = "Seleccionar ...";
            $tipo_nomina = "Planilla";
            $modo_aplicacion = "Una Nómina";
            $aplicacion_especial = "Seleccionar...";
            $horas_extras = $_POST["horas_extras_ad_personal"];
            $dias = $_POST["dias_ad_personal"];
            $monto = $_POST["resultado_final"];
            $fecha_desde = $_POST["rango_fecha_ad_personal_desde"];
            $fecha_hasta = $_POST["rango_fecha_ad_personal_hasta"];
            $comentarios = $_POST["comentarios_ad_personal"];
            $user = $_SESSION["user_name"];
            $id_empresa = $_SESSION['id_empresa'];
            $correoEmpleado = $_POST["correoEmpleado"];
            $nomEmpleado = $_POST["nomEmpleado"];
            $conceptoTxt = $_POST["concepto"];
            $nominaTxt = $_POST["nominaTxt"];
            $id_nomina = $_POST["nomina_ad_personal"];

            $data = array("cedula" => $cedula,
                "concepto" => $concepto,
                "nomina_aplica" => $nomina_aplica,
                "aplicacion_ordinaria" => $aplicacion_ordinaria,
                "periodo_nomina" => $periodo_nomina,
                "tipo_nomina" => $tipo_nomina,
                "modo_aplicacion" => $modo_aplicacion,
                "aplicacion_especial" => $aplicacion_especial,
                "horas_extras" => $horas_extras,
                "dias" => $dias,
                "monto" => $monto,
                "fecha_desde" => $fecha_desde,
                "fecha_hasta" => $fecha_hasta,
                "comentarios" => $comentarios,
                "user" => $user,
                "id_empresa" => $id_empresa,
                "id_nomina" => $id_nomina

            );

            /*  echo("<script>console.log('PHP: USER ".json_encode($data) .  "');</script>");

            exit();
             */

            $response = AdPersonalModel::MdlAgregarNomina($table, $data);
            /*$response = "ok";*/

            if ($response == "ok") {

                /****************************************
                 * Consumo de API para enviar el correo *
                 ****************************************/

                $table1 = "tbl_correos_modulos";
                $correoRRHH = SalidaEmpleadosModel::MdlCargarCorreo($table1, $id_empresa);

                $curl = curl_init();

                $correoArreglo = '';

                foreach ($correoRRHH as $key => $value){
                    $correoArreglo = $correoArreglo.''.$value['correo'].',';
                }

                $value2 = '{"fileContent":{
                        "correo": "' . $correoEmpleado . '",
                        "correoRRHH": "' . $correoArreglo . '",
                        "nombre": "' . $nomEmpleado . '",
                        "concepto": "' . $conceptoTxt . '",
                        "dias": "' . $dias . '",
                        "planilla": "' . $nominaTxt . ' ",
                        "fechaDesde": "' . $fecha_desde . '",
                        "fechaHasta": "' . $fecha_hasta . '",
                        "comentario": "' . $comentarios . '"
                        }
                    }';

              
               
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://outthebox-cr.com/api/api-correo-ad-personal.controller.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"fileContent":{
                        "correo": "' . $correoEmpleado . '",
                        "correoRRHH": "' . $correoArreglo . '",
                        "nombre": "' . $nomEmpleado . '",
                        "concepto": "' . $conceptoTxt . '",
                        "dias": "' . $dias . '",
                        "planilla": "' . $nominaTxt . ' ",
                        "fechaDesde": "' . $fecha_desde . '",
                        "fechaHasta": "' . $fecha_hasta . '",
                        "comentario": "' . $comentarios . '"
                        }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                echo '<script>

                          Swal.fire(
                            "Ingreso exitoso!",
                            "¡El registro a sido guardado correctamente!",
                            "success"
                          ).then((result) => {

                         // window.location = "ad-personal";
                          })

                      </script>';
            } else {

                echo '<script>

                      Swal.fire(
                          "Ingreso fallido!",
                          "¡La registro NO a sido guardado correctamente!",
                          "error"
                        ).then((result) => {

                        //window.location = "ad-personal";
                        })

                </script>';
            }
        }
    }

}