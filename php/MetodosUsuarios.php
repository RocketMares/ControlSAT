<?php

class MetodosUsuarios 
{
  public function estados_plaza(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT  [id_proc]
    ,[nombre_proc]
    ,[fecha_alta]
    ,[user_alta]
    FROM [Control_Ingresos].[dbo].[Procesos] where
    [id_proc] in ( 4,5,13 )";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function cat_escolar(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT [id_escolaridad]
    ,[nombre_escolaridad]
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
FROM [Control_Ingresos].[dbo].[cat_escolaridad] where estatus = 'A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function cat_nombramientos(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT  [id_tipo_nombramiento]
    ,[nombre_nombramiento]
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
FROM [Control_Ingresos].[dbo].[cat_nombramiento] WHERE estatus ='A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function cat_sindicatos(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT  [id_sindicato]
    ,[nombre_sindical]
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
FROM [Control_Ingresos].[dbo].[cat_sindical] WHERE estatus = 'A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  } 
   public function cat_jerarquia(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT  [id_nivel_jer]
    ,[nombre_nombramiento]
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
    FROM [Control_Ingresos].[dbo].[cat_nivel_jerarquico] where estatus = 'A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function cat_estatus_escolar(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT id_estatus_escolaridad
    ,nombre_estatus_escolaridad
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
FROM [Control_Ingresos].[dbo].[cat_estatus_escolar] where estatus = 'A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function cat_estatus_civil(){
    include_once 'sesion.php';
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT  [id_estado_civil]
    ,[nombre_estado_civil]
    ,[estatus]
    ,[fecha_alta]
    ,[user_alta]
    ,[fecha_modf]
    ,[user_modf]
FROM [Control_Ingresos].[dbo].[cat_estado_civil] where estatus ='A'";
     $prepare = sqlsrv_query($con,$query);
     if($prepare){
         while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
             $fila[] = $row;
         }
         if (isset($fila)) {
             return $fila;
             $conexion->CerrarConexion($con);
         }else{
             return null;
             $conexion->CerrarConexion($con);
         }
     }else{
         return print_r(sqlsrv_errors(),true);
         $conexion->CerrarConexion($con); 
     }        
  }
  public function Consulta_datos_admins(){
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT id_admin  ,nombre_admin
    ,nombre_corto
    ,nombre_sigla
    ,estatus
    ,user_alta
    ,fecha_alta
    ,user_mod
    ,fecha_mod
    ,user_baja
    ,fecha_baja
    ,unidad
  ,telefono
  ,direccion
FROM [Control_Ingresos].[dbo].[Administracion]";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila[] = $row;
      }
      if (isset($fila)) {
        return $fila;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
  public function Para_responsiva1($id_empleado,$admin)
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT 
    Emp.nombre_empleado,
    Emp.no_empleado,
    Emp.fecha_alta,
    Emp.rfc_corto,
    adminx.direccion,
    Emp.correo,
    Emp.user_alta,
    per.nombre_perfil,
    dep.nombre_depto,
    (select nombre_empleado from [Empleados_usuario] where id_perfil = 1 AND estatus = 'A' AND id_puesto = 1 AND id_admin = $admin) As jefe,
    (select correo from [Empleados_usuario] where id_perfil = 1 AND estatus = 'A' AND id_puesto = 1 AND id_admin = $admin) As correo_jefe,
    (select rfc_corto from [Empleados_usuario] where id_perfil = 1 AND estatus = 'A' AND id_puesto = 1 AND id_admin = $admin) As rfc_jefe
    FROM [Empleados_usuario] Emp
    INNER JOIN Administracion adminx ON Emp.id_admin = adminx.id_admin
    INNER JOIN Puestos_usuario Pues ON Emp.id_puesto = Pues.id_puesto
    inner join Perfil per on Emp.id_perfil = per.id_perfil
    inner join Departamento dep on Emp.id_depto = dep.id_depto
    Where Emp.id_empleado_us = $id_empleado  And Emp.id_admin = $admin";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila = $row;
      }
      if (isset($fila)) {
        return $fila;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
  public function Consulta_AUTO_Subadmin($id_sub_admin)
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT * FROM SubAdmin WHERE id_sub_admin = $id_sub_admin AND estatus = 'A'";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila[] = $row;
      }
      if (isset($fila)) {
        return $fila;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
  public function Consulta_AUTO_dep($id_dep)
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT * FROM Departamento WHERE id_depto = $id_dep AND estatus = 'A'";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila[] = $row;
      }
      if (isset($fila)) {
        return $fila;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
  public function Valida_estructura_admin($nombre_admin,$unidad,$Abreb_act){
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT *  FROM Administracion where nombre_admin = '$nombre_admin' or nombre_sigla = '$Abreb_act' or unidad = $unidad";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila[] = $row;
      }
      if (isset($fila)) {
        return true;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
  public function Valida_estructura_deps($nombre_depto){
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT *  FROM [Departamento] where [nombre_depto] = '$nombre_depto'";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
        $fila[] = $row;
      }
      if (isset($fila)) {
        return true;
        $conexion->CerrarConexion($con);
      } else {
        return null;
        $conexion->CerrarConexion($con);
      }
    } else {
      return print_r(sqlsrv_errors(), true);
      $conexion->CerrarConexion($con);
    }
  }
   public function registrar_datos_Admin($datos)
  {   include_once 'sesion.php';
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $user_alta = $_SESSION["ses_rfc_corto_ing"];
      $nombre_admin = $datos->nombre_admin;
      $unidad = $datos->unidad;
      $direc_act = $datos->direc_act;
      $Abreb_act = $datos->Abreb_act;
      $telefono_admin = $datos->telefono_admin;
      $filtro = self::Valida_estructura_admin($nombre_admin,$unidad,$Abreb_act);
      if($filtro == true){//valuda que no exista alguna coincidencia 
        echo "Se valida que ya se encuentra activa una Administracion con el nombre, unidad o sigla cargada en el sistema\n
        revise los datos nuevamente para poder realizar la carga de los datos correctamente";
      }
      else {
        $query = "INSERT INTO Administracion (
          nombre_admin,
          nombre_corto,
          nombre_sigla,
          unidad,
          direccion,
          telefono,
          fecha_alta,
          user_alta
          ,estatus)
          values ('$nombre_admin','$Abreb_act','$Abreb_act',$unidad ,'$direc_act',$telefono_admin,GETDATE(),'$user_alta','A')";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == true) {
            return 'Se actualizo Exitosamente';
            $conexion->CerrarConexion($con);
        } else {
            return "Algo no salbio bien (".print_r(sqlsrv_errors(),true).")";
            $conexion->CerrarConexion($con);
        }
      }
     
  }
  public function registrar_datos_deptos($datos)
  {   include_once 'sesion.php';
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $user_alta = $_SESSION["ses_rfc_corto_ing"];
      $ADMIN = $datos->admin;
      $Sub = $datos->sub;
      $nombre_deps = $datos->nombre_dep;
     
      $filtro = self::Valida_estructura_deps($nombre_deps);
      if($filtro == true){//valuda que no exista alguna coincidencia 
        echo "Se valida que ya se encuentra activo el departamento en el sistema\n
        revise los datos nuevamente para poder realizar la carga de los datos correctamente";
      }
      else {
        $query = "  INSERT INTO Departamento
        ([id_admin]
            ,[id_sub_admin]
            ,[nombre_depto]
            ,[estatus]
            ,[user_alta]
            ,[fecha_alta])
          VALUES($ADMIN,$Sub,'$nombre_deps','A','$user_alta',GETDATE())";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == true) {
            return 'Se actualizo Exitosamente';
            $conexion->CerrarConexion($con);
        } else {
            return "Algo no salbio bien (".print_r(sqlsrv_errors(),true).")";
            $conexion->CerrarConexion($con);
        }
      }
     
  }
  public function Actualizar_datos_Admin($datos)
  {   include_once 'sesion.php';
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $user_alta = $_SESSION["ses_rfc_corto_ing"];
      $admin_asoc = $datos->admin_asoc;
      $nombre_admin = $datos->nombre_admin_cam;
      $unidad = $datos->unidad;
      $direc_act = $datos->direc_act;
      $Abreb_act = $datos->Abreb_act;
      $telefono_admin = $datos->telefono_admin;
      $estatus = $datos->estatus;
      switch ($estatus) {
            case 'A':
            $query = "  UPDATE Administracion  
            set nombre_admin = '$nombre_admin'
            ,unidad = $unidad
            ,direccion = '$direc_act'
            ,nombre_corto = '$Abreb_act'
            ,nombre_sigla = '$Abreb_act'
            ,telefono = '$telefono_admin'
            ,user_mod = '$user_alta'
            ,estatus = 'A'
            ,fecha_mod = GETDATE()
            where id_admin = $admin_asoc";
            break;
            case 'N':
            $query = "  UPDATE Administracion  
            set nombre_admin = '$nombre_admin'
            ,unidad = $unidad
            ,direccion = '$direc_act'
            ,nombre_corto = '$Abreb_act'
            ,nombre_sigla = '$Abreb_act'
            ,telefono = '$telefono_admin'
            ,user_mod = '$user_alta'
            ,estatus = 'N'
            ,fecha_mod = GETDATE()
            where id_admin = $admin_asoc";
            break;
            default:
            $query = "  UPDATE Administracion  
            set nombre_admin = '$nombre_admin'
            ,unidad = $unidad
            ,direccion = '$direc_act'
            ,nombre_corto = '$Abreb_act'
            ,nombre_sigla = '$Abreb_act'
            ,telefono = '$telefono_admin'
            ,user_mod = '$user_alta'
            ,fecha_mod = GETDATE()
            where id_admin = $admin_asoc";
            break;
      }

      $prepare = sqlsrv_query($con, $query);
      if ($prepare == true) {
          return 'Se actualizo Exitosamente';
          $conexion->CerrarConexion($con);
      } else {
          return 'Algo no salbio bien';
          $conexion->CerrarConexion($con);
      }
  }
  public function Actualizar_datos_deps($datos)
  {   include_once 'sesion.php';
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $user_alta = $_SESSION["ses_rfc_corto_ing"];
      $admins = $datos->admin;
      $sub = $datos->sub;
      $nombre_dep = $datos->nombre_dep;
      $estatus_dep = $datos->estatus;
      $dep_asoc = $datos->dep_asoc;
     
      switch ($estatus_dep) {
            case 'A':
            $query = "    UPDATE Departamento SET
            [id_admin] = $admins
            ,[id_sub_admin] = $sub
            ,[nombre_depto] = '$nombre_dep'
            ,[estatus] = 'A'
            ,[user_mod] = '$user_alta'
            ,[fecha_mod]= GETDATE() 
            WHERE id_depto = $dep_asoc ";
            break;
            case 'N':
              $query = " UPDATE Departamento SET
              [id_admin] = $admins
              ,[id_sub_admin] = $sub
              ,[nombre_depto] = '$nombre_dep'
              ,[user_baja] = '$user_alta'
              ,[estatus] = 'N'
              ,[fecha_baja]= GETDATE() 
              WHERE id_depto = $dep_asoc ";
            break;
            default:
            $query = "UPDATE Departamento SET
            [id_admin] = $admins
            ,[id_sub_admin] = $sub
            ,[nombre_depto] = '$nombre_dep'
            ,[user_mod] = '$user_alta'
            ,[fecha_mod]= GETDATE() 
            WHERE id_depto = $dep_asoc ";
            break;
      }

      $prepare = sqlsrv_query($con, $query);
      if ($prepare == true) {
          return 'Se actualizo Exitosamente';
          $conexion->CerrarConexion($con);
      } else {
          return 'Algo no salbio bien';
          $conexion->CerrarConexion($con);
      }
  }
  public function Actualizar_datos_Sub_admin($admin, $sub_admin_asoc, $nombre_sub, $estatus)
  {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $user_alta = $_SESSION["ses_rfc_corto"];
      switch ($estatus) {
          case 'A':
              $query = "UPDATE SubAdmin  
              set nombre_sub_admin = '$nombre_sub'
              , id_admin = $admin 
              , user_mod = '$user_alta'
              , estatus = 'A'
              ,fecha_mod = GETDATE()
              where id_sub_admin = $sub_admin_asoc";
              break;
          case 'N':
              $query = "UPDATE SubAdmin  
              set nombre_sub_admin = '$nombre_sub'
              , id_admin = $admin 
              , user_mod = '$user_alta'
              , estatus = 'N'
              ,fecha_mod = GETDATE()
              where id_sub_admin = $sub_admin_asoc";
              break;
          default:
              $query = "UPDATE SubAdmin  
              set nombre_sub_admin = '$nombre_sub'
              , id_admin = $admin 
              , user_mod = '$user_alta'
              ,fecha_mod = GETDATE()
              where id_sub_admin = $sub_admin_asoc";
              break;
      }

      $prepare = sqlsrv_query($con, $query);
      if ($prepare == true) {
          return 'Se actualizo Exitosamente';
          $conexion->CerrarConexion($con);
      } else {
          return 'Algo no salbio bien';
          $conexion->CerrarConexion($con);
      }
  }
  public function Consulta_AUTO_Admin($id_admin)
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    $query = "SELECT 
              id_admin
              ,nombre_admin
              ,nombre_corto
              ,nombre_sigla
              ,estatus
              ,user_alta
              ,fecha_alta
              ,user_mod
              ,fecha_mod
              ,user_baja
              ,fecha_baja
              ,unidad
              ,telefono
              ,direccion
              FROM Administracion
              WHERE id_admin = $id_admin AND estatus = 'A'";
    $prepare = sqlsrv_query($con, $query);
    if($prepare){
      while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
          $fila = $row;
      }
      if (isset($fila)) {
          return $fila;
          $conexion->CerrarConexion($con);
      }else{
          return null;
          $conexion->CerrarConexion($con);
      }
  }else{
      return print_r(sqlsrv_errors(),true);
      $conexion->CerrarConexion($con); 
  }        
}
  public function ConsultaAsistenciasHoy($id_admin)
  {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
      $con = $conexion->ObtenerConexionBD();
      $query = " SELECT DISTINCT
      Emp.nombre_empleado
      ,(SELECT rfc_corto FROM Empleado WHERE nombre_empleado = Emp.nombre_empleado ) AS RFC
      ,(SELECT TOP (1) MIN(Fecha_ini) FROM Registro_session WHERE id_empleado_us = Emp.id_empleado_us AND DAY(Fecha_ini)= DAY(GETDATE()) ) AS Fecha_Ini  
      ,(SELECT TOP (1) MAX(Fecha_fin) FROM Registro_session WHERE id_empleado_us = Emp.id_empleado_us AND DAY(Fecha_fin)= DAY(GETDATE()) ) AS Fecha_fin 
      ,ip_recep_ini
      FROM Registro_session Reg
      INNER JOIN Empleado Emp ON Reg.id_empleado = Emp.id_empleado
       WHERE DAY(Fecha_ini)= DAY(GETDATE()) AND Emp.id_admin =$id_admin";
     $prepare = sqlsrv_query($con, $query);
     if ($prepare) {
         //SE DISPONE LA CONSULTA COMO UN ARREGLO
         while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC))    {
         $em=$row["nombre_empleado"];
         $rfc=$row["RFC"];
         $fecha_ini = ($row["Fecha_Ini"]==null) ?  "-" : $row["Fecha_Ini"]->format("Y/m/d H:i:s");
         $fecha_fin = ($row["Fecha_fin"]==null) ? "-" : $row["Fecha_fin"]->format("Y/m/d H:i:s");
      
             $filas[] = array(
               'Nombre' => $em,
              'rfc_corto' => $rfc,
               'Hora_inicio' => $fecha_ini,
              'Hora_Fin' => $fecha_fin,
               'IP_ubicación' => $row["ip_recep_ini"]);
             //$filas[] = array('Asistencia' => 1);
         }   
         if (isset($filas)) {
             return $filas;
         } else {
             return null;
         }
         sqlsrv_close($con);
     } else {
         return sqlsrv_errors();
         sqlsrv_close($con);
     }
 }
  public function Reg_SES()
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    session_start();
    $empleado = $_SESSION["ses_id_usuario_ing"];
    $query =
      "  Insert into Registro_session (
      [id_empleado]
      ,[Fecha_ini]
      ,[ip_recep_ini])
      values($empleado,
      GETDATE(),
      '" . $_SERVER['REMOTE_ADDR'] . "') 
       SELECT SCOPE_IDENTITY() as id_sess";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare) {
      sqlsrv_next_result($prepare);
      sqlsrv_fetch($prepare);
      $fila = array('id_sess' => sqlsrv_get_field($prepare, 0));
      if ($fila["id_sess"] != null) {
        return $fila;
      } else {
        return print_r(sqlsrv_errors(), true);
      }
    }
  }
  public function Registro_fin_sesion()
  {
    include_once 'conexion.php';
    $conexion = new ConexionSQL();
    $con = $conexion->ObtenerConexionBD();
    session_destroy();
    $id = $_SESSION["ses_id_sess_ing"];
    $query = "update Registro_session set Fecha_fin=GETDATE() where id_session = $id ";
    // se ingresa la conexi�n, el query, y los parametros
    $rst = sqlsrv_query($con, $query);

    if ($rst === false) {
      return sqlsrv_errors();
    }
  }
    public function Consulta_User_Existe($rfc_corto)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Empleados_usuario WHERE rfc_corto ='$rfc_corto' AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }        
    }

    public function Consulta_Cat_Jefes($id_admin)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM [Empleados_usuario] 
                WHERE id_admin = 1 
                AND id_puesto in (2,3,4,5) 
                AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }        
    }

    public function Consulta_Cat_Jefes_insumo()
    {
        include_once 'conexion.php';
        include_once 'sesion.php';
        $admin = $_SESSION['ses_id_admin_ing'];
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "    SELECT estatus,id_empleado_plant,CONCAT (nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado FROM Empleado_insumo 
        WHERE id_admin = $admin 
        AND id_puesto in (  
          4,
          15,
          17,
          18,
          19,
          20,
          21,
          22,
          25,
          30,
          31,
          32,
          34) 
        AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }        
    }

    public function Consulta_Datos_Usere($id_usuario)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT * FROM Empleados_usuario WHERE id_empleado_us = $id_usuario  ";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }        
    }

    public function Valida_Admin_Activo($id_admin)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Administracion WHERE id_admin ='$id_admin' AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return true;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Valida_Subadmin_Activo($id_sub_admin)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM SubAdmin WHERE id_sub_admin ='$id_sub_admin' AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return true;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Consulta_Subadmin($id_admin)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM SubAdmin WHERE id_admin = $id_admin AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }
    public function Consulta_Subadmin_()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM SubAdmin where estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Consulta_Depto($id_admin)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Departamento WHERE id_admin = $id_admin AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Consulta_Depto_sub($id_sub)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Departamento 
        WHERE id_sub_admin = $id_sub AND estatus = 'A'
        ORDER BY nombre_depto";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return print_r(sqlsrv_errors(),true);
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Consulta_Puestos()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM [Puestos_usuario]  WHERE estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }
    public function Consulta_Puestos_us_insu()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM [Puesto_ADR]  WHERE estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }
    public function Consulta_Puestos_Fun()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Puesto_FUMP WHERE estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }
    public function Valida_Dep_Activo($id_depto)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Departamento WHERE id_depto ='$id_depto' AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return true;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Valida_Perfil_Activo($id_perfil)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Perfil WHERE id_perfil ='$id_perfil' AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return true;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }    
    }

    public function Encriptado_Passwd($password)
    {
        $passwd = md5($password);
        return $passwd;
    }

    public function CambiarContrasenaUser($user,$pass)
    {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
  
      $query = "UPDATE Empleados_usuario SET passwd = '$pass' 
      WHERE no_empleado = $user";
      $con = $conexion->ObtenerConexionBD();
      $prepare = sqlsrv_query($con,$query);
      if ($prepare == false) {
          return false;
      }
    }

    public function CambiarContrasenaUser_ses($user,$pass)
    {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();
  
      $query = "UPDATE Empleados_usuario SET passwd = '$pass' 
      WHERE id_empleado_us = $user";
      $con = $conexion->ObtenerConexionBD();
      $prepare = sqlsrv_query($con,$query);
      if ($prepare == false) {
          return false;
      }
    }

    public function Consulta_user_exist($no_empleado)
    {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();// SE INSTANCIA LA CLASE CONEXIÓN
      //SE CREA UN QUERY
      $query = "SELECT * FROM Empleados_usuario WHERE (no_empleado = $no_empleado) AND (estatus = 'A') ";
        //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
      $con = $conexion->ObtenerConexionBD();
        //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
      $prepare = sqlsrv_query($con, $query);
      if ($prepare) {
        while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
          $filas = array('id_empleado_us' => $row["id_empleado_us"]);
        }
        if (isset($filas)) {
          return $filas;
        } else {
          return false;
        }
        $conexion->CerrarConexion($con);
      } else {
        return false;
      }
  
    }

    public function Consulta_user_exist2($no_empleado)
    {
      include_once 'conexion.php';
      $conexion = new ConexionSQL();// SE INSTANCIA LA CLASE CONEXIÓN
      //SE CREA UN QUERY
      $query = "SELECT * FROM Empleados_usuario WHERE (no_empleado = $no_empleado) AND (estatus = 'A') ";
        //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
      $con = $conexion->ObtenerConexionBD();
        //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
      $prepare = sqlsrv_query($con, $query);
      if ($prepare) {
        while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
          $filas = array('id_empleado_us' => $row["id_empleado_us"]);
        }
        if (isset($filas)) {
          return true;
        } else {
          return false;
        }
        $conexion->CerrarConexion($con);
      } else {
        return false;
      }
  
    }
    public function Consulta_usuarios_pag_num($id_admin){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "  SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_admin = $id_admin
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_pag($id_admin,$numero){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "   SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $numero
        AND sub.id_admin = $id_admin";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }
    
      public function Consulta_Perfiles()
      {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();// SE INSTANCIA LA CLASE CONEXIÓN
        //SE CREA UN QUERY
        $query = "SELECT * FROM Perfil ORDER BY nombre_perfil ASC";
          //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
          //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
        $prepare = sqlsrv_query($con, $query);
    
        if ($prepare) {
              //SE DISPONE LA CONSULTA COMO UN ARREGLO
          while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
            $filas[] = $row ;
          }
          return $filas;
          sqlsrv_close($con);
        } else {
          print_r(sqlsrv_errors(), true);
          sqlsrv_close($con);
        }
      }

      public function Consulta_usuarios_nombre_pag_num($id_admin,$nombre){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_admin = $id_admin
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_pag_num($id_admin,$id_sub_admin,$nombre){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_admin = $id_admin
        and sub.id_sub_admin = $id_sub_admin
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_dep_pag_num($id_admin,$id_sub_admin,$id_depto,$nombre){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_admin = $id_admin
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_dep_per_pag_num($id_admin,$id_sub_admin,$id_depto,$id_perfil,$nombre){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_admin = $id_admin
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        AND sub.id_perfil = $id_perfil
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_sub_pag_num($id_sub_admin){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_sub_admin = $id_sub_admin
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_perfil_pag_num($id_perfil){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_sub_admin = $id_perfil
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_sub_dep_pag_num($id_sub_admin,$id_depto){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		SELECT SUB.seq,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
        WHERE sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return count($filas);
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_sub_dep_pag($id_sub_admin,$id_depto,$inicio){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado  ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $inicio
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_perfil_pag($id_perfil,$inicio){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	  SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado  ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $inicio
        AND sub.id_perfil = $id_perfil
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_pag($id_admin,$nombre,$numero){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "						SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado  ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE SUB.seq >= $numero
        AND SUB.id_admin = $id_admin
        AND SUB.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (SUB.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_sub_pag($id_sub_admin,$inicio){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "		    				SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado  ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $inicio
        AND sub.id_sub_admin = $id_sub_admin
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_pag($id_admin,$id_sub_admin,$nombre,$numero){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "  SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
		    sub.nombre_empleado  ,
        sub.correo_inst,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $numero
        AND sub.id_admin = $id_admin
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_dep_pag($id_admin,$id_sub_admin,$id_depto,$nombre,$numero){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "  SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
	      sub.nombre_empleado  ,
        sub.correo_inst,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.seq >= $numero
        AND sub.id_admin = $id_admin
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Consulta_usuarios_nombre_sub_dep_per_pag($id_admin,$id_sub_admin,$id_depto,$id_perfil,$nombre,$numero){
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	  SELECT TOP 50 SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
	      sub.nombre_empleado  ,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
          WHERE sub.seq >= $numero
          AND sub.id_admin = $id_admin
          AND sub.id_sub_admin = $id_sub_admin
          AND sub.id_depto = $id_depto
          AND sub.id_perfil = $id_perfil
          AND sub.nombre_empleado like '%$nombre%' COLLATE SQL_Latin1_General_CP1_CI_AI
          ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
      }

      public function Valida_registro_user($datos)
      {
          if (self::Valida_usuario_activo($datos->rfc_corto) != true) {
              $resultado = self::Registrar_usuario($datos);
              return $resultado;
          } else {
              return "Error: El usuario a registrar, se encuentra activo en el sistema.";
          }
      }

      public function Registrar_usuario($datos)
      {
        include_once 'conexion.php';
        include_once 'sesion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $user = $_SESSION["ses_rfc_corto_ing"];
        $query = "INSERT INTO Empleados_usuario
                 (id_admin
                 ,id_sub_admin
                 ,id_depto
                 ,id_puesto
                 ,id_perfil
                 ,rfc_corto
                 ,no_empleado
                 ,nombre_empleado
                 ,correo
                 ,passwd
                 ,jefe_directo
                 ,estatus
                 ,user_alta
                 ,fecha_alta
                 ,responsiva)
                 SELECT 
                         ".$datos->id_admin." as id_admin
                        ,".$datos->id_sub_admin." as id_sub_admin
                        ,".$datos->id_depa." as id_depto
                        ,".$datos->puesto." as id_puesto
                        ,".$datos->perfil." as id_perfil
                        ,'".$datos->rfc_corto."' as rfc_corto
                        ,".$datos->no_emp." as no_empleado
                        ,'".$datos->nombre_u."' as nombre_empleado
                        ,'".$datos->correo."' as correo
                        ,'e10adc3949ba59abbe56e057f20f883e' as passwd
                        ,".$datos->jefe." as jefe_directo
                        ,'".$datos->estatus."' as estatus
                        ,'$user' as rfc_corto
                        ,GETDATE() AS fecha_alta
                        ,0 as responsiva";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare === false) {
            return "Error al intentar registrar el usuario: ".print_r(sqlsrv_errors(),true);
        }else{
            return "Registro exitoso.";
        }
      }

      public function Actualizar_usuario($datos)
      {
        include_once 'conexion.php';
        include_once 'sesion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $user = $_SESSION["ses_rfc_corto_ing"];
        $referencias_historial = self::Consulta_Datos_Usere($datos->id_empleado);
        if ($referencias_historial[0]['puesto']) {
          
        }
        $query = "UPDATE Empleados_usuario
                SET  id_admin = ".$datos->id_admin."
                    ,id_sub_admin =  ".$datos->id_sub_admin."
                    ,id_depto = ".$datos->id_depa."
                    ,id_puesto = ".$datos->puesto."
                    ,id_perfil = ".$datos->perfil."
                    ,rfc_corto = '".$datos->rfc_corto."'
                    ,no_empleado = '".$datos->no_emp."'
                    ,nombre_empleado = '".$datos->nombre_u."'
                    ,correo = '".$datos->correo."'
                    ,jefe_directo = ".$datos->jefe."
                    ,estatus = '".$datos->estatus."'
                    ,user_mod = '$user'
                    ,fecha_mod = GETDATE()
                    WHERE id_empleado_us = ".$datos->id_empleado;
        $prepare = sqlsrv_query($con,$query);
        if ($prepare === false) {
            return "Error al intentar actualizar el usuario: ".print_r(sqlsrv_errors(),true);
        }else{
            return "Actualización exitosa.";
        }
      }

    public function Valida_usuario_activo($rfc_corto)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT rfc_corto FROM Empleados_usuario 
                  WHERE rfc_corto = '$rfc_corto'
                  AND estatus = 'A'";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return true;
            $conexion->CerrarConexion($con);
          }else{
            return false;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }

    public function Consulta_por_perfil_sub_dep_pag_num($id_perfil,$id_sub_admin,$id_depto)
    {
      include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT SUB.seq,
        sub.id_empleado_us,
        sub.rfc_corto,
        sub.no_empleado,
        sub.nombre_empleado,
        sub.correo,
        sub.id_admin,
        lo.nombre_admin,
        sub.id_sub_admin,
        area.nombre_sub_admin,
        sub.id_depto,
        depa.nombre_depto,
        sub.id_perfil,
        per.nombre_perfil,
		pue.id_puesto,
		pue.nombre_puesto,
        case 
          WHEN (sub.estatus = 'A') THEN 'ACTIVO'
          ELSE 'NO ACTIVO'
        END AS estatus,
        case 
      WHEN (sub.responsiva = 0) THEN 'PENDIENTE'
      ELSE 'FIRMADA'
    END AS responsiva
        FROM (SELECT ROW_NUMBER() OVER(ORDER BY (fecha_alta) DESC) AS seq,
          * FROM Empleados_usuario) AS sub 
          INNER JOIN Administracion lo on lo.id_admin = sub.id_admin
          INNER JOIN SubAdmin area on area.id_sub_admin = sub.id_sub_admin
          INNER JOIN Departamento depa on depa.id_depto = sub.id_depto
		    INNER JOIN Puestos_usuario pue on pue.id_puesto = sub.id_puesto
        INNER JOIN Perfil per on per.id_perfil = sub.id_perfil
        WHERE sub.id_perfil = $id_perfil
        AND sub.id_sub_admin = $id_sub_admin
        AND sub.id_depto = $id_depto
        ORDER BY (sub.fecha_alta) DESC";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare) {
          while($row = sqlsrv_fetch_array($prepare,SQLSRV_FETCH_ASSOC)){
            $filas[] = $row;
          }
          if (isset($filas)) {
            return $filas;
            $conexion->CerrarConexion($con);
          }else{
            return null;
            $conexion->CerrarConexion($con);
          }
        }else{
          return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Para_responsiva($id_empleado)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT 
        enp.nombre_empleado,
        enp.fecha_alta,
        enp.rfc_corto,
        enp.RFC,
        enp.correo,
        enp.user_alta,
        enp.id_admin,
        per.nombre_perfil,
        dep.nombre_depto,
	      (SELECT nombre_empleado FROM [dbo].[Empleados_usuario]  where id_empleado_us = enp.jefe_directo) as jefe,
        (SELECT rfc_corto FROM [Empleados_usuario] where id_empleado_us = enp.jefe_directo) as rfc_jefe,
        (SELECT correo FROM [Empleados_usuario]  where id_empleado_us = enp.jefe_directo) as correo_jefe
            from 
            [Empleados_usuario] enp  
            inner join Perfil per on enp.id_perfil = per.id_perfil
            inner join Departamento dep on enp.id_depto = dep.id_depto
            where 
            enp.id_empleado_us=".$id_empleado;
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            while($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return $fila;
                $conexion->CerrarConexion($con);
            }else{
                return null;
                $conexion->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $conexion->CerrarConexion($con); 
        }        
    }
    
}
