<?php

$QUERY ="SELECT* from  Empleado_insumo
select * from mov_insumo
select * from mov_Posisiones
select  id_num_posision from Posisiones where year(fecha_alta) = year(getdate())
select * from Posisiones where id_num_posision = '10339524'
delete from Posisiones where id_posision = 282
delete from mov_Posisiones where id_posision = 282

delete from mov_Posisiones where id_posision is null
SELECT top 1 id_empleado_plant  FROM Empleado_insumo where no_empleado = 194333 and estatus ='A'
select base.no_empleado no_empleado_insertado,
INS.[Id Empl#]
from Empleado_insumo base
FULL JOIN Insumo6 Ins ON Ins.[Id Empl#] = base.no_empleado
WHERE base.no_empleado IS NULL AND Ins.[Id Empl#] IS NOT NULL

delete from mov_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate())
delete from Empleado_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate())
select *from Empleado_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate())

update Posisiones set id_empleado = null where id_empleado = (select id_empleado_plant from Empleado_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate()))

select * from Posisiones where id_empleado = 11674";

// PARA LIMPIAR LAS POSISIONES DE LA CARGA MASIVA
// QUERY DECLARANDO UN WHILE Y VARIABLES

$QUERY2 = "DECLARE @id_empleado int = (select count(*) from Empleado_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate()))
select @id_empleado

while (@id_empleado > 0)
begin
update Posisiones set id_empleado = null 
where id_empleado = (select top 1 id_empleado_plant  from Empleado_insumo where day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate()))

delete from Empleado_insumo where id_empleado_plant = (select top 1 id_empleado_plant  from Empleado_insumo where  day(fecha_alta) = day(getdate()) 
and month(fecha_alta) = month(getdate()) 
and year(fecha_alta) = year(getdate()))

end ";


echo "INSERT INTO Empleado_insumo (
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
    ,Case '$jefe' when '' then null Else ( select id_empleado_plant from Empleado_insumo where no_empleado = '$jefe' ) end  AS [jefe_directo]
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


    INSERT INTO [mov_insumo](
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
    ( SELECT top 1 CAST(scope_identity() AS int) AS EMPLEADO FROM Empleado_insumo) AS [id_empleado_plant]
    ,$No_Empleado AS [no_empleado]
    ,Case '$jefe' when '' then null Else (select concat(nombre_s, ' ',apellido_p, ' ',apellido_m) as nombre_jefe from Empleado_insumo where no_empleado = '$jefe')  end  AS [jefe_directo]
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
    , (SELECT posision_jefe from Posisiones where id_num_posision = '$num_plaza')  AS [posision_jefe]
    ,case '$nivel' when '' then NULL else (SELECT nivel from Posisiones where id_num_posision ='$num_plaza') end AS [nivel]
    ,case '$clave_presupuesto' when '' then  NULL else (SELECT Codigo_pres from Posisiones where id_num_posision = '$num_plaza') end AS [Codigo_pres]
    ,CASE '$sal_net'WHEN '' THEN NULL ELSE '$sal_net' END AS [sueldo_neto]
    ,8 AS [id_proc]
    ,'$user_alta' AS [user_alta]
    ,GETDATE() AS [fecha_alta]
    ,'A' AS [estatus] ";