 <?php

$nameTech="";

class SubCategoriaserviciosController{

			/*=============================================
=                   CARGAR CLIENTES EDITAR              =
=============================================*/

	static public function ctrCargarSubCategoriaClientesEditar($item, $value){

       $table = "`upee-cr`.tbl_sub_categoria_servicios"; 	
      
		$response = SubCategoriaserviciosModel::MdlCargarSubCategoriaClientesEditar($table, $item, $value);	

		return $response;


	} 

/*=============================================
=                 CARGAR CATGORIAS       =
=============================================*/

	static public function ctrcargarcartegorias(){

        $table = "`upee-cr`.tbl_categoria_servicios";

		$response = SubCategoriaserviciosModel::Mdlcargarcartegorias($table);

		return $response;

	} 


/*=============================================
=                 CARGAR SUB CATGORIA CLIENTES      =
=============================================*/

	static public function ctrCargarSubCategoriaServicios(){

        $table = "`upee-cr`.view_subcategorias";

		$response = SubCategoriaserviciosModel::MdlCargarSubCategoriaServicios($table);

		return $response;

	} 



	/*=============================================
=           CARGAR CATEGORIA SERVICIOS     =
=============================================*/
static public function ctrCargarSubCategorias($item,$value){

       $table = "`upee-cr`.tbl_sub_categoria_servicios"; 	

		$response = SubCategoriaserviciosModel::MdlCargarSubCategorias($table, $item, $value);		

		return $response;

	}


	static public function ctrEditarSubCategoriaServicio(){

	if(isset($_POST["editarcodigocategoriaservicio"])) {

	

   	$table = "`upee-cr`.tbl_tipo_servicios";
	   
		   $data = array("codigo" => $_POST["editarcodigocategoriaservicio"],
		                  "nombre" => $_POST["editarnombrecategoriaservicio"],
		                  "palabra_clave" => $_POST["editarpalabraclavecategoriaservicio"]);
		              

		    $response = SubCategoriaserviciosModel::MdlEditarSubCategoriaServicio($table , $data);


	    if($response == "ok"){

		    	echo '<script>

		

				 Swal.fire(
      "Actualización exitosa!",
      "¡La categoria a sido actualizada correctamente",
      "success"
    ).then((result) => {

	window.location = "subcategoria-servicios";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Actualización fallida!",
      "¡La categoria no a sido actualizada correctamente",
      "error"
    ).then((result) => {

	window.location = "subcategoria-servicios";
    })		

				

			</script>'	;


		   }




	}


}


static public function ctrAgregarSubCategoriaServicio(){

	if(isset($_POST["agregarcodigosubcategoriaservicio"])) {

	

		   	$table = "`upee-cr`.tbl_tipo_servicios";
	   
		   $data = array("codigo" => $_POST["agregarcodigocategoriaservicio"],
		                  "nombre" => $_POST["agregarnombrecategoriaservicio"],
		                  "palabra_clave" => $_POST["agregarpalabraclavecategoriaservicio"],
		                   "user" => $_SESSION["user_name"],			                 
		              	  "activo" =>"No" );
		              

		    $response = SubCategoriaserviciosModel::MdlAgregarSubCategoriaServicio($table , $data);

	  
  if($response == "ok"){

   			$table = "`upee-cr`.tbl_tipo_servicios";
	   
		    $data = array("nombre" => $_POST["agregarnombrecategoriaservicio"]);		              

		    $response = SubCategoriaserviciosModel::MdlActualizarCodigoSubCategoriaServicio($table , $data);






  }

	    if($response == "ok"){

		    	echo '<script>

		

				 Swal.fire(
      "Ingreso exitoso!",
      "¡La categoria a sido guardado correctamente1",
      "success"
    ).then((result) => {

	window.location = "subcategoria-servicios";
    })			

			</script>'	;

		    } else {

		    	 	echo '<script>

						 Swal.fire(
      "Ingreso fallido!",
      "¡La categoria no a sido guardado correctamente1",
      "error"
    ).then((result) => {

	window.location = "csubategoria-servicios";
    })		

				

			</script>'	;


		   }




	}


}



}
