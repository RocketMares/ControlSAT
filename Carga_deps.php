<?php
    require_once 'php/sesion.php';
    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    // $menu->Menu_vertical();
    ?>




<center>
    <br>
    <div class="mt-5 my-5">
        <h1 class="display-4">Sistema de Control de Ingresos SAT</h1>

    </div>
    <div class="mt-5  my-5">

    <div class="container mt-5 pt-5">

    </div>
    <div class="container pt-4">
        <H1 class="display-4">Registro de Departamentos: </H1>
        <form action="php/ra_area.php" method="POST">
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Administración Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="id_admin" name="id_admin">
                        <option value='0'>Seleccionar Administración</option>
                        <?php
            include_once 'php/MetodosUsuarios.php';
            $consulta = new MetodosUsuarios();
                 $rows_local = $consulta->Consulta_datos_admins();
                 for ($i = 0; $i < count($rows_local); $i++) {
                     if ($rows_local[$i]["estatus"] == "A") {
                         echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                     }
                 }
                 ?>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Subadministración Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="id_sub_admin" name="id_sub_admin">
                        <option value='0'>Seleccionar Subadministración</option>
                        <?php
                 include_once 'php/MetodosUsuarios.php';
                 $consulta = new MetodosUsuarios();
                 $rows_area = $consulta->Consulta_Subadmin_();
                 for ($i = 0; $i < count($rows_area); $i++) {
                     if ($rows_area[$i]["estatus"] == "A") {
                         echo "<option value='" . $rows_area[$i]["id_sub_admin"] . "'>" . $rows_area[$i]["nombre_sub_admin"] . "</option>";
                     }
                 }
                 ?>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Nombre del Departamento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_dep"
                        placeholder=" Ejem:  Control y Analisis Estratejiico" name="nombre_area">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary" onclick="Registrar_departamento()">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container pt-4">
    <H1 class="display-4">Actualizar Departamentos: </H1>
    <form action="php/ra_area.php" method="POST">
            <div class="form-group row">
           
                <label for="inputState" class="col-sm-2 col-form-label">Administración Asociada: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="num_admin" name="num_admin">
                        <option value='0'>Seleccionar Administración</option>
                        <?php
                 include_once 'php/MetodosUsuarios.php';
                 $consulta = new MetodosUsuarios();
                 $rows_local = $consulta->Consulta_datos_admins();
                 for ($i = 0; $i < count($rows_local); $i++) {
                     if ($rows_local[$i]["estatus"] == "A") {
                         echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
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
                <label for="inputState" class="col-sm-2 col-form-label">Departamento Asociado: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="deptos_f" name="deptos_f">
                        <option value='0'>Seleccionar Departamento</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> Cambio de Nombre : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_dep_cam" name="nombre_dep_cam" value="" required>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo" id="Estatus_Activo" value="A"
                                checked>
                            <label class="form-check-label" for="Estatus_Activo">
                                Activa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo" id="Estatus_inactivo" value="N">
                            <label class="form-check-label" for="Estatus_inactivo">
                                Inactiva
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" onclick="Actualiza_departamento()">Actualizar</button>
                    </div>
                </div>
        </form>
    </div>



    </div>







</center>

<?php

   // se imprime footer
   $menu->Footer();

    ?>
