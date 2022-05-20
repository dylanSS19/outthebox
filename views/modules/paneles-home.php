<!-- PANELES -->
<!-- d-block d-md-none -->
            <div class="d-block d-md-none" id="menuxs">

   <div class="row">

                     <div class="col-md-12">


                                     <form role="form">


    <div class="container h-100 ">

  <div class="input-group">
    <input  type="text" class="form-control" id="textobuscartiposervicio" autocomplete="off" placeholder="Buscar Servicio...">
    <div class="input-group-append">
      <div>
          <div class="btn btn-secondary " >      <i class="fa fa-search"></i>
      </div>
      </div>
    
  
    </div>
  </div>

</div>

<br>

   </form>
            <div class="card col-md-12 ">
       
              <div class="card-body ">
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion-services">


     

<!-- SERVICIOS -->



 
                  <?php

                      $tipo = HomeController::ctrCargarCategoriaServicios();   
       
                  foreach ($tipo as $key => $value) {

                   echo '<div class="card tipo" id="tipo-'.$value["palabra_clave"].'">

                    <div class="card-header" style="background-color: #F5F0EF">

                      <h4 class="card-title w-100 text-center" >

                        <a class="d-block w-100" data-toggle="collapse" href="#accordion-sub-tipo-'.$value["palabra_clave"].'" style="color:black;">

                          '.$value["nombre"].'

                        </a>

                      </h4>

                    </div>

                    <div id="accordion-sub-tipo-'.$value["palabra_clave"].'" class="collapse" data-parent="#accordion-services">';

               /*   <!-- ABRE CARD BODY -->*/

         $item="id_categoria_servicio";

$value= $value["idtbl_categoria_servicios"];

$subtipo = HomeController::ctrCargarSubTipoServicios($item, $value);

          echo '<div class="card-body">';

                  foreach ($subtipo as $key => $value2) {
                  
                   

echo '<div class="col-xs-6 servicios sub-tipo-'.$value2["palabra_clave"].'" id="'.$value2["palabra_clave"].'">

    <a class="openmodal"  sub-tipo-id="'.$value2["idtbl_sub_categoria_servicios"].'" sub-tipo-nombre="'.strval($value2["nombre"]).'"">

<div class="card text-center">

  <div class="card-body">

'.strval($value2["nombre"]).'

</div>

</div>

</a>  
        </div> ';

                 }

    
/*                        <!-- CIERRA CARD BODY -->
*/
                  echo ' </div> 

                   </div>


                  </div>';

                };



                     





                  ?>











<!-- /SERVICIOS -->





                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
              </div>
        <!-- /.row -->
          </div>


  

          </div>
          


        
  
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



     <div class="modal fade cleanmodal" id="modal-servicios">

        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title titulo-modal">Agua</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

    <div class="container h-100 ">

  <div class="input-group">
    <input  type="text" class="form-control" id="textobuscarservicio" autocomplete="off" placeholder="Buscar Servicio..." required>
    <div class="input-group-append">
      <div class="rutas">
          <button type="button" class="btn btn-secondary">      <i class="fa fa-search"></i>
      </button>
      </div>
    
  
    </div>
  </div>

</div>

<br>

<div class="cargar-servicios"> 
  


                                     
  <!--            <div class="col-xs-6 servicio" id="prueba" >

    <a id="">

<div class="card text-center">

  <div class="card-body">

PRUEBA

</div>

</div>

</a>  
        </div> -->



        </div>

  



 


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Pagar</button>
            </div>

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>