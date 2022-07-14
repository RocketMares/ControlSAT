
<?php
class Manda_tabla{
    public function Tabla_usuarios_activos(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $universo_datos_activos = $consultaADR->universo_usuarios_activos();
        $resultado = $universo_datos_activos[0]['total_total'] / 50;
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
            case isset($_GET['fecha_ingreso']):
                $num = $_GET['fecha_ingreso'];
            break;
            case isset($_GET['nivel']):
                $num = $_GET['nivel'];
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
                <a class='nav-link active btn btn-outline-light'data-toggle='tooltip' data-placement='top' title=' Personal total' >  PT: ".$universo_datos_activos[0]['total_total']."  <i class='fas fa-user' ></i> </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-success'data-toggle='tooltip' data-placement='top' title=' Personal Activo' >  PA: ".$universo_datos_activos[0]['TOTAL']."  <i class='fas fa-user' ></i> </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-info' data-toggle='tooltip' data-placement='top' title=' Personal en comisión sindical' >  PCS: ".$universo_datos_activos[0]['total_comision_sindical']."  <i class='fas fa-user' ></i> </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title=' Personal en suspención' >  PS: ".$universo_datos_activos[0]['total_suspendidos']."  <i class='fas fa-user' ></i> </a>
                </li>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-secondary'data-toggle='tooltip' data-placement='top' title=' Personal en comisión sin goze de sueldo' >  PCSGS: ".$universo_datos_activos[0]['total_Comision_sin_goze_sueldo']."  <i class='fas fa-user' ></i> </a>
                </li>";
                if ($perfil == 1 || $perfil == 4 || $perfil == 5) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark justify-content-end' type='button' onclick='Genera_doc_excel()' data-toggle='tooltip' data-placement='top' title='Exportar a excel' > <img class='d-inline-block aligin-top' src='img/iconos_internos/icono_excel.png' alt='' width='50' height='20'></a>
                </li>";
                }
              echo"</ul>";
            
  

echo "<table class='table  table-responsive  text-center  table-bordered shadow-sm bg-white rounded table-hover' style='height: 520px;' >
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
                        switch ($datos[$i]['id_proc']) {
                        case 9:
                        $clase_color = "";
                        break;
                        case 6:
                            $clase_color = "class= 'table-info'";
                        break;
                        case 25:
                            $clase_color = "class= 'table-danger'";
                        break;
                        case 28:
                            $clase_color = "class= 'table-secondary'";
                        break;
                        case 12:
                            $clase_color = "";
                        break;
                        default:
                        $clase_color = "";
                        break;
                        }
               echo " 
                
                <tr $clase_color>
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
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Ups!</strong>  No hay usuarios registrados en esta categoria por el momento.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
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
        case isset($_GET['fecha_ingreso']):
            $page =$_GET['fecha_ingreso'];
            $nombre_get = "fecha_ingreso";
        break;
        case isset($_GET['nivel']):
            $page =$_GET['nivel'];
            $nombre_get = "nivel";
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
      public static function Paginacion_responsiva_bajas($paginas_por_vista){
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
        case isset($_GET['fecha_baja']):
            $page =$_GET['fecha_baja'];
            $nombre_get = "fecha_baja";
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
        <li class='page-item $condicion'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=1'>Inicio</a></li>
        <li class='page-item $condicion'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".$anterior."'>anterior</a></li>";
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
                echo"<li class='page-item $active'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".$m++."'>".$k++."</a></li>";
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
                echo"<li class='page-item $active'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".$i."'>".$i."</a></li>";
                
        }
        echo"<li class='page-item disabled '><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".($i)."'>...</a></li>";
        } 
        if ($page == $paginas_por_vista) {
                $condicion1 = "disabled";  
        }
        else{
                $condicion1 = "";
        }
         echo" <li class='page-item $condicion1'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".$siguiente."'>siguiente</a></li>
         <li class='page-item $condicion1'><a class='page-link' href='Plantilla_empleados_baja.php?$nombre_get=".$paginas_por_vista."'>Final</a></li>
        </ul>
      </nav>";
          
      }
    public function Tabla_usuarios_baja_comision_suspen_laudos(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $universo_datos_activos = $consultaADR->universo_usuarios_bajas();
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
            case isset($_GET['fecha_baja']):
                $num = $_GET['fecha_baja'];
            break;
            default:
                $num = 1;
            break;
          }
          if ($num==1) {
            $inicio = 1;
            $datos = $consultaADR->Consulta_usuarios_baja_comision_suspenndidos_laudos($inicio);
            }
            else {
            $pagina = $num-1 ;
            $inicio = ($pagina * $Posision_por_pagina) + 1;
            $datos = $consultaADR->Consulta_usuarios_baja_comision_suspenndidos_laudos($inicio);
            }
            self::Paginacion_responsiva_bajas($paginas_por_vista);

    
                echo "

                <ul class='nav'>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-dark'>  Personal Inactivo: ".$universo_datos_activos[0]['TOTAL']."  <i class='fas fa-user' ></i> </a>
                </li>";
                if ($perfil == 1 || $perfil == 4 || $perfil == 5) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark justify-content-end' type='button' onclick='Genera_doc_excel()'>Exportar a <img class='d-inline-block aligin-top' src='img/iconos_internos/icono_excel.png' alt='' width='50' height='20'></a>
                </li>";
                }
              echo"</ul>";
            
  


 
        echo "
            <table class='table  table-responsive  text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover' style='height: 520px;'>
                <thead class='thead-dark sticky-top'>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>RFC corto</th>
                    <th scope='col'>Nombre</th>
                    <th scope='col'>Subadministración</th>
                    <th scope='col'>Departamento</th>
                    <th scope='col'>Ocupación</th>
                    <th scope='col'>Inactividad</th>
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
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Ups!</strong>  No hay usuarios registrados en esta categoria por el momento.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>
                    ";
                }
                echo"</tbody>
                </table>";

                self::Paginacion_responsiva_bajas($paginas_por_vista);
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

                <ul class='nav justify-content-left'>
                <li class='nav-item'>
                <a class='nav-link active btn btn-outline-success'>  Sistemas Activos: ".$universo_datos_activos[0]['TOTAL']."  <i class='fas fa-assistive-listening-systems' ></i> </a>
                </li>";
                if ($perfil == 1 || $perfil == 4 || $perfil == 6) {
                    echo "
                <li class='nav-item'>
                  <a class='nav-link active btn btn-outline-dark ' type='button' onclick='Genera_doc_excel()'>Exportar a <img class='d-inline-block aligin-top' src='img/iconos_internos/icono_excel.png' alt='' width='50' height='20'></a>
                </li>";
                }
           
              echo"</ul>";
            
  

echo "<table class='table  table-responsive container text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover' style='height: 520px;' >
        <thead class='thead-dark sticky-top'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Nombre Sistema</th>
            <th scope='col'>No. cuentas Permitidas</th>
            <th scope='col'>Autorizador</th>
            <th scope='col'>Usuarios activos</th>
            <th scope='col'>No. Roles</th>
            <th scope='col'>Tipo de acceso</th>
            <th scope='col'>Detalle</th>
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
                switch ($datos[$i]['Administraciion_sistema']) {
                    case 1:
                        $insti_autorizadora =  "ADR DF4";
                    break;
                    case 2:
                        $insti_autorizadora =  "CENTRALES";
                    break;
                    case 3:
                        $insti_autorizadora =  "DESCONCENTRADAS";
                    break;
                    case 4:
                        $insti_autorizadora =  "EXTERNOS";
                    break;
                    default:
                        $insti_autorizadora =  "ADR DF4";
                    break;
                }   
                switch ($datos[$i]['tipo_sistema']) {
                    case 1:
                        $tipo_sistema =  "PAGINA WEB";
                    break;
                    case 2:
                        $tipo_sistema =  "CARPETA COMPARTIDA";
                    break;
                    case 3:
                        $tipo_sistema =  "APLICACIÓN DE ESCRITORIO";
                    break;
                    case 4:
                        $tipo_sistema =  "APLICACIÓN DE ESCRITORIO EXTERNA";
                    break;
                    default:
                        $tipo_sistema =  "PAGINA WEB";
                    break;
                }   
                if ($datos[$i]['Num_cuentas_Siistema'] == "" || $datos[$i]['Num_cuentas_Siistema'] == null) {
                    $num_cuentas = "SIN LIMITE";
                } else {
                    $num_cuentas = $datos[$i]['Num_cuentas_Siistema'];
                }
               echo " 
                
                <tr>
                    <th scope='row'>".$datos[$i]['seq']."</th>
                    <td> ".$datos[$i]['nombre_sistema']."</td>
                    <td> ".$num_cuentas."</td>
                    <td>".$insti_autorizadora."</td>
                    <td>".$datos[$i]['total_acces']."</td>
                    <td>".$datos[$i]['roles_totales']."</td>
                    <td>".$tipo_sistema."</td>
                    <td> <button type='button' class ='btn btn-dark' onclick='detalle_sistema_muestra(".$datos[$i]['id_system'].")' > <i class='fas fa-bars' ></i></button>

                    </td>
                </tr>";
            }
        }
        else {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Ups!</strong>  No hay sistemas registrados por el momento..
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
            </div>
           ";
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