
 <?php

ini_set('memory_limit', '1024M');

/*require  './extensions/PHPMailer-master/src/Exception.php' ;*/
/*require  './extensions/PHPMailer-master/src/PHPMailer.php' ;
/*require  './extensions/PHPMailer-master/src/SMTP.php' ;*/

class controladorAgregarEmpleado
{

    /*=============================================
    =            LOAD EMPLEADOS           =
    =============================================*/

    public static function ctrCargarEmpleados($item, $value, $id_empresa)
    {

        $table = "empresas.tbl_empleados";

        $response = AgregarEmpleadosModel::MdlCargarEmpleados($table, $item, $value, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD PUESTOS           =
    =============================================*/

    public static function ctrCargarPuestos($item, $value, $id_empresa)
    {

        $table = "empresas.tbl_puestos";

        $response = AgregarEmpleadosModel::MdlCargarPuestos($table, $item, $value, $id_empresa);

        return $response;

    }

    /*=============================================
    =            LOAD DEPARTAMENTOS           =
    =============================================*/

    public static function ctrCargarDepartamentos($id_empresa, $supervisor)
    {

        $table = "empresas.tbl_departamento";

        $response = AgregarEmpleadosModel::MdlCargarDepartamentos($table, $id_empresa, $supervisor);

        return $response;

    }

/*=============================================
=         INSERT ACTIVACIONES         =
=============================================*/

    public static function ctrAgregarEmpleado()
    {

        if (isset($_POST["cedula-agregar-cliente"])) { //abre i

            $table = "empresas.tbl_empleados";

            $cedula = $_POST["cedula-agregar-cliente"];
            $nombre = $_POST["nombre-agregar-cliente"];
            $apellidopri = $_POST["primer-apellido-agregar-cliente"];
            $apellidoseg = $_POST["segundo-apellido-agregar-cliente"];
            $telefono = $_POST["telefono-agregar-cliente"];
            $mail = $_POST["correo-agregar-cliente"];
            $cuenta = $_POST["cuenta-agregar-cliente"];
            $id_empresa = $_SESSION['id_empresa'];
            $nombre_completo = $nombre . ' ' . $apellidopri . ' ' . $apellidoseg . '';
            $fecha_nacimiento = date('Y-m-d', strtotime($_POST["fecha-nacimiento-agregar-cliente"]));
            $direccion = $_POST["direccion-agregar-cliente"];
            $fecha_ingreso = date('Y-m-d', strtotime($_POST["fecha-ingreso-agregar-cliente"]));
            $departamento = $_POST["departamento"];
            $puesto = $_POST["puesto"];

            $data = array("cedula" => $cedula,
                "nombre" => $nombre,
                "1_apellido" => $apellidopri,
                "2_apellido" => $apellidoseg,
                "telefono" => $telefono,
                "mail" => $mail,
                "cuenta" => $cuenta,
                "id_empresa" => $id_empresa,
                "nombre_completo" => $nombre_completo,
                "fecha_nacimiento" => $fecha_nacimiento,
                "direccion" => $direccion,
                "fecha_ingreso" => $fecha_ingreso,
            );

            $response = AgregarEmpleadosModel::MdlAgregarEmpleado($table, $data);

            //echo "<script> alert(error: " . $response . ") </script>";
            if ($response == "ok") {

                $table1 = "tbl_correos_modulos";
                $correoRRHH = AgregarEmpleadosModel::MdlCargarCorreo($table1, $id_empresa);

                foreach ($correoRRHH as $key => $value){
                    $correoArreglo = $correoArreglo.''.$value['correo'].',';
                }

                //echo ("<script>console.log('PHP: correo " . $correoRRHH . "');</script>");
                //$correo = "jsegura@digitalsat-cr.com";

                /****************************************
                 * Consumo de API para enviar el correo *
                 ****************************************/

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://outthebox-cr.com/api/api-correo-nuevo-empleado.controller.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"fileContent":{
                        "correoRRHH": "'.$correoArreglo.'",
                        "cedula": "' . $cedula . '",
                        "nombre": "' . $nombre . '",
                        "primerApellido": "' . $apellidopri . '",
                        "segundoApellido": "' . $apellidoseg . '",
                        "fechaIngreso": "' . $fecha_ingreso . '",
                        "departamento": "' . $departamento . '",
                        "puesto": "' . $puesto . '"
                        }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                //MENSAJE EXITO
                echo '<script>

                Swal.fire(
                  "Ingreso exitoso!",
                  "¡El registro a sido guardado correctamente!",
                  "success"
                ).then((result) => {

                window.location = "agregar-empleados";
                })

              </script>';

            } else {

                echo '<script>

                  Swal.fire(
                    "Ingreso fallido!",
                    "¡La registro NO a sido guardado correctamente!",
                    "error"
                  ).then((result) => {

                  window.location = "agregar-empleados";
                  })

                </script>';
            }
        }
    }

}