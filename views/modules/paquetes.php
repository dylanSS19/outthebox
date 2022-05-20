
<!-- Content Wrapper. Contains page content  -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Paquetes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">

         <h1 style="text-align: center;" class="m-0">Paquetes</h1>

<br>
<br> 




            <div class="card">

           
              <div class="card-body">

                  <form role="form" id="btn-pagar-paquetes" method="post" enctype="multipart/form-data">

      

    <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">

       <label style="font-size:35px" class="saldorecargalocal">DISPONIBLE: ₡10000.00</label>

 
  </div>
</div>

   <div class="input-group mb-6" style=" width: 60%;">

          <div class="input-group-prepend">

            <span style="font-size:20px;height: 50px" class="input-group-text"><i class="fas fa-mobile-alt"></i>&nbsp;&nbspNúmero Telefono</span>

            </div>

            <input style="font-size:30px;height: 50px" maxlength="8"  minlength="8" class="form-control" id="recarga-paquete-numero" name="recarga-paquete-numero" onkeypress='validate(event)' required placeholder="Número" >  

         </div>




         
         

         <br>


 <div class="input-group" style=" width: 60%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i>&nbsp;&nbspTipo Paquete</span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select " id="combo-tipo-paquete-paquetes">
                    <option value="MINUTOS INTERNACIONALES">MINUTOS INTERNACIONALES</option>
                    <option value="AMIGOS FAVORITOS">AMIGOS FAVORITOS</option>
                    <option value="MINUTOS LOCALES">MINUTOS LOCALES</option>
                    <option value="PAQUETES MENSAJES">PAQUETES MENSAJES</option>
                    <option value="PAQUETES PREPAGO M@S">PAQUETES PREPAGO M@S</option>
                    <option value="PAQUETES INTERNET">PAQUETES INTERNET</option>
                  </select> 
                   </div>

                            <br>


 <div class="input-group" style=" width: 60%;">
                    <div class="input-group-prepend">
                      <span style="font-size:20px;height: 50px"  class="input-group-text"><i class="far fa-flag"></i>&nbsp;&nbspPaquete</span>
                    </div>
                      <select style="font-size:30px;height: 50px" class="custom-select " id="combo-paquete-paquetes">
                    <option selected value="Selecciona un paquete" disabled>Selecciona un paquete</option>
                    <option value="Paquete #1">Paquete #1</option>
                   <option value="Paquete #2">Paquete #2</option>
                    <option value="Paquete #3">Paquete #3</option>
                   <option value="Paquete #4">Paquete #4 </option>
                  </select> 
                   </div>
                                     
  

         <br>

          <div class="form-group">
                       
                        <textarea style="font-size:30px;width: 60%;resize: none;" class="form-control"  id="descripcionpaquetes" rows="2" readonly placeholder="Descripción ..."></textarea>
                      </div>

                      <br>

  <div class=" text-center">
       <label style="font-size:35px;text-align: center;" class="totalpagarpaquetes">TOTAL PAGAR: ₡0.00 </label>
        </div>
          <button type="submit" class="btn btn-primary float-right" >Pagar</button>

       
          </form>
            </div>
       

      
              </div>
    
            </div>
          
      
    
          </div>


      </div>
    
  </div>