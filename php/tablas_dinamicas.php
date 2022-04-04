
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
        $perfil = $_SESSION['ses_id_perfil_ing'];
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
            case isset($_GET['no_empleado']):
                $num = $_GET['no_empleado'];
            break;
            case isset($_GET['Stock']):
                $num = $_GET['Stock'];
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

                <ul class='nav'>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-success'>  Personal Activo: ".$universo_datos_activos[0]['TOTAL']."  <i class='fas fa-user' ></i> </a>
                </li>";
                if ($perfil == 1 || $perfil == 4) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark justify-content-end' type='button' onclick='Genera_doc_excel()'>Exportar a <img class='d-inline-block aligin-top' src='img/iconos_internos/icono_excel.png' alt='' width='50' height='20'></a>
                </li>";
                }
              echo"</ul>";
            
  

echo "<table class='table  table-responsive  text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover' style='height: 520px;' >
        <thead class='thead-dark sticky-top'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>No. Empleado</th>
            <th scope='col'>RFC corto</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Subadministración</th>
            <th scope='col'>Departamento</th>
            <th scope='col'>Puesto funcional</th>
            <th scope='col'>Antigüedad</th>
            <th scope='col'>Cumpleaños</th>
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
                   $puestos=$datos[$i]['id_puesto'];
                   switch ($puestos) {
                     case 22:
                     $nombre_puesto =  $datos[$i]['nombre_puesto']." DE ".$nombre_deptos;
                     break;
                     case 37:
                     $nombre_puesto =  $datos[$i]['nombre_puesto']." DE ".$nombre_deptos;
                     break;
                     default:
                     $nombre_puesto =  $datos[$i]['nombre_puesto']." DE ".$nombre_deptos;
                     break;
                     }
                       break;
               }
             
               echo " 
                
                <tr>
                    <th scope='row'>".$datos[$i]['seq']."</th>
                    <td> ".$datos[$i]['no_empleado']."</td>
                    <td> ".$datos[$i]['rfc_corto']."</td>
                    <td>".$datos[$i]['nombre_empleado']."</td>
                    <td>".$datos[$i]['nombre_sub_admin']."</td>
                    <td>".$nombre_deptos."</td>
                    <td>".$nombre_puesto."</td>
                    <td>".$datos[$i]['years']." años, ".$datos[$i]['meses']." meses y ".$datos[$i]['dias']." dias.</td>
                    <td>".$datos[$i]['Fecha_nacimiento']->format('d-m-Y')." <br>(".$datos[$i]['years_nacimiento']." años)</td>
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
        self::Paginacion_responsiva_posisiones($paginas_por_vista);
    }
    public static function Paginacion_responsiva_posisiones($paginas_por_vista){
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
        case isset($_GET['no_empleado']):
            $page =$_GET['no_empleado'];
            $nombre_get = "no_empleado";
        break;
        case isset($_GET['Stock']):
            $page =$_GET['Stock'];
            $nombre_get = "Stock";
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
        echo"<li class='page-item disabled '><a class='page-link' href='Plantilla_empleados_activos.php?$nombre_get=".($i)."'>...</a></li>";
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

    public function Matriz_sistemas(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $universo_datos_activos = $consultaADR->universo_sistemas_activos();
        $resultado = $universo_datos_activos[0]['TOTAL'] / 25;
        $Posision_por_pagina = 25;
        $paginas_por_vista = ceil($resultado);
        $perfil = $_SESSION['ses_id_perfil_ing'];
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
            case isset($_GET['no_empleado']):
                $num = $_GET['no_empleado'];
            break;
            case isset($_GET['Stock']):
                $num = $_GET['Stock'];
            break;
            default:
                $num = 1;
            break;
          }
          if ($num==1) {
            $inicio = 1;
            $datos = $consultaADR->Consulta_sistemas_activos($inicio);
            }
            else {
            $pagina = $num-1 ;
            $inicio = ($pagina * $Posision_por_pagina) + 1;
            $datos = $consultaADR->Consulta_sistemas_activos($inicio);
            }
            self::Paginacion_responsiva_sistemas($paginas_por_vista);

    
                echo "

                <ul class='nav'>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-success'>  Sistemas Activos: ".$universo_datos_activos[0]['TOTAL']."  <i class='fas fa-assistive-listening-systems' ></i> </a>
                </li>";
                if ($perfil == 1 || $perfil == 4 || $perfil == 6) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark justify-content-end' type='button' onclick='Genera_doc_excel()'>Exportar a <img class='d-inline-block aligin-top' src='img/iconos_internos/icono_excel.png' alt='' width='50' height='20'></a>
                </li>";
                }
                if ($perfil == 1 || $perfil == 4 || $perfil == 6) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark justify-content-end' type='button' id='Abre_modal_agre_sistema'>Agregar sistema <i class='fas fa-crosshairs' ></i> </a>
                </li>";
                }
              echo"</ul>";
            
  

echo "<table class='table  table-responsive  text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover' style='height: 520px;' >
        <thead class='thead-dark sticky-top'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Nombre Sistema</th>
            <th scope='col'>No. cuentas Permitidas</th>
            <th scope='col'>Autorizador</th>
            <th scope='col'>Usuarios activos</th>
            <th scope='col'>No. Roles</th>
            <th scope='col'>URL/Acceso</th>
          </tr>
        </thead>
        <tbody>";
        if (isset($datos)) {
            $j = 1;
            for ($i=0; $i < count($datos) ; $i++) { 
                if ($datos[$i]['funcion'] != null) {
                    $liga =  "<a class='text-secondary' target='_blank' onclick='descarga_aplicacion(\"".$datos[$i]['id_system']."\")'>" .$datos[$i]['url/acceso']."</a></p>";
                }
                else {
                    $liga =  "<a href='" .$datos[$i]['url/acceso']."' class='text-secondary' target='_blank'>" .$datos[$i]['url/acceso']."</a></p>";
                }
                            
               echo " 
                
                <tr>
                    <th scope='row'>".$datos[$i]['seq']."</th>
                    <td> ".$datos[$i]['nombre_sistema']."</td>
                    <td> ".$datos[$i]['Num_cuentas_Siistema']."</td>
                    <td>".$datos[$i]['Administraciion_sistema']."</td>
                    <td>".$datos[$i]['total_acces']."</td>
                    <td>".$datos[$i]['roles_totales']."</td>
                    <td>$liga</td>
                </tr>";
            }
        }
        else {
            echo "No hay usuarios registrados por el momento.";
        }
        echo"</tbody>
        </table>";
        self::Paginacion_responsiva_sistemas($paginas_por_vista);
    }
    public static function Paginacion_responsiva_sistemas($paginas_por_vista){
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
        case isset($_GET['no_empleado']):
            $page =$_GET['no_empleado'];
            $nombre_get = "no_empleado";
        break;
        case isset($_GET['Stock']):
            $page =$_GET['Stock'];
            $nombre_get = "Stock";
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
        <li class='page-item $condicion'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=1'>Inicio</a></li>
        <li class='page-item $condicion'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".$anterior."'>anterior</a></li>";
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
                echo"<li class='page-item $active'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".$m++."'>".$k++."</a></li>";
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
                echo"<li class='page-item $active'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".$i."'>".$i."</a></li>";
                
        }
        echo"<li class='page-item disabled '><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".($i)."'>...</a></li>";
        } 
        if ($page == $paginas_por_vista) {
                $condicion1 = "disabled";  
        }
        else{
                $condicion1 = "";
        }
         echo" <li class='page-item $condicion1'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".$siguiente."'>siguiente</a></li>
         <li class='page-item $condicion1'><a class='page-link' href='Matriz_sistemas.php?$nombre_get=".$paginas_por_vista."'>Final</a></li>
        </ul>
      </nav>";
          
      }
}