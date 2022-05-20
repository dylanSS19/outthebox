  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aceptación de Inventarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item"><a href="#">Inventarios</a></li>
              <li class="breadcrumb-item active">Aceptación de Inventarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 

    <!-- Main content -->
    <section class="content"> 
      <div class="container-fluid">


                <div class="row">
          <div class="col-12">

            <!-- /.card -->
            <div class="card">
                   <div class="card-header">
             </div>


              <div class="card-body">



                    <div class="col-md-12">
                    <p class="text-center">
                      <strong>CARGAS</strong>
                    </p>

              <table class="table table-bordered table-striped dt-responsive display tablas" id="tablaAceptacionCargasInventarios" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>ID</th>
            <th>Tipo</th> 
            <th>Fecha</th> 
            <th>Origen</th> 
            <th>Destino</th>
            <th>Accion</th>        
            </tr>

          </thead>

          <tbody>

                  <?php

      
              
                            
              $ventas="";
              $ventas = controladorAceptacionInventarios::ctrCargarCargos();
           /*   echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           


                    foreach ($ventas as $key => $value2) {



               echo '<tr>
              
              <td>'.($key+1).'</td>     
              <td>'.$value2["movimiento_numero"].'</td>
              <td>'.$value2["tipo"].'</td>
              <td>'.date('d-m-Y', strtotime($value2["fecha"])).'</td>
              <td>'.strtoupper($value2["tienda_entrega"]).'</td>
              <td>'.strtoupper($value2["tienda_recibe"]).'</td>
              <td><button class="btn btn-warning btndetalleaceptacioncargo" iddetalleaceptacioncargo="'.$value2["movimiento_numero"].'"  id="btndetalleaceptacioncargo"> <i class="fa fa-check-circle"></i></button>
              <button class="btn btn-info btnaceptacioncargo" idaceptacioncargo="'.$value2["movimiento_numero"].'"  id="btnaceptacioncargo"> <i class="fa fa-info-circle"></i></button></td>                                
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 


         






         </div>

           

   

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

      
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">

            <!-- /.card -->
            <div class="card">
                   <div class="card-header">
             </div>


              <div class="card-body">



                <div class="col-md-12">
                    <p class="text-center">
                      <strong>MOVIMIENTOS

              <table class="table table-bordered table-striped dt-responsive display tablas" id="tablaAceptacionMovimientosInventarios" width="100%">

          
          
          <thead>
            
            <tr>              
            <th style="width:10px">#</th>
            <th>ID</th>
            <th>Tipo</th> 
            <th>Fecha</th> 
            <th>Origen</th> 
            <th>Destino</th>
            <th>Accion</th>        
            </tr>

          </thead>

          <tbody>

                  <?php
               
                            
              $ventas="";
              $ventas = controladorAceptacionInventarios::ctrCargarMovimientos();
           /*   echo '<pre>'; print_r($ventas); echo '</pre>';
             
              exit();*/
           


                  foreach ($ventas as $key => $value2) {


 $button = "<td><button class='btn btn-info btn-xs aceptacionmovimiento' idaceptacionmovimiento='".$value2["movimiento_numero"]."' >Aceptar</button></td>";

               echo '<tr>
              
              <td>'.($key+1).'</td>     
              <td>'.$value2["movimiento_numero"].'</td>
              <td>'.$value2["tipo"].'</td>
               <td>'.date('d-m-Y', strtotime($value2["fecha"])).'</td>
              <td>'.strtoupper($value2["tienda_entrega"]).'</td>
              <td>'.strtoupper($value2["tienda_recibe"]).'</td>
              
                <td><button class="btn btn-warning btndetalleaceptacionmovimiento" iddetalleaceptacionmovimiento="'.$value2["movimiento_numero"].'"  id="btndetalleaceptacionmovimiento"> <i class="fa fa-check-circle"></i></button>
              <button class="btn btn-info btnaceptacionmovimiento" idaceptacionmovimiento="'.$value2["movimiento_numero"].'"  id="btnaceptacionmovimiento"> <i class="fa fa-info-circle"></i></button></td>          
                        
                                         
            </tr>';

             }

                    ?>   

          </tbody>



        </table>  



      

</div> 








         </div>

           

   

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <style>
  
  #overlay {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}

.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid firebrick;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>



<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
   <h1>Cargando ...</h1> 
</div>




      
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

            <!--=====================================
=            MODAL ESTADO TIENDAS          =
======================================-->



     <div class="modal fade" id="modalAceptacionCargoInventarios">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detalle de Series</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                   <table class="table table-bordered table-striped dt-responsive" width="100%" id="tableDetalleSeriesAceptacionCargosInventarios">
             <thead>
                   <tr>
                     <th style="width:10px">#</th>
                     <th>Equipo</th> 
                     <th>Serie</th>                    
                                         
                                                     
                   </tr>
                   </thead>  
                     <tbody id="tbodyid_tableDetalleSeriesAceptacionCargosInventarios">

                     </tbody>


                   </table> 
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
         </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


