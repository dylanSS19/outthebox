 
 <?php 



  
     
class controladorConsultaEmpleados {


 

  /*=============================================
=            LOAD EMPLEADOS           =
=============================================*/

static public function ctrCargarEmpleados($id_empresa,$supervisor){

 
    $table="empresas.tbl_empleados"; 
      
    $response = ConsultaEmpleadosModel::MdlCargarEmpleados($table,$id_empresa,$supervisor); 

    return $response;

  }

    /*=============================================
=            LOAD EMPLEADOS           =
=============================================*/

static public function ctrCargarDatosEmpleados($item, $value){

 
    $table="empresas.tbl_empleados"; 
      

      $table2="empresas.tbl_departamento";
      $table3="empresas.tbl_puestos";
    $response = ConsultaEmpleadosModel::MdlCargarDatosEmpleados($table,$table2,$table3,$item, $value); 

    return $response;

  }

  static public function guardarImagenes() {

    session_start();

    if(isset($_FILES["imgIdefntificacionFrontal"])) {
      echo "<script>$('#overlay2').fadeIn();</script>";
      $imgFrontal = $_FILES["imgIdefntificacionFrontal"];
      $imgTrasera = $_FILES["imgIdefntificacionTrasera"];
      $imgEmpleado = $_FILES["fotoEmpleado"];
 

      $idEmpleado = $_POST["idEmpleadoImg"];
      $idEmpresa = $_POST["idEmpresaImg"];

            $directory = "apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado;

      if(!file_exists($directory)){

        mkdir($directory);

      };

      if (isset($imgFrontal["tmp_name"]) && !empty($imgFrontal["tmp_name"])) {
                
        list($weight, $height) = getimagesize($imgFrontal["tmp_name"]);

        $newWeight = 900;
        $newHeight = 900;

        /*===================================================
        = ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS =
        ====================================================*/

        if ($imgFrontal["type"] == "image/jpeg"  &&  $imgTrasera["type"] == "image/jpeg" &&  $imgEmpleado["type"] == "image/jpeg") {

            /*=============================================
            =       GUARDANDO IMAGEN DE PARTE FRONTAL     =
            =============================================*/

            $route = "apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_cedula_frente.jpg";

            $source = imagecreatefromjpeg($imgFrontal["tmp_name"]);

            $destination = imagecreatetruecolor($newWeight, $newHeight);

            //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

            imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

            imagejpeg($destination, $route);


            /*=============================================
          =    GUARDANDO IMAGEN DE PARTE TRASERA         =
          =============================================*/

          $route1 = "apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_cedula_atras.jpg";

          $source1 = imagecreatefromjpeg($imgTrasera["tmp_name"]);

          $destination1 = imagecreatetruecolor($newWeight, $newHeight);

          //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

          imagecopyresized($destination1, $source1, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

          imagejpeg($destination1, $route1);


          $route2 = "apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_empleado.jpg";

          $source2 = imagecreatefromjpeg($imgEmpleado["tmp_name"]);

          $destination2 = imagecreatetruecolor($newWeight, $newHeight);

          //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

          imagecopyresized($destination2, $source2, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

          imagejpeg($destination2, $route2);


          $ipremoteserver='backup.midigitalsat.com';
            $username = 'root';
          $password = 'Heriberto9109';
          // Make our connection
          $connection = ssh2_connect($ipremoteserver, 6060);

          // Authenticate
          if (!ssh2_auth_password($connection, $username, $password)) throw new Exception('Unable to connect.');

          // Create our SFTP resource
          if (!$sftp = ssh2_sftp($connection)) throw new Exception('Unable to create SFTP connection.');


          ssh2_sftp_mkdir($sftp, "/mnt/blockstorage/html/private/apiHacienda/clientes/".$idEmpresa."/FotoTrabajadores/".$idEmpleado,0777);

          ssh2_exec($connection, 'exit');

          $data = '{"idEmpleado": "'.$idEmpleado.'",
                    "idEmpresa": "'.$idEmpresa.'",
                    "foto_cedula_atras": "'.$imgFrontal.'",
                    "foto_cedula_atras": "'.$imgTrasera.'"
            }';
          
          $ch = curl_init("https://outthebox-cr.com/api/api_mover_fotos_empleados.php");

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
          echo "<script>$('#overlay2').fadeOut();</script>";
          if(is_file($route) && is_file($route1)) {
            echo '<script>
    
                        Swal.fire(
                            "¡Imagenes Guardadas Exitosamente!",
                            "Se han almacenado exitosamente las imagenes.",
                            "success"
                        ).then((result) => {
                        
                           window.location = "consulta-empleados"; 
                        })			
    
                    </script>'	;
          } else {
            echo '<script>
    
                        Swal.fire(
                            "Error",
                            "Fallo al almacenar las imagenes en el servidor.",
                            "error"
                        ).then((result) => {
                                                   window.location = "consulta-empleados"; 

                        })		
                    </script>'	;
          }
        }

        
      } else {
        echo '<script>
    
        Swal.fire(
            "Error",
            "Fallo al almacenar las imagenes.",
            "error"
        ).then((result) => {
        
        })		
    </script>'	;
      }

    }
  }


 
 


}