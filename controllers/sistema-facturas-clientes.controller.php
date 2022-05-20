 <?php

 

class ReporteClientesController{

    /*=============================================
    =                   CARGAR CLIENTES EDITAR              =
    =============================================*/

    static public function ctrCargarClientesXempresa($idempresa){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = ReporteClientesModel::MdlCargarClientesXempresa($table, $idempresa); 

        return $response;


    } 


    /*=============================================
    =         CARGAR CABYS             =
    =============================================*/

    static public function ctrCargarcedula($Cedula){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apis.gometa.org/cedulas/'.$Cedula,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);

// echo $response; 

        return $response;


} 



    /*=============================================
    =        AGREGAR CLIENTES              =
    =============================================*/

    static public function ctrAgregarClientes($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $tipoLista){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = ReporteClientesModel::MdlAgregarCliente($table, $id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $tipoLista); 

        return $response;


    } 



    static public function ctrValCedula($id_empresaV, $cedulaV){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = ReporteClientesModel::MdlValCedula($table, $id_empresaV, $cedulaV); 

        return $response;


    }

        static public function ctrCargarClienteXid($client){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = ReporteClientesModel::MdlCargarClienteXid($table, $client); 

        return $response;


    }

    static public function ctrEditarClientes($id_clienteE, $nombreCE, $cedulaCE, $tipo_CedulaCE, $correoCE, $telefonoCE, $provinciaCE, $CantonCE, $distritoCE, $direccionCE, $tipoListaCE){

        $table = "empresas.tbl_empresas_clientes";    
       
         $response = ReporteClientesModel::MdlEditarClientes($table, $id_clienteE, $nombreCE, $cedulaCE, $tipo_CedulaCE, $correoCE, $telefonoCE, $provinciaCE, $CantonCE, $distritoCE, $direccionCE, $tipoListaCE); 
 
         return $response;
 
 
     } 


    /*===================================
	=        CARGAR LISTAS PRECIOS      =
	====================================*/
    static public function ctrCargarListasPrecios() {
        $table = "empresas.tbl_listas_precio";
        $idEmpresa = $_SESSION["id_empresa"];

        $response = ReporteClientesModel::MdlCargarListasPrecios($table, $idEmpresa);

        return $response;
    }

}