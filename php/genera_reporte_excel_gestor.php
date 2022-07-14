<?php 


if (isset($_COOKIE['hol'])) {
    include_once 'ConsultaADR.php';
    $consulta = new ConsultaInfoADR();
    $reporte = $consulta->Reporte_busca_reporte_gestor();
    $nombre_reporte = "Gestor_contris_especificos";
    $consulta->Crear_Excel_Reporte_gestor($reporte,$nombre_reporte);
    exit;
}

?>