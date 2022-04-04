<?php
    require_once 'php/sesion.php';
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
    <div class="mt-5 my-5">
        <h1 class="display-3 text-center">Sistema de Control de Ingresos SAT</h1>

    </div>
    <div class="mt-5  my-5">

    <div class="container mt-5 pt-5">

            <h1 class="display-4 text-center">Mantenimiento de Subadministración</h1>
 
    </div>
    <div class="container pt-4">
        <H1 class="display-4">Registro de Subadministración: </H1>
        <form method="POST">
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Administracion Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="id_admin_1" name="id_admin_1">
                        <option value='0'>Seleccionar Administración</option>
                        <?php
                 include_once 'php/ConsultaADR.php';
                 $consulta = new ConsultaInfoADR();
                 $rows_area = $consulta->Consulta_Local($_SESSION["ses_id_admin"]);
                 for ($i = 0; $i < count($rows_area); $i++) {
                     if ($rows_area[$i]["estatus"] == "A") {
                         echo "<option value='" . $rows_area[$i]["id_admin"] . "'>" . $rows_area[$i]["nombre_admin"] . "</option>";
                     }
                 }
                 ?>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Nombre de la Subadministración</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_area"
                        placeholder=" Ejem: Subadministración de Control y Análisis Estratégico " name="nombre_area">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Nombre de la Subadministración</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_area_c"
                        placeholder=" Ejem: Sub. Ctrl. Y A. E. " name="nombre_area_c">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary"
                        onclick="Registrar_Sub_administracion()">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container pt-4">
        <H1 class="display-4">Actualizar Subadministración: </H1>
        <form method="POST">
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Administracion Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="num_admin" name="num_admin">
                        <option value='0'>Seleccionar Administración</option>
                        <?php
                 include_once 'php/ConsultaADR.php';
                 $consulta = new ConsultaInfoADR();
                 $rows_area = $consulta->Consulta_Local($_SESSION["ses_id_admin"]);
                 for ($i = 0; $i < count($rows_area); $i++) {
                     if ($rows_area[$i]["estatus"] == "A") {
                         echo "<option value='" . $rows_area[$i]["id_admin"] . "'>" . $rows_area[$i]["nombre_admin"] . "</option>";
                     }
                 }
                 ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Subadministración Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="id_sub_admin_b" name="id_sub_admin_b">
                        <option value='0'>Seleccionar Subadministración</option>


                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> Cambio de Nombre de la Subadministración :
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_sub_admin2" name="nombre_sub_admin2">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> Cambio de Nombre corto de la Subadministración :
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_sub_admin2_corto" name="nombre_sub_admin2_corto">
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Estatus: </legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo" id="Estatus_activo"
                                value="A">
                            <label class="form-check-label" for="Estatus_activo">
                                Activa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo" id="Estatus_activo"
                                value="N">
                            <label class="form-check-label" for="Estatus_inactivo">
                                Inactiva
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary"
                        onclick="Actualiza_Sub_administracion()">Actualizar</button>
                </div>
            </div>
        </form>
    </div>



    </div>








<?php

   // se imprime footer
   $menu->Footer();

    ?>
