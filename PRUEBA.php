

<?php
    include_once "php/sesion.php";
    require_once 'php/menu_dinamico.php';
    $perfil= $_SESSION['ses_id_perfil_ing'];
    if ($perfil != 1) {
        header('location:index.php');
    }


    $menu = new Menu();
    ?>

<link rel='stylesheet' href='css/bootstrap.css'>
<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
   $menu->modals();

    ?>
<br>
<br>
<br>






<br>
<br>
<br>
</div>

<script>



 
 </script>
<?php
   $menu->Footer();

    ?>

