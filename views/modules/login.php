<?php 

/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('models/client_secret.json');
// $cliente->setAuthConfig('models/loginProduccion.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/
// htmlspecialchars($_GET["code"])
if(isset(parse_url($_SERVER['REQUEST_URI'])['query'])){

  parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $params);
  
}



if(isset($params["code"])){

	$token = $cliente->authenticate($params["code"]);

	$_SESSION['id_token_google'] = $token;
  
	$cliente->setAccessToken($token);



}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if($cliente->getAccessToken()){

	$item = $cliente->verifyIdToken();

  $correo = $item["email"];

$validarUser =  UserController::ctrExistencia($correo);

$validarUser =json_decode($validarUser);

if($validarUser->existencia == 1 || $validarUser->existencia == "1"){

// session_destroy();
// session_commit();

  echo '<script> sessionStorage.setItem("id", "' . $validarUser->id . '");</script>';
  echo '<script> sessionStorage.setItem("rol", "' . $validarUser->rol . '");</script>';
  echo '<script> sessionStorage.setItem("tabla_tiendas", "' . $validarUser->tabla_tiendas . '");</script>';
  echo '<script> sessionStorage.setItem("tabla_dth", "' . $validarUser->tabla_dth . '");</script>';
  
  echo '<script>
 
  window.location = "home";

  </script>';

}else{

// $nombre = $item["name"];
// $correo = $item["email"];
// $foto = $item["picture"];
// $id = mt_rand(100000,99999999);

// $AgregarUser =  UserController::ctrAgregarUsuario($id, $foto, $nombre, $correo);

echo '<script>

Swal.fire({
  type: "warning",
title: "Usuario NO registrado!",
text: "¡El usuario no se encuentra registrado, por favor registrarse e iniciar nuevamente.!",
showConfirmButton: true,
confirmButtonText: "Cerrar"

}).then(function(result){

  window.location = "login";
  
});

</script>';


}


}

?>



<div class="login-box" >
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
    <!--   <a href="#" class="h1"><b>Digital</b>SAT</a> -->
    <img src="views/img/template/logo.png"  style=" height: 120px; height: 120px">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Regístrese para iniciar su sesión</p>

          <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="user" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

              <div class="input-group mb-3">
          <input type="password" class="form-control pwd" placeholder="Contraseña" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span id="lockbtn"class="fas fa-eye reveal"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="loggin" class="btn btn-danger btn-block">Ingresar</button>

          </div>
          <!-- /.col -->
        </div>

        <div class="social-auth-links text-center mb-3">      
        <a href="#"  class="btn btn-block btn-primary facebook">
        <!-- <a href="#" class="btn btn-block btn-primary "> -->
          <i class="fab fa-facebook mr-2"></i> Iniciar sesión con Facebook
        </a>
        <a href="<?php echo $rutaGoogle; ?>" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Iniciar sesión con Google+
        </a>
      </div>

      <p class="mt-3 mb-1"><a href="recuperar-contrasena-frm1">Recuperar Contraseña</a></p>
   
      <?php

      $login = new UserController();
      $login -> ctrLogginUser();
      


      ?>
      </form>

  </div> 
    <!-- /.card-body -->
  </div> 
  <!-- /.card -->
</div>



  