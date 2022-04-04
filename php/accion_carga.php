<?php

if (isset($_POST["USU1"])) {
    //echo "hola";
     if ($_POST["USU1"] == 1) {
         include_once 'ConsultaADR.php';
         $contrib = new ConsultaInfoADR();
         $contrib->Insertar_Usuarios();
     }elseif ($_POST["USU1"] == 2) {
        include_once 'sesion.php';
        $id_user = $_SESSION["ses_id_usuario_ing"];
        $ruta = "../temp_files/carga_nueva$id_user.xlsx";
        unlink($ruta);
        echo "Carga cancelada.";
     }

}



?>