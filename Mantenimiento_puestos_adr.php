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
    <div class="mt-5 my-5">
        <h1 class="display-4 text-center">Sistema de Control de Ingresos SAT</h1>

    </div>
    <div class="mt-5  my-5">

    <div class="container-fluid mt-5 pt-5">

    </div>
    <div class="container pt-4">
        <H1 class="display-4 text-center">Registro de Puestos ADR: </H1>
        <form action="php/ra_area.php" method="POST">
            <div class="form-group row">
                <label for="inputState" class="col-sm-2 col-form-label">Nombre del Puesto ADR:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_puesto_adr_reg"
                        placeholder=" Ejem: ANALISTA DESCONCENTRADO DEL AREA DE CONTROL Y ANALISIS" name="nombre_puesto_adr_reg" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary" onclick="Registrar_puesto_ADR()">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container pt-4">
    <H1 class="display-4 text-center">Actualizar Puestos ADR: </H1>
    <form action="php/ra_area.php" method="POST">
            <div class="form-group row">
           
                <label for="inputState" class="col-sm-2 col-form-label">Puesto ADR asociado: </label>
                <div class="col-sm-10">
                    <select class="custom-select line" id="id_puesto_adr" name="id_puesto_adr">
                        <option value='0'>Seleccionar Puesto ADR:</option>
                        <?php
                 include_once 'php/MetodosUsuarios.php';
                 $consulta = new MetodosUsuarios();
                 $rows_local = $consulta->Consulta_Puestos_us_insu();
                 for ($i = 0; $i < count($rows_local); $i++) {
                    
                 echo "<option value='" . $rows_local[$i]["id_puesto"] . "'>" . $rows_local[$i]["nombre_puesto"] . "</option>";
                     
                 }
                 ?>

                    </select>
                </div>
            </div>
        
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"> Cambio de Nombre : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_puesto_adr" name="nombre_puesto_adr" value="" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Estado:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo_adr" id="Estatus_activo_adr" value="A"
                                checked>
                            <label class="form-check-label" for="Estatus_activo_adr">
                                Activa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Estatus_activo_adr" id="Estatus_inactivo_adr" value="N">
                            <label class="form-check-label" for="Estatus_inactivo_adr">
                                Inactiva
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-primary" onclick="Actualiza_puesto_ADR()">Actualizar</button>
                    </div>
                </div>
        </form>
    </div>



    </div>









<?php

   // se imprime footer
   $menu->Footer();

    ?>
