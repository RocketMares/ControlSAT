<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PRUEBA RFC CORTO</title>
  </head>
  <body>
<div class="container-fluid">
<button class="btn btn-danger" id="descarga" type="submit" >Descarga</button>
<button class="btn btn-danger" id="manda_responsiva" type="submit" >resp</button>
</div>
<?php
switch (ISSET($_GET['caso'])) {
    case 1:
        
    echo"<script>
 alert('no hay nada')
    </script>
<!--     <div class='alert alert-danger' role='alert'>
    No tiene documento
   </div>-->";
    break;
    
    default:
    echo"";
        break;
}

?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $('#mandar').on('click',function(){
           var datos = $('#RFC_COMP').val();
            $.ajax({
                type:'POST',
                dataType: 'html',
                url:"algoritmo.php",
                data:{RFC:datos},
              
            }).done(function(respuesta){
                $('#RFC_CORTO').html(respuesta);
            })
        })
        $('#descarga').on('click',function(){
           
                location.href ="Prueba_boton_descarga.php";
               
        })
        $('#manda_responsiva').on('click',function(){
           
           url='php/Resp.php?id_usuario=2';
           window.open(url);
        })
    });

</script>
</body>
</html>

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
</div>




<div class="col-md-8 col-sm-12  container-fluid" style="display: none;" id="filtros_reg">

  <p class="h5"> Filtros de busqueda.</p>
  <div class="py-3 text-center flex-colun justify-content-center align-items-center">
  <div class="row  container-fluid">
          <label class="input-group-text col-md-3" for="inputGroupSelect01">Estructura: </label>
     
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

        <input type="text" class="form-control col-8" placeholder="Buscar por nombre Ejem: ANDRÉS MARES SÁNCHEZ">
        <button type="button" class="btn btn-outline-dark" id="filtra_oficio">Ir </button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-3">
          <label class="input-group-text" for="inputGroupSelect01"> Folio Gestor:</label>
        </div>

        <input type="text" class="form-control col-8" id="FiltroGestor" placeholder="Ejemplo: 2021001234-0"
          data-inputmask="'Mask':'9999999999-9'" required>
        <button type="button" class="btn btn-outline-dark" id="filtra_Gestor_wb">Ir</button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> No. Determinante:</label>
        </div>

        <input type="text" class="form-control col-8" id="FiltroDet" placeholder="Ejemplo: COND11/2021"
          onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
        <button type="button" class="btn btn-outline-dark" id="filtra_por_deter">Ir</button>
      </div>
    </div>

    <div class="row">
      <div class="input-group col-md-12">
        <div class="col-sm-4">
          <label class="input-group-text" for="inputGroupSelect01"> Por prioridad:</label>

        </div>
        <select class="custom-select" id="prioridad" name="prioridad">
          <option value='0'>Seleccionar Opción</option>
          <option value='1'>Mas de 4 dias sin ingresar la fecha notificación desde su alta.</option>
          <option value='2'>Mas de 16 dias sin ingresar la fecha notificacíon desde su alta.</option>
        </select>
        <button type="button" class="btn btn-outline-dark" id="filtra_por_prioridades">Ir</button>
      </div>
    </div>


  </div>

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
      var num = <?php 
      switch ($_GET) {
      case isset($_GET['pagina']) :
      echo $num = $_GET['pagina']; 
      break;
      case isset($_GET['Estructura']) :
      echo $num = $_GET['Estructura']; 
      break;
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      var pagina = <?php 
        switch ($_GET) {
        case isset($_GET['pagina']):
        echo "pagina";
        break;
        case isset($_GET['Estructura']):
        echo"Estructura";
        break;
        default:
        echo "pagina";
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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
      default:
      echo $num = $_GET['pagina']; 
      break;
      }
      ?> ;
      $('#tabla_activa').load("php/tabla_actualizada.php?"+<?php 
        switch ($_GET) {
        case isset($_GET['pagina']):

        echo   $nombre_get = "pagina";
        break;
        case isset($_GET['Estructura']):

        echo   $nombre_get = "Estructura";
        break;
        default:

        echo $nombre_get = "pagina";
        break;
        }
      ?>+"=" + num);
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