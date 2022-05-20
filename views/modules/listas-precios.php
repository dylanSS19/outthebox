  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista De Precios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Admistración</a></li>
              <li class="breadcrumb-item active">Lista de Precios</li>
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

              <div class="card-header" id="header">
              <button type="button" class="btn btn-primary btnNuevaLista">
                Crear Lista
              </button>
              </div>




              <div class="card-body">
                <table id="tablaListasPrecios" class="table table-bordered table-hover" width="100%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>

                  <tbody>


                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


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

</div>



<style type="text/css">


.tabla_totales {
   width: 100%;
   /*border: 1px solid #999;*/

   border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;
   border-style: solid;
   border-color: coral;
}
.tableAbajoText{
  text-align: left;  font-weight: bold; font-style: italic; padding: 0.3em; border-bottom: 1px solid #e0e0e1;
   width: 25%;
}


.tableAbajoNum{
  text-align: right;  font-weight: bold; font-style: italic; padding: 0.3em; border-bottom: 1px solid #e0e0e1;
   width: 25%;
}


.titulo{

text-align: center;

}

.cont_table{
margin-top: 25px;
}
</style>


<!--*******  MODAL CREAR *******-->

<div class="modal fade" id="modalNuevaLista" >
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Crear una Nueva Lista</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="newNombreModal" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="newNombreModal" name="newNombreModal" required>
          </div>

          <div class="form-group">
            <label for="newCodigoModal" class="col-form-label">Código:</label>
            <input type="text" class="form-control" id="newCodigoModal" name="newCodigoModal" required>
          </div>


        </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="submit" class="btn btn-primary" >Guardar Cambio</button>

        </div>

      </form>

      <?php
          $updateList = new ListasPreciosController();

          $updateList->CtrInsertarLista();
        
      ?>
    </div>
  </div>
</div>

<!--*******  FIN MODAL CREAR *******-->

<!--****** MODAL EDITAR ******  -->

<div class="modal fade" id="modalEditar">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Editar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">


          <div class="form-group">
            <label for="idModal" class="col-form-label">Identificador:</label>
            <input type="text" class="form-control" id="idModal" name="idModal" readonly>
          </div>

          <div class="form-group">
            <label for="nombreModal" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombreModal" name="nombreModal" required>
          </div>

          <div class="form-group">
            <label for="codigoModal" class="col-form-label">Código:</label>
            <input type="text" class="form-control" id="codigoModal" name="codigoModal" required>
          </div>


        </div>

        <div class="modal-footer justify-content-between">

           <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
           <button type="submit" class="btn btn-primary" >Guardar Cambio</button>

        </div>

      </form>

      <?php

        $updateList = new ListasPreciosController();

        $updateList->CtrlModificar();

      ?>
    </div>
  </div>
</div>

<!--****** CIERRE MODAL EDITAR ******  -->
