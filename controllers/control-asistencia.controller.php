 
 <?php 

     
class controladorControlAsistencia {


  static public function comparaFoto() {

 
    if(isset($_POST["idEmpleadopicsnap"])) {

            $post_data = $_POST["fromcanvas"];

            $idEmpresa = $_POST["id_empresaControlAsistencia"];
      
          $idEmpleado = $_POST["idEmpleadopicsnap"];

          $nombreEmpleado = $_POST["nombreEmpleado"];

          $empresa = $_POST["empresa"];

          $codigo = "WEB";

    if (!empty($post_data)) {

        $route = "/var/www/outthebox/fotosControlAsistencia/" .$idEmpleado. ".jpg";

        $data = $post_data;

        $data = str_replace('data:image/jpeg;base64,', '', $data);

        $data = str_replace(' ', '+', $data);

        $data = base64_decode($data);

        $file = $route;

        $success = file_put_contents($file, $data);

     $rutaFoto = $route;


                       $rutaCedula= "/var/www/outthebox/apiHacienda/clientes/" . $idEmpresa . "/FotoTrabajadores/" . $idEmpleado . "/foto_cedula_frente.jpg";


                         $data = '{
    "fileContent":{
      "datosRutas":{            
      "ruta1":"'. $rutaFoto .'",
      "ruta2":"'. $rutaCedula .'"
      },
      "datosFuncion":{            
      "numero":1,
      "empresa": "'. $idEmpresa .'",
      "idEmpleado":"'. $idEmpleado .'"
      }     
    }
  }';

          $ch = curl_init("https://outthebox-cr.com/api/reconocimientoFacial.php");

          //a true, obtendremos una respuesta de la url, en otro caso,
        //true si es correcto, false si no lo es
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          // Se define el tipo de metodo de envio de datos
          curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
          //establecemos el verbo http que queremos utilizar para la petición
        
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
          //enviamos el array data

          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          
          curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
          //obtenemos la respuesta
          $response = curl_exec($ch);
          // Se cierra el recurso CURL y se liberan los recursos del sistema
          curl_close($ch);

          // echo("<script>console.log('PHP: resp ". $response .  "');</script>");

        $resp = json_decode($response, true);

//         unset($rutaFoto);
//         unset($route);
 
// if (unlink("/var/www/outthebox/fotosControlAsistencia/" .$idEmpleado. ".jpg")) {
//     $deat= 'The file  was deleted successfully!';

// } else {
//       $deat=  'There was a error deleting the file ';
// };


             echo("<script>console.log('PHP: resp ". $response .  "');</script>");

                        // exit();
                        date_default_timezone_set('America/Costa_Rica');

                        $hoy = date("d/m/Y h:i:s");

        if ($resp["Success"] == "true") {
           
        if($resp["Compatibilidad"] >= 95) {

          $table = "empresas.tbl_control_asistencia";
          
          ControlAsistenciaModel::MdlAgregarControlAsistencia($table, $idEmpleado, $codigo, $empresa);

          echo '<script>
         
                            Swal.fire(
                                "¡Bienvenid@ '. $nombreEmpleado .'!",
                                "Que tenga buen día.  '.$hoy.'",
                                "success"
                            ).then((result) => {
                            
                              window.location = "control-asistencia"; 
                            })      
        
                        </script>'  ;
              } else {
                echo '<script>
        
                            Swal.fire(
                                "Error",
                                "Por favor tomarse la foto nuevamente",
                                "error"
                            ).then((result) => {
                            
                              window.location = "control-asistencia"; 

                            })    
                        </script>'  ;
              }


        }else{

        echo '<script>
    
                        Swal.fire(
                            "Error",
                            "Favor probar nuevamente!",
                            "error"
                        ).then((result) => {
                        
                          window.location = "control-asistencia"; 

                        })    
                    </script>'  ;

        }

     }else{


                // echo("<script>console.log('PHP: foto ".$idEmpleado .  "');</script>");

echo '<script>
    
                        Swal.fire(
                            "Error",
                            "SIN FOTO.",
                            "error"
                        ).then((result) => {
                        
                          window.location = "control-asistencia"; 

                        })    
                    </script>'  ;



     }





        
      } 

    }




    /*=============================================
    =            LOAD ID EMPLEADOS           =
    =============================================*/

    public static function ctrCargarIDEmpleados($item, $value, $id_empresa){

        $table = "empresas.tbl_empleados";

        $table2 = "empresas.tbl_clientes";

        $response = ControlAsistenciaModel::MdlCargarIDEmpleados($table,$table2,$item, $value,$id_empresa);

        return $response;

    }
 

    public static function ctrValidarRegistros($empresa, $idempleado){

        $table = "empresas.tbl_control_asistencia";
        $table2 = "empresas.tbl_clientes";

        $response = ControlAsistenciaModel::MdlValidarRegistros($table, $empresa, $idempleado);

        return $response;

    }

 

}