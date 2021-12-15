<?php
    if (!$_GET ) {
      header('Location:Plantilla_empleados_activos.php?pagina=1');
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




<!-- aqui se depositan los scritps para actualizar las tablas -->
<script>
$(document).ready(function () {
  $('#user_more').on('click', function () {
    $('#agregar_user_insumo').modal();
  });
  $('#act_tabla_inicio').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#registrar_us_ins').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#actualiza_area_asig').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#cerrar_modal_dat_area').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#cerrar_modal_dat_adicio').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#actualiza_dat_adicionales_bot').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#actualiza_dat_adicionales_bot_baja').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_bajas_actualiza.php?pagina=" +num);
  })
  $('#cerrar_mod_actualiza_plazas').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
    limpia_campos_2()
  })
  $('#actualiza_plazas').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_actualizada.php?pagina=" +num);
  })
  $('#act_tabla_inicio_baja').on('click', function () {
    var num = <?php echo $num = $_GET['pagina']; ?> ;
    $('#tabla_activa').load("php/tabla_bajas_actualiza.php?pagina=" +num);
  })
});

</script>
<?php

   // se imprime footer

   echo"
   <div class='modal fade' id='Muestra_modal_cambios_fotos' tabindex='-1' role='dialog' aria-hidden='true'>
 <div class='modal-dialog' role='document'>
   <div class='modal-content'>
     <div class='modal-header'>
       <h5 class='modal-title' id='titulos'>Modal title</h5>
       <button type='button' class='close' data-dismiss='modal'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>
     <div class='modal-body'>
       ...
     </div>
     <div class='modal-footer'>
       <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
       <button type='button' class='btn btn-primary'>Save changes</button>
     </div>
   </div>
 </div>
</div>
   ";

   $menu->Footer();

    ?>