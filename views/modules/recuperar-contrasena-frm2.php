
<div class="row justify-content-center ">

        <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="#" class="h3"><b>Cambio Contrasena</b></a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg"></p>
                        <form action="" method="post" onsubmit="return false;">

<?php  



if(isset($_GET["user"])){


                            echo'<div class="input-group mb-3">';
                                echo'<input type="text" class="form-control user_cambio" value="'. $_GET["user"] .'" placeholder="Usuario" readonly>';
                                echo'<div class="input-group-append">';
                                    echo'<div class="input-group-text">';
                                        echo'<span class="fas fa-user-circle"></span>';
                                    echo'</div>';
                               echo' </div>';
                           echo' </div>';

}else{

                            echo'<div class="input-group mb-3">';
                                echo'<input type="text" class="form-control user_cambio" value="" placeholder="Usuario">';
                                echo'<div class="input-group-append">';
                                    echo'<div class="input-group-text">';
                                        echo'<span class="fas fa-user-circle"></span>';
                                    echo'</div>';
                               echo' </div>';
                           echo' </div>';




}



?>
                        <!--=====================================
                        =     CODIGO VERIFICACION USUARIO      =
                        ======================================-->

                            
                            <div class="input-group mb-3">
                                <input type="password" class="form-control cod_validacion" id="cod_validacion" name="cod_validacion" placeholder="Código Validación" >
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock span_codigo"></span>
                                    </div>
                                </div>
                            </div>

 
                        <!--=====================================
                                    =     CONTRASEnA      =
                        ======================================-->

                          <div class="input-group mb-3">
                                <input type="password" class="form-control contrasena " placeholder="Contrasena" id="contrasena" name="contrasena" required readonly>
                                <div class="input-group-append">
                                <div class="input-group-text">
                                <span id="lockbtn1"class="fas fa-eye revelar_contrasena1"></span>
                            </div>
                         </div>
                        </div>


                        <!--=====================================
                        =   CONFIRMACION DE  CONTRASEnA       =
                        ======================================-->

                        <div class="input-group mb-3">
                            <input type="password" class="form-control valid_contrasena " placeholder="Confirmar Contrasena" id="valid_contrasena" name="valid_contrasena" required readonly>
                            <div class="input-group-append">
                            <div class="input-group-text">
                            <span id="lockbtn2"class="fas fa-eye revelar_contrasena2"></span>
                          </div>
                         </div>
                        </div>




<!--                          <div class="input-group mb-3">
          <input type="password" class="form-control pwd" placeholder="Contrasena" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span id="lockbtn"class="fas fa-eye reveal"></span>
            </div>
          </div>
        </div> -->

                            <!--=====================================
                            = MENSAJE ERROR CONFIRMACION DE CODIGO   =
                            ======================================-->


                             <div class="input-group mb-3 mensaje_error" id="#mensaje_error">
                               


                            </div>



                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-block btn_recuperar_contrasena" disabled>Guardar</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <p class="mt-3 mb-1">
                            <a href="login">Iniciar Sesión</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->


  </div>