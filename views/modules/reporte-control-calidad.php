  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Control De Calidad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Reportes</a></li>
              <li class="breadcrumb-item active">Reportes De Control De Calidad</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row" >
          
            <!-- /.card colapsable Control Calidad-->
            
            <div class="card collapsed-card col-12" >

                <div class="card-header" >
                    <h3 class="card-title">  CONTROL DE CALIDAD </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table class="table table-bordered table-striped dt-responsive display" id="tblControlCalidad" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mes</th>
                                <th>Total Cartera</th>
                                <th>Total Actualizado</th>
                                <th>Total Atendidos</th>
                                <th>Total No Atendidos</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $ventas="";
                                $ventas = controladorReporteControlCalidad::ctrGetReporte();

                                foreach ($ventas as $key => $value2) {

                                    echo '<tr>   
                                            <td>'.($key+1).'</td> 
                                            <td>'.$value2["mes"].'</td>
                                            <td>'.$value2["total cartera"].'</td>
                                            <td>'.$value2["total actualizado"].'</td>
                                            <td>'.$value2["total atendido"].'</td>
                                            <td>'.$value2["total no atendido"].'</td>  
                                        </tr>';

                                }

                            ?>  
                        </tbody>

                        <tfoot >
                          <tr>
                            <td style="font-weight: bold;"></td>
                            <td  style="font-weight: bold;">Total:</td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
   
                          </tr> 

                 
                        </tfoot>
           
                    </table>


                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.card colapsable Control De Pagos-->
            
            <div class="card collapsed-card col-12" >

                <div class="card-header" >
                    <h3 class="card-title">  CONTROL DE PAGOS </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table class="table table-bordered table-striped dt-responsive display" id="tblControlPagos" width="100%">
                        <thead>
                            <tr>
                                
                                <th>#</th>
                                <th>Mes</th>
                                <th>Total Cartera</th>
                                <th>0 Pagos</th>
                                <th>1 Pagos</th>
                                <th>2 Pagos</th>
                                <th>3 Pagos</th>
                                <th>4 Pagos</th>
                                <th>5 Pagos</th>
                                <th>6 Pagos</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $ventas="";
                                $ventas = controladorReporteControlCalidad::ctrGetReportePagos();
                               
                                foreach ($ventas as $key => $value2) {
                                    
                                    echo '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$value2["mes"].'</td>
                                        <td>'.$value2["total cartera"].'</td>
                                        <td>'.$value2["cantidadpago0"].'</td>
                                        <td>'.$value2["cantidadpago1"].'</td>
                                        <td>'.$value2["cantidadpago2"].'</td>
                                        <td>'.$value2["cantidadpago3"].'</td>
                                        <td>'.$value2["cantidadpago4"].'</td>
                                        <td>'.$value2["cantidadpago5"].'</td>
                                        <td>'.$value2["cantidadpago6"].'</td>
                                    </tr>';

                                }

                            ?>  
                        </tbody>

                        <tfoot >
                          <tr>
                            <td style="font-weight: bold;"></td>
                            <td  style="font-weight: bold;">Total:</td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
                            <td style="font-weight: bold;"></td>
   
                          </tr> 

                 
                        </tfoot>
           
                    </table>


                </div>
                <!-- /.card-body -->
            </div>

        </div>

      </div>
</section>
</div>
              