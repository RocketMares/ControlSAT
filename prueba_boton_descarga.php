<?php

// if (isset($_POST['trae'])) {
   // Comprobar que existe el documento con esta sentencia, verifica que la existencia de la extencion exista, dentro la permitida, y si existe, descarga
$tipo_doc =['xls','doc','pdf','jpg'];
$no_empleado = '190771';

foreach ($tipo_doc as $extencion) {
    $nombre_archivo = $no_empleado.".".$extencion;
    $path = "img/fotos_empleados/$nombre_archivo";
    if (file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($nombre_archivo));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        ob_clean();
        flush();
        readfile($path);
        exit;
        header("location:Prueba.php?pagina=1");
    }  else {
        $i = 1;
        $errores[]= $i;
        $i++;
        }
    }
if (isset($errores)) {
    header("location:Prueba.php?pagina=1&caso=1");
}


// }


?>