<?php

if (isset($_POST["ID_USER"]) && isset($_POST["PASS_USER"])) {
    include_once 'MetodosUsuarios.php';
    $users = new MetodosUsuarios();
    $contrasena_default = "e10adc3949ba59abbe56e057f20f883e";
    if (($datos = $users->Consulta_User_Existe(strtoupper($_POST["ID_USER"]))) != null ) {
        $pass_enc = $users->Encriptado_Passwd($_POST["PASS_USER"]);
        if ($datos["passwd"] == $pass_enc) {
            if ($admin = $users->Valida_Admin_Activo($datos["id_admin"])) {
                if ($subadmin = $users->Valida_Subadmin_Activo($datos["id_sub_admin"])) {
                    if ($depto = $users->Valida_Dep_Activo($datos["id_depto"])) {
                        if ($perfil = $users->Valida_Perfil_Activo($datos["id_perfil"])) {
                           if ($pass_enc == $contrasena_default) {
                                session_start();
                                $_SESSION["ses_id_usuario_ing"] = $datos["id_empleado_us"];
                                $_SESSION["ses_rfc_corto_ing"] = $datos["rfc_corto"];
                                $_SESSION["ses_correo_ing"] = $datos["correo"];
                                $_SESSION["ses_nombre_empleado_ing"] = $datos["nombre_empleado"];
                                $_SESSION["ses_id_perfil_ing"] =$datos["id_perfil"];
                                $_SESSION["ses_id_admin_ing"] = $datos["id_admin"];
                                $_SESSION["ses_jefe_directo_ing"] = ($datos["jefe_directo"] != null) ? $datos["jefe_directo"] : $datos["id_empleado"];
                                $_SESSION["ses_cambio_pass_ing"] = "cambiar contraseña";
                                $_SESSION["tiempo"] = time();
                                $_SESSION["estatus_ent_ing"] = 1;
                                $_SESSION["ses_id_puesto_ing"] =$datos["id_puesto"];
                                header('location:../Cambio_pass.php');
                           }else{
                                session_start();
                             
                                $_SESSION["ses_id_usuario_ing"] = $datos["id_empleado_us"];
                                $_SESSION["ses_rfc_corto_ing"] = $datos["rfc_corto"];
                                $_SESSION["ses_correo_ing"] = $datos["correo"];
                                $_SESSION["ses_nombre_empleado_ing"] = $datos["nombre_empleado"];
                                $_SESSION["ses_id_perfil_ing"] =$datos["id_perfil"];
                                $_SESSION["ses_id_admin_ing"] = $datos["id_admin"];
                                $_SESSION["ses_jefe_directo_ing"] = ($datos["jefe_directo"] != null) ? $datos["jefe_directo"] : $datos["id_empleado"];
                                $_SESSION["tiempo"] = time();
                                $_SESSION["estatus_ent_"] = 1;
                                $_SESSION["ses_id_puesto_"] =$datos["id_puesto"];
                                $registro= $users->Reg_SES();
                                $_SESSION["ses_id_sess_ing"] = $registro["id_sess"];
                                $_SESSION["nombre_archivo_ses"] =0;
                                header('location:../index.php');
                               
                           }
                        }else{
                            header('location:../login.php?error=1');
                            echo "El perfil esta inactivo.";
                        }
                    }else{
                        header('location:../login.php?error=2');
                        echo "El departamento esta inactivo.";
                    }
                }else{
                    header('location:../login.php?error=3');
                    echo "La subadminsitración esta inactivo.";
                }
            }else{
                header('location:../login.php?error=4');
                echo "La administración esta inactivo.";
            }
            
        }else{
            header('location:../login.php?error=5');
            echo "Las contraseñas no son iguales";
        }
    }else{
        header('location:../login.php?error=6');
        echo "El usuario no existe.";
    }
}

?>