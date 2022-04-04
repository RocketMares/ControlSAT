<?php

    require_once 'php/menu_dinamico.php';
    $perfil= $_SESSION['ses_id_perfil_ing'];
    if ($perfil != 1) {
        header('location:index.php');
    }


    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();




?>
<br>
<div class="container-fluid mt-5 pt-5">

    <div>
        <h1 class="display-4 text-center">Carga masiva de usuarios de plantilla</h1>
    </div>

    <div class="d-flex justify-content-center align-items-center " >

<?php

if (isset($_GET["resultado"])) {
    switch ($_GET["resultado"]) {
        case 1:
        $class_form = "";
        $class_mensaje = "valid-feedback";
        $mensaje_error = "Archivo permitido.";
        $input = "is-valid";
        break;

        case 2:
            $class_form = "was-validated vh-100";
            $class_mensaje = "invalid-feedback";
            $mensaje_error = "No se selecciono ningun archivo, favor de selecionarlo.";
        break;

        case 3:
        $class_form = "was-validated vh-100";
        $class_mensaje = "invalid-feedback";
        $mensaje_error = "Debe de elegir un archivo de excel con extensión <strong>\".xlsx\"</strong>.";
        break;

        case 4:
            $class_form = "was-validated vh-100";
            $class_mensaje = "invalid-feedback";
            $mensaje_error = "El archivo es demasiado pesado para cargarse, debe de pesar menos de 1000 MB.";
        break;
    
        
    }
}

?>

    <div class="container text-center ">
        <form class="<?php echo (isset($class_form)) ? $class_form : 'vh-100'; ?>" action="php/valida_carga_usuarios.php" enctype="multipart/form-data"  method="post">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="archivito" name ="archivito" required>
                <label class="custom-file-label <?php echo (isset($input)) ? $input : ''?>" for="archivo_cont">Seleccionar archivo de carga masiva. (xlsx).</label>
                <div class="<?php echo (isset($class_mensaje)) ? $class_mensaje : ''; ?>"><?php echo (isset($mensaje_error)) ? $mensaje_error : ''; ?></div>
                <a type="submit" class="btn btn-dark text-white" onclick="Genera_doc_excel_Carga_masiva_ejemplo()"  >Descarga formato de carga masiva de empleados.</a> 
            </div>
            <button class="btn btn-dark btn_sat_black text-white btn-lg" type="submit">Cargar archivo.</button>
        </form>

        <div class="container" id="resultado">

            <?php
             if (isset($_GET["resultado"])) {
                 switch ($_GET["resultado"]) {
                   case 1:
                    include_once 'php/ConsultaADR.php';
                    $contribuyentes = new ConsultaInfoADR();
                    $contribuyentes->Leer_archivo_usuarios();
                   break;
                }
             }

            ?>

        </div>


    </div>



</div>



</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" id="texto_result" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div id='resultado_carga'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php

   // se imprime footer
$menu->Footer();

?>