<?php
    if (!$_GET ) {
      header('Location:Matriz_sistemas.php?pagina=1');
  }
require_once 'php/menu_dinamico.php';
   

$menu = new Menu();
$menu->cabecera_principal();
$menu->Crear_menu();
$menu->Modal_matriz();
?>
<style>

</style>


<br>

<div class="container-fluid mt-5 my-5">
    <h1 class="display-4 text-center" >Matriz de sistemas institucionales e internos</h1>

</div>

<div class="continer " id="vista_temp">
 <?php 
include_once 'php/tablas_dinamicas.php';
$tab = new Manda_tabla();
$tab->Matriz_sistemas();





?>


</div>



<?php
  // se imprime footer
  $menu->Footer();


?>