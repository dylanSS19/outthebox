<?php

error_reporting(0);
$nameTech = "";

class UserController
{

/*=============================================
=                   LOGGIN USER                  =
=============================================*/

    public static function ctrLogginUser()
    {

        // echo'<script>
        // sessionStorage.clear();

        // var cookie = document.cookie.split(";");
        
        // for (var i = 0; i < cookie.length; i++) {
        
        //     var chip = cookie[i],
        //         entry = chip.split("="),
        //         name = entry[0];
        
        //     document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        // }
        // </script>';

        

        if(isset( $_SESSION['id']) and $_SESSION['id'] != ""){

echo '<script>
Swal.fire(
    "Error",
    "Se detecto otra pestaña abierta, cierre sesión e inicie nuevamente.",
    "error"
  ).then((result) => {
   
    window.location ="home";

  }) 

  </script>';

        }
 

        if (isset($_POST["user"])) {

//a-zA-Z0-9ñÑáéíóúÁÉÍÉÓÚ

                $table = "empresas.tbluser_2";

                // $encrypt = crypt($_POST["password"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');

                //  $encrypt = $_POST["password"];
 
                $item = "nombre";

                $value = $_POST["user"];

                //echo("<script>console.log('PHP: USER ".$value .  "');</script>");

                $response = UsersModel::MdlShowUsers($table, $item, $value);

                echo("<script>console.log('PHP: USER ".$response["nombre"].  "');</script>");

                if (is_array($response) && $response["nombre"] == $_POST["user"] && $response["pass"] == $_POST["password"]) {

                    if ($response["status"] == "Disponible") {

                        $_SESSION["login"] = "ok";

                        $_SESSION["id"] = $response["idtbluser_2"];

                        $_SESSION["rol"] = $response["privilegios"];

                        $_SESSION["user_name"] = $response["nombre"];

                        $_SESSION["nombre_perfil"] = $response["nombre_perfil"];

                        $_SESSION["foto_perfil"] = $response["img_perfil"];

                        $_SESSION["pass_perfil"] = $response["pass"];

                        $empresas = ReporteFacturasController::ctrCargarEmpresasUsuarios($response["idtbluser_2"]);

                        $value = $empresas[0][2];
                        $_SESSION["subModulos"] = $empresas[0][4];

                        // echo("<script>console.log('PHP: Sub Modulos ".json_encode($empresas)."');</script>");
                        // exit();

                        $_SESSION['empresa'] = $value;

                        $table = "empresas.tbl_clientes";

                        $response = HomeModel::MdlCargarTablaTiendas($table, $value);

                        $nombre = json_encode($response[0][0]);
                        $privempresa = json_encode($response[0][1]);
                        $id_empresa = json_encode($response[0][2]);
                        $nombredth = json_encode($response[0][3]);

                        $nombre = str_replace('"', '', $nombre);

                        $nombredth = str_replace('"', '', $nombredth);

                        $id_empresa = str_replace('"', '', $id_empresa);
                        //$privempresa=str_replace('"', '', $privempresa);

                        /*    echo("<script>console.log('PHP: USER ".$nombredth ."  ////  " .$nombredth.  "');</script>");
                        exit();*/

                        $_SESSION['tabla_tiendas'] = $nombre;
                        $_SESSION['privempresa'] = $privempresa;
                        $_SESSION['id_empresa'] = $id_empresa;
                        $_SESSION['tabla_dth'] = $nombredth;
                        $_COOKIE["modulosEmpresas"] = $_SESSION['privempresa'];

                        echo '<script> sessionStorage.setItem("tabla_tiendas", "' . $_SESSION['tabla_tiendas'] . '");</script>';
                        echo '<script> sessionStorage.setItem("tabla_dth", "' . $_SESSION['tabla_dth'] . '");</script>';

                        echo '<script>
    var nombre =sessionStorage.getItem("tabla_tiendas");
     var name="tabla_tiendas";
     document.cookie= name + "=" + nombre;
      var nombredth =sessionStorage.getItem("tabla_dth");
     var namedth="tabla_dth";
     document.cookie= namedth + "=" + nombredth;
        </script>';

                        echo '<script> sessionStorage.setItem("id", "' . $_SESSION['id'] . '");</script>';

                        echo '<script> sessionStorage.setItem("rol", "' . $_SESSION['rol'] . '");</script>';
                        if ($_SESSION["rol"] == "Vendedor") {

                            $table = "digitalsat.tblvendedores";

                            $item = "user";

                            $value = $_SESSION["id"];

                            echo ("<script>console.log('PHP: SUBTYPE " . $value . "');</script>");

                            $response = UsersModel::MdlShowSaleManRole($table, $item, $value);

                            $_SESSION["sub_tipo"] = $response["sub_tipo"];

                            echo '<script> sessionStorage.setItem("subtype", "' . $_SESSION['sub_tipo'] . '");</script>';

                        };

                        date_default_timezone_set('America/Costa_Rica');

                        echo '<script>

					window.location ="home";


					</script>';

                    } else {

                        echo '<br> <div class="alert alert-danger"> Error el usuario esta desactivo </div>';

                    }

                } else {

                    echo '<br> <div class="alert alert-danger"> Error al ingresar, vuelve a intentarlo </div>';

                }

           

        } 

    }

    public static function ctrExistencia($correo)
    {

        $table = "empresas.tbluser_2";

        $response1 = UsersModel::MdlExistencia($table, $correo);

        if ($response1[0] == "1" || $response1[0] == 1) {

            $table = "empresas.tbluser_2";

            $item = "nombre";

            $value = $correo;

            $response = UsersModel::MdlShowUsers($table, $item, $value);

            //  echo("<script>console.log('PHP: USER ".json_encode($response).  "');</script>");

            if ($response["nombre"] == $correo) {

                if ($response["status"] == "Disponible") {

                    session_start();

                    $_SESSION["login"] = "ok";

                    $_SESSION["id"] = $response["idtbluser_2"];

                    $_SESSION["rol"] = $response["privilegios"];

                    $_SESSION["user_name"] = $response["nombre"];

                    $_SESSION["foto_user"] = $response["img_perfil"];

                    $_SESSION["nombre_perfil"] = $response["nombre_perfil"];

                    $_SESSION["pass_perfil"] = $response["pass"];

                    $_COOKIE["tabla_tiendas"] = "";

                    $_COOKIE["tabla_dth"] = "";

                    $_SESSION["sub_tipo"] = "";

                    if ($response["privilegios"] == "Invitado") {

                        $response1 = array("existencia" => $response1[0],
                            "id" => $_SESSION['id'],
                            "rol" => $_SESSION['rol'],
                            "tabla_tiendas" => "",
                            "tabla_dth" => "");

                    } else {

                        $tableEmp = "empresas.tbl_empresas_usuarios";

                        $empresas = UsersModel::MdlCargarEmpresasUsuarios($tableEmp, $_SESSION['id']);

                        // return json_encode($empresas);

                        // $empresas = ReporteFacturasController::ctrCargarEmpresasUsuarios($response["idtbluser_2"]);

                        $value = $empresas[0][2];
                        $_SESSION["subModulos"] = $empresas[0][4];

                        // $_SESSION['empresa'] = $value;

                        // $value = $_SESSION['empresa'];

                        $table = "empresas.tbl_clientes";

                        $response = UsersModel::MdlCargarTablaTiendas($table, $value);

// return json_encode($response);

                        $nombre = json_encode($response[0][0]);
                        $privempresa = json_encode($response[0][1]);
                        $id_empresa = json_encode($response[0][2]);
                        $nombredth = json_encode($response[0][3]);

                        $nombre = str_replace('"', '', $nombre);

                        $nombredth = str_replace('"', '', $nombredth);

                        $id_empresa = str_replace('"', '', $id_empresa);
                        //$privempresa=str_replace('"', '', $privempresa);

                        /*    echo("<script>console.log('PHP: USER ".$nombredth ."  ////  " .$nombredth.  "');</script>");
                        exit();*/

                        $_SESSION['tabla_tiendas'] = $nombre;
                        $_SESSION['privempresa'] = $privempresa;
                        $_COOKIE["modulosEmpresas"] = $_SESSION['privempresa'];

                        $_SESSION['id_empresa'] = $id_empresa;
                        $_SESSION['tabla_dth'] = $nombredth;

                        $_COOKIE["tabla_tiendas"] = $_SESSION['tabla_tiendas'];
                        $_COOKIE["tabla_dth"] = $_SESSION['tabla_dth'];

                        $response1 = array("existencia" => $response1[0],
                            "id" => $_SESSION['id'],
                            "rol" => $_SESSION['rol'],
                            "tabla_tiendas" => $_SESSION['tabla_tiendas'],
                            "tabla_dth" => $_SESSION['tabla_dth']);

                    }

                } else {

                }

            }

        } else {

        }

        //  return $_SESSION["nombre_perfil"];
        return json_encode($response1);

    }

    public static function ctrExistenciaRegistro($correo)
    {

        $table = "empresas.tbluser_2";

        $response1 = UsersModel::MdlExistencia($table, $correo);

        return $response1;

    }

    /*============================
    =     VERIFICAR USUARIO     =
    ============================*/

    public static function ctrVerificarUsuario($email)
    {

        $table = "tbluser_2";
        $response = UsersModel::MdlValidarNuevoUsuario($table, $email);

        return $response;
    }

    /*============================
    =     REGISTRAR USUARIO     =
    ============================*/
 
    public static function ctrAgregarUsuario()
    {

        $table = "empresas.tbluser_2";

        session_start();
        if(isset($_POST["user"])) {
            $nombrePerfil = $_POST["user"];
            $correo = $_POST["email"];
            $password = $_POST["password"];
            $imgUsuario = $_FILES["imgUsuario"];

            $response = UsersModel::MdlAgregarUsuario($table, $nombrePerfil, $correo, $password);

            echo '<pre>'; print_r($response); echo '</pre>';


            $usuario = UsersModel::MdlValidarNuevoUsuario($table, $correo);
            
            
            if ($response == "ok") {
                $route = "";
        
                if (isset($imgUsuario["tmp_name"]) && !empty($imgUsuario["tmp_name"])) {
                
                    list($weight, $height) = getimagesize($imgUsuario["tmp_name"]);

                    $newWeight = 900;
                    $newHeight = 900;

                    /*===================================================
                    = ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS =
                    ====================================================*/

                    if ($imgUsuario["type"] == "image/jpeg") {

                        /*=============================================
                        =        SAVE IMAGE IN DIRECTORY JPG         =
                        =============================================*/

                        $route = "public/ProfilePic/Pic".$usuario[0].".jpg";

                        $source = imagecreatefromjpeg($imgUsuario["tmp_name"]);

                        $destination = imagecreatetruecolor($newWeight, $newHeight);

                        //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

                        imagejpeg($destination, $route);


                    }

                    if ($imgUsuario["type"] == "image/png") {

                        /*=============================================
                        =        SAVE IMAGE IN DIRECTORY PNG        =
                        =============================================*/

                        $random = mt_rand(100,999);
            
                            $route = "public/ProfilePic/Pic".$usuario[0].".png";
            
                            $source = imagecreatefrompng($imgUsuario["tmp_name"]);
            
                            $destination = imagecreatetruecolor($newWeight, $newHeight);
            
                            //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
            
                            imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);
            
                            imagepng($destination, $route);

                        

                    }

                } else {
                    $route = "views/img/users/default/anonymous.png";
                }

                //idtbluser_2, nombre, pass, privilegios, status, usuario, id_usuario, lat, lon, last_seen, intentos_fallidos, Codigo_recuperacion, nombre_perfil, img_perfil
                $table = "empresas.tbluser_2";

                $data = array("idUsuario" => $usuario[0],
                            "img_perfil" => $route);

                $response = UsersModel::MdlAgregarImagenUsuario($table, $data);
                

                if($response == "ok"){
    
                    echo '<script>
    
                        Swal.fire(
                            "Registro exitoso!",
                            "Perfil Registrado Correctamente.",
                            "success"
                        ).then((result) => {
                        
                            window.location = "login";
                        })			
    
                    </script>'	;
    
                } else {
    
                    echo '<script>
    
                        Swal.fire(
                            "Fallo al registrar",
                            "Error en el registro, por favor intente de nuevo.",
                            "error"
                        ).then((result) => {
                        
                            window.location = "";
                        })		
                    </script>'	;

                }
            } else {
                echo '<script>
    
                    Swal.fire(
                        "Fallo al registrar",
                        "Error en el registro, por favor intente de nuevo.",
                        "error"
                    ).then((result) => {
                        // window.location = "";
                    })		
                </script>'	;
            }
        }

        
        
    }
 
     /*=============================================
       =        INGRESAR USUARIOS CON FACEBOOK       =
     =============================================*/


    static public function ctrAgregarUsuarioFacebook($id, $foto, $nombre, $correo){

        $table = "tbluser_2";
    
         $response1 = UsersModel::MdlAgregarUsuarioFacebook($table, $id, $foto, $nombre, $correo);
    
         $table = "empresas.tbluser_2";
    
         // $encrypt = crypt($_POST["password"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');
    
          //  $encrypt = $_POST["password"];
    
             $item = "nombre";
    
             $value = $correo;
    
             //echo("<script>console.log('PHP: USER ".$value .  "');</script>");
    
             $response = UsersModel::MdlShowUsers($table, $item, $value);
    
             if(is_array($response) && $response["nombre"] == $correo && $response["pass"] == $id){
    
                if($response["status"] == "Disponible"){
    
                    session_start();
    
                    $_SESSION["login"] = "ok";
    
                    $_SESSION["id"] = $response["idtbluser_2"];
    
                    $_SESSION["rol"] = $response["privilegios"];
    
                    $_SESSION["user_name"] = $response["nombre"];
    
                    $_SESSION["foto_user"]= $response["img_perfil"];
    
                    $_SESSION["nombre_perfil"] = $response["nombre_perfil"];
    
                    $_SESSION["pass_perfil"] = $response["pass"];
                    
                    $_COOKIE["tabla_tiendas"] = "";
                    
                    $_COOKIE["tabla_dth"] = "";
    
                    $_SESSION["sub_tipo"] = "";
    
                    if($response["privilegios"] == "Invitado"){
    
    
                        $response1 = array("existencia" => 1,
                        "id" => $_SESSION['id'],
                        "rol" => $_SESSION['rol'],
                        "tabla_tiendas" => "",
                        "tabla_dth" => "");
                    
                    }else{
                    
                        $tableEmp = "empresas.tbl_empresas_usuarios"; 	
                    
                        $empresas = ReporteFacturasModel::MdlCargarEmpresasUsuarios($tableEmp, $response["idtbluser_2"]);
                    
                        // $empresas = ReporteFacturasController::ctrCargarEmpresasUsuarios($response["idtbluser_2"]);
                                       
                        // $value = $empresas[0][2];
                                     
                        $_SESSION['empresa'] = $value;
                                       
                        $table="empresas.tbl_clientes";
                    
                        $response = HomeModel::MdlCargarTablaTiendas($table, $value);
                    
                        $nombre=json_encode($response[0][0]);
                        $privempresa=json_encode($response[0][1]);
                        $id_empresa=json_encode($response[0][2]);
                        $nombredth=json_encode($response[0][3]);
                                                       
                        $nombre=str_replace('"', '', $nombre);
                    
                        $nombredth=str_replace('"', '', $nombredth);
                    
                        $id_empresa=str_replace('"', '', $id_empresa);
                        //$privempresa=str_replace('"', '', $privempresa);
                    
                        /*	echo("<script>console.log('PHP: USER ".$nombredth ."  ////  " .$nombredth.  "');</script>");
                            exit();*/
                    
                        $_SESSION['tabla_tiendas'] = $nombre;
                        $_SESSION['privempresa'] = $privempresa;
                        $_SESSION['id_empresa'] = $id_empresa;
                        $_SESSION['tabla_dth'] = $nombredth;
                    
                            $_COOKIE["tabla_tiendas"] = $_SESSION['tabla_tiendas'];
                            $_COOKIE["tabla_dth"] = $_SESSION['tabla_dth'];
                    
                    
                            $response1 = array("existencia" => 1,
                            "id" => $_SESSION['id'],
                            "rol" => $_SESSION['rol'],
                            "tabla_tiendas" => $_SESSION['tabla_tiendas'],
                            "tabla_dth" => $_SESSION['tabla_dth']);
                        
                    }
                                
    
                }else{
    
                    
                }
    
             }
    
    
         return json_encode($response1);
    
    
     }


/*=============================================
=                  SHOW GPS LOCATION          =
=============================================*/

    public static function ctrShowGPSLocation()
    {

        $table = "empresas.tbluser_2";

        $response = UsersModel::MdlShowGPSLocation($table);

        return $response;

//return $value . $value2 . $value3 . $table;
    }

/*=============================================
=                  UPDATE GPS LOCATION          =
=============================================*/

    public static function ctrUpdateGPSLocation($value, $value2, $value3, $currentDate)
    {

        $table = "empresas.tbluser_2";

        $response = UsersModel::MdlUpdateGPSLocation($table, $value, $value2, $value3, $currentDate);

        return $response;

//return $value . $value2 . $value3 . $table;
    }

/*=============================================
=                   SHOW SALES MAN            =
=============================================*/

    public static function ctrShowSalesMan($item, $value)
    {

        $table = "digitalsat.tblvendedores";

        $response = UsersModel::MdlShowSalesManm($table, $item, $value);

        return $response;

    }

/*=============================================
=                   SHOW SALES MAN 2        =
=============================================*/

    public static function ctrShowSalesMan2($item, $value)
    {

        $table = "digitalsat.tblvendedores";

        $response = UsersModel::MdlShowSalesManm2($table, $item, $value);

        return $response;

    }

/*=============================================
=                   SHOW TECHNICIAN NAME             =
=============================================*/

    public static function ctrShowtechnicians($item, $value)
    {

        $table = "digitalsat.tbltecnicos";

        $response = UsersModel::MdlShowTechnicians($table, $item, $value);

        return $response;

    }

    /*=============================================
    =                   LOAD TECHNICIAN NAME ADMIN            =
    =============================================*/

    public static function ctrLoadtechniciansAdmin($item, $value)
    {

        $table = "empresas.tbluser_2";

        $response = UsersModel::MdlLoadTechniciansAdmin($table, $item, $value);

        return $response;

    }

    /*=============================================
    =                   LOAD TECHNICIAN NAME             =
    =============================================*/

    public static function ctrLoadtechnicians($item, $value)
    {

        $table = "digitalsat.tbltecnicos";

        $response = UsersModel::MdlLoadTechnicians($table, $item, $value);

        return $response;

    }

    /*=============================================
    =                   LOAD TECHNICIAN NAME             =
    =============================================*/

    public static function ctrLoadtechniciansHome($item, $value)
    {

        $table = "digitalsat.tbltecnicos";

/*       //echo("<script>console.log('PHP: " . $table . $item . $value . "');</script>");
echo("<script>console.log('ITEM: " . $item . "');</script>");

echo("<script>console.log('value: " . $value . "');</script>");*/

        $response = UsersModel::MdlShowTechniciansHome($table, $item, $value);

        //echo json_encode($response);

        return $response;

    }

    /*=============================================
    =                   UPDATE USER USER            =
    =============================================*/

    public static function ctrUpdateUserUser($value, $value1, $value2)
    {

        $table = "empresas.tbluser_2";

        $response = UsersModel::MdlUpdateUserUser($table, $value, $value1, $value2);

        return $response;

    }

/*=============================================
=                   CREATE USER                  =
=============================================*/

    public static function ctrCreateUser()
    {

        if (isset($_POST["newUser"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÉÓÚ ]+$/', $_POST["newName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])) {

/*=============================================
=                   VALIDATE IMAGE                  =
=============================================*/

                $route = "";

                if (isset($_FILES["newPicture"]["tmp_name"]) && $_FILES["newPicture"]["tmp_name"] != "") {

                    list($weight, $height) = getimagesize($_FILES["newPicture"]["tmp_name"]);

                    $newWeight = 500;
                    $newHeight = 500;

/*=============================================
=        CREATE DIRECTORY  FOR IMAGE          =
=============================================*/

                    $directory = "views/img/users/" . $_POST["newUser"];

                    mkdir($directory, 0755);

/*=============================================
=        ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS     =
=============================================*/

                    if ($_FILES["newPicture"]["type"] == "image/jpeg") {

/*=============================================
=        SAVE IMAGE IN DIRECTORY JPG         =
=============================================*/

                        $random = mt_rand(100, 999);

                        $route = "views/img/users/" . $_POST["newUser"] . "/" . $random . ".jpg";

                        $source = imagecreatefromjpeg($_FILES["newPicture"]["tmp_name"]);

                        $destination = imagecreatetruecolor($newWeight, $newHeight);

                        //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

                        imagejpeg($destination, $route);

                    }

                    if ($_FILES["newPicture"]["type"] == "image/png") {

/*=============================================
=        SAVE IMAGE IN DIRECTORY PNG        =
=============================================*/

                        $random = mt_rand(100, 999);

                        $route = "views/img/users/" . $_POST["newUser"] . "/" . $random . ".png";

                        $source = imagecreatefrompng(filename)($_FILES["newPicture"]["tmp_name"]);

                        $destination = imagecreatetruecolor($newWeight, $newHeight);

                        //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

                        imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);

                        imagepng($destination, $route);

                    }

                }

                $table = "tbl_users";

                $encrypt = crypt($_POST["newPassword"], '$2a$07$asxx54apDDGsystemdev$f45sd87a5a4dhjp');

                $data = array("name" => $_POST["newName"],
                    "user_name" => $_POST["newUser"],
                    "password" => $encrypt,
                    "profile" => $_POST["newProfile"],
                    "route" => $route);

                $response = UsersModel::MdlAddUser($table, $data);

                if ($response == "ok") {

                    echo '<script>

			swal({

				type: "success",
				title: "¡El usuario a sido guardado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});

			</script>';

                } else {

                    echo '<script>

			swal({

				type: "error",
				title: "¡ERROR AL GUARDAR DATOS!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});



			</script>';

                }

            } else {

                echo '<script>

			swal({

				type: "error",
				title: "!El usuario no debe estar en blanco o llevar caracteres especiales!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				closeOnConfirm: false

			}).then((result)=>{

				if(result.value){

					window.location = "users";
				}

				});



			</script>';

            }

        }

    }

/*=============================================
=                   LOAD USERS                =
=============================================*/

    public static function ctrLoadUsers($item, $value)
    {

        $table = "tbluser_2";

        //echo("<script>console.log('PHP: " . $table . $item . $value . "');</script>");

        $response = UsersModel::MdlShowUsers($table, $item, $value);

        return $response;

    }



    static public function ctrActualizarPerfil(){
        

        if(isset($_POST["username_perfil_edit"])) {
    
    
    
            $route = $_POST["currentPicture"];
    
    
            
                If(isset($_FILES["upload-profile-pic"]["tmp_name"]) && !empty($_FILES["upload-profile-pic"]["tmp_name"])){
    
                   
    
    
    
                     list($weight,$height) = getimagesize($_FILES["upload-profile-pic"]["tmp_name"]);
    
                    $newWeight = 900;
                    $newHeight = 900;
    
    
    
    
    /*=============================================
    =        ACCORDING IMAGE FORMAT APLY DEFAULT PHP FUNCTIONS     =
    =============================================*/
            
                    if($_FILES["upload-profile-pic"]["type"] == "image/jpeg"){
    
    
                        /*=============================================
                        =        SAVE IMAGE IN DIRECTORY JPG         =
                        =============================================*/
    
                    
    
                    $route = "public/ProfilePic/Pic".$_SESSION["id"].".jpg";
    
                    //$route = "views/img/users/".$_POST["username_perfil_edit"]."/".$random.".jpg";
     
                    $source = imagecreatefromjpeg($_FILES["upload-profile-pic"]["tmp_name"]);
    
                    $destination = imagecreatetruecolor($newWeight, $newHeight);
    
                    //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
    
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);
    
                    imagejpeg($destination, $route);
    
    
                    }
    
                    if($_FILES["upload-profile-pic"]["type"] == "image/png"){
    
                        
                        /*=============================================
                        =        SAVE IMAGE IN DIRECTORY PNG        =
                        =============================================*/
    
                    $random = mt_rand(100,999);
    
                    $route = "public/ProfilePic/Pic".$_SESSION["id"].".png";
    
                    $source = imagecreatefrompng($_FILES["upload-profile-pic"]["tmp_name"]);
    
                    $destination = imagecreatetruecolor($newWeight, $newHeight);
    
                    //imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);
    
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWeight, $newHeight, $weight, $height);
    
                    imagepng($destination, $route);
    
    
    
    
    
                    }
    
    
    
    
    
    
    
                }else{
    
                                        $route = $_POST["currentPicture"];
    
                }
    
    
    
    
    
    //idtbluser_2, nombre, pass, privilegios, status, usuario, id_usuario, lat, lon, last_seen, intentos_fallidos, Codigo_recuperacion, nombre_perfil, img_perfil
                   $table = "tbluser_2";
    
                $data = array("nombre" => $_POST["username_perfil_edit"],
                              "pass" => $_POST["pass_perfil"],
                              "nombre_perfil" => $_POST["name_perfil"],
                              "img_perfil" => $route);
    
                $response = UsersModel::MdlEditUser($table , $data);
    
                if($response == "ok"){
    
                    echo '<script>
    
         Swal.fire(
          "Actualización exitosa!",
          "Perfil editado correctamente.",
          "success"
        ).then((result) => {
    
    window.location = "home";
        })			
    
                </script>'	;
    
                } else {
    
                        echo '<script>
    
         Swal.fire(
          "Actualización fallida!",
          "Perfil NO editado correctamente.",
          "error"
        ).then((result) => {
    
    window.location = "home";
        })		
    
                    
    
                </script>'	;
    
    
               }
    
        }
    
    
    
    }



	/*==============================================
	=        GUARDAR NUEVA IMAGEN DE USUARIO       =
	===============================================*/
	static public function guardarNuevaImagen ($imagenUsuario, $idUsuario) {
		
        
    }

    
	
}
