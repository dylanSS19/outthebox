<?php

class Movimiento_saldosController{


static public function ctrCargarClientes(){

       $table = "empresas.view_clientes"; 	
      
		$response = Movimiento_saldosModel::MdlCargarClientes($table);	

		return $response;


	}  


static public function ctrCargarMoviemintos(){

       $table = "empresas.tbl_inventario"; 	
      
		$response = Movimiento_saldosModel::MdlCargarClientes($table);	

		return $response;


	}


static public function ctrinsertar_saldo(){

		      
		if(isset($_POST["nombre_cliente"])) {


		 $table = "`upee-cr`.tbl_ingresos_saldos"; 

		 $data = array("cedula" => $_POST["nombre_cliente"],
				       "banco" => $_POST["banco_empresa"],		                 
				       "cuenta" => $_POST["cuenta"],
				       "referencia" => $_POST["referencia"],
				       "monto" => $_POST["monto_saldo"],
				       "fecha" => $_POST["fecha_ingreso"]);

		 $ultimo_ingreso_saldo = Movimiento_saldosModel::MdlAgregarcargasaldo($table, $data);	


		 $consecutivo = "";

	
 
		 $table = "empresas.tbl_inventario"; 

		 	

$monto_saldo_bodegas_array = explode(',', $_POST["monto-saldo-bodega"]);
$id_bodegas_clientes_array = explode(',', $_POST["id-bodegas"]);


$table_inventario = "empresas.tbl_inventario"; 	
$table = "empresas.tbl_bodegas";
foreach ($monto_saldo_bodegas_array as $key => $value) {


$data = array("idtbl_bodegas" =>  $id_bodegas_clientes_array[$key],
			  "saldo" => $value
				   );



$consecutivo =  strval($ultimo_ingreso_saldo."-CARGO-".$id_bodegas_clientes_array[$key]);



		 $cedula = $id_bodegas_clientes_array[$key];
		      
		$Ultimo_total = Movimiento_saldosModel::MdlCargarultimototal($table_inventario, $cedula);	


		if( $Ultimo_total == "" || empty($Ultimo_total) || $Ultimo_total == 0){

			$nuevo_total = floatval ($value);
			$Ultimo_total = 0;


		}else{

			$nuevo_total = (floatval ($value) + floatval ($Ultimo_total[0][0]));
	
			$Ultimo_total = floatval ($Ultimo_total[0][0]);

		}

$data_inventario = array("movimiento_numero" =>  $ultimo_ingreso_saldo,
				       "consecutivo" => $consecutivo,		                 
				       "tipo_movimiento" => "CARGO",
				       "codigo" => "1",
				       "producto" => "Saldo",
				       "stock" => $Ultimo_total,
				   	   "cantidad" =>$value,		                 
				       "origen" => "2",
				       "destino" => $id_bodegas_clientes_array[$key],
				       "total" => $nuevo_total,
				       "usuario" => $_SESSION["id"], 
				       "estado" => "Aceptado",
				       "bodega" => $id_bodegas_clientes_array[$key],
				   	   "cedula_cliente" => $_POST["nombre_cliente"]);


		if($value == 0 || $value == "0" ){

		}else{

		$response2 = Movimiento_saldosModel::MdlAgregarmovimientosaldo($table_inventario, $data_inventario);	
		$response = Movimiento_saldosModel::MdlAgregarsaldobodega($table, $data);
		

		}


}



 if($response == "OK"){

		    	echo '<script>
				 Swal.fire(
      "Actualización exitosa!",
      "¡Información Ingresada Exitosamente.",
      "success"
    ).then((result) => {

	 window.location = "movimiento-saldos";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡Error al ingresar los datos intente nuevamente.",
      "error"
    ).then((result) => {

	 window.location = "movimiento-saldos";
    })		

				

			</script>';


		   }


	}


} 


static public function ctrCargarbodegas($cedula){

       $table = "empresas.tbl_bodegas"; 
       $table2 = "empresas.tbl_clientes"; 	
      
		$response = Movimiento_saldosModel::MdlCargarbodegas($table, $table2, $cedula);	

		return $response;


	}




}