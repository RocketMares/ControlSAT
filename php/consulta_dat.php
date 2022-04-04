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
       echo"<button type='button' class='btn btn-success' onclick='descarga_documento(\"".$datos[$i]["rfc_corto"]."\",\"".$datos[$i]["no_empleado"]."\",\"".$datos[$i]["id_oficio_gen"]."\",\"".str_replace("-","_",$datos[$i]["id_num_oficio"])."\",\"".$datos[$i]["tipo_oficio"]."\")'>Ver documento Cargado</button>";
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

?>

