<?php

/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
// $cliente->setAuthConfig('models/client_secret_Registro.json');
$cliente->setAuthConfig('models/registroProduccion.json');

$cliente->setAccessType("offline");
$cliente->setScopes(['profile', 'email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/
// htmlspecialchars($_GET["code"])
if (isset(parse_url($_SERVER['REQUEST_URI'])['query'])) {

    parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $params);

} 

if (isset($params["code"])) {

    $token = $cliente->authenticate($params["code"]);

    $_SESSION['id_token_google'] = $token;

    $cliente->setAccessToken($token);

}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if ($cliente->getAccessToken()) {

    $item = $cliente->verifyIdToken();

    $correo = $item["email"];

    $validarUser = UserController::ctrExistenciaRegistro($correo);



    if ($validarUser[0] == 1 || $validarUser[0] == "1") {

        echo '<script>

  Swal.fire({
    type: "warning",
  title: "Usuario YA se encuentra registrado!",
  text: "¡El usuario ya se encuentra registrado, por favor iniciar sesion!",
  showConfirmButton: true,
confirmButtonText: "Cerrar"

}).then(function(result){

  window.location = "registro";

});
 
  </script>';

    } else {

        $nombre = $item["name"];
        $correo = $item["email"];
        $foto = $item["picture"];
        $id = mt_rand(100000, 99999999);

        $AgregarUser = UserController::ctrAgregarUsuarioFacebook($id, $foto, $nombre, $correo);
       
        $AgregarUser = json_decode($AgregarUser);
  
        echo '<script> sessionStorage.setItem("id", "' . $AgregarUser->id . '");</script>';
        echo '<script> sessionStorage.setItem("rol", "' . $AgregarUser->rol . '");</script>';
        echo '<script> sessionStorage.setItem("tabla_tiendas", "' . $AgregarUser->tabla_tiendas . '");</script>';
        echo '<script> sessionStorage.setItem("tabla_dth", "' . $AgregarUser->tabla_dth . '");</script>';

        if ($AgregarUser->existencia == 1) {

            echo '<script>

  window.location = "home";

  </script>';

        } else {

        }

    }

}

?>


<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-danger">
        <div class="card-header text-center">
            <!--   <a href="#" class="h1"><b>Digital</b>SAT</a> -->
            <img src="views/img/template/logo.png" style=" height: 100px;">
        </div>
        <div class="card-body">
            <p class="login-box-msg">Ingresa tus datos para crear una cuenta.</p>

            <form role="form" method="post" enctype="multipart/form-data">
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="Nombre Del Perfil" name="user" id="user" required>
              </div> 

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                  <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" id="email" required>
                </div> 

                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span id="lockbtn" class="fas fa-eye reveal"></span>
                    </div>
                  </div>
                  <input type="password" class="form-control pwd" placeholder="Contraseña" name="password" id="password" required>
                </div>
 

                <div class="input-group mb-3 ">
                  
                  <input id="imgUsuario" name="imgUsuario" type="file"
                      onchange="readURL(this);" class="form-control border-0" accept="image/x-png,image/jpeg">
                  <label id="imgUsuario-label" for="imgUsuario"
                      class="font-weight-light text-muted">Elegir Imagen De Perfil</label>
                  <div class="input-group-append">
                      <label for="imgUsuario" class="btn btn-light"> <i
                        class="fa fa-cloud-upload mr-2 text-muted"></i><small
                    class="text-uppercase font-weight-bold text-muted">Buscar Imagen</small></label>
                  </div>
                </div>
              
                      <!-- /.col -->
                <div class="col-12 text-center mt-3">
                  <button type="submit" id="registrarUser" class="btn btn-primary">Registrarse</button>
                </div>
                      <!-- /.col -->
                  </div>
<?php

$user = new UserController();
$user -> ctrAgregarUsuario();

?>
             
              <div class="col-12 ">
                <p class="text-center">O</p>
                <div class="social-auth-links text-center mb-3">
                    <a href="#" class="btn btn-block btn-primary facebookRegistro">
                        <!-- <a href="#" class="btn btn-block btn-primary "> -->
                        <i class="fab fa-facebook mr-2"></i> Registrar sesión con Facebook
                    </a>
                    <a href="<?php echo $rutaGoogle; ?>" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Registrar sesión con Google+
                    </a>
                </div>
              </div>
              </form>
              <div class="text-center">
                <p>¿Ya tienes cuenta? <a href="login">¡Inicia sesión aquí!</a></p>
              </div>
           
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<style>
#imgUsuario {
    opacity: 0;
}

#imgUsuario-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}


</style>