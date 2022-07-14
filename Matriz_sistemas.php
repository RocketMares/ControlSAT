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
<?php

 $perfil = $_SESSION['ses_id_perfil_ing'];


 if ($perfil == 1 || $perfil == 4 || $perfil == 6) {
     echo "
 <div class='container'>
   <button class=' btn btn-outline-dark' type='button' id='Abre_modal_agre_sistema'>Agregar sistema <i class='fas fa-plus' ></i> </button>
 </div>";
 }


?>
<div class="container" id="vista_temp">
 <?php 


include_once 'php/tablas_dinamicas.php';
$tab = new Manda_tabla();
$tab->Matriz_sistemas();





?>


</div>

<script>
  $(document).ready(function(){
    $('#agrega_rol_al_sistema').on('click',function(){
      var pagina = <?php
        switch ($_GET) {
          case isset($_GET['pagina']):
          echo "'pagina'";
          break;

          default:
          echo "'pagina'";
          break;
        }
        
         ?>;
      var num = <?php 
              switch ($_GET) {
                case isset($_GET['pagina']):
                  echo $num = $_GET['pagina'];
                break;
      
                default:
                echo  $num = $_GET['pagina'];
                break;
              }
      ?>;

      $('#vista_temp').load('php/tabal_matriz_datos.php?'+pagina+'='+num);
    })
    $('#cerrar_detalle').on('click',function(){
      var pagina = <?php
        switch ($_GET) {
          case isset($_GET['pagina']):
          echo "'pagina'";
          break;

          default:
          echo "'pagina'";
          break;
        }
        
         ?>;
      var num = <?php 
              switch ($_GET) {
                case isset($_GET['pagina']):
               echo $num = $_GET['pagina'];
                break;
      
                default:
                echo $num = $_GET['pagina'];
                break;
              }
      ?>;

      $('#vista_temp').load('php/tabal_matriz_datos.php?'+pagina+'='+num);
    })
  });

</script>

<?php



  // se imprime footer
  $menu->Footer();


?>