<?php

$nameTech="";

class CategoriaserviciosController{

			/*=============================================
=                   CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarCategoriaClientesEditar($item, $value){

       $table = "`upee-cr`.tbl_categoria_servicios"; 	
      
		$response = CategoriaserviciosModel::MdlCargarCategoriaClientesEditar($table, $item, $value);	

		return $response;


	} 


/*=============================================
=                 CARGAR CATGORIA CLIENTES      =
=============================================*/

	static public function ctrCargarCategoriaServicios(){

        $table = "`upee-cr`.tbl_categoria_servicios";

		$response = CategoriaserviciosModel::MdlCargarCategoriaServicios($table);

		return $response;

	} 



	/*=============================================
=           CARGAR CATEGORIA SERVICIOS     =
=============================================*/
static public function ctrCargarCategorias($item,$value){

       $table = "`upee-cr`.tbl_categoria_servicios"; 	

		$response = CategoriaserviciosModel::MdlCargarCategorias($table, $item, $value);		

		return $response;

	}


	static public function ctrEditarCategoriaServicio(){

	if(isset($_POST["editarcodigocategoriaservicio"])) {

	

   	$table = "`upee-cr`.tbl_categoria_servicios";
	   
		   $data = array("codigo" => $_POST["editarcodigocategoriaservicio"],
		                  "nombre" => $_POST["editarnombrecategoriaservicio"],
		                  "palabra_clave" => $_POST["editarpalabraclavecategoriaservicio"]);
		              

		    $response = CategoriaserviciosModel::MdlEditarCategoriaServicio($table , $data);


	    if($response == "ok"){

		    	echo '<script>

		

				 Swal.fire(
      "Actualización exitosa!",
      "¡La categoria a sido actualizada correctamente",
      "success"
    ).then((result) => {

	window.location = "categoria-servicios";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡La categoria no a sido actualizada correctamente",
      "error"
    ).then((result) => {

	window.location = "categoria-servicios";
    })		

				

			</script>'	;


		   }




	}


}


static public function ctrAgregarCategoriaServicio(){

	if(isset($_POST["agregarcodigocategoriaservicio"])) {

	

		   	$table = "`upee-cr`.tbl_categoria_servicios";
	   
		   $data = array("codigo" => $_POST["agregarcodigocategoriaservicio"],
		                  "nombre" => $_POST["agregarnombrecategoriaservicio"],
		                  "palabra_clave" => $_POST["agregarpalabraclavecategoriaservicio"],	
		                  "user" => $_SESSION["user_name"],		                 
		              	  "activo" =>"No" );
		              

		    $response = CategoriaserviciosModel::MdlAgregarCategoriaServicio($table , $data);

	  
  if($response == "ok"){

   			$table = "`upee-cr`.tbl_categoria_servicios";
	   
		    $data = array("nombre" => $_POST["agregarnombrecategoriaservicio"]);		              

		    $response = CategoriaserviciosModel::MdlActualizarCodigoCategoriaServicio($table , $data);






  }

	    if($response == "ok"){

		    	echo '<script>

		

				 Swal.fire(
      "Ingreso exitoso!",
      "¡La categoria a sido guardado correctamente1",
      "success"
    ).then((result) => {

	window.location = "categoria-servicios";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Ingreso fallido!",
      "¡La categoria no a sido guardado correctamente1",
      "error"
    ).then((result) => {

	window.location = "categoria-servicios";
    })		

				

			</script>'	;


		   }




	}


}



}
