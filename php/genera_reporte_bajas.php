<?php

 if (isset($_GET)) {
    include_once 'ConsultaADR.php';
    $consulta = new ConsultaInfoADR();
    $reporte = $consulta->Reporte_Plantilla_filtrada_bajas();
    switch ($_GET) {
        case isset($_GET['pagina']):
            $nombre_reporte = "Reporte_general_bajas";
        break;
        case isset($_GET['Estructura']):
            $nombre_reporte = "Reporte_por_estructura_bajas";
        break;
        case isset($_GET['Nombre']):
            $nombre_reporte = "Reporte_por_coincidencia_de_nombres_bajas";
        break;
        case isset($_GET['RFC']):
            $nombre_reporte = "Reporte_por_RFC_bajas";
        break;
        case isset($_GET['Puestos']):
            $nombre_reporte = "Reporte_por_puestos_funcionales_bajas";
        break;
        case isset($_GET['no_empleado']):
            $nombre_reporte = "Reporte_No_empleado_bajas";
        break;
        case isset($_GET['Stock']):
            $nombre_reporte = "Reporte_por_filtros_especiales_bajas";
        break;
        case isset($_GET['fecha_baja']):
        $nombre_reporte = "Reporte_por_filtros_fecha_bajas_bajas";
        break;
        default:
        $nombre_reporte = "Reporte_general_bajas";
        break;
        }

    $consulta->Crear_Excel_Reporte_filtro($reporte,$nombre_reporte);
    exit;
 }


?>