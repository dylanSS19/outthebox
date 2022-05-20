<?php  
 
date_default_timezone_set('America/Costa_Rica');

$hoy =getdate(); 

$dia = $hoy["weekday"];

$dia_español;

if($hoy["weekday"] == "Monday"){

$dia_hoy = "L";
$dia_español = "LUNES";

}elseif ($hoy["weekday"] == "Tuesday"){

$dia_hoy = "K";
$dia_español = "MARTES";

}elseif ($hoy["weekday"] == "Wednesday"){

$dia_hoy = "M";
$dia_español = "MIERCOLES";

}elseif ($hoy["weekday"] == "Thursday"){

	$dia_hoy = "J";
	$dia_español = "JUEVES";

}elseif ($hoy["weekday"] == "Friday"){

	$dia_hoy = "V";
	$dia_español = "VIERNES";

}elseif ($hoy["weekday"] == "Saturday"){

	$dia_hoy = "S";
	$dia_español = "SABADO";

}elseif ($hoy["weekday"] == "Sunday"){

	$dia_hoy = "D";
	$dia_español = "DOMINGO";

}


 ?>

<div class="content-wrapper">
  
    <section class="content-header">

          <h1>

	        Rutas

	      </h1>

      <ol class="breadcrumb">

        <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Rutas</li>

      </ol>

    </section>


    <section class="content">

     <div class="row">

<div class="box box-warning">
	<div class="box box-warning">

		<table class="table">
<tr>

      <td style="width: 40%; text-align: center; ">
	      

	      	<?php

			echo '<h4>'.$dia_español.'</h4>'

			?>

	     
      </td>

        <td style="width: 60%;  ">
	     

<!--        				   <div class="form-group ">

				          <div class="input-group">
		                                        	                   		               	               		                  		                 							            					  							           			          		                        				           			         			                    											              	                            
		                   <span class="input-group-addon"><i class="fa fa-users" ></i></span>

						   <select class="form-control nombre_rutas select2"  id="motivo_no_compra" name="motivo_no_compra" required>	
					
						      <?php

					

						    if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){
						    	

						    	

						    	$item = null;

								$valor =  null;  

								$perfil = controladorFacturacion::ctr_CargarUsuario($item, $valor);	
							
								
								 echo '<option disabled selected value="Seleccione Ruta">Seleccione Ruta</option>';
								foreach ($perfil as $key => $value) {

									echo '<option  value="'.$value["nombre"].'" codigo="'.$value["codigo"].'" >'.$value["nombre"].'</option>';


				 				}

		                       
							 }else {



  if($_SESSION["rol"]=="Supervisor-Masivo"){

                      $item = "id_usuario";

                     $value = $_SESSION["id"];

                   }else{


                            $item = "usuario";

                     $value = $_SESSION["id"];

                   }

						$perfil = controladorFacturacion::ctr_CargarUsuario($item, $valor);		
						echo '<pre>'; print_r($perfil); echo '</pre>';

								foreach ($perfil as $key => $value) {

		          
		                         echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].'</option>';

		                       }

		                    $value = $perfil[0][1];
		               
		                   
		               
							$rutas_del_dia = controladorRutas::ctr_rutas($value, $dia_hoy);	
					
					
																			

							$value1 = $perfil[0][0] ;

							$value2 = date('Y-m-d');


							$facturados = controladorRutas::ctr_clientes_facturados($value1, $value2);
					


							$fecha = date('Y-m-d');
						
							$ruta = $perfil[0][0] ;
						

							$no_compra = controladorRutas::ctr_clientes_no_compra($fecha, $ruta);

						

							$pendientes_vicita = controladorRutas::ctr_pendientes_vicitas($value, $dia_hoy);
							

							 }						                              
		                 
	                   
		                    ?>

                   		 </select>

                     </div>

				     </div> -->


				                             <!--ADD ROUTE -->

                       <?php 

                    if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){


                        echo '   <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-users" ></i></span>

<select class="form-control nombre_rutas select2"  id="motivo_no_compra" name="motivo_no_compra" required>	              
              <option selected="true" value disabled="">Seleccionar Ruta</option>';


                 $item = null;

                $value =null ;
                
            
                $perfil = controladorRutas::ctrLoadRoutesMasivo($item, $value);   

          
                  foreach ($perfil as $key => $value) {

           echo '<option  value="'.$value["nombre"].'" codigo="'.$value["codigo"].'" >'.$value["nombre"].'</option>';


                
                      }

                      $value = $perfil[0][1];
		               
		                   
		               
							$rutas_del_dia = controladorRutas::ctr_rutas($value, $dia_hoy);	
					
					
																			

							$value1 = $perfil[0][0] ;

							$value2 = date('Y-m-d');


							$facturados = controladorRutas::ctr_clientes_facturados($value1, $value2);
					


							$fecha = date('Y-m-d');
						
							$ruta = $perfil[0][0] ;
							
						

							$no_compra = controladorRutas::ctr_clientes_no_compra($fecha, $ruta);
		

						

							$pendientes_vicita = controladorRutas::ctr_pendientes_vicitas($value, $dia_hoy);

 

          }else{

            
              if($_SESSION["rol"]=="Supervisor-Masivo"){

                      $item = "id_usuario";

                     $value = $_SESSION["id"];

                   }else{


                            $item = "usuario";

                     $value = $_SESSION["id"];

                   }

                     $perfil = controladorRutas::ctrLoadRoutesMasivo($item, $value);   
           


              echo '   <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-th"></i></span>

<select class="form-control nombre_rutas select2"  id="motivo_no_compra" name="motivo_no_compra" value="'.$perfil[0][0].'" required>	

             <option selected="true" value disabled="">Seleccionar Ruta</option>';

     
                foreach ($perfil as $key => $value) {

                         echo '<option  value="'.$value["nombre"].'" codigo="'.$value["codigo"].'" >'.$value["nombre"].'</option>';
       
                      }


          }

          $value = $perfil[0][1];
		               
		                   
		               
							$rutas_del_dia = controladorRutas::ctr_rutas($value, $dia_hoy);	
					
					
																			

							$value1 = $perfil[0][0] ;
 
							$value2 = date('Y-m-d');


							$facturados = controladorRutas::ctr_clientes_facturados($value1, $value2);
					


							$fecha = date('Y-m-d');
						
							$ruta = $perfil[0][0] ;
						

							$no_compra = controladorRutas::ctr_clientes_no_compra($fecha, $ruta);

						

							$pendientes_vicita = controladorRutas::ctr_pendientes_vicitas($value, $dia_hoy);


               ?>      

              

            


            </select>

          </div>

         </div>



	     
      </td>
</tr>
</table>
			
			<table class="table">
				
				<thead>

					<tr>
					                         
					    <th  style="width: 30%; text-align: center;">Clientes Facturados: </th>  
					    <th style="width: 30%; text-align: center;"> Clientes no compra: </th>  
					     <th style="width: 30%; text-align: center;">Pendientes:</th>                          
					  </tr>
			


			     </thead>

			      <tbody>

			        <tr>

			        	<td style="width: 33%; text-align: center; justify-content: center;">

			        		

			        		<?php

			        		if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"|| $_SESSION["rol"]=="Supervisor-Masivo"){

			        			echo '<div style=" display: flex; align-items: center; justify-content: center;">
			        	<input type="text" class="form-control facturados" style="width: 33%; text-align: center; display: none;" id="facturados" value="" placeholder="0" readonly>
			        
			        	</div>';

			        		}else{

			        			echo '<h3>'.$facturados[0].'</h3>';


			        		}
			        		

			        		?>
	                   
			        	</td>
			        	
			        	<td style="width: 33%; text-align: center; justify-content: center;">
							
							
						<?php
							
							 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"|| $_SESSION["rol"]=="Supervisor-Masivo"){

							 	 echo '<div style=" display: flex; align-items: center; justify-content: center;">
							  	<input type="text" class="form-control no_compra" style="width: 33%; text-align: center; display: none;" id="no_compra" value="" placeholder="0" readonly>
			        		</div>';

							}else{

								echo '<h3>'.$no_compra[0].'</h3>';

							}

			        		

			        		?>

						</td>

						<td style="width: 33%; text-align: center; ">
							
							

						<?php

						 if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"|| $_SESSION["rol"]=="Supervisor-Masivo"){

						echo '<div style=" display: flex; align-items: center; justify-content: center;">
						<input type="text" class="form-control pendientes_vicita" style="width: 33%; text-align: center; display: none;" id="pendientes_vicita" value="" placeholder="0" readonly>
 							
 							</div>';

						 }else{

						 	echo '<h3>'.$pendientes_vicita[0].'</h3>';
						 }
			        		

			        		?>

						</td>

					</tr>


                 </tbody>
											

			</table>		

      </div>
				              	             
    </div>

  </div>

    
    <?php

	    if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" || $_SESSION["rol"]=="Supervisor-Masivo"){
echo '<div class="col-xs-12 col-lg-12 rutas" >';

    echo '</div>';

	    }else {

foreach ($rutas_del_dia as $key => $value){

echo '<div class="col-xs-12 col-lg-12 " >';

echo '<div class="box box-default collapsed-box">';

            echo '<div class="box-header with-border">';

            	echo '<h3 class="box-title nombres" >'.$value["nombre_comercial"].'</h3>';

              echo '<div class="box-tools pull-right">';
               echo ' <button type="button" class="btn btn-box-tool btn_colapse boton_ruta"  atts="0" caja="'.$value["idtbl_clientes"].'" longitud ="'.$value["longitud"].'" latitud="'.$value["latitud"].'" data-widget="collapse"><i class="fa fa-plus"></i>';
                echo '</button>';
              echo '</div>';

				 echo '<div class="box box-success">';
				    echo '<div class="box box-primary">';
				          
				            echo '<form role="form" method="POST">';
				              echo '<div class="box-body">';

				                echo '<div class="form-group">';
				                  echo '<label for="exampleInputEmail1">Nombre</label>';
				                  echo '<input type="text" class="form-control" id="nombre_cliente" cedula ="'.$value["cedula"].'" value="'.$value["nombre_cliente"].'" placeholder="Nombre" readonly>';
				                 echo '</div>';

				                  echo '<div class="form-group">';
				                   echo '<label for="exampleInputEmail1">Comercio</label>';
				                   echo '<input type="text" class="form-control nombre_comercio" value="'.$value["nombre_comercial"].'" placeholder="Nombre Comercio" readonly>';
				                 echo '</div>';

				                    echo '<div class="form-group">';
				                   echo '<label for="exampleInputEmail1">Dirección</label>';
				                   echo '<input type="text" class="form-control" id="direccion" value="'.$value["direccion"].'" placeholder="Dirección"readonly>';
				                 echo '</div>';
				              	             
				               echo '</div>';
				            
					          echo ' </form>';

					           echo '<div class="box-footer">';
							
				            
				       
				               
				               $id_cliente =	$value["idtbl_clientes"];
							
				         				              	echo 
							
				              	'<a href="index.php?route=facturacion&id='.$value["idtbl_clientes"].'&valor='.$value["nombre_comercial"].'">

									<span class=" btn btn-primary factura_ruta">Facturar</span>

								</a>';

								$longitud = $value["longitud"];
							
								$latitud = $value["latitud"];
							
									echo 
							
				              	'<a href="https://www.google.com/maps/search/?api=1&query='.$latitud.','.$longitud.'">

									<span class=" btn btn-primary">Ubicación</span>

								</a>'; 


								$perfil_vend = $perfil[0][0];



								   	echo '<a href="index.php?route=historico-facturas&perfil='.$value["idtbl_clientes"].'&nombre='.$value["nombre_comercial"].'">

									<span class=" btn btn-primary">Detalles</span>

								</a>'; 
				   
					                   echo '</div>';           				              		
					             			              		       		                               
			               echo '</div>';

					                 echo '<div class="box-footer">';
			              			              			   
				              			 echo '<button class="btn btn-danger pull-right btn_nocompra2" value="'.$value["nombre_comercial"].'" data-toggle="modal" cedula="'.$value["idtbl_clientes"].'" cedula2="'.$value["cedula"].'" data-target="#modalNocompra">No Compra</button>';
				   
					                   echo '</div>';	
 			   echo '</div>';


			// $value = $value["cedula"];
			// $ultimaCompra = controladorRutas::ctrDatosUltimaCompra($value);
			



echo '<h6>Ultima Compra: '.date('d/m/Y', strtotime($value["fecha"])).'</h6>';

echo '<h6>Monto:₡ '.number_format($value["total"], 2, '.', ',').'</h6>';


			   echo '</div>';
						  
			   echo '</div>';

			   echo '</div>';
						  
			

 }


	    }
						   

    ?>


   
    </section>

    </div>

</div>


 <div id="modalNocompra" class="modal fade" role="dialog">

		 <div class="modal-dialog">
		   
		   <div class="modal-content">

		     <form class="frm_no_compra" role="form" method="post">

		      <div class="modal-header" style="background:#3c8bdc; color: white">

				    <button type="button" class="close" data-dismiss="modal">&times;</button>

				    <h4 class="modal-title">Agregar Motivo No Compra</h4>

			     </div>

				 <div class="modal-body">

       				<div class="box-body">

       					<div class="form-group">

				          <div class="input-group">

					            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
<?php

date_default_timezone_set('America/Costa_Rica');
              echo "  <input type='text' class='form-control input-lg fecha_ingreso'  name='fecha_ingreso' data-inputmask='alias': 'yyyy-mm-dd' id='fecha_ingreso' value='".date('Y-m-d H:i:s')."'  required readonly> ";

?>
					             
			             </div>

         				   </div>


<?php 

if ($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo" ){




}else if ($_SESSION["rol"]=="Supervisor-Masivo"){

$item = "id_usuario";

$value = $_SESSION["id"];

$perfil = controladorRutas::ctrLoadRoutesMasivo($item, $value);  

$ruta = $perfil[0][0];


}else{

$item = "usuario";

$value = $_SESSION["id"];

$perfil = controladorRutas::ctrLoadRoutesMasivo($item, $value);  

$ruta = $perfil[0][0];
//echo '<pre>'; print_r($ruta); echo '</pre>';


}




?>



				    <div class="form-group">

				          <div class="input-group">

				            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        
	                      <input type="text" class="form-control input-lg nombre"  name="nombre" placeholder="Nombre" id="nombre" required readonly>

	                      <?php


echo '<input type="hidden" class="form-control input-lg"  value="' . $ruta . '" name="ruta_no_compra"  required>' ?>





				             </div>

       				  </div>

       				   <div class="form-group">

				          <div class="input-group">

				            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        
	       

					         <input type="text" class="form-control input-lg cedula"  name="cedula" placeholder="Cedula" id="cedula" required readonly>
					         

				             </div>

       				  </div>

       				   <div class="form-group ">

				          <div class="input-group">
		                                        	                   		               	               		                  		                 							            					  							           			          		                        				           			         			                    											              	                            
		                   <span class="input-group-addon"><i class="fa fa-users" ></i></span>

						   <select class="form-control motivo_no_compra" id="motivo_no_compra" name="motivo_no_compra" required>	
						    <option disabled selected value="">Seleccione Motivo</option>          
	                
                         <?php
		                     $motivos = controladorRutas::ctr_motivos();
		                       foreach ($motivos as $key => $value) {

		                         echo '<option  value="'.$value["nombre_motivo"].'">'.$value["nombre_motivo"].'</option>';

		                       }
	                   
		                    ?>

                   		 </select>

                     </div>

				     </div>

				    


				    <div class="form-group">

				          <div class="input-group">

				            <span class="input-group-addon" ><i class="fa fa-bars"></i></span>
                        
	                       <textarea  style="resize: none ; width: 100%" class="txt_area" name="txt_area" id="txt_area" placeholder="Descripción de no compra"></textarea>

	       				  </div>

					</div>


   						 <div class="form-group">

				          <div class="input-group">

				            
                        
					         <input type="hidden" class="form-control input-lg latitud_no_compra"  name="latitud_no_compra" placeholder="latitud_no_compra" id="latitud_no_compra" required readonly>

					          <input type="hidden" class="form-control input-lg longitud_no_compra"  name="longitud_no_compra" placeholder="longitud" id="longitud_no_compra" required readonly>
					         

				             </div>

       				  	</div>
					


       				   <div class="form-group">

				          <div class="input-group">
				       
                       

					         <input type="hidden" class="form-control input-lg id_cliente"  name="id_cliente" placeholder="id_cliente" id="id_cliente" required readonly>
					         

				             </div>

       				  </div>


					  <div class="modal-footer">

				      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

				      <button type="submit" class="btn btn-primary btn_agregar_datos">Guardar</button>

				      </div>

				      	      <?php

				             $createNoCompra = new controladorRutas();

					          $createNoCompra -> ctr_agregar_no_compra();
							
					      ?>

					      </div>	
				</div>

		      	    </form>
	

</div>
		</div>	
				</div>