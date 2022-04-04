
<?php


if (isset($_COOKIE['Carpeta']) && isset($_COOKIE['nombre_doc']) ) {
    $carpeta = $_COOKIE['Carpeta'];
    $nombre_documento = $_COOKIE['nombre_doc'];
     
    $extenciones =['.pdf','.zip','.xlsx','.docs'];
     //echo $path;
    foreach ($extenciones as $ext) {
        $path = '../formatos/'.$carpeta.'/'.$nombre_documento.$ext;
    if (file_exists($path)) {

        //echo "El documento si existe y si esta (".$path.")";
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($nombre_documento.$ext));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        ob_clean();
        flush();
        readfile($path);
        exit;
    }
    else {
        echo "El documento no existe y no esta (".$path.")";
    }
    }
     
    //header('location:../Plantilla_empleados_activos.php?Estructura=1');
}
   

else {
    header('location:../Plantilla_empleados_activos.php?pagina=1');
}

if (isset($_COOKIE['Carpeta']) && isset($_COOKIE['Num_sistema']) ) {
    $carpeta = $_COOKIE['Carpeta'];
    $nombre_documento = $_COOKIE['nombre_doc'];
     
    $extenciones =['.pdf','.zip','.xlsx','.docs'];
     //echo $path;
    foreach ($extenciones as $ext) {
        $path = '../'.$carpeta.'/'.$nombre_documento.$ext;
    if (file_exists($path)) {

        //echo "El documento si existe y si esta (".$path.")";
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($nombre_documento.$ext));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        ob_clean();
        flush();
        readfile($path);
        exit;
    }
    else {
        echo "El documento no existe y no esta (".$path.")";
    }
    }
     
    //header('location:../Plantilla_empleados_activos.php?Estructura=1');
}
   

else {
    header('location:../Matriz_sistemas.php?pagina=1');
}


?>

 
