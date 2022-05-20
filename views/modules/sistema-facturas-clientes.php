 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Clientes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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


  

                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalClientes">
                  
                  Agregar Cliente

                </button>

		<button class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#modalClientesMasivos">
                  Agregar Clientes Masivo
                </button>


<!--                   <button type="button" class="btn btn-default float-right" id="daterange-btn-SistemaFacturas" >

                  <span>
                    
                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>
                  
                  
                </button> -->

             </div>

              <div class="card-body">

                  <div class="row">
                    
                    <div class="col-sm-12">
                      


  <table class="table table-bordered table-striped dt-responsive tablaReportClientes" id="tablaReportClientes" width="100%">
                          
                          <thead>
                            
                            <tr>   

                              <th style="width:5px">#</th>
                              <th>Acciones</th> 
                              <th>Nombre</th> 
                              <th>Tipo Cédula</th>
                              <th>Cédula</th>                            
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


 


  <div class="modal" id="modalClientes" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Crear Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>
 
        <div class="modal-body">

         <div class="row">
            

          <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCédula:</label> 
            <div class="input-group mb-6" style=" width: 100%;">
              <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="frmclientlblcedulasearch" name="frmclientlblcedulasearch" autocomplete="off">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat" id="frmclientcedulasearch"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fas fa-search"></i></font></font></button>
                </span>
            </div>
          <br>
          </div>

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspNombre:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientNombre" name="frmclientNombre" required placeholder="Nombre" >  
            </div> 
         </div>


        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTipo Cédula:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; height: 35px;"  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px; height: 35px;" class="custom-select " id="frmclientTcedula" name="frmclientTcedula" required>
            <option selected disabled value="" >Seleccionar Tipo Cédula</option>          
            <option  value="01" >Fisico</option>
            <option  value="02" >Juridico</option>
            <option  value="03" >Dimex</option>
            <option  value="03" >Nite</option>
            <option  value="Pasaporte" >Pasaporte</option>
          </select> 
          </div>
        </div>


         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCédula:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientCedula" name="frmclientCedula" required placeholder="Cédula" >  
            </div> 

         </div>


         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCorreo</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientCorreo" name="frmclientCorreo" required placeholder="Correo" >  
            </div> 
         </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTelefono</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientTelefono" name="frmclientTelefono" required placeholder="Telefono" autocomplete="off">  
            </div> 
         </div>



<?php  

$provincias = ClientesController::ctrBUSCAR_PROVINCIAS();

?>


                          <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspProvincia:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientProvincia" name="frmclientProvincia" required>
                    <option selected disabled value="" >Seleccionar Provincia</option>
           
                     <?php foreach ($provincias as $key => $value): ?>
                  
                <option value="<?php echo $value["idprovincias"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                  </select> 
                   </div>
                  </div>


                          <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspCanton:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientCanton" name="frmclientCanton" required>
                    <option selected disabled value="" >Seleccionar Canton</option>
                  </select> 
                   </div>
                  </div>

            <div class="col-xs-12 col-lg-4">
              <label>&nbsp;&nbspDistrito:</label>
              <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientDistrito" name="frmclientDistrito" required>
                    <option selected disabled value="" >Seleccionar Distrito</option>
      
                 </select> 
                   </div>
                  </div>
       
        
        <?php
          $listasPrecios = ReporteClientesController::ctrCargarListasPrecios();
        ?>
      <div class="col-xs-12 col-lg-12">
        <label>&nbsp;&nbspListas De Precios:</label>
        <div class="input-group" style=" width: 100%;">
          <div class="input-group-prepend">
            <span style="font-size:15px;" id="btnNewListPrices" title="Crear Nueva Lista De Precio" class="input-group-text "><i class="far fa-plus-square"></i></span>
          </div>
          <select style="font-size:15px;height: 35px" class="custom-select listaPrecio" id="listaPrecio" name="listaPrecio" required>
            <option selected disabled value="" >Seleccionar Lista De Precio</option>
            
              <?php foreach ($listasPrecios as $key => $value): ?>
                    
              <option value="<?php echo $value["idtbl_listas_precio"];?>"><?php echo $value["nombre"];?></option>
                  

            <?php endforeach ?>

          </select> 
        </div>
      </div>

      <style>
    
    #btnNewListPrices:hover, #btnNewListPricesModificar:hover {
        background-color: #6C6C6C;
        color: #FFFFFF;
    }

    #btnNewListPrices:active, #btnNewListPricesModificar:active {
        background-color: #9D9D9D;
        color: #FFFFFF;
    }

    
</style>

      <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspDirección</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <!-- <span style="font-size:15px;" class="input-group-text"><i class=""></i>₡</span> -->
              </div>
              <textarea class="form-control" id="frmclientDireccion" name="frmclientDireccion" rows="3" required></textarea>
            </div> 
         </div>       
      
        </div>

      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="button" class="btn btn-primary btnGuardarCliente" >Guardar</button>

        </div>

      </form>  
    </div>
  </div>
</div>




<div class="modal" id="modalEditClientes" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Modificar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

         <div class="row">
            

          <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCédula:</label> 
            <div class="input-group mb-6" style=" width: 100%;">
              <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="frmclientlblcedulasearchE" name="frmclientlblcedulasearchE" autocomplete="off">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat" id="frmclientcedulasearchE"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="fas fa-search"></i></font></font></button>
                </span>
            </div>
          <br>
          </div>

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspNombre:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientNombreE" name="frmclientNombreE" required placeholder="Nombre" >  
            </div> 

         </div>


        <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTipo Cédula:</label>
          <div class="input-group" style=" width: 100%;">
            <div class="input-group-prepend">
              <span style="font-size:15px; height: 35px;"  class="input-group-text "><i class="fas fa-percentage"></i></span>
            </div>
          <select style="font-size:15px; height: 35px;" class="custom-select " id="frmclientTcedulaE" name="frmclientTcedulaE" required>
            <option selected disabled value="" >Seleccionar Tipo Cédula</option>   
            <option  value="01" >Fisico</option>
            <option  value="02" >Juridico</option>
            <option  value="03" >Dimex</option>
            <option  value="04" >Nite</option>
            <option  value="Pasaporte" >Pasaporte</option>
          </select> 
          </div>
        </div>


         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCédula:</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientCedulaE" name="frmclientCedulaE" required placeholder="Cédula" >  
            </div> 

         </div>


         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspCorreo</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientCorreoE" name="frmclientCorreoE" required placeholder="Correo" >  
            </div> 
         </div>

         <div class="col-xs-12 col-lg-6">
          <label>&nbsp;&nbspTelefono</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-edit"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientTelefonoE" name="frmclientTelefonoE" required placeholder="Telefono" autocomplete="off">  
            </div> 
         </div>



<?php  

$provincias = ClientesController::ctrBUSCAR_PROVINCIAS();

?>


                          <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspProvincia:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientProvinciaE" name="frmclientProvinciaE" required>
                    <option selected disabled value="" >Seleccionar Provincia</option>
           
                     <?php foreach ($provincias as $key => $value): ?>
                  
                <option value="<?php echo $value["idprovincias"];?>"><?php echo $value["nombre"];?></option>
                

                <?php endforeach ?>

                  </select> 
                   </div>
                  </div>


                          <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspCanton:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientCantonE" name="frmclientCantonE" required>
                    <option selected disabled value="" >Seleccionar Canton</option>
                  </select> 
                   </div>
                  </div>

                          <div class="col-xs-12 col-lg-4">
<label>&nbsp;&nbspDistrito:</label>
      <div class="input-group" style=" width: 100%;">
                    <div class="input-group-prepend">
                      <span style="font-size:15px;height: 35px"  class="input-group-text"><i class="far fa-flag"></i></span>
                    </div>
                      <select style="font-size:15px;height: 35px" class="custom-select " id="frmclientDistritoE" name="frmclientDistritoE" required>
                    <option selected disabled value="" >Seleccionar Distrito</option>
      
                 </select> 
                   </div>
                  </div>

                  <?php
          $listasPrecios = ReporteClientesController::ctrCargarListasPrecios();
        ?>
      <div class="col-xs-12 col-lg-12">
        <label>&nbsp;&nbspListas De Precios:</label>
        <div class="input-group" style=" width: 100%;">
        <div class="input-group-prepend">
            <span style="font-size:15px;" id="btnNewListPricesModificar" title="Crear Nueva Lista De Precio" class="input-group-text "><i class="far fa-plus-square"></i></span>
          </div>
          <select style="font-size:15px;height: 35px" class="custom-select listaPrecio" id="editarListaPrecio" name="editarListaPrecio" required>
            <option selected disabled value="" >Seleccionar Lista De Precio</option>
            
              <?php foreach ($listasPrecios as $key => $value): ?>
                    
              <option value="<?php echo $value["idtbl_listas_precio"];?>"><?php echo $value["nombre"];?></option>
                  

            <?php endforeach ?>

          </select> 
        </div>
      </div>
  

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspDirección</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <!-- <span style="font-size:15px;" class="input-group-text"><i class=""></i>₡</span> -->
              </div>
              <textarea class="form-control" id="frmclientDireccionE" name="frmclientDireccionE" rows="3" required></textarea>
            </div> 
         </div>       
      
        </div>

        <input type="text" class="form-control" style="font-size:20px;height: 50px; background: #fbfbfb;" id="id_clienteE" name="id_clienteE" hidden>



      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="button" class="btn btn-primary btnEditarCliente" >Guardar</button>

        </div>

      </form>  
    </div>
  </div>
</div>



<div class="modal" id="modalBuscarCliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    
      <!-- <form role="form" method="post" enctype="multipart/form-data" id="frmClientes"> -->

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Buscar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

         <div class="row">

         <div class="col-xs-12 col-lg-12">
          <label>&nbsp;&nbspCédula Cliente</label>
            <div class="input-group mb-6" style=" width: 100%;">
              <div class="input-group-prepend">
                <span style="font-size:15px;" class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input type="text" style="font-size:15px;"  class="form-control" id="frmclientcedulaSearch2" name="frmclientcedulaSearch2" required placeholder="Cédula" >  
            </div> 
            <br>
         </div> 
        
        </div>

      <div class="row justify-content-end">
        <div class="col-xs-12 col-lg-2 justify-content-end">         
          <div class="input-group mb-2" style=" width: 100%;">       
            <div class='btn-group'>
              <button type="button" class="btn btn-outline-secondary BuscarCliente">Buscar</button>     
            </div>       
          </div>                 
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-lg-12">
          <table class="table table-bordered table-striped dt-responsive " id="tablaclientessearch" width="100%"> 
             
            <thead >        
              
              <tr>
                <th><strong>Acción</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Tipo Cédula</strong></th>
                <th><strong>Cédula</strong></th>
                
              </tr>

            </thead>

            <tbody >


            </tbody>

           </table>



      </div>
    </div>


      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

        </div>

      <!-- </form>   -->
    </div>
  </div>
</div>


<!-- Modal Crear listas Precios -->

<div class="modal fade" id="modalNuevaListaCliente" >
  <div class="modal-dialog modal-xs">
    <div class="modal-content">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Crear una Nueva Lista</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="nombreLista" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombreLista" name="newNombreModal" required>
          </div>

          <div class="form-group">
            <label for="codigoLista" class="col-form-label">Código:</label>
            <input type="text" class="form-control" id="codigoLista" name="newCodigoModal" required>
          </div>


        </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           <button id="btnGuardarListaCliente" class="btn btn-primary" >Guardar</button>

        </div>


      <?php
        
      ?>
    </div>
  </div>
</div>


<div class="modal" id="modalClientesMasivos" style="overflow-y: scroll;">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form role="form" method="post" enctype="multipart/form-data">

                 <div class="modal-header">
                     <h4 style="text-align: center;" class="modal-title">Agregar Clientes Masivos</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">

                     <div class="row">

                     <style type="text/css">

                        #csvClients {
                            opacity: 0;
                        }

                        #labelCsvClientes {
                            position: absolute;
                            top: 50%;
                            left: 1rem;
                            transform: translateY(-50%);
                        }

                     </style>

                     <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input id="csvClients" name="csvClients" type="file"
                            class="form-control border-0" accept=".csv">
                        <label id="labelCsvClientes" for="csvClients" class="font-weight-light text-muted">Elegir
                            archivo</label>
                        <div class="input-group-append">
                            <label for="csvClients" class="btn btn-light m-0 rounded-pill px-4"> <i
                                    class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                    class="text-uppercase font-weight-bold text-muted">Elegir archivo</small></label>
                        </div>
                        
                    </div>
                    <label style="font-size:14px;" class="text-secondary"><em><b>Importante:</b> El archivo debe ser solamente en formato .csv</em></label>
                </div>

                         <div class="col-xs-12 col-lg-12 mt-4">
                             <!-- <label class="mt-4">&nbsp;&nbspDocumentación</label> -->
                             
                                 <button class="btn btn-outline-primary documentacion" type="button">
                                 Descargar Documentación
                             </button>

                             <button class="btn btn-outline-primary btnAddClientM float-right" type="button">

                                Procesar Clientes

                                </button>
                            
                         </div>
                                             
                     </div>

                 </div>

                 <div class="modal-footer justify-content-between">

                     <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                     <!-- <button type="button" class="btn btn-primary btnGuardarCliente">Guardar</button> -->

                 </div>

             </form>
         </div>
     </div>
 </div>

