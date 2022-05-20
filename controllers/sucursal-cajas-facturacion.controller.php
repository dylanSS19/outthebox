<?php

  
class SucursalesCajasController{

		/*=============================================
		=    CARGAR CLIENTES EDITAR              =
		=============================================*/

		static public function ctrCargarSucursal($idempresa){

        
	       $table = "empresas.tbl_sucursal_".$idempresa;
           $table2 = "empresas.tbl_cajas_".$idempresa;  	
	      
			$response = SucursalesCajasModel::MdlCargarSucursal($table, $table2);	

			return $response;

		} 

		static public function ctrInsertarUltimoConse($id_factura, $ultimo_consecutivo, $sucursal, $caja, $tipo, $id_empresa, $tabla){ 	

      $table = $tabla;

      $data = array("id_factura" => '0',
      "ultimo_consecutivo" => $ultimo_consecutivo,
      "sucursal" => $sucursal,                         
      "caja" => $caja,
      "tipo" => $tipo,
      "id_empresa" => $id_empresa
      );
     
   $response = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);	

   return $response;

 }



 static public function ctrCargarUltimoConse($SearchTabla, $Searchtipo, $SearchSucursal, $SearchCaja, $Searchempresa){
	
 
$response = SucursalesCajasModel::MdlCargarUltimoConse($SearchTabla, $Searchtipo, $SearchSucursal, $SearchCaja, $Searchempresa);	

return $response;

} 

      /*=============================================
      =   CREAR SUCURSALES  EMPRESAS              =
      =============================================*/

 static public function ctrCrearSucursal(){
       
         if(isset($_POST["idsucursal"])){


            $idempresa =  $_SESSION['empresa'];
                
            $response = SucursalesCajasModel::MdlCrearSucursal($idempresa); 

            $table = "empresas.tbl_sucursal_".$idempresa;
           
            $valsucursal = SucursalesCajasModel::MdlValSucursales($table, $_POST["idsucursal"]);



        if($valsucursal[0] == "no"){
            
             echo '<script>
             Swal.fire(
                  "Datos diplicados no validos!",
                  "¡ID de la sucursal ingresado ya existe en sistema.",
                  "error"
                ).then((result) => {

                window.location = "sucursal-cajas-facturacion";
                })          
                </script>';

        }else{

      
         $data = array("nombre" => $_POST["nombresucursal"],
                                  "idsucursal" => $_POST["idsucursal"]
                                  );
                              
                    $responseinsert = SucursalesCajasModel::MdlAgregarSucursal($table , $data);   
                //     echo '<pre>'; print_r($responseinsert); echo '</pre>';                
                   if($responseinsert == "ok"){

                        echo '<script>
            Swal.fire(
              "Ingreso exitoso!",
              "¡Datos ingresados correctamente.",
              "success"
            ).then((result) => {

            window.location = "sucursal-cajas-facturacion";
            })          
                    </script>'  ;

                    } else {
 
                            echo '<script>

                                 Swal.fire(
              "ingreso fallido!",
              "Error al ingresar los datos, intente nuevamente.",
              "error"
            ).then((result) => {
            
                window.location = "sucursal-cajas-facturacion";

            })      
                    </script>'  ;

           
                   }

 

                      

        }


    } 
 }


     /*=============================================
      =    CREAR CAJAS  EMPRESAS 
      window.location = "sucursal-cajas-facturacion";            =
      =============================================*/

      static public function ctrCrearCajas(){

       
            if(isset($_POST["idcaja"])){

                $idempresa =  $_SESSION['empresa'];
            
                $response = SucursalesCajasModel::MdlCrearCajas($idempresa); 
               
             
                 $table = "empresas.tbl_cajas_".$idempresa;    

            $valcajas = SucursalesCajasModel::MdlValCajas($table , $_POST["idcaja"], $_POST["sucursalcaja"]);

   
        
    if($valcajas[0] == "no"){


     echo '<script>
                 Swal.fire(
                      "Datos diplicados no validos!",
                      "¡ID de la sucursal ingresado ya existe en sistema.",
                      "error"
                    ).then((result) => {

                    window.location = "sucursal-cajas-facturacion";
                    })          
                    </script>';

    }else{

                    $data = array("nombre" => $_POST["nombrecaja"],
                                  "idcaja" => $_POST["idcaja"],
                                  "idsucursal" => $_POST["sucursalcaja"],
                                      );
                                  

                        $response = SucursalesCajasModel::MdlAgregarCajas($table , $data);   


            $idsucursal = $_POST["sucursalcaja"];
            $sucursal = SucursalesCajasModel::MdlCSucursalesID($table, $idsucursal);
            // echo '<pre>'; print_r($sucursal[2]); echo '</pre>';


            $table = "empresas.tbl_ultimo_consecutivo"; 

            $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseFE"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "FE",
                          "id_empresa" => $idempresa
                          );

            $utlConseFE = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);

            $table = "empresas.tbl_ultimo_consecutivo"; 

            $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseTE"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "TE",
                          "id_empresa" => $idempresa
                          );

            $utlConseTE = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);

            $table = "empresas.tbl_ultimo_consecutivo"; 
             $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseNC"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "NC",
                          "id_empresa" => $idempresa
                          );         

            $utlConseNC = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);

            $table = "empresas.tbl_ultimo_consecutivo"; 

             $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseND"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "ND",
                          "id_empresa" => $idempresa
                          );
         
            $utlConseND = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);

            $table = "empresas.tbl_ultimo_consecutivo"; 

             $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseFC"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "FC",
                          "id_empresa" => $idempresa
                          );
         
            $utlConseFC = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);


            $table = "empresas.tbl_ultimo_consecutivo"; 

             $data = array("id_factura" => '0',
                          "ultimo_consecutivo" => $_POST["utlconseMC"],
                          "sucursal" => $sucursal[2],                         
                          "caja" => $_POST["idcaja"],
                          "tipo" => "MR",
                          "id_empresa" => $idempresa                        
                          );
         
            $utlConseFC = SucursalesCajasModel::MdlAgregarUltimoConse($table, $data);

                                 
                       if($response == "ok"){

                            echo '<script>

                             Swal.fire(
                  "Actualización exitosa!",
                  "¡Datos ingresados correctamente.",
                  "success"
                ).then((result) => {

window.location = "sucursal-cajas-facturacion";
                
                })          

                        </script>'  ;

                        } else {

                                echo '<script>

                                     Swal.fire(
                  "Actualización fallida!",
                  "Error al ingresar los datos, intente nuevamente.",
                  "error"
                ).then((result) => {
               
                    window.location = "sucursal-cajas-facturacion";

                })      

                            

                        </script>'  ;


                       }
        }
                      


    }

} 

 

        /*=============================================
        =                   CARGAR CLIENTES EDITAR              =
        =============================================*/

        static public function ctrCargarSucursalxEmpresa($idEmpresa){

           $table = "empresas.tbl_sucursal_".$idEmpresa;
        
            $response = SucursalesCajasModel::MdlCargarSucursalxEmpresa($table);    

            return $response;

        } 


}
