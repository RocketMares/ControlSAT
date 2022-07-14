<?php
//ACCIONES PARA REGISTRAR Y CARGAR USUARIOS NUEVOS --------------------------------------------------------
if (isset($_POST['datos'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $datos = json_decode($_POST['datos']);
    $accion = $metodos->Registra_usuario_insumo($datos);   
    $num_empleado = $_SESSION['nombre_archivo_ses'] = $datos->num_empleado;
    echo $accion;
}

if (isset($_FILES['archvioID'])) {
    include_once 'sesion.php';
    $nombre_archivo = $_FILES['archvioID']['name'];
    $tipo_archivo = $_FILES['archvioID']['type'];
    $nombre_temp_archivo = $_FILES['archvioID']['tmp_name'];
    $tamano_archivo = $_FILES['archvioID']['size'];
    $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
    $Carpeta = "../img/fotos_empleados/";
    $nombre_archivo_emp = $_SESSION['nombre_archivo_ses'].$ext_archivo;

    if (move_uploaded_file($nombre_temp_archivo, $Carpeta.$nombre_archivo_emp)) {
        echo "El usuario se ha cargado exitosamente ";
    } else {
        echo "El usaurio se registro exitosamente, pero no se ha podido cargar la foto.";
    }

}
//FIN ACCIONES PARA REGISTRAR Y CARGAR USUARIOS NUEVOS --------------------------------------------------------
//ACCIONES ACTUALIZAR Y CARGAR OFICIOS GENERADOS --------------------------------------------------------
if (isset($_POST['Aactualiza_oficio'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();

    $datos = json_decode(json_encode($_POST['Aactualiza_oficio']),true);
    $fecha_oficio = $datos['fecha_oficio'];
    $id_oficio = $datos['id_oficio'];
  
    $accion = $metodos->Actualiza_Oficio($id_oficio,$fecha_oficio); 
     $num_empleado = $_SESSION['nombre_archivo_ses'] = $id_oficio;
    echo $accion;
}
if (isset($_FILES['carga_oficio_firm_asig'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $zip = new ZipArchive();
    $id_oficio = $_SESSION['nombre_archivo_ses'];
    $datos = $metodos->Consulta_datos_del_oficio_para_nombrar($id_oficio);
    $nombre_carpeta_interna = $datos['rfc_corto'];
    $NOMBRE_BUSCADO = $datos['no_empleado'].'_'.$datos['id_oficio_gen'].'_'.str_replace("-", "_", $datos['id_num_oficio']).'_'.$datos['tipo_oficio'];
    $nombre_archivo = $_FILES['carga_oficio_firm_asig']['name'];
    $tipo_archivo = $_FILES['carga_oficio_firm_asig']['type'];
    $nombre_temp_archivo = $_FILES['carga_oficio_firm_asig']['tmp_name'];
    $tamano_archivo = $_FILES['carga_oficio_firm_asig']['size'];
    $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
    $carpteta_temporal = "../temp_files/";
    if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777, true);
        // if ($zip->open($path_temp.$nombre_doc, ZIPARCHIVE::CREATE) === true) {
        $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
   
        $nombre_archivo_emp = $NOMBRE_BUSCADO.$ext_archivo;
        // $zip->addFile($micarpeta.$nombre_archivo_emp);
        if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
            if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                if ($zip->close()) {
                    echo "Se ha cargado el documento exitosxamente";
                    unlink($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                }
            } else {
                echo 'Error al crear el documento zip ';
            }
        }
    } else {
        $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
        $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
   
        $nombre_archivo_emp = $NOMBRE_BUSCADO.$ext_archivo;
    
        if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
            if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                if ($zip->close()) {
                    echo "Se ha cargado el documento exitosxamente";
                    unlink($carpteta_temporal.$nombre_archivo_emp);
                }
            } else {
                echo 'Error al crear el documento zip ';
            }
        }
    }
}
//FIN DE ACTUALIZAR Y CARGAR OFICIOS GENERADOS--------------------------------------------------------

//ACCIONES PARA CARGAR FOTOS NUEVAS--------------------------------------------------------
if (isset($_POST['nombre_foto'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $datos = json_decode(json_encode($_POST['nombre_foto']),true);
    $num_empleado = $_SESSION['nombre_archivo_ses'] = $datos['no_emp'];
}
if (isset($_FILES['Foto_nueva'])) {
    include_once 'sesion.php';
    $nombre_archivo = $_FILES['Foto_nueva']['name'];
    $tipo_archivo = $_FILES['Foto_nueva']['type'];
    $nombre_temp_archivo = $_FILES['Foto_nueva']['tmp_name'];
    $tamano_archivo = $_FILES['Foto_nueva']['size'];
    $fecha_hoy = date_create(date('Y')."/".date('m')."/".date('d')); 
    $formato = date_format($fecha_hoy,"Y_m_d");
    $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
    $nombre_archivo_emp = $_SESSION['nombre_archivo_ses'].$ext_archivo;

    $Carpeta = "../img/fotos_empleados/";
    $Archivo_a_remplazar = "../img/fotos_empleados/.$nombre_archivo_emp";
    $nombre_archivo_emp_anterior = $_SESSION['nombre_archivo_ses']."_".$formato.$ext_archivo;
    if (file_exists($Carpeta.$nombre_archivo_emp)) {
        if(rename($Carpeta.$nombre_archivo_emp, $Carpeta.$nombre_archivo_emp_anterior)){
            if (move_uploaded_file($nombre_temp_archivo, $Carpeta.$nombre_archivo_emp)) {
                echo "El usuario se ha cargado exitosamente.";
            } else {
                echo "El usaurio se registro exitosamente, pero no se ha podido cargar la foto.";
            }
            echo " <br> Se pudo cambiar tambien el nombre de la imagen anterior para que quede guardada en el historial.";
         }
         else {
             echo "No se pudo remplazar el nombre de la imagen anterior";
         }
      

    }
    else {
        if (move_uploaded_file($nombre_temp_archivo, $Carpeta.$nombre_archivo_emp)) {
            echo "El usuario se ha cargado exitosamente.";
        } else {
            echo "El usaurio se registro exitosamente, pero no se ha podido cargar la foto.";
        }
        echo "<br> Se valida que no existe en la carpeta de fotos una foto igual.";
        
    }



}
//FIN ACCIONES PARA CARGAR FOTOS NUEVAS--------------------------------------------------------


//ACCIONES PARA CARGAR OFICIOS NUEVOS--------------------------------------------------------
if (isset($_POST['nombre_doc'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $datos = json_decode(json_encode($_POST['nombre_doc']),true);
    $accion = $metodos->Inserta_nuevo_documento($datos);
     $_SESSION['nombre_archivo_ses'] = $accion;

}
if (isset($_FILES['documento_nuevo_oficio'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $zip = new ZipArchive();
    $id_oficio = $_SESSION['nombre_archivo_ses'];
    if ($id_oficio != 0) {
        $datos = $metodos->Consulta_datos_del_oficio_para_nombrar($id_oficio);
        $nombre_carpeta_interna = $datos['rfc_corto'];
        $NOMBRE_BUSCADO = $datos['no_empleado'].'_'.$datos['id_oficio_gen'].'_'.str_replace("-", "_", $datos['id_num_oficio']).'_'.$datos['tipo_oficio'];
    
        $nombre_archivo = $_FILES['documento_nuevo_oficio']['name'];
        $tipo_archivo = $_FILES['documento_nuevo_oficio']['type'];
        $nombre_temp_archivo = $_FILES['documento_nuevo_oficio']['tmp_name'];
        $tamano_archivo = $_FILES['documento_nuevo_oficio']['size'];
        $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
        $carpteta_temporal = "../temp_files/";
        
        $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
        $nombre_archivo_emp = $NOMBRE_BUSCADO.$ext_archivo;
        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
            if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
                if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                    $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                    if ($zip->close()) {
                        echo "Se ha cargado el documento exitosxamente";
                        unlink($carpteta_temporal.$nombre_archivo_emp);
                    }
                } else {
                    echo 'Error al crear el documento zip ';
                }
            }
        } else {
            $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
       
            if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
                // if ($zip->open($path_temp.$nombre_doc, ZIPARCHIVE::CREATE) === true) {
                
                if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                    $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                    if ($zip->close()) {
                        echo "Se ha cargado el documento exitosxamente";
                        unlink($carpteta_temporal.$nombre_archivo_emp);
                    }
                } else {
                    echo 'Error creando '.$NOMBRE_BUSCADO;
                }
            }
        }
    }
}


//FIN ACCIONES PARA CARGAR OFICIOS NUEVOS--------------------------------------------------------
//INICIO ACCIONES PARA CARGAR SISTEMAS NUEVOS--------------------------------------------------------


if (isset($_FILES['archivo_sistema_app'])) {
    //ECHO"hola";
    include_once "sesion.php";
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $zip = new ZipArchive();
    $id_sistem = $_SESSION['nombre_archivo_ses'];
    if ($id_sistem != 0) {
        $datos = $metodos->consulta_info_sistema($id_sistem);
        
        $NOMBRE_BUSCADO = $datos['id_system'];
    
        $nombre_archivo = $_FILES['archivo_sistema_app']['name'];
        $tipo_archivo = $_FILES['archivo_sistema_app']['type'];
        $nombre_temp_archivo = $_FILES['archivo_sistema_app']['tmp_name'];
        $tamano_archivo = $_FILES['archivo_sistema_app']['size'];
        $micarpeta = '../Sistemas_almacenados/';
        $carpteta_temporal = "../temp_files/";
        
        $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
        $nombre_archivo_emp = $NOMBRE_BUSCADO.$ext_archivo;
        
            if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
                if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                    $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                    if ($zip->close()) {
                        echo "Se ha cargado el sistema exitosxamente";
                        unlink($carpteta_temporal.$nombre_archivo_emp);
                    }
                } else {
                    echo 'Error al crear el documento zip ';
                }
            }
        
    }
}
if (isset($_FILES['miArchvio_firmado_resp'])) {
    include_once 'sesion.php';
    include_once 'ConsultaADR.php';
    $metodos = new ConsultaInfoADR();
    $zip = new ZipArchive();
    $id_acceso = $_SESSION['nombre_archivo_ses'];
    if ($id_oficio != 0) {
        $datos = $metodos->Consulta_datos_de_la_responsiva_para_nombrar($id_acceso);
        $nombre_carpeta_interna = $datos['rfc_corto'];
        $NOMBRE_BUSCADO = $datos['no_empleado'].'_'.$datos['id_reg_acceso'].'_RESP_'.str_replace(" ", "_",$datos['nombre_sistema']);
    
        $nombre_archivo = $_FILES['miArchvio_firmado_resp']['name'];
        $tipo_archivo = $_FILES['miArchvio_firmado_resp']['type'];
        $nombre_temp_archivo = $_FILES['miArchvio_firmado_resp']['tmp_name'];
        $tamano_archivo = $_FILES['miArchvio_firmado_resp']['size'];
        $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
        $carpteta_temporal = "../temp_files/";
        
        $ext_archivo = substr($nombre_archivo, strrpos($nombre_archivo, '.'));
        $nombre_archivo_emp = $NOMBRE_BUSCADO.$ext_archivo;
        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
            if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
                if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                    $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                    if ($zip->close()) {
                        echo "Se ha cargado el documento exitosxamente";
                        unlink($carpteta_temporal.$nombre_archivo_emp);
                    }
                } else {
                    echo 'Error al crear el documento zip ';
                }
            }
        } else {
            $micarpeta = '../Formatos/'.$nombre_carpeta_interna.'/';
       
            if (move_uploaded_file($nombre_temp_archivo, $carpteta_temporal.$nombre_archivo_emp)) {
                // if ($zip->open($path_temp.$nombre_doc, ZIPARCHIVE::CREATE) === true) {
                
                if ($zip->open($micarpeta.$NOMBRE_BUSCADO.'.zip', ZIPARCHIVE::CREATE)===true) {
                    $zip->addFile($carpteta_temporal.$nombre_archivo_emp,$nombre_archivo_emp);
                    if ($zip->close()) {
                        echo "Se ha cargado el documento exitosxamente";
                        unlink($carpteta_temporal.$nombre_archivo_emp);
                    }
                } else {
                    echo 'Error creando '.$NOMBRE_BUSCADO;
                }
            }
        }
    }
    else{
        echo "no hay datos $id_acceso";
    }
}


//FIN ACCIONES PARA CARGAR OFICIOS NUEVOS--------------------------------------------------------
?>