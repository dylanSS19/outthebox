<?php 
 

class MoverSaldoController{

/*=============================================
=     CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarBodegas($value){

       $table = "empresas.tbl_bodegas"; 	
       $table2 = "empresas.tbl_clientes"; 	
      
		$response = MoverSaldoModel::MdlBodegasCliente($table, $table2, $value);	

		return $response;

	} 

/*=============================================
=     CARGAR BODEGAS POR USUARIO             =
=============================================*/

	static public function ctrCargarBodegasxusuario($value){

       $table = "empresas.tbl_bodegas"; 	
       $table2 = "empresas.tbl_clientes"; 	
      
		$response = MoverSaldoModel::MdlCargarBodegasxusuario($table, $table2, $value);	

		return $response;

	} 



/*=============================================
=     CARGAR SALDO BODEGAS             =
=============================================*/

	static public function ctrCargarSalarioBodega($value){

       $table = "empresas.tbl_bodegas"; 	
	   
		$response = MoverSaldoModel::MdlCargarSalarioBodega($table, $value);	

		return $response;

	} 



/*=============================================
=     CARGAR BODEGAS POR CLIENTE             =
=============================================*/

	static public function ctrCargarBodegasxcliente($value){

       $table = "empresas.tbl_bodegas"; 	
       $table2 = "empresas.tbl_clientes"; 	
      
		$response = MoverSaldoModel::MdlCargarBodegasxcliente($table, $table2, $value);	

		return $response;

	} 





/*=============================================
=     CARGAR BODEGAS POR CLIENTE             =
=============================================*/

	static public function ctringresarMovimeinto(){

	
if(isset($_POST["bodega_final"])) {


if($_SESSION["rol"]=="Administrador" || $_SESSION["rol"]=="Administrativo"){


$table = "empresas.tbl_bodegas"; 
$table2 = "empresas.tbl_clientes"; 
$value = $_POST["cliente"];

$datos_cliente = MoverSaldoModel::MdlCargarClientesXid($table,$table2, $value);

$cliente = $datos_cliente[0][0];


}else{


$table = "empresas.tbl_bodegas"; 
$table2 = "empresas.tbl_clientes"; 
$value = $_SESSION["id"];
$datos_cliente = MoverSaldoModel::MdlCargarClientesXusuario($table,$table2, $value);

$cliente = $datos_cliente[0][0];

}


		 $table_inventario = "empresas.tbl_inventario"; 	
		 $cedula = $_POST["bodega_inicial"];
		      
		$Ultimo_total = MoverSaldoModel::MdlCargarultimototal($table_inventario, $cedula);	
	
$total_final = floatval ($Ultimo_total[0][0]);
$ultimo_movimeinto = strval($Ultimo_total[0][1]);
$ultimo_movimeinto = intval($ultimo_movimeinto) + 1;
		if( $Ultimo_total == "" || empty($Ultimo_total) || $Ultimo_total == 0){

			$nuevo_total = floatval ($_POST["saldo_transferir"]);
			$Ultimo_total = 0;


		}else{

			$nuevo_total = ($total_final - floatval ($_POST["saldo_transferir"]));
			
	
			$Ultimo_total = floatval ($Ultimo_total[0][0]);

		}

$consecutivo =  strval($ultimo_movimeinto."-MOVIMIENTO SALIDA-".$_POST["bodega_inicial"]);

 $table = "empresas.tbl_inventario"; 

$data_inventario = array("movimiento_numero" =>  $ultimo_movimeinto,
				       "consecutivo" => $consecutivo,		                 
				       "tipo_movimiento" => "MOVIMIENTO SALIDA",
				       "codigo" => "1",
				       "producto" => "Saldo",
				       "stock" => $Ultimo_total,
				   	   "cantidad" => $_POST["saldo_transferir"],		                 
				       "origen" => $_POST["bodega_inicial"],
				       "destino" => $_POST["bodega_inicial"],
				       "total" => $nuevo_total,
				       "usuario" => $_SESSION["id"], 
				       "estado" => "Aceptado",
				       "bodega" => $_POST["bodega_inicial"],
				   	   "cedula_cliente" => $cliente);


 $ingreso_movimeinto = MoverSaldoModel::MdlAgregarmovimiento($table, $data_inventario);


$data_inventario = [];
$table_inventario = "";
$cedula = "";
$Ultimo_total = "";
$total_final = "";
$ultimo_movimeinto = "";
$consecutivo = "";
$nuevo_total = "";
$ingreso_movimeinto = "";

		 $table_inventario = "empresas.tbl_inventario"; 	
		 $cedula = $_POST["bodega_final"];
		      
		$Ultimo_total = MoverSaldoModel::MdlCargarultimototal($table_inventario, $cedula);	
	
$total_final = floatval ($Ultimo_total[0][0]);
$ultimo_movimeinto = strval($Ultimo_total[0][1]);
$ultimo_movimeinto = intval($ultimo_movimeinto) + 1;
		if( $Ultimo_total == "" || empty($Ultimo_total) || $Ultimo_total == 0){

			$nuevo_total = floatval ($_POST["saldo_transferir"]);
			$Ultimo_total = 0;


		}else{

			$nuevo_total = (floatval ($_POST["saldo_transferir"]) + $total_final);
	
			$Ultimo_total = floatval ($Ultimo_total[0][0]);

		}

$consecutivo =  strval($ultimo_movimeinto."-MOVIMIENTO ENTRADA-".$_POST["bodega_final"]);

 $table = "empresas.tbl_inventario"; 

$data_inventario = array("movimiento_numero" =>  $ultimo_movimeinto,
				       "consecutivo" => $consecutivo,		                 
				       "tipo_movimiento" => "MOVIMIENTO ENTRADA",
				       "codigo" => "1",
				       "producto" => "Saldo",
				       "stock" => $Ultimo_total,
				   	   "cantidad" => $_POST["saldo_transferir"],		                 
				       "origen" => $_POST["bodega_inicial"],
				       "destino" => $_POST["bodega_final"],
				       "total" => $nuevo_total,
				       "usuario" => $_SESSION["id"], 
				       "estado" => "Aceptado",
				       "bodega" => $_POST["bodega_final"],
				   	   "cedula_cliente" => $cliente);


 $ingreso_movimeinto = MoverSaldoModel::MdlAgregarmovimiento($table, $data_inventario);



 $table = "empresas.tbl_bodegas"; 
$value_bodega = $_POST["bodega_final"];


 $ultimo_saldo = MoverSaldoModel::MdlCargarSaldoBodegas($table, $value_bodega);



$saldo_actual = floatval($ultimo_saldo[0]) + floatval ($_POST["saldo_transferir"]);


$data_bodegas = array("idtbl_bodegas" =>  $_POST["bodega_final"],
				       "saldo" => $saldo_actual		                 
				      );

 $ultimo_ingreso_saldo = MoverSaldoModel::Mdleditarsaldo($table, $data_bodegas);


 $table = "empresas.tbl_bodegas"; 
$value_bodega = $_POST["bodega_inicial"];


 $ultimo_saldo = MoverSaldoModel::MdlCargarSaldoBodegas($table, $value_bodega);



$saldo_actual = floatval($ultimo_saldo[0]) - floatval ($_POST["saldo_transferir"]);


$data_bodegas = array("idtbl_bodegas" =>  $_POST["bodega_inicial"],
				       "saldo" => $saldo_actual		                 
				      );

 $ultimo_ingreso_saldo = MoverSaldoModel::Mdleditarsaldo($table, $data_bodegas);


// echo '<pre>'; print_r( $ingreso_movimeinto ); echo '</pre>';

 if($ingreso_movimeinto == "OK"){

		    	echo '<script>
				 Swal.fire(
      "Actualización exitosa!",
      "¡Información Ingresada Exitosamente.",
      "success"
    ).then((result) => {

	 window.location = "mover-saldo-bodegas";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡Error al ingresar los datos intente nuevamente.",
      "error"
    ).then((result) => {

	 window.location = "mover-saldo-bodegas";
    })		

				

			</script>';


		   }


	









	}

} 



}

 