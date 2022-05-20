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






echo'<li class="nav-item">
<a href="reporte-tiendas" class="nav-link">
  <i class="nav-icon fas fa-shopping-cart"></i>
  <p>
    KPIS Tiendas
  </p>
</a>
</li> ';

echo'<li class="nav-item">
<a href="reporte-ventas-dth" class="nav-link">
  <i class="nav-icon fas fa-shopping-cart"></i>
  <p>
    KPIS DTH
  </p>
</a>
</li> ';

echo'<li class="nav-item">
    <a href="reporte-ventas-bodega" class="nav-link">
    <i class="fas fa-chart-pie nav-icon"></i>
      <p>Evaluacion De Ruta</p>
    </a>
  </li>';

/**  INICIO INVENTARIOS  **/
echo'<li class="nav-item">
<a href="#" class="nav-link">
  <i class="fas fa-boxes nav-icon"></i>
  <p>
    Inventarios
    <i class="fas fa-angle-left right"></i>
  </p>
</a>
<ul class="nav nav-treeview">

  
  <li class="nav-item">
    <a href="aceptacion-inventarios" class="nav-link">
      <i class="nav-icon fas fa-bullhorn"></i>
      <p>Aceptacion</p>
    </a>
  </li>
 
</ul>
</li>';

/**  FIN INVENTARIOS  **/

/** INICIO PLANILLA MOVIL **/
echo'   <li class="nav-item">
<a href="#" class="nav-link">
  <i class="nav-icon fas fa-clipboard-list size: 2x"></i>
  <p>
    Planilla Movil
    <i class="fas fa-angle-left right"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="#" class="nav-link">
    <i class="fas fa-users nav-icon"></i>
      <p>
        Colaboradores 
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="consulta-empleados" class="nav-link">
        <i class="fas fa-search nav-icon"></i>
          <p>Consulta </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../examples/register.html" class="nav-link">
          <i class="fas fa-plus nav-icon"></i>
          <p>Registro</p>
        </a>
      </li>

    </ul>
  </li>
  
  <li class="nav-item">
    <a href="ad-personal" class="nav-link">
      <i class="nav-icon fas fa-bullhorn"></i>
      <p>AD Personal</p>
    </a>
  </li>
 
</ul>
</li>';
/** FIN PLANILLA MOVIL **/

