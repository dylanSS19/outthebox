  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Sub Categorias de Servicios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Sub Categorias de Servicios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">


 

     

      <div class="container">



        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">

                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubCategoriaServicio">
            
            Agregar Sub Categoria de Servicio

          </button>



   <!--        <button type="button" class="btn btn-default float-right" id="daterange-btn-pospago">

            <span>
              
              <i class="fa fa-calendar"></i> Rango de Fecha

            </span>

             <i class="fa fa-caret-down"></i>
            
            
          </button> -->

             </div>
              <div class="card-body">

   <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive" id="tablasubcategoriadeservicios" width="100%">
          
          <thead>
            
            <tr>
              
            <th style="width:5px">#</th>
            <th>Acciones</th> 
            <th>Activo</th> 
            <th>Categoria</th> 
            <th>Código</th> 
            <th>Nombre</th>  
            <th>Palabra Clave</th>          
                   
            </tr>

          </thead>

          <tbody>

 <!--          <?php
        
                     

              $clientes = ClientesController::ctrCargarClientes();


              foreach ($clientes as $key => $value2) {

               echo '<tr>
              
              <td>'.($key+1).'</td>
                
              <td>            
                 
                <div class="btn-group">
                  
                  <button class="btn btn-info btnClienteDetalle" orderId2="'.$value2["codigo"].'" data-toggle="modal" data-target="#"> <i class="fa fa-info-circle"></i></button>

                                </div>

              </td>  
              <td>'.$value2["codigo"].'</td>
              <td>'.$value2["cedula"].'</td>
              <td class="text-uppercase">'.$value2["nombre"].'</td>        
              <td class="text-uppercase">'.$value2["nombre_contacto"].'</td>  
              <td>'.$value2["regimen"].'</td> 
              <td>'.$value2["telefono"].'</td>
              <td>'.$value2["mail"].'</td> 
              <td>'.$value2["provincia"].'</td> 
              <td>'.$value2["canton"].'</td> 
              <td>'.$value2["distrito"].'</td> 
              <td>'.$value2["latitud"].'</td> 
              <td>'.$value2["longitud"].'</td> 
              <td>'.$value2["activo"].'</td> 


            </tr>';

             }
           
             ?>    -->
             
          </tbody>


        </table>

        </div>

        


              </div>
            </div>

                 </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




         <div class="modal fade cleanmodal" id="modalAgregarSubCategoriaServicio">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

           
                  <form role="form" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Agregar Sub Categoria de Servicio</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

 <!-- provincia -->

 <?php 

    $categorias = SubCategoriaserviciosController::ctrcargarcartegorias();
/*    echo '<pre>'; print_r($categorias); echo '</pre>';
*/     


    ?>

        <div class="row">

                              <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspCategoria:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select cleancombo" id="agregarcategoriasubcategoriaservicio" name="agregarcategoriasubcategoriaservicio" required>
                    <option selected disabled value="" >Seleccionar Categoria...</option>
           
                     <?php foreach ($categorias as $key => $value): ?>
  <!--=====================================
  este foreach captura la ruta y puedo autocompletar el otro select dependiedo de los datos que seleccione en el primero
  ======================================-->
                  
                <option value="<?php echo $value["idtbl_categoria_servicios"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                  </select> 
                   </div>
                  </div>


 
             

               
</div>

<!--  -->

 
        <div class="row">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspCódigo:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="agregarcodigocategoriaservicio" name="agregarcodigocategoriaservicio" required readonly value="0" placeholder="Código" >  

         </div>                  </div>


 
                <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspNombre:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="agregarnombrecategoriaservicio" name="agregarnombrecategoriaservicio" required placeholder="Nombre" >  

         </div>                  </div>

                  <div class="col-xs-12 col-lg-4">
                    <label  data-toggle="popover" data-placement="top" data-content="Algun texto bonito para explicar palabra clave?">&nbsp;&nbspPalabra Clave: <span class="shake-little shake-constant shake-constant--hover" style=" color: #7a6d6a;">
 <i class="far fa-question-circle"></i> </span></label> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="agregarpalabraclavecategoriaservicio" name="agregarpalabraclavecategoriaservicio" required placeholder="Palabra Clave" >  

         </div>                 
          </div>

               
</div>





            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
          </form>

                 <?php 

      $createCliente = new SubCategoriaserviciosController();

      $createCliente -> ctrAgregarSubCategoriaServicio();

      ?>
 
              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

         <div class="modal fade cleanmodal" id="modalEditarSubCategoriaServicio">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

           
                  <form role="form" method="post" enctype="multipart/form-data">

            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title">Editar Categoria de Servicio</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">



 
        <div class="row">

                  <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspCódigo:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="editarcodigocategoriaservicio" name="editarcodigocategoriaservicio" required readonly value="0" placeholder="Código" >  

         </div>                  </div>


 
                <div class="col-xs-12 col-lg-4">

                    <label>&nbsp;&nbspNombre:</label>
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="editarnombrecategoriaservicio" name="editarnombrecategoriaservicio" required placeholder="Nombre" >  

         </div>                  </div>

                  <div class="col-xs-12 col-lg-4">
                    <label  data-toggle="popover" data-placement="top" data-content="Algun texto bonito para explicar palabra clave?">&nbsp;&nbspPalabra Clave: <span class="shake-little shake-constant shake-constant--hover" style=" color: #7a6d6a;">
 <i class="far fa-question-circle"></i> </span></label> 
 <div class="input-group mb-6" style=" width: 100%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i></span>

            </div>

            <input type="text" style="font-size:30px;height: 50px"  class="form-control" id="editarpalabraclavecategoriaservicio" name="editarpalabraclavecategoriaservicio" required placeholder="Palabra Clave" >  

         </div>                 
          </div>

               
</div>





            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
          </form>

<!--                 <?php 

      $createCliente = new CategoriaserviciosController();

      $createCliente -> ctrEditarCategoriaServicio();

      ?> -->

              
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>