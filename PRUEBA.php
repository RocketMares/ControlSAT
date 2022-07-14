

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
 //  $menu->modals();

    ?>
<br>
<br>
<div class="container mt-3 my-3">
<h1 class="display-4">Genera reporte de Gestor de contris especificos</h1>
</div>

<br>

<div id="Mares_report" class="container" >
    <button id="ya_vaz" type="button" onclick="genera_reporte_gestor()" class="btn btn-outline-danger" >Genera_reporte</button>
</div>


<?php



?>


<br>
<br>
</div>


<?php
// switch ($_GET) {
//     case isset($_GET['caso']):
        
//         echo"<div class='jumbotron'>
//         <h1 class='display-4'>UPS!</h1>
//         <p class='lead'>En este momento, no hay regsitros de folios capturados el dia de hoy .</p>
//         <hr class='my-4'>
//         <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
     
//       </div>";
//         break;
// }
   $menu->Footer();



    ?>

