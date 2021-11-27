<?php 
include_once 'php/sesion.php';
include_once 'php/menu_dinamico.php';
$menu = new Menu();

$menu->cabecera_principal();

$menu->Crear_menu();
 $menu->Modal_insert_modf_usuarios();
?>

<!-- Aqui puedes incluir lo que quieras -->


<div id="main">

    <!-- contenedor general -->
    <div class="container-fluid" style="padding-top: 3rem !important;">
        <?php
    ?>
        <!-- Segundo elemento -->
        <div class="container-fluid" id="main">
            <div class="container text-center py-2">
                <h1 class="display-4 mb-2">Administración de Usuarios</h1>
            </div>
            <?php
        include_once 'php/vistas_Plantilla.php';
        include_once 'php/MetodosUsuarios.php';
        $consulta = new VistasPlantilla();
        $mu = new MetodosUsuarios();
        $rows_sub = $consulta->Consulta_Sub($_SESSION["ses_id_admin_ing"]);
        $rows_administracion = $consulta->Consulta_Local();
        ?>

            <div class="form-inline justify-content-center mb-2">
                <input type="text" class="form-control mr-sm-2 letras" id="nombre_b" name="nombre" placeholder="Nombre"
                    required onkeyup="javascript:this.value=this.value.toUpperCase();">

                <select class="custom-select" id="num_admin" name="num_admin">
                    <option value='0'>Seleccionar Administración</option>
                    <?php
                for ($i = 0; $i < count($rows_administracion); $i++) {
                    if ($rows_administracion[$i]["estatus"] == "A") {
                        echo "<option value='" . $rows_administracion[$i]["id_admin"] . "'>" . $rows_administracion[$i]["nombre_admin"] . "</option>";
                    }
                }
                ?>
                </select>
                <select class="custom-select mr-sm-2 col-sm-3" id="id_sub_admin_b" name="id_sub_admin_b">
                    <option value='0'>Seleccionar subadministración</option>

                </select>
                <select class="custom-select mr-sm-2" id="deptos_f" name="deptos_f">
                    <option value='0'>Seleccionar departamento</option>

                </select>
                <select class="custom-select mr-sm-2" id="perfil_b" name="perfil_b">
                    <option value='0'>Seleccionar perfil</option>
                    <?php

                $rows_perfil = $mu->Consulta_Perfiles();
                for ($i = 0; $i < count($rows_perfil); $i++) {
                    if ($rows_perfil[$i]["estatus"] == "A") {
                        echo "<option value='" .  $rows_perfil[$i]["id_perfil"] . "'>" .  $rows_perfil[$i]["nombre_perfil"] . "</option>";
                    }
                }
                ?>
                </select>
                <button type="submit" class="btn btn-primary mr-sm-2" onclick="filtros_users()">Buscar</button>


            </div>


            <div id="tabla_uuarios" class="container-fluid">
                <div class='card'>
                    <div class='card-header'>
                        <div class="d-flex bd-highlight">
                            <div class="mr-auto p-2 bd-highlight">
                                <p class="lead">Listado de usuarios</p>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button type="submit" id="agregar_user" class="btn btn-primary"><i
                                        class="fas fa-user-plus"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class='card-body'>
                        <?php
                    switch (isset($_GET)) {
                        case isset($_GET["usuarios"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->Vista_General();
                            break;

                        case isset($_GET["por_nombre"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_nombre();
                            break;

                        case isset($_GET["por_nomb_sub"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_nombre_sub();
                            break;

                        case isset($_GET["por_nomb_sub_dep"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_nombre_sub_dep();
                            break;

                        case isset($_GET["por_nomb_sub_dep_per"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_nombre_sub_dep_per();
                            break;

                        case isset($_GET["por_sub"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_sub();
                            break;

                        case isset($_GET["por_sub_dep"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_sub_dep();
                            break;

                        case isset($_GET["por_perfil"]):
                            include_once 'php/vista_conf_usuarios.php';
                            $vista_conf = new Conf_Users();
                            $vista_conf->vista_por_perfil();
                            break;

                        default:
                            echo "<script>
                                    location.href='usuarios_ingresos.php?usuarios=1';
                                  </script>";
                            break;
                    }



                    ?>
                    </div>
                </div>

            </div>


        </div>


    </div>

</div>
<!-- Inicio Modals -->







<!-- <script src="js/scripts_user.js"></script> -->
<?php

$menu->Footer();

if (isset($_GET["caso"])) {
    if ($_GET["caso"] == 1) {
        echo "<scirpt>
                alert(\"El usuario se registro exitosamente, recuerde que la contraseña por defecto es: 123456.\")
                </scirpt>";
    } else if ($_GET["caso"] == 2) {
        echo "<scirpt>
                alert(\"El nombre de usuario ya existe vinculado a otro RFC corto.\")
                </scirpt>";
    } else if ($_GET["caso"] == 3) {
        echo "<scirpt>
                alert(\"El RFC Corto ya existe\")
                </scirpt>";
    }
}
?>