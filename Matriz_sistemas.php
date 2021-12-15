<?php

require_once 'php/menu_dinamico.php';
   

$menu = new Menu();
$menu->cabecera_principal();
$menu->Crear_menu();
?>
<style>

</style>


<br>

<div class="container-fluid mt-5 my-5">
    <h1 class="display-4 text-center" >Matriz de sistemas institucionales e internos</h1>

</div>

<div class="Arreglos" id="vista_temp">

<h1 class="display-4 text-md-center" >Pagina en mantenimiento</h1>

</div>



<?php
  // se imprime footer
  $menu->Footer();


?>