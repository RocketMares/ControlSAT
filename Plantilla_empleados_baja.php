<?php
    if (!$_GET ) {
        header('Location:Plantilla_empleados_baja.php?pagina=1');
    }
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
    <h1 class="display-4 text-center">Plantilla empleados en estado de Baja, comision y Laudos registrados.</h1>
</div>





<div class="container-fluid" id="tabla_activa">
    <?php
    include_once "php/tablas_dinamicas.php";
    $tablas = new Manda_tabla();
    $tablas->Tabla_usuarios_baja_comision_suspen_laudos();
    ?>



</div>




<script>
  $(document).ready(function () {
    
    $('#act_tabla_inicio').on('click', function () {
      var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#registrar_us_ins').on('click', function () {
                var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#actualiza_area_asig').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#cerrar_modal_dat_area').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#cerrar_modal_dat_adicio').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#actualiza_dat_adicionales_bot').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#actualiza_dat_adicionales_bot_baja').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#cerrar_mod_actualiza_plazas').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
      limpia_campos_2()
    })
    $('#actualiza_plazas').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
    $('#act_tabla_inicio_baja').on('click', function () {
                            var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      case isset($_GET['Nombre']) :
      echo $num = $_GET['Nombre']; 
      break;
      case isset($_GET['RFC']) :
      echo $num = $_GET['RFC']; 
      break;
      case isset($_GET['Puestos']) :
      echo $num = $_GET['Puestos']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
     var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "'pagina'";
        break;
        case isset($_GET['Estructura']):
        echo"'Estructura'";
        break;
        case isset($_GET['Nombre']):
        echo"'Nombre'";
        break;
        case isset($_GET['RFC']):
        echo"'RFC'";
        break;
        case isset($_GET['Puestos']):
        echo"'Puestos'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_bajas_actualiza.php?"+pagina+"=" + num);
    })
  });
</script>
<?php

   // se imprime footer



   // se imprime footer
   $menu->Footer();

    ?>