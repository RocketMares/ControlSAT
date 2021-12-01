<?php


    require_once 'php/sesion.php';
    require_once 'php/menu_dinamico.php';
    if (!$_GET ) {
        header('Location:Posisiones.php?pagina=1');
    }

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    $menu->Modal_posisiones();
    ?>
<br>
<div class="container-fluid mt-5 my-5">
    <div class="text-center">
        <h1 class="display-4">Mantenimiento de Posisiones.</h1>
    </div>

</div>
<div class="container-fluid">

    <button class="btn btn-success" id="posision_more"> Agregar Posisión <i class="fas fa-plus"></i>
    </button>
</div>
<div class="container-fluid mt-4 my-4 justify-content-center" id="vista_posisiones">
    <?php
include_once 'php/Vistas_generales.php';
$vista_gen = new vistas();
$muesta = $vista_gen->Tabla_posisiones();

?>

</div>






<?php

   // se imprime footer
   $menu->Footer();

    ?>
<script>
    $(document).ready(function () {

        $('#cerrar_mod_agrega_pososion').on('click', function () {

            var num = <?php echo $num = $_GET['pagina']; ?> ;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?pagina=" + num);
        })
        $('#registra_posison').on('click', function () {
            var num = <?php echo $num = $_GET['pagina']; ?> ;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?pagina=" + num);
        })
        $('#agree_posision_change').on('click', function () {
            var num = <?php echo $num = $_GET['pagina']; ?> ;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?pagina=" + num);
        })
  
        $('#posision_more').on('click', function () {
            $('#Agregar_posisones_nuevas').modal();
        })
        $('#New_Puesto_fump_add').change(function(){
            $('#New_Puesto_fump_add option:selected').each(function(){
                var puest = $(this).val();
                $.post("php/consulta_dat.php",{consulta_clav:puest},function(data){
                    $('#New_clav_puesto_add').val(data);
                })
            })
        })
        $('#pos_Puesto_fump_add').change(function(){
            $('#pos_Puesto_fump_add option:selected').each(function(){
                var puest = $(this).val();
                $.post("php/consulta_dat.php",{consulta_clav:puest},function(data){
                    $('#pos_clav_puesto_add').val(data);
                })
            })
        })
    })
</script>