<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Admistración</a></li>
                    <li class="breadcrumb-item active">Facturar</li>
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

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">

                        <div class="col-xs-12 col-lg-4 float-right">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text"  class="form-control " value="<?php  echo date('d-m-Y')  ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" disabled>
							</div>
						</div>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-sm-12">

                                    <div class="col-xs-12 col-lg-12">                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmnombreC" name="frmnombreC" prov="" cant="" dist=""  autocomplete = "off" required placeholder="Nombre" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmced" name="frmced" prov="" cant="" dist=""  autocomplete = "off" required placeholder="Cédula" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12">                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmCorreo" name="frmCorreo" prov="" cant="" dist=""  autocomplete = "off" required placeholder="Correo" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12" hidden>                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmActEconomica" name="frmActEconomica" prov="" cant="" dist=""  autocomplete = "off" required placeholder="Actividad Economica" readonly>  
                                        </div> 
                                        <br>
                                    </div>
 
                                    <div class="col-xs-12 col-lg-12" hidden>                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmsucursal" name="frmsucursal" prov="" cant="" dist=""  autocomplete = "off" required placeholder="Sucursal" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12" hidden>                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmCaja" name="frmCaja" prov="" cant="" dist=""  autocomplete = "off"  required placeholder="Caja" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12" hidden>                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmtipoPago" name="frmtipoPago" prov="" cant="" dist=""  autocomplete = "off" required  placeholder="Tipo Pago" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <div class="col-xs-12 col-lg-12" hidden>                                
                                        <div class="input-group mb-6" style=" width: 100%;">
                                        <div class="input-group-prepend ">
                                            <span style="font-size:15px;" class="input-group-text"><i class="far fa-address-card"></i></span>
                                        </div>
                                        <input type="text" style="font-size:15px;"  class="form-control" id="frmtipoDoc" name="frmtipoDoc" prov="" cant="" dist=""  autocomplete = "off" required  placeholder="Tipo Documento" readonly>  
                                        </div> 
                                        <br>
                                    </div>

                                    <style>
                                    .select2-selection__rendered {
                                        line-height: 31px !important;
                                    }
                                    .select2-container .select2-selection--single {
                                        height: 35px !important;
                                    }
                                    .select2-selection__arrow {
                                        height: 34px !important;
                                    }

                                    .select2-container .select2-search__field {
                                        width: 100% !important;
                                    }


                                    </style>
                                    
                                    <div class="ListProductos">
                  
                  
         
                                     </div>
                                    
                                    <!-- <div class="col-xs-12 col-lg-12 d-flex justify-content-end">

                                        <button type="button" class="btn btn-outline-secondary  btnAgregar_producto">Agregar producto</button>
                                    
                                    </div> -->
                                   
                                    <br>
                            

                                    <div class ="row">

                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6"> 
                                        <label>&nbsp;&nbspTotal:</label>                                
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text"><i class="">₡</i></span>
                                                </div>
                                            <input type="text" style="font-size:15px;"  class="form-control" id="frmtoSiniva" name="frmtoSiniva"  required placeholder="Total" disabled hidden>
                                            <input type="text" style="font-size:15px;"  class="form-control" id="frmtoSiniva2" name="frmtoSiniva2"  required placeholder="Total" disabled>  
                                            </div> 
                                            
                                        </div>

                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6"> 
                                        <label>&nbsp;&nbspTotal IVA:</label>                                
                                            <div class="input-group mb-6" style=" width: 100%;">
                                                <div class="input-group-prepend ">
                                                    <span style="font-size:15px;" class="input-group-text"><i class="">₡</i></span>
                                                </div>
                                            <input type="text" style="font-size:15px;"  class="form-control frmtoIva" id="frmtoIva" name="frmtoIva" required placeholder="Total" disabled hidden>
                                            <input type="text" style="font-size:15px;"  class="form-control frmtoIva2" id="frmtoIva2" name="frmtoIva2" required placeholder="Total" disabled>  
                                            </div> 
                                        <br>

                                    </div>
                                    <!-- d-flex justify-content-end -->
                                    <div class="col-xs-12 col-lg-12 ">                                <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">  -->
                                        <!-- <button type="button" class="btn btn-outline-dark float-right  Facturar">Facturar</button> -->
                                        <button type="button" class="btn btn-outline-dark btnFacturaProductos">Facturar</button>
                                    </div>

                                    </div>
                            </div>

                        </div>

                    </div>





                </div>
            </div>


            </div><!-- /.row -->

        </div><!-- /.container-fluid -->

    </div><!-- /.content -->

</div><!-- /.content-wrapper -->