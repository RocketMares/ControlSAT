<?php

if (isset($_POST["id_admin"])) {
    include_once 'MetodosUsuarios.php';
    $resultado = new MetodosUsuarios();
    $id_admin = $_POST["id_admin"];
    $resultado_area = $resultado->Consulta_Subadmin($id_admin);
    $html[] = null;
    for ($i = 0; $i < count($resultado_area); $i++) {
        $contenido = "<option value='" . $resultado_area[$i]["id_sub_admin"] . "'>" . $resultado_area[$i]["nombre_sub_admin"] . "</option>";
        $html[$i] = $contenido;
    }
    echo "<option value='0'>Seleccionar Subadministración</option>";
    for ($i = 0; $i < count($html); $i++) {
      echo "$html[$i]";
    }
}elseif (isset($_POST["id_sub_admin"])) {
    include_once 'MetodosUsuarios.php';
    $resultado = new MetodosUsuarios();
    $id_sub_admin = $_POST["id_sub_admin"];
    $resultado_dep = $resultado->Consulta_Depto_sub($id_sub_admin);
    if (is_array($resultado_dep)) {
      $html[] = null;
      for ($i = 0; $i < count($resultado_dep); $i++) {
          $contenido = "<option value='" . $resultado_dep[$i]["id_depto"] . "'>" . $resultado_dep[$i]["nombre_depto"] . "</option>";
          $html[$i] = $contenido;
      }
      $opcions =  "<option value='0'>Seleccionar Departamento</option>";
      for ($i = 0; $i < count($html); $i++) {
        $opcions .=  $html[$i];
      }
      echo $opcions;
    } else {
      $opcions =  "<option value='0'>$resultado_dep</option>";
      echo $opcions;
    }
  }
  if (isset($_POST['id_sub_admin1'])) {
    include_once 'MetodosUsuarios.php';
    $resultado = new MetodosUsuarios();
    $id_sub_admin = $_POST["id_sub_admin1"];
    $resultado_dep = $resultado->Consulta_Depto_sub($id_sub_admin);
    return $resultado_dep['nombre_depto'];

  }
  if (isset($_POST['nom_dep'])) {
    include_once 'MetodosUsuarios.php';
    $resultado = new MetodosUsuarios();
    $nom_dep = $_POST["nom_dep"];
    $resultado_dep = $resultado->Consulta_Depto_sub($nom_dep);
    return "value= '".$resultado_dep['nombre_depto']."'";

  }

  if (isset($_POST['nombre_puesto_adr'])) {
    include_once 'MetodosUsuarios.php';
    $resultado = new MetodosUsuarios();
    $nom_dep = $_POST["nombre_puesto_adr"];
    $resultado_dep = $resultado->Consulta_Puestos_us_insu_filtro($nom_dep);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($resultado_dep);
    

  }
  if (isset($_POST['filtra_jefe_por_dep'])) {
    include_once 'ConsultaADR.php';
    $resultado = new ConsultaInfoADR();
    $nom_dep = $_POST["filtra_jefe_por_dep"];
    $resultado_dep = $resultado->Consulta_Jefe_por_deps($nom_dep);
    if (isset($resultado_dep)) {
      echo"<option value= '0'>Seleccion de opciones</option>";
      for ($i=0; $i <count($resultado_dep) ; $i++) { 
        echo "<option value= '".$resultado_dep[$i]['id_empleado_plant']."'>".$resultado_dep[$i]['nombre_empleado']."</option>";
      }
  
    }
    else {
      echo"<option value= '0'>Seleccion de opciones</option>";
    }
  }