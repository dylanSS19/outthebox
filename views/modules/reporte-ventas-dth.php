
 


<div class="content-wrapper">

<!--     TITULO Y RUTAS EN PARTE SUPERIOR        -->
<section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte Ventas DTH</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reportes</a></li>
              <li class="breadcrumb-item active">Reporte ventas DTH</li>
            </ol>
          </div>
        </div>
</section>


<!-- Main content -->
<section class="content">
    <div class="card">
    <!-- Default card -->
    <div class="card-body">
        <div class="card-header with-border">
            <button type="button" class="btn btn-default" id="daterange-btn-reporte-ventas-dth">
            <span>  
                <i class="fa fa-calendar"></i> Rango de Fecha
            </span>
            <i class="fa fa-caret-down"></i>
            </button>
        
            <div class="card-tools pull-right">
              
        </div>
        <br>


        <?php

            $usuario = $_SESSION["id"];

            $vendedores = ControladorVentasDth::ctrCargarVendedores($usuario);

            if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){

                $coordinadores = ControladorVentasDth::ctrCargarCoordinadores();

            //   }else if ($_SESSION["sub_tipo"]=="1. Coordinador"){

            // $usuario = $_SESSION["id"];

            // $coordinadores = ControladorVentasDth::ctrCargarCoordinadoresXusuario($usuario);

            }

        ?>


        <div class="form-group">
        <br> 
        <div class="input-group col-xs-12 col-md-8" >

        <?php

        if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){?>

        <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
        <select class="form-control input-lg Coordinador_DTH select2"   value="<?php echo $_GET["vendedor"] ?>"  name="Coordinador_DTH" id="Coordinador_DTH" required >
            
        <?php

        if(isset($_GET["coordinador"]) && $_GET["vendedor"] != "null"){?>
                
        <option disabled selected value="<?php echo $_GET["coordinador"] ?>"><?php echo $_GET["coordinador"] ?></option>

        <?php
        }else{?>

        <option disabled selected value="">Coordinadores</option>

        <?php
        }

        ?>
                                
                    <?php foreach ($coordinadores as $key => $value): ?>
                
                    <option value="<?php echo $value["nombre"];?>" ><?php echo $value["nombre"];?></option>
                    
                    <?php endforeach ?> 

                </select>

                </div>

            <?php }else{



            } ?>

        </div>



        <!-- 

        <div class="form-group">

        <div class="input-group col-xs-12 col-md-8" >


        <?php

        if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["sub_tipo"]=="1. Coordinador"){?>

        <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
        <select class="form-control input-lg Ventas_DTH select2"   value="<?php echo $_GET["vendedor"] ?>"  name="Ventas_DTH" id="Ventas_DTH" required >
            
        <?php

        if(isset($_GET["vendedor"]) && $_GET["vendedor"] != "null"){?>
                
        <option disabled selected value="<?php echo $_GET["vendedor"] ?>"><?php echo $_GET["nombre"] ?></option>

        <?php
        }else{?>

        <option disabled selected value="">Vendedores</option>

        <?php
        }

        ?>
                    
                    <?php foreach ($vendedores as $key => $value): ?>
                
                    <option value="<?php echo $value["user"];?>" ><?php echo $value["nombre"];?></option>
                    
                    <?php endforeach ?> 

                </select>

                </div>

            <?php }else{



            } ?>



        </div> -->

        
        </div>
        <div class="row">

            <?php

                include "reporte-ventas-dth/grafico-reporte-ventas-dth.php";

            ?>

        </div>
        

        


        </div>



            </div>
            <!-- /.card-body -->

        
        </div>
        <!-- /.card -->
    </div>

    
</section>
        <!-- /.content -->
</div>
        <!-- /.content-wrapper -->
       
