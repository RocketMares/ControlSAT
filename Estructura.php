<?php
    require_once 'php/sesion.php';
    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    // $menu->menu_vertical();
    ?>




<center>
<br>
<div class="mt-5 my-5">
<h1 class="display-4">Estructura operativa</h1>
</div>
<div class="mt-5  my-5" >
<div id="myDiagramDiv" class="fondo" style="border: solid 2px black;"></div>
<?php   
include_once 'php/Vistas_generales.php';
$vis = new vistas();
$vista_gen = $vis->Vista_general();
?>
</div>



<!-- Button trigger modal -->



</center>

<?php

   // se imprime footer
   $menu->Footer();

    ?>
