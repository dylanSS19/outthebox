<?php


// echo'

// <li class="nav-item">';

$idMod = "'1','2'";
$usuario = $_SESSION["id"];
$Submodulos = sidebarController::ctrCargarSubModulos($idMod);
$Usuariosmodulos = sidebarController::ctrUsuariosModulos($usuario);

// echo '<pre>'; print_r($Submodulos); echo '</pre>';


$Usuariosmodulos = str_replace ( '"' , '' ,$Usuariosmodulos[0]["modulos"]);
$Usuariosmodulos = str_replace ( '[' , '' ,$Usuariosmodulos);
$Usuariosmodulos = str_replace ( ']' , '' ,$Usuariosmodulos);
$Usuariosmodulos = explode(',', $Usuariosmodulos);



foreach ($Submodulos as $key => $value) {
 
  for ($i=0; $i < count($Usuariosmodulos); $i++) { 
 
    if($value["idtbl_subModulos_outthebox"] == $Usuariosmodulos[$i]["modulos"]){

    $etiquetas =   str_replace ( "'" , '' ,$value["etiquetahtml"]);

    echo $etiquetas;
     
    
    }
  
  }

}


// exit();
// echo '<pre>'; print_r($Submodulos); echo '</pre>';
// echo '<pre>'; print_r($Usuariosmodulos); echo '</pre>';


// echo  ' <a href="clientes" class="nav-link">
//              <i class="nav-icon fas fa-user-tag"></i>
//               <p>
//                 Clientes
//               </p>
//             </a>
//           </li>';


//           echo' <li class="nav-item">
//             <a href="clientes" class="nav-link">
//              <i class="nav-icon fas fa-user-tag"></i>
//               <p>
//                clientes
//               </p>
//             </a>
//           </li>'


//           echo' <li class="nav-item">
//             <a href="inicio-facturacion" class="nav-link">
//              <i class="nav-icon fas fa-user-tag"></i>
//               <p>
//                Dashboard Facturacion
//               </p>
//             </a>
//           </li>


//             <li class="nav-item a">
//             <a href="sistema-facturas-crearFactura" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Crear Pedidos
//               </p>
//             </a>
//           </li>



//             <li class="nav-item a">
//             <a href="sistema-facturas-facturacion" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Facturar
//               </p>
//             </a>
//           </li>

 
//             <li class="nav-item">
//             <a href="reporte-sistema-facturacion" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Reporte Facturas
//               </p>
//             </a>
//           </li>


//   	<li class="nav-item">
//             <a href="sistema-facturas-reporte-gastos" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Reporte Gastos
//               </p>
//             </a>
//           </li>


//           <li class="nav-item">
//             <a href="sucursal-cajas-facturacion" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Sucursales y Cajas
//               </p>
//             </a>
//           </li>

//           <li class="nav-item">
//             <a href="sistema-facturas-productos" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Productos
//               </p>
//             </a>
//           </li>

//           <li class="nav-item">
//             <a href="sistema-facturas-clientes" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Clientes
//               </p>
//             </a>
//           </li>
          
//           <li class="nav-item">
//             <a href="sistema-facturas-actividadEconomica" class="nav-link">
//              <i class="nav-icon fas fa-arrow-alt-circle-right"></i>
//               <p>
//                Actividad Economica
//               </p>
//             </a>
//           </li>       


// ';


