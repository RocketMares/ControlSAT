<?php

if (isset($_POST['datos'])) {
    include_once "sesion.php";
    $datos = $_POST['datos'];
    $admin = $_SESSION['ses_id_admin_ing'];
    $sub = $datos['sub'];
    include_once "MetodosUsuarios.php";
    $metodos = new MetodosUsuarios();
    $sub = $metodos->Consulta_Depto_filtro($admin,$sub);
    echo"    <option value='0' selected>Selecciona Departamento</option>";
    for ($i=0; $i < count($sub) ; $i++) { 
        echo" <option value='".$sub[$i]['id_depto']."'>".$sub[$i]['nombre_depto']."</option>";
    }

}




?>