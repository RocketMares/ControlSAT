<?php


    require_once 'php/sesion.php';
    require_once 'php/menu_dinamico.php';
    if (!$_GET ) {
        header('Location:Posisiones.php?pagina=1');
    }
    $perfil= $_SESSION['ses_id_perfil_ing'];
    if ($perfil == 1 || $perfil == 4 || $perfil == 5 ) {
        
    }
    else{
        header('location:index.php');
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
        <h1 class="display-4">Mantenimiento de Posiciones.</h1>
    </div>

</div>
<div class="container-fluid mt-4 my-4 container" >
<button type="button" id="Monstrar" class="btn btn-info">Mostrar Filtros <i class='fas fa-bars' ></i> </button>

<?php
    switch ($_GET) {
    case isset($_GET['pagina']):
    echo $boton_quita_filtros = "";
    break;
    case isset($_GET['Cod_puesto']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros2' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Nivel']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros2' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Pos_gerente']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros2' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Posision']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros2' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Stock']):
      echo $boton_quita_filtros = "<button type='button' id='quitar_filtros2' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
      break;
    default:
    echo $boton_quita_filtros = "";
    break;
}
?>
</div>




<div class="col-md-8 col-sm-12  container-fluid" style="display: none;" id="filtros_reg">

  <p class="h5"> Filtros de busqueda.</p>
  <div class="py-3 text-center flex-colun justify-content-center align-items-center">
  <div class="row  container-fluid">
  <label class="input-group-text col-md-3" for="inputGroupSelect01">Selecciona puesto FUMP: </label>
     
    <select class="custom-select col-8" id="puesto_fump_filtro">
      <option value="0" selected>Selecciona Puesto FUMP</option>
      <?php 
					  include_once "php/ConsultaADR.php";
					  $metodo = new ConsultaInfoADR();
					  $admin = $metodo->Consulta_Puestos_Fun();
					  for ($i=0; $i < count($admin) ; $i++) { 
						echo" <option value='".$admin[$i]['id_puesto_fump']."'>(".$admin[$i]['clave_puesto'].") ".$admin[$i]['nombre_puesto']."</option>";
					  }
					 ?>
    </select>
    <button type="button" class="btn btn-outline-dark" id="filtro_cod_puesto">Ir</button>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por Nivel:</label>
        </div>

        <select class="custom-select col-8" id="Nivel_select">
      <option value="0" selected>Selecciona Nivel Posición</option>
      <?php 
					  include_once "php/ConsultaADR.php";
					  $metodo = new ConsultaInfoADR();
					  $admin = $metodo->Consulta_Plazas_nivles();
					  for ($i=0; $i < count($admin) ; $i++) { 
						echo" <option value='".$admin[$i]['nivel']."'>".$admin[$i]['nivel']."</option>";
					  }
					 ?>
    </select>
        <button type="button" class="btn btn-outline-dark" id="filtro_nivel">Ir </button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por Posición Gerente:</label>
        </div>

        <select class="custom-select col-8" id="posision_gerente_busc">
      <option value="0" selected>Selecciona Posición Gerente</option>
      <?php 
					  include_once "php/ConsultaADR.php";
					  $metodo = new ConsultaInfoADR();
					  $admin = $metodo->Consulta_Plazas_Gerentes();
					  for ($i=0; $i < count($admin) ; $i++) { 
						echo" <option value='".$admin[$i]['posision_jefe']."'>".$admin[$i]['posision_jefe']."</option>";
					  }
					 ?>
    </select>
        <button type="button" class="btn btn-outline-dark" id="Posision__gerente_filtro">Ir</button>
      </div>
    </div>
    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por No. Posición:</label>
        </div>

        <input type="text" class="form-control col-8" id="posiscion_busc" maxlength="11" placeholder="Ejemplo: 1033456" required  onkeypress='return numero(event)'>
        <button type="button" class="btn btn-outline-dark" id="Posision__filtro">Ir</button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> Filtros extras:</label>

        </div>
        <select class="custom-select" id="filtros_extra_select" name="filtros_extra_select">
          <option value='0'>Seleccionar Opción</option>
          <option value='1'>Seleccionar en estado de Vacantes</option>
          <option value='2'>Seleccionar en estado de Ocupante Activo</option>
          <option value='3'>Seleccionar Laudos</option>
          <option value='4'>Seleccionar en estado de Suspención</option>
          <option value='5'>Seleccionar en estado de Comisión Sindical</option>
          <option value='6'>Seleccionar en estado de Comisión SGS</option>
        </select>
        <button type="button" class="btn btn-outline-dark" id="filtro_extra">Ir</button>
      </div>
    </div>


  </div>

</div>
<div class="container">

    <button class="btn btn-success" id="posision_more"> Agregar Posisión <i class="fas fa-plus"></i>
    </button>
</div>
<div class="container mt-4 my-4 justify-content-center" id="vista_posisiones">
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

            var num = <?php  switch ($_GET) {
            case isset($_GET['pagina']):
            echo  $num =$_GET['pagina'];
            break;
            case isset($_GET['Cod_puesto']):
            echo $num= $_GET['Cod_puesto'];
            break;
            case isset($_GET['Nivel']):
                echo $num= $_GET['Nivel'];
            break;
            case isset($_GET['Pos_gerente']):
                echo $num= $_GET['Pos_gerente'];
            break;
            case isset($_GET['Posision']):
                echo $num= $_GET['Posision'];
            break;
            case isset($_GET['Stock']):
                echo $num= $_GET['Stock'];
            break;
            default:
            echo  $num =$_GET['pagina'];
            break;
        }
        ?>;
            var pagina = <?php switch ($_GET) {
            case isset($_GET['pagina']):
            echo "'pagina'";
            break;
            case isset($_GET['Cod_puesto']):
            echo"'Cod_puesto'";
            break;
            case isset($_GET['Nivel']):
            echo"'Nivel'";
            break;
            case isset($_GET['Pos_gerente']):
            echo"'Pos_gerente'";
            break;
            case isset($_GET['Posision']):
            echo"'Posision'";
            break;
            case isset($_GET['Stock']):
            echo"'Stock'";
            break;
            default:
            echo "'pagina'";
            break;
        }?>;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?"+pagina+"=" + num);
        })
        $('#registra_posison').on('click', function () {
            var num = <?php  switch ($_GET) {
            case isset($_GET['pagina']):
            echo  $num =$_GET['pagina'];
            break;
            case isset($_GET['Cod_puesto']):
            echo $num= $_GET['Cod_puesto'];
            break;
            case isset($_GET['Nivel']):
                echo $num= $_GET['Nivel'];
            break;
            case isset($_GET['Pos_gerente']):
                echo $num= $_GET['Pos_gerente'];
            break;
            case isset($_GET['Posision']):
                echo $num= $_GET['Posision'];
            break;
            case isset($_GET['Stock']):
                echo $num= $_GET['Stock'];
            break;
            default:
            echo  $num =$_GET['pagina'];
            break;
        }
        ?>;
            var pagina = <?php switch ($_GET) {
            case isset($_GET['pagina']):
            echo "'pagina'";
            break;
            case isset($_GET['Cod_puesto']):
            echo"'Cod_puesto'";
            break;
            case isset($_GET['Nivel']):
            echo"'Nivel'";
            break;
            case isset($_GET['Pos_gerente']):
            echo"'Pos_gerente'";
            break;
            case isset($_GET['Posision']):
            echo"'Posision'";
            break;
            case isset($_GET['Stock']):
            echo"'Stock'";
            break;
            default:
            echo "'pagina'";
            break;
        }?>;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?"+pagina+"=" + num);
        })
        $('#agree_posision_change').on('click', function () {
            var num = <?php  switch ($_GET) {
            case isset($_GET['pagina']):
            echo  $num =$_GET['pagina'];
            break;
            case isset($_GET['Cod_puesto']):
            echo $num= $_GET['Cod_puesto'];
            break;
            case isset($_GET['Nivel']):
                echo $num= $_GET['Nivel'];
            break;
            case isset($_GET['Pos_gerente']):
                echo $num= $_GET['Pos_gerente'];
            break;
            case isset($_GET['Posision']):
                echo $num= $_GET['Posision'];
            break;
            case isset($_GET['Stock']):
                echo $num= $_GET['Stock'];
            break;
            default:
            echo  $num =$_GET['pagina'];
            break;
        }
        ?>;
            var pagina = <?php switch ($_GET) {
            case isset($_GET['pagina']):
            echo "'pagina'";
            break;
            case isset($_GET['Cod_puesto']):
            echo"'Cod_puesto'";
            break;
            case isset($_GET['Nivel']):
            echo"'Nivel'";
            break;
            case isset($_GET['Pos_gerente']):
            echo"'Pos_gerente'";
            break;
            case isset($_GET['Posision']):
            echo"'Posision'";
            break;
            case isset($_GET['Stock']):
            echo"'Stock'";
            break;
            default:
            echo "'pagina'";
            break;
        }?>;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?"+pagina+"=" + num);
        })
        $('#cerrar_mod_change_posis').on('click', function () {
            var num = <?php  switch ($_GET) {
            case isset($_GET['pagina']):
            echo  $num =$_GET['pagina'];
            break;
            case isset($_GET['Cod_puesto']):
            echo $num= $_GET['Cod_puesto'];
            break;
            case isset($_GET['Nivel']):
                echo $num= $_GET['Nivel'];
            break;
            case isset($_GET['Pos_gerente']):
                echo $num= $_GET['Pos_gerente'];
            break;
            case isset($_GET['Posision']):
                echo $num= $_GET['Posision'];
            break;
            case isset($_GET['Stock']):
                echo $num= $_GET['Stock'];
            break;
            default:
            echo  $num =$_GET['pagina'];
            break;
        }
        ?>;
            var pagina = <?php switch ($_GET) {
            case isset($_GET['pagina']):
            echo "'pagina'";
            break;
            case isset($_GET['Cod_puesto']):
            echo"'Cod_puesto'";
            break;
            case isset($_GET['Nivel']):
            echo"'Nivel'";
            break;
            case isset($_GET['Pos_gerente']):
            echo"'Pos_gerente'";
            break;
            case isset($_GET['Posision']):
            echo"'Posision'";
            break;
            case isset($_GET['Stock']):
            echo"'Stock'";
            break;
            default:
            echo "'pagina'";
            break;
        }?>;
            $('#vista_posisiones').load("php/tablas_dinamicas_posisiones.php?"+pagina+"=" + num);
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