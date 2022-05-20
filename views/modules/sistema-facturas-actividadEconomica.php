 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Actividad Economica</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Actividad Economica</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">

                <button class="btn btn-outline-primary btn_actividadEconomica">
                  
                  Agregar Actividad

                </button>

             </div>

              <div class="card-body">

                  <div class="row">
                    
                    <div class="col-sm-12">
                      

  <table class="table table-bordered table-striped dt-responsive tablaActividadesClientes" id="tablaActividadesClientes" width="100%">
                          
                          <thead>
                            
                            <tr>                              
                              <th style="width:5px">#</th>
                              <th>Acciones</th> 
                              <th>Nombre</th> 
                              <th>Código</th>                                                        
                                                        
                            </tr>

                          </thead>

                          <tbody>


                 
                             
                          </tbody>



                        </table>

                    </div>


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

  
<div class="modal" id="modalAddActividad">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    
      <!-- <form role="form" method="post" enctype="multipart/form-data" id="frmClientes"> -->
        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Actividades Economicas</h4>
          <button type="button" class="close btnCerrarModal"  aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

        

      <div class="row">
        <div class="col-xs-12 col-lg-12">
          <table class="table table-bordered table-striped dt-responsive " id="tablaActividades" width="100%"> 
             
            <thead >        
              
              <tr>
                <th><strong>Acción</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Código</strong></th>
                
              </tr>

            </thead>

            <tbody class="">


            </tbody>

           </table>



      </div>
    </div>


      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default btnCerrarModal" >Salir</button>
           <button type="button" class="btn btn-primary btnEnviarCorreo" >Enviar</button>

        </div>

      <!-- </form>   -->
    </div>
  </div>
</div>