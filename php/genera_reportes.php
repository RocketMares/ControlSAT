<?php

 if (isset($_GET)) {
    include_once 'ConsultaADR.php';
    $consulta = new ConsultaInfoADR();
    $reporte = $consulta->Reporte_Plantilla_filtrada();
    switch ($_GET) {
        case isset($_GET['pagina']):
            $nombre_reporte = "Reporte_general_activos";
        break;
        case isset($_GET['Estructura']):
            $nombre_reporte = "Reporte_por_estructura";
        break;
        case isset($_GET['Nombre']):
            $nombre_reporte = "Reporte_por_coincidencia_de_nombres";
        break;
        case isset($_GET['RFC']):
            $nombre_reporte = "Reporte_por_RFC";
        break;
        case isset($_GET['Puestos']):
            $nombre_reporte = "Reporte_por_puestos_funcionales";
        break;
        case isset($_GET['no_empleado']):
            $nombre_reporte = "Reporte_No_empleado";
        break;
        case isset($_GET['Stock']):
            $nombre_reporte = "Reporte_por_filtros_especiales";
        break;
        default:
        $nombre_reporte = "Reporte_general_activos";
        break;
        }

    $consulta->Crear_Excel_Reporte_filtro($reporte,$nombre_reporte);
    exit;
 }


?>