<?php

if (($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/gif")) {
	
    $directory = "../apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos";

    if(!file_exists($directory)){

        mkdir($directory);

      };

      $ruta_destino_archivo = "../apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos/".uniqid().'_'.$_FILES['file']['name'];
      $ruta_destino_guardar = "apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos/".uniqid().'_'.$_FILES['file']['name'];


    // echo("<script>console.log('PHP: empresa ".$_GET["empresa"]."');</script>");


    // $data = array("Ruta" => $ruta_destino_guardar,
    // "Nombre" => uniqid().'_'.$_FILES['file']['name'],
    // "Empleado" => $_GET["empleado"],
    // "Empresa" => $_GET["empleado"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_destino_archivo)) {
	

        

	} else {

        echo("<script>console.log('PHP: subido No');</script>");


	}

}else{


    $directory = "../apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos";

    if(!file_exists($directory)){

        mkdir($directory);

      };

    $ruta_destino_archivo = "../apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos/".uniqid().'_'.$_FILES['file']['name'];
    $ruta_destino_guardar = "apiHacienda/clientes/".$_GET["empresa"]."/FotoTrabajadores/".$_GET["empleado"]."/Documentos/".uniqid().'_'.$_FILES['file']['name'];

    // $data = array("Ruta" => $ruta_destino_guardar,
    // "Nombre" => uniqid().'_'.$_FILES['file']['name'],
    // "Empleado" => $_GET["empleado"],
    // "Empresa" => $_GET["empleado"]);
    
 
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta_destino_archivo)) {
	
        echo("<script>console.log('PHP: subido Si');</script>");
    
        } else {
            echo("<script>console.log('PHP: subido No');</script>");
    
        }

}