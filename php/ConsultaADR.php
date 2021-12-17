<?php

class ConsultaInfoADR{
    public function Actualiza_posisiones_mantenimiento($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
        $query = "  UPDATE [Posisiones]
        SET
       [id_puesto_fump] = ".$datos->id_puesto."
      ,[id_num_posision] = ".$datos->num_posision."
      ,[id_proc] = CASE ".$datos->proc." WHEN 13 THEN 9  ELSE ".$datos->proc."  end
      ,[posision_jefe] = '".$datos->jefe_posision."'
      ,[nivel] =  '".$datos->nivel."'
      ,[Codigo_pres] =  '".$datos->clave_pres."'
      ,[sueldo_neto] = CASE '".$datos->sueldo."' WHEN '' THEN NULL ELSE '".$datos->sueldo."' END
      ,[user_mod] = '$user_alta'
      ,[fecha_mod] = GETDATE()
      WHERE id_posision =  ".$datos->id_posision."
        
      INSERT INTO [mov_Posisiones] 
      (
        [id_posision]
        ,[nombre_empleado]
        ,[puesto_fump]
        ,[id_num_posision]
        ,[posision_jefe]
        ,[nivel]
        ,[Codigo_pres]
        ,[sueldo_neto]
        ,[id_proc]
        ,[user_alta]
        ,[fecha_alta]
        ,[estatus]
      )
      SELECT
      ".$datos->id_posision."  AS [id_posision]
          ,(select Concat( emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) from Posisiones pos 
         FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
         where pos.[id_num_posision] = '".$datos->num_posision."'
        ) AS [nombre_empleado]
          ,(SELECT nombre_puesto FROM Puesto_FUMP WHERE id_puesto_fump = ".$datos->id_puesto." ) AS [puesto_fump]
          ,".$datos->num_posision." AS [id_num_posision]
          , CASE '".$datos->jefe_posision."'WHEN '' THEN NULL ELSE '".$datos->jefe_posision."' END  AS [posision_jefe]
          ,'".$datos->nivel."' AS [nivel]
          ,'".$datos->clave_pres."'  AS [Codigo_pres]
          ,CASE '".$datos->sueldo."'WHEN '' THEN NULL ELSE '".$datos->sueldo."' END AS [sueldo_neto]
          ,".$datos->proc." AS [id_proc]
          ,'$user_alta' AS [user_alta]
          ,GETDATE() AS [fecha_alta]
        ,'A' AS [estatus]
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
           return "Exito al actualizar";
         
            $conexion->CerrarConexion($con);
        }
    }
    public function Movimientos_de_plazas($id_plaza){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT [id_mov_posision]
        ,[id_posision]
        ,[nombre_empleado]
        ,[puesto_fump]
        ,[id_num_posision]
        ,[posision_jefe]
        ,[nivel]
        ,[Codigo_pres]
        ,[sueldo_neto]
        ,mov_pos.[id_proc]
        ,procc.nombre_proc
        ,mov_pos.[user_alta]
        ,mov_pos.[fecha_alta] 
        ,[user_mod]
        ,[fecha_mod]
        ,[user_baja]
        ,[fecha_baja]
        ,[estatus]
    FROM [Control_Ingresos].[dbo].[mov_Posisiones] mov_pos
    INNER JOIN Procesos procc ON procc.id_proc = mov_pos.id_proc
    WHERE id_posision = $id_plaza ORDER BY mov_pos.fecha_alta DESC";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }  
    }
    public function Consulta_datos_plaza($id_plaza){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "	   SELECT 
    
        busq.id_posision
        ,busq.id_empleado
        ,busq.[id_puesto_fump]
        ,busq.[id_proc]
        ,busq.nombre_proc
        ,busq.[user_alta]
        ,busq.[fecha_alta]
        ,busq.[estatus]
        ,busq.[posision_jefe]
        ,busq.[nivel]
        ,busq.[Codigo_pres]
        ,busq.[sueldo_neto]
        ,busq.Ocupante
        ,busq.id_num_posision
        ,busq.nombre_puesto
        ,busq.estado_analista
        ,busq.nombre_proc_analista
        ,busq.clave_puesto
      FROM( 
        SELECT 
        
         pos.[id_posision]
          , id_empleado
          ,emp.id_proc as estado_analista
          ,procc1.nombre_proc as nombre_proc_analista
          ,pos.[id_puesto_fump]
          ,[id_num_posision]
          ,pos.[id_proc]
          ,procc.nombre_proc
          ,pos.[user_alta]
          ,pos.[fecha_alta]
          ,pos.[user_mod]
          ,pos.[fecha_mod]
          ,pos.[user_baja]
          ,pos.[fecha_baja]
          ,pos.[estatus]
          ,pos.[posision_jefe]
          ,pos.[nivel]
          ,pos.[Codigo_pres]
          ,pos.[sueldo_neto]
          ,puest.nombre_puesto
          ,puest.clave_puesto
          ,Concat( emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) as Ocupante
       from [Control_Ingresos].[dbo].[Posisiones] pos
      FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
      INNER JOIN Procesos procc ON procc.id_proc = pos.id_proc 
      full JOIN Procesos procc1 ON procc1.id_proc = emp.id_proc 
      inner JOIN Puesto_FUMP puest ON puest.id_puesto_fump = pos.id_puesto_fump ) busq
      WHERE busq.id_posision = $id_plaza  ";
        $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila[] = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
    }
    public function Consulta_datos_Posisines_General(){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "	SELECT  COUNT(*) TOTAL
        FROM [Control_Ingresos].[dbo].[Posisiones] pos
        FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
        INNER JOIN Procesos procc ON procc.id_proc = pos.id_proc 
        INNER JOIN Puesto_FUMP puest ON puest.id_puesto_fump = pos.id_puesto_fump   ";
        $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila[] = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
    }
    public function inserta_historial_plazas($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $posision_anterior = $datos->posision_act;
        $id_empleado = $datos->id_empleado;
        $sueldo_neto = $datos->sueldo_neto;
        $proc = $datos->id_proc_plaza;
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
        if ($proc == 4 || $proc == 5 ) {
            $proc = 24;
        }
        else {
           $proc = $proc;
        }

        $query = "  INSERT INTO [mov_Posisiones](
            [id_posision]
                ,[nombre_empleado]
                ,[puesto_fump]
                ,[id_num_posision]
                ,[posision_jefe]
                ,[nivel]
                ,[Codigo_pres]
                ,[sueldo_neto]
                ,[id_proc]
                ,[user_alta]
                ,[fecha_alta]
                ,[estatus]
            )
          SELECT
                (select id_posision from Posisiones where id_num_posision ='$posision_anterior')  AS [id_posision]
                ,(SELECT CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado FROM Empleado_insumo WHERE id_empleado_plant = $id_empleado) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP where id_puesto_fump=(SELECT [id_puesto_fump] FROM Posisiones Where  id_num_posision = '$posision_anterior' ))  AS [puesto_fump]
                ,$posision_anterior AS [id_num_posision]
                ,(SELECT [posision_jefe] FROM Posisiones Where  id_num_posision = '$posision_anterior' ) AS [posision_jefe]
                ,(SELECT [nivel] FROM Posisiones Where  id_num_posision = '$posision_anterior' ) AS [nivel]
                ,(SELECT [Codigo_pres] FROM Posisiones Where  id_num_posision = '$posision_anterior' ) AS [Codigo_pres]
                ,CASE '$sueldo_neto' WHEN '' THEN NULL else '$sueldo_neto'END AS [sueldo_neto]
                ,$proc AS [id_proc]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus]
              ";
        $resultado = sqlsrv_query($con,$query);
        if ($resultado == true) {
            if ( $datos->id_proc_plaza == 4 ||  $datos->id_proc_plaza == 5 ) {
                return $activa_segundo_procesos = self::Inserta_historial_cambio_de_plza($datos);
            }
            else {
                return "Moviemiento registrado satisfactoriamente";
            }
           
        }
        else{
            return print_r(sqlsrv_errors(),false);
        }
    }
    public function Inserta_historial_cambio_de_plza($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $posision_anterior = $datos->posision_act;
        $posision_cambio = $datos->posision_ten;
        $nivel = $datos->nivel;
        $Codigo_pres = $datos->clave_presupuesto;
    
        $id_empleado = $datos->id_empleado;
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
       

        $query = " INSERT INTO [mov_Posisiones](
            [id_posision]
                ,[nombre_empleado]
                ,[puesto_fump]
                ,[id_num_posision]
                ,[posision_jefe]
                ,[nivel]
                ,[Codigo_pres]
                ,[sueldo_neto]
                ,[id_proc]
                ,[user_alta]
                ,[fecha_alta]
                ,[estatus]
            )
          SELECT
                (SELECT id_posision FROM Posisiones where id_posision = $posision_cambio)  AS [id_posision]
                ,(SELECT CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado FROM Empleado_insumo WHERE id_empleado_plant = $id_empleado) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP where id_puesto_fump=(SELECT id_puesto_fump FROM Posisiones where id_posision = $posision_cambio))  AS [puesto_fump]
                ,(SELECT id_num_posision FROM Posisiones where id_posision = $posision_cambio) AS [id_num_posision]
                ,(SELECT posision_jefe FROM Posisiones where id_posision = $posision_cambio) AS [posision_jefe]
                ,(SELECT nivel FROM Posisiones where id_posision = $posision_cambio) AS [nivel]
                ,(SELECT Codigo_pres FROM Posisiones where id_posision = $posision_cambio) AS [Codigo_pres]
                ,(SELECT [sueldo_neto] FROM Posisiones where id_posision = $posision_cambio) AS [sueldo_neto]
                ,8 AS [id_proc]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus]
                
              ";
        $resultado = sqlsrv_query($con,$query);
        if ($resultado) {
            return "Moviemiento registrado satisfactoriamente";
        }
        else{
            return print_r(sqlsrv_errors(),false);
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
    public function ConsultaClave($id_fun){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT * FROM [Puesto_FUMP] WHERE [id_puesto_fump] = $id_fun ";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }  
    }
    public function datos_por_vissta_Consulta_datos_Posisines_General($num){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "  	     SELECT distinct TOP (50)
        busq.seq
       ,busq.id_posision
       ,busq.id_empleado
       ,busq.[id_puesto_fump]
       ,busq.[id_proc]
       ,busq.nombre_proc
       ,busq.[user_alta]
       ,busq.[fecha_alta]
       ,busq.[estatus]
       ,busq.[posision_jefe]
       ,busq.[nivel]
       ,busq.[Codigo_pres]
       ,busq.[sueldo_neto]
       ,busq.Ocupante
       ,busq.id_num_posision
       ,busq.nombre_puesto
	   ,busq.estado_analista
	   ,busq.nombre_proc_analista
     FROM( 
       SELECT 
         ROW_NUMBER() OVER(ORDER BY pos.id_num_posision asc) AS seq
       ,pos.[id_posision]
         , id_empleado
		 ,emp.id_proc as estado_analista
		 ,procc1.nombre_proc as nombre_proc_analista
         ,pos.[id_puesto_fump]
         ,[id_num_posision]
         ,pos.[id_proc]
         ,procc.nombre_proc
         ,pos.[user_alta]
         ,pos.[fecha_alta]
         ,pos.[user_mod]
         ,pos.[fecha_mod]
         ,pos.[user_baja]
         ,pos.[fecha_baja]
         ,pos.[estatus]
         ,pos.[posision_jefe]
         ,pos.[nivel]
         ,pos.[Codigo_pres]
         ,pos.[sueldo_neto]
         ,puest.nombre_puesto
         ,Concat( emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) as Ocupante
      from [Control_Ingresos].[dbo].[Posisiones] pos
     FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
     INNER JOIN Procesos procc ON procc.id_proc = pos.id_proc 
	 full JOIN Procesos procc1 ON procc1.id_proc = emp.id_proc 
     inner JOIN Puesto_FUMP puest ON puest.id_puesto_fump = pos.id_puesto_fump ) busq
     WHERE busq.seq >=  $num";
        $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila[] = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
    }
    public function Movimientos_del_personal($id_insumo){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "  SELECT  [id_mov_insumo]
        ,[id_empleado_plant]
        ,[no_empleado]
        ,[admin]
        ,[sub_admin]
        ,[depto]
        ,[jefe_directo]
        ,[id_num_posision]
        ,[puesto]
        ,[rfc_corto]
        ,[nombre_s]
        ,[apellido_p]
        ,[apellido_m]
        ,[correo_inst]
        ,[correo_personal]
        ,[numero_contacto_1]
        ,[numero_contacto_2]
        ,[ext_tel]
        ,[estatus]
        ,mov.[user_alta]
        ,mov.[fecha_alta]
        ,[user_mod]
        ,[fecha_mod]
        ,[user_baja]
        ,[fecha_baja]
        ,procc.nombre_proc
        ,[fec_ingreso]
        ,[RFC]
        ,[CURP]
        ,[Genero]
        ,[Hijos]
        ,[Escolaridad]
        ,[estatus_escolaridad]
        ,[estado_civil]
        ,[Carrera]
        ,[fec_fin_rel_laboral]
        ,[tipo_nombramiento]
        ,[sindicato]
        ,[nivel_jer]
        ,salario_neto
    FROM [Control_Ingresos].[dbo].[mov_insumo] mov
	INNER JOIN Procesos procc ON procc.id_proc = mov.id_proc
	where id_empleado_plant = $id_insumo ORDER BY mov.fecha_alta DESC";
    $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila[] = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
    }
  public function Dame_el_numero_de_oficio($oficio){
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "  SELECT CONCAT (Determinante , YEAR(GETDATE()),'-',$oficio) as determinante FROM cat_Determinante";
    $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
  }
  public function dame_el_encargado_sub_actual($id_user){
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "  SELECT top 1 CONCAT (nombre_s,' ',apellido_p,' ',apellido_m )as nombre_sub,cat_esc.nombre_honor,esta.nombre_estatus_escolaridad,emp.estatus_escolaridad from  Empleado_insumo emp 
    INNER JOIN SubAdmin sub ON sub.id_sub_admin = emp.id_sub_admin
    INNER JOIN cat_escolaridad cat_esc ON emp.Escolaridad = cat_esc.id_escolaridad
     INNER JOIN cat_estatus_escolar esta ON emp.estatus_escolaridad = esta.id_estatus_escolaridad
    INNER JOIN Puesto_ADR puest ON puest.id_puesto = emp.id_puesto
    where puest.id_puesto = 15 
    and emp.id_sub_admin = (select id_sub_admin from Empleado_insumo where id_empleado_plant = $id_user)";
    $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
  }
  public function dame_el_encargado_admin_actual($id_user){
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "  SELECT top 1 CONCAT (nombre_s,' ',apellido_p,' ',apellido_m )as nombre_sub,
    cat_esc.nombre_honor,
    esta.nombre_estatus_escolaridad,
    emp.estatus_escolaridad ,
    puest.nombre_puesto
    from  Empleado_insumo emp 
    INNER JOIN SubAdmin sub ON sub.id_sub_admin = emp.id_sub_admin
    INNER JOIN cat_escolaridad cat_esc ON emp.Escolaridad = cat_esc.id_escolaridad
     INNER JOIN cat_estatus_escolar esta ON emp.estatus_escolaridad = esta.id_estatus_escolaridad
    INNER JOIN Puesto_ADR puest ON puest.id_puesto = emp.id_puesto
    where puest.id_puesto = 4 
    and emp.id_admin = (select id_admin from Empleado_insumo where id_empleado_plant = $id_user)";
    $respuesta = sqlsrv_query($con,$query);
    if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila = $row;
        }
        if (isset($fila)) {
            return $fila;
            $BD->CerrarConexion($con);
        }else{
            return null;
            $BD->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $BD->CerrarConexion($con); 
    }  
  }
    public function info_datos_us($id_us){
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT [id_empleado_plant]
        ,emp.[no_empleado]
        ,ad.nombre_admin
        ,sub.nombre_sub_admin
        ,dep.nombre_depto
        ,emp.[jefe_directo]
        ,pos.id_num_posision
        ,CASE WHEN(  emp.[tipo_nombramiento] = 1) THEN 'Base'
		WHEN(  emp.[tipo_nombramiento] = 2) THEN 'Confianza'
		WHEN(  emp.[tipo_nombramiento] = 3) THEN 'Eventual'
		WHEN(  emp.[tipo_nombramiento] = 3) THEN 'Honorarios'
		end as [tipo_nombramiento]
        ,puest_adr.nombre_puesto as nombre_puesto_adr
        ,emp.[id_perfil]
        ,emp.[RFC]
        ,emp.[CURP]
        ,emp.[rfc_corto]
        ,Concat([nombre_s],' ',[apellido_p],' ' ,[apellido_m]) as nombre_empleado
        ,emp.[correo_inst]
        ,emp.[correo_personal]
        ,emp.[numero_contacto_1]
        ,emp.[numero_contacto_2]
        ,emp.[ext_tel]
        ,emp.[estatus]
        ,emp.[user_alta]
        ,emp.[fecha_alta]
        ,emp.[user_mod]
        ,emp.[fecha_mod]
        ,emp.[user_baja]
        ,emp.[fecha_baja]
        ,emp.[id_proc]
        ,puest_fun.nombre_puesto
        ,emp.[fec_ingreso]
         FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
        INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
      INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
      INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
      INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
      INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
      INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
       WHERE  id_empleado_plant = $id_us and emp.estatus = 'A' ORDER BY emp.id_sub_admin & emp.id_depto  ASC
";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }  
    }
    public function info_datos_us_2($id_us){
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT TOP 1
         [id_empleado_plant]
        ,emp.[no_empleado]
        ,ad.nombre_admin
        ,ad.direccion
        ,emp.id_admin
        ,emp.id_sub_admin
        ,emp.id_depto
        ,sub.nombre_sub_admin
        ,dep.nombre_depto
        ,puest_adr.id_puesto
        ,emp.[jefe_directo]
        ,pos.id_posision
        ,pos.id_num_posision
		,pos.posision_jefe
        ,pos.nivel
        ,pos.sueldo_neto
		,pos.Codigo_pres
		,(select clave_puesto from Puesto_FUMP where id_puesto_fump = (select id_puesto_fump from Posisiones where id_num_posision =(SELECT posision_jefe from Posisiones where id_empleado = $id_us))) as clave_jefe
        ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_posision = (select id_posision from Posisiones where id_num_posision =(SELECT posision_jefe from Posisiones where id_empleado = $id_us))) as nombre_jefe
		,CASE WHEN(  emp.[tipo_nombramiento] = 1) THEN 'Base'
		WHEN(  emp.[tipo_nombramiento] = 2) THEN 'Confianza'
		WHEN(  emp.[tipo_nombramiento] = 3) THEN 'Eventual'
		WHEN(  emp.[tipo_nombramiento] = 4) THEN 'Honorarios'
		end as [tipo_nombramiento],
        emp.tipo_nombramiento as num_nombramiento
        ,puest_adr.nombre_puesto
        ,emp.[id_perfil]
        ,emp.[RFC] as rfc_comp
        ,emp.[CURP] as curp_comp
        ,emp.[rfc_corto]
        ,[nombre_s]
        ,[apellido_p]
        ,[apellido_m]
        ,emp.[correo_inst]
        ,emp.[correo_personal]
        ,emp.[numero_contacto_1]
        ,emp.[numero_contacto_2]
        ,emp.[ext_tel]
        ,emp.[estatus]
        ,emp.[user_alta]
        ,emp.[Escolaridad]
        ,emp.[estatus_escolaridad]
        ,emp.[Carrera]
        ,emp.[id_sindicato]
        ,emp.[id_nivel_jer]
        ,emp.[Genero]
        ,emp.[Hijos]
        ,emp.[fecha_alta]
        ,emp.[user_mod]
        ,emp.[fecha_mod]
        ,emp.[user_baja]
        ,emp.[fecha_baja]
        ,emp.[id_proc]
        ,emp.[fec_ingreso]
        ,emp.fec_fin_rel_laboral
        ,emp.estado_civil
        ,puest_fun.nombre_puesto as nombre_puesto_fun
		,puest_fun.clave_puesto
        ,cat_esc.nombre_escolaridad
        ,cat_esc.nombre_honor
         FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
        INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
        INNER JOIN cat_escolaridad cat_esc ON emp.Escolaridad = cat_esc.id_escolaridad
      INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
      INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
      INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
      INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
      INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
       WHERE  id_empleado_plant = $id_us and emp.estatus = 'A' 
";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }  
    }
    public function Estructura_por_deps_agregados(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT  distinct
        dep.id_admin,
        dep.id_sub_admin,
        sub.nombre_sub_admin,
        admi.nombre_admin,
        dep.nombre_depto
        FROM [Control_Ingresos].[dbo].[Departamento] dep
        INNER JOIN Administracion admi ON admi.id_admin =  dep.id_admin
        INNER JOIN SubAdmin sub ON sub.id_sub_admin =  dep.id_sub_admin
        ORDER BY id_sub_admin asc";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function vista_procesos_fijos(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT * FROM Procesos where  id_proc =9 or id_proc = 11  or id_proc = 7 or id_proc = 6 or id_proc = 12";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function vista_Posisiones_fijos(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "    SELECT* FROM Posisiones WHERE estatus= 'A' and id_empleado is null order by id_num_posision asc ";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function vista_Posisiones_fijos_insumo_agregado($consulta){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = " SELECT* FROM Posisiones WHERE id_posision = $consulta and estatus= 'A' ";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function Estructura_por_subs_agregados(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT  distinct
        sub.nombre_sub_admin
        FROM [Control_Ingresos].[dbo].[Departamento] dep
        INNER JOIN Administracion admi ON admi.id_admin =  dep.id_admin
        INNER JOIN SubAdmin sub ON sub.id_sub_admin =  dep.id_sub_admin";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function Estructura_por_admin_agregados(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = " SELECT distinct
        admi.id_admin,
		Concat([nombre_s],' ',[apellido_p],' ' ,[apellido_m]) as nombre_empleado,
        admi.nombre_admin,
		pues.nombre_puesto,
        emp.no_empleado
        FROM [Control_Ingresos].[dbo].[Departamento] dep
		 INNER JOIN Empleado_insumo emp ON emp.id_admin =  dep.id_admin
        INNER JOIN Administracion admi ON admi.id_admin =  dep.id_admin
        INNER JOIN SubAdmin sub ON sub.id_sub_admin =  dep.id_sub_admin
		  INNER JOIN Puesto_ADR pues ON emp.id_puesto =  pues.id_puesto
		WHERE id_posision = 14
        ORDER BY id_admin asc";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function Datos_subs_por_admin(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT DISTINCT
        nombre_admin,
        nombre_sub_admin,
        nombre_depto,
        emp.no_empleado,
        CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) As nombre_empleado,
        puest.nombre_puesto
        FROM SubAdmin SUB
        FULL JOIN Administracion admind ON admind.id_admin = SUB.id_admin
        FULL JOIN Departamento dep ON SUB.id_sub_admin = dep.id_sub_admin	
        FULL JOIN Empleado_insumo emp ON emp.id_depto = dep.id_depto
        FULL JOIN Puesto_ADR puest ON puest.id_puesto = emp.id_puesto
        WHERE nombre_depto = 'SUBADMINISTRACIÓN'";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function Datos_deps_por_subs(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "		 SELECT distinct
        nombre_admin
        ,nombre_sub_admin
        ,nombre_depto
        ,no_empleado
        ,concat(emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) AS nombre_empleado
        ,pues_adr.nombre_puesto
        FROM Administracion admins
        FULL JOIN SubAdmin sub ON sub.id_admin =  admins.id_admin
        FULL JOIN Departamento dep ON sub.id_sub_admin =  dep.id_sub_admin
        FULL JOIN Empleado_insumo emp ON  dep.id_depto =  emp.id_depto
        FULL JOIN Puesto_ADR pues_adr ON  emp.id_puesto =  pues_adr.id_puesto
        WHERE 
        (sub.nombre_sub_admin != 'Subadministración' 
        AND dep.nombre_depto != 'Subadministración' 
        and dep.estatus = 'A')
        AND  (sub.nombre_sub_admin != 'Administración' 
        AND dep.nombre_depto != 'Administración' 
        AND dep.estatus = 'A') 
        AND sub.estatus = 'A'
        OR (pues_adr.id_puesto  = 22 OR pues_adr.id_puesto  = 37) ";
        $respuesta = sqlsrv_query($con,$query);
        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila[] = $row;
            }
            if (isset($fila)) {
                return $fila;
                $BD->CerrarConexion($con);
            }else{
                return null;
                $BD->CerrarConexion($con);
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }        
        
    }
    public function Consulta_Local()
    {
        include_once("php/conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "SELECT * FROM Administracion WHERE estatus = 'A' ORDER BY nombre_admin ASC";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function consulta_clave_puesto_fump($id)
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "     SELECT 
		pos.id_posision
		,pos.id_num_posision
		,pos.id_puesto_fump
		,fun.nombre_puesto
		,fun.clave_puesto
		,pos.id_proc
        ,pos.nivel
		,pos.Codigo_pres
		,(select clave_puesto from Puesto_FUMP where id_puesto_fump = 
		(select id_puesto_fump from Posisiones where id_posision = (
		Select id_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_num_posision = $id)))) as clave_jefe
		,(Select concat(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_jefe from Empleado_insumo where id_num_posision = (
		Select id_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_num_posision = $id))) as nombre_jefe
        ,(Select id_num_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_num_posision = $id)) as posision_jefe
		from Posisiones Pos
		INNER JOIN Puesto_FUMP fun ON Pos.id_puesto_fump = fun.id_puesto_fump 
		WHERE Pos.id_num_posision = $id ";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function consulta_clave_puesto_fump2($id)
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "     SELECT 
		pos.id_posision
		,pos.id_num_posision
		,pos.id_puesto_fump
		,fun.nombre_puesto
		,fun.clave_puesto
		,pos.id_proc
        ,pos.nivel
		,pos.Codigo_pres
		,(select clave_puesto from Puesto_FUMP where id_puesto_fump = 
		(select id_puesto_fump from Posisiones where id_posision = (
		Select id_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_posision = $id)))) as clave_jefe
		,(Select concat(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_jefe from Empleado_insumo where id_num_posision = (
		Select id_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_posision = $id))) as nombre_jefe
        ,(Select id_num_posision From Posisiones where id_num_posision = (select posision_jefe from Posisiones where id_posision = $id)) as posision_jefe
		from Posisiones Pos
		INNER JOIN Puesto_FUMP fun ON Pos.id_puesto_fump = fun.id_puesto_fump 
		where Pos.id_posision = $id ";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function valida_RFC_corto($rfc){
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT * FROM Empleado_insumo where rfc_corto = '$rfc' AND estatus = 'A'";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return true;
            } else {
                return false;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function Valida_no_empleado($no_empleado){
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT * FROM Empleado_insumo where no_empleado = $no_empleado  AND estatus = 'A'";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return true;
            } else {
                return false;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
       
    }
    public function Registra_usuario_insumo($datos){
        // $vista_datos = json_encode($datos);
        // echo $vista_datos;
        $CURP = $datos->CURP;
        $RFC_comp = $datos->rfc_comp;
        $RFC_Corto = $datos->rfc_corto;
        $No_Empleado = $datos->num_empleado;
        $admin = $datos->admin;
        $sub = $datos->sub;
        $dep = $datos->dep;
        $jefe = $datos->jefe_dir_adr;
        $nombres = $datos->nombre_S;
        $apellido_P = $datos->apllido_p;
        $apellido_M = $datos->apllido_m;
        $Correo_sat = $datos->correo_ins;
        $Correo_P = $datos->correo_p;
        $telefono_1 = $datos->tel_1;
        $telefono_2 = $datos->tel_2;
        $ext_tele = $datos->tel_ext;
        $estatus_opera = $datos->estatus_op;
        $Genero = $datos->genero;
        $Hijos = $datos->hijos;
        $estado_civil = $datos->est_civil;
        $Escolaridad = $datos->escolaridad;
        $est_escolar = $datos->est_escolar;
        $carrera = $datos->carrera;
        $puesto_adr = $datos->puesto_adr;
        $num_plaza = $datos->num_plaza;
        $fecha_ingreso = $datos->fec_ingreso;
        $tipo_nom = $datos->nombramiento;
        $nivel_jer = $datos->nivel_jerarq;
        $sindicatos = $datos->sindicato;
        $sal_net = $datos->salario_net;
        include_once 'sesion.php';
        include_once 'conexion.php';
        $user_alta = $_SESSION['ses_rfc_corto_ing'];

        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();

        $filtro_1= self::valida_RFC_corto($RFC_Corto);
        $filtro_2= self::Valida_no_empleado($No_Empleado);
        if ($filtro_1 == true) {
            return false;
        }
        else {
            if ($filtro_2 == true) {
                return false;
            }
            else {
                $query = "INSERT INTO Empleado_insumo (
                    [no_empleado]
                   ,[id_admin]
                   ,[id_sub_admin]
                   ,[id_depto]
                   ,[jefe_directo]
                   ,[id_posision]
                   ,[id_puesto]
                   ,[rfc_corto]
                   ,[nombre_s]
                   ,[apellido_p]
                   ,[apellido_m]
                   ,[correo_inst]
                   ,[correo_personal]
                   ,[numero_contacto_1]
                   ,[numero_contacto_2]
                   ,[ext_tel]
                   ,[estatus]
                   ,[user_alta]
                   ,[fecha_alta]
                   ,[id_proc]
                   ,[fec_ingreso]
                   ,[RFC]
                   ,[CURP]
                   ,[Genero]
                   ,[Hijos]
                   ,[Escolaridad]
                   ,[estatus_escolaridad]
                   ,[estado_civil]
                   ,[Carrera]
                   ,[tipo_nombramiento]
                   ,[id_sindicato]
                   ,[id_nivel_jer])
                    SELECT 
                    $No_Empleado AS [no_empleado]
                    ,$admin AS [id_admin]
                    ,$sub AS [id_sub_admin]
                    ,$dep AS [id_depto]
                    ,Case '$jefe' when '' then null Else '$jefe' end  AS [jefe_directo]
                    ,(select id_posision from Posisiones where id_num_posision = '$num_plaza') AS [id_posision]
                    ,$puesto_adr AS [id_puesto]
                    ,'$RFC_Corto' AS [rfc_corto]
                    ,'$nombres' AS [nombre_s]
                    ,'$apellido_P' AS [apellido_p]
                    ,'$apellido_M' AS [apellido_m]
                    ,'$Correo_sat' AS [correo_inst]
                    ,Case '$Correo_P' when '' then null Else '$Correo_P' end AS [correo_personal]
                    ,Case '$telefono_1' when '' then null Else '$telefono_1' end AS [numero_contacto_1]
                    ,Case '$telefono_2' when '' then null Else '$telefono_2' end AS [numero_contacto_2]
                    ,Case '$ext_tele' when '' then null Else '$ext_tele' end AS [ext_tel]
                    ,'A' AS [estatus]
                    ,'$user_alta' AS [user_alta]
                    ,GETDATE() AS [fecha_alta]
                    ,$estatus_opera AS [id_proc]
                    ,'$fecha_ingreso' AS [fec_ingreso]
                    ,'$RFC_comp' AS [RFC]
                    ,'$CURP' AS [CURP]
                    ,'$Genero' AS [Genero]
                    , Case '$Hijos' when '' then null Else '$Hijos' end  AS [Hijos]
                    ,$Escolaridad AS [Escolaridad]
                    ,$est_escolar AS [estatus_escolaridad]
                    ,$estado_civil AS [estado_civil]
                    ,Case '$carrera' when '' then null Else '$carrera' end AS [Carrera]
                    ,$tipo_nom AS [tipo_nombramiento]
                    ,$sindicatos AS [id_sindicato]
                    ,$nivel_jer AS [id_nivel_jer]


                    UPDATE Posisiones set id_empleado =( SELECT top 1 CAST(scope_identity() AS int) as empleado  from Empleado_insumo ),
                   sueldo_neto =Case '$sal_net' when '' then NULL else '$sal_net' end where id_num_posision = $num_plaza
                   

                    INSERT INTO [mov_insumo](
            [id_empleado_plant]
                ,[no_empleado]
                ,[admin]
                ,[sub_admin]
                ,[depto]
                ,[id_num_posision]
                ,[puesto]
                ,[rfc_corto]
                ,[nombre_s]
                ,[apellido_p]
                ,[apellido_m]
                ,[correo_inst]
                ,[correo_personal]
                ,[numero_contacto_1]
                ,[numero_contacto_2]
                ,[ext_tel]
                ,[estatus]
                ,[user_alta]
                ,[fecha_alta]
                ,[id_proc]
                ,[fec_ingreso]
                ,[RFC]
                ,[CURP]
                ,[Genero]
                ,[Hijos]
                ,[Escolaridad]
                ,[estatus_escolaridad]
                ,[estado_civil]
                ,[Carrera]
                ,[tipo_nombramiento]
                ,[sindicato]
                ,[nivel_jer]
                ,salario_neto
            )
            SELECT 
            ( SELECT top 1 CAST(scope_identity() AS int) AS EMPLEADO FROM Empleado_insumo) AS [id_empleado_plant]
                ,$No_Empleado AS [no_empleado]
                ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
                ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
                ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
                ,'$num_plaza' as [id_num_posision]
                ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
                ,'$RFC_Corto' AS [rfc_corto]
                ,'$nombres' AS [nombre_s]
                ,'$apellido_P' AS [apellido_p]
                ,'$apellido_M' AS [apellido_m]
                ,'$Correo_sat' AS [correo_inst]
                ,(Case '$Correo_P' when '' then NULL else '$Correo_P' end) AS [correo_personal]
                ,(Case '$telefono_1' when '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
                ,(Case '$telefono_2' when '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
                ,(Case '$ext_tele' when '' then NULL else '$ext_tele' end) AS [ext_tel]
                ,'A' AS [estatus]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,16 AS [id_proc]
                ,'$fecha_ingreso' AS[fec_ingreso]
                ,'$RFC_comp' AS [RFC]
                ,'$CURP' AS [CURP]
                ,'$Genero' AS [Genero]
                ,'$Hijos' AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad =$Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil =$estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento =$tipo_nom) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer =$nivel_jer) AS [nivel_jer]
                ,'$sal_net' AS salario_neto
<<<<<<< HEAD
=======

>>>>>>> 0d2e10d0abc5bdb88b5a62c2492711c602adb5dd
                    INSERT INTO [mov_Posisiones] 
            (
              [id_posision]
                ,[nombre_empleado]
                ,[puesto_fump]
                ,[id_num_posision]
                ,[posision_jefe]
                ,[nivel]
                ,[Codigo_pres]
                ,[sueldo_neto]
                ,[id_proc]
                ,[user_alta]
                ,[fecha_alta]
              ,[estatus]
            )
            SELECT
              (Select id_posision from Posisiones where id_num_posision = '$num_plaza') AS [id_posision]
              ,(SELECT CONCAT ('$nombres',' ','$apellido_P',' ','$apellido_M') ) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP WHERE id_puesto_fump = (Select id_puesto_fump from Posisiones where id_num_posision = $num_plaza)) AS [puesto_fump]
                , '$num_plaza' AS [id_num_posision]
                ,(Select [posision_jefe] from Posisiones where id_num_posision = '$num_plaza') AS [posision_jefe]
                ,(Select [nivel] from Posisiones where id_num_posision = '$num_plaza') AS [nivel]
                ,(Select [Codigo_pres] from Posisiones where id_num_posision =' $num_plaza')  AS [Codigo_pres]
                ,CASE '$sal_net' WHEN '' THEN NULL ELSE '$sal_net' END AS [sueldo_neto]
                ,8 AS [id_proc]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus]

                   ";
                 $prepare = sqlsrv_query($con, $query);
                 if ($prepare == false) {
                     return print_r(sqlsrv_errors(),false);
                     $conexion->CerrarConexion($con);
                 }
                 else{
                    return true;
                   // $resultado =  self::inserta_movimiento_historial_deptos($datos);                  
                     $conexion->CerrarConexion($con);
                 }
            }
        }
       


    }
    public function inserta_movimiento_historial_deptos($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $user = $_SESSION['ses_rfc_corto_ing'];
        $BD= new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $CURP = $datos->CURP;
        $RFC_comp = $datos->rfc_comp;
        $RFC_Corto = $datos->rfc_corto;
        $No_Empleado = $datos->num_empleado;
        $admin = $datos->admin;
        $sub = $datos->sub;
        $dep = $datos->dep;
        $jefe = $datos->jefe_dir_adr;
        $nombres = $datos->nombre_S;
        $apellido_P = $datos->apllido_p;
        $apellido_M = $datos->apllido_m;
        $Correo_sat = $datos->correo_ins;
        $Correo_P = $datos->correo_p;
        $telefono_1 = $datos->tel_1;
        $telefono_2 = $datos->tel_2;
        $ext_tele = $datos->tel_ext;
        $Genero = $datos->genero;
        $Hijos = $datos->hijos;
        $estado_civil = $datos->est_civil;
        $Escolaridad = $datos->escolaridad;
        $est_escolar = $datos->est_escolar;
        $carrera = $datos->carrera;
        $puesto_adr = $datos->puesto_adr;
        $num_plaza = $datos->num_plaza;
        $fecha_ingreso = $datos->fec_ingreso;
        $tipo_nom = $datos->nombramiento;
        $nivel_jer = $datos->nivel_jerarq;
        $sindicatos = $datos->sindicato;
        $sal_net = $datos->salario_net;
        $tipo_nom = $datos->nombramiento;
        $nivel_jer = $datos->nivel_jerarq;
        $sindicatos = $datos->sindicato;
        $query = "  INSERT INTO [mov_insumo](
            [id_empleado_plant]
                ,[no_empleado]
                ,[admin]
                ,[sub_admin]
                ,[depto]
                ,[id_num_posision]
                ,[puesto]
                ,[rfc_corto]
                ,[nombre_s]
                ,[apellido_p]
                ,[apellido_m]
                ,[correo_inst]
                ,[correo_personal]
                ,[numero_contacto_1]
                ,[numero_contacto_2]
                ,[ext_tel]
                ,[estatus]
                ,[user_alta]
                ,[fecha_alta]
                ,[id_proc]
                ,[fec_ingreso]
                ,[RFC]
                ,[CURP]
                ,[Genero]
                ,[Hijos]
                ,[Escolaridad]
                ,[estatus_escolaridad]
                ,[estado_civil]
                ,[Carrera]
                ,[tipo_nombramiento]
                ,[sindicato]
                ,[nivel_jer]
                ,[jefe_directo]
            )
            SELECT 
            ( SELECT top 1 CAST(scope_identity() AS int) AS EMPLEADO FROM Empleado_insumo) AS [id_empleado_plant]
                ,$No_Empleado AS [no_empleado]
                ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
                ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
                ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
                ,$num_plaza as [id_num_posision]
                ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
                ,'$RFC_Corto' AS [rfc_corto]
                ,'$nombres' AS [nombre_s]
                ,'$apellido_P' AS [apellido_p]
                ,'$apellido_M' AS [apellido_m]
                ,'$Correo_sat' AS [correo_inst]
                ,(Case '$Correo_P' when '' then NULL else '$Correo_P' end) AS [correo_personal]
                ,(Case '$telefono_1' when '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
                ,(Case '$telefono_2' when '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
                ,(Case '$ext_tele' when '' then NULL else '$ext_tele' end) AS [ext_tel]
                ,'A' AS [estatus]
                ,'$user' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,16 AS [id_proc]
                ,'$fecha_ingreso' AS[fec_ingreso]
                ,'$RFC_comp' AS [RFC]
                ,'$CURP' AS [CURP]
                ,'$Genero' AS [Genero]
                ,'$Hijos' AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad =$Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil =$estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento =$tipo_nom) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer =$nivel_jer) AS [nivel_jer]
                ,(SELECT CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_jefe from Empleado_insumo where id_empleado_plant = $jefe) AS [jefe_directo]
          ";
        $prepare = sqlsrv_query($con,$query);
        if ($prepare==true) {
            return true;
        }
        else {
            return print_r(sqlsrv_errors(),false);
        }
    }
    public function universo_usuarios_activos()
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        switch ($_GET) {
            case isset($_GET['pagina']):
                    $condicion = "";
            break;
            case isset($_GET['Estructura']):
                $sub = $_COOKIE["sub"];
                $dep = $_COOKIE["dep"];
                $condicion = " AND sub.id_sub_admin = $sub and dep.id_depto = $dep ";
            break;
            case isset($_GET['Nombre']):
                $nom = $_COOKIE["nombre"];
                $condicion = "AND  (emp.nombre_s LIKE '%$nom%' OR  emp.apellido_p LIKE '%$nom%' OR  emp.apellido_m LIKE '%$nom%')";
            break;
            case isset($_GET['RFC']):
                $RFC = $_COOKIE["rfc_corto_cokie"];
                $condicion = " AND emp.rfc_corto = '$RFC' ";
            break;
            case isset($_GET['Puestos']):
                $puest = $_COOKIE["puest_adr"];
                $condicion = " AND puest_adr.id_puesto = $puest ";
            break;
            default:
            $condicion = "";
            break;
          }
        $query = "  SELECT count(*) TOTAL
        FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
       INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
     INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
     INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
     INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
     INNER JOIN Procesos procs ON emp.id_proc = procs.id_proc
     INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
     INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
      WHERE emp.estatus = 'A' and emp.id_proc = 9 or emp.id_proc = 12 $condicion";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function Consulta_usuarios_activos($num)
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        switch ($_GET) {
            case isset($_GET['pagina']):
                    $condicion = "";
            break;
            case isset($_GET['Estructura']):
                $sub = $_COOKIE["sub"];
                $dep = $_COOKIE["dep"];
                $condicion = " AND subc.id_sub_admin = $sub AND subc.id_depto = $dep ";
            break;
            case isset($_GET['Nombre']):
            $nom = $_COOKIE["nombre"];
            $condicion = "AND subc.nombre_empleado LIKE '%$nom%'";
            break;
            case isset($_GET['RFC']):
                $rfc = $_COOKIE["rfc_corto_cokie"];
                $condicion = " AND subc.rfc_corto = '$rfc' ";
            break;
            case isset($_GET['Puestos']):
                $puest = $_COOKIE["puest_adr"];
                $condicion = " AND subc.id_puesto = $puest ";
            break;
            default:
                $condicion = "";
             break;
          }
        $query = " SELECT TOP(50)
        subc.seq,
        subc.id_empleado_plant 
         ,subc.[no_empleado]
         ,subc.id_admin
         ,subc.id_sub_admin
         ,subc.id_depto
         ,subc.nombre_admin
         ,subc.nombre_sub_admin
         ,subc.nombre_depto
         ,subc.[jefe_directo]
         ,subc.id_num_posision
         ,subc.[tipo_nombramiento]
         ,subc.nombre_puesto
         ,subc.[id_perfil]
         ,subc.[RFC]
         ,subc.[CURP]
         ,subc.[rfc_corto]
        ,subc.nombre_empleado
        ,subc.years
        ,subc.meses
        ,subc.dias
         ,subc.[correo_inst]
         ,subc.[correo_personal]
         ,subc.[numero_contacto_1]
         ,subc.[numero_contacto_2]
         ,subc.[ext_tel]
         ,subc.[estatus]
         ,subc.[user_alta]
         ,subc.[fecha_alta]
         ,subc.[user_mod]
         ,subc.[fecha_mod]
         ,subc.[user_baja]
         ,subc.[fecha_baja]
         ,subc.[id_proc]
         ,subc.nombre_proc
         ,subc.[fec_ingreso]
         ,subc.id_puesto
        from
       ( SELECT  
         ROW_NUMBER() OVER(ORDER BY sub.nombre_sub_admin asc,dep.nombre_depto desc) AS seq,
         [id_empleado_plant]
         ,emp.[no_empleado]
         ,ad.nombre_admin
         ,ad.id_admin
         ,sub.id_sub_admin
         ,sub.nombre_sub_admin
         ,dep.nombre_depto
         ,dep.id_depto
         ,emp.[jefe_directo]
         ,pos.id_num_posision
         ,emp.[tipo_nombramiento]
         ,puest_adr.id_puesto
         ,puest_adr.nombre_puesto
         ,emp.[id_perfil]
         ,emp.[RFC]
         ,emp.[CURP]
         ,emp.[rfc_corto]
         ,Concat([nombre_s],' ',[apellido_p],' ' ,[apellido_m]) as nombre_empleado
         ,floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365) AS years
         ,floor((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12) AS meses
         ,floor((((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12)-floor((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12))*(365/12)) AS dias
         ,emp.[correo_inst]
         ,emp.[correo_personal]
         ,emp.[numero_contacto_1]
         ,emp.[numero_contacto_2]
         ,emp.[ext_tel]
         ,emp.[estatus]
         ,emp.[user_alta]
         ,emp.[fecha_alta]
         ,emp.[user_mod]
         ,emp.[fecha_mod]
         ,emp.[user_baja]
         ,emp.[fecha_baja]
         ,emp.[id_proc]
         ,procs.nombre_proc
         ,emp.[fec_ingreso]
          FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
         INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
       INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
       INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
       INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
       INNER JOIN Procesos procs ON emp.id_proc = procs.id_proc
       INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
       INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
        WHERE emp.estatus = 'A' and emp.id_proc = 9 or emp.id_proc = 12 ) subc
        WHERE seq >= $num $condicion";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function Consulta_usuarios_baja_comision_suspenndidos_laudos()
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "  SELECT [id_empleado_plant]
        ,emp.[no_empleado]
        ,ad.nombre_admin
        ,sub.nombre_sub_admin
        ,dep.nombre_depto
        ,emp.[jefe_directo]
        ,pos.id_num_posision
        ,emp.[tipo_nombramiento]
        ,puest_adr.nombre_puesto
        ,emp.[id_perfil]
        ,emp.[RFC]
        ,emp.[CURP]
        ,emp.[rfc_corto]
        ,Concat([nombre_s],' ',[apellido_p],' ' ,[apellido_m]) as nombre_empleado
        ,emp.[correo_inst]
        ,emp.[correo_personal]
        ,emp.[numero_contacto_1]
        ,emp.[numero_contacto_2]
        ,emp.[ext_tel]
        ,emp.[estatus]
        ,emp.[user_alta]
        ,emp.[fecha_alta]
        ,emp.[user_mod]
        ,emp.[fecha_mod]
        ,emp.[user_baja]
        ,emp.[fecha_baja]
        ,emp.[id_proc]
        ,procs.nombre_proc
        ,emp.[fec_ingreso]
         FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
        INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
      INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
      INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
      INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
      INNER JOIN Procesos procs ON emp.id_proc = procs.id_proc
      INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
      INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
       WHERE emp.estatus = 'A' and (emp.id_proc = 7 or emp.id_proc = 6 or emp.id_proc = 11) ORDER BY sub.nombre_sub_admin asc,dep.nombre_depto desc";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }

    public function Actualiza_datos_basicos_acti($datos){
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        include_once 'sesion.php';
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        $con = $conexion->ObtenerConexionBD();
        $query = "  UPDATE [Empleado_insumo] SET
        [no_empleado] = ".$datos->no_empleado.",
        [nombre_s] = '".$datos->nombre_s."',
        [apellido_p] = '".$datos->apellido_p."',
        [apellido_m] = '".$datos->apellido_m."',
        [RFC] = '".$datos->rfc."',
        [CURP] = '".$datos->curp."',
        [correo_inst] = '".$datos->correo."',
        [correo_personal] = '".$datos->correo_p."',
        [numero_contacto_1] = '".$datos->num_tel1."',
        [numero_contacto_2] = '".$datos->num_tel2."',
        [ext_tel] = '".$datos->ext."',
        [fec_ingreso] = '".$datos->fec_ingres."',
        [fec_fin_rel_laboral] = CASE '".$datos->fec_baja."' WHEN '' THEN NULL ELSE '".$datos->fec_baja."' END ,
        [id_proc] = ".$datos->estatus.",
        [rfc_corto] = '".$datos->rfc_c."',
        [tipo_nombramiento] = '".$datos->tipo_nom."',
        [id_sindicato] = ".$datos->sindicato.",
        fecha_mod = GETDATE(),
        user_mod = '".$user_ej."'
        WHERE id_empleado_plant = ".$datos->id_emp."        
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
            return $proceso =self::Registra_historial($datos);
           // $conexion->CerrarConexion($con);
            
             //return $datos_res;
        }

    }
    public function Registra_historial_cambios_deps($datos,$proc){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_alta = $_SESSION['ses_rfc_corto_ing'];

        $admin = $datos->id_admin;
        $sub = $datos->id_sub_admin;
        $dep = $datos->id_depto;
        $jefe_directo = $datos->id_jefe;
        $puesto_adr = $datos->id_puesto;
        $id_user_insumo = $datos->id_empleado;
        
        $datos_us_faltantes = self::info_datos_us_2($id_user_insumo);
        $sindicatos = $datos_us_faltantes['id_sindicato'];
        $num_plaza = $datos_us_faltantes['id_num_posision'];
        $No_Empleado = $datos_us_faltantes['no_empleado'];
        $nombres =$datos_us_faltantes['nombre_s'];
        $apellido_P = $datos_us_faltantes['apellido_p'];
        $apellido_M = $datos_us_faltantes['apellido_m'];
        $RFC_comp =$datos_us_faltantes['rfc_comp'];
        $CURP = $datos_us_faltantes['curp_comp'];
        $RFC_Corto = $datos_us_faltantes['rfc_corto'];
        $Correo_sat = $datos_us_faltantes['correo_personal'];
        $Correo_P = $datos_us_faltantes['id_num_posision'];
        $telefono_1 = $datos_us_faltantes['numero_contacto_1'];
        $telefono_2 = $datos_us_faltantes['numero_contacto_2'];
        $ext_tele = $datos_us_faltantes['ext_tel'];
        $fecha_ingreso = $datos_us_faltantes['fec_ingreso']->format('Y/m/d');
        $fecha_fin_laboral = $datos_us_faltantes['fec_fin_rel_laboral'] == NULL ? NULL: $datos_us_faltantes['fec_fin_rel_laboral']->format('Y/m/d');
        $tipo_nom1 = $datos_us_faltantes['num_nombramiento'];
        $Genero = $datos_us_faltantes['Genero'];
        $Hijos = $datos_us_faltantes['Hijos'];
        $Escolaridad = $datos_us_faltantes['Escolaridad'];
        $est_escolar = $datos_us_faltantes['estatus_escolaridad'];
        $carrera = $datos_us_faltantes['Carrera'];
        $nivel_jer = $datos_us_faltantes['id_nivel_jer'];
        $estado_civil = $datos_us_faltantes['estado_civil'];
        $sal_net = $datos_us_faltantes['sueldo_neto'];
        $query = "INSERT INTO [mov_insumo](
                [id_empleado_plant]
                ,[no_empleado]
                ,[admin]
                ,[sub_admin]
                ,[depto]
                ,[id_num_posision]
                ,[puesto]
                ,[rfc_corto]
                ,[nombre_s]
                ,[apellido_p]
                ,[apellido_m]
                ,[correo_inst]
                ,[correo_personal]
                ,[numero_contacto_1]
                ,[numero_contacto_2]
                ,[ext_tel]
                ,fec_fin_rel_laboral
                ,[estatus]
                ,[user_alta]
                ,[fecha_alta]
                ,[id_proc]
                ,[fec_ingreso]
                ,[RFC]
                ,[CURP]
                ,[Genero]
                ,[Hijos]
                ,[Escolaridad]
                ,[estatus_escolaridad]
                ,[estado_civil]
                ,[Carrera]
                ,[tipo_nombramiento]
                ,[sindicato]
                ,[nivel_jer]
                ,salario_neto
                ,[jefe_directo]
            )
                 SELECT 
                 $id_user_insumo AS [id_empleado_plant]
                ,$No_Empleado AS [no_empleado]
                ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
                ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
                ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
                ,$num_plaza as [id_num_posision]
                ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
                ,'$RFC_Corto' AS [rfc_corto]
                ,'$nombres' AS [nombre_s]
                ,'$apellido_P' AS [apellido_p]
                ,'$apellido_M' AS [apellido_m]
                ,'$Correo_sat' AS [correo_inst]
                ,(Case '$Correo_P' when '' then NULL else '$Correo_P' end) AS [correo_personal]
                ,(Case '$telefono_1' when '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
                ,(Case '$telefono_2' when '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
                ,(Case '$ext_tele' when '' then NULL else '$ext_tele' end) AS [ext_tel]
                ,(Case '$fecha_fin_laboral' when '' then NULL else '$fecha_fin_laboral' end) AS  [fec_fin_rel_laboral]
                ,'A' AS [estatus]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,$proc AS [id_proc]
                ,'$fecha_ingreso' AS [fec_ingreso]
                ,'$RFC_comp' AS [RFC]
                ,'$CURP' AS [CURP]
                ,'$Genero' AS [Genero]
                ,'$Hijos' AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad = $Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil = $estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento = $tipo_nom1 ) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer = $nivel_jer ) AS [nivel_jer]
                ,'$sal_net' AS salario_neto
                ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            return "Se actualizo el area asignada del empleado satisfactoriamente." ;
        }
        else {
            return print_r(sqlsrv_errors(),false);
            
        }

    }
    public function Registra_historial($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
        $No_Empleado = $datos->no_empleado;
        $nombres =$datos->nombre_s;
        $apellido_P = $datos->apellido_p;
        $apellido_M = $datos->apellido_m;
        $RFC_comp =$datos->rfc;
        $CURP = $datos->curp;
        $RFC_Corto = $datos->rfc_c;
        $Correo_sat = $datos->correo;
        $Correo_P = $datos->correo_p;
        $telefono_1 = $datos->num_tel1;
        $telefono_2 = $datos->num_tel2;
        $ext_tele = $datos->ext;
        $fecha_ingreso = $datos->fec_ingres;
        $fecha_fin_laboral = $datos->fec_baja;
        $tipo_nom1 = $datos->tipo_nom;
        $proceso = $datos->estatus;
        $id_user_insumo = $datos->id_emp;
        $sindicatos = $datos->sindicato;

        $datos_us_faltantes = self::info_datos_us_2($id_user_insumo);
        $num_plaza = $datos_us_faltantes['id_num_posision'];
        $admin = $datos_us_faltantes['id_admin'];
        $sub = $datos_us_faltantes['id_sub_admin'];
        $dep = $datos_us_faltantes['id_depto'];
        $puesto_adr = $datos_us_faltantes['id_puesto'];
        $Genero = $datos_us_faltantes['Genero'];
        $proc_reg = $datos_us_faltantes['id_proc'];
        $Hijos = $datos_us_faltantes['Hijos'];
        $Escolaridad = $datos_us_faltantes['Escolaridad'];
        $est_escolar = $datos_us_faltantes['estatus_escolaridad'];
        $carrera = $datos_us_faltantes['Carrera'];
        $jefe_directo = $datos_us_faltantes['jefe_directo'];
        $nivel_jer = $datos_us_faltantes['id_nivel_jer'];
        $estado_civil = $datos_us_faltantes['estado_civil'];
        $sal_net = $datos_us_faltantes['sueldo_neto'];

        if ($proceso == 9 && $proc_reg == 9) {
            $proceso =17;
        }
        else if ($proc_reg == 11 && $proceso == 9 ||  $proc_reg == 7 && $proceso == 9 ) {
            $proceso =20;
        } 
        else if($proc_reg == 6) {
            $proceso =$proceso;
        }
        else {
            $proceso =$proceso;
        }
        $query = "INSERT INTO [mov_insumo](
            [id_empleado_plant]
                ,[no_empleado]
                ,[admin]
                ,[sub_admin]
                ,[depto]
                ,[id_num_posision]
                ,[puesto]
                ,[rfc_corto]
                ,[nombre_s]
                ,[apellido_p]
                ,[apellido_m]
                ,[correo_inst]
                ,[correo_personal]
                ,[numero_contacto_1]
                ,[numero_contacto_2]
                ,[ext_tel]
                ,fec_fin_rel_laboral
                ,[estatus]
                ,[user_alta]
                ,[fecha_alta]
                ,[id_proc]
                ,[fec_ingreso]
                ,[RFC]
                ,[CURP]
                ,[Genero]
                ,[Hijos]
                ,[Escolaridad]
                ,[estatus_escolaridad]
                ,[estado_civil]
                ,[Carrera]
                ,[tipo_nombramiento]
                ,[sindicato]
                ,[nivel_jer]
                ,salario_neto
                ,[jefe_directo]
            )
                 SELECT 
                 $id_user_insumo AS [id_empleado_plant]
                ,$No_Empleado AS [no_empleado]
                ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
                ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
                ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
                ,$num_plaza as [id_num_posision]
                ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
                ,'$RFC_Corto' AS [rfc_corto]
                ,'$nombres' AS [nombre_s]
                ,'$apellido_P' AS [apellido_p]
                ,'$apellido_M' AS [apellido_m]
                ,'$Correo_sat' AS [correo_inst]
                ,(Case '$Correo_P' when '' then NULL else '$Correo_P' end) AS [correo_personal]
                ,(Case '$telefono_1' when '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
                ,(Case '$telefono_2' when '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
                ,(Case '$ext_tele' when '' then NULL else '$ext_tele' end) AS [ext_tel]
                ,(Case '$fecha_fin_laboral' when '' then NULL else '$fecha_fin_laboral' end) AS  [fec_fin_rel_laboral]
                ,'A' AS [estatus]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,$proceso AS [id_proc]
                ,'$fecha_ingreso' AS[fec_ingreso]
                ,'$RFC_comp' AS [RFC]
                ,'$CURP' AS [CURP]
                ,'$Genero' AS [Genero]
                ,'$Hijos' AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad = $Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil = $estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento = $tipo_nom1 ) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer = $nivel_jer ) AS [nivel_jer]
                ,'$sal_net' AS salario_neto
                ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo
                ";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            return "Se actualizaron los datos basicos del empleado satisfactoriamente." ;
        }
        else {
            return print_r(sqlsrv_errors(),false);
            
        }
    }
    public function Actualiza_area_y_jefe_insumo($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        $admin = $datos->id_admin;
        $sub = $datos->id_sub_admin;
        $dep = $datos->id_depto;
        $jefe_directo = $datos->id_jefe;
        $puesto_adr = $datos->id_puesto;
        $id_user_insumo = $datos->id_empleado;
        $datos_us_faltantes = self::info_datos_us_2($id_user_insumo);
        $admin_act = $datos_us_faltantes['id_admin'];
        $sub_act = $datos_us_faltantes['id_sub_admin'];
        $dep_act = $datos_us_faltantes['id_depto'];
        $puesto_adr_act = $datos_us_faltantes['id_puesto'];    
        $jefe_directo_act = $datos_us_faltantes['jefe_directo'];

        if ($admin != $admin_act || $sub != $sub_act || $dep != $dep_act ) {
            $proc = 2;
        }
        elseif ($puesto_adr != $puesto_adr_act) {
            $proc = 21;
        }
        elseif($jefe_directo != $jefe_directo_act){
            $proc = 22;
        }
        else {
            $proc = 23;
        }

        $query = "UPDATE Empleado_insumo set 
        id_admin = ".$datos->id_admin." ,
        id_sub_admin = ".$datos->id_sub_admin.",
        id_depto = ".$datos->id_depto.",
        jefe_directo = ".$datos->id_jefe.",
        id_puesto = ".$datos->id_puesto.",
        user_mod = '$user_ej',
        fecha_mod = GETDATE()
        WHERE id_empleado_plant = ".$datos->id_empleado."
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
            $procesos= self::Registra_historial_cambios_deps($datos,$proc);
            return  $procesos;
            //$conexion->CerrarConexion($con);
        }
    }
    public function Actualiza_datos_adicionales($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        $query = " UPDATE Empleado_insumo set 
        [Genero] = '".$datos->genero."' ,
        [Hijos] = '".$datos->hijos."',
        [estado_civil] = '".$datos->estado_civil."',
        [Escolaridad] = ".$datos->escolaridad.",
        [estatus_escolaridad] = '".$datos->estatus_escolar."',
		[Carrera] = case '".$datos->carrera."' when '' then null else '".$datos->carrera."' end,
        user_mod = '$user_ej',
        fecha_mod = GETDATE()
		WHERE id_empleado_plant = ".$datos->id_empleado."
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
             
            //$conexion->CerrarConexion($con);
            return $respuesta = self::Registra_historial_datos_adicionales($datos);
        }
    }
    public function Registra_historial_datos_adicionales($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
        $con = $BD->ObtenerConexionBD();
        //DATOS DEL SCRIPT 
        $id_user_insumo = $datos->id_empleado;
        $Genero =$datos->genero;
        $Hijos = $datos->hijos;
        $estado_civil = $datos->estado_civil;
        $Escolaridad =  $datos->escolaridad;
        $est_escolar = $datos->estatus_escolar;
        $carrera = $datos->carrera;
        //DATOS DE EL USUARIO INSUMO QUE FALTAN POR RELLENAR
        $datos_us_faltantes = self::info_datos_us_2($id_user_insumo);
        $RFC_comp = $datos_us_faltantes['rfc_comp'];
        $RFC_Corto = $datos_us_faltantes['rfc_corto'];
        $CURP = $datos_us_faltantes['curp_comp'];
        $No_Empleado = $datos_us_faltantes['no_empleado'];
        $nombres = $datos_us_faltantes['nombre_s'];
        $apellido_P = $datos_us_faltantes['apellido_p'];
        $apellido_M =$datos_us_faltantes['id_num_posision'];
        $Correo_sat =  $datos_us_faltantes['correo_inst'];
        $Correo_P = $datos_us_faltantes['correo_personal'];
        $telefono_1 = $datos_us_faltantes['numero_contacto_1'];
        $telefono_2 = $datos_us_faltantes['numero_contacto_2'];
        $ext_tele = $datos_us_faltantes['ext_tel'];
        $fecha_ingreso = $datos_us_faltantes['fec_ingreso']->format('Y-m-d');
        $tipo_nom1 = $datos_us_faltantes['num_nombramiento'];
        $num_plaza = $datos_us_faltantes['id_num_posision'];
        $tipo_nom1 = $datos_us_faltantes['num_nombramiento'];
        $admin = $datos_us_faltantes['id_admin'];
        $sub = $datos_us_faltantes['id_sub_admin'];
        $dep = $datos_us_faltantes['id_depto'];
        $puesto_adr = $datos_us_faltantes['id_puesto'];    
        $sindicatos = $datos_us_faltantes['id_sindicato'];
        $nivel_jer = $datos_us_faltantes['id_nivel_jer'];
        $sal_net = $datos_us_faltantes['sueldo_neto'];
        $jefe_directo = $datos_us_faltantes['jefe_directo'];
        $query = "INSERT INTO [mov_insumo](
            [id_empleado_plant]
                ,[no_empleado]
                ,[admin]
                ,[sub_admin]
                ,[depto]
                ,[id_num_posision]
                ,[puesto]
                ,[rfc_corto]
                ,[nombre_s]
                ,[apellido_p]
                ,[apellido_m]
                ,[correo_inst]
                ,[correo_personal]
                ,[numero_contacto_1]
                ,[numero_contacto_2]
                ,[ext_tel]
                ,[estatus]
                ,[user_alta]
                ,[fecha_alta]
                ,[id_proc]
                ,[fec_ingreso]
                ,[RFC]
                ,[CURP]
                ,[Genero]
                ,[Hijos]
                ,[Escolaridad]
                ,[estatus_escolaridad]
                ,[estado_civil]
                ,[Carrera]
                ,[tipo_nombramiento]
                ,[sindicato]
                ,[nivel_jer]
                ,salario_neto
                ,[jefe_directo]
            )
                 SELECT 
                 $id_user_insumo AS [id_empleado_plant]
                ,$No_Empleado AS [no_empleado]
                ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
                ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
                ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
                ,$num_plaza as [id_num_posision]
                ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
                ,'$RFC_Corto' AS [rfc_corto]
                ,'$nombres' AS [nombre_s]
                ,'$apellido_P' AS [apellido_p]
                ,'$apellido_M' AS [apellido_m]
                ,'$Correo_sat' AS [correo_inst]
                ,(Case '$Correo_P' WHEN '' then NULL else '$Correo_P' end) AS [correo_personal]
                ,(Case '$telefono_1' WHEN '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
                ,(Case '$telefono_2' WHEN '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
                ,(Case '$ext_tele' WHEN '' then NULL else '$ext_tele' end) AS [ext_tel]
                ,'A' AS [estatus]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,19 AS [id_proc]
                ,'$fecha_ingreso' AS[fec_ingreso]
                ,'$RFC_comp' AS [RFC]
                ,'$CURP' AS [CURP]
                ,'$Genero' AS [Genero]
                ,'$Hijos' AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad = $Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil = $estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento = $tipo_nom1 ) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer = $nivel_jer ) AS [nivel_jer]
                ,'$sal_net' AS salario_neto
                ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            return "Se actualizaron los datos adicionales del empleado satisfactoriamente." ;
            
        }
        else {
            return print_r(sqlsrv_errors(),false);
            
        }

    }
    public function Actualiza_datos_posisiones($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        $id_user_insumo = $datos->id_empleado;
  
     

        $datos_us_faltantes = self::info_datos_us_2($id_user_insumo);
        $sindicatos = $datos_us_faltantes['id_sindicato'];
        $admin = $datos_us_faltantes['id_admin'];
        $sub = $datos_us_faltantes['id_sub_admin'];
        $dep = $datos_us_faltantes['id_depto'];
        $jefe_directo = $datos_us_faltantes['jefe_directo'];
        $puesto_adr = $datos_us_faltantes['id_puesto'];
        $num_plaza = $datos->posision_ten;
        $No_Empleado = $datos_us_faltantes['no_empleado'];
        $nombres =$datos_us_faltantes['nombre_s'];
        $apellido_P = $datos_us_faltantes['apellido_p'];
        $apellido_M = $datos_us_faltantes['apellido_m'];
        $RFC_comp =$datos_us_faltantes['rfc_comp'];
        $CURP = $datos_us_faltantes['curp_comp'];
        $RFC_Corto = $datos_us_faltantes['rfc_corto'];
        $Correo_sat = $datos_us_faltantes['correo_inst'];
        $Correo_P = $datos_us_faltantes['correo_personal'];
        $telefono_1 = $datos_us_faltantes['numero_contacto_1'];
        $telefono_2 = $datos_us_faltantes['numero_contacto_2'];
        $ext_tele = $datos_us_faltantes['ext_tel'];
        $fecha_ingreso = $datos_us_faltantes['fec_ingreso'] == NULL ? '' :$datos_us_faltantes['fec_ingreso']->format('Y/m/d');
        $fecha_fin_laboral = $datos_us_faltantes['fec_fin_rel_laboral'] == NULL ? '' :$datos_us_faltantes['fec_fin_rel_laboral']->format('Y/m/d');
        $tipo_nom1 = $datos_us_faltantes['num_nombramiento'];
        $Genero = $datos_us_faltantes['Genero'];
        $Hijos = $datos_us_faltantes['Hijos'];
        $Escolaridad = $datos_us_faltantes['Escolaridad'];
        $est_escolar = $datos_us_faltantes['estatus_escolaridad'];
        $carrera = $datos_us_faltantes['Carrera'];
        $nivel_jer = $datos_us_faltantes['id_nivel_jer'];
        $estado_civil = $datos_us_faltantes['estado_civil'];
        $sal_net = $datos_us_faltantes['sueldo_neto'];
        $proc =$datos->id_proc_plaza;
        $filtro_despeje = self::Deja_libre_plaza_por_cambio($datos);
if ($filtro_despeje == true) {
    $query = " INSERT INTO [mov_insumo](
        [id_empleado_plant]
        ,[no_empleado]
        ,[admin]
        ,[sub_admin]
        ,[depto]
        ,[id_num_posision]
        ,[puesto]
        ,[rfc_corto]
        ,[nombre_s]
        ,[apellido_p]
        ,[apellido_m]
        ,[correo_inst]
        ,[correo_personal]
        ,[numero_contacto_1]
        ,[numero_contacto_2]
        ,[ext_tel]
        ,fec_fin_rel_laboral
        ,[estatus]
        ,[user_alta]
        ,[fecha_alta]
        ,[id_proc]
        ,[fec_ingreso]
        ,[RFC]
        ,[CURP]
        ,[Genero]
        ,[Hijos]
        ,[Escolaridad]
        ,[estatus_escolaridad]
        ,[estado_civil]
        ,[Carrera]
        ,[tipo_nombramiento]
        ,[sindicato]
        ,[nivel_jer]
        ,salario_neto
        ,[jefe_directo]
    )
            SELECT 
            $id_user_insumo AS [id_empleado_plant]
        ,$No_Empleado AS [no_empleado]
        ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
        ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
        ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
        ,$num_plaza as [id_num_posision]
        ,(SELECT nombre_puesto FROM Puesto_ADR WHERE id_puesto = $puesto_adr) AS [puesto]
        ,'$RFC_Corto' AS [rfc_corto]
        ,'$nombres' AS [nombre_s]
        ,'$apellido_P' AS [apellido_p]
        ,'$apellido_M' AS [apellido_m]
        ,'$Correo_sat' AS [correo_inst]
        ,(Case '$Correo_P' when '' then NULL else '$Correo_P' end) AS [correo_personal]
        ,(Case '$telefono_1' when '' then NULL else '$telefono_1' end) AS [numero_contacto_1]
        ,(Case '$telefono_2' when '' then NULL else '$telefono_2' end) AS [numero_contacto_2]
        ,(Case '$ext_tele' when '' then NULL else '$ext_tele' end) AS [ext_tel]
        ,(Case '$fecha_fin_laboral' when '' then NULL else '$fecha_fin_laboral' end) AS  [fec_fin_rel_laboral]
        ,'A' AS [estatus]
        ,'$user_ej' AS [user_alta]
        ,GETDATE() AS [fecha_alta]
        ,$proc AS [id_proc]
        ,'$fecha_ingreso' AS [fec_ingreso]
        ,'$RFC_comp' AS [RFC]
        ,'$CURP' AS [CURP]
        ,'$Genero' AS [Genero]
        ,'$Hijos' AS [Hijos]
        ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad = $Escolaridad) AS [Escolaridad]
        ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
        ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil = $estado_civil) AS [estado_civil]
        ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
        ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento = $tipo_nom1 ) AS [tipo_nombramiento]
        ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
        ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer = $nivel_jer ) AS [nivel_jer]
        ,'$sal_net' AS salario_neto
        ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo
    
    UPDATE Empleado_insumo SET id_posision = ".$datos->posision_ten." ,
    [user_mod] ='$user_ej',
    fecha_mod = GETDATE()
    WHERE id_empleado_plant = ".$datos->id_empleado."
    UPDATE Posisiones set id_empleado = ".$datos->id_empleado.",user_mod= '$user_ej',fecha_mod= GETDATE() where id_posision = ".$datos->posision_ten."
    ";
    $prepare = sqlsrv_query($con, $query);
    if ($prepare == false) {
        return print_r(sqlsrv_errors(),false);
        $conexion->CerrarConexion($con);
    }
    else{
        $respuestas = self::inserta_historial_plazas($datos);
        return $respuestas;
        //$conexion->CerrarConexion($con);
    }
    }
    else {
        return "Error al dejar libre la plaza actual";
    }
       
    }
    public function Actualiza_datos_posisiones_sueldos($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
    
        $query = " UPDATE Posisiones set sueldo_neto = '".$datos->sueldo_neto."', 
        user_mod ='$user_ej',
        fecha_mod = GETDATE()
        where id_num_posision =  ".$datos->posision_act."
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
            $respuestas = self::inserta_historial_plazas($datos);
            return $respuestas;
            $conexion->CerrarConexion($con);
        }

       
    }
    public function Deja_libre_plaza_por_cambio($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        $query = "UPDATE Empleado_insumo SET id_posision = NULL ,
        user_mod = '$user_ej',
        fecha_mod=GETDATE()
        WHERE id_empleado_plant = ".$datos->id_empleado."
        UPDATE Posisiones set id_empleado = NULL where id_num_posision = ".$datos->posision_act."
        ";
        $prepare = sqlsrv_query($con, $query);
        if ($prepare == false) {
            return print_r(sqlsrv_errors(),false);
            $conexion->CerrarConexion($con);
        }
        else{
            return true ;
            $conexion->CerrarConexion($con);
        }
    }
}