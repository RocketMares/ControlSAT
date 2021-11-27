<?php

if (isset($_POST['datos'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $datos = json_decode($_POST['datos']);
    $accion = $metodos->Registra_usuario_insumo($datos);   
    $num_empleado = $_SESSION['nombre_archivo_ses'] = $datos->num_empleado;
    echo $accion;
}

if (isset($_FILES['archvioID'])) {
    include_once 'sesion.php';
    $nombre_archivo = $_FILES['archvioID']['name'];
    $tipo_archivo = $_FILES['archvioID']['type'];
    $nombre_temp_archivo = $_FILES['archvioID']['tmp_name'];
    $tamano_archivo = $_FILES['archvioID']['size'];
    $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
    $Carpeta = "../img/fotos_empleados/";
    $nombre_archivo_emp = $_SESSION['nombre_archivo_ses'].$ext_archivo;

    if (move_uploaded_file($nombre_temp_archivo, $Carpeta.$nombre_archivo_emp)) {
        echo "El archivo ha sido cargado correctamente.";
    } else {
        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
    }

}

?>