<?php

    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    $menu->modals();

    ?>
<br>
<div class="mt-5 my-5">
    <h1 class="display-4 text-center">Plantilla vigente de empleados.</h1>
</div>



<div class="container-fluid">

    <button class="btn btn-success" id="user_more"> Agregar empleado <i class="fas fa-user-plus"></i>
    </button>
</div>

<div class="container-fluid" id="tabla_activa">
    <?php
    include_once "php/tablas_dinamicas.php";
    $tablas = new Manda_tabla();
    $tablas->Tabla_usuarios_activos();
    ?>



</div>






<?php

   // se imprime footer
   $menu->Footer();

    ?>