<?php

class ConsultaInfoADR{

    public static function Inserta_nuevo_documento($datos)
    {
        include_once 'conexion.php';
        include_once 'sesion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $id_usu = $datos['id_user'];
        $tipo_doc = $datos["tipo_doc"];
        $no_oficio = $datos["no_oficio"];
        $fecha_oficio = $datos["fecha_oficio"];
        $usuario = $_SESSION["ses_rfc_corto_ing"];
        if ($no_oficio != '') {
            $oficio = self::Dame_el_numero_de_oficio($no_oficio);
            $no_ofi = $oficio['determinante'];
        }
        else {
            $no_ofi ="NO APLICA";
        }
        //echo $id_usu."/". $tipo_doc."/". $no_ofi."/". $fecha_oficio."/". $usuario;
        $query = " INSERT INTO [Oficios_historial](
            [id_empleado_plant]
            ,[Tipo_oficio]
            ,[id_num_oficio]
            ,[fecha_oficio_generado]
            ,[fecha_oficio_firmada]
            ,[id_proc]
            ,[user_alta]
            ,[fecha_alta]
        )
        values(
          $id_usu
          ,$tipo_doc
          ,'$no_ofi'
          ,'$fecha_oficio'
          ,'$fecha_oficio'
          ,31
          ,'$usuario'
          ,GETDATE()
        )
               ";
        $respuesta = sqlsrv_query($con,$query);
        if ($respuesta === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if ($respuesta1 =  self::Busca_id_oficio_nuevo($id_usu)) {
                return $respuesta1;
            }
            else {
                return print_r(sqlsrv_errors(),true);
            }
            
        }
    }
    public function Busca_id_oficio_nuevo($id_usu){
        include_once 'conexion.php';
        include_once 'sesion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
    
        $query = "SELECT top 1 id_oficio_gen FROM [Oficios_historial] where id_empleado_plant = $id_usu and  fecha_alta = (select  max (fecha_alta) from [Oficios_historial]) ";
        $respuesta = sqlsrv_query($con,$query);
       if($respuesta){
        while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
            $fila = $row;
        }
        if (isset($fila)) {
            return $fila['id_oficio_gen'];
            $conexion->CerrarConexion($con);
        }else{
            return "No se puede ver el resultado";
            $conexion->CerrarConexion($con);
        }
    }else{
        return print_r(sqlsrv_errors(),true);
        $conexion->CerrarConexion($con); 
    }
    }
    public function Catalogo_de_tipos_oficio()
    {
        include_once 'conexion.php';
        include_once 'sesion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
    
        $query = "SELECT * FROM cat_Tipo_Oficios where estatus = 'A'";
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
        public function dame_el_encargado_sub_actual_analisis(){
            include_once 'conexion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD();
            $query = " 	SELECT top 1 
            CONCAT (nombre_s,' ',apellido_p,' ',apellido_m )as nombre_sub_analisis,
            cat_esc.nombre_honor,
            esta.nombre_estatus_escolaridad,
            emp.estatus_escolaridad,
            puest.nombre_puesto,
            puest.id_puesto
            from  Empleado_insumo emp 
            INNER JOIN SubAdmin sub ON sub.id_sub_admin = emp.id_sub_admin
            INNER JOIN cat_escolaridad cat_esc ON emp.Escolaridad = cat_esc.id_escolaridad
             INNER JOIN cat_estatus_escolar esta ON emp.estatus_escolaridad = esta.id_estatus_escolaridad
            INNER JOIN Puesto_ADR puest ON puest.id_puesto = emp.id_puesto
            where puest.id_puesto = 15  and emp.id_proc = 9 and emp.id_sub_admin = 1";
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
          public function Motivos_filtros($est){
            include_once 'conexion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD();
            $query = "SELECT [id_motivo_esp]
            ,[id_proc]
            ,[Motivo_especial]
            ,[estatus]
            ,[user_alta]
            ,[fecha_alta]
            ,[user_mod]
            ,[fecha_mod]
            ,[user_baja]
            ,[fecha_baja]
        FROM [Control_Ingresos].[dbo].[Motivos_especiales] where id_proc = $est  and estatus = 'A'";
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
          public function Motivos_especiales(){
            include_once 'conexion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD();
            $query = "SELECT [id_motivo_esp]
            ,[id_proc]
            ,[Motivo_especial]
            ,[estatus]
            ,[user_alta]
            ,[fecha_alta]
            ,[user_mod]
            ,[fecha_mod]
            ,[user_baja]
            ,[fecha_baja]
        FROM [Control_Ingresos].[dbo].[Motivos_especiales] where estatus = 'A'";
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
        public function Consulta_Jefe_por_deps($dep){
            include_once 'conexion.php';
            include_once 'sesion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD(); 
            $query = "SELECT 
            id_empleado_plant,
            CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) nombre_empleado
            FROM Empleado_insumo where id_depto = $dep and (id_puesto = 37 OR
            id_puesto =   41 OR
            id_puesto =   4 OR
            id_puesto =   15 OR
            id_puesto =   22) and id_proc = 9";
            $respuesta = sqlsrv_query($con,$query);
            if($respuesta){
                while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                    $fila[] = $row;
                }
                if (isset($fila)) {
                    return $fila;
                   
                }else{
                    return null;
              
                }
            }else{
                return print_r(sqlsrv_errors(),true);
                $BD->CerrarConexion($con); 
            }  
        }
        public function Consulta_datos_del_oficio_para_nombrar($id_oficio){
            include_once 'conexion.php';
            include_once 'sesion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD(); 
            $query = "		SELECT [id_oficio_gen]
            ,ofi_his.[id_empleado_plant]
            ,emp.no_empleado
            ,emp.rfc_corto
            ,tip.Descripcion as tipo_oficio
            ,[id_num_oficio]
            ,ofi_his.[id_proc]
            ,ofi_his.[estatus]
        FROM [Control_Ingresos].[dbo].[Oficios_historial] ofi_his
        INNER JOIN Empleado_insumo emp ON emp.id_empleado_plant = ofi_his.id_empleado_plant 
		INNER JOIN [dbo].[cat_Tipo_Oficios] tip ON tip.id_tipo_of = ofi_his.Tipo_oficio 
        where ofi_his.id_oficio_gen = $id_oficio";
            $respuesta = sqlsrv_query($con,$query);
            if($respuesta){
                while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                    $fila = $row;
                }
                if (isset($fila)) {
                    return $fila;
                   
                }else{
                    return null;
              
                }
            }else{
                return print_r(sqlsrv_errors(),true);
                $BD->CerrarConexion($con); 
            }  
        }
        public function Consulta_Plazas_Gerentes(){
            include_once 'conexion.php';
            include_once 'sesion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD(); 
            $query = "SELECT DISTINCT posision_jefe From Posisiones where posision_jefe is not  null and posision_jefe != ''";
            $respuesta = sqlsrv_query($con,$query);
            if($respuesta){
                while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                    $fila[] = $row;
                }
                if (isset($fila)) {
                    return $fila;
                   
                }else{
                    return null;
              
                }
            }else{
                return print_r(sqlsrv_errors(),true);
                $BD->CerrarConexion($con); 
            }  
        }
        public function Consulta_Plazas_nivles(){
            include_once 'conexion.php';
            include_once 'sesion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD(); 
            $query = "SELECT DISTINCT nivel From Posisiones where nivel is not  null and nivel != ''";
            $respuesta = sqlsrv_query($con,$query);
            if($respuesta){
                while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                    $fila[] = $row;
                }
                if (isset($fila)) {
                    return $fila;
                   
                }else{
                    return null;
              
                }
            }else{
                return print_r(sqlsrv_errors(),true);
                $BD->CerrarConexion($con); 
            }  
        }
        public function Leer_archivo_usuarios()
        {
            include_once 'php/Classes/PHPExcel.php';
            include_once 'php/Classes/PHPExcel/Reader/Excel2007.php';
            $objReader = new PHPExcel_Reader_Excel2007();
            $objFecha = new PHPExcel_Shared_Date();
            $id_user = $_SESSION["ses_id_usuario_ing"];
            $ruta = "temp_files/carga_nueva$id_user.xlsx";
            if (is_file($ruta)) {
                $objPHPExcel = $objReader->load($ruta);
    
                // Asignar hoja de excel activa
                $objPHPExcel->setActiveSheetIndex(0);
                $i = 0; //posición 0 del arreglo
                $j = 2; //desde que fila se cuenta
                $_DATOS_EXCEL[] = null;
                do {
                    $_DATOS_EXCEL[$i]['CURP'] = $objPHPExcel->getActiveSheet()->getCell('A' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['RFC'] = $objPHPExcel->getActiveSheet()->getCell('B' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['RFC CORTO'] = $objPHPExcel->getActiveSheet()->getCell('C' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['NO.EMPLEADO'] = $objPHPExcel->getActiveSheet()->getCell('D' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['NOMBRES'] = $objPHPExcel->getActiveSheet()->getCell('E' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['APELLIDO_P'] = $objPHPExcel->getActiveSheet()->getCell('F' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['APELLIDO_M'] = $objPHPExcel->getActiveSheet()->getCell('G' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CORREO_INST'] = $objPHPExcel->getActiveSheet()->getCell('H' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CORREO_P'] = $objPHPExcel->getActiveSheet()->getCell('I' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['TEL_1'] = $objPHPExcel->getActiveSheet()->getCell('J' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['TEL_2'] = $objPHPExcel->getActiveSheet()->getCell('K' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['EXT'] = $objPHPExcel->getActiveSheet()->getCell('L' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ESTATUS_ACT'] = $objPHPExcel->getActiveSheet()->getCell('M' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['FECHA_INGRESO'] = $objPHPExcel->getActiveSheet()->getCell('N' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['TIPO_NOM'] = $objPHPExcel->getActiveSheet()->getCell('O' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['NIVEL_JER'] = $objPHPExcel->getActiveSheet()->getCell('P' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['SINDICATO'] = $objPHPExcel->getActiveSheet()->getCell('Q' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['SEXO'] = $objPHPExcel->getActiveSheet()->getCell('R' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['HIJOS'] = $objPHPExcel->getActiveSheet()->getCell('S' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ESTADO_CIVIL'] = $objPHPExcel->getActiveSheet()->getCell('T' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ESCOLARIDAD'] = $objPHPExcel->getActiveSheet()->getCell('U' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ESTATUS_ESTUDIOS'] = $objPHPExcel->getActiveSheet()->getCell('V' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CARRERA'] = $objPHPExcel->getActiveSheet()->getCell('W' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['ADMIN'] = $objPHPExcel->getActiveSheet()->getCell('X' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['SUB'] = $objPHPExcel->getActiveSheet()->getCell('Y' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['DEP'] = $objPHPExcel->getActiveSheet()->getCell('Z' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['JEFE_DIRECTO'] = $objPHPExcel->getActiveSheet()->getCell('AA' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['PUESTO_FUNCIONAL'] = $objPHPExcel->getActiveSheet()->getCell('AB' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['POSISION'] = $objPHPExcel->getActiveSheet()->getCell('AC' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['NIVEL'] = $objPHPExcel->getActiveSheet()->getCell('AD' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CLAVE_PRESUPUESTAL'] = $objPHPExcel->getActiveSheet()->getCell('AE' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['CLAVE_PUESTO'] = $objPHPExcel->getActiveSheet()->getCell('AF' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['SUELDO'] = $objPHPExcel->getActiveSheet()->getCell('AG' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL[$i]['POSISION JEFE'] = $objPHPExcel->getActiveSheet()->getCell('AH' . $j)->getCalculatedValue();
                    $i++;
                    $j++;
                } while ($j <= 200);
    
                $numerador = 1;
                $html[] = null;
                for ($i = 0; $i < count($_DATOS_EXCEL); $i++) {
                    $html[$i] = self::rows_leer_archivo2($_DATOS_EXCEL[$i], $numerador);
                    $numerador++;
                }
    
    
                echo "
                 <div class='text-center py-3'>
                        <button class='btn btn-dark btn_sat_black text-white' onclick='ConfirmarCargaUSU(1)'>Confirmar carga</button>
                        <button class='btn btn-secondary' onclick='ConfirmarCargaUSU(2)'>Cancelar</button>
                 </div>
                 <div class='container vh-50' style='padding-top: 3rem !important;' >
                 <table class='table table-responsive table-hover text-center vh-50 shadow p-1 bg-white rounded '>
                 <thead>
                   <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>No. Empleado</th>
                    <th scope='col'>Nombre</th>
                    <th scope='col'>Correo</th>
                    <th scope='col'>Estado</th>
                   </tr>
                 </thead>
                 <tbody>";
    
                for ($i = 0; $i < count($html); $i++) {
                    echo $html[$i];
                }
    
                echo "</tbody>
                </table>
                </div>
                ";
            } else {
                echo "<p class='h1 vh-100'>No se ha cargado ningun archivo aún.</p>";
            }
        }
        public static function rows_leer_archivo2($datos, $numerador)
        {
            include_once 'php/MetodosUsuarios.php';
            $usuarios = new MetodosUsuarios();
    
            $error_a = "<span class='d-inline-block' data-toggle='tooltip' data-placement='top' data-html='true' title='<b>Empleado ingresado con anterioridad.</b>'>
                            <i class='fas fa-exclamation-circle text-warning'></i>
                        </span>";
            $valido_a = "<span class='d-inline-block' data-toggle='tooltip' data-placement='top' data-html='true' title='<b>Analista valido.</b>'>
                        <i class='fas fa-check-circle text-success'></i>
                </span>";
    
    
            if (self::Consulta_usu_exist($datos["NO.EMPLEADO"]) == false) {
                $identificado = $valido_a;
            } else {
                $identificado = $error_a;
            }
    
            $html = "<tr>
                        <th scope='row'>$numerador</td>
                        <td>" . $datos["NO.EMPLEADO"] . "</td>
                        <td>" . $datos["NOMBRES"] . " " . $datos["APELLIDO_P"] . " " . $datos["APELLIDO_M"] . "</td>
                        <td>" . $datos["CORREO_INST"] . "</td>
                        <td>$identificado</td>
                    </tr>";
            return $html;
        }
        public static function Consulta_usu_exist($no_empleado)
        {
            include_once 'conexion.php';
            $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXIÓN
            //SE CREA UN QUERY
            $query = "SELECT * FROM Empleado_insumo WHERE (no_empleado = $no_empleado) ";
            //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
            $con = $conexion->ObtenerConexionBD();
            //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas =$row;
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
        public static function Consulta_rfc_Exist($rfc_c)
        {
            include_once 'conexion.php';
            $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXIÓN
            //SE CREA UN QUERY
            $query = "SELECT * FROM Empleado_insumo WHERE (rfc_corto = '$rfc_c') ";
            //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
            $con = $conexion->ObtenerConexionBD();
            //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas =$row;
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
        public static function Consulta_usu_exist_x_id($id_emp)
        {
            include_once 'conexion.php';
            $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXIÓN
            //SE CREA UN QUERY
            $query = "SELECT * FROM Empleado_insumo WHERE id_empleado_plant = $id_emp ";
            //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
            $con = $conexion->ObtenerConexionBD();
            //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas = $row;
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
        public static function posision_existe($posision)
        {
            include_once 'conexion.php';
            $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXIÓN
            //SE CREA UN QUERY
            $query = "SELECT id_num_posision FROM Posisiones WHERE id_num_posision = '$posision' ";
            //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
            $con = $conexion->ObtenerConexionBD();
            //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas = array('id_num_posision' => $row["id_num_posision"]);
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
        public static function posision_existe2($posision)
        {
            include_once 'conexion.php';
            $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXIÓN
            //SE CREA UN QUERY
            $query = "SELECT * FROM Posisiones WHERE id_posision = $posision ";
            //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
            $con = $conexion->ObtenerConexionBD();
            //SE VALIDA EL QUERY CON FORME A LA CONEXIÓN
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas =$row;
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
        public static function Crear_Posision_masiva($datos)
        {
            include_once 'conexion.php';
            include_once 'sesion.php';
            include_once 'Classes/PHPExcel.php';
            include_once 'Classes/PHPExcel/Reader/Excel2007.php';
            $conexion = new ConexionSQL();
            $con = $conexion->ObtenerConexionBD();
            
            $num_plaza = $datos['POSISION'];
            $nivel = $datos['NIVEL'];
            $clave_presupuesto = $datos['CLAVE_PRESUPUESTAL'];
            $clave_puesto = $datos['CLAVE_PUESTO'];
            $sal_net = $datos['SUELDO'];
            $posision_jefe = $datos['POSISION JEFE'];

            $usuario = $_SESSION["ses_rfc_corto_ing"];
            $query = " INSERT INTO [Posisiones] (
                [id_puesto_fump]
                ,[id_num_posision]
                ,[id_proc]
                ,[user_alta]
                ,[fecha_alta]
                ,[estatus]
                ,[posision_jefe]
                ,[nivel]
                ,[Codigo_pres]
                ,[sueldo_neto]
                )
                SELECT 
                (SELECT [id_puesto_fump] FROM [Puesto_FUMP] where [clave_puesto] = '$clave_puesto') AS [id_puesto_fump]
                ,'$num_plaza' AS [id_num_posision]
                ,9 AS [id_proc]
                , '$usuario' AS [user_alta]
                ,GETDATE() [fecha_alta]
                ,'A' AS [estatus]
                , CASE '$posision_jefe'WHEN '' THEN NULL ELSE '$posision_jefe' END  AS [posision_jefe]
                , case '$nivel' when '' then NULL else '$nivel' end AS [nivel]
                , case '$clave_presupuesto' when '' then NULL else '$clave_presupuesto' end  AS [Codigo_pres]
                ,CASE '$sal_net'WHEN '' THEN NULL ELSE '$sal_net' END AS [sueldo_neto]
            
            
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
                (select TOP 1 CAST (SCOPE_IDENTITY() AS INT) AS id_posision from Posisiones) AS [id_posision]
                ,(select Concat( emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) from Posisiones pos 
                FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
                where pos.[id_num_posision] = '$num_plaza'
                ) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP WHERE clave_puesto = '$clave_puesto' ) AS [puesto_fump]
                ,'$num_plaza' AS [id_num_posision]
                , CASE '$posision_jefe'WHEN '' THEN NULL ELSE '$posision_jefe' END  AS [posision_jefe]
                ,case '$nivel' when '' then NULL else '$nivel' end AS [nivel]
                ,case '$clave_presupuesto' when '' then NULL else '$clave_presupuesto' END AS [Codigo_pres]
                ,CASE '$sal_net'WHEN '' THEN NULL ELSE '$sal_net' END AS [sueldo_neto]
                ,16 AS [id_proc]
                ,'$usuario' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus]
                ";
    
            $prepare = sqlsrv_query($con, $query);
            if ($prepare === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                return true;
            }
        }
        public function Insertar_Usuarios()
        {
            include_once 'Classes/PHPExcel.php';
            include_once 'Classes/PHPExcel/Reader/Excel2007.php';
            include_once 'sesion.php';
            $objReader = new PHPExcel_Reader_Excel2007();
            $id_user = $_SESSION["ses_id_usuario_ing"];
            $ruta = "../temp_files/carga_nueva$id_user.xlsx";
    
            $objPHPExcel = $objReader->load($ruta);
    
            // Asignar hoja de excel activa
            $objPHPExcel->setActiveSheetIndex(0);
            $i = 0; //posición 0 del arreglo
            $j = 2; //desde que fila se cuenta
            $_DATOS_EXCEL[] = null;
            do {

                    $_DATOS_EXCEL['CURP'] = $objPHPExcel->getActiveSheet()->getCell('A' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['RFC'] = $objPHPExcel->getActiveSheet()->getCell('B' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['RFC CORTO'] = $objPHPExcel->getActiveSheet()->getCell('C' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['NO.EMPLEADO'] = $objPHPExcel->getActiveSheet()->getCell('D' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['NOMBRES'] = $objPHPExcel->getActiveSheet()->getCell('E' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['APELLIDO_P'] = $objPHPExcel->getActiveSheet()->getCell('F' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['APELLIDO_M'] = $objPHPExcel->getActiveSheet()->getCell('G' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['CORREO_INST'] = $objPHPExcel->getActiveSheet()->getCell('H' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['CORREO_P'] = $objPHPExcel->getActiveSheet()->getCell('I' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['TEL_1'] = $objPHPExcel->getActiveSheet()->getCell('J' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['TEL_2'] = $objPHPExcel->getActiveSheet()->getCell('K' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['EXT'] = $objPHPExcel->getActiveSheet()->getCell('L' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['ESTATUS_ACT'] = $objPHPExcel->getActiveSheet()->getCell('M' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['FECHA_INGRESO'] = $objPHPExcel->getActiveSheet()->getCell('N' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['TIPO_NOM'] = $objPHPExcel->getActiveSheet()->getCell('O' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['NIVEL_JER'] = $objPHPExcel->getActiveSheet()->getCell('P' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['SINDICATO'] = $objPHPExcel->getActiveSheet()->getCell('Q' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['SEXO'] = $objPHPExcel->getActiveSheet()->getCell('R' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['HIJOS'] = $objPHPExcel->getActiveSheet()->getCell('S' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['ESTADO_CIVIL'] = $objPHPExcel->getActiveSheet()->getCell('T' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['ESCOLARIDAD'] = $objPHPExcel->getActiveSheet()->getCell('U' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['ESTATUS_ESTUDIOS'] = $objPHPExcel->getActiveSheet()->getCell('V' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['CARRERA'] = $objPHPExcel->getActiveSheet()->getCell('W' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['ADMIN'] = $objPHPExcel->getActiveSheet()->getCell('X' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['SUB'] = $objPHPExcel->getActiveSheet()->getCell('Y' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['DEP'] = $objPHPExcel->getActiveSheet()->getCell('Z' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['JEFE_DIRECTO'] = $objPHPExcel->getActiveSheet()->getCell('AA' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['PUESTO_FUNCIONAL'] = $objPHPExcel->getActiveSheet()->getCell('AB' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['POSISION'] = $objPHPExcel->getActiveSheet()->getCell('AC' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['NIVEL'] = $objPHPExcel->getActiveSheet()->getCell('AD' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['CLAVE_PRESUPUESTAL'] = $objPHPExcel->getActiveSheet()->getCell('AE' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['CLAVE_PUESTO'] = $objPHPExcel->getActiveSheet()->getCell('AF' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['SUELDO'] = $objPHPExcel->getActiveSheet()->getCell('AG' . $j)->getCalculatedValue();
                    $_DATOS_EXCEL['POSISION JEFE'] = $objPHPExcel->getActiveSheet()->getCell('AH' . $j)->getCalculatedValue();
                    $llave = self::Consulta_usu_exist($_DATOS_EXCEL["NO.EMPLEADO"]);
    
                if ($llave == false) {
                        if ( $filtro = self::posision_existe($_DATOS_EXCEL['POSISION']) != true) {
                            if($error_c =self::Crear_Posision_masiva($_DATOS_EXCEL)!= true){
                                $errores[] = array('Posision' => $_DATOS_EXCEL['POSISION'], 'error' => "No se pudo crear la posisión; " . $error_c);
                            }
                            else{
                                $errores[] = array('Posision' => $_DATOS_EXCEL['POSISION'], 'error' => "Posisión registrada con anterioridad; ");
                            }
                            if ($error_c = self::Crear_Usuario_insumo_masvio($_DATOS_EXCEL) != true) {
                                $errores[] = array('num_empleado' => $_DATOS_EXCEL['NO.EMPLEADO'], 'error' => "No se pudo crear el usuario; " . $error_c);
                            } else {
                                $errores[] = array('num_empleado' => $_DATOS_EXCEL['NO.EMPLEADO'], 'error' => "Usuario registrado con anterioridad; ");
                            }
                        }
                        else{
                            if ($error_c = self::Crear_Usuario_insumo_masvio($_DATOS_EXCEL) != true) {
                                $errores[] = array('num_empleado' => $_DATOS_EXCEL['NO.EMPLEADO'], 'error' => "No se pudo crear el usuario; " . $error_c);
                            } else {
                                $errores[] = array('num_empleado' => $_DATOS_EXCEL['NO.EMPLEADO'], 'error' => "Usuario registrado con anterioridad; ");
                            }
                        }
                        
                }
                 
            
        
    
    
                $j++;
            } while (($objPHPExcel->getActiveSheet()->getCell('A' . $j)->getCalculatedValue() != null));
    
            unlink($ruta);
            if (isset($errores)) {
                $formato = self::Formato_error2($errores);
            } else {
                $formato = self::Formato_exito2();
            }
            echo $formato;
        }
        public static function Crear_Usuario($datos)
        {
            include_once 'conexion.php';
            include_once 'sesion.php';
            include_once 'Classes/PHPExcel.php';
            include_once 'Classes/PHPExcel/Reader/Excel2007.php';
            $objFecha = new PHPExcel_Shared_Date();
            $conexion = new ConexionSQL();
            $con = $conexion->ObtenerConexionBD();
            $id_usu = $datos['num_empleado'];
            $analista = $datos["Analista"];
            $rfc = $datos["RFC"];
            $correo = $datos["Correo"];
            $Admin1 = $datos['id_admin'];
            $sub = $datos['id_sub_admin'];
            $dpto = $datos['id_depto'];
            $Jefe = $datos['jefe_directo'];
            $usuario = $_SESSION["ses_rfc_corto"];
            $query = "INSERT INTO Empleado (id_admin,id_sub_admin,id_depto,id_puesto,id_perfil,rfc_corto,nombre_empleado,correo,estatus,passwd,user_alta,fecha_alta,no_empleado,jefe_directo,responsiva) 
            VALUES ( $Admin1 , $sub , $dpto ,1,2,'" . $rfc . "','" . $analista . "','" . $correo . "','A','e10adc3949ba59abbe56e057f20f883e','" . $usuario . "',GETDATE()," . $id_usu . "," . $Jefe . " ,0) ";
    
            $prepare = sqlsrv_query($con, $query);
            if ($prepare === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                return true;
            }
        }
        public function saca_id_jefe($no_empleado_jefe){
            include_once 'conexion.php';
            $conexion = new ConexionSQL();
            $con = $conexion->ObtenerConexionBD();
            $query = "SELECT top 1 id_empleado_plant  FROM Empleado_insumo where no_empleado = '$no_empleado_jefe' and estatus ='A'";
            $respuesta = sqlsrv_query($con,$query);

        if($respuesta){
            while($row = sqlsrv_fetch_array($respuesta, SQLSRV_FETCH_ASSOC)){
                $fila = $row['id_empleado_plant'];
            }
            if (isset($fila)) {
                return $fila;
               
            }else{
                return null;
          
            }
        }else{
            return print_r(sqlsrv_errors(),true);
            $BD->CerrarConexion($con); 
        }  
        }
        public static function Crear_Usuario_insumo_masvio($datos)
        {
            include_once 'conexion.php';
            include_once 'sesion.php';
            include_once 'Classes/PHPExcel.php';
            include_once 'Classes/PHPExcel/Reader/Excel2007.php';
            $objFecha = new PHPExcel_Shared_Date();
            $timestamp =  $objFecha->ExcelToPHP($datos['FECHA_INGRESO']);
            $fecha_Ing = date("Y-m-d", $timestamp);
            $fec_ing =  DateTime::createFromFormat('Y-m-d', $fecha_Ing);
            $conexion = new ConexionSQL();
            $con = $conexion->ObtenerConexionBD();
            $CURP = $datos['CURP'];
            $RFC_comp = $datos['RFC'];
            $RFC_Corto = $datos['RFC CORTO'];
            $No_Empleado = $datos['NO.EMPLEADO'];
            $nombres = $datos['NOMBRES'];
            $apellido_P = $datos['APELLIDO_P'];
            $apellido_M = $datos['APELLIDO_M'];
            $Correo_sat = $datos['CORREO_INST'];
            $Correo_P = $datos['CORREO_P'];
            $telefono_1 = $datos['TEL_1'];
            $telefono_2 = $datos['TEL_2'];
            $ext_tele = $datos['EXT'];
            $estatus_opera = $datos['ESTATUS_ACT'];
            $fecha_ingreso =  $fec_ing->format('Y/m/d');;
            $tipo_nom = $datos['TIPO_NOM'];
            $nivel_jer = $datos['NIVEL_JER'];
            $sindicatos = $datos['SINDICATO'];
            $Genero = $datos['SEXO'];
            $Hijos = $datos['HIJOS'];
            $estado_civil = $datos['ESTADO_CIVIL'];
            $Escolaridad = $datos['ESCOLARIDAD'] ;
            $est_escolar = $datos['ESTATUS_ESTUDIOS'];
            $carrera = $datos['CARRERA'];
            $admin = $datos['ADMIN'];
            $sub = $datos['SUB'];
            $dep = $datos['DEP'];
            $jefe = $datos['JEFE_DIRECTO'];
            $puesto_adr = $datos['PUESTO_FUNCIONAL'];
            $num_plaza = $datos['POSISION'];
            $nivel = $datos['NIVEL'];
            $clave_presupuesto = $datos['CLAVE_PRESUPUESTAL'];
            $clave_puesto = $datos['CLAVE_PUESTO'];
            $sal_net = $datos['SUELDO'];
            $user_alta = $_SESSION['ses_rfc_corto_ing'];
    
    
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
            ,Case '$jefe' when '' then null Else ( SELECT top 1 id_empleado_plant  FROM Empleado_insumo where no_empleado = '$jefe' and estatus ='A' ) end  AS [jefe_directo]
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
            sueldo_neto =Case '$sal_net' when '' then NULL else '$sal_net' end where id_num_posision = '$num_plaza'
        
        
            ";
            $prepare = sqlsrv_query($con, $query);
            if ($prepare == false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                if($insert_historial= self::crea_historiales_carga_masvia($datos) != true){
                    return $insert_historial;
                }
                else {
                    return true;
                }
            }
                
            }
            public static function crea_historiales_carga_masvia($datos)
        {
            include_once 'conexion.php';
            include_once 'sesion.php';
            include_once 'Classes/PHPExcel.php';
            include_once 'Classes/PHPExcel/Reader/Excel2007.php';
            $objFecha = new PHPExcel_Shared_Date();
            $timestamp =  $objFecha->ExcelToPHP($datos['FECHA_INGRESO']);
            $fecha_Ing = date("Y-m-d", $timestamp);
            $fec_ing =  DateTime::createFromFormat('Y-m-d', $fecha_Ing);
            $conexion = new ConexionSQL();
            $con = $conexion->ObtenerConexionBD();
            $CURP = $datos['CURP'];
            $RFC_comp = $datos['RFC'];
            $RFC_Corto = $datos['RFC CORTO'];
            $No_Empleado = $datos['NO.EMPLEADO'];
            $nombres = $datos['NOMBRES'];
            $apellido_P = $datos['APELLIDO_P'];
            $apellido_M = $datos['APELLIDO_M'];
            $Correo_sat = $datos['CORREO_INST'];
            $Correo_P = $datos['CORREO_P'];
            $telefono_1 = $datos['TEL_1'];
            $telefono_2 = $datos['TEL_2'];
            $ext_tele = $datos['EXT'];
            $estatus_opera = $datos['ESTATUS_ACT'];
            $fecha_ingreso =  $fec_ing->format('Y/m/d');;
            $tipo_nom = $datos['TIPO_NOM'];
            $nivel_jer = $datos['NIVEL_JER'];
            $sindicatos = $datos['SINDICATO'];
            $Genero = $datos['SEXO'];
            $Hijos = $datos['HIJOS'];
            $estado_civil = $datos['ESTADO_CIVIL'];
            $Escolaridad = $datos['ESCOLARIDAD'] ;
            $est_escolar = $datos['ESTATUS_ESTUDIOS'];
            $carrera = $datos['CARRERA'];
            $admin = $datos['ADMIN'];
            $sub = $datos['SUB'];
            $dep = $datos['DEP'];
            $jefe = $datos['JEFE_DIRECTO'];
            $puesto_adr = $datos['PUESTO_FUNCIONAL'];
            $num_plaza = $datos['POSISION'];
            $nivel = $datos['NIVEL'];
            $clave_presupuesto = $datos['CLAVE_PRESUPUESTAL'];
            $clave_puesto = $datos['CLAVE_PUESTO'];
            $sal_net = $datos['SUELDO'];
            $user_alta = $_SESSION['ses_rfc_corto_ing'];
          
            $query="INSERT INTO [mov_insumo](
                [id_empleado_plant]
                ,jefe_directo
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
                ( SELECT id_empleado_plant FROM Empleado_insumo where no_empleado = $No_Empleado) AS [id_empleado_plant]
                ,Case '$jefe' when '' then null Else (select concat(nombre_s, ' ',apellido_p, ' ',apellido_m) as nombre_jefe from Empleado_insumo where no_empleado = '$jefe')  end  AS [jefe_directo]
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
                ,Case '$Hijos' when '' then null Else '$Hijos' end  AS [Hijos]
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad =$Escolaridad) AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad =$est_escolar) AS [estatus_escolaridad]
                ,(SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil =$estado_civil) AS [estado_civil]
                ,(Case '$carrera' when '$carrera' then NULL else '$carrera' end) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento =$tipo_nom) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer =$nivel_jer) AS [nivel_jer]
                ,Case '$sal_net' when '' then NULL else '$sal_net' end AS salario_neto
                    
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
                (select  id_posision from Posisiones where [id_num_posision] = '$num_plaza') AS [id_posision]
                ,(select Concat( emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) from Posisiones pos 
                FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
                where pos.[id_num_posision] = '$num_plaza'
                ) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP WHERE clave_puesto = '$clave_puesto' ) AS [puesto_fump]
                ,'$num_plaza' AS [id_num_posision]
                ,(SELECT posision_jefe from Posisiones where id_num_posision = '$num_plaza')  AS [posision_jefe]
                ,case '$nivel' when '' then NULL else (SELECT nivel from Posisiones where id_num_posision ='$num_plaza') end AS [nivel]
                ,case '$clave_presupuesto' when '' then  NULL else (SELECT Codigo_pres from Posisiones where id_num_posision = '$num_plaza') end AS [Codigo_pres]
                ,CASE '$sal_net'WHEN '' THEN NULL ELSE '$sal_net' END AS [sueldo_neto]
                ,8 AS [id_proc]
                ,'$user_alta' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus] ";
            $prepare = sqlsrv_query($con, $query);
            if ($prepare === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                return true;
            }
        }

        public static function Formato_error2($datos)
        {
            $html = "<div class='alert alert-danger' role='alert'><ul>";
            for ($i = 0; $i < count($datos); $i++) {
                if ($i == 9) {
                    $html .= "<a onclick='vermas()' href='#' id='link_ver'>Ver mas</a>
                                <div id='vermasdiv' style='display:none'> 
                                    <li>Error con <b>" . $datos["NO.EMPLEADO"] . "</b>: " . $datos["error"] . "</li>
                                ";
                    $html .= "<a onclick='vermas()' href='#' id='link_ver'>Ver mas</a>
                    <div id='vermasdiv' style='display:none'> 
                        <li>Error con <b>" . $datos["POSISION"] . "</b>: " . $datos["error"] . "</li>
                    ";
                } else {
                    $html .= "<li>Error con <b>" . $datos["NO.EMPLEADO"] . "</b>: " . $datos["error"] . "</li>";
                    $html .= "<li>Error con <b>" . $datos["POSISION"] . "</b>: " . $datos["error"] . "</li>";
                }
            }
            if (count($datos) >= 10) {
                $html .= "</div></ul></div>";
            } else {
                $html .= "</ul></div>";
            }
            return $html;
        }
        public static function Formato_exito2()
        {
            $html = "<div class='alert alert-success' role='alert'>
                        ¡Carga realizada con éxito!
                    </div>";
            return $html;
        }





        public function Actualiza_posisiones_mantenimiento($datos){
            include_once 'sesion.php';
            include_once 'conexion.php';
            $BD = new ConexionSQL();
            $con = $BD->ObtenerConexionBD();
            $user_alta = $_SESSION['ses_rfc_corto_ing'];
            $filtro = self::posision_existe($datos->num_posision);
            $filtro2 = self::posision_existe2($datos->id_posision);
            $compra_dato1 = $filtro2['id_num_posision'];
            $compra_dato2 = $filtro2['id_proc'];
            $compra_dato3 = $filtro2['Codigo_pres'];
            $compra_dato4 = $filtro2['nivel'];
            $compra_dato5 = $filtro2['posision_jefe'];
            if (!isset($filtro)) {
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
            } else {
                if ($datos->num_posision == $compra_dato1) {
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
                } else {
                    return "El número de posición ya fue registrado en sistema";
                }
                
               
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
        switch ($_GET) {
            case isset($_GET['pagina']):
  
            $condicion = "";
            break;
            case isset($_GET['Cod_puesto']):
            $id_puesto_fump = $_COOKIE['Cod_puest'];
            $condicion = "WHERE puest.id_puesto_fump = $id_puesto_fump";
            break;
            case isset($_GET['Nivel']):
                $nivel = $_COOKIE['Nivel_select'];
                $condicion = "WHERE pos.nivel = '$nivel'";
            break;
            case isset($_GET['Pos_gerente']):
                $ps_ger = $_COOKIE['pos_gerentes'];
                $condicion = "WHERE pos.posision_jefe = '$ps_ger'";
            break;
            case isset($_GET['Posision']):
                $Posision = $_COOKIE['posiscion_busc'];
                $condicion = "WHERE pos.id_num_posision like '%$Posision%'";
            break;
            case isset($_GET['Stock']):
                $opcion = $_COOKIE['extra'];
                switch ($opcion) {
                case 1:
                    $condicion = "where pos.id_empleado is null";
                break;
                case 2:
                    $condicion = "where emp.id_empleado_plant is not null and (emp.id_proc = 9 or emp.id_proc = 12)";
                break;
                case 3:
                    $condicion = "WHERE pos.id_proc = 7 or emp.id_proc = 7";
                break;
                case 4:
                    $condicion = "WHERE emp.id_proc = 25 or emp.id_proc = 25";
                break;
                case 5:
                    $condicion = "WHERE emp.id_proc = 6";
                break;
                case 6:
                    $condicion = "WHERE emp.id_proc = 28";
                break;

                }
                
            break;
            default:
            $num = $_GET['pagina'];
            break;
          }
        $query = "	SELECT  COUNT(*) TOTAL
        FROM [Control_Ingresos].[dbo].[Posisiones] pos
        FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
        INNER JOIN Procesos procc ON procc.id_proc = pos.id_proc 
        INNER JOIN Puesto_FUMP puest ON puest.id_puesto_fump = pos.id_puesto_fump 
        $condicion";
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
                if ($activa_segundo_procesos = self::Inserta_historial_cambio_de_plza($datos)) {
                    return "Registro exitoso";
                }{
                    return $activa_segundo_procesos;
                }
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
        switch ($_GET) {
        case isset($_GET['pagina']):
            $condicion ="";
            break;
            case isset($_GET['Cod_puesto']):
            $id_puesto_fump = $_COOKIE['Cod_puest'];
            $condicion = "AND busq.id_puesto_fump = $id_puesto_fump";
            break;
            case isset($_GET['Nivel']):
                $NIVEL = $_COOKIE['Nivel_select'];
                $condicion = "AND busq.nivel = '$NIVEL'";
            break;
            case isset($_GET['Pos_gerente']):
                $ps_ger = $_COOKIE['pos_gerentes'];
                $condicion = "AND busq.posision_jefe = '$ps_ger'";
            break;
            case isset($_GET['Posision']):
                $posision = $_COOKIE['posiscion_busc'];
                $condicion = "AND busq.id_num_posision like '%$posision%'";
            break;
            case isset($_GET['Stock']):
                $opcion = $_COOKIE['extra'];
                switch ($opcion) {
                    case 1:
                        $condicion = "and busq.id_empleado is null";
                    break;
                    case 2:
                        $condicion = "and busq.id_empleado is not null and (busq.id_proc = 9 or busq.id_proc = 12)";
                    break;
                    case 3:
                        $condicion = "and busq.id_proc = 7 or busq.id_proc = 7";
                    break;
                    case 4:
                        $condicion = "and busq.id_proc = 25 or busq.proc_empleado = 25";
                    break;
                    case 5:
                        $condicion = "and busq.id_proc = 6 or busq.proc_empleado = 6";
                    break;
                    case 6:
                        $condicion = "and busq.id_proc = 28 or busq.proc_empleado = 28";
                    break;
    
                    }
            break;
            default:
            $condicion ="";
            break;
          }
        $query = "  	       SELECT distinct TOP (50)
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
	   ,busq.clave_puesto
	   ,busq.estado_analista
	   ,busq.nombre_proc_analista
       ,busq.proc_empleado

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
         ,emp.id_proc as proc_empleado
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
     FROM [Control_Ingresos].[dbo].[Posisiones] pos
     FULL JOIN Empleado_insumo emp ON emp.id_empleado_plant = pos.id_empleado 
     INNER JOIN Procesos procc ON procc.id_proc = pos.id_proc 
	 FULL JOIN Procesos procc1 ON procc1.id_proc = emp.id_proc 
     inner JOIN Puesto_FUMP puest ON puest.id_puesto_fump = pos.id_puesto_fump ) busq
     WHERE busq.seq >=  $num $condicion";
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
        ,fecha_mov_funcional
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
    public function Historial_mov_oficios_por_analista($id_insumo){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "  SELECT of_his.[id_oficio_gen]
        ,of_his.[id_mov_personal]
        ,of_his.[id_empleado_plant]
        ,emp.no_empleado
        ,emp.rfc_corto
        ,CONCAT(emp.nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado
        ,cat_tipo.Descripcion as tipo_oficio
        ,[id_num_oficio]
        ,of_his.[fecha_oficio_generado]
        ,of_his.fecha_oficio_firmada
        ,procc.nombre_proc
        ,of_his.id_proc
        ,of_his.[user_alta]
        ,of_his.[fecha_alta]
        ,of_his.[user_mod]
        ,of_his.[fecha_mod]
        ,of_his.[user_baja]
        ,of_his.[fecha_baja]
        ,of_his.[estatus]
    FROM [Control_Ingresos].[dbo].[Oficios_historial] of_his
    FULL JOIN cat_Determinante det ON det.id_det = of_his.id_oficio_det
    INNER JOIN Procesos procc ON procc.id_proc = of_his.id_proc
    INNER JOIN Empleado_insumo emp ON emp.id_empleado_plant = of_his.id_empleado_plant
	INNER JOIN cat_Tipo_Oficios cat_tipo ON cat_tipo.id_tipo_of = of_his.Tipo_oficio
	where emp.id_empleado_plant = $id_insumo ORDER BY of_his.fecha_alta DESC";
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
    public function Historial_movimientos($id_insumo){
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
    public function datos_oficio_generacion_pdf($oficio){
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = " SELECT of_his.[id_oficio_gen]
        ,of_his.[id_mov_personal]
        ,of_his.[id_empleado_plant]
        ,CONCAT(emp.nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado
        ,emp.RFC
		,emp.no_empleado
        , CASE WHEN of_his.[Tipo_oficio] = 1 THEN 'ASIGNACION'
        WHEN of_his.[Tipo_oficio] = 2 THEN 'NOMBRAMIENTO' end as tipo_oficio
        ,[id_num_oficio]
        ,of_his.[fecha_oficio_generado]
        ,day(of_his.[fecha_oficio_generado]) dia_gnerado
        ,MOnth(of_his.[fecha_oficio_generado]) mes_gnerado
        ,Year(of_his.[fecha_oficio_generado]) anio_gnerado
        ,of_his.fecha_oficio_firmada
        ,day(of_his.fecha_oficio_firmada) dia_firmado
        ,MOnth(of_his.fecha_oficio_firmada) mes_firmado
        ,Year(of_his.fecha_oficio_firmada) anio_firmado
        ,procc.nombre_proc
        ,of_his.[user_alta]
        ,of_his.[fecha_alta]
        ,of_his.[user_mod]
        ,of_his.[fecha_mod]
        ,of_his.[user_baja]
        ,of_his.[fecha_baja]
        ,of_his.[estatus]
        FROM [Control_Ingresos].[dbo].[Oficios_historial] of_his
        INNER JOIN cat_Determinante det ON det.id_det = of_his.id_oficio_det
        INNER JOIN Procesos procc ON procc.id_proc = of_his.id_proc
        INNER JOIN Empleado_insumo emp ON emp.id_empleado_plant = of_his.id_empleado_plant
        where of_his.id_oficio_gen = $oficio ";
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
  public function Dame_el_numero_de_oficio($oficio){
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT CONCAT(Determinante,YEAR(GETDATE()),'-','$oficio') as determinante FROM cat_Determinante";
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
  public function datos_insumo_descarga($no_emp){
    include_once 'conexion.php';
    $BD = new ConexionSQL();
    $con = $BD->ObtenerConexionBD();
    $query = "SELECT * FROM Empleado_insumo where no_empleado = $no_emp";
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
        ,puest_adr.id_puesto as id_puesto_adr
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
       WHERE  id_empleado_plant = $id_us and emp.estatus = 'A' ORDER BY emp.id_sub_admin & emp.id_depto ASC
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
       ,(select clave_puesto from Puesto_FUMP where id_puesto_fump = (select top 1 id_puesto_fump  from Posisiones where id_num_posision =(SELECT posision_jefe from Posisiones where id_empleado = $id_us))) as clave_jefe
       ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_posision = (select top 1 id_posision from Posisiones where id_num_posision =(SELECT posision_jefe from Posisiones where id_empleado = $id_us))) as nombre_jefe
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
       ,emp.id_motivo_esp
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
        $query = "SELECT * FROM Procesos where id_proc = 32 or id_proc = 28 or id_proc =9 or id_proc = 11  or id_proc = 7 or id_proc = 6 or id_proc = 25 or id_proc = 12";
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
		WHERE id_posision = 14 and emp.id_proc = 9
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
        $query = "	SELECT DISTINCT
        nombre_admin,
        admind.id_admin,
        SUB.id_sub_admin,
        nombre_sub_admin,
        Concat('SUB. ',SUBSTRING(nombre_sub_admin, 22,90)) as nombre_estructura_sub,
        nombre_depto,
        emp.no_empleado,
        CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) As nombre_empleado,
        puest.nombre_puesto
        FROM SubAdmin SUB
        FULL JOIN Administracion admind ON admind.id_admin = SUB.id_admin
        FULL JOIN Departamento dep ON SUB.id_sub_admin = dep.id_sub_admin	
        INNER JOIN Empleado_insumo emp ON emp.id_depto = dep.id_depto
        FULL JOIN Puesto_ADR puest ON puest.id_puesto = emp.id_puesto
        WHERE nombre_depto = 'SUBADMINISTRACIÓN' AND nombre_puesto = 'SUBADMINISTRADOR' 
		and emp.id_proc = 9
        or nombre_puesto = 'ENCARGADO' AND no_empleado != null order by nombre_sub_admin asc";
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
    public function Datos_empleados_por_jefes($jefe){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "SELECT 
        dep.nombre_depto,
        sub.nombre_sub_admin,
        emp.id_empleado_plant,
        emp.no_empleado,
        emp.id_puesto,
        CONCAT(emp.nombre_s,' ',emp.apellido_p,' ',apellido_m) nombre_empleado,
        puest_adr.nombre_puesto,
        emp.jefe_directo
        FROM Departamento dep
        INNER JOIN SubAdmin sub ON sub.id_sub_admin = dep.id_sub_admin
        INNER JOIN Empleado_insumo emp ON emp.id_depto = dep.id_depto
        INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto 
        WHERE( emp.id_puesto != 22 
        AND emp.id_puesto != 37 
        AND emp.id_puesto != 4 
        AND emp.id_puesto != 22 
        AND emp.id_puesto != 15) 
        AND jefe_directo = $jefe 
        AND (emp.id_proc != 11 
        AND emp.id_proc != 7 
        AND emp.id_proc != 6 
        AND emp.id_proc != 25 
        and emp.id_proc != 28 ) and emp.id_proc = 9 
        order by dep.id_sub_admin asc,  dep.id_depto asc, emp.id_puesto asc";
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
    public function jefes_Diagramas(){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "		SELECT 
        emp.id_empleado_plant
       ,emp.[no_empleado]
       ,emp.[id_admin]
       ,emp.[id_sub_admin]
       ,sub.nombre_sub_admin
       ,emp.[id_depto]
       ,dep.nombre_depto
       ,emp.[jefe_directo]
       ,emp.[id_posision]
       ,emp.[id_puesto]
       ,puest_adr.nombre_puesto
       ,emp.[id_perfil]
       ,emp.[rfc_corto]
       ,Concat(emp.[nombre_s],' ',emp.[apellido_p],' ',emp.[apellido_m]) as nombre_empleado
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
       ,emp.[fec_ingreso]
       ,emp.[RFC]
       ,emp.[CURP]
       ,emp.[Genero]
       ,emp.[Hijos]
       ,emp.[Escolaridad]
       ,emp.[estatus_escolaridad]
       ,emp.[estado_civil]
       ,emp.[Carrera]
       ,emp.[fec_fin_rel_laboral]
       ,emp.[tipo_nombramiento]
       ,emp.[id_sindicato]
       ,emp.[id_nivel_jer]
 from Empleado_insumo emp 
 INNER JOIN SubAdmin sub ON sub.id_sub_admin = emp.id_sub_admin
 INNER JOIN Departamento dep ON dep.id_depto = emp.id_depto 
 INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto 
 WHERE 
 (emp.id_puesto = 22 
 OR emp.id_puesto = 37 
 OR  emp.id_puesto = 4 
 OR emp.id_puesto = 22 
 OR emp.id_puesto = 15 and emp.estatus = 'A' ) AND emp.id_proc = 9
 ORDER BY emp.id_sub_admin ASC,  emp.id_depto ASC, emp.id_puesto ASC";
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
        ,sub.id_sub_admin
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
        AND sub.estatus = 'A' AND emp.id_proc = 9
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
    public function filtra_deps_por_sub($sub){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "	SELECT distinct
        nombre_admin
        ,nombre_sub_admin
        ,sub.id_sub_admin
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
        AND sub.estatus = 'A' AND emp.id_proc = 9
        and (pues_adr.id_puesto  = 22 OR pues_adr.id_puesto  = 37) and dep.id_sub_admin = $sub";
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
    public function Datos_subordinados_por_jefe(){
        //include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query = "		   SELECT distinct
        --nombre_admin
        --,nombre_sub_admin
        sub.id_sub_admin
        ,nombre_depto
        ,emp_jefe.no_empleado
        ,concat(emp.nombre_s,' ',emp.apellido_p,' ',emp.apellido_m) AS  nombre_jefe
		,pues_adr.nombre_puesto as puesto_jefe
		,concat(emp_jefe.nombre_s,' ',emp_jefe.apellido_p,' ',emp_jefe.apellido_m) AS subordinado
		,pues_adr_subor.nombre_puesto as puesto_subor
        FROM Administracion admins
        FULL JOIN SubAdmin sub ON sub.id_admin =  admins.id_admin
        FULL JOIN Departamento dep ON sub.id_sub_admin =  dep.id_sub_admin
        FULL JOIN Empleado_insumo emp ON  dep.id_depto =  emp.id_depto
		FULL JOIN Empleado_insumo emp_jefe ON  emp.id_empleado_plant =  emp_jefe.jefe_directo
        FULL JOIN Puesto_ADR pues_adr ON  emp.id_puesto =  pues_adr.id_puesto
		FULL JOIN Puesto_ADR pues_adr_subor ON  emp_jefe.id_puesto =  pues_adr_subor.id_puesto
        WHERE 
        (sub.nombre_sub_admin != 'Subadministración' 
        AND dep.nombre_depto != 'Subadministración' 
        and dep.estatus = 'A')
        AND  (sub.nombre_sub_admin != 'Administración' 
        AND dep.nombre_depto != 'Administración' 
        AND dep.estatus = 'A') 
        AND sub.estatus = 'A'
		AND pues_adr.nombre_puesto != 'ANALISTA DESCONCENTRADO'
        OR (pues_adr.id_puesto  = 22 OR pues_adr.id_puesto  = 37)  ";
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
    public function Consulta_Local_menu($admin)
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
    public function Consulta_Subs_menu($admin)
    {
        include_once("php/conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "	SELECT * FROM SubAdmin WHERE estatus = 'A' AND  nombre_corto is not null and id_admin = $admin ORDER BY nombre_sub_admin ASC";
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
    public function Consulta_deps_menu($admin)
    {
        include_once("php/conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "SELECT 
        id_depto,
        nombre_depto,
        dep.nombre_corto,
        sub.nombre_sub_admin
        FROM Departamento  dep
        INNER JOIN SubAdmin sub ON dep.id_sub_admin = sub.id_sub_admin
        WHERE dep.estatus = 'A' 
        AND  dep.nombre_corto is not null 
        AND dep.id_admin = $admin 
        ORDER BY dep.id_sub_admin ASC";
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
    public function Consulta_deps_menu_x_sub($admin,$sub)
    {
        include_once("php/conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "SELECT 
        id_depto,
        nombre_depto,
        dep.nombre_corto,
        sub.nombre_sub_admin
        FROM Departamento  dep
        INNER JOIN SubAdmin sub ON dep.id_sub_admin = sub.id_sub_admin
        WHERE dep.estatus = 'A' 
        AND  dep.nombre_corto is not null 
        AND dep.id_admin = $admin 
        AND dep.id_sub_admin = $sub 
        ORDER BY dep.id_sub_admin ASC,dep.nombre_depto DESC ";
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
    public function Actualiza_Oficio($id_oficio,$fecha_oficio){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $user_alta = $_SESSION['ses_rfc_corto_ing'];

        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $query="  UPDATE [Oficios_historial]
        SET [fecha_oficio_firmada] = '$fecha_oficio'
        ,[user_mod]= '$user_alta'
        ,[fecha_mod] = GETDATE()
        ,[id_proc] = 31
        WHERE id_oficio_gen = $id_oficio ";
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
                if ($dep == 0) {
                    $condicion = " AND emp.id_sub_admin = $sub" ;
                }
                else {
                    $condicion = " AND emp.id_sub_admin = $sub AND emp.id_depto = $dep ";
                }
            break;
            case isset($_GET['Nombre']):
                $nom = $_COOKIE["nombre"];
                $condicion = "AND  (emp.nombre_s LIKE '%$nom%' OR  emp.apellido_p LIKE '%$nom%' OR  emp.apellido_m LIKE '%$nom%')";
            break;
            case isset($_GET['no_empleado']):
                $no = $_COOKIE["no_empleado_cokie"];
                $condicion = "AND emp.no_empleado = $no";
            break;
            case isset($_GET['RFC']):
                $RFC = $_COOKIE["rfc_corto_cokie"];
                $condicion = " AND emp.rfc_corto = '$RFC' ";
            break;
            case isset($_GET['Puestos']):
                $puest = $_COOKIE["puest_adr"];
                $condicion = " AND puest_adr.id_puesto = $puest ";
            break;
            case isset($_GET['Stock']):
                $Stock = $_COOKIE["extra_option"];
                switch ($Stock) {
                case 1:
                    $condicion = "";
                break;
                case 2:
                    $condicion = " AND emp.id_nivel_jer = 6 AND emp.id_sindicato = 2";
                break;
                case 3:
                    $condicion = " AND emp.id_nivel_jer = 6 AND emp.id_sindicato = 1";

                break;
                case 4:
                    $condicion = " AND emp.id_nivel_jer = 6";
                break;
                case 5:
                    $condicion = " AND emp.id_nivel_jer = 1 OR emp.id_nivel_jer = 2 OR emp.id_nivel_jer = 3 OR emp.id_nivel_jer = 4 OR emp.id_nivel_jer = 5";

                break;
                default:
                $condicion = "";
                break;
                }
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
      WHERE emp.estatus = 'A' and (emp.id_proc = 9 or emp.id_proc = 12 ) $condicion";
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
    public function universo_sistemas_activos()
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        // switch ($_GET) {
        //     case isset($_GET['pagina']):
        //             $condicion = "";
        //     break;
        //     case isset($_GET['Estructura']):
        //         $sub = $_COOKIE["sub"];
        //         $dep = $_COOKIE["dep"];
        //         if ($dep == 0) {
        //             $condicion = " AND emp.id_sub_admin = $sub" ;
        //         }
        //         else {
        //             $condicion = " AND emp.id_sub_admin = $sub AND emp.id_depto = $dep ";
        //         }
        //     break;
        //     case isset($_GET['Nombre']):
        //         $nom = $_COOKIE["nombre"];
        //         $condicion = "AND  (emp.nombre_s LIKE '%$nom%' OR  emp.apellido_p LIKE '%$nom%' OR  emp.apellido_m LIKE '%$nom%')";
        //     break;
        //     case isset($_GET['no_empleado']):
        //         $no = $_COOKIE["no_empleado_cokie"];
        //         $condicion = "AND emp.no_empleado = $no";
        //     break;
        //     case isset($_GET['RFC']):
        //         $RFC = $_COOKIE["rfc_corto_cokie"];
        //         $condicion = " AND emp.rfc_corto = '$RFC' ";
        //     break;
        //     case isset($_GET['Puestos']):
        //         $puest = $_COOKIE["puest_adr"];
        //         $condicion = " AND puest_adr.id_puesto = $puest ";
        //     break;
        //     case isset($_GET['Stock']):
        //         $Stock = $_COOKIE["extra_option"];
        //         switch ($Stock) {
        //         case 1:
        //             $condicion = "";
        //         break;
        //         case 2:
        //             $condicion = " AND emp.id_nivel_jer = 6 AND emp.id_sindicato = 2";
        //         break;
        //         case 3:
        //             $condicion = " AND emp.id_nivel_jer = 6 AND emp.id_sindicato = 1";

        //         break;
        //         case 4:
        //             $condicion = " AND emp.id_nivel_jer = 6";
        //         break;
        //         case 5:
        //             $condicion = " AND emp.id_nivel_jer = 1 OR emp.id_nivel_jer = 2 OR emp.id_nivel_jer = 3 OR emp.id_nivel_jer = 4 OR emp.id_nivel_jer = 5";

        //         break;
        //         default:
        //         $condicion = "";
        //         break;
        //         }
        //     break;
        //     default:
        //     $condicion = "";
        //     break;
        //   }
        $query = " SELECT count(*) TOTAL
        FROM [Systems]";
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
                if ($dep == 0) {
                    $condicion = " AND subc.id_sub_admin = $sub" ;
                }
                else {
                    $condicion = " AND subc.id_sub_admin = $sub AND subc.id_depto = $dep ";
                }
               
            break;
            case isset($_GET['Nombre']):
            $nom = $_COOKIE["nombre"];
            $condicion = "AND subc.nombre_empleado LIKE '%$nom%'";
            break;
            case isset($_GET['no_empleado']):
                $no = $_COOKIE["no_empleado_cokie"];
                $condicion = "AND subc.no_empleado = $no";
                break;
            case isset($_GET['RFC']):
                $rfc = $_COOKIE["rfc_corto_cokie"];
                $condicion = " AND subc.rfc_corto = '$rfc' ";
            break;
            case isset($_GET['Puestos']):
                $puest = $_COOKIE["puest_adr"];
                $condicion = " AND subc.id_puesto = $puest ";
            break;
            case isset($_GET['Stock']):
                $opcion = $_COOKIE["extra_option"];
                switch ($opcion) {
                case 1://Cumpleaños del mes
                $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                case 2://Personal de Base con seccion V
                $condicion = "AND  subc.id_nivel_jer = 6 AND subc.id_sindicato = 2";
                break;
                case 3://Personal de Base con seccion XVI
                    $condicion = "AND  subc.id_nivel_jer = 6 AND subc.id_sindicato = 1";
                break;
                case 4://Personal de Base UNIFICADOS
                $condicion = "AND  subc.id_nivel_jer = 6";
                break;
                case 5://Personal de Confianza
                $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                default:
                $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                }
   
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
		,subc.Fecha_nacimiento
		,subc.years_nacimiento
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
         ,subc.id_sindicato
         ,subc.id_nivel_jer
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
         ,floor(cast(datediff(day,cast (SUBSTRING(RFC, 5, 6) as date), getdate()) as float)/365) AS years_nacimiento
		 ,cast (SUBSTRING(RFC, 5, 6) as date) as Fecha_nacimiento
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
         ,emp.[id_sindicato]
         ,procs.nombre_proc
         ,emp.id_nivel_jer
         ,emp.[fec_ingreso]
          FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
         INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
       INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
       INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
       INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
       INNER JOIN Procesos procs ON emp.id_proc = procs.id_proc
       INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
       INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
        WHERE emp.estatus = 'A' and (emp.id_proc = 9 or emp.id_proc = 12) ) subc
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
    public function Consulta_sistemas_activos($num)
    {
        include_once "conexion.php";
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        // switch ($_GET) {
        //     case isset($_GET['pagina']):
        //             $condicion = "";
        //     break;
        //     case isset($_GET['Estructura']):
        //         $sub = $_COOKIE["sub"];
        //         $dep = $_COOKIE["dep"];
        //         if ($dep == 0) {
        //             $condicion = " AND subc.id_sub_admin = $sub" ;
        //         }
        //         else {
        //             $condicion = " AND subc.id_sub_admin = $sub AND subc.id_depto = $dep ";
        //         }
               
        //     break;
        //     case isset($_GET['Nombre']):
        //     $nom = $_COOKIE["nombre"];
        //     $condicion = "AND subc.nombre_empleado LIKE '%$nom%'";
        //     break;
        //     case isset($_GET['no_empleado']):
        //         $no = $_COOKIE["no_empleado_cokie"];
        //         $condicion = "AND subc.no_empleado = $no";
        //         break;
        //     case isset($_GET['RFC']):
        //         $rfc = $_COOKIE["rfc_corto_cokie"];
        //         $condicion = " AND subc.rfc_corto = '$rfc' ";
        //     break;
        //     case isset($_GET['Puestos']):
        //         $puest = $_COOKIE["puest_adr"];
        //         $condicion = " AND subc.id_puesto = $puest ";
        //     break;
        //     case isset($_GET['Stock']):
        //         $opcion = $_COOKIE["extra_option"];
        //         switch ($opcion) {
        //         case 1://Cumpleaños del mes
        //         $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
        //         break;
        //         case 2://Personal de Base con seccion V
        //         $condicion = "AND  subc.id_nivel_jer = 6 AND subc.id_sindicato = 2";
        //         break;
        //         case 3://Personal de Base con seccion XVI
        //             $condicion = "AND  subc.id_nivel_jer = 6 AND subc.id_sindicato = 1";
        //         break;
        //         case 4://Personal de Base UNIFICADOS
        //         $condicion = "AND  subc.id_nivel_jer = 6";
        //         break;
        //         case 5://Personal de Confianza
        //         $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
        //         break;
        //         default:
        //         $condicion = "AND MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
        //         break;
        //         }
   
        //     break;
        
        //     default:
        //         $condicion = "";
        //      break;
        //   }
        $query = " SELECT
        subc.seq
        ,subc.[id_system]
        ,subc.[nombre_sistema]
        ,subc.[url/acceso]
        ,subc.[Administraciion_sistema]
        ,subc.[Descripcion_sistema]
        ,subc.[Num_cuentas_Siistema]
        ,subc.funcion
		,subc.total_acces
		,subc.roles_totales
        from(
        SELECT  
               ROW_NUMBER() OVER(ORDER BY [Administraciion_sistema] asc) AS seq
              ,sis.[id_system]
              ,sis.[nombre_sistema]
              ,sis.[url/acceso]
              ,sis.[Administraciion_sistema]
              ,sis.[Descripcion_sistema]
              ,sis.[Num_cuentas_Siistema]
              ,sis.[Aprobador_Sistemas]
              ,sis.funcion
              ,sis.[estatus]
              ,sis.[user_alta]
              ,sis.[fecha_alta]
              ,sis.[user_mod]
              ,sis.[fecha_mod]
			  ,(select COUNT(*) total from Regstro_accesos where id_system = sis.id_system ) total_acces
			  ,(select COUNT(*) total from [Roles_sistemas] where [id_sistema] = sis.id_system ) roles_totales
          FROM [Systems] sis 
		  full JOIN Regstro_accesos reg_ac ON reg_ac.id_system = sis.id_system 
		  ) subc
        WHERE seq >= $num";
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
    public function consulta_info_sistema($id_app){
     
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT
         subc.seq
        ,subc.[id_system]
        ,subc.[nombre_sistema]
        ,subc.[url/acceso]
        ,subc.[Administraciion_sistema]
        ,subc.[Descripcion_sistema]
        ,subc.[Num_cuentas_Siistema]
        ,subc.funcion
        from(
        SELECT  
        ROW_NUMBER() OVER(ORDER BY [Administraciion_sistema] asc) AS seq
        ,[id_system]
        ,[nombre_sistema]
        ,[url/acceso]
        ,[Administraciion_sistema]
        ,[Descripcion_sistema]
        ,[Num_cuentas_Siistema]
        ,[Aprobador_Sistemas]
        ,funcion
        ,[estatus]
        ,[user_alta]
        ,[fecha_alta]
        ,[user_mod]
        ,[fecha_mod]
        FROM [Systems] ) subc
        WHERE subc.id_system = $id_app";
            $prepare = sqlsrv_query($con, $query);
            if ($prepare) {
                while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                    $filas = $rows;
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
       WHERE emp.estatus = 'A' and (emp.id_proc = 7 or emp.id_proc = 6 or emp.id_proc = 11 or emp.id_proc = 25 or emp.id_proc = 28 or emp.id_proc = 32) ORDER BY sub.nombre_sub_admin asc,dep.nombre_depto desc";
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
        $filtro1 = self::Consulta_usu_exist_x_id($datos->id_emp);
 
        $rfc= $filtro1['rfc_corto'];
        $no_emppleado = $filtro1['no_empleado'];
        if ($rfc == $datos->rfc_c) {
            //return "el rfc es igual al que esta registrado para este usuario";
            if ($no_emppleado == $datos->no_empleado) {
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
                    user_mod = '".$user_ej."',
                    id_motivo_esp = CASE '".$datos->Motivo_especial_por_est."' WHEN '' THEN NULL  WHEN '0' THEN NULL ELSE ".$datos->Motivo_especial_por_est." END
                    WHERE id_empleado_plant = ".$datos->id_emp."        
                    ";
                $prepare = sqlsrv_query($con, $query);
                if ($prepare == false) {
                    return print_r(sqlsrv_errors(), false);
                    $conexion->CerrarConexion($con);
                } else {
                    return $proceso =self::Registra_historial($datos);
                    // $conexion->CerrarConexion($con);
                        
                         //return $datos_res;
                }
            } else {
                if ($filtro3 = self::Consulta_usu_exist($datos->no_empleado)) {
                    return "el numero de empleado no existe en el sistema (".$datos->no_empleado.")";
                } else {
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
                    user_mod = '".$user_ej."',
                    id_motivo_esp = CASE '".$datos->Motivo_especial_por_est."' WHEN '' THEN NULL  WHEN '0' THEN NULL ELSE ".$datos->Motivo_especial_por_est." END
                    WHERE id_empleado_plant = ".$datos->id_emp."        
                    ";
                    $prepare = sqlsrv_query($con, $query);
                    if ($prepare == false) {
                        return print_r(sqlsrv_errors(), false);
                        $conexion->CerrarConexion($con);
                    } else {
                        return $proceso =self::Registra_historial($datos);
                        // $conexion->CerrarConexion($con);
                        
                         //return $datos_res;
                    }
                }
            }
        } else {
            if ($filtro2 = self::Consulta_rfc_Exist($datos->rfc_c)) {
                $rfc1 = $filtro2['rfc_corto'];
                //     $no_emppleado1 = $filtro2['no_empleado'];
                if ($rfc1 == $datos->rfc_c) {
                    return "el RFC corto ya existe en el sistema (".$datos->rfc_c.")";
                //         echo "El número de empleado ya esta registrado en el sistema";
                } else {
                    //return "el rfc no existe en el sistema (".$datos->rfc_c.")";
                                 
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
                       user_mod = '".$user_ej."',
                       id_motivo_esp = CASE '".$datos->Motivo_especial_por_est."' WHEN '' THEN NULL  WHEN '0' THEN NULL ELSE ".$datos->Motivo_especial_por_est." END
                       WHERE id_empleado_plant = ".$datos->id_emp."
                       ";
                    $prepare = sqlsrv_query($con, $query);
                    if ($prepare == false) {
                        return print_r(sqlsrv_errors(), false);
                        $conexion->CerrarConexion($con);
                    } else {
                        return $proceso =self::Registra_historial($datos);
                        // $conexion->CerrarConexion($con);
                   
                            //return $datos_res;
                    }
                }
            }
        }
    }

           
 

  
    public  function Registra_historial_cambios_deps($datos,$proc){
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
        $fecha_mov_func = $datos->fecha_mov_funcional;
        
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
                ,[fecha_mov_funcional]
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
                ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo
                ,'$fecha_mov_func' as fecha_mov_funcional";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
            return "Se actualizo el area asignada del empleado satisfactoriamente." ;
        }
        else {
            return print_r(sqlsrv_errors(),false);
            
        }

    }
    public function Genera_oficio_historial($datos){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_alta = $_SESSION['ses_rfc_corto_ing'];
        $oficio = self::Dame_el_numero_de_oficio($datos->num_oficio);
        $query= "INSERT INTO [Oficios_historial](
            [id_mov_personal]
           ,[id_empleado_plant]
           ,[Tipo_oficio]
           ,[id_oficio_det]
           ,[id_num_oficio]
           ,[fecha_oficio_generado]
           ,[id_proc]
           ,[user_alta]
           ,[fecha_alta]
       )
       values(
         (select top 1 id_mov_insumo from mov_insumo where id_empleado_plant = $datos->id_empleado and id_proc = 2 )
         ,$datos->id_empleado
         ,1
         ,1
         ,'".$oficio['determinante']."'
         ,'$datos->fecha_oficio'
         ,30
         ,'$user_alta'
         ,GETDATE()
       )
        ";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
         return "Se registro el oficio, ya lo puedes visualizar en documentos Firmados o por Firmar." ;

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
        $motivo_esp = $datos->Motivo_especial_por_est;
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


// echo json_encode($DATOS_muestra);
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
                ,Motivo_Especial
                ,fecha_mov_funcional
            )
                 SELECT 
                 $id_user_insumo AS [id_empleado_plant]
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
                ,(SELECT nombre_escolaridad from cat_escolaridad where id_escolaridad = '$Escolaridad') AS [Escolaridad]
                ,(SELECT nombre_estatus_escolaridad from cat_estatus_escolar where id_estatus_escolaridad ='$est_escolar') AS [estatus_escolaridad]
                ,(Case '$estado_civil' when '' then NULL ELSE (SELECT nombre_estado_civil from cat_estado_civil where id_estado_civil = '$estado_civil') end) AS [estado_civil]
                ,(Case '$carrera' when '' then NULL ELSE '$carrera' end ) AS [Carrera]
                ,(SELECT nombre_nombramiento from cat_nombramiento where id_tipo_nombramiento ='$tipo_nom1' ) AS [tipo_nombramiento]
                ,(SELECT nombre_sindical from cat_sindical where id_sindicato =$sindicatos) AS [sindicato]
                ,(SELECT nombre_nombramiento from cat_nivel_jerarquico where id_nivel_jer = $nivel_jer ) AS [nivel_jer]
                ,(CASE '$sal_net' WHEN '' THEN NULL ELSE '$sal_net' END) AS salario_neto
                ,(case'$jefe_directo' when '' then NULL ELSE  (select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) end) AS jefe_directo
                ,(Case '$motivo_esp' when '' then NULL else (SELECT Motivo_especial from Motivos_especiales where id_motivo_esp =$motivo_esp) end) AS  [Motivo_Especial]
                ,GETDATE() AS fecha_mov_funcional
                ";
        $prepare = sqlsrv_query($con,$query);
        if($prepare){
           
            if ($proceso == 11 || $proceso == 32 && $motivo_esp == 6 || $proceso == 32 && $motivo_esp == 5 ) {
               $accion =  self::registra_baja_plaza($proceso,$num_plaza,$sal_net,$id_user_insumo,$motivo_esp);
               return $accion;
            }
            else {
                return "Se actualizaron los datos basicos del empleado satisfactoriamente." ;
            }
        }
        else {
            return print_r(sqlsrv_errors(),false);
            
        }
    }
    public function registra_baja_plaza($proceso,$num_plaza,$sal_net,$id_user_insumo,$motivo_esp){
        include_once 'sesion.php';
        include_once 'conexion.php';
        $BD = new ConexionSQL();
        $con = $BD->ObtenerConexionBD();
        $user_ej = $_SESSION['ses_rfc_corto_ing'];
        if ($proceso == 32 && $motivo_esp == 6 || $proceso == 11 ) {
            $complemento = "UPDATE Posisiones SET id_empleado = null WHERE id_empleado = $id_user_insumo";
        } else {
            $complemento = "UPDATE Posisiones SET id_proc = $proceso WHERE id_empleado = $id_user_insumo";
        }
        
        $query = "INSERT INTO [mov_Posisiones](
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
                (select id_posision from Posisiones where id_num_posision ='$num_plaza')  AS [id_posision]
                ,(SELECT CONCAT(nombre_s,' ',apellido_p,' ',apellido_m) as nombre_empleado FROM Empleado_insumo WHERE id_empleado_plant = $id_user_insumo) AS [nombre_empleado]
                ,(SELECT nombre_puesto FROM Puesto_FUMP where id_puesto_fump=(SELECT [id_puesto_fump] FROM Posisiones Where  id_num_posision = '$num_plaza' ))  AS [puesto_fump]
                ,$num_plaza AS [id_num_posision]
                ,(SELECT [posision_jefe] FROM Posisiones Where  id_num_posision = '$num_plaza' ) AS [posision_jefe]
                ,(SELECT [nivel] FROM Posisiones Where  id_num_posision = '$num_plaza' ) AS [nivel]
                ,(SELECT [Codigo_pres] FROM Posisiones Where  id_num_posision = '$num_plaza' ) AS [Codigo_pres]
                ,CASE '$sal_net' WHEN '' THEN NULL else '$sal_net'END AS [sueldo_neto]
                ,28 AS [id_proc]
                ,'$user_ej' AS [user_alta]
                ,GETDATE() AS [fecha_alta]
                ,'A' AS [estatus]

                $complemento
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
                ,fecha_mov_funcional
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
                ,(select concat(nombre_s,' ',apellido_p,' ',apellido_m ) from Empleado_insumo where id_empleado_plant= $jefe_directo) as jefe_directo
                ,GETDATE() AS fecha_mov_funcional
                ";
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
        ,fecha_mov_funcional
    )
            SELECT 
            $id_user_insumo AS [id_empleado_plant]
        ,$No_Empleado AS [no_empleado]
        ,(SELECT nombre_admin FROM Administracion WHERE id_admin = $admin) AS [admin]
        ,(SELECT nombre_sub_admin FROM SubAdmin WHERE id_sub_admin = $sub) AS [sub_admin]
        ,(SELECT nombre_depto FROM Departamento WHERE id_depto = $dep) AS [depto]
        ,(select id_num_posision from Posisiones where id_posision =$num_plaza) as [id_num_posision]
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
        ,GETDATE AS fecha_mov_funcional
    
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
    public function  Enviar_correo($correo,$asunto,$mens){

        $headers = 'From: ' .$correo . "\r\n". 
        'Reply-To: ' . $correo. "\r\n" . 
        'X-Mailer: PHP/' . phpversion();
      
      mail($correo, $asunto, $mens, $headers);
    }

    public function Reporte_Plantilla_filtrada()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        switch ($_GET) {
            case isset($_GET['pagina']):
                    $condicion = "";
            break;
            case isset($_GET['Estructura']):
                $sub = $_COOKIE["sub"];
                $dep = $_COOKIE["dep"];
                if ($dep == 0) {
                    $condicion = " WHERE subc.id_sub_admin = $sub" ;
                }
                else {
                    $condicion = " WHERE subc.id_sub_admin = $sub AND subc.id_depto = $dep ";
                }
               
            break;
            case isset($_GET['Nombre']):
            $nom = $_COOKIE["nombre"];
            $condicion = "WHERE subc.nombre_empleado LIKE '%$nom%'";
            break;
            case isset($_GET['no_empleado']):
                $no = $_COOKIE["no_empleado_cokie"];
                $condicion = "WHERE subc.no_empleado = $no";
                break;
            case isset($_GET['RFC']):
                $rfc = $_COOKIE["rfc_corto_cokie"];
                $condicion = " WHERE subc.rfc_corto = '$rfc' ";
            break;
            case isset($_GET['Puestos']):
                $puest = $_COOKIE["puest_adr"];
                $condicion = " WHERE subc.id_puesto = $puest ";
            break;
            case isset($_GET['Stock']):
                $opcion = $_COOKIE["extra_option"];
                switch ($opcion) {
                case 1://Cumpleaños del mes
                $condicion = "WHERE MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                case 2://Personal de Base con seccion V
                $condicion = "WHERE  subc.id_nivel_jer = 6 AND subc.id_sindicato = 2";
                break;
                case 3://Personal de Base con seccion XVI
                    $condicion = "WHERE  subc.id_nivel_jer = 6 AND subc.id_sindicato = 1";
                break;
                case 4://Personal de Base UNIFICADOS
                $condicion = "WHERE  subc.id_nivel_jer = 6";
                break;
                case 5://Personal de Confianza
                $condicion = "WHERE MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                default:
                $condicion = "WHERE MONTH(Fecha_nacimiento) = MONTH(GETDATE()) ORDER BY DAY(Fecha_nacimiento) ASC ";
                break;
                }
   
            break;
        
            default:
                $condicion = "";
             break;
          }
        $query = "		SELECT 
        subc.[id_empleado_plant]
       ,subc.[no_empleado]
       ,subc.nombre_admin
       ,subc.nombre_sub_admin
       ,subc.nombre_depto
       ,subc.[jefe_directo]
       ,subc.id_num_posision
	   ,subc.nivel
	   ,subc.nombre_empleado
       ,subc.sueldo_neto
       ,subc.Codigo_pres
	   ,subc.clave_puesto
       ,subc.posision_jefe
       ,subc.[tipo_nombramiento]
       ,subc.nombre_puesto
	   ,subc.nombre_puesto_fun
       ,subc.rfc_comp
       ,subc.curp_comp
       ,subc.[rfc_corto]
       ,subc.[nombre_s]
       ,subc.[apellido_p]
       ,[apellido_m]
       ,subc.[correo_inst]
       ,subc.[correo_personal]
       ,subc.[numero_contacto_1]
       ,subc.[numero_contacto_2]
       ,subc.[ext_tel]
       ,subc.nombre_sindical
       ,subc.tipo_nombramiento
       ,subc.[Genero]
       ,subc.[Hijos]
	   ,subc.nombre_estado_civil
       ,subc.nombre_escolaridad
	   ,subc.nombre_estatus_escolaridad
       ,subc.nombre_honor
       ,subc.nombre_proc
       ,subc.Motivo_especial
       ,subc.[fec_ingreso]
       ,subc.fec_fin_rel_laboral
       ,subc.id_sub_admin
       ,subc.id_admin
       ,subc.id_depto
       ,subc.id_puesto
       ,subc.id_sindicato
       ,subc.id_nivel_jer
       ,CONCAT( subc.years,' años, ',subc.meses,' meses y ',subc.dias,' dias' ) as Antiguedad
       ,subc.years_nacimiento
       ,subc.Fecha_nacimiento
       ,subc.nivel_jerarq_nom
       ,subc.carrera
	FROM (select
	   emp.[id_empleado_plant]
       ,emp.[no_empleado]
       ,ad.nombre_admin
       ,ad.id_admin
       ,sub.nombre_sub_admin
       ,sub.id_sub_admin
       ,dep.nombre_depto
       ,dep.id_depto
       ,(select concat (nombre_s,' ',apellido_p,' ',apellido_m)FROM Empleado_insumo where id_empleado_plant =  emp.[jefe_directo]) as jefe_directo
       ,pos.id_num_posision
       ,pos.posision_jefe
       ,pos.nivel
       ,pos.sueldo_neto
       ,pos.Codigo_pres
       ,cat_nom.nombre_nombramiento as [tipo_nombramiento]
       ,puest_adr.nombre_puesto
       ,puest_adr.id_puesto
       ,emp.[RFC] as rfc_comp
       ,emp.[CURP] as curp_comp
       ,emp.[rfc_corto]
	   ,CONCAT([nombre_s],' ',[apellido_p],' ',[apellido_m]) as nombre_empleado
       ,[nombre_s]
       ,[apellido_p]
       ,[apellido_m]
        ,floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365) AS years
        ,floor((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12) AS meses
        ,floor((((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12)-floor((cast(datediff(day, fec_ingreso, getdate()) as float)/365-(floor(cast(datediff(day, fec_ingreso, getdate()) as float)/365)))*12))*(365/12)) AS dias
        ,floor(cast(datediff(day,cast (SUBSTRING(RFC, 5, 6) as date), getdate()) as float)/365) AS years_nacimiento
        ,cast (SUBSTRING(RFC, 5, 6) as date) as Fecha_nacimiento
       ,emp.[correo_inst]
       ,emp.[correo_personal]
       ,emp.[numero_contacto_1]
       ,emp.[numero_contacto_2]
       ,emp.[ext_tel]
       ,cat_SIND.nombre_sindical
       ,cat_SIND.id_sindicato
       ,cat_nivel.nombre_nombramiento AS nivel_jerarq_nom
       ,cat_nivel.id_nivel_jer
       ,emp.[Genero]
       ,emp.[Hijos]
       ,emp.[fecha_alta]
       ,emp.[user_mod]
       ,emp.[fecha_mod]
       ,emp.[user_baja]
       ,emp.[fecha_baja]
       ,emp.[carrera]
       ,procc.nombre_proc
       ,mot.Motivo_especial
       ,emp.[fec_ingreso]
       ,emp.fec_fin_rel_laboral
       ,puest_fun.nombre_puesto as nombre_puesto_fun
       ,puest_fun.clave_puesto
	   ,cat_est_civ.nombre_estado_civil
       ,cat_esc.nombre_escolaridad
	   ,cat_est_esc.nombre_estatus_escolaridad
       ,cat_esc.nombre_honor
        FROM [Control_Ingresos].[dbo].[Empleado_insumo] emp
       INNER JOIN Administracion ad ON emp.id_admin = ad.id_admin
       INNER JOIN cat_escolaridad cat_esc ON emp.Escolaridad = cat_esc.id_escolaridad
        INNER JOIN SubAdmin sub ON emp.id_sub_admin = sub.id_sub_admin
        INNER JOIN Departamento dep ON emp.id_depto = dep.id_depto
        INNER JOIN Posisiones pos ON emp.id_posision = pos.id_posision
        INNER JOIN Puesto_ADR puest_adr ON puest_adr.id_puesto = emp.id_puesto
        INNER JOIN Puesto_FUMP puest_fun ON puest_fun.id_puesto_fump = pos.id_puesto_fump
        INNER JOIN cat_nombramiento cat_nom ON cat_nom.id_tipo_nombramiento = emp.tipo_nombramiento
        INNER JOIN cat_sindical cat_SIND ON cat_SIND.id_sindicato = emp.id_sindicato
        INNER JOIN cat_nivel_jerarquico cat_nivel ON cat_nivel.id_nivel_jer = emp.id_nivel_jer
        INNER JOIN cat_estatus_escolar cat_est_esc ON cat_est_esc.id_estatus_escolaridad = emp.estatus_escolaridad
        full JOIN cat_estado_civil cat_est_civ ON cat_est_civ.id_estado_civil = emp.estado_civil
        INNER JOIN Procesos procc ON procc.id_proc = emp.id_proc
        left JOIN Motivos_especiales mot ON mot.id_motivo_esp = emp.id_motivo_esp 
        WHERE emp.id_proc=9 or emp.id_proc=12 ) subc
        $condicion";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }

    public function Crear_Excel_Reporte_filtro($reporte,$nombre_reporte)
    {
        include_once 'Classes/PHPExcel.php';
        include_once 'Classes/PHPExcel/Writer/Excel2007.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator('Andres Mares Sanchez') // Nombre del autor
            ->setLastModifiedBy('Andres Mares Sanchez') //Ultimo usuario que lo modific�
            ->setTitle($nombre_reporte) // Titulo
            ->setSubject('Reporte Excel con PHP y SQL SERVER') //Asunto
            ->setDescription($nombre_reporte); //Descripci�n

        $encabezados = [
            'Estado_Operativo_Actual',
            'No. Empleado',
            'RFC',
            'CURP',
            'RFC corto',
            'Nombre',
            'Apellido P',
            'Apellido M',
            'Nombre Completo',
            'Edad',
            'Fecha_nacimiento',
            'Correo',
            'Ext',
            'Nivel Jerarquico',
            'Nombramiento_Actual',
            'Sindicato_Actual',
            'Sexo',
            'Hijos',
            'Estado civil',
            'Escolaridad',
            'Estatus de estudios',
            'Carrera',
            'Fecha_ingreso',
            'Antiguedad',
            'Administración_Actual',
            'Subadministración_Actual',
            'Departamento_Actual',
            'Jefe_directo_Actual',
            'Puesto_Actual',
            'Posicion_asginada',
            'Nivel',
            'Clave Presupuestal',
            'Puesto_FUMP_Actual',
            'Clave Puesto',
            'Sueldo Puesto',
            'Posicion_Gerente',


           
    
  

        ];
        // se definen los estilos de las celdas
        $estilo_titulos = [
            'font' => [
                'name' => 'Montserrat',
                'bold' => true,
                'size' => 12,
                'italic' => true,
            /*'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE,*/
                'strike' => false, /* hace un efecto fixed en excel*/
                'color' => [
                    'rgb' => 'ffffff',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => [
                        'rgb' => 'ffffff',
                    ],
                ],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'a12142'],
            ],
        ];
        $estilos_registros = [
            'font' => [
                'name' => 'Montserrat',
                'bold' => false,
                'size' => 9,
                'italic' => false,
            /*'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE,*/
                'strike' => false, /* hace un efecto fixed en excel*/
                'color' => [
                    'rgb' => '000109',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => [
                        'rgb' => '808080',
                    ],
                ],
            ],
        ];

        //se terminan de definir los estilos

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $encabezados[0])
            ->setCellValue('B1', $encabezados[1])
            ->setCellValue('C1', $encabezados[2])
            ->setCellValue('D1', $encabezados[3])
            ->setCellValue('E1', $encabezados[4])
            ->setCellValue('F1', $encabezados[5])
            ->setCellValue('G1', $encabezados[6])
            ->setCellValue('H1', $encabezados[7])
            ->setCellValue('I1', $encabezados[8])
            ->setCellValue('J1', $encabezados[9])
            ->setCellValue('K1', $encabezados[10])
            ->setCellValue('L1', $encabezados[11])
            ->setCellValue('M1', $encabezados[12])
            ->setCellValue('N1', $encabezados[13])
            ->setCellValue('O1', $encabezados[14])
            ->setCellValue('P1', $encabezados[15])
            ->setCellValue('Q1', $encabezados[16])
            ->setCellValue('R1', $encabezados[17])
            ->setCellValue('S1', $encabezados[18])
            ->setCellValue('T1', $encabezados[19])
            ->setCellValue('U1', $encabezados[20])
            ->setCellValue('V1', $encabezados[21])
            ->setCellValue('W1', $encabezados[22])
            ->setCellValue('X1', $encabezados[23])
            ->setCellValue('Y1', $encabezados[24])
            ->setCellValue('Z1', $encabezados[25])
            ->setCellValue('AA1', $encabezados[26])
            ->setCellValue('AB1', $encabezados[27])
            ->setCellValue('AC1', $encabezados[28])
            ->setCellValue('AD1', $encabezados[29])
            ->setCellValue('AE1', $encabezados[30])
            ->setCellValue('AF1', $encabezados[31])
            ->setCellValue('AG1', $encabezados[32])
            ->setCellValue('AH1', $encabezados[33])
            ->setCellValue('AI1', $encabezados[34])
            ->setCellValue('AJ1', $encabezados[35])
            ;
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:AJ1')->applyFromArray($estilo_titulos);
        if ($reporte != null) {
            $h = 2;
            for ($i = 0; $i < count($reporte); ++$i) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$h, $reporte[$i]['nombre_proc'])
                    ->setCellValue('B'.$h, $reporte[$i]['no_empleado'])
                    ->setCellValue('C'.$h, $reporte[$i]['rfc_comp'])
                    ->setCellValue('D'.$h, $reporte[$i]['curp_comp'])
                    ->setCellValue('E'.$h, $reporte[$i]['rfc_corto'])
                    ->setCellValue('F'.$h, $reporte[$i]['nombre_s'])
                    ->setCellValue('G'.$h, $reporte[$i]['apellido_p'])
                    ->setCellValue('H'.$h, $reporte[$i]['apellido_m'])
                    ->setCellValue('I'.$h, $reporte[$i]['nombre_empleado'])
                    ->setCellValue('J'.$h, $reporte[$i]['years_nacimiento'])
                    ->setCellValue('K'.$h, $reporte[$i]['Fecha_nacimiento']->format('d-m-Y'))
                    ->setCellValue('L'.$h, $reporte[$i]['correo_inst'])
                    ->setCellValue('M'.$h, $reporte[$i]['ext_tel'])
                    ->setCellValue('N'.$h, $reporte[$i]['nivel_jerarq_nom'])
                    ->setCellValue('O'.$h, $reporte[$i]['tipo_nombramiento'])
                    ->setCellValue('P'.$h, $reporte[$i]['nombre_sindical'])
                    ->setCellValue('Q'.$h, $reporte[$i]['Genero'])
                    ->setCellValue('R'.$h, $reporte[$i]['Hijos'])
                    ->setCellValue('S'.$h, $reporte[$i]['nombre_estado_civil'])
                    ->setCellValue('T'.$h, $reporte[$i]['nombre_escolaridad'])
                    ->setCellValue('U'.$h, $reporte[$i]['nombre_estatus_escolaridad'])
                    ->setCellValue('V'.$h, $reporte[$i]['carrera'])
                    ->setCellValue('W'.$h, $reporte[$i]['fec_ingreso']->format('d-m-Y'))
                    ->setCellValue('X'.$h, $reporte[$i]['Antiguedad'])
                    ->setCellValue('Y'.$h, $reporte[$i]['nombre_admin'])
                    ->setCellValue('Z'.$h, $reporte[$i]['nombre_sub_admin'])
                    ->setCellValue('AA'.$h, $reporte[$i]['nombre_depto'])
                    ->setCellValue('AB'.$h, $reporte[$i]['jefe_directo'])
                    ->setCellValue('AC'.$h, $reporte[$i]['nombre_puesto'])
                    ->setCellValue('AD'.$h, $reporte[$i]['id_num_posision'])
                    ->setCellValue('AE'.$h, $reporte[$i]['nivel'])
                    ->setCellValue('AF'.$h, $reporte[$i]['Codigo_pres'])
                    ->setCellValue('AG'.$h, $reporte[$i]['nombre_puesto_fun'])
                    ->setCellValue('AH'.$h, $reporte[$i]['clave_puesto'])
                    ->setCellValue('AI'.$h, $reporte[$i]['sueldo_neto'])
                    ->setCellValue('AJ'.$h, $reporte[$i]['posision_jefe'])
                    ;

                $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$h.':AJ'.$h)->applyFromArray($estilos_registros);
                ++$h;
            }
            $objPHPExcel->setActiveSheetIndex(0);

            foreach (range('A', 'AJ') as $columnID) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=" '.$nombre_reporte.'.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        } else {
            echo"No hay datos que se detecten de la consulta por eso no se ha generado el documento";
        }
    }
    public function Catalogos_archvio_masvio_Administracion()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT  [id_admin]
        ,[nombre_admin]
        ,[nombre_corto]
        ,[nombre_sigla]
        ,[estatus]
        ,[user_alta]
        ,[fecha_alta]
        ,[user_mod]
        ,[fecha_mod]
        ,[user_baja]
        ,[fecha_baja]
        ,[unidad]
        ,[telefono]
        ,[direccion]
    FROM [Control_Ingresos].[dbo].[Administracion] WHERE estatus = 'A'";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                // $conexion->CerrarConexion($con);
            } else {
                return null;
                //$conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_SubAdmin()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM SubAdmin WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_Departamento()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM Departamento WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_cat_escolaridad()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM cat_escolaridad WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_Puesto_ADR()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Puesto_ADR  WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_Puesto_FUMP()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM Puesto_FUMP  WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_cat_nombramiento()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM cat_nombramiento  WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_cat_nivel_jerarquico()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM cat_nivel_jerarquico   WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_cat_estatus_escolar()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM cat_estatus_escolar   WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_cat_estado_civil()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM cat_estado_civil  WHERE estatus = 'A'	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Catalogos_archvio_masvio_Procesos()
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();
        $con = $conexion->ObtenerConexionBD();
        $query = "	SELECT * FROM Procesos	";
        $con = $conexion->ObtenerConexionBD();
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($row = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[]  = $row;
            }
            if (isset($filas)) {
                return $filas;
                $conexion->CerrarConexion($con);
            } else {
                return null;
                $conexion->CerrarConexion($con);
            }
           
        } else {
            return sqlsrv_errors();
            $conexion->CerrarConexion($con);
        }
    }
    public function Crear_Exel_carga_masiva_emp($reporte,$nombre_reporte)
    {
        include_once 'Classes/PHPExcel.php';
        include_once 'Classes/PHPExcel/Writer/Excel2007.php';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator('Andres Mares Sanchez') // Nombre del autor
            ->setLastModifiedBy('Andres Mares Sanchez') //Ultimo usuario que lo modific�
            ->setTitle($nombre_reporte) // Titulo
            ->setSubject('Reporte Excel con PHP y SQL SERVER') //Asunto
            ->setDescription($nombre_reporte); //Descripci�n

        $encabezados = [
            'id_Admin',
            'Administración_Actual',

        ];
        // se definen los estilos de las celdas
        $estilo_titulos = [
            'font' => [
                'name' => 'Montserrat',
                'bold' => true,
                'size' => 12,
                'italic' => true,
            /*'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE,*/
                'strike' => false, /* hace un efecto fixed en excel*/
                'color' => [
                    'rgb' => 'ffffff',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => [
                        'rgb' => 'ffffff',
                    ],
                ],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'a12142'],
            ],
        ];
        $estilos_registros = [
            'font' => [
                'name' => 'Montserrat',
                'bold' => false,
                'size' => 9,
                'italic' => false,
            /*'underline' => PHPExcel_Style_Font::UNDERLINE_DOUBLE,*/
                'strike' => false, /* hace un efecto fixed en excel*/
                'color' => [
                    'rgb' => '000109',
                ],
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => [
                        'rgb' => '808080',
                    ],
                ],
            ],
        ];

        //se terminan de definir los estilos

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $encabezados[0])
            ->setCellValue('B1', $encabezados[1])
            
            ;
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:B1')->applyFromArray($estilo_titulos);
        // if ($reporte != null) {
        //     $h = 2;
        //     for ($i = 0; $i < count($reporte); ++$i) {
        //         $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue('A'.$h, $reporte[$i]['id_admin'])
        //             ->setCellValue('B'.$h, $reporte[$i]['nombre_admin'])
        //             ;
        //         $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$h.':B'.$h)->applyFromArray($estilos_registros);
        //         ++$h;
        //     }
        //     $objPHPExcel->setActiveSheetIndex(0);

        //     foreach (range('A', 'B') as $columnID) {
        //         $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        //             ->setAutoSize(true);
        //     }
        
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=" '.$nombre_reporte.'.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        // } else {
        //     echo"No hay datos que se detecten de la consulta por eso no se ha generado el documento";
        // }
    }
    
}



