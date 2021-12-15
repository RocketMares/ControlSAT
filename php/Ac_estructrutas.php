<?php

if (isset($_POST["auto_admin_name"])) {
$id_admin = $_POST['auto_admin_name'];
include_once 'MetodosUsuarios.php';
$consulta = new MetodosUsuarios();
$resultado = $consulta->Consulta_AUTO_Admin($id_admin);
echo $resultado[0]['nombre_admin'];

}
if (isset($_POST["auto_sbu_name"])) {
$id_sub = $_POST['auto_sbu_name'];
include_once 'MetodosUsuarios.php';
$consulta = new MetodosUsuarios();
$resultado = $consulta->Consulta_AUTO_Subadmin($id_sub);
echo $resultado[0]['nombre_sub_admin'];

}
if (isset($_POST["auto_admin_name_corto"])) {
$id_admin = $_POST['auto_admin_name_corto'];
include_once 'MetodosUsuarios.php';
$consulta = new MetodosUsuarios();
$resultado = $consulta->Consulta_AUTO_Admin($id_admin);
echo $resultado[0]['nombre_corto'];

}
if (isset($_POST["auto_dep_name"])) {
$id_sub = $_POST['auto_dep_name'];
include_once 'MetodosUsuarios.php';
$consulta = new MetodosUsuarios();
$resultado = $consulta->Consulta_AUTO_dep($id_sub);
echo $resultado[0]['nombre_depto'];

}

if (isset($_POST['Obtener_datos_admin'])) {
$id_admin = $_POST['Obtener_datos_admin'];
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Consulta_AUTO_Admin($id_admin);
header('Content-type: application/json; charset=utf-8');
echo json_encode($datos_admin);

}

if (isset($_POST['Act_admin'])) {
$admin_act = $_POST['Act_admin'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Actualizar_datos_Admin($datros);
echo $datos_admin;
}
if (isset($_POST['reg_admin'])) {
$admin_act = $_POST['reg_admin'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->registrar_datos_Admin($datros);
echo $datos_admin;
}
if (isset($_POST['reg_dep'])) {
$admin_act = $_POST['reg_dep'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->registrar_datos_deptos($datros);
echo $datos_admin;
}
if (isset($_POST['Act_dep'])) {
$admin_act = $_POST['Act_dep'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Actualizar_datos_deps($datros);
echo $datos_admin;
}
if (isset($_POST['reg_sub_admin'])) {
$admin_act = $_POST['reg_sub_admin'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->registrar_datos_Admin($datros);
echo $datos_admin;
}
if (isset($_POST['Act_sub'])) {
$admin_act = $_POST['Act_sub'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Actualizar_datos_Admin($datros);
echo $datos_admin;
}
if (isset($_POST['registra_posision'])) {
$admin_act = $_POST['registra_posision'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Registra_psosion($datros);
echo $datos_admin;
}

if (isset($_POST['reg_puesto_adr'])) {
$admin_act = $_POST['reg_puesto_adr'];
$datros =   json_decode($admin_act);
include_once 'MetodosUsuarios.php';
$metodos = new MetodosUsuarios();
$datos_admin= $metodos->Registra_puesto_ADR($datros);
echo $datos_admin;
}
if (isset($_POST['act_puesto_adr'])) {
    $admin_act = $_POST['act_puesto_adr'];
    $datros =   json_decode($admin_act);
    include_once 'MetodosUsuarios.php';
    $metodos = new MetodosUsuarios();
    $datos_admin= $metodos->Actualiza_puesto_ADR($datros);
    echo $datos_admin;
    }