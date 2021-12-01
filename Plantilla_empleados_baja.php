<?php

    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    $menu->Modals_bajas_laudos();

    ?>
<br>
<div class="mt-5 my-5">
    <h1 class="display-4 text-center">Plantilla empleados en estado de Baja, comision y Laudos registrados.</h1>
</div>





<div class="container-fluid" id="tabla_activa">
    <?php
    include_once "php/tablas_dinamicas.php";
    $tablas = new Manda_tabla();
    $tablas->Tabla_usuarios_baja_comision_suspen_laudos();
    ?>



</div>






<?php

   // se imprime footer
   $menu->Footer();

    ?>