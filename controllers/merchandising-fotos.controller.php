<?php

class MerchandisingFotosController{

/*=============================================
    =        AGREGAR CLIENTES              =
    =============================================*/

    static public function ctrAgregarFotos($id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud){

       $table = "empresas.tbl_empresas_clientes";    
      
        $response = MerchandisingClientesModel::MdlAgregarCliente($table, $id_empresa, $nombreC, $cedulaC, $tipo_CedulaC, $correoC, $telefonoC, $provinciaC, $CantonC, $distritoC, $direccionC, $diasVisita, $latitud, $longitud); 

        return $response;

    } 

}