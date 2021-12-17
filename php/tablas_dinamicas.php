
<?php
class Manda_tabla{
    public function Tabla_usuarios_activos(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $universo_datos_activos = $consultaADR->universo_usuarios_activos();
        $resultado = $universo_datos_activos[0]['TOTAL'] / 50;
        $Posision_por_pagina = 50;
        $paginas_por_vista = ceil($resultado);
        //$datos = $consultaADR->Consulta_usuarios_activos();
        switch ($_GET) {
            case isset($_GET['pagina']):
                    $num = $_GET['pagina'];
            break;
            case isset($_GET['Estructura']):
                $num = $_GET['Estructura'];
            break;
            case isset($_GET['Nombre']):
                $num = $_GET['Nombre'];
            break;
            case isset($_GET['RFC']):
                $num = $_GET['RFC'];
            break;
            case isset($_GET['Puestos']):
                $num = $_GET['Puestos'];
            break;
            default:
                $num = 1;
            break;
          }
          if ($num==1) {
            $inicio = 1;
            $datos = $consultaADR->Consulta_usuarios_activos($inicio);
            }
            else {
            $pagina = $num-1 ;
            $inicio = ($pagina * $Posision_por_pagina) + 1;
            $datos = $consultaADR->Consulta_usuarios_activos($inicio);
            }
            self::Paginacion_responsiva_posisiones($paginas_por_vista);
        echo "
    <table class='table table-sm table-responsive vh-50 text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>RFC corto</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Subadministración</th>
            <th scope='col'>Departamento</th>
            <th scope='col'>Puesto</th>
            <th scope='col'>Antigüedad</th>
            <th scope='col'>Estado</th>
            <th scope='col'>Acciones</th>
          </tr>
        </thead>
        <tbody>";
        if (isset($datos)) {
            $j = 1;
            for ($i=0; $i < count($datos) ; $i++) { 
                // onclick='Revisa_info_det(\"".$datos[$i]['id_empleado_plant']."\")'
               $nombre_deptos =  $datos[$i]['nombre_depto'];
               switch ($nombre_deptos) {
                   case 'ADMINISTRACIÓN':
                    $nombre_puesto =  $datos[$i]['nombre_puesto'];
                    break;
                    case 'SUBADMINISTRACIÓN':
                    $nombre_puesto =  $datos[$i]['nombre_puesto']." DE LA ".$datos[$i]['nombre_sub_admin'] ;
                    break;
                   
                   default:
                   $nombre_puesto =  $datos[$i]['nombre_puesto']." DEL AREA DE ".$nombre_deptos;
                       break;
               }
                echo " 
                <tr>
                    <th scope='row'>".$j++."</th>
                    <td> ".$datos[$i]['rfc_corto']."</td>
                    <td>".$datos[$i]['nombre_empleado']."</td>
                    <td>".$datos[$i]['nombre_sub_admin']."</td>
                    <td>".$nombre_deptos."</td>
                    <td>".$nombre_puesto."</td>
                    <td>".$datos[$i]['years']." años, ".$datos[$i]['meses']." meses y ".$datos[$i]['dias']." dias.</td>
                    <td>".$datos[$i]['nombre_proc']."</td>
                    <td> <button type='button' class='btn btn-dark btn-group' id='informacion_user'  onclick='Revisa_info_det_us(\"".$datos[$i]['id_empleado_plant']."\")' > Info.</button> </td>
                </tr>";
            }
        }
        else {
            echo "No hay usuarios registrados por el momento.";
        }
        echo"</tbody>
        </table>";
    }
    public function Paginacion_responsiva_posisiones($paginas_por_vista){
        switch ($_GET) {
          case isset($_GET['pagina']):
                  $page =$_GET['pagina'];
                  $nombre_get = "pagina";
          break;
          case isset($_GET['Estructura']):
            $page =$_GET['Estructura'];
            $nombre_get = "Estructura";
        break;
        case isset($_GET['Nombre']):
            $page =$_GET['Nombre'];
            $nombre_get = "Nombre";
        break;
        case isset($_GET['RFC']):
            $page =$_GET['RFC'];
            $nombre_get = "RFC";
        break;
        case isset($_GET['Puestos']):
            $page =$_GET['Puestos'];
            $nombre_get = "Puestos";
        break;
        default:
        $page =1;
         $nombre_get = "pagina";
        break;
        }
        $pagina_responsiva = $page + 10;
        $anterior = $page - 1;
        $siguiente = $page + 1;

        if ($page == 1) {
                $condicion = "disabled";
        }
        else{
                $condicion = "";
        }
        echo "<nav aria-label='Page navigation example '>
        <ul class='pagination justify-content-center'>
        <li class='page-item $condicion'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=1'>Inicio</a></li>
        <li class='page-item $condicion'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".$anterior."'>anterior</a></li>";
        $k = 1;
        $m = 1;
        if ($paginas_por_vista < 10) {
     
        for ($i=0; $i < $paginas_por_vista ; $i++) { 
                if ($page == $m) {
                        $active = 'active';
                  }
                  else {
                          $active = '';
                  }
                echo"<li class='page-item $active'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".$m++."'>".$k++."</a></li>";
        }
        }
        elseif ($paginas_por_vista > 20) {
        for ($i=$page; $i < $pagina_responsiva ; $i++) { 
            if ($page == $i) {
                $active = 'active';
          }
          else {
                  $active = '';
          }
                echo"<li class='page-item $active'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".$i."'>".$i."</a></li>";
                
        }
        echo"<li class='page-item disabled '><a class='page-link' href='Posisiones.php?$nombre_get=".($i)."'>...</a></li>";
        } 
        if ($page == $paginas_por_vista) {
                $condicion1 = "disabled";  
        }
        else{
                $condicion1 = "";
        }
         echo" <li class='page-item $condicion1'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".$siguiente."'>siguiente</a></li>
         <li class='page-item $condicion1'><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".$paginas_por_vista."'>Final</a></li>
        </ul>
      </nav>";
          
      }
    public function Tabla_usuarios_baja_comision_suspen_laudos(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $datos = $consultaADR->Consulta_usuarios_baja_comision_suspenndidos_laudos();
        echo "
    <table class='table table-sm text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>RFC corto</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Subadministración</th>
            <th scope='col'>Departamento</th>
            <th scope='col'>Ocupación</th>
            <th scope='col'>Estado</th>
            <th scope='col'>Acciones</th>
          </tr>
        </thead>
        <tbody>";
        if (isset($datos)) {
            $j = 1;
            for ($i=0; $i < count($datos) ; $i++) { 
                // onclick='Revisa_info_det(\"".$datos[$i]['id_empleado_plant']."\")'
                echo " 
                <tr>
                    <th scope='row'>".$j++."</th>
                    <td> ".$datos[$i]['rfc_corto']."</td>
                    <td>".$datos[$i]['nombre_empleado']."</td>
                    <td>".$datos[$i]['nombre_sub_admin']."</td>
                    <td>".$datos[$i]['nombre_depto']."</td>
                    <td>".$datos[$i]['nombre_puesto']."</td>
                    <td>".$datos[$i]['nombre_proc']."</td>
                    <td> <button type='button' class='btn btn-dark btn-group' id='informacion_user'  onclick='Revisa_info_det_us2(\"".$datos[$i]['id_empleado_plant']."\")' > Info.</button> </td>
                </tr>";
            }
        }
        else {
            echo "No hay usuarios registrados por el momento.";
        }
        echo"</tbody>
        </table>";
    }
}