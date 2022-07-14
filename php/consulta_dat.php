<?php

if (isset($_POST['datos'])) {
   $id_user = $_POST['datos'];
   include_once "sesion.php";
    include_once "ConsultaADR.php";
    $cons = new ConsultaInfoADR();
    $datos_us = $cons->info_datos_us($id_user);

    $perfil = $_SESSION['ses_id_perfil_ing'];
    if (isset($datos_us)) {
        
        $nombre_empleado = $datos_us[0]['nombre_empleado'];
        $id_empleado = $datos_us[0]['id_empleado_plant'];
        $no_emppleado = $datos_us[0]['no_empleado'];
        $nombre_puest_fun = $datos_us[0]['nombre_puesto'];
        //$nombre_puest_ADR = $datos_us[0]['nombre_puesto_adr'];
        $Rfc_corto = $datos_us[0]['rfc_corto'];
        $nombramiento = $datos_us[0]['tipo_nombramiento'];
        $nombre_deptos =  $datos_us[0]['nombre_depto'];
        switch ($nombre_deptos) {
            case 'ADMINISTRACIÓN':
             $nombre_puest_ADR =  $datos_us[0]['nombre_puesto_adr'];
             break;
             case 'SUBADMINISTRACIÓN':
             $nombre_puest_ADR =  $datos_us[0]['nombre_puesto_adr']." DE LA ".$datos_us[0]['nombre_sub_admin'] ;
             break;
        
            default:
            $puestos=$datos_us[0]['id_puesto_adr'];
            switch ($puestos) {
              case 22:
              $nombre_puest_ADR =  $datos_us[0]['nombre_puesto_adr']." DE ".$nombre_deptos;
              break;
              case 37:
              $nombre_puest_ADR =  $datos_us[0]['nombre_puesto_adr']." DE ".$nombre_deptos;
              break;
              default:
              $nombre_puest_ADR =  $datos_us[0]['nombre_puesto_adr']." DE ".$nombre_deptos;
                break;
              }
                break;
        }
        switch ($perfil) {
                case 1:
                  $accion = "onclick='modal_actualiza(\"$id_empleado\",\"$no_emppleado\")'";
                break;
                case 4:
                  $accion = "onclick='modal_actualiza(\"$id_empleado\",\"$no_emppleado\")'";
                break;
                case 5:
                  $accion = "onclick='modal_actualiza(\"$id_empleado\",\"$no_emppleado\")'";
                break;
          
                default:
                  $accion = "";
                break;
        }
        echo "
        <div class='row  container-fluid mt-2 py-2' id ='vista'>
        <div class='col-sm-3 text-center ' >
         <br>
      
          <img src='img/fotos_empleados/$no_emppleado.jpg' $accion  class='rounded-circle ' style='height: 200px; width: 200px ;border: solid 4px black;' alt=''>
     
          </div>
         
        <div class='col-sm-9'>
          <div class='card border-dark'>
            <div class='card-header card'>
              <b>Información general del usuario:</b>
            </div>
            <ul class='list-group list-group-flush '>
              <li class='list-group-item'> <b>Nombre del empleado:</b> $nombre_empleado</li>
              <li class='list-group-item'><b>Nombre del puesto FUMP:</b> $nombre_puest_fun</li>
              <li class='list-group-item'><b>Nombre del puesto Funcional:</b> $nombre_puest_ADR</li>
              <li class='list-group-item'><b>Número de empleado:</b> $no_emppleado</li>
              <li class='list-group-item'><b>RFC corto del empleado:</b> $Rfc_corto</li>
            </ul>
          </div>
        </div>
      
      </div>
      
      ";
    }
    else {
        echo "no hay datos pero si viene la cockie".$id_user;
    }
    
}

if (isset($_POST['busca_info_us'])) {
 
      $id_user = $_POST['busca_info_us'];
      //echo $id_user;
       include_once "ConsultaADR.php";
       $cons = new ConsultaInfoADR();
       $datos_us = $cons->info_datos_us_2($id_user);
       header('Content-type: application/json; charset=utf-8');
       echo json_encode($datos_us);
  
}
if (isset($_POST['detalle_sistema'])) {
 
  $id_system = $_POST['detalle_sistema'];
  //echo $id_user;
   include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
   $datos_us = $cons->consulta_info_sistema($id_system);
   header('Content-type: application/json; charset=utf-8');
   echo json_encode($datos_us);

}
if (isset($_POST['detalle_sistema1'])) {
  $id_system = $_POST['detalle_sistema1'];
   include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
   $datos_us = $cons->consulta_info_sistema($id_system);

  if ($datos_us['funcion'] != '' && isset($datos_us['funcion'])   || $datos_us['funcion'] != NULL && isset($datos_us['funcion'])) {
   $liga =  "<button type='button' onclick='descarga_aplicacion($id_system)' class='btn btn-outline-dark'>Descarga Aplicación</button>";
  }
  else {
    $liga =  "<a href='" .$datos_us['url/acceso']."' class='card-link text-primary' target='_blank'>" .$datos_us['url/acceso']."</a>";
  }
  echo $liga;
}
if (isset($_POST['detalle_sistema2'])) {
  $id_system = $_POST['detalle_sistema2'];
   include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
   $datos_us = $cons->consulta_info_sistema($id_system);

   if ($datos_us['funcion'] != '' && isset($datos_us['funcion'])   || $datos_us['funcion'] != NULL && isset($datos_us['funcion'])) {

   $liga =  "";
  }
  else {
    $liga =  "<button type='button' onclick='descarga_aplicacion($id_system)' class='btn btn-outline-dark'>Descarga Aplicación</button>";
  }
  echo $liga;
}
if (isset($_POST['tabla_roles'])) {
  $id_system = $_POST['tabla_roles'];
   include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
   $datos_us = $cons->Roles_cat_roles_acceso($id_system);
  echo"
  <table class='table text-center table-responsive  text-center  shadow p-1 bg-white rounded' style='height: 420px;'>
  <thead class='table-dark sticky-top'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Nombre Rol</th>
      <th scope='col'>Clave de Rol</th>
      <th scope='col'>Fecha Mov. Cap.</th>
      <th scope='col'>Usuario Captura</th>
    </tr>
  </thead>
  <tbody>
  ";
  $j=1;
  if(isset($datos_us)){
    for ($i=0; $i <count($datos_us) ; $i++) { 
    
      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos_us[$i]['nombre_rol']."</td>
      <td>".$datos_us[$i]['clave_rol']."</td>
      <td>".$datos_us[$i]['fecha_alta']->format('d/m/Y H:i')."</td>
      <td>".$datos_us[$i]['user_alta']."</td>
    </tr>";
    }
  } else {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Ups!</strong> El sistema no cuenta con roles o privilegios por el momento.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  
  echo"</tbody>
  </table>";
}
if (isset($_POST['vista_users_x_sistem'])) {
  $id_system = $_POST['vista_users_x_sistem'];
   include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
   $datos_us = $cons->Accesos_x_sistemas($id_system);
  echo"
  <table class='table text-center table-responsive  text-center  shadow p-1 bg-white rounded' style='height: 420px;'>
  <thead class='table-dark sticky-top'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Nombre User</th>
      <th scope='col'>Rol o roles</th>
      <th scope='col'>Clave rol</th>
      <th scope='col'>Fecha Alta</th>
      <th scope='col'>Estatus Actividad</th>
      <th scope='col'>Fecha Baja</th>
      <th scope='col'>Usuario Captura</th>
      <th scope='col'>Fecha Captura</th>
    </tr>
  </thead>
  <tbody>
  ";
  $j=1;
  if(isset($datos_us)){
    for ($i=0; $i <count($datos_us) ; $i++) { 
      $rol ="";
      $claves ="";
      $saca_roles = $cons->saca_roles_sistemas_acceso($datos_us[$i]['id_reg_acceso']);
      if (isset($saca_roles)) {
        for ($a=0; $a <count($saca_roles) ; $a++) { 
          $rol .= "<li>".$saca_roles[$a]['nombre_rol']."</li>\n";
          $claves .= "<li>".$saca_roles[$a]['clave_rol']."</li>\n";
        }
      } else {
        $rol ="";
        $claves ="";
      }
      $fecha_alta_sis = $datos_us[$i]['fecha_alta'] == NULL ?"": $datos_us[$i]['fecha_alta']->format('d/m/Y');
      $fecha_bajas_sis = $datos_us[$i]['fecha_baja'] == NULL ?"": $datos_us[$i]['fecha_baja']->format('d/m/Y');
      $fecha_cap_sis = $datos_us[$i]['fecha_alta'] == NULL ?"": $datos_us[$i]['fecha_alta']->format('d/m/Y H:i');
     
      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos_us[$i]['nombre_emp']."</td>
      <td><ul>".$rol."</ul></td>
      <td><ul>".$claves."</ul></td>
      <td>".$fecha_alta_sis."</td>
      <td>".$datos_us[$i]['nombre_proc']."</td>
      <td>".$fecha_bajas_sis."</td>
      <td>".$datos_us[$i]['user_alta']."</td>
      <td>".$fecha_cap_sis."</td>

    </tr>";
    }
  } else {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Ups!</strong> El sistema no cuenta con usuarios por el momento.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  
  echo"</tbody>
  </table>";
}


if (isset($_POST['agre_rol_sis'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $data = $_POST['agre_rol_sis'];
  $datos = json_decode($data);
  $datos = $cons->registra_nuevo_rol($datos);
  echo $datos;

}

if (isset($_POST['act_datos_basic_ins'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_datos_basic_ins'];
  $datos = json_decode($entre);

  $datos = $cons->Actualiza_datos_basicos_acti($datos);
  echo $datos;

    // $datos =  json_encode($entre);
  // echo $datos;

}
if (isset($_POST['act_area_asignada'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_area_asignada'];
  $datos = json_decode($entre);
  $datos = $cons->Actualiza_area_y_jefe_insumo($datos);
  echo $datos;

}
if (isset($_POST['consulta_jefe_dep'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $id_emp = $_POST['consulta_jefe_dep'];
 $datos = $cons->Consulta_encarg_dep($id_emp);
if (isset($datos)) {
  $jefe_actual =  $datos;

 if ($jefe_actual == $id_emp) {

  echo 1;
 }
 else{

  echo 2;
 }
}
else {
  echo 2;
}



}
if (isset($_POST['Genera_oficio_Asignacion'])) {
  include_once "ConsultaADR.php";
  
  $cons = new ConsultaInfoADR();
  $entre = $_POST['Genera_oficio_Asignacion'];
  $datos1 = json_decode($entre);
  //$datos = json_encode($entre);
  $datos = $cons->Genera_oficio_historial($datos1);
  echo $datos;

}

if (isset($_POST['act_datos_adicionales'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_datos_adicionales'];
  $datos = json_decode($entre);
  $datos = $cons->Actualiza_datos_adicionales($datos);
  echo $datos;

}
if (isset($_POST['act_datos_posision'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_datos_posision'];
  $datos = json_decode($entre);
  $datos = $cons->Actualiza_datos_posisiones($datos);
  echo $datos;

}
if (isset($_POST['act_datos_posision_sueldos'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_datos_posision_sueldos'];
  $datos = json_decode($entre);
  $datos = $cons->Actualiza_datos_posisiones_sueldos($datos);
  echo $datos;

}
if (isset($_POST['posi'])) {
  include_once "ConsultaADR.php";
  $id =$_POST['posi'];
  $cons = new ConsultaInfoADR();
  $datos = $cons->consulta_clave_puesto_fump($id) ;
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($datos);
}
if (isset($_POST['posi2'])) {
  include_once "ConsultaADR.php";
  $id =$_POST['posi2'];
  $cons = new ConsultaInfoADR();
  $datos = $cons->consulta_clave_puesto_fump2($id) ;
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($datos);
}

if (isset($_POST['posision_predic'])) {
  $consulta = $_POST['posision_predic'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos_plaza = $cons->vista_Posisiones_fijos();
  if (isset($datos_plaza)) {
    for ($i=0; $i < count($datos_plaza) ; $i++) { 
      echo"<option value='".$datos_plaza[$i]['id_num_posision']."'>".$datos_plaza[$i]['id_num_posision']."</option>";
    }
  }
  else{
    return false;
  }

   
}
if (isset($_POST['motivo_baj_filtro'])) {
  $consulta = $_POST['motivo_baj_filtro'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos_plaza = $cons->Motivos_filtros($consulta);

  if (isset($datos_plaza)) {
    echo"<option value='0'>Seleccionar Motivo</option>";
    for ($i=0; $i < count($datos_plaza) ; $i++) { 
      echo"<option value='".$datos_plaza[$i]['id_motivo_esp']."'>".$datos_plaza[$i]['Motivo_especial']."</option>";
    }
  }
  else{
    echo"<option value='0'>Seleccionar Motivo</option>";
  }

   
}
 if(isset($_POST['mov_insumos'])){
  $id_insumo = $_POST['mov_insumos'];
  include_once "ConsultaADR.php";
  include_once "sesion.php";
  $cons = new ConsultaInfoADR();
  $datos = $cons->Movimientos_del_personal($id_insumo);
  $perfil = $_SESSION['ses_id_perfil_ing'];
  echo "
  <table class='table text-center table-responsive  text-center  shadow p-1 bg-white rounded' style='height: 420px;'>
  <thead class='table-dark sticky-top'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Proceso</th>
      <th scope='col'>Fecha Mov.</th>
      <th scope='col'>No. Empleado</th>
      <th scope='col'>Nombre empleado</th>
      <th scope='col'>CURP</th>
      <th scope='col'>RFC</th>
      <th scope='col'>RFC Corto</th>
      <th scope='col'>Nivel Jerarquico</th>
      <th scope='col'>Nombramiento</th>
      <th scope='col'>Sindicato</th>
      <th scope='col'>Fecha Ingreso</th>
      <th scope='col'>Fecha Baja</th>
      <th scope='col'>Sub.</th>
      <th scope='col'>Dep.</th>";
      if ($perfil== 1 ||$perfil== 5 || $perfil== 7 || $perfil== 4 ) {
        echo" <th scope='col'>Posición.</th>";
      }
     echo"<th scope='col'>Jefe directo</th>
      <th scope='col'>Puesto ADR.</th>
      <th scope='col'>Fecha Mov. Cap.</th>
      <th scope='col'>Usuario Captura</th>
    </tr>
  </thead>
  <tbody>";
  $j =1;
  if (isset($datos)) {
    for ($i=0; $i <count($datos) ; $i++) { 
        $fecha_baja = $datos[$i]['fec_fin_rel_laboral'] != null ? $datos[$i]['fec_fin_rel_laboral']->format('d/m/Y'):'';
        $fecha_mov_func = $datos[$i]['fecha_mov_funcional'] != null ? $datos[$i]['fecha_mov_funcional']->format('d/m/Y'):'';

      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos[$i]['nombre_proc']."</td>
      <td>".$fecha_mov_func."</td>
      <td>".$datos[$i]['no_empleado']."</td>
      <td>".$datos[$i]['nombre_s']." ".$datos[$i]['apellido_p']." ".$datos[$i]['apellido_m']."</td>
      <td>".$datos[$i]['CURP']."</td>
      <td>".$datos[$i]['RFC']."</td>
      <td>".$datos[$i]['rfc_corto']."</td>
      <td>".$datos[$i]['nivel_jer']."</td>
      <td>".$datos[$i]['tipo_nombramiento']."</td>
      <td>".$datos[$i]['sindicato']."</td>
      <td>".$datos[$i]['fec_ingreso']->format('d/m/Y')."</td>
      <td>".$fecha_baja ."</td>
      <td>".$datos[$i]['sub_admin']."</td>
      <td>".$datos[$i]['depto']."</td>";
      if ($perfil== 1 ||$perfil== 5 || $perfil== 7 || $perfil== 4) {
          echo"<td>".$datos[$i]['id_num_posision']."</td>";
      }

     echo" <td>".$datos[$i]['jefe_directo']."</td>
      <td>".$datos[$i]['puesto']."</td>
      <td>".$datos[$i]['fecha_alta']->format('d/m/Y H:i')."</td>
      <td>".$datos[$i]['user_alta']."</td>
    </tr>";
    }
  }
  else {
    echo"no hay movimientos registrados datos";
  }

  

    echo"</tbody>
</table>
  ";

 }
 if (isset($_POST['mov_oficios_his'])) {
     $id_insumo = $_POST['mov_oficios_his'];
     include_once "ConsultaADR.php";
     include_once "sesion.php";
     $cons = new ConsultaInfoADR();
     $datos = $cons->Historial_mov_oficios_por_analista($id_insumo);
     $perfil = $_SESSION['ses_id_perfil_ing'];

  echo "

  <table class='table text-center table-responsive  text-center shadow p-1 bg-white rounded'  style='height: 420px;' >
  <thead class=' table-dark sticky-top'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Proceso</th>
      <th scope='col'>Fecha Mov.</th>
      <th scope='col'>No. Oficio</th>
      <th scope='col'>Tipo Oficio</th>
      <th scope='col'>Fecha de Oficio</th>
      <th scope='col'>Fecha de Firmado</th>
      <th scope='col'>Acciones del Oficio</th>
    </tr>
  </thead>
  <tbody>";
  $j =1;
  if (isset($datos)) {
    for ($i=0; $i <count($datos) ; $i++) { 
      $fecha_generado = $datos[$i]['fecha_oficio_generado'] != null ? $datos[$i]['fecha_oficio_generado']->format('d/m/Y'):'';
      $fecha_firmada = $datos[$i]['fecha_oficio_firmada'] != null ? $datos[$i]['fecha_oficio_firmada']->format('d/m/Y'):'';
      $proceso = $datos[$i]['id_proc'];

      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos[$i]['nombre_proc']."</td>
      <td>".$datos[$i]['fecha_alta']->format('d/m/Y H:i')."</td>
      <td>".$datos[$i]['id_num_oficio']."</td>
      <td>".$datos[$i]['tipo_oficio']."</td>
      <td>".$fecha_generado."</td>
      <td>".$fecha_firmada ."</td>
      <td>
      ";
      if ($proceso == 30) {
        echo"   <a class='btn btn-outline-danger'  data-toggle='tooltip' data-placement='top' title='Descarga Oficio de ".$datos[$i]['tipo_oficio']."' href='php/Oficio_asignacion.php?id_usuario=" . $datos[$i]["id_empleado_plant"] . "&oficio=".$datos[$i]["id_oficio_gen"]."' target='_blank'><i class='fas fa-file-pdf'></i></a>
        <a class='btn btn-outline-secondary' onclick='Editar_oficio(".$datos[$i]["id_oficio_gen"].",".$datos[$i]["id_empleado_plant"].")' data-toggle='tooltip' data-placement='top' title='Carga Oficio' href='#'  ><i class='fas fa-edit'></i></a>";
      } else {
       echo"<button type='button' class='btn btn-success'data-toggle='tooltip' data-placement='top' title='Descarga documento' onclick='descarga_documento(\"".$datos[$i]["rfc_corto"]."\",\"".$datos[$i]["no_empleado"]."\",\"".$datos[$i]["id_oficio_gen"]."\",\"".str_replace("-","_",$datos[$i]["id_num_oficio"])."\",\"".$datos[$i]["tipo_oficio"]."\")'><i class='fas fa-download'></i></button>";
      }
    
      echo"
    </tr>";
    }
  }
  else {
    echo"no hay movimientos registrados datos";
  }

  

    echo"</tbody>
</table>


  ";

 }
 if (isset($_POST['consulta_clav'])) {
    $consulta = $_POST['consulta_clav'];
    include_once 'ConsultaADR.php';
    $cons = new ConsultaInfoADR();
    $clave = $cons->ConsultaClave($consulta);
    echo $clave['clave_puesto'];
 }

 if (isset($_POST['posision_info'])) {

  include_once "ConsultaADR.php";
  $id =$_POST['posision_info'];
  $cons = new ConsultaInfoADR();
  $datos = $cons->Consulta_datos_plaza($id) ;
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($datos);

}

if (isset($_POST['actualiza_mante_posision'])) {

  include_once "ConsultaADR.php";
  $datos =$_POST['actualiza_mante_posision'];
  $cons = new ConsultaInfoADR();
  $data = json_decode($datos);
  $datos = $cons->Actualiza_posisiones_mantenimiento($data);
echo $datos;
}

if(isset($_POST['revisa_mov_plazas'])){
  $id_insumo = $_POST['revisa_mov_plazas'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos = $cons->Movimientos_de_plazas($id_insumo);
  echo "
  <table class='table text-center table-responsive  text-center vh-75 shadow p-1 bg-white rounded'>
  <thead class='table-dark sticky-top'>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Proceso</th>
      <th scope='col'>Posición</th>
      <th scope='col'>Fecha</th>
      <th scope='col'>Usuario Captura</th>
      <th scope='col'>Ocupante</th>
      <th scope='col'>Posision Jefe</th>
      <th scope='col'>Nivel</th>
      <th scope='col'>Clave Presupuestal</th>
      <th scope='col'>Sueldo</th>
      <th scope='col'>Puesto FUMP.</th>
      <th scope='col'>Clave Puest. FUMP.</th>
    </tr>
  </thead>
  <tbody>";
  $j =1;
  if (isset($datos)) {
    for ($i=0; $i <count($datos) ; $i++) { 
      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos[$i]['nombre_proc']."</td>
      <td>".$datos[$i]['id_num_posision']."</td>
      <td>".$datos[$i]['fecha_alta']->format('d/m/Y H:i')."</td>
      <td>".$datos[$i]['user_alta']."</td>
      <td>".$datos[$i]['nombre_empleado']."</td>
      <td>".$datos[$i]['posision_jefe']."</td>
      <td>".$datos[$i]['nivel']."</td>
      <td>".$datos[$i]['Codigo_pres']."</td>
      <td>".$datos[$i]['sueldo_neto']."</td>
      <td>".$datos[$i]['puesto_fump']."</td>
      <td>".$datos[$i]['clave_puesto']."</td>
    </tr>";
    }
  }
  else {
    echo"no hay movimientos registrados datos";
  }

  

    echo"</tbody>
</table>
  ";

 }
 if (isset($_POST['data_lista'])) {
  $escritura = $_POST['data_lista'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $data = $cons->Consulta_COUNC_NOMBRE_Exist($escritura);
  if (isset($data)) {
      for ($i=0; $i <count($data) ; $i++) {
          echo"<option value='".$data[$i]['id_empleado_plant']."' >".$data[$i]['nombre_s']." ".$data[$i]['apellido_p']." ".$data[$i]['apellido_m']."</option>";
      }
  }
}
 if (isset($_POST['buscar_data'])) {
  $escritura = $_POST['buscar_data'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $data = $cons->info_datos_us($escritura);
  if (isset($data)) {
    echo"
    <table class='table'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>First</th>
        <th scope='col'>Last</th>
        <th scope='col'>Handle</th>
      </tr>
    </thead>
    <tbody>";
    $a =1;
  for ($i=0; $i < count($data) ; $i++) { 
        echo" <tr>
        <th scope='row'>".$a."</th>
        <td>".$data[$i]['nombre_empleado']."</td>
        <td>".$data[$i]['nombre_puesto_adr']."</td>
        <td>".$data[$i]['nombre_puesto']."</td>
      </tr>";
  }
    
     
  echo"</tbody>
  </table>
  
  
  ";
  } else {
    echo"No hay nada de este empleado";
  }
  

  

}

if (isset($_POST['Prueba_rfc'])) {
    require_once 'Algoritmo_fundado_RFC.php';
    $data = $_POST['Prueba_rfc'];
    $cons = new AlgoritmoRFC();
    $data = json_decode($data);
    $nombre_s = $data->nombre_s;
    $aplleido_p = $data->apllido_p;
    $aplleido_m = $data->apllido_m;
    $fecha_nacimiento = $data->fec_nac;
    $resp = $cons->CalcularRFC($nombre_s,$aplleido_p,$aplleido_m,$fecha_nacimiento);

    echo $resp;
}

if (isset($_POST['Matriz_empleado'])) {
  $id_emp = $_POST['Matriz_empleado'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $data = $cons->Sistemas_acceso_por_usuario($id_emp);
  echo "
  <table class='table text-center table-responsive  text-center  shadow p-1 bg-white rounded' style='height: 420px;'>
    <thead class='table-dark sticky-top'>
        <tr>
          <th scope='col'>#</th>
          <th scope='col'>Nombre del sistema</th>
          <th scope='col'>Proceso</th>
          <th scope='col'>Rol</th>
          <th scope='col'>Acción</th>
          <th scope='col'>Fecha alta</th>
          <th scope='col'>Fecha baja</th>
          <th scope='col'>Fecha Mov.</th>
          <th scope='col'>Usuario Captura</th>
        </tr>
      </thead>
    <tbody>
  ";
  if (isset($data)) {
    $e = 1;
    for ($i=0; $i < count($data) ; $i++) { 

      $proceso = $data[$i]['id_proc'];
      if ($proceso == 30) {
      $boton ="   <a class='btn btn-outline-danger'  data-toggle='tooltip' data-placement='top' title='Descarga Responsiva de la aplicación/sistema de ".$data[$i]['nombre_sistema']."' href='php/Resp_dinamica.php?id_usuario=" . $data[$i]["id_empleado"] . "&id_acceso=".$data[$i]["id_reg_acceso"]."' target='_blank'><i class='fas fa-file-pdf'></i></a>  <br>
        <a class='btn btn-outline-secondary' onclick='Retro_responsivas(".$data[$i]["id_reg_acceso"].",".$data[$i]["id_empleado"].")' data-toggle='tooltip' data-placement='top' title='Retroalimenta' href='#'  ><i class='fas fa-edit'></i></a> <br>
        <a class='btn btn-outline-secondary' onclick='Cancelar_responsiva2(".$data[$i]["id_reg_acceso"].",".$data[$i]["id_empleado"].")' data-toggle='tooltip' data-placement='top' title='Cancelar Acceso' href='#'  ><i class='fas fa-trash'></i></a>"
        ;
        $color_reow = "";
      } else if ($proceso == 31) {
        $boton ="<button type='button' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='Descarga documento' onclick='descarga_responsiva_firmada(\"".$data[$i]["rfc_corto"]."\",\"".$data[$i]["no_empleado"]."\",\"".$data[$i]["id_reg_acceso"]."\",\"".str_replace("-","_",$data[$i]["nombre_sistema"])."\")'><i class='fas fa-download'></i></a></button>
        <button type='button'  class='btn btn-info ' data-toggle='tooltip' data-placement='top' title='Editar acceso' onclick='cambiaroceso_resp(\"".$data[$i]["id_reg_acceso"]."\")' ><i class='fas fa-edit'></i></a></button>";
        $color_reow = "";
      }
      else {
        $boton ="<button type='button' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='Descarga documento' onclick='descarga_responsiva_firmada(\"".$data[$i]["rfc_corto"]."\",\"".$data[$i]["no_empleado"]."\",\"".$data[$i]["id_reg_acceso"]."\",\"".str_replace("-","_",$data[$i]["nombre_sistema"])."\")'><i class='fas fa-download'></i></a></button>
        ";
        $color_reow = "class=' table-dark'";
      }

      $rol ="";

      $saca_roles = $cons->saca_roles_sistemas_acceso($data[$i]['id_reg_acceso']);
      if (isset($saca_roles)) {
        for ($a=0; $a <count($saca_roles) ; $a++) { 
          $rol .= "<li>".$saca_roles[$a]['nombre_rol']."</li>\n";
        
        }
      } else {
        $rol ="";
      
      }
      $fecha_alta_Resp =$data[$i]['fecha_alta_resp'] !=  NULL ?   $data[$i]['fecha_alta_resp']->format('d/m/Y') : "";
      $fecha_baja_Resp = $data[$i]['fecha_baja_acceso_real'] !=  NULL ? $data[$i]['fecha_baja_acceso_real']->format('d/m/Y') : "";
      echo" <tr $color_reow>
      <th scope='row'>".$e++."</th>
      <td>".$data[$i]['nombre_sistema']."</td>
      <td>".$data[$i]['nombre_proc']."</td>
      <td>".$rol."</td>
      <td>".$boton."</td>
      <td>".$fecha_alta_Resp."</td>
      <td>".$fecha_baja_Resp."</td>
      <td>".$data[$i]['fecha_alta']->format('d/m/Y H:i')."</td>
      <td>".$data[$i]['user_alta']."</td>
    </tr>";
    }
  } else {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Ups!</strong> El empleado no tiene registrado algun acceso a los sistemas por el momento.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  
  echo"</tbody>
  </table>";

}
if (isset($_POST['Bandeja_empleados_por_sistema'])) {
  $id_sistema = $_POST['Bandeja_empleados_por_sistema'];
 echo "hola: ".$id_sistema;
}
if (isset($_POST['rolores_por_sistema'])) {
    include_once 'ConsultaADR.php';
    $id_sis = $_POST['rolores_por_sistema'];
    $cons = new ConsultaInfoADR();
    $datos = $cons->Roles_cat_roles_acceso($id_sis);

    echo"
    <div class='form-group row'>
    <div class='col-sm-2'>Rol o privilegio</div>
    <div class='col-sm-10' id= 'selec_rol'>";
    if (isset($datos)) {
      for ($i=0; $i < count($datos) ; $i++) {
        echo"<div class='custom-control custom-checkbox'>
    <input type='checkbox' class='custom-control-input' name='Roles_asign' id='".$datos[$i]['id_rol']."' value='".$datos[$i]['id_rol']."'>
    <label class='custom-control-label' for='".$datos[$i]['id_rol']."'>
    ".$datos[$i]['nombre_rol']."
    </label>
</div>";
    }
    }
    else {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Ups!</strong> El sistema no tiene registrado algun rol o privilegio por el momento.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
    }
    



    echo"</div>
  </div>";

  
}
if (isset($_POST['saca_roles_res'])) {

        include_once 'ConsultaADR.php';
        $id_sis_acc = $_POST['saca_roles_res'];
        $cons = new ConsultaInfoADR();
        $datos_Rol = $cons->Roles_cat_acceso_por_sistema($id_sis_acc);
        $datos_act = $cons->Roles_cat_acceso_por_sistema_se($id_sis_acc);
          echo"
          <div class='row container'>
                    <!-- AQUI SE VALIDA SI QUIERE RETROALIMENTAR LA FIRMA DE LA RESPONSIVA -->
                    <div class='container row'>
                        <form class='form_example_asigna'>
                            <div class='form-group'>
                                <label for='exampleFormControlFile1'>Seleccione el documento:</label>
                                <input type='file' class='form-control-file' id='Carga_responsiva_firmada'
                                    name='Carga_responsiva_firmada'>
                            </div>
                        </form>
                        <div class='form-group col-md-3'>
                            <label for='NO_EMPLEADO'>Fecha que firma:<samp
                                    class='text-danger'>*</samp></label>
                            <input type='text' class='form-control datepicker-inline formato_campos_activos'
                                id='fec_firma_responsiva' name='fec_firma_responsiva' placeholder='yyyy/mm/dd'
                                required>
                        </div>
                    </div>
                </div>

                <div class='card' >
                <div class='card-header bg-dark text-white text-center'>
                    Roles:
                  </div>
                <ul class='list-group list-group-flush'>";
                for ($i=0; $i < count($datos_act) ; $i++) { 
                  echo"<li class='list-group-item'>".$datos_act[$i]['nombre_rol']."</li>";
                }
                 
                
                echo" </ul>
              </div>
                <div class='container mt-4'>
                  <button type='button' class='btn btn btn-outline-dark' id='boton_act_etid_roles' > Editar roles</button>
                  <button type='button' class='btn btn btn-outline-danger' onclick='Cancelar_responsiva2(\"$id_sis_acc\",\"".$datos_act[0]['id_empleado']."\")' id='cerrar_modal_responsiva_retro'
                  data-dismiss='modal'> Cancelar responsiva</button>
                </div>
                <div class='container row' style='display:none;'id='revisa_edit_roles'>
                    <div id='roles_actv'>
                    <div class='form-group row'>
                    <div class='col-sm-8'>Rol o privilegio a seleccionar</div>
                    <div class='col-sm-10' id= 'selec_rol2'>";
                      if(isset($datos_Rol)){
                          for ($i=0; $i < count($datos_Rol) ; $i++) {
                    
                            echo"<div class='custom-control custom-checkbox'>
                            <input type='checkbox' class='custom-control-input' name='Roles_asign' id='".$datos_Rol[$i]['id_rol']."' value='".$datos_Rol[$i]['id_rol']."'>
                            <label class='custom-control-label' for='".$datos_Rol[$i]['id_rol']."'>
                            ".$datos_Rol[$i]['nombre_rol']."
                            </label>
                        </div>";
                        }
                      }
                    echo"</div>
                    <button type='button' onclick='Modifica_roles_resp_empleado2(\"$id_sis_acc\",\"".$datos_act[0]['id_empleado']."\")' class='btn btn-dark'>Guardar cambios</button>
                    </div>
                    </div>

              <script>
              $(document).ready(function(){
                $('#boton_act_etid_roles').on('click',function(){
                  $('#revisa_edit_roles').toggle();
                  
              })
              $('#fec_firma_responsiva').datepicker({
                endDate: 'today',
                autoclose: true,
                //daysOfWeekDisabled: [0, 6],
                todayHighlight: true,
                format: 'yyyy/mm/dd',
                toggleActive: true,
                language: 'es'
              });
              })
              function Modifica_roles_resp_empleado2(id_acceso,id_empleado) {
                var selected = '';
                var roles = '';
                $('input:checkbox[name=Roles_asign]:checked').each(function () {
                  if (this.checked) {
                    roles += $(this).val() + ', ';
                  }
              
                });
              
                if (roles != '') {
                 
                    var json = {
                      id_acceso: id_acceso,
                      roles: roles
                    }
                    var datos = JSON.stringify(json)
                    $.ajax({
                      type: 'POST',
                      url: 'php/consulta_dat.php',
                      data: {
                        datos_para_reg2: datos
                      },
                      dataType: 'HTML',
                      success: function (response) {
                        toastr.success(response, 'Notificacion')
                        // Revisa_info_det_us(id_empleado)
                        Retro_responsivas(id_acceso,id_empleado)
                        //Historial_registro_sistemas(id_empleado)
                      }
                    });
                  
                } else {
                  alert('Tienes quue sleeccionar los roles que asigna a la cuenta')
                }
              }
              </script>
         ";
}
if (isset($_POST['Actualiza_resp'])) {
  include_once 'ConsultaADR.php';
  include_once "sesion.php";
  $cons = new ConsultaInfoADR();
  
  //$accion = $cons->Manda_datos();
  // echo"hola";

  $data = json_decode($_POST['Actualiza_resp']);
  $fec_resp =   $data->fecha_resp_alta;
  $id_accesos = $data->id_acceso;

  $resultado = $cons->Se_carga_responsiva_firmada_afecta_base($id_accesos,$fec_resp);

  if ($resultado) {
    echo $resultado;
    $_SESSION['nombre_archivo_ses'] = $id_accesos;
  } else {
    echo $resultado;

  }
  

  // echo $fec_resp." // ".$id_accesos;
}
if (isset($_POST['datos_para_reg'])) {
  include_once 'ConsultaADR.php';
  
  $cons = new ConsultaInfoADR();
  
  //$accion = $cons->Manda_datos();

  $datos = $_POST['datos_para_reg'];
  $data = json_decode($datos);
  $sistema = $data->sistema;
  $fec_resp =   $data->fecha;
  $roles =   $data->roles;
  $id_emp = $data->id_empleado;
  $array_roles = explode(',',$roles);
  $filtro = $cons->Revisa_cuenta_activa_sistema($id_emp,$sistema);
  if ($filtro == true) {
    echo"No se puede registrar el acceso a este sistema por que el empleado ya cuenta con un acceso anterior a este, tiene que darlo de baja para poder realizar este registro.";
  } else {
    $resultado = $cons->Agrega_sistema_acceso_al_empleado($sistema,$id_emp,$array_roles,$fec_resp);
    echo $resultado;
  }
  

}
if (isset($_POST['datos_para_reg2'])) {
  include_once 'ConsultaADR.php';
  
  $cons = new ConsultaInfoADR();
  
  //$accion = $cons->Manda_datos();

  $datos = $_POST['datos_para_reg2'];
  $data = json_decode($datos);
  $id_ac = $data->id_acceso;
  $roles =   $data->roles;
  $array_roles = explode(',',$roles);
  
  $resultado = $cons->Modifica_roles_acceso_al_empleado($id_ac,$array_roles);
  echo $resultado;
}
if (isset($_POST['Retro_resp_por_user'])) {
  include_once 'ConsultaADR.php';
  
  $cons = new ConsultaInfoADR();
  
  //$accion = $cons->Manda_datos();

  $datos = $_POST['Retro_resp_por_user'];
  $data = json_decode($datos);
  $sistema = $data->sistema;
  $fec_resp =   $data->fecha;
  $roles =   $data->roles;
  $id_emp = $data->id_empleado;
  $array_roles = explode(',',$roles);
  
  $resultado = $cons->Agrega_sistema_acceso_al_empleado($sistema,$id_emp,$array_roles,$fec_resp);
  echo $resultado;
}

if(isset($_POST['cancelar_acceso2'])){
  $id_acceso = $_POST['cancelar_acceso2'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $resp = $cons->Borra_acceso_y_borra_registro($id_acceso);
  echo $resp;
}

if (isset($_POST['reg_sistema'])) {
  include_once 'sesion.php';
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos = json_decode($_POST['reg_sistema']);
  $resp = $cons->Registra_sistema($datos);
  $_SESSION['nombre_archivo_ses']=  $resp;
  if (isset($resp)){
  echo true;
  }
  else {
    echo $resp;
  }

}
if (isset($_POST['Actualiza_sistema'])) {
  include_once 'sesion.php';
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos = json_decode($_POST['Actualiza_sistema']);
  $resp = $cons->Actualiza_sistema($datos);
  $_SESSION['nombre_archivo_ses']=  $datos->id_system;
  if ($resp){
  echo true;
  }
  else {
    echo $resp;
  }

}
if(isset($_POST['cambia_est_resp'])){
  $data = json_decode($_POST['cambia_est_resp']) ;
  $id_acceso = $data->id_acc;
  $estatus = $data->estado;
  $fecha = $data->fecha;
  include_once "ConsultaADR.php";
  include_once "sesion.php";
  $cons = new ConsultaInfoADR();
  $metodo = $cons->Actualiza_responsiva_us($id_acceso,$estatus,$fecha);
  echo $metodo;

}
?>

