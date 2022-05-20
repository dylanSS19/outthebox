<?php
 
require_once "../controllers/consulta-empleados.controller.php";
require_once "../models/consulta-empleados.model.php";

class AjaxConsultaEmpleados{

	/*=============================================
	=                  CARGAR SERVICIOS                =
	=============================================*/
	 
	public $varempleado;

	public function ajaxCargarEmpleados(){

		
		$item = "idtbl_empleados";

		$value = $this->varempleado;

		$response = controladorConsultaEmpleados::ctrCargarDatosEmpleados($item, $value);

		echo json_encode($response);

		/*echo "HOLA";*/ 

	}
 

	public $idEmpleado;
	public $idEmpresa;

	public function ajaxValidarImagen() {
		$idEmpleado = $this->idEmpleado;
		$idEmpresa = $this->idEmpresa;

		$imgFrontal = "../apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_cedula_frente.jpg";
		$imgTrasera = "../apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_cedula_atras.jpg";
		// $imgEmpleado = "../apiHacienda/clientes/" .$idEmpresa. "/FotoTrabajadores/" .$idEmpleado. "/foto_cedula_atras.jpg";
	

	/*echo $imgFrontal . ' / ' .$imgTrasera;*/
		if(file_exists($imgFrontal) || file_exists($imgTrasera) )  {
			echo "ok";
		}else{

			echo "NO FOTO";
		}
	}



	public $idEmpleadoT;
	public $idEmpresaT;


	public function ajaxCargarTabla(){

		$idEmpleadoT = $this->idEmpleadoT;
		$idEmpresaT = $this->idEmpresaT;

		// $response = controladorConsultaEmpleados::ctrCargarDatosEmpleados($item, $value);
		function pretty_filesize($file) {
			$size=filesize($file);
			if($size<1024){$size=$size." Bytes";}
			elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
			elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
			else{$size=round($size/1073741824, 1)." GB";}
			return $size;
		  }
		
		  // Checks to see if veiwing hidden files is enabled
		  if($_SERVER['QUERY_STRING']=="hidden")
		  {$hide="";
		   $ahref="./";
		   $atext="Hide";}
		  else
		  {$hide=".";
		   $ahref="./?hidden";
		   $atext="Show";}
		
		   // Opens directory

		   $rut1 = "../apiHacienda/clientes/".$idEmpresaT."/FotoTrabajadores/".$idEmpleadoT;
		   $rut2 = "../apiHacienda/clientes/".$idEmpresaT."/FotoTrabajadores/".$idEmpleadoT."/Documentos/";

		   $dir = "../apiHacienda/clientes/".$idEmpresaT."/FotoTrabajadores/".$idEmpleadoT."/Documentos/";

		   if(!file_exists($rut1)){

			mkdir($rut1);
	
		  }

		  if(!file_exists($rut2)){

			mkdir($rut2);

		  }

		  $carpeta = @scandir($rut2);

		  if (count($carpeta) > 2){
			
		  }else{
			
			exit();
		  }



		   
		   $myDirectory=opendir($dir);
		
		  // Gets each entry
		  while($entryName=readdir($myDirectory)) {
			 $dirArray[]=$dir . ''.$entryName;
		  }
		
		  // Closes directory
		  closedir($myDirectory);
		
		  // Counts elements in array
		  $indexCount=count($dirArray);
		
		  // Sorts files
		  sort($dirArray);
		
		
		  $tabla = "";

		  // Loops through the array of files
		  for($index=2; $index < $indexCount; $index++) {
			
		  // Decides if hidden files should be displayed, based on query above.
			//   if(substr("$dirArray[$index]", 0, 1)!=$hide) {
		
		  // Resets Variables
			$favicon="";
			$class="file";
		
		  // Gets File Names
			$name=$dirArray[$index];
			//echo '<pre>'; print_r($name); echo '</pre>';
			$namehref=$dirArray[$index];
		
		  // Gets Date Modified
			$modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
			$timekey=date("YmdHis", filemtime($dirArray[$index]));
		
		
		  // Separates directories, and performs operations on those directories
			if(is_dir($dirArray[$index]))
			{
				$extn="&lt;Directory&gt;";
				$size="&lt;Directory&gt;";
				$sizekey="0";
				$class="dir";
		
			  // Gets favicon.ico, and displays it, only if it exists.
				if(file_exists("$namehref/favicon.ico"))
				  {
					$favicon=" style='background-image:url($namehref/favicon.ico);'";
					$extn="&lt;Website&gt;";
				  }
		
			  // Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
			}
		
		  // File-only operations
			else{
			  // Gets file extension
			  $extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);
		
			  // Prettifies file type
			  switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "jpeg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;
		
				case "txt": $extn="Text File"; break;
				case "log": $extn="Log File"; break;
				case "htm": $extn="HTML File"; break;
				case "html": $extn="HTML File"; break;
				case "xhtml": $extn="HTML File"; break;
				case "shtml": $extn="HTML File"; break;
				case "php": $extn="PHP Script"; break;
				case "js": $extn="Javascript File"; break;
				case "css": $extn="Stylesheet"; break;
		
				case "pdf": $extn="PDF Document"; break;
				case "xls": $extn="Spreadsheet"; break;
				case "xlsx": $extn="Spreadsheet"; break;
				case "doc": $extn="Microsoft Word Document"; break;
				case "docx": $extn="Microsoft Word Document"; break;
		
				case "zip": $extn="ZIP Archive"; break;
				case "htaccess": $extn="Apache Config File"; break;
				case "exe": $extn="Windows Executable"; break;
		
				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
			  }
		
			  // Gets and cleans up file size
				$size=pretty_filesize($dirArray[$index]);
				$sizekey=filesize($dirArray[$index]);
			}
		
		  		// Output

				  $name = explode("/", $name);
				  $namehref = substr($namehref, 3);
				$tabla .=  "
				<tr class='$class'>
				<td><a href='$namehref'$favicon class='name' target='_blank'>$name[7]</a></td>
				<td><a href='$namehref' target='_blank'>$extn</a></td>
				<td sorttable_customkey='$sizekey'><a href='$namehref' target='_blank'>$size</a></td>
				<td sorttable_customkey='$timekey'><a href='$namehref' target='_blank'>$modtime</a></td>
				<td><div class='btn-group'> <button type='button' class='btn btn-outline-danger btnElimArch' rut='$namehref' empl='$idEmpleadoT'><i class='fas fa-trash-alt'></i></button> <button type='button' class='btn btn-outline-secondary ml-2 btnRename' rut='$namehref' empl='$idEmpleadoT'><i class='fas fa-edit'></i></button></div></td>
				</tr>";
				
			//  }
		  }

		  echo $tabla;
	}






	public $RutaDelete;

	public function ajaxEliminarDocumento() {
		$RutaDelete = $this->RutaDelete;
		


		if(unlink('../'.$RutaDelete)){

			echo 'OK';

		}else{

			echo 'ERROR';

		}
		
	}


	public $RenameNombre;
	public $RenameRuta;
	public $RenameEmpleado;
	public $RenameEmpresa;
	public function ajaxRenombrarDocumento() {
		$RenameNombre = $this->RenameNombre;
		$RenameRuta = $this->RenameRuta;
		$RenameEmpleado = $this->RenameEmpleado;
		$RenameEmpresa = $this->RenameEmpresa;

		
		$name = explode(".", $RenameRuta);

		$tamano = count($name); 

		$tamano = $tamano - 1;

		$dir = "../apiHacienda/clientes/".$RenameEmpresa."/FotoTrabajadores/".$RenameEmpleado."/Documentos/";
		

		if(rename ("../".$RenameRuta, $dir."".$RenameNombre.".".$name[$tamano])){

			echo 'OK';

		}else{

			echo 'ERROR';

		}


		

		
	}


}


	/*=============================================
	=  LOAD GPS LACATION USER OBJECT              =
	=============================================*/
if(isset($_POST["varempleado"])){

	$value = new AjaxConsultaEmpleados();

	$value -> varempleado = $_POST["varempleado"];

	$value -> ajaxCargarEmpleados();

}


if(isset($_POST["idEmpleado"])){

	$value = new AjaxConsultaEmpleados();

	$value -> idEmpleado = $_POST["idEmpleado"];
	$value -> idEmpresa = $_POST["idEmpresa"];

	$value -> ajaxValidarImagen();

}


if(isset($_POST["idEmpleadoT"])){

	$value = new AjaxConsultaEmpleados();

	$value -> idEmpleadoT = $_POST["idEmpleadoT"];
	$value -> idEmpresaT = $_POST["idEmpresaT"];

	$value -> ajaxCargarTabla();

}


if(isset($_POST["RutaDelete"])){

	$value = new AjaxConsultaEmpleados();

	$value -> RutaDelete = $_POST["RutaDelete"];

	$value -> ajaxEliminarDocumento();

}


if(isset($_POST["RenameNombre"])){

	$value = new AjaxConsultaEmpleados();

	$value -> RenameNombre = $_POST["RenameNombre"];
	$value -> RenameRuta = $_POST["RenameRuta"];
	$value -> RenameEmpleado = $_POST["RenameEmpleado"];
	$value -> RenameEmpresa = $_POST["RenameEmpresa"];


	$value -> ajaxRenombrarDocumento();

}


	