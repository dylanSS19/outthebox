
 <?php

class controladorSalidaEmpleado
{

    /*=============================================
    =            LOAD EMPLEADOS           =
    =============================================*/

    public static function ctrCargarEmpleados($id_empresa, $supervisor)
    {

        $table = "empresas.tbl_empleados";

        $response = SalidaEmpleadosModel::MdlCargarEmpleados($table, $id_empresa, $supervisor);

        return $response;

    }

    /*=============================================
    =            LOAD Motivos           =
    =============================================*/

    public static function ctrCargarMotivos($id_empresa)
    {

        $table = "empresas.tbl_motivos_despido";

        $response = SalidaEmpleadosModel::MdlCargarMotivos($table, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD CORREO EMPLEADO             =
    =============================================*/

    public static function ctrCargarCorreoEmpleado($item, $value, $id_empresa)
    {

        $table = "empresas.view_empleados";

        $response = SalidaEmpleadosModel::MdlCargarCorreoEmpleado($item, $value, $table, $id_empresa);

        return $response;

    }

/*=============================================
=           INSERT SALIDA EMPLEADO            =
=============================================*/

    public static function ctrSalidaEmpleado()
    {

        if (isset($_POST["comentarios_salida_empleado"])) { //abre i

            $table = "empresas.tbl_empleados";
            $idtbl_empleados = $_POST["empleados_salida_empleado"];
            $nombreEmpleado = $_POST["nombreEmpleado"];
            $motivo_salida = $_POST["motivoSalida"];
            $comentarios_salida = $_POST["comentarios_salida_empleado"];
            $fecha_salida = date('Y-m-d', strtotime($_POST["fecha-salida-salida_empleado"]));
            $id_empresa = $_SESSION["id_empresa"];

            $id_empresa = $_SESSION['id_empresa'];
            $estado = "no";

            $response = SalidaEmpleadosModel::MdlSalidaEmpleado($table, $estado, $idtbl_empleados, $motivo_salida, $fecha_salida, $comentarios_salida, $id_empresa);

            //echo("<script>console.log('PHP: correo ".$correo .  "');</script>");

            // echo("<script>console.log('PHP: USER ".$msg .  "');</script>");

            if ($response == "ok") {

                /****************************************
                 * Consumo de API para enviar el correo *
                 ****************************************/
                $table1 = "tbl_correos_modulos";
                $correoRRHH = SalidaEmpleadosModel::MdlCargarCorreo($table1, $id_empresa);

                $correoArreglo = '';
                foreach ($correoRRHH as $key => $value){
                    $correoArreglo = $correoArreglo.''.$value['correo'].',';
                }

                //$correoRRHH="jsegura@digitalsat-cr.com";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://outthebox-cr.com/api/api-correo-salida-empleado.controller.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"fileContent":{
                        "correoRRHH": "' . $correoArreglo.'",
                        "nombre": "' . $nombreEmpleado . '",
                        "motivo": "' . $motivo_salida . '",
                        "fechaSalida": "' . $fecha_salida . '",
                        "comentario": "' . $comentarios_salida . '"
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

                    //window.location = "salida-empleados";
                    })

                </script>';

                $response = "";
            } else {

                echo '<script>

                    Swal.fire(
                    "Ingreso fallido!",
                    "¡La registro NO a sido guardado correctamente!",
                    "error"
                    ).then((result) => {

                    //window.location = "salida-empleados";
                    })

                </script>';
            }
        }
    }

}
