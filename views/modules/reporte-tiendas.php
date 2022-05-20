
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>KPIS Tiendas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">KPIS Tiendas</li>
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

                       <div class="card">
                <!-- /.card-header -->
              <div class="card-body">

                      <div class="card-header">

                  <button type="button" class="btn btn-default " id="daterange-btn-reporte-ventas-tiendas">

                  <span>
                    
                    <i class="fa fa-calendar"></i> Rango de Fecha

                  </span>

                   <i class="fa fa-caret-down"></i>
                  
                  
                </button>


            

             </div>
   
      <div class="col-xs-12">
  
<?php

include "reporte-ventas-tiendas/grafico-ventas-tiendas.php";

?>

</div>
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