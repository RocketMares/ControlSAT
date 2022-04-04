
<?php
    include_once 'ConsultaADR.php';
    $consulta = new ConsultaInfoADR();
    $nombre_reporte = "Formato_carga_masiva";
    $admins_data = $consulta->Catalogos_archvio_masvio_Administracion();
   
    $consulta->Crear_Exel_carga_masiva_emp($admins_data, $nombre_reporte);
    exit;

?>