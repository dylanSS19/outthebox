 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0">Clientes </h1>
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

                             <!-- btnAddClientM -->
                             <button class="btn btn-outline-primary " data-toggle="modal"
                                 data-target="#modalClientesMasivos">

                                 Agregar Clientes

                             </button>

                        
                         </div>

                         <div class="card-body">

                             <div class="row">

                                 <div class="col-sm-12">

                                     <table class="table table-bordered table-striped dt-responsive "
                                         id="tablaClientesMasivo" width="100%">

                                         <thead>

                                             <tr>

                                                 <th style="width:5px">#</th>
                                                 <th>Nombre</th>
                                                 <th>Tipo Cédula</th>
                                                 <th>Cédula</th>
                                                 <th>Correo</th>
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