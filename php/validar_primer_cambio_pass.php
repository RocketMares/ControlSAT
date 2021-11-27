<?php

if (isset($_POST["Password"]) && isset($_POST["Password_C"])) {
    include_once 'sesion.php';
    $pass = $_POST["Password"];
    $pass2 = $_POST["Password_C"];

    if ($pass == $pass2 && strlen($pass) >= 6) {

        include_once 'MetodosUsuarios.php';
        $usuarios = new MetodosUsuarios();

        $pass_enc = $usuarios->Encriptado_Passwd($pass);
        $actualizar = $usuarios->CambiarContrasenaUser_ses($_SESSION["ses_id_usuario_ing"], $pass_enc);
                    $id_user = $_SESSION["ses_id_usuario_ing"];
                    $user = $_SESSION["ses_rfc_corto_ing"];
					$correo = $_SESSION["ses_correo_ing"];
					$nombre = $_SESSION["ses_nombre_ing"];
                    $id_perfil = $_SESSION["ses_id_perfil_ing"];
                    $id_admin = $_SESSION["ses_id_admin_ing"];
                    $tiempo = $_SESSION["tiempo"];
                    session_destroy();

                    session_start();
					$_SESSION["ses_id_usuario_ing"] = $id_user;
                    $_SESSION["ses_rfc_corto_ing"] = $user;
                    $_SESSION["ses_correo_ing"] = $correo;
                    $_SESSION["ses_nombre_ing"] = $nombre;
                    $_SESSION["ses_id_perfil_ing"] =$id_perfil;
                    $_SESSION["ses_id_admin_ing"] = $id_admin;
                    $_SESSION["tiempo"] = $tiempo;		
                    
        header("location:../index.php");
    
    }else if (strlen($pass) < 6 ) {
        header("location:../Cambio_pass.php?error=1"); 
    }else if ($pass != $pass2){
        header("location:../Cambio_pass.php?error=2");  
    }
}

?>