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
    // $menu->Menu_vertical();
    ?>





<br>
<div class=" mt-5 my-5">

    <h1 class="display-3 text-center">Mantenimiento Administración</h1>

</div>


<div class="mt-5   container-fluid my-5 ">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <h3 class="display-9 text-center">Registro de Administración</h3>
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-5">
                        <label for="validationCustom01">Nombre de la Administración</label>
                        <input type="text" class="form-control" id="nom_Admin_reg" name="nom_Admin_reg"
                            placeholder="Administración Desconcentrada de Recaudación" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <label for="validationCustom02">Unidad</label>
                        <input type="text" class="form-control" id="unidad_admin_reg" maxlength="5" onkeypress='return numero(event)' name="unidad_admin_reg" placeholder="437" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="validationCustomUsername">Abreviatura</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="abrev_admin_reg" name="abrev_admin_reg" placeholder="ADR DF4"
                                aria-describedby="inputGroupPrepend" required
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-6 mb-3">
                        <label for="validationCustom03">Domicilio</label>
                        <input type="text" class="form-control" id="direccion_admin_reg" name="direccion_admin_reg"
                            placeholder="AV.San Lorenzo N# Col.# C.P #" required
                            onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="validationCustom04">Telefono General</label>
                        <input type="text" class="form-control" onkeypress='return numero(event)' id="admin_telefono_reg" name="admin_telefono_reg" placeholder="Tel. 5635868"
                            required maxlength="10">
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                </div>
              
                <button class="btn btn-primary" type="button" onclick="valida_datos_reg_admin()">Registrar Administracion</button>
            </form>
        </div>
        <div class="col-sm-6">
            <h3 class="display-9 text-center">Actualizar Administración</h3>

            <div class="col-12">
                <select class="custom-select custom-select-sm" id="selecciona_admmin">
                    <option value="0" selected>Selecciona Administración</option>
                    <?php
                            include_once 'php/MetodosUsuarios.php';
                            $metodos = new MetodosUsuarios();
                            $datos_ad = $metodos->Consulta_datos_admins();
                            for ($i=0; $i < count($datos_ad) ; $i++) { 
                            echo" <option value='".$datos_ad[$i]['id_admin']."'>".$datos_ad[$i]['nombre_admin']."</option>";
                            }

                        ?>
                </select>
            </div>
            <br>
            <form class="needs-validation" id="formulatio_actualiza_admin" novalidate >
                <div class="form-row">
                    <div class="col-sm-5">
                        <label  for="validationCustom01">Nombre de la Administración</label>
                        <input type="text" class="form-control" id="nombre_admin_act" name="nombre_admin_act"
                            placeholder="Administración Desconcentrada de Recaudación" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <label for="validationCustom02">Unidad</label>
                        <input type="text" class="form-control" onkeypress='return numero(event)' name="unidad_act" id="unidad_act" placeholder="437" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="validationCustomUsername">Abreviatura</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="Abreb_act" id="Abreb_act" placeholder="ADR DF4"
                                aria-describedby="inputGroupPrepend" required
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-6">
                        <label for="validationCustom03">Dirección</label>
                        <input type="text" class="form-control" id="direc_act" name="direc_act"
                            placeholder="AV.San Lorenzo N# Col.# C.P #" required
                            onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="validationCustom04">Telefono General</label>
                        <input type="text" class="form-control" id="telefono_admin1" onkeypress='return numero(event)' name="telefono_admin1" placeholder="Tel. 5635868" required>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="form-check">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="A" id="estatus_admin_act"
                                name="estatus_admin_baj" required checked>
                            <label class="custom-control-label" for="estatus_admin_act">Activa</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" value="N" id="estatus_admin_baj"
                                name="estatus_admin_baj" required>
                            <label class="custom-control-label" for="estatus_admin_baj">Baja</label>
                            <div class="invalid-feedback">More example invalid feedback text</div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="button" onclick="valida_datos_Act_admin()">Actualizar datos</button>
            </form>
        </div>
    </div>







</div>








<?php

   // se imprime footer
   $menu->Footer();

    ?>
