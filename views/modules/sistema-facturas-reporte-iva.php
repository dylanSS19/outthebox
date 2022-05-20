<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reporte IVA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                        <li class="breadcrumb-item active">IVA</li>
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


                            <button class="btn btn-outline-success btnExport"> Exportar Excel</button>
                            <button class="btn btn-outline-success btnRekognition">Reconocimiento Facial</button>


                            <button type="button" class="btn btn-default float-right" id="daterange-btn-ReportIva">

                                <span>

                                    <i class="fa fa-calendar"></i> Rango de Fecha

                                </span>

                                <i class="fa fa-caret-down"></i>

                            </button>

                        </div>

                        <div class="card-body">

                            <!-- <div class="row"> -->


                            <!-- Reporte IVA -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Reporte IVA</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <table class="table table-bordered table-striped dt-responsive "
                                                id="tablaReportIva" width="100%">

                                                <thead>

                                                    <tr>

                                                        <th style="width:5px">#</th>
                                                        <th>Fecha</th>
                                                        <th>Origen</th>
                                                        <th>Nombre</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Tipo Pago</th>
                                                        <th>Consecutivo</th>
                                                        <th>Monto Exento</th>
                                                        <th>Monto Base</th>
                                                        <th>Total IVA</th>
                                                        <th>Total</th>
                                                        <th>Afecta</th>

                                                    </tr>

                                                </thead>

                                                <tbody>


                                                </tbody>

                                                <tfoot>
                                                    <tr>

                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="font-weight: bold;">Total:</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                    </tr>

                                                </tfoot>


                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>


                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                            </div>
                            <!-- /.card -->


                            <!-- Reporte Gastos-->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Reporte Gastos</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <table class="table table-bordered table-striped dt-responsive "
                                                id="tablaReportCompras" width="100%">

                                                <thead>

                                                    <tr>
                                                        <th style="width:5px">#</th>
                                                        <th>Fecha</th>
                                                        <th>Proveedor</th>
                                                        <th>Cedula Proveedor</th>
                                                        <th>Tipo Documento</th>
                                                        <th>Consecutivo</th>
                                                        <th>Tipo Pago</th>
                                                        <th>Monto Exento</th>
                                                        <th>Monto Base</th>
                                                        <th>Total Iva</th>
                                                        <th>Total Factura</th>

                                                    </tr>

                                                </thead>

                                                <tbody>




                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="font-weight: bold;">Total:</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>


                                                    </tr>

                                                </tfoot>


                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>


                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                            </div>
                            <!-- /.card -->

                            <h3>Resumen de Reportes</h3>

                            <!-- Reporte Resumen IVA -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Reporte Resumen IVA</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <table class="table table-bordered table-striped dt-responsive "
                                                id="tablaReportRiva" width="100%">

                                                <thead>

                                                    <tr>
                                                        <th style="width:5px">#</th>
                                                        <th>Tipo</th>
                                                        <th>Servicios Exentos</th>
                                                        <th>Servicios Grabados</th>
                                                        <th>Servicios IVA</th>
                                                        <th>Servicios Total</th>
                                                        <th>Bienes Exentos</th>
                                                        <th>Bienes Grabados</th>
                                                        <th>Bienes IVA</th>
                                                        <th>Bienes Total</th>
                                                        <th>No Sujetas Exentos</th>
                                                        <th>No Sujetas Grabados</th>
                                                        <th>No Sujetas IVA</th>
                                                        <th>No Sujetas Total</th>

                                                    </tr>

                                                </thead>

                                                <tbody>




                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="font-weight: bold;">Total:</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                    </tr>

                                                </tfoot>


                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>


                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                            </div>
                            <!-- /.card -->



                            <!-- Reporte Resumen Gastos -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Reporte Resumen Gastos</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <table class="table table-bordered table-striped dt-responsive "
                                                id="tablaReportRgastos" width="100%">

                                                <thead>

                                                    <tr>
                                                        <th style="width:5px">#</th>
                                                        <th>Tipo</th>
                                                        <th>Servicios Exentos</th>
                                                        <th>Servicios Grabados</th>
                                                        <th>Servicios IVA</th>
                                                        <th>Servicios Total</th>
                                                        <th>Bienes Exentos</th>
                                                        <th>Bienes Grabados</th>
                                                        <th>Bienes IVA</th>
                                                        <th>Bienes Total</th>
                                                        <th>No Sujetas Exentos</th>
                                                        <th>No Sujetas Grabados</th>
                                                        <th>No Sujetas IVA</th>
                                                        <th>No Sujetas Total</th>

                                                    </tr>

                                                </thead>

                                                <tbody>




                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="font-weight: bold;">Total:</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                    </tr>

                                                </tfoot>


                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.row -->

                                </div>


                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                            </div>
                            <!-- /.card -->


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