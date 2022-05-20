  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Facturas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Facturas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

        <!-- INGRESAR AQUI LOS FILTROS -->
           
        <div class="row">
          <div class="col-lg-12">
            <div class="card">      
               <div class="card-body">
                 <div class="box-body">

                    <div class="row">

    
                              <div class="col-xs-12 col-lg-4 ">
                                <label>&nbsp;&nbspCédula:</label>
                                 <div class="input-group mb-6" style=" width: 100%;">
                                   <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 30px" class="input-group-text"><i class="fa fa-id-card"></i></span>
                                  </div>
                                <input type="text" style="font-size:15px;height: 30px"  class="form-control" id="cedulaBuscar" name="cedulaBuscar" required placeholder="Cédula" >  
                             </div> 
                          </div>


                              <div class="col-xs-12 col-lg-4 ">
                                <label>&nbsp;&nbspConsecutivo:</label>
                                 <div class="input-group mb-6" style=" width: 100%;">
                                   <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 30px" class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                  </div>
                                <input type="text" style="font-size:15px;height: 30px"  class="form-control" id="consecutivoBuscar" name="consecutivoBuscar" required placeholder="Consecutivo" >  
                             </div> 
                          </div>


                           <div class="col-xs-12 col-lg-4 ">
                                <label>&nbsp;&nbspClave:</label>
                                 <div class="input-group mb-6" style=" width: 100%;">
                                   <div class="input-group-prepend">
                                    <span style="font-size:15px;height: 30px" class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                  </div>
                                <input type="text" style="font-size:15px;height: 30px"  class="form-control" id="claveBuscar" name="claveBuscar" required placeholder="Clave" >  
                             </div> 
                          </div>    
                        
                        <br>
                        <br>

                        <div class="col-xs-12 col-lg-4">
                            <label>&nbsp;&nbspEstado:</label>
                              <div class="input-group" style=" width: 100%;">
                                <div class="input-group-prepend">
                                  <span style="font-size:15px;height: 30px"  class="input-group-text "><i class="fa fa-bars"></i></span>
                                </div>
                                <select style="font-size:15px;height: 30px" class="custom-select  estadoFactura" id="estadoFactura" name="estadoFactura" required>
                                  <option selected disabled value=""  >Seleccionar...</option>                    
                                  <option value="Aceptado">Aceptado</option>
                                  <option value="Rechazado">Rechazado</option>
                                </select> 
                            </div>
                        </div>


                        <div class="col-xs-12 col-lg-4">
                          <label>&nbsp;&nbspTipo Documento:</label>
                            <div class="input-group" style=" width: 100%;">
                              <div class="input-group-prepend">
                                <span style="font-size:15px;height: 30px"  class="input-group-text "><i class="fa fa-bars"></i></span>
                                </div>
                                <select style="font-size:15px;height: 30px" class="custom-select  tipodocumento" id="tipodocumento" name="tipodocumento" required>
                                  <option selected disabled value=""  >Seleccionar...</option>                    
                                  <option value="01">Factura Electronica</option>
                                  <option value="04">Tiquete Electronico</option>
                                  <option value="03">Nota Credito</option>
                                  <option value="02">Nota Debito</option>
                                </select> 
                            </div>
                        </div>


                    </div>                 
                  </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->


        <div class="row">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">

                  <button type="button" class="btn btn-default " id="daterange-btn-SistemaFacturas">

                  <span>
                    
                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>
                  
                  
                </button>


                <button class="btn btn-outline-primary float-right buscarFacturas">
                  
                  Buscar

                </button>

             </div>

              <div class="card-body">

                  <div class="row">
                    
                    <div class="col-sm-12">
                      
<!-- table table-bordered table-striped dataTable dtr-inline -->
<!-- table table-bordered table-striped dt-responsive -->
<table id="tablaSistemaFacturas" class="table responsive display table-striped pb-25" cellspacing="0" width="100%">
                      <!-- <table class="table table-bordered table-striped dt-responsive " id="tablaSistemaFacturas" width="100%"> -->
                          
                          <thead>
                            
                            <tr>
                              
                          <th>#</th>
                          <th>Acciones</th>
                          <th>Estado</th> 
                          <th>Consecutivo</th>
                          <th>Tipo Dcumento</th> 
                          <th>Nombre</th>                            
                          <th>Fecha</th>                                                       
                          <th>Moneda</th>                       
                          <th>Total</th>                       
                                   
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



<div class="modal" id="modalDfacturas">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">    
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Detalle Documento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">


<h6><strong>Datos Receptor</strong></h6>

      <div class="row">
        <div class="col-xs-12 col-lg-6">         
            <div class="input-group mb-6" style=" width: 100%;">
            <div class="input-group-prepend">
            <span style="font-size:20px;height: 30px" class="input-group-text"><i class="" style="width: 65px;">Nombre:</i></span>
            </div>
            <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;"   minlength="9" class="form-control " id="nomReceptor" name="nomReceptor" disabled placeholder="Nombre">  
            </div>                 
        </div>
      </div> 

      <div class="row">
        <div class="col-xs-12 col-lg-6">         
            <div class="input-group mb-6" style=" width: 100%;">
            <div class="input-group-prepend">
            <span style="font-size:20px;height: 30px" class="input-group-text"><i class="" style="width: 65px;">Cédula:</i></span>
            </div>
            <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;"   minlength="9" class="form-control " id="cedReceptor" name="cedReceptor" disabled placeholder="Cédula">  
            </div>                 
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-lg-6">         
            <div class="input-group mb-6" style=" width: 100%;">
            <div class="input-group-prepend">
            <span style="font-size:20px;height: 30px" class="input-group-text"><i class="" style="width: 65px;">Correo:</i></span>
            </div>
            <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;"   minlength="9" class="form-control " id="mailReceptor" name="mailReceptor" disabled placeholder="Correo">  
            </div>                 
        </div>
      </div>


      <div class="row clvNotas" hidden>
        <div class="col-xs-12 col-lg-6">         
            <div class="input-group mb-6" style=" width: 100%;">
            <div class="input-group-prepend">
            <span style="font-size:20px;height: 30px" class="input-group-text"><i class="" style="width: 85px;">Referencia:</i></span>
            </div>
            <input type="text" style="font-size:20px;height: 30px; background: #fbfbfb;"   minlength="9" class="form-control " id="clvDocumento" name="clvDocumento" disabled placeholder="Referencia Factura">  
            </div>                 
        </div>
      </div>

      <dr>
      <dr>
      <dr>

 

          <div class="row">
                    
          <div class="col-xs-12 col-lg-12">

          <table class="table table-bordered table-striped dt-responsive" id="tblDetalleFac" width="100%">
                          
            <thead>
                            
              <tr>
                              
                <th style="width:5px">#</th>
                <th>Nombre</th> 
                <th>Codigo</th>  
                <th>Cantidad</th>     
                <th>Precio Unitario</th>
                <th>sub Total</th>
                <th>Descuento</th>      
                <th>Impuesto</th>
                <th>Total</th> 

              </tr>

            </thead>

            <tbody id="tblDetalle">
                         

            </tbody>

          </table>

          </div>

         </div> 

<style type="text/css">

.tabla_totales {
   width: 100%;
   /*border: 1px solid #999;*/
   text-align: left;
   border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;
}
caption, td, th {
   padding: 0.3em;
}
th, td {
   border-bottom: 1px solid #e0e0e1;
   width: 25%;
}
caption {
   font-weight: bold;
   font-style: italic;
}
.titulo{

text-align: center;

}

.cont_table{
margin-top: 25px;
}


 
</style>

    <div class="container cont_table">

      <div class="row justify-content-start"> 


        <div class="col-xs-12 col-lg-2">         
          <div class="input-group mb-2" style=" width: 100%;">       
            <div class='btn-group'>
              <button type="button" class="btn btn-outline-secondary btnCorreo" idFactura="">Reenvio Correo</button>     
            </div>       
          </div>                 
        </div>

        <div class="col-xs-12 col-lg-2">         
          <div class="input-group mb-2" style=" width: 100%;">        
            <div class='btn-group'> 
              <button type='button' class='btn btn-outline-secondary'>Documentos</button>
              <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'> <span class='sr-only'>Toggle Dropdown</span></button>
              <div class='dropdown-menu' role='menu'><a class='dropdown-item btnImprimir' idFactura="" comp="">Ver PDF</a><a class='dropdown-item descargar' idF="" Clv="">Descargar Documentos</a></div>
            </div>
          </div>                 
        </div>

        <div class="col-xs-12 col-lg-2">         
          <div class="input-group mb-2" style=" width: 100%;">       
            <div class='btn-group'>
              <button type="button" class="btn btn-outline-danger btnEliminar" idFactura="">Nota Crédito</button>     
            </div>       
          </div>                 
        </div>


         <div class="col-xs-12 col-lg-6">
              <div class="callout callout-danger">
                <h5><p class="estadoCorreo">Motivo Rechazo</p></h5> 
                    <div class="input-group mb-12" style=" width: 100%;">
                      <div class="input-group-prepend">
                      <!-- <span style="font-size:20px;height: 32px" class="input-group-text"><i class="" style="width: 65px;">a</i></span> -->
                      </div>
                    <input type="text" style="font-size:20px;height: 32px; background: #fbfbfb;"   minlength="9" class="form-control " id="rechazo" name="rechazo" disabled >  
                    </div> 
              </div>
            </div>




      </div>

      <div class="row justify-content-end" >
        <div class="col-xs-12 col-lg-4">         
            
        <table class="tabla_totales">          
          
          <thead >        
            
            <tr><td class="titulo" colspan="2"><strong>Totales Factura</strong></td></tr>

          </thead>

          <tbody>

            <tr><th>Monto Neto:</th><th class="Mneto"></th></tr>
            <tr><th>Descuento:</th><th class="Mdescuento"></th></tr>
            <tr><th>IVA:</th><th class="Miva"></th></tr>
            <tr><th>Monto Total:</th><th class="Mtotal"></th></tr>

          </tbody>

          </table>

        </div>
      </div>


    </div>

       </div>


        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <!--  <button type="submit" class="btn btn-primary" >Guardar</button> -->

        </div>

      </form>  
    </div>
  </div>
</div>



<div class="modal" id="modalCorreo">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">    
      <form role="form" method="post" enctype="multipart/form-data" id="frmClientes">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Correo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

         <div class="row">

            <div class="col-xs-12 col-lg-12">
              <div class="callout callout-danger">
                <h5><p class="estadoCorreo">Correo Enviado</p></h5> 
                    <div class="input-group mb-12" style=" width: 100%;">
                      <div class="input-group-prepend">
                      <span style="font-size:20px;height: 32px" class="input-group-text"><i class="" style="width: 65px;">a</i></span>
                      </div>
                    <input type="text" style="font-size:20px;height: 32px; background: #fbfbfb;"   minlength="9" class="form-control " id="mailReenvioReceptor" name="mailReenvioReceptor" disabled >  
                    </div> 
              </div>
            </div>

            <div class="col-xs-12 col-lg-12">         
              <div class="input-group mb-12" style=" width: 100%;">
                <div class="input-group-prepend">
                <span style="font-size:20px;height: 32px" class="input-group-text"><i class="" style="width: 65px;">Correo:</i></span>
                </div>
                <input type="text" style="font-size:20px;height: 32px; background: #fbfbfb;"   minlength="9" class="form-control " id="mailReenvio" name="mailReenvio"  placeholder="Correo">
                
              </div> 
              <br>                
            </div>

            <div class="col-xs-12 col-lg-12">         
              <div class="input-group mb-12" style=" width: 100%;">
                <div class="input-group-prepend">
                <!-- <span style="font-size:20px;height: 32px" class="input-group-text"><i class="" style="width: 65px;">Correo:</i></span> -->
                </div>
                <p><strong>Ingresar los correos separados por una coma.</strong></p>  
              </div> 
              <br>                
            </div>
        
        </div>

      </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="button" class="btn btn-primary btnEnviarCorreo" >Enviar</button>

        </div>

      </form>  
    </div>
  </div>
</div>



