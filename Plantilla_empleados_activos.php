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
<div class="container-fluid mt-5 my-5">
<h1 class="display-4 text-center">Plantilla vigente de empleados.</h1>
</div>


<div class="container-fluid mt-4 my-4 container" >
<button type="button" id="Monstrar" class="btn btn-info">Mostrar Filtros</button>
<button type="button" id="Ocultar" style="display: none;" class="btn btn-primary">Ocultar Filtros</button>
<?php
    switch ($_GET) {
    case isset($_GET['pagina']):
    echo $boton_quita_filtros = "";
    break;
    case isset($_GET['Estructura']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Nombre']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['RFC']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Puestos']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['no_empleado']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
    break;
    case isset($_GET['Stock']):
    echo $boton_quita_filtros = "<button type='button' id='quitar_filtros' data-toggle='tooltip' data-placement='top' title='Regresar a pagina de inicio' class='btn btn-info'><I class='fa fa-house-damage' ></I></button>";
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
  <div class="row container">
  <div class="col-sm-3">
      <label class="input-group-text" for="inputGroupSelect01">Estructura: </label>
      </div>
    <select class="custom-select col-4" id="sub_admin_filtro">
      <option value="0" selected>Selecciona Subadmin</option>
      <?php 
					  include_once "php/MetodosUsuarios.php";
					  $metodo = new MetodosUsuarios();
					  $admin = $metodo->Consulta_Subadmin($_SESSION['ses_id_admin_ing']);
					  for ($i=0; $i < count($admin) ; $i++) { 
						echo" <option value='".$admin[$i]['id_sub_admin']."'>".$admin[$i]['nombre_sub_admin']."</option>";
					  }
					 ?>
    </select>
    <select class="custom-select col-4" id="depto_filtro">
      <option value="0" selected>Selecciona Departamento</option>

    </select>

    <button type="button" class="btn btn-outline-dark" id="filtro_POR_ESTRUCTURA">Ir</button>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por nombre:</label>
        </div>

        <input type="text" class="form-control col-8" id="nombre_buscqueda" placeholder="Buscar por nombre Ejem: ANDRÉS MARES SÁNCHEZ" onkeyup="javascript:this.value=this.value.toUpperCase();">
        <button type="button" class="btn btn-outline-dark" id="filtro_nombre">Ir </button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por RFC corto:</label>
        </div>

        <input type="text" class="form-control col-8" id="FiltroRFC" maxlength="9" placeholder="Ejemplo: MASA955J1" required onkeyup="javascript:this.value=this.value.toUpperCase();">
        <button type="button" class="btn btn-outline-dark" id="filtro_RFC_CORTO">Ir</button>
      </div>
    </div>
    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Filtrar por No. Empleado:</label>
        </div>

        <input type="text" class="form-control col-8" id="id_filtro_no_empleado" maxlength="11" placeholder="Ejemplo: 190772" required  onkeypress='return numero(event)'>
        <button type="button" class="btn btn-outline-dark" id="filtro_no_empleado">Ir</button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Por puesto ADR:</label>
        </div>
        <select class="custom-select col-8" id="puestos_filtros" name="puestos_filtros">
          <option value='0'>Seleccionar Opción</option>
            <?php
             include_once 'php/MetodosUsuarios.php';
             $mu = new MetodosUsuarios();
             $rows_jefes = $mu->Consulta_Cat_Jefes_insumo();
                $rows_puestos = $mu->Consulta_Puestos_us_insu();
                for ($i = 0; $i < count($rows_puestos); $i++) {
                    echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                }
            ?>
        </select>
        <button type="button" class="btn btn-outline-dark" id="filtro_POR_PUESTO">Ir</button>
      </div>
    </div>
    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Filtros Extras:</label>
        </div>
        <select class="custom-select col-8" id="filtros_extras_option" name="filtros_extras_option">
          <option value='0'>Seleccionar Opción</option>
          <option value='1'>Cumpleaños del mes</option>
          <option value='2'>Personal de Base con sindicato seccion V</option>
          <option value='3'>Personal de Base con sindicato seccion XVI</option>
          <option value='4'>Personal de Base Unificado</option>
          <option value='5'>Personal de Confianza</option>
        </select>
        <button type="button" class="btn btn-outline-dark" id="filtro_extra_activos">Ir</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
<?php
$perfil = $_SESSION['ses_id_perfil_ing'];
  if ($perfil == 1 || $perfil == 5 ) {
    echo"<button class='btn btn-success' id='user_more'> Agregar empleado <i class='fas fa-user-plus'></i>
    </button>";
  }

?>
  </div>


<div class="container-fluid" id="tabla_activa" > 
  <?php
    include_once "php/tablas_dinamicas.php";
    $tablas = new Manda_tabla();
    $tablas->Tabla_usuarios_activos();
    ?>



</div>



<!-- aqui se depositan los scritps para actualizar las tablas -->
<script>
  
function Genera_doc_excel()

{
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
          
 
  $.fileDownload("php/genera_reportes.php?"+pagina) 
   .done(function () {
      alert('File download a success!'); 
    }) 
   .fail(function (data) {
      alert(data); 
    });  
}
  $(document).ready(function () {
    $('#user_more').on('click', function () {
      $('#agregar_user_insumo').modal();
    });
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
      case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
          echo"'Stock'";
          break;
        default:
        echo "'pagina'";
        break;
      }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
      case isset($_GET['no_empleado']):
      echo $num= $_GET['no_empleado'];
      break;
      case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
          echo"'Stock'";
          break;
        default:
        echo "'pagina'";
        break;
      }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
      case isset($_GET['no_empleado']):
      echo $num= $_GET['no_empleado'];
      break;
      case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
          echo"'Stock'";
          break;
        default:
        echo "'pagina'";
        break;
     
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
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
        case isset($_GET['no_empleado']):
        echo $num= $_GET['no_empleado'];
        break;
        case isset($_GET['Stock']):
        echo $num= $_GET['Stock'];
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
        case isset($_GET['no_empleado']):
        echo"'no_empleado'";
        break;
        case isset($_GET['Stock']):
        echo"'Stock'";
        break;
        default:
        echo "'pagina'";
        break;
        }
      ?>;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+pagina+"=" + num);
    })
  });
</script>
<?php

   // se imprime footer


   $menu->Footer();

    ?>