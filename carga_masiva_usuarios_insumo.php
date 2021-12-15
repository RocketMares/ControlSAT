<?php

    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();




?>
<br>
<div class="container-fluid mt-5 pt-5">

    <div>
        <h1 class="display-4 text-center">Carga masiva de usuarios de plantilla</h1>
    </div>





</div>



<?php

   // se imprime footer
$menu->Footer();

?>