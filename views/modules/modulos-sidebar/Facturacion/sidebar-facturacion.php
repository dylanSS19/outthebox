
<?php

echo'  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Facturación
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">';

            include "Submodulos-facturacion/sub-facturacion.php";
	                 
            echo '</ul>
          </li>';


