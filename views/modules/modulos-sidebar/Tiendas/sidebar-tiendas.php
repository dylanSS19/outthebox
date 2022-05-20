<?php

echo'  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Tiendas
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">';

            include "Submodulos-tiendas/sub-tiendas.php";
	                 
            echo '</ul>
          </li>';