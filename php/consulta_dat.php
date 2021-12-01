<?php

if (isset($_POST['datos'])) {
   $id_user = $_POST['datos'];
    include_once "ConsultaADR.php";
    $cons = new ConsultaInfoADR();
    $datos_us = $cons->info_datos_us($id_user);
    if (isset($datos_us)) {
        $nombre_empleado = $datos_us[0]['nombre_empleado'];
        $no_emppleado = $datos_us[0]['no_empleado'];
        $nombre_puest_fun = $datos_us[0]['nombre_puesto'];
        $nombre_puest_ADR = $datos_us[0]['nombre_puesto_adr'];
        $Rfc_corto = $datos_us[0]['rfc_corto'];
        $nombramiento = $datos_us[0]['tipo_nombramiento'];
    
        echo "
        <div class='row  container-fluid mt-5 my-5' id ='vista'>
        <div class='col-sm-3 text-center ' >
        <div id='imagen_empleado'>
        <button type='button' id='muestra_boton' style='display:none;' class='btn btn-outline-primary'>Cambiar Foto.</button>
        </div>
         <br>
      
          <img src='img/fotos_empleados/$no_emppleado.jpg'  class='rounded-circle ' style='height: 200px; width: 200px ;border: solid 4px black;' alt=''>
     
          </div>
         
        <div class='col-sm-9'>
          <div class='card'>
            <div class='card-header card'>
              Información general del usuario:
            </div>
            <ul class='list-group list-group-flush '>
              <li class='list-group-item'>$nombre_empleado</li>
              <li class='list-group-item'>$nombre_puest_fun</li>
              <li class='list-group-item'>$nombre_puest_ADR</li>
              <li class='list-group-item'>$no_emppleado</li>
              <li class='list-group-item'>$Rfc_corto</li>
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

  

}
if (isset($_POST['act_area_asignada'])) {
  include_once "ConsultaADR.php";
   $cons = new ConsultaInfoADR();
  $entre = $_POST['act_area_asignada'];
  $datos = json_decode($entre);
  $datos = $cons->Actualiza_area_y_jefe_insumo($datos);
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
  for ($i=0; $i < count($datos_plaza) ; $i++) { 
    echo"<option value='".$datos_plaza[$i]['id_num_posision']."'>".$datos_plaza[$i]['id_num_posision']."</option>";
  }
   
}
 if(isset($_POST['mov_insumos'])){
  $id_insumo = $_POST['mov_insumos'];
  include_once "ConsultaADR.php";
  $cons = new ConsultaInfoADR();
  $datos = $cons->Movimientos_del_personal($id_insumo);
  echo "
  <table class='table text-center table-striped table-responsive shadow-sm'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>Proceso</th>
      <th scope='col'>Fecha</th>
      <th scope='col'>Usuario Captura</th>
      <th scope='col'>Sub.</th>
      <th scope='col'>Dep.</th>
      <th scope='col'>Posisión.</th>
      <th scope='col'>Nombramiento.</th>
      <th scope='col'>Jefe directo</th>
      <th scope='col'>Puesto ADR.</th>
    </tr>
  </thead>
  <tbody>";
  $j =1;
  if (isset($datos)) {
    for ($i=0; $i <count($datos) ; $i++) { 
      echo" <tr>
      <th scope='row'>".$j++."</th>
      <td>".$datos[$i]['nombre_proc']."</td>
      <td>".$datos[$i]['fecha_alta']->format('d-m-Y H:i')."</td>
      <td>".$datos[$i]['user_alta']."</td>
      <td>".$datos[$i]['sub_admin']."</td>
      <td>".$datos[$i]['depto']."</td>
      <td>".$datos[$i]['id_num_posision']."</td>
      <td>".$datos[$i]['tipo_nombramiento']."</td>
      <td>".$datos[$i]['jefe_directo']."</td>
      <td>".$datos[$i]['puesto']."</td>
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
  
  //$datos = $cons->Consulta_datos_plaza($data);

}

?>

