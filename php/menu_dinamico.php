<?php

class Menu
{
    public function ConsultaMenu($id_perfil, $id_padre)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();// SE INSTANCIA LA CLASE CONEXIÓN
        //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Menu_app WHERE 
        id_perfil = $id_perfil and id_padre = $id_padre
        and estatus = 'A'
         ORDER BY orden ASC";
  
        $rst = sqlsrv_query($con, $query);
        $filas[] = null;
        if ($rst) {
            while ($rows = sqlsrv_fetch_array($rst, SQLSRV_FETCH_ASSOC)) {
                $filas[] = array('id_menu' => $rows['id_menu'],'id_padre' => $rows['id_padre'],
            'orden' => $rows['orden'],'nombre_menu' => $rows['nombre_menu'],'url_menu' => $rows['url_menu'],
          'estatus' => $rows['estatus'],'Funcion' => $rows['Funcion']);
            }
            return $filas;
            $conexion->CerrarConexion($con);
        }
    }
  
    public function ConsultaMenu_Encabezados($id_perfil)
    {
        include_once 'conexion.php';
        $conexion = new ConexionSQL();// SE INSTANCIA LA CLASE CONEXIÓN
        //SE MANDA A LLAMAR LA CONEXIÓN Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        $query = "SELECT * FROM Menu_app WHERE id_perfil = $id_perfil AND id_padre = 0
        AND estatus = 'A' ORDER BY orden ASC";
  
        $rst = sqlsrv_query($con, $query);
        if ($rst) {
            $filas[] = null;
            while ($rows = sqlsrv_fetch_array($rst, SQLSRV_FETCH_ASSOC)) {
                $filas[] = array('id_menu' => $rows['id_menu'],'id_padre' => $rows['id_padre'],
            'orden' => $rows['orden'],'nombre_menu' => $rows['nombre_menu'],'url_menu' => $rows['url_menu'],
          'estatus' => $rows['estatus'],'Funcion' => $rows['Funcion']);
            }
            return $filas;
            $conexion->CerrarConexion($con);
        }
    }
  
    public function RenderMenu($id_perfil)
    {
        $menu = self::ConsultaMenu_Encabezados($id_perfil);
        $html[] = null;
        $posicion = 0;
        $html[$posicion] = "<ul class='navbar-nav mr-auto '>";
        for ($i = 0; $i <count($menu);$i++) {
            if ($menu[$i]["estatus"] == "A") {
                $posicion++;
                $html[$posicion] ="<li class='nav-item '><a class='nav-link' href='". $menu[$i]['url_menu']."'>". $menu[$i]['nombre_menu']."</a></li>";
                $submenu = self::ConsultaMenu($id_perfil, $menu[$i]["id_menu"]);
                if (count($submenu)-1 !=0) {
                    $html[$posicion] = "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='". $menu[$i]['url_menu']."'>".$menu[$i]['nombre_menu']."</a>
            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                    for ($j = 0; $j<count($submenu); $j++) {
                        if ($submenu[$j]["estatus"] == "A") {
                            $posicion++;
                            $html[$posicion] = "<a class='dropdown-item' href='".$submenu[$j]['url_menu'] ."'>".$submenu[$j]['nombre_menu']."</a>";
                            $subopcion = self::ConsultaMenu($id_perfil, $submenu[$j]["id_menu"]);
                            if (count($subopcion)-1 !=0) {
                                $posicion++;
                                $html[$posicion] = "<div class='dropdown-divider'></div>";
                                for ($m=0; $m <count($subopcion) ; $m++) {
                                    if ($subopcion[$m]["estatus"] == "A") {
                                        $posicion++;
                                        $html[$posicion] = "<a class='' href='".$subopcion[$m]['url_menu'] ."'onclick='".$subopcion[$m]['Funcion'] ."'>".$subopcion[$m]['nombre_menu']."</a>";
                                    }
                                }
                                $posicion++;
                                $html[$posicion] = "<div class='dropdown-divider'></div>";
                            }
                        }
                    }
                    $posicion++;
                    $html[$posicion] = "</div>
            </li>";
                }
            }
        }
        $c = count($html);
        $html[$c]= "</ul>";
        return $html;
    }

    public function Crear_menu()
    {


 echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark  fixed-top' >
             <a class='navbar-brand text-white' style='font-size:25px;' style='cursor:pointer; ' id='ver' href='index.php' >Control de Ingresos del Personal <img src='img\LOGO11.png' width='50' height='50' class=d-inline-block align-top alt=''></a>
              <button class='navbar-toggler'  type='button'  data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
              </button>
              <div class='collapse navbar-collapse' id='navbarSupportedContent'>";
         $html = self::RenderMenu($_SESSION['ses_id_perfil_ing']);
         for ($i = 0; $i < count($html); $i++) {
             echo $html[$i];
         }
     
        $nombre =  $_SESSION['ses_nombre_empleado_ing'];
        echo "
                <ul class='navbar-nav ml-auto'>
                    <li class='nav-item dropdown'>
                      <a class='nav-link-sat dropdown-toggle text-white'id='cerrar' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          ".$nombre."
                      </a>
                      <div class='dropdown-menu' aria-labelledby='cerrar'>
                      <a class='dropdown-item-sat' href='#' id='CerrarSesion' >Cerrar sesión</a>
                      </div>
                    </li>
                </ul>
              </div>
            </nav>";
    }

    public function Footer()
    {
        // SE COMVIERTE EN ARREGLO EL NOMBRE DELIMITADO POR ESPACIOS
      $nombre =  $_SESSION["ses_nombre_empleado_ing"];  // SE CREA EL NOMBRE CONCATENADO CON LA PRIMERA LETRA DE LA POSICIÓN 1
      echo "
      <!-- Footer inicio -->
 
       
        <footer class='container-fluid py-3 fixed-low'  style='background-color:#2E2E2E;' >
                <p class='float-right text-white'><a class='text-white' href='http://99.85.26.227:8181/Comunicados/login.html'>Comunicados</a></p>
                <p class='text-white' >&copy; SAT. &middot; <a class='text-white' href='https://intrasat2.sat.gob.mx/'>Intrasat</a>&middot;</p>

        <p class=' float-md-none text-white text-center' >Esta información esta clasificada como reservada en términos de los artículos 13 fracción V, 14 fracciones II y VI, y 63 de la Ley Federal de Transparencia y Acceso a la Información Pública Gubernamental; el lineamiento Vigésimo Cuarto, fracciones I, II y IV, de los “Lineamientos Generales para la Clasificación y Desclasificación de la información de las Dependencias de la Administración Pública Federal”, publicados en el Diario Oficial de la Federación el 18 de agosto de 2003; así como el artículo 69, primer párrafo, del Código Fiscal de la Federación vigente. El conocimiento y uso de la información contenida en el presente, por personas y/o fines diversos para los que ha sido remitido, puede ser constitutivo de responsabilidades administrativas y/o penales, sancionadas conforme a la legislación vigente.</p>

        </footer>
      
            
        <!-- Footer fin -->
        <script type='text/javascript' src='js/toastr.min.js'></script>
        <script src='js/jquery-3.1.1.js'></script>
        <script src='js/Popper.min.js'></script>
        <script src='js/bootstrap.js'></script>
        <script defer src='js/js/all.js'></script>
        <script src='js/scripts_index.js'></script>
        <script src='js/scripts_user.js'></script>
        <script src='js/scripts_filtros.js'></script>
        <script src='js/scripts_estructura.js'></script>
        <script src='js/toastr.js'></script>
        <script type='text/javascript' src='js/libs/bootstrap-datepicker.min.js'></script>
        <script src='js/libs/locales/bootstrap-datepicker.es.js' charset='UTF-8'></script>
        <script src='js/moment.min.js'></script>
        <script src='js/jquery.inputmask.js'></script>
        <script src='js/inputmask.binding.js'></script>
        <script src='js/moment.min.js'></script>
        <script src='js/jquery.fileDownload.js'></script>
        <script src='https://smtpjs.com/v3/smtp.js'></script>
        <script type='text/javascript'>
          $(document).ready(function() {
            $(\"#CerrarSesion\").click(function (e) { 
              e.preventDefault();
              alert('¡Vuelva pronto $nombre!')
              location.href=\"php/cerrar_sesion.php\";
              });
          });

          </script>
          </body>
          </html>
        ";
    }
    public function Footer_login()
    {
      //   $arreglo_nombre = explode(" ", $_SESSION["ses_nombre_"]); // SE COMVIERTE EN ARREGLO EL NOMBRE DELIMITADO POR ESPACIOS
      // $nombre = $arreglo_nombre[0];  // SE CREA EL NOMBRE CONCATENADO CON LA PRIMERA LETRA DE LA POSICIÓN 1
      echo "
      <!-- Footer inicio -->
 
   
        <footer class='container-fluid py-5 fixed-low' style='background-color:#2E2E2E;' >
                <p class='float-right'><a class='text-white' href='http://99.85.26.227:8181/Comunicados/login.html'>Comunicados</a></p>
                <p class='text-white'>&copy; SAT. &middot; <a class='text-white' href='https://intrasat2.sat.gob.mx/'>Intrasat</a>&middot;</p>
        <p class='text-white text-sm-center text-break' style='font: zice 2px;' >Esta información esta clasificada como reservada en términos de los artículos 13 fracción V, 14 fracciones II y VI, y 63 de la Ley Federal de Transparencia y Acceso a la Información Pública Gubernamental; el lineamiento Vigésimo Cuarto, fracciones I, II y IV, de los “Lineamientos Generales para la Clasificación y Desclasificación de la información de las Dependencias de la Administración Pública Federal”, publicados en el Diario Oficial de la Federación el 18 de agosto de 2003; así como el artículo 69, primer párrafo, del Código Fiscal de la Federación vigente. El conocimiento y uso de la información contenida en el presente, por personas y/o fines diversos para los que ha sido remitido, puede ser constitutivo de responsabilidades administrativas y/o penales, sancionadas conforme a la legislación vigente.</p>

        </footer>
 
            
        <!-- Footer fin -->
        <script src='js/jquery-3.3.1.js'></script>
        <script src='js/Popper.min.js'></script>
        <script src='js/bootstrap.js'></script>

          </body>

        </html>";
    }
    public function cabecera_principal(){


       include_once 'sesion.php';
      
      echo"
      <!DOCTYPE html>
      <html lang='en'>
        <head>
          <!-- Required meta tags -->
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
          <!-- Bootstrap CSS -->
          <link rel='stylesheet' href='css/bootstrap.css'>
          <link rel='stylesheet' src='css/css/all.css'>
          <link rel='stylesheet' href='css/toastr.min.css'>
          <link rel='shortcut icon' href='img/LOGO11.ico'>
          <title>CIP SAT</title>
          <link rel='stylesheet' href='css/style.css'>
          <link rel='stylesheet' href='css/css/all.css'>
          <link rel='stylesheet' href='css/libs/bootstrap-datepicker3.min.css'>
        <style>
        .formato_campos_activos{
            color:  #495057 ;
            background-color: #e5e8e8   ;
          }
       
        </style>
          <script src='js//jquery-3.1.1.js'></script>
          <!--otros--->
          <script src='js/bootstrap-table.min.js'></script>
          <script type='text/javascript' src='js/chart.js'></script>
          <script type='text/javascript' src='js/go.js'></script>  
          </head>
        <body class='fondo' id='body_cer'>";
  
    }
    public function cabecera_principal_log(){


     
     echo"
     <!doctype html>
     <html lang='en'>
       <head>
         <!-- Required meta tags -->
         <meta charset='utf-8'>
         <meta name='viewpor' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
     
         <!-- Bootstrap CSS -->
         <link rel='stylesheet' href='css/bootstrap.min.css'>
         <link rel='stylesheet' href='css/style.css'>
         <link rel='stylesheet' href='css/css/all.css'>
         <link rel='shortcut icon' href='img/LOGO11.ico'>
         <title>CIP SAT</title>
       </head >
       <body class='fondo'>
       <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
             <a class='navbar-brand text-white'  href='login.php' id='ver' >
             <img src='img\LOGO11.png' width='50' height='50' class=d-inline-block align-top alt=''>
             Control de ingresos del Personal SAT</a>
     </nav>";
 
   }



   public function Modal_insert_modf_usuarios(){
    include_once 'php/vistas_Plantilla.php';
    include_once 'php/MetodosUsuarios.php';
    $consulta = new VistasPlantilla();
    $mu = new MetodosUsuarios();
    $rows_sub = $consulta->Consulta_Sub($_SESSION["ses_id_admin_ing"]);
    $rows_sub = $mu->Consulta_Subadmin($_SESSION["ses_id_admin_ing"]);
    $rows_depto = $mu->Consulta_Depto($_SESSION["ses_id_admin_ing"]);
    $rows_jefes = $mu->Consulta_Cat_Jefes($_SESSION["ses_id_admin_ing"]);
    $rows_perfil = $mu->Consulta_Perfiles();
    $rows_administracion = $consulta->Consulta_Local();
    $rows_local = $consulta->Consulta_Local();
    $rows_perfil = $mu->Consulta_Perfiles();
    echo"
                   
        <div class='modal fade' id='Modal_form_editar' tabindex='-1' role='dialog'>
            <div class='modal-dialog modal-dialog-scrollable modal-lg' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Datos del usuario.</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <!-- Contenido del modal aqui-->
                        <div class='form-row'>
                        <div class='form-group col-md-4'>

                        <label for='RFC_CORTO_A'>RFC:<samp class='text-danger'>*</samp></label>
                        <input type='text' class='form-control' id='RFC_COMP_A' name='RFC_COMP_A'
                            placeholder='XXXX4548' maxlength='8' min='8' required
                            onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                            <div class='form-group col-md-4'>

                                <label for='RFC_CORTO_A'>RFC Corto:<samp class='text-danger'>*</samp></label>
                                <input type='text' class='form-control' id='RFC_CORTO_A' name='RFC_CORTO_A'
                                    placeholder='XXXX4548' maxlength='8' min='8' required
                                    onkeyup='javascript:this.value=this.value.toUpperCase();'>
                            </div>
                       
                            <div class='form-group col-md-4'>
                                <label for='NO_EMPLEADO_A'>No. de Empleado:<samp class='text-danger'>*</samp></label>
                                <input type='text' class='form-control' id='NO_EMPLEADO_A' name='NO_EMPLEADO_A'
                                    placeholder='123265' maxlength='6'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group col-md-6'>
                                <label for='NOMBRE_A'>Nombre:<samp class='text-danger'>*</samp></label>
                                <input type=' text' class='form-control letras' id='NOMBRE_A' name='NOMBRE_A'
                                    placeholder='Juan Pérez' required
                                    onkeyup='javascript:this.value=this.value.toUpperCase();'>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='CORREO_A'>Correo:<samp class='text-danger'>*</samp></label>
                                <input type='email' class='form-control' id='CORREO_A' name='CORREO_A'
                                    placeholder='xxxx@dssat.sat.gob.mx'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group col-md-6'>
                                <div class='input-group-prepend'>
                                    <label for='id_admin_A'>Administración:<samp class='text-danger'>*</samp></label>
                                </div>
                                <select class='custom-select' id='id_admin_A' name='id_admin_A'>
                                    <option value='0'>Seleccionar Local</option>";
                                   
                                for ($i = 0; $i < count($rows_local); $i++) {
                                    if ($rows_local[$i]["estatus"] == "A") {
                                        echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                                    }
                                }
                            echo"
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='id_sub_admin_A'>Subadministración:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='id_sub_admin_A' name='id_sub_admin_A'>
                                    <option value='0'>Seleccionar Subadministración</option>";
                                    
                                $rows_sub = $mu->Consulta_Subadmin($_SESSION["ses_id_admin_ing"]);
                                for ($i = 0; $i < count($rows_sub); $i++) {
                                    echo "<option value='" .  $rows_sub[$i]["id_sub_admin"] . "'>" .  $rows_sub[$i]["nombre_sub_admin"] . "</option>";
                                }
                              echo"
                                </select>
                            </div>
                        </div>

                        <div class='form-row'>

                            <div class='form-group col-md-6'>
                                <label for='ID_DEPA_A'>Departamento:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='ID_DEPA_A' name='ID_DEPA_A'>
                                    <option value='0'>Seleccionar Departamento</option>";
                                
                                $rows_depto = $mu->Consulta_Depto($_SESSION["ses_id_admin_ing"]);
                                for ($i = 0; $i < count($rows_depto); $i++) {
                                    echo "<option value='" .  $rows_depto[$i]["id_depto"] . "'>" .  $rows_depto[$i]["nombre_depto"] . "</option>";
                                }
                               echo"
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='RFC_JEFE_A'>Jefe Directo:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='id_JEFE_A' name='id_JEFE_A'>
                                    <option value='0'>Seleccionar Jefe directo</option>";
                                    
                                $rows_jefes = $mu->Consulta_Cat_Jefes($_SESSION["ses_id_admin_ing"]);
                                for ($i = 0; $i < count($rows_jefes); $i++) {
                                    if ($rows_jefes[$i]["estatus"] == "A") {
                                        echo "<option value='" .$rows_jefes[$i]["id_empleado_us"] . "'>" .  $rows_jefes[$i]["nombre_empleado"] . "</option>";
                                    }
                                }
                                echo"
                                </select>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group col-md-6'>
                                <label for='estatus_A'>Estatus de actividad:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='estatus_Actividad' name='estatus_Actividad'>
                                    <option value='0'>Seleccionar estatus</option>
                                    <option value='A'>ACTIVO</option>
                                    <option value='N'>NO ACTIVO</option>
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <div class='input-group-prepend'>
                                    <label for='ID_PERFIL_A'>Perfil:<samp class='text-danger'>*</samp></label>
                                </div>
                                <select class='custom-select' id='ID_PERFIL_A' name='ID_PERFIL_A'>
                                    <option value='0'>Seleccionar Perfil</option>";
                                   
                                for ($i = 0; $i < count($rows_perfil); $i++) {
                                    if ($rows_perfil[$i]["estatus"] == "A") {
                                        echo "<option value='" .  $rows_perfil[$i]["id_perfil"] . "'>" .  $rows_perfil[$i]["nombre_perfil"] . "</option>";
                                    }
                                }
                                echo"
                                </select>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group col-md-6'>
                                <div class='input-group-prepend'>
                                    <label for='ID_PUESTO_A'>Puesto:<samp class='text-danger'>*</samp></label>
                                </div>
                                <select class='custom-select' id='ID_PUESTO_A' name='ID_PUESTO_A'>
                                    <option value='0'>Seleccionar Puesto</option>";
                                   
                                $rows_puestos = $mu->Consulta_Puestos();
                                for ($i = 0; $i < count($rows_puestos); $i++) {
                                    echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                                }
                                echo"
                                </select>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='estatus_A'>Estatus de responsiva:</label>
                                <select class='custom-select' id='estatus_responsiva' name='estatus_responsiva'>
                                    <option value='0'>Seleccionar Estatus</option>
                                    <option value='0'>PENDIENTE</option>
                                    <option value='1'>FRIMADA</option>
                                </select>
                            </div>
                        </div>
                        <button type='button' id='btn_RU_A' class='btn btn-block btn-primary'>Actualizar
                            usuario.</button>
                        <!-- Contenido del modal aqui-->
                    </div>
                    <div class='modal-footer'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='Modal_form_registrar' tabindex='-1' role='dialog'>
        <div class='modal-dialog modal-dialog-scrollable modal-xl' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Agregar nuevo usuario.</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                <!-- Contenido del modal aqui-->


                <div class='form-row'>
                <div class='form-group col-md-6'>

                <label for='RFC_CORTO'>RFC completo:<samp class='text-danger'>*</samp></label>
                <input type='text' class='form-control' id='RFC_COMPLE' name='RFC_COMPLE' placeholder='MASA950519E48' maxlength='13' min='8' required onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>
                    <div class='form-group col-md-3'>

                        <label for='RFC_CORTO'>RFC Corto:<samp class='text-danger'>*</samp></label>
                        <input type='text' class='form-control' id='RFC_CORTO' name='RFC_CORTO' placeholder='XXXX4548' maxlength='9' min='8' required onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>

                    <div class='form-group col-md-3'>
                        <label for='NO_EMPLEADO'>No. de Empleado:<samp class='text-danger'>*</samp></label>
                        <input type='text' class='form-control' id='NO_EMPLEADO' name='NO_EMPLEADO' placeholder='123265' maxlength='6'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='NOMBRE'>Nombre:<samp class='text-danger'>*</samp></label>
                        <input type=' text' class='form-control letras' id='NOMBRE' name='NOMBRE' placeholder='Juan Pérez' required onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='CORREO'>Correo:<samp class='text-danger'>*</samp></label>
                        <input type='email' class='form-control' id='CORREO' name='CORREO' placeholder='xxxx@dssat.sat.gob.mx'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <div class='input-group-prepend'>
                            <label for='id_admin'>Administración:<samp class='text-danger'>*</samp></label>
                        </div>
                        <select class='custom-select' id='id_admin' name='id_admin'>
                            <option value='0'>Seleccionar Local</option>";
                            
                            for ($i = 0; $i < count($rows_local); $i++) {
                                if ($rows_local[$i]["estatus"] == "A") {
                                    echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                                }
                            }
                      echo"
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_sub_admin'>Subadministración:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='id_sub_admin' name='id_sub_admin'>
                            <option value='0'>Seleccionar Subadministración</option>";
                            
                            $rows_sub = $mu->Consulta_Subadmin($_SESSION["ses_id_admin"]);
                            for ($i = 0; $i < count($rows_sub); $i++) {
                                echo "<option value='" .  $rows_sub[$i]["id_sub_admin"] . "'>" .  $rows_sub[$i]["nombre_sub_admin"] . "</option>";
                            }
                            echo"
                        </select>
                    </div>
                </div>

                <div class='form-row'>

                    <div class='form-group col-md-6'>
                        <label for='ID_DEPA'>Departamento:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='ID_DEPA' name='ID_DEPA'>
                            <option value='0'>Seleccionar Departamento</option>";
                            
                            $rows_depto = $mu->Consulta_Depto($_SESSION["ses_id_admin"]);
                            for ($i = 0; $i < count($rows_depto); $i++) {
                                echo "<option value='" .  $rows_depto[$i]["id_depto"] . "'>" .  $rows_depto[$i]["nombre_depto"] . "</option>";
                            }
                         echo"
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='RFC_JEFE'>Jefe Directo:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='RFC_JEFE' name='RFC_JEFE'>
                            <option value='0'>Seleccionar Jefe directo</option>";
                            
                            $rows_jefes = $mu->Consulta_Cat_Jefes($_SESSION["ses_id_admin"]);
                            for ($i = 0; $i < count($rows_jefes); $i++) {
                                if ($rows_jefes[$i]["estatus"] == "A") {
                                    echo "<option value='" .  $rows_jefes[$i]["id_empleado"] . "'>" .  $rows_jefes[$i]["nombre_empleado"] . "</option>";
                                }
                            }
                         echo"
                        </select>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='estatus'>Estatus de actividad:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='estatus' name='estatus'>
                            <option value='0'>Seleccionar Estatus</option>
                            <option value='A'>ACTIVO</option>
                            <option value='N'>NO ACTIVO</option>
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <div class='input-group-prepend'>
                            <label for='ID_PERFIL'>Perfil:<samp class='text-danger'>*</samp></label>
                        </div>
                        <select class='custom-select' id='ID_PERFIL' name='ID_PERFIL'>
                            <option value='0'>Seleccionar Perfil</option>";
                        
                            for ($i = 0; $i < count($rows_perfil); $i++) {
                                if ($rows_perfil[$i]["estatus"] == "A") {
                                    echo "<option value='" .  $rows_perfil[$i]["id_perfil"] . "'>" .  $rows_perfil[$i]["nombre_perfil"] . "</option>";
                                }
                            }
                           echo"
                        </select>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <div class='input-group-prepend'>
                            <label for='ID_PUESTO'>Puesto:<samp class='text-danger'>*</samp></label>
                        </div>
                        <select class='custom-select' id='ID_PUESTO' name='ID_PUESTO'>
                            <option value='0'>Seleccionar Puesto</option>";
                        
                            $rows_puestos = $mu->Consulta_Puestos();
                            for ($i = 0; $i < count($rows_puestos); $i++) {
                                echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                            }
                        echo"
                        </select>
                    </div>
                </div>
                <button type='button' id='btn_RU' class='btn btn-block btn-primary' onclick='valida_formulario_registro_user()'>Registrar usuario.</button>
                <!-- Contenido del modal aqui-->
            </div>
            <div class='modal-footer'>
            </div>
            </div>
        </div>
    </div>
</div>
              ";

              

   } 
   public function modals(){
    include_once 'vistas_Plantilla.php';
    include_once 'MetodosUsuarios.php';
    include_once "ConsultaADR.php";
    include_once 'sesion.php';
    $consulta = new VistasPlantilla();
    $mu = new MetodosUsuarios();
    $cons = new ConsultaInfoADR();
    $datos_procesos_act = $cons->vista_procesos_fijos();
    $datos_procesos_act_plaz = $mu->estados_plaza();
    
    $datos_escolaridad = $mu->cat_escolar();
    $datos_estatus_escolar = $mu->cat_estatus_escolar();
    $datos_estados_civil = $mu->cat_estatus_civil();
    $datos_tipos_nombramiento = $mu->cat_nombramientos();
    $datos_tipos_nombramiento = $mu->cat_nombramientos();
    $datos_sindicatos = $mu->cat_sindicatos();
    $datos_nivel_jerar = $mu->cat_jerarquia();
    $perfil = $_SESSION['ses_id_perfil_ing'];
    $datos_plaza = $cons->vista_Posisiones_fijos();
    $rows_sub = $consulta->Consulta_Sub($_SESSION["ses_id_admin_ing"]);
    $rows_sub = $mu->Consulta_Subadmin($_SESSION["ses_id_admin_ing"]);
    $rows_depto = $mu->Consulta_Depto($_SESSION["ses_id_admin_ing"]);
    $rows_jefes = $mu->Consulta_Cat_Jefes_insumo();
    $rows_perfil = $mu->Consulta_Perfiles();
    $rows_administracion = $consulta->Consulta_Local();
    $rows_local = $consulta->Consulta_Local();
    $rows_perfil = $mu->Consulta_Perfiles();
    $datos_motivos = $cons->Motivos_especiales();
    $datos_tipos_oficios = $cons->Catalogo_de_tipos_oficio();
    // Modal de información del usuario detalles de movimientos
    
    switch ($perfil) {
        case 1:
        $habilitacion = "";
        break;
        case 4:
        $habilitacion = "";
        break;
        case 5:
        $habilitacion = "";
        break;
        default:
        $habilitacion = "Disabled";
        break;
    }
    
    echo"
    
    
    
    
    <div class='modal fade bd-example-modal-xl' id='Modal_detalle_usuario_insumo' tabindex='-1' role='dialog'
    aria-labelledby='myExtraLargeModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-xl'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalCenterTitle'>DETALLE Y MOVIMIENTOS DEL USUARIO</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body '>

                <div id='datos_princip_us'> </div>
                <div id='entrada_princ'>";
                // AQUI INICA EL MENU DE INFORMACION DEL USUARIO
                    ECHO"<nav>
                            <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                                <a class='nav-item nav-link active' id='nav-home-tab' data-toggle='tab' href='#DATOS_GEN'
                                    role='tab' aria-controls='nav-home' aria-selected='true'>Datos del usuario</a>
                                <a class='nav-item nav-link' id='nav-profile-tab' data-toggle='tab' href='#MOVIMIENTOS'
                                    role='tab' aria-controls='nav-profile' aria-selected='false'>Movimientos</a>
                                <a class='nav-item nav-link' id='nav-sistemas-tab' data-toggle='tab' href='#SISTEMAS'
                                    role='tab' aria-controls='nav-sistemas-tab' aria-selected='false'>Acceso a sistemas</a>";
                                    if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7 ) {
                                        echo"<a class='nav-item nav-link' id='nav-Oficios_his-tab' data-toggle='tab' href='#RESPONSIVAS'
                                        role='tab' aria-controls='nav-Oficios_his-tab' aria-selected='false'>Documentos firmados o por
                                        firmar</a>";
                                    }
                               
                        echo"</div>
                        </nav>";
              // FIN DE EL MENU
                         ECHO" <div class='tab-content' id='nav-tabContent'>
                
                        <div class='tab-pane fade show active' id='DATOS_GEN' role='tabpanel'
                            aria-labelledby='nav-home-tab'>";
                            // INTERIOR DE DATOS GENERALES 
                            // AQUI INICA EL MENU DE LOS DATOS GENERALES
                            ECHO"
                            <ul class='nav nav-pills mb-3' id='pills-tab' role='tablist'>
                                <li class='nav-item'>
                                    <a class='nav-link active' id='pills-home-tab' data-toggle='pill' href='#datos_basc'
                                        role='tab' aria-controls='pills-home' aria-selected='true'>Datos Basicos</a>
                                </li>";
                                if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7) {
                                    echo"<li class='nav-item'>
                                    <a class='nav-link' id='pills-home-tab' data-toggle='pill' href='#datos_basc_adic'
                                        role='tab' aria-controls='pills-home' aria-selected='true'>Datos adicionales</a>
                                </li>";
                                }
                                echo"<li class='nav-item'>
                                    <a class='nav-link' id='pills-profile-tab' data-toggle='pill' href='#datos_op'
                                        role='tab' aria-controls='pills-profile' aria-selected='false'>Estructura Funcional</a>
                                </li>";
                                if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7 ) {
                                    echo"<li class='nav-item'>
                                    <a class='nav-link' id='pills-contact-tab' data-toggle='pill' href='#datos_fun'
                                        role='tab' aria-controls='pills-contact' aria-selected='false'>Estructura Central</a>
                                </li>";
                                }

                            echo"</ul>";
                            // FIN DE EL MENU
                            ECHO "<div class='tab-content' id='pills-tabContent'>";
                            
                            // INICIO DE DATOS BASICOS
                             echo"   <div class='tab-pane fade show active' id='datos_basc' role='tabpanel'
                                    aria-labelledby='pills-home-tab'>

                                    <div class='form-row'>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>CURP:<samp class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='CURP2' name='CURP2'
                                                placeholder='XXXX4548' maxlength='18' min='18' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>RFC con Homoclave:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='RFC_COMP' name='RFC_COMP'
                                                placeholder='XXXX4548' maxlength='13' min='13' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>RFC Corto:<samp class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='RFC_CORTO' name='RFC_CORTO'
                                                placeholder='XXXX4548' maxlength='9' min='8' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>
                                            <label for='NO_EMPLEADO'>No. de Empleado:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='NO_EMPLEADO' name='NO_EMPLEADO'
                                                placeholder='123265' maxlength='6' onkeypress='return numero(event)'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-4'>
                                            <label for='NOMBRE'>Nombre(s):<samp class='text-danger'>*</samp></label>
                                            <input type=' text' class='form-control letras formato_campos_activos' id='NOMBRE' name='NOMBRE'
                                                placeholder='Juan Pérez' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='NO_EMPLEADO'>Apellido Paterno:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='APELLIDO_P1' name='APELLIDO_P1'
                                                placeholder='López'
                                                onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='NO_EMPLEADO'>Apellido Materno:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='APELLIDO_M' name='APELLIDO_M'
                                                placeholder='Mares'
                                                onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-6'>
                                            <label for='CORREO'>Correo Institucional:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='email' class='form-control formato_campos_activos' id='CORREO' name='CORREO'
                                                placeholder='xxxx@dssat.sat.gob.mx'>
                                        </div>";
                                        if ($perfil == 1 || $perfil == 5 || $perfil == 4  ) {
                                        echo"<div class='form-group col-md-6'>
                                            <label for='CORREO'>Correo Personal:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='email' class='form-control formato_campos_activos' id='CORREO_P' name='CORREO_P'
                                                placeholder='xxxx@gmail.com'>
                                        </div>";
                                        }
                                        echo"</div>
                                    <div class='form-row'>";
                                    if ($perfil == 1 || $perfil == 5 || $perfil == 4  ) {
                                        echo"<div class='form-group col-md-4'>
                                            <label for='CORREO'>Número personal:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='num_1' name='num_1'
                                                placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                                onkeypress='return numero(event)'>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='CORREO'>Número adicional:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control formato_campos_activos' id='num_2' name='num_2'
                                                placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                                onkeypress='return numero(event)'>
                                        </div>";
                                    }
                                    echo"<div class='form-group col-md-4'>
                                            <label for='CORREO'>Ext.Tel.:<samp class='text-danger'></samp></label>
                                            <input type='email' class='form-control formato_campos_activos' id='ext_tel' name='ext_tel'
                                                placeholder='Ejem: 42726' maxlength='5' minlength='5'
                                                onkeypress='return numero(event)'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-4'>
                                            <label for='estatus'>Estatus de Actividad:<samp
                                                    class='text-danger'>*</samp></label>
                                            <select class='custom-select formato_campos_activos' id='estatus' name='estatus'>
                                                <option value='0'>Seleccionar Estatus</option>";
                                                for ($i=0; $i <count($datos_procesos_act) ; $i++) { 
                                                    echo "<option value='".$datos_procesos_act[$i]['id_proc']."'>".$datos_procesos_act[$i]['nombre_proc']."</option>";
                                                }
                                               
                                            
                                            echo "</select>
                                        </div>
                                        <div class='form-group col-md-4'>
                                        <label for='NO_EMPLEADO'>Fecha de ingreso<samp
                                                    class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control datepicker-inline formato_campos_activos' id='fecha_ingreso' name='fecha_ingreso'
                                                placeholder='yyyy/mm/dd' 
                                                required>
                                    </div>
                                  
                                <div class='form-group col-md-4' id='fec_baja_reg'>
                                    <label for='NO_EMPLEADO'>Fecha de baja: <samp
                                    class='text-danger'>*</samp></label>
                                     <input type='text' class='form-control formato_campos_activos' id='fecha_baja' name='fecha_baja'
                                     placeholder='yyyy/mm/dd'
                                     onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                </div>

                                <div class='form-group col-sm-4'>
                                <label for='estatus'>Tipo de nombramiento:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select formato_campos_activos' id='tipo_nombramiento12' name='tipo_nombramiento12'>
                                    <option value='0'>Seleccionar Estatus</option>";
                                    for ($i=0; $i <count($datos_tipos_nombramiento) ; $i++) { 
                                        echo "<option value='".$datos_tipos_nombramiento[$i]['id_tipo_nombramiento']."'>".$datos_tipos_nombramiento[$i]['nombre_nombramiento']."</option>";
                                    }
                                echo"</select>
                            </div>
                            <div class='form-group col-sm-4'>
                            <label for='estatus'>Nivel jerarquico:<samp class='text-danger'>*</samp></label>
                            <select class='custom-select formato_campos_activos' id='nivel_jerar_detalle' name='nivel_jerar_detalle'>
                                <option value='0'>Seleccionar jerarquia</option>";
                                for ($i=0; $i <count($datos_nivel_jerar) ; $i++) { 
                                    echo "<option value='".$datos_nivel_jerar[$i]['id_nivel_jer']."'>".$datos_nivel_jerar[$i]['nombre_nombramiento']."</option>";
                                }
                            echo"</select>
                        </div>
                        <div class='form-group col-sm-4' id='Motivo_baj'>
                        <label for='estatus'id='texto_referencia_baj'>:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select formato_campos_activos' id='Motivo_baja_option' name='Motivo_baja_option'>
                            <option value='0'>Seleccionar Motivo</option>";
                            for ($i=0; $i <count($datos_motivos) ; $i++) { 
                                echo "<option value='".$datos_motivos[$i]['id_motivo_esp']."'>".$datos_motivos[$i]['Motivo_especial']."</option>";
                            }
                        echo"</select>
                    </div>
                               <div class='form-group col-sm-10' id='opcion_sindical'>
                                <label for='estatus'>Nombre del sindicato:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select formato_campos_activos' id='sindicato' name='sindicato'>
                                    <option value='0'>Seleccionar Estatus</option>";
                                   for ($i=0; $i <count($datos_sindicatos) ; $i++) { 
                                        echo "<option value='".$datos_sindicatos[$i]['id_sindicato']."'>".$datos_sindicatos[$i]['nombre_sindical']."</option>";
                                   }

                                echo"</select>
                            </div>
                            </div>
                            <div class='modal-footer'>";
                            echo"<button type='button' class='btn btn-secondary' id='act_tabla_inicio' data-dismiss='modal'>Cerrar</button>";
                            if ($perfil == 1 || $perfil == 5 || $perfil == 4  ) {
                                echo"<button type='button'  class='btn btn-success' id='act_us_in_datos_basicos' >Actualizar datos Basicos</button>";
                            }


                        echo"</div>
                             </div>";
                                // FIN DE DATOS BASICOS
                                // INICIO DE DATOS ADICIONALES
                                if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7) {
                                    echo"<div class='tab-pane fade' id='datos_basc_adic' role='tabpanel'
                                aria-labelledby='pills-home-tab'>
                                <div class='row container-fluid'> 
                                <div class='form-group col-sm-4'>
                                <label for='estatus'>Genero:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select formato_campos_activos' id='sex' name='sex'>
                                    <option value='0'>Seleccionar Opción</option>
                                    <option value='H'>Hombre</option>
                                    <option value='M'>Mujer</option>
                                    <option value='O'>Omitir</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-4'>
                                <label for='estatus'>Hijos:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select formato_campos_activos' id='Hijos' name='Hijos'>
                                    <option value='0'>Seleccionar Opción</option>
                                    <option value='S'>Sí</option>
                                    <option value='N'>No</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-4'>
                            <label for='estatus'>Estado civil:<samp class='text-danger'>*</samp></label>
                            <select class='custom-select formato_campos_activos' id='estado_civ' name='estado_civ'>
                                <option value='0'>Seleccionar estado</option>";
                                    for ($i=0; $i <count($datos_estados_civil) ; $i++) {
                                        echo "<option value='".$datos_estados_civil[$i]['id_estado_civil']."'>".$datos_estados_civil[$i]['nombre_estado_civil']."</option>";
                                    }
                                    echo "</select>
                        </div>
                            </div>
                            <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Escolaridad:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select formato_campos_activos ' id='Escolaridad' name='Escolaridad'>
                                        <option value='0'>Seleccionar Escolaridad</option>";
                                    for ($i=0; $i <count($datos_escolaridad) ; $i++) {
                                        echo "<option value='".$datos_escolaridad[$i]['id_escolaridad']."'>".$datos_escolaridad[$i]['nombre_escolaridad']."</option>";
                                    }
                                    echo"</select>
                                </div>
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Estatus de estudios:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select formato_campos_activos' id='estatus_esco' name='estatus_esco'>
                                        <option value='0'>Seleccionar Estatus</option>";
                                    for ($i=0; $i <count($datos_estatus_escolar) ; $i++) {
                                        echo "<option value='".$datos_estatus_escolar[$i]['id_estatus_escolaridad']."'>".$datos_estatus_escolar[$i]['nombre_estatus_escolaridad']."</option>";
                                    }
                                    echo"</select>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Carrera:</label>
                                    <input type='text' class='form-control formato_campos_activos' id='carrera' name='carrera'
                                        placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                            
                            </div>

                    

                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal' id='cerrar_modal_dat_adicio'>Cerrar</button>";
                                    if ($perfil== 1 || $perfil == 5 || $perfil == 4) {
                                        echo"<button type='button' class='btn btn-success' id='actualiza_dat_adicionales_bot' >Actualizar datos Adicionales</button>";
                                    }
                                    echo"</div>

                                </div>";
                                }
                                 // FIN DE DATOS ADICIONALES
                                //  INICIO DE AREA ASIGNADA
                               ECHO" <div class='tab-pane fade' id='datos_op' role='tabpanel'
                                    aria-labelledby='pills-profile-tab'>
                               
                                <!-- Aqui va la segunda parte -->
                                <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <div class='input-group-prepend'>
                                        <label for='id_admin'>Administración:<samp class='text-danger'>*</samp></label>
                                    </div>
                                    <select class='custom-select formato_campos_activos' id='id_admin' name='id_admin'>
                                        <option value='0'>Seleccionar Local</option>";
                                        
                                    for ($i = 0; $i < count($rows_local); $i++) {
                                        if ($rows_local[$i]["estatus"] == "A") {
                                            echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                                        }
                                    }
                                 echo"
                                    </select>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='id_sub_admin'>Subadministración:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select formato_campos_activos' id='id_sub_admin' name='id_sub_admin'>
                                        <option value='0'>Seleccionar Subadministración</option>";
                                       
                  
                                    for ($i = 0; $i < count($rows_sub); $i++) {
                                        echo "<option value='" .  $rows_sub[$i]["id_sub_admin"] . "'>" .  $rows_sub[$i]["nombre_sub_admin"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                            </div>
                  
                            <div class='form-row'>
                  
                                <div class='form-group col-md-6'>
                                    <label for='ID_DEPA'>Departamento:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select formato_campos_activos' id='ID_DEPA' name='ID_DEPA'>
                                        <option value='0'>Seleccionar Departamento</option>";
                                       
                               
                                    for ($i = 0; $i < count($rows_depto); $i++) {
                                        echo "<option value='" .  $rows_depto[$i]["id_depto"] . "'>" .  $rows_depto[$i]["nombre_depto"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='RFC_JEFE'>Jefe Directo:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select formato_campos_activos' id='RFC_JEFE' name='RFC_JEFE'>
                                        <option value='0'>Seleccionar Jefe directo</option>";
                                        
                   
                                    for ($i = 0; $i < count($rows_jefes); $i++) {
                                        if ($rows_jefes[$i]["estatus"] == "A") {
                                            echo "<option value='" .  $rows_jefes[$i]["id_empleado_plant"] . "'>" .  $rows_jefes[$i]["nombre_empleado"] . "</option>";
                                        }
                                    }
                                    echo"
                                    </select>
                                </div>
                            </div>
                           
                            <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <div class='input-group-prepend'>
                                        <label for='ID_PUESTO'>Puesto ADR:<samp class='text-danger'>*</samp></label>
                                    </div>
                                    <select class='custom-select formato_campos_activos' id='ID_PUESTO' name='ID_PUESTO'>
                                        <option value='0'>Seleccionar Puesto</option>";
                                        
                                    $rows_puestos = $mu->Consulta_Puestos_us_insu();
                                    for ($i = 0; $i < count($rows_puestos); $i++) {
                                        echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                                <div class='form-group col-md-3'>
                                <label for='NO_EMPLEADO'>Fecha del movimiento:<samp
                                            class='text-danger'>*</samp></label>
                            <input type='text' class='form-control datepicker-inline formato_campos_activos' id='fecha_mov_funcional' name='fecha_mov_funcional'
                                        placeholder='yyyy/mm/dd' 
                                        required $habilitacion>
                            </div>
                                <div class='form-group col-md-2'>
                                <div class='input-group-prepend'>
                                    <label for='confirma_gen_ofi'>Generar Oficio?:<samp class='text-danger'>*</samp></label>
                                </div>
                                <select class='custom-select formato_campos_activos' id='Si_oficio' name='Si_oficio' $habilitacion>
                                    <option value='0'>Seleccionar Puesto</option>
                                    <option value='1'>Sí</option>
                                    <option value='2'>No</option>";
                                echo"
                                </select>
                                </div>
                            
                           
                                 
                           
                            
                            
                            <div class='row container' style='display:none;' id='Bloque_genera_tipo_oficio'>
                            <div class='col-md-12 mt-3 my-3'><n>DATOS PARA GENERAR OFICIOS:</n></div>
                          
                            
                            <div class='form-group col-md-3'>
                                    <label for='NO_EMPLEADO'>No. de Oficio:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control formato_campos_activos' id='no_oficio' name='no_oficio'
                                        placeholder='0001' maxlength='11' onkeypress='return numero(event)'$habilitacion>
                            </div>
                            <div class='form-group col-md-6'>
                            <div class='input-group-prepend'>
                                <label for='confirma_gen_ofi'>Tipo de Oficio?:<samp class='text-danger'>*</samp></label>
                            </div>
                            <select class='custom-select formato_campos_activos' id='tipo_ofifcio' name='tipo_ofifcio' $habilitacion>
                                <option value='0'>Seleccionar Tipo de Oficio</option>
                                <option value='1'>ASIGNACION</option>
                               ";
                            echo"
                            </select>
                       
                        </div>
                        <div class='form-group col-md-3'>
                        <label for='NO_EMPLEADO'>Fecha de Oficio:<samp
                                    class='text-danger'>*</samp></label>
                    <input type='text' class='form-control datepicker-inline formato_campos_activos' id='fecha_de_oficio' name='fecha_de_oficio'
                                placeholder='yyyy/mm/dd' 
                                required $habilitacion>
                    </div>
                            </div>
                            </div>
                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal' id='cerrar_modal_dat_area'>Cerrar</button>";
                            if ($perfil== 1 || $perfil == 5 || $perfil == 4) {
                                echo"<button type='button' class='btn btn-success' id='actualiza_area_asig'>Actualizar Area asignada</button>";

                            }
                        echo"</div>
                                </div>";
                                //  FIN DE AREA ASIGNADA
                                       //  INICIO DE ESTRUCTURA FUNCIONAL
                                if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7) {
                                    echo" <div class='tab-pane fade' id='datos_fun' role='tabpanel'
                                    aria-labelledby='pills-contact-tab'>
                        
                                   
                                    <div class='container-fluid'>
                                    <div class='container-fluid' >
                                    <div class='row container-fluid' >
                                    <div class = col-md-6>
                                    <h3>
                                    Datos de Plaza actual
                                    </h3>
                                    </div>
                                    <div class = col-md-6>";
                                    if ($perfil== 1 || $perfil== 5) {
                                        echo"<label for='estatus'>Proceso a realizar:<samp
                                        class='text-danger'>*</samp></label>
                                <select class='custom-select formato_campos_activos' id='estatus_plazas_act' name='estatus_plazas_act'>
                                    <option value='0'>Seleccionar Estatus</option>";
                                        for ($i=0; $i <count($datos_procesos_act_plaz) ; $i++) {
                                            echo "<option value='".$datos_procesos_act_plaz[$i]['id_proc']."'>".$datos_procesos_act_plaz[$i]['nombre_proc']."</option>";
                                        }
                                   
                                
                                        echo "</select>";
                                    }
     
                                    echo" </div>
                                    </div>
                                    </div>
                                    <div class='row container-fluid '>
                                    <div class='form-group col-sm-4'>
                                            <label for='estatus'>Posición o plaza asignada:<samp class='text-danger'>*</samp></label>
                                            <input type='text' disabled class='form-control formato_campos_activos' id='posision' name='posision'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                        </div>
                                        <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Nivel:</label>
                                        <input type='text' disabled class='form-control formato_campos_activos'  id='nivel' name='nivel'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Clave Presupuestal:</label>
                                        <input type='text' disabled class='form-control formato_campos_activos' id='clave_pres2' name='clave_pres2'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    </div>
                                    <div class='row container-fluid'>
                            
                                    <div class='form-group col-sm-8'>
                                        <label for='estatus'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                                        <input type='text' disabled class='form-control formato_campos_activos' id='Puesto_fump' name='Puesto_fump'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Clave Puesto:</label>
                                    <input type='text' disabled class='form-control formato_campos_activos' id='clav_puesto' name='clav_puesto'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                                    
                               
                                
                                </div>
                                <div class='row container-fluid'>
                              
                                <div class='col-md-4 '>
                                <label for='validationServer02'>Sueldo Neto: <samp class='text-danger'>*</samp></label>
                                <input class='form-control formato_campos_activos' name='sueldo_neto' id='sueldo_neto' value='$'
                                data-inputmask-alias='numeric' data-inputmask-groupSeparator=',' data-inputmask-digits=2
                                data-inputmask-digitsOptional=false data-inputmask-prefix='$ '
                                data-inputmask-placeholder='0' placeholder='$ 0.00 MXM' > 
                            </div>
                            
                            </div>
                                <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
                                    <input type='text' disabled class='form-control formato_campos_activos' id='plaza_jefe' name='plaza_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Clave Puesto Jefe:</label>
                                <input type='text' disabled class='form-control formato_campos_activos' id='clav_puesto_jefe' name='clav_puesto_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                            <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Nombre de Jefe directo:</label>
                                <input type='text' disabled class='form-control formato_campos_activos' id='nombre_jefe' name='nombre_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                                                            
                            </div>
                            
                            </div>
                            <div class='container-fluid' id='democion_promocion' style='display:none;' >
                            <div class='container-fluid' >
                            <h3>
                            Datos de Plaza tentativa
                            </h3>
                            </div>
                                    <div class='row container-fluid '>
                                    <div class='form-group col-sm-4'>
                                            <label for='estatus'>Posición o plaza asignada:<samp class='text-danger'>*</samp></label>
                                            <select class='custom-select formato_campos_activos' id='posision_ten' name='posision_ten'>
                                                <option value='0'>Seleccionar Posición</option>";
                                    for ($i=0; $i < count($datos_plaza) ; $i++) {
                                        echo"<option value='".$datos_plaza[$i]['id_posision']."'>".$datos_plaza[$i]['id_num_posision']."</option>";
                                    }
                                               
                                                
                                    echo" </select>
                                        </div>
                                        <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Nivel:</label>
                                        <input type='text' disabled class='form-control formato_campos_activos' id='nivel_ten' name='nivel_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Clave Presupuestal:</label>
                                        <input type='text' disabled class='form-control formato_campos_activos' id='clave_pres2_ten' name='clave_pres2_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    </div>
                                    <div class='row container-fluid'>
                            
                                    <div class='form-group col-sm-8'>
                                        <label for='estatus'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                                        <input type='text' disabled class='form-control formato_campos_activos' id='Puesto_fump_ten' name='Puesto_fump_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Clave Puesto:</label>
                                    <input type='text' disabled class='form-control formato_campos_activos' id='clav_puesto_ten' name='clav_puesto_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                                    
                               
                                
                                </div>
                                <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
                                    <input type='text' disabled class='form-control formato_campos_activos' id='plaza_jefe_ten' name='plaza_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Clave Puesto Jefe:</label>
                                <input type='text' disabled class='form-control formato_campos_activos' id='clav_puesto_jefe_ten' name='clav_puesto_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                            <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Nombre de Jefe directo:</label>
                                <input type='text' disabled class='form-control formato_campos_activos' id='nombre_jefe_ten' name='nombre_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                                                            
                            </div>
                            </div>

                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' id='cerrar_mod_actualiza_plazas' data-dismiss='modal'>Cerrar</button>";
                                    if ($perfil== 1 || $perfil == 5 || $perfil == 4) {
                                        echo"<button type='button' class='btn btn-success' id='actualiza_plazas'>Actualizar estructura Central</button>";
                                    }
                                    echo"</div>
                                </div>
                                ";
                                }
                                 //  FIN DE ESTRUCTURA FUNCIONAL
                          ECHO"  </div>
                             </div>";
                                  //  FIN DE DATOS GENERALES
                                  //  INICIO DE REGISTRO DE MOVIMIENTOS
                        ECHO"<div class='tab-pane fade' id='MOVIMIENTOS' role='tabpanel' aria-labelledby='nav-profile-tab'>
                            <div id='caja_mov_personal_insumo' class='vh-50'>
                            
                            </div>

                        </div>";
                         //  FIN DE REGISTRO DE MOVIMIENTOS
                         //  INICIO DE ACCESO A SISTEMAS
                         ECHO" <div class='tab-pane fade' id='SISTEMAS' role='tabpanel' aria-labelledby='nav-sistemas-tab'>
                            <div class=' Arreglos'></div>




                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <button type='button' class='btn btn-success'>Actualizar</button>
                        </div>
                        </div>";
                        //  FIN DE ACCESO A SISTEMAS
                        //  INICIO DE REGISTRO DE DOCUMENTOS FIRMADOS/RESPONSIVAS/CAMBIOS DE NOMBRAMIENTOS
                        if ($perfil == 1 || $perfil == 4 || $perfil == 5|| $perfil == 7) {
                            echo" <div class='tab-pane fade' id='RESPONSIVAS' role='tabpanel' aria-labelledby='nav-Oficios_his-tab'>
                            ";
                            if ($perfil == 1 || $perfil == 4 || $perfil == 5) {
                                echo"<div class='container' >
                            <button class='btn btn-outline-success' id='Agregar_oficio_nuevo' >Cargar documento <i class='fas fa-folder-plus' ></i> </button>
                            </div>";
                            }
                            
                            echo"<div id='caja_oficios_historial_ins' class='vh-50 mt-3 my-3'>
                            </div>





                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            
                        </div>
                        </div>";
                        }
                          //  FIN DE ACCESO A SISTEMAS
                    ECHO"</div>

                </div>



            </div>
         
        </div>
    </div>
</div>";


// Modal para agregar usuarios a la plantilla de activos

// Modal para confirmar accion de aactualizacion de datos basicos

echo "<div class='modal fade bd-example-modal-xl' tabindex='-1' id='agregar_user_insumo' role='dialog' aria-hidden='true'>
<div class='modal-dialog modal-xl'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Agregar empleado</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <div class='modal-body'>
            <div class='container-fluid' id='contenido'>
       

                          <ul class='nav nav-pills mb-3' id='pills-tab' role='tablist'>
                              <li class='nav-item'>
                                  <a class='nav-link active' id='pills-home-tab' data-toggle='pill' href='#datos_basc_add'
                                      role='tab' aria-controls='pills-home' aria-selected='true'>Datos Basicos</a>
                              </li>
                              <li class='nav-item'>
                                  <a class='nav-link' id='pills-home-tab' data-toggle='pill' href='#datos_basc_adic_add'
                                      role='tab' aria-controls='pills-home' aria-selected='true'>Datos adicionales</a>
                              </li>
                              <li class='nav-item'>
                                  <a class='nav-link' id='pills-profile-tab' data-toggle='pill' href='#datos_op_add'
                                      role='tab' aria-controls='pills-profile' aria-selected='false'>Estructura Funcional</a>
                              </li>
                              <li class='nav-item'>
                                  <a class='nav-link' id='pills-contact-tab' data-toggle='pill' href='#datos_fun_add'
                                      role='tab' aria-controls='pills-contact' aria-selected='false'>Estructura Central</a>
                              </li>
                          </ul>";
                          // FIN DE EL MENU
                          ECHO "<div class='tab-content' id='pills-tabContent'>";
                          
                          // INICIO DE DATOS BASICOS
                           echo"   <div class='tab-pane fade show active' id='datos_basc_add' role='tabpanel'
                                  aria-labelledby='pills-home-tab'>
                                <form class='form_example'>
                                
                                <div class='form-row'>
                                <div class='form-group col-md-3'>

                                    <label for='RFC_CORTO'>CURP:<samp class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='CURP2_Add' name='CURP2_Add'
                                        placeholder='XXXX4548' maxlength='18' min='18' required
                                        onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                </div>
                                <div class='form-group col-md-3'>

                                    <label for='RFC_CORTO'>RFC con Homoclave:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='RFC_COMP_add' name='RFC_COMP_add'
                                        placeholder='XXXX4548' maxlength='13' min='13' required
                                        onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                </div>
                                <div class='form-group col-md-3'>

                                    <label for='RFC_CORTO'>RFC Corto:<samp class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='RFC_CORTO_add' name='RFC_CORTO_add'
                                        placeholder='XXXX4548' maxlength='9' min='8' required
                                        onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                </div>
                                <div class='form-group col-md-3'>
                                    <label for='NO_EMPLEADO'>No. de Empleado:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='NO_EMPLEADO_add' name='NO_EMPLEADO_add'
                                        placeholder='123265' maxlength='6' onkeypress='return numero(event)'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-4'>
                                    <label for='NOMBRE'>Nombre(s):<samp class='text-danger'>*</samp></label>
                                    <input type=' text' class='form-control letras' id='NOMBRE_add' name='NOMBRE_add'
                                        placeholder='Juan Pérez' required
                                        onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                </div>
                                <div class='form-group col-md-4'>
                                    <label for='NO_EMPLEADO'>Apellido Paterno:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='APELLIDO_P_add' name='APELLIDO_P_add'
                                        placeholder='López'
                                        onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                </div>
                                <div class='form-group col-md-4'>
                                    <label for='NO_EMPLEADO'>Apellido Materno:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='APELLIDO_M_add' name='APELLIDO_M_add'
                                        placeholder='Mares'
                                        onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <label for='CORREO'>Correo Institucional:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='email' class='form-control' id='CORREO_add' name='CORREO_add'
                                        placeholder='xxxx@dssat.sat.gob.mx'>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='CORREO'>Correo Personal:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='email' class='form-control' id='CORREO_P_add' name='CORREO_P_add'
                                        placeholder='xxxx@gmail.com'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-4'>
                                    <label for='CORREO'>Número personal:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='num_1_add' name='num_1_add'
                                        placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                        onkeypress='return numero(event)'>
                                </div>
                                <div class='form-group col-md-4'>
                                    <label for='CORREO'>Número adicional:<samp
                                            class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='num_2_add' name='num_2_add'
                                        placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                        onkeypress='return numero(event)'>
                                </div>
                                <div class='form-group col-md-4'>
                                    <label for='CORREO'>Ext.Tel.:<samp class='text-danger'></samp></label>
                                    <input type='email' class='form-control' id='ext_tel_add' name='ext_tel_add'
                                        placeholder='Ejem: 42726' maxlength='5' minlength='5'
                                        onkeypress='return numero(event)'>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='form-group col-md-4'>
                                    <label for='estatus'>Estatus de actividad:<samp
                                            class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='estatus_add' name='estatus_add'>
                                        <option value='0' selected>Seleccionar Estatus</option>";
                                        for ($i=0; $i <count($datos_procesos_act) ; $i++) { 
                                            echo "<option value='".$datos_procesos_act[$i]['id_proc']."'>".$datos_procesos_act[$i]['nombre_proc']."</option>";
                                        }
                                       
                                    
                                    echo "</select>
                                </div>
                                <div class='form-group col-md-4'>
                                        <label for='NO_EMPLEADO'>Fecha de ingreso<samp
                                                    class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control datepicker-inline' id='fecha_ingreso_add' name='fecha_ingreso_add'
                                                placeholder='yyyy/mm/dd' 
                                                required>
                                    </div>
                                <div class='form-group col-md-4' style='display:none;' id='fec_baja_reg_add'>
                                    <label for='NO_EMPLEADO'>Fecha de baja: <samp
                                    class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control' id='fecha_baja_add' name='fecha_baja_add'
                                    placeholder='dd/mm/yyyy'
                                    onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                </div>

                                <div class='form-group col-md-4'>
                                <label for='archvioID' class='custom-file-label'>Foto del empleado:<samp class='text-danger'>*</samp></label>
                                <input type='file' class='custom-file-input' id='archvioID' name='archvioID' accept='image/jpg' placeholder='No.empleado.jpg'>                        
                                </div>
                            </div>
                        </form>
                        <div class=' row'>
                        <div class='form-group col-sm-4'>
                        <label for='estatus'>Tipo de nombramiento:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='tipo_nombramiento12_add' name='tipo_nombramiento12_add'>
                            <option value='0'>Seleccionar estatus</option>";
                            for ($i=0; $i <count($datos_tipos_nombramiento) ; $i++) { 
                                echo "<option value='".$datos_tipos_nombramiento[$i]['id_tipo_nombramiento']."'>".$datos_tipos_nombramiento[$i]['nombre_nombramiento']."</option>";
                            }
                        echo"</select>
                    </div>
                    <div class='form-group col-sm-4'>
                    <label for='estatus'>Nivel Jerarquico:<samp class='text-danger'>*</samp></label>
                    <select class='custom-select' id='nivel_jerarquico_add' name='nivel_jerarquico_add'>
                        <option value='0'>Seleccionar Estatus</option>";
                        for ($i=0; $i <count($datos_nivel_jerar) ; $i++) { 
                            echo "<option value='".$datos_nivel_jerar[$i]['id_nivel_jer']."'>".$datos_nivel_jerar[$i]['nombre_nombramiento']."</option>";
                        }
                    echo"</select>
                </div>
                    </div>
                       <div class='form-group col-sm-10'  id='opcion_sindical'>
                        <label for='estatus'>Nombre del sindicato:<samp class='text-danger'>*</samp></label>
                        <select class='custom-select' id='sindicato_add' name='sindicato_add'>
                            <option value='0'>Seleccionar Estatus</option>";
                           for ($i=0; $i <count($datos_sindicatos) ; $i++) { 
                                echo "<option value='".$datos_sindicatos[$i]['id_sindicato']."'>".$datos_sindicatos[$i]['nombre_sindical']."</option>";
                           }

                        echo"</select>
                    </div>
                      
                    
                         
                           </div>";
                              // FIN DE DATOS BASICOS
                              // INICIO DE DATOS ADICIONALES
                              ECHO"<div class='tab-pane fade' id='datos_basc_adic_add' role='tabpanel'
                              aria-labelledby='pills-home-tab'>
                              <div class='row container-fluid'> 
                              <div class='form-group col-sm-4'>
                              <label for='estatus'>Genero:<samp class='text-danger'>*</samp></label>
                              <select class='custom-select' id='sex_add' name='sex_add'>
                                  <option value='0' selected>Seleccionar Opción</option>
                                  <option value='H'>Hombre</option>
                                  <option value='M'>Mujer</option>
                                  <option value='O'>Omitir</option>
                              </select>
                          </div>
                          <div class='form-group col-sm-4'>
                              <label for='estatus'>Hijos:<samp class='text-danger'>*</samp></label>
                              <select class='custom-select' id='Hijos_add' name='Hijos_add'>
                                  <option value='0' selected>Seleccionar Opción</option>
                                  <option value='S'>Sí</option>
                                  <option value='N'>No</option>
                              </select>
                          </div>
                          <div class='form-group col-sm-4'>
                          <label for='estatus'>Estado civil:<samp class='text-danger'>*</samp></label>
                          <select class='custom-select' id='estado_civ_add' name='estado_civ_add'>
                              <option value='0' selected>Seleccionar estado</option>";
                              for ($i=0; $i <count($datos_estados_civil) ; $i++) { 
                                echo "<option value='".$datos_estados_civil[$i]['id_estado_civil']."'>".$datos_estados_civil[$i]['nombre_estado_civil']."</option>";
                           }
                          ECHO"</select>
                      </div>
                          </div>
                          <div class='row container-fluid'>
                          
                              <div class='form-group col-sm-4'>
                                  <label for='estatus'>Escolaridad:<samp class='text-danger'>*</samp></label>
                                  <select class='custom-select' id='Escolaridad_add' name='Escolaridad_add'>
                                      <option value='0' selected>Seleccionar Escolaridad</option>";
                                      for ($i=0; $i <count($datos_escolaridad) ; $i++) { 
                                        echo "<option value='".$datos_escolaridad[$i]['id_escolaridad']."'>".$datos_escolaridad[$i]['nombre_escolaridad']."</option>";
                                   }
                                  echo"</select>
                              </div>
                              <div class='form-group col-sm-4'>
                                  <label for='estatus'>Estatus de estudios:<samp class='text-danger'>*</samp></label>
                                  <select class='custom-select' id='estatus_esco_add' name='estatus_esco_add'>
                                      <option value='0' selected>Seleccionar Estatus</option>";
                                      for ($i=0; $i <count($datos_estatus_escolar) ; $i++) { 
                                        echo "<option value='".$datos_estatus_escolar[$i]['id_estatus_escolaridad']."'>".$datos_estatus_escolar[$i]['nombre_estatus_escolaridad']."</option>";
                                   }
                                  echo"</select>
                              </div>
                              <div class='form-group col-sm-4' id='asdas'>
                                  <label for='estatus'>Carrera:</label>
                                  <input type='text' class='form-control' id='carrera_add' name='carrera_add'
                                      placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                      required>
                              </div>
                          
                          </div>

                  

                         

                              </div>";
                               // FIN DE DATOS ADICIONALES
                              //  INICIO DE AREA ASIGNADA
                             ECHO" <div class='tab-pane fade' id='datos_op_add' role='tabpanel'
                                  aria-labelledby='pills-profile-tab'>
                             
                              <!-- Aqui va la segunda parte -->
                              <div class='form-row'>
                              <div class='form-group col-md-6'>
                                  <div class='input-group-prepend'>
                                      <label for='id_admin'>Administración:<samp class='text-danger'>*</samp></label>
                                  </div>
                                  <select class='custom-select' id='id_admin_add' name='id_admin_add'>
                                      <option value='0' selected>Seleccionar Local</option>";
                                      
                                  for ($i = 0; $i < count($rows_local); $i++) {
                                      if ($rows_local[$i]["estatus"] == "A") {
                                          echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                                      }
                                  }
                               echo"
                                  </select>
                              </div>
                              <div class='form-group col-md-6'>
                                  <label for='id_sub_admin'>Subadministración:<samp class='text-danger'>*</samp></label>
                                  <select class='custom-select' id='id_sub_admin_add' name='id_sub_admin_add'>
                                      <option value='0'selected>Seleccionar Subadministración</option>";
                                     
                
                                  for ($i = 0; $i < count($rows_sub); $i++) {
                                      echo "<option value='" .  $rows_sub[$i]["id_sub_admin"] . "'>" .  $rows_sub[$i]["nombre_sub_admin"] . "</option>";
                                  }
                                  echo"
                                  </select>
                              </div>
                          </div>
                
                          <div class='form-row'>
                
                              <div class='form-group col-md-6'>
                                  <label for='ID_DEPA'>Departamento:<samp class='text-danger'>*</samp></label>
                                  <select class='custom-select' id='ID_DEPA_add' name='ID_DEPA_add'>
                                      <option value='0' selected>Seleccionar Departamento</option>";
                                     
                             
                                  for ($i = 0; $i < count($rows_depto); $i++) {
                                      echo "<option value='" .  $rows_depto[$i]["id_depto"] . "'>" .  $rows_depto[$i]["nombre_depto"] . "</option>";
                                  }
                                  echo"
                                  </select>
                              </div>
                              <div class='form-group col-md-6'>
                                  <label for='RFC_JEFE'>Jefe Directo:<samp class='text-danger'>*</samp></label>
                                  <select class='custom-select' id='RFC_JEFE_add' name='RFC_JEFE_add'>
                                      <option value='0'selected>Seleccionar Jefe directo</option>";
                                      
                 
                                  for ($i = 0; $i < count($rows_jefes); $i++) {
                                      if ($rows_jefes[$i]["estatus"] == "A") {
                                          echo "<option value='" .  $rows_jefes[$i]["id_empleado_plant"] . "'>" .  $rows_jefes[$i]["nombre_empleado"] . "</option>";
                                      }
                                  }
                                  echo"
                                  </select>
                              </div>
                          </div>
                         
                          <div class='form-row'>
                              <div class='form-group col-md-6'>
                                  <div class='input-group-prepend'>
                                      <label for='ID_PUESTO'>Puesto ADR:<samp class='text-danger'>*</samp></label>
                                  </div>
                                  <select class='custom-select' id='ID_PUESTO_add' name='ID_PUESTO_add'>
                                      <option value='0' selected>Seleccionar Puesto</option>";
                                      
                                  $rows_puestos = $mu->Consulta_Puestos_us_insu();
                                  for ($i = 0; $i < count($rows_puestos); $i++) {
                                      echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                                  }
                                  echo"
                                  </select>
                              </div>
                          </div>
                         
                              </div>";
                              //  FIN DE AREA ASIGNADA
                                     //  INICIO DE ESTRUCTURA FUNCIONAL
                             ECHO" <div class='tab-pane fade' id='datos_fun_add' role='tabpanel'
                                  aria-labelledby='pills-contact-tab'>
                                  <div class='row container-fluid '>
                                  <div class='form-group col-sm-4'>
                                          <label for='estatus'>Posición o plaza asignada:<samp class='text-danger'>*</samp></label>
                                         <datalist id='opciones'>
                                         </datalist>
                                         <input  id='posision_add' class='form-control'  list='opciones' name='opciones' type='text'>
                                      </div>
                                      <div class='form-group col-sm-4' id='asdas'>
                                      <label for='estatus'>Nivel:</label>
                                      <input type='text'  class='form-control' id='nivel_add' name='nivel_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                          required>
                                  </div>
                                  <div class='form-group col-sm-4' id='asdas'>
                                      <label for='estatus'>Clave Presupuestal:</label>
                                      <input type='text'  class='form-control' id='clave_pres_add' name='clave_pres_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                          required>
                                  </div>
                                  </div>
                                  <div class='row container-fluid'>
                          
                                  <div class='form-group col-sm-8'>
                                      <label for='estatus'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                                      <input type='text'  class='form-control' id='Puesto_fump_add' name='Puesto_fump_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                      required>
                                  </div>
                                  <div class='form-group col-sm-4' id='asdas'>
                                  <label for='estatus'>Clave Puesto:</label>
                                  <input type='text'  class='form-control' id='clav_puesto_add' name='clav_puesto_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                      required>
                              </div>
                                  
                             
                              
                              </div>
                              <div class='col-md-4 '>
                              <label for='validationServer02'>Sueldo Neto: <samp class='text-danger'>*</samp></label>
                              <input class='form-control' name='sueldo_neto_add' id='sueldo_neto_add' value='$'
                              data-inputmask-alias='numeric' data-inputmask-groupSeparator=',' data-inputmask-digits=2
                              data-inputmask-digitsOptional=false data-inputmask-prefix='$ '
                              data-inputmask-placeholder='0' placeholder='$ 0.00 MXM' > 
                          </div>

                              <div class='row container-fluid'>
                          
                              <div class='form-group col-sm-4'>
                                  <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
                                  <input type='text'  class='form-control' id='plaza_jefe_add' name='plaza_jefe_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                  required>
                              </div>
                              <div class='form-group col-sm-4' id='asdas'>
                              <label for='estatus'>Clave Puesto Jefe:</label>
                              <input type='text'  class='form-control' id='clav_puesto_jefe_add' name='clav_puesto_jefe_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                  required>
                          </div>
                          <div class='form-group col-sm-4' id='asdas'>
                              <label for='estatus'>Nombre de Jefe directo:</label>
                              <input type='text'  class='form-control' id='nombre_jefe_add' name='nombre_jefe_add'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                  required>
                          </div>
                                                          
                          </div>

                              <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                              <button type='button' class='btn btn-primary' id='registrar_us_ins'>Agregar Empleado</button>
                            </div>
                              </div>
                              ";
                               //  FIN DE ESTRUCTURA FUNCIONAL
                        ECHO"  </div>
            </div>

        </div>

    </div>
</div>
</div>";
// ------------- Modal para editar oficios-----------------------//
echo"<div class='modal fade bd-example-modal-lg' id='Modal_editor_documento_oficios' tabindex='-1' role='dialog' aria-labelledby='Modal_editor_documento_oficios' aria-hidden='true'>
<div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
  <div class='modal-content'>
    <div class='modal-header'>
      <h5 class='modal-title' id='exampleModalCenterTitle'>Carga Oficio</h5>
      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <div class='modal-body'>
    <div class='row container'>
                            <div class='col-md-12 mt-3 my-3'><n>DATOS PARA RETROALIMENTAR OFICIOS:</n></div>
                          
                            
                            <form class= 'form_example_asigna'>
                            <div class='form-group'>
                              <label for='exampleFormControlFile1'>Seleccione el documento:</label>
                              <input type='file' class='form-control-file' id='carga_oficio_firm_asig' name='carga_oficio_firm_asig'>
                            </div>
                          </form>
                        <div class='form-group col-md-3'>
                        <label for='NO_EMPLEADO'>Fecha de Oficio:<samp
                                    class='text-danger'>*</samp></label>
                    <input type='text' class='form-control datepicker-inline formato_campos_activos' id='fecha_de_oficio_editar' name='fecha_de_oficio_editar'
                                placeholder='yyyy/mm/dd' 
                                required $habilitacion>
                             </div>
                            </div>
    </div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-secondary' id='cerrar_modal_editor_oficios' data-dismiss='modal'>Close</button>
      <button type='button' class='btn btn-primary' id='carga_documento_oficio_firmado_asig' >Carga documento</button>
    </div>
  </div>
</div>
</div>




";

//---------------Fin Modal Editor de Oficios---------------------//

//----------------------------------MODAL CAMBIO DE FOTOS----------------------------//

echo"
<div class='modal fade' id='Muestra_modal_cambios_fotos' tabindex='-1' role='dialog' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
  <div class='modal-header'>
    <h5 class='modal-title' id='titulos'>Subir Foto</h5>
    <button type='button' class='close' data-dismiss='modal'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>
  <div class='modal-body'>
  <form class='formulario_cambia_foto'>
  <div class='form-group'>
    <label for='exampleFormControlFile1'>Selecciona la foto:</label>
    <input type='file' class='form-control-file' id='Foto_nueva' name='Foto_nueva'>
  </div>
</form>
  </div>
  <div class='modal-footer'>
    <button type='button' class='btn btn-secondary' id='cerrar_modal_foto' data-dismiss='modal'>Cancelar</button>
    <button type='button' class='btn btn-success' id='subir_foto' >Carga Foto</button>
  </div>
</div>
</div>
</div>
";


//----------------------------------FIN MODAL CAMBIO DE FOTOS------------------------//

//----------------------------------MODAL DE OFICIOS NUEVOS--------------------------//
echo "<div class='modal fade bd-example-modal-xl' tabindex='-1' role='dialog' id='oficio_nuevo_modal' aria-hidden='true'>
<div class='modal-dialog modal-dialog-centered modal-xl'>
  <div class='modal-content'>
  <div class='modal-header'>
  <h5 class='modal-title' id='titulos'>Carga nuevo Oficio</h5>
  <button type='button' class='close' data-dismiss='modal'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
<div class='modal-body'>

<form class='Formato_oficios_nuevos'>
  <div class='form-row'>
  <div class='form-group col-md-4'>
  <label for='inputState'>Tipo de Oficio</label>
  <select id='Tipo_de_oficio' class='form-control'>
    <option value='0' selected>Selecciona Tipo...</option>";
            for ($i=0; $i <count($datos_tipos_oficios) ; $i++) { 
                echo"<option value='".$datos_tipos_oficios[$i]['id_tipo_of']."' selected>".$datos_tipos_oficios[$i]['Descripcion']."</option>";
            }                
  echo"</select>
</div>
<div class='form-group col-md-2'>
    <label for='inputEmail4'>Omitir Oficio?</label>
    <div class='custom-control custom-switch'>
    <input type='checkbox' class='custom-control-input' id='Selecciona_Opicion'>
    <label class='custom-control-label' for='Selecciona_Opicion'>Sí</label>
    </div>
    </div>

    <div class='form-group col-md-2' >
      <label for='inputEmail4'>No. Oficio</label>
      <input type='text' class='form-control'  id='No_oficio_nuevo' name='No_oficio_nuevo' placeholder='002'>
    </div>
    <div class='form-group col-md-2'>
      <label for='inputEmail4'>Fecha Doc.</label>
      <input type='text' class='form-control' id='fecha_oficio_doc'>
    </div>
    
   
    <div class='form-group col-md-2'>
      <label for='inputZip'>Adjuntar Archivo</label>
      <input type='file' class='form-control-flie' id='documento_nuevo_oficio'>
    </div>
  </div>
  
  
</form>

</div>
<div class='modal-footer'>
  <button type='button' class='btn btn-secondary' id='Cerrar_mod_oficio_nuevo' data-dismiss='modal'>Cancelar</button>
  <button type='button' class='btn btn-success' id='revisa_datos_oficio' >Carga Documento</button>
</div>
  </div>
</div>
</div>
";
   }

   public function Modal_posisiones(){
       include_once 'ConsultaADR.php';
       include_once 'MetodosUsuarios.php';
       $mu = new ConsultaInfoADR();
       $mu = new MetodosUsuarios();
       $datos_procesos_act_plaz = $mu->estados_plaza_mante();
       echo "<div class='modal fade bd-example-modal-xl' tabindex='-1' id='Agregar_posisones_nuevas' role='dialog'
       aria-hidden='true'>
       <div class='modal-dialog modal-xl'>
           <div class='modal-content'>
               <div class='modal-header'>
                   <h5 class='modal-title' id='exampleModalLabel'>Agregar Posición</h5>
                   <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                   </button>
               </div>
               <div class='modal-body'>";
              echo" <div class='row container-fluid '>
               <div class='form-group col-sm-4'>
                       <label for='estatus'>Posición o plaza:<samp class='text-danger'>*</samp></label>
                   
                      <input  id='New_posision' class='form-control' maxlength='8'  name='New_posision' type='text' onkeypress='return numero(event)' placeholder='Ejem: 103XXXXX'>
                   </div>
                   <div class='form-group col-sm-4' id='asdas'>
                   <label for='estatus'>Nivel:</label>
                   <input type='text'  class='form-control' id='New_nivel_add' name='New_nivel_add'  maxlength='4'  placeholder='Ejem: P12' onkeyup='javascript:this.value=this.value.toUpperCase();'
                       required>
               </div>
               <div class='form-group col-sm-4' id='asdas'>
                   <label for='estatus'>Clave Presupuestal:</label>
                   <input type='text'  class='form-control' id='New_clave_pres_add' maxlength='10' name='New_clave_pres_add'  placeholder='Ejem: T12804' onkeyup='javascript:this.value=this.value.toUpperCase();'
                       required>
               </div>
               </div>
               <div class='row container-fluid'>
       
               <div class='form-group col-sm-8'>
                   <label for='estatus New_Puesto_fump_add' >Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                   <select class='custom-select' id='New_Puesto_fump_add' name='New_Puesto_fump_add'>
                   <option value='0' selected>Seleccionar Puesto</option>";
                   
               $rows_puestos = $mu->Consulta_Puestos_Fun();
               for ($i = 0; $i < count($rows_puestos); $i++) {
                   echo "<option value='" .  $rows_puestos[$i]["id_puesto_fump"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
               }
               echo"
               </select>
               </div>
               <div class='form-group col-sm-4' id='asdas'>
               <label for='estatus'>Clave Puesto:</label>
               <input type='text' DISABLED class='form-control' id='New_clav_puesto_add' name='New_clav_puesto_add'  placeholder='Ejem:RE6025' onkeyup='javascript:this.value=this.value.toUpperCase();'
                   required>
           </div>
               
          
           
           </div>
           <div class='row container-fluid'>
           <div class='col-md-4 '>
           <label for='validationServer02'>Sueldo Neto: <samp class='text-danger'>*</samp></label>
           <input class='form-control' name='New_sueldo_neto' id='New_sueldo_neto' value='$'
           data-inputmask-alias='numeric' data-inputmask-groupSeparator=',' data-inputmask-digits=2
           data-inputmask-digitsOptional=false data-inputmask-prefix='$ '
           data-inputmask-placeholder='0' placeholder='$ 0.00 MXM' > 


 
       </div>
       <div class='form-group col-sm-4'>
       <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
       <input type='text'  class='form-control' id='New_plaza_jefe' maxlength='8' name='New_plaza_jefe'  placeholder='Ejem: 103XXXXX' onkeypress='return numero(event)'
       required>
   </div>
   </div>";
                   echo"
               </div>
               <div class='modal-footer'>
                   <button type='button' class='btn btn-secondary' data-dismiss='modal'
                       id='cerrar_mod_agrega_pososion'>Cerrar</button>
                   <button type='button' class='btn btn-primary' id='registra_posison'>Registrar Posissión</button>
               </div>
           </div>
       </div>
   
   </div>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////MODAL DE INFORMACION DE LA POSISION//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   echo"
   <div class='modal fade bd-example-modal-xl' id='modal_info_posision' tabindex='-1' role='dialog' aria-labelledby='exampleModalScrollableTitle' aria-hidden='true'>
  <div class='modal-dialog modal-xl' role='document'>
    <div class='modal-content'>
    <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalScrollableTitle'>Informacion detalla da de la Posición</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////MENU DE NAVEGACION INFO/HISTORIAL/COMENTARIOS//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 


    echo"<ul class='nav nav-pills mb-3' id='pills-tab' role='tablist'>
  <li class='nav-item'>
    <a class='nav-link active' id='Nav_posision_info' data-toggle='pill' href='#informes_plaz' role='tab' aria-controls='pills-home' aria-selected='true'>Información</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' id='Nav_posision_mov' data-toggle='pill' href='#Moviemientos_plaz' role='tab' aria-controls='pills-profile' aria-selected='false'>Movimientos</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link' id='Nav_posision_com' data-toggle='pill' href='#Comentarios_plaz' role='tab' aria-controls='pills-contact' aria-selected='false'>Comentarios</a>
  </li>
</ul>";


      echo "


      <div class='tab-content' id='pills-tabContent'>";
//INFORMES PLAZA
     echo" <div class='tab-pane fade show active' id='informes_plaz' role='tabpanel' aria-labelledby='pills-home-tab'>
     <div class='row container-fluid '>
     <div class='form-group col-sm-4'>
         <label for='estatus'>Posición o plaza:<samp class='text-danger'>*</samp></label>
 
         <input id='pos_posision' class='form-control' maxlength='8' name='pos_posision' type='text'
             onkeypress='return numero(event)' placeholder='Ejem: 103XXXXX'>
     </div>
     <div class='form-group col-sm-4' id='asdas'>
         <label for='estatus'>Nivel:</label>
         <input type='text' class='form-control' id='pos_nivel_add' name='pos_nivel_add' maxlength='4'
             placeholder='Ejem: P12' onkeyup='javascript:this.value=this.value.toUpperCase();' required>
     </div>
     <div class='form-group col-sm-4' id='asdas'>
         <label for='estatus'>Clave Presupuestal:</label>
         <input type='text' class='form-control' id='pos_clave_pres_add' maxlength='10' name='pos_clave_pres_add'
             placeholder='Ejem: T12804' onkeyup='javascript:this.value=this.value.toUpperCase();' required>
     </div>
 </div>
 <div class='row container-fluid'>
 
     <div class='form-group col-sm-8'>
         <label for='estatus New_Puesto_fump_add'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
         <select class='custom-select' id='pos_Puesto_fump_add' name='pos_Puesto_fump_add'>
             <option value='0' selected>Seleccionar Puesto</option>";
 
             $rows_puestos = $mu->Consulta_Puestos_Fun();
             for ($i = 0; $i < count($rows_puestos); $i++) { echo "<option value='" . $rows_puestos[$i]["id_puesto_fump"]
                 . "'>" . $rows_puestos[$i]["nombre_puesto"] . "</option>" ; } echo" 
                 </select> 
                 </div> 
                 <div class='form-group col-sm-4' id='asdas'>
                 <label for='estatus'>Clave Puesto:</label>
                 <input type='text' DISABLED class='form-control' id='pos_clav_puesto_add' name='pos_clav_puesto_add'
                     placeholder='Ejem:RE6025' onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                 </div>
 </div>
 <div class='row container-fluid'>
     <div class='col-md-4 '>
         <label for='validationServer02'>Sueldo Neto: <samp class='text-danger'>*</samp></label>
         <input class='form-control' name='pos_sueldo_neto' id='pos_sueldo_neto' value='$' data-inputmask-alias='numeric'
             data-inputmask-groupSeparator=',' data-inputmask-digits=2 data-inputmask-digitsOptional=false
             data-inputmask-prefix='$ ' data-inputmask-placeholder='0' placeholder='$ 0.00 MXM'>
 
 
 
     </div>
     <div class='form-group col-sm-4'>
         <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
         <input type='text' class='form-control' id='pos_plaza_jefe' maxlength='8' name='pos_plaza_jefe'
             placeholder='Ejem: 103XXXXX' onkeypress='return numero(event)' required>
     </div>
 </div>
 <div class = col-md-6>
 <label for='estatus'>Proceso a realizar:<samp
                 class='text-danger'>*</samp></label>
         <select class='custom-select' id='estatus_plazas_act_mante' name='estatus_plazas_act_mante'>
             <option value='0'>Seleccionar estatus</option>";
             for ($i=0; $i <count($datos_procesos_act_plaz) ; $i++) { 
                 echo "<option value='".$datos_procesos_act_plaz[$i]['id_proc']."'>".$datos_procesos_act_plaz[$i]['nombre_proc']."</option>";
             }
            
         
         echo "</select>
 </div>
 <div class='modal-footer'>
     <button type='button' class='btn btn-secondary' id='cerrar_mod_change_posis' data-dismiss='modal'>Cerrar</button>
     <button type='button' id='agree_posision_change' class='btn btn-primary'>Guardar cambios</button>
 </div>
      </div>";
      
      
      //MOVIMIENTOS PLAZA
      echo"<div class='tab-pane fade' id='Moviemientos_plaz' role='tabpanel' aria-labelledby='pills-profile-tab'>
      <div class='container-fluid' id= 'Caja_mov_plazas'>
      
      </div>
      
      </div>";
      
      
      
      //COMENTARIOS PLAZA
      echo"  <div class='tab-pane fade' id='Comentarios_plaz' role='tabpanel' aria-labelledby='pills-contact-tab'>
      hola
      
      </div>
    </div>";







     echo"   </div>
    </div>
  </div>
</div>
   ";
   }
   public function Modals_bajas_laudos(){
    include_once 'vistas_Plantilla.php';
    include_once 'MetodosUsuarios.php';
    include_once "ConsultaADR.php";
    include_once 'sesion.php';
    $consulta = new VistasPlantilla();
    $mu = new MetodosUsuarios();
    $cons = new ConsultaInfoADR();
    $datos_procesos_act = $cons->vista_procesos_fijos();
    $datos_procesos_act_plaz = $mu->estados_plaza();
    
    $datos_escolaridad = $mu->cat_escolar();
    $datos_estatus_escolar = $mu->cat_estatus_escolar();
    $datos_estados_civil = $mu->cat_estatus_civil();
    $datos_tipos_nombramiento = $mu->cat_nombramientos();
    $datos_sindicatos = $mu->cat_sindicatos();
    $datos_nivel_jerar = $mu->cat_jerarquia();
    $perfil = $_SESSION['ses_id_perfil_ing'];
    $datos_plaza = $cons->vista_Posisiones_fijos();
    $rows_sub = $consulta->Consulta_Sub($_SESSION["ses_id_admin_ing"]);
    $rows_sub = $mu->Consulta_Subadmin($_SESSION["ses_id_admin_ing"]);
    $rows_depto = $mu->Consulta_Depto($_SESSION["ses_id_admin_ing"]);
    $rows_jefes = $mu->Consulta_Cat_Jefes_insumo();
    $rows_perfil = $mu->Consulta_Perfiles();
    $rows_administracion = $consulta->Consulta_Local();
    $rows_local = $consulta->Consulta_Local();
    $rows_perfil = $mu->Consulta_Perfiles();
    // Modal de información del usuario detalles de movimientos
    echo"<div class='modal fade bd-example-modal-xl' id='Modal_detalle_usuario_insumo' tabindex='-1' role='dialog'
    aria-labelledby='myExtraLargeModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-xl'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalCenterTitle'>DETALLE Y MOVIMIENTOS DEL USUARIO</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body '>

                <div id='datos_princip_us'> </div>
                <div id='entrada_princ'>";
                // AQUI INICA EL MENU DE INFORMACION DEL USUARIO
                    ECHO"<nav>
                            <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                                <a class='nav-item nav-link active' id='nav-home-tab' data-toggle='tab' href='#DATOS_GEN'
                                    role='tab' aria-controls='nav-home' aria-selected='true'>Datos del usuario</a>
                                <a class='nav-item nav-link' id='nav-profile-tab' data-toggle='tab' href='#MOVIMIENTOS'
                                    role='tab' aria-controls='nav-profile' aria-selected='false'  >Movimientos</a>
                                <a class='nav-item nav-link' id='nav-profile-tab' data-toggle='tab' href='#SISTEMAS'
                                    role='tab' aria-controls='nav-profile' aria-selected='false'>Acceso a sistemas</a>
                                <a class='nav-item nav-link' id='nav-contact-tab' data-toggle='tab' href='#RESPONSIVAS'
                                    role='tab' aria-controls='nav-contact' aria-selected='false'>Documentos firmados o por
                                    firmar</a>
                            </div>
                        </nav>";
              // FIN DE EL MENU
                         ECHO" <div class='tab-content' id='nav-tabContent'>
                
                        <div class='tab-pane fade show active' id='DATOS_GEN' role='tabpanel'
                            aria-labelledby='nav-home-tab'>";
                            // INTERIOR DE DATOS GENERALES 
                            // AQUI INICA EL MENU DE LOS DATOS GENERALES
                            ECHO"
                            <ul class='nav nav-pills mb-3' id='pills-tab' role='tablist'>";
                                echo"<li class='nav-item'>
                                    <a class='nav-link active' id='pills-home-tab' data-toggle='pill' href='#datos_basc'
                                        role='tab' aria-controls='pills-home' aria-selected='true'>Datos Basicos</a>
                                </li>";
                               echo" <li class='nav-item'>
                                    <a class='nav-link' id='pills-home-tab' data-toggle='pill' href='#datos_basc_adic'
                                        role='tab' aria-controls='pills-home' aria-selected='true'>Datos adicionales</a>
                                </li>";
                                echo"<li class='nav-item'>
                                    <a class='nav-link' id='pills-profile-tab' data-toggle='pill' href='#datos_op'
                                        role='tab' aria-controls='pills-profile' aria-selected='false'>Estructura Funcional</a>
                                </li>";
                                if ($perfil==1||$perfil==5||$perfil==4||$perfil==7 ) {
                                    echo"<li class='nav-item'>
                                    <a class='nav-link' id='pills-contact-tab' data-toggle='pill' href='#datos_fun'
                                        role='tab' aria-controls='pills-contact' aria-selected='false'>Estructura Central</a>
                                </li>";
                                }
                               
                           echo" </ul>";
                            // FIN DE EL MENU
                            ECHO "<div class='tab-content' id='pills-tabContent'>";
                            
                            // INICIO DE DATOS BASICOS
                             echo"   <div class='tab-pane fade show active' id='datos_basc' role='tabpanel'
                                    aria-labelledby='pills-home-tab'>

                                    <div class='form-row'>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>CURP:<samp class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='CURP2' name='CURP2'
                                                placeholder='XXXX4548' maxlength='18' min='18' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>RFC con Homoclave:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='RFC_COMP' name='RFC_COMP'
                                                placeholder='XXXX4548' maxlength='13' min='13' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>

                                            <label for='RFC_CORTO'>RFC Corto:<samp class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='RFC_CORTO' name='RFC_CORTO'
                                                placeholder='XXXX4548' maxlength='9' min='8' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-3'>
                                            <label for='NO_EMPLEADO'>No. de Empleado:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='NO_EMPLEADO' name='NO_EMPLEADO'
                                                placeholder='123265' maxlength='6' onkeypress='return numero(event)'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-4'>
                                            <label for='NOMBRE'>Nombre(s):<samp class='text-danger'>*</samp></label>
                                            <input type=' text' class='form-control letras' id='NOMBRE' name='NOMBRE'
                                                placeholder='Juan Pérez' required
                                                onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='NO_EMPLEADO'>Apellido Paterno:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='APELLIDO_P' name='APELLIDO_P'
                                                placeholder='López'
                                                onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='NO_EMPLEADO'>Apellido Materno:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='APELLIDO_M' name='APELLIDO_M'
                                                placeholder='Mares'
                                                onkeyup='javascript:this.value=this.value.toUpperCase();' required>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-6'>
                                            <label for='CORREO'>Correo Institucional:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='email' class='form-control' id='CORREO' name='CORREO'
                                                placeholder='xxxx@dssat.sat.gob.mx'>
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='CORREO'>Correo Personal:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='email' class='form-control' id='CORREO_P' name='CORREO_P'
                                                placeholder='xxxx@gmail.com'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-4'>
                                            <label for='CORREO'>Número personal:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='num_1' name='num_1'
                                                placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                                onkeypress='return numero(event)'>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='CORREO'>Número adicional:<samp
                                                    class='text-danger'>*</samp></label>
                                            <input type='text' class='form-control' id='num_2' name='num_2'
                                                placeholder='55XXXXXX73' maxlength='10' minlength='10'
                                                onkeypress='return numero(event)'>
                                        </div>
                                        <div class='form-group col-md-4'>
                                            <label for='CORREO'>Ext.Tel.:<samp class='text-danger'></samp></label>
                                            <input type='email' class='form-control' id='ext_tel' name='ext_tel'
                                                placeholder='Ejem: 42726' maxlength='5' minlength='5'
                                                onkeypress='return numero(event)'>
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='form-group col-md-4'>
                                            <label for='estatus'>Estatus de actividad:<samp
                                                    class='text-danger'>*</samp></label>
                                            <select class='custom-select' id='estatus' name='estatus'>
                                                <option value='0'>Seleccionar Estatus</option>";
                                                for ($i=0; $i <count($datos_procesos_act) ; $i++) { 
                                                    echo "<option value='".$datos_procesos_act[$i]['id_proc']."'>".$datos_procesos_act[$i]['nombre_proc']."</option>";
                                                }
                                               
                                            
                                            echo "</select>
                                        </div>
                                        <div class='form-group col-md-4'>
                                        <label for='NO_EMPLEADO'>Fecha de ingreso<samp
                                                    class='text-danger'>*</samp></label>
                                    <input type='text' class='form-control datepicker-inline' id='fecha_ingreso' name='fecha_ingreso'
                                                placeholder='yyyy/mm/dd' 
                                                required>
                                    </div>
                                  
                                <div class='form-group col-md-4'  id='fec_baja_reg'>
                                    <label for='NO_EMPLEADO'>Fecha de baja: <samp
                                    class='text-danger'>*</samp></label>
                                     <input type='text' class='form-control' id='fecha_baja_mod_baja' name='fecha_baja_mod_baja'
                                     placeholder='dd/mm/yyyy'>
                                </div>
                                <div class='form-group col-sm-4'>
                                <label for='estatus'>Tipo de nombramiento:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='nivel_jerar_detalle_laudos' name='nivel_jerar_detalle_laudos'>
                                    <option value='0'>Seleccionar Nviel Jerarquico</option>";
                                    for ($i=0; $i <count($datos_nivel_jerar) ; $i++) { 
                                        echo "<option value='".$datos_nivel_jerar[$i]['id_nivel_jer']."'>".$datos_nivel_jerar[$i]['nombre_nombramiento']."</option>";
                                    }
                                echo"</select>
                            </div>
                            <div class='form-group col-sm-4'>
                            <label for='estatus'>Tipo de nombramiento:<samp class='text-danger'>*</samp></label>
                            <select class='custom-select' id='tipo_nombramiento12' name='tipo_nombramiento12'>
                                <option value='0'>Seleccionar Nombramiento</option>";
                                for ($i=0; $i <count($datos_tipos_nombramiento) ; $i++) { 
                                    echo "<option value='".$datos_tipos_nombramiento[$i]['id_tipo_nombramiento']."'>".$datos_tipos_nombramiento[$i]['nombre_nombramiento']."</option>";
                                }
                            echo"</select>
                        </div>
                               <div class='form-group col-sm-10' id='opcion_sindical'>
                                <label for='estatus'>Nombre del sindicato:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='sindicato1' name='sindicato1'>
                                    <option value='0'selected>Seleccionar opcion</option>";
                                   for ($i=0; $i <count($datos_sindicatos) ; $i++) { 
                                        echo "<option value='".$datos_sindicatos[$i]['id_sindicato']."'>".$datos_sindicatos[$i]['nombre_sindical']."</option>";
                                   }

                                echo"</select>
                            </div>
                            </div>
                            <div class='modal-footer'>
                            ";
                            echo"<button type='button' class='btn btn-secondary' id='act_tabla_inicio_baja' data-dismiss='modal'>Cerrar</button>";

                            if ( $perfil==1 || $perfil == 5|| $perfil == 4 ) {
                          echo"  <button type='button'  class='btn btn-success' id='act_us_in_datos_basicos_baja' >Actualizar datos Basicos</button>";

                            }

                       echo" </div>
                             </div>";
                                // FIN DE DATOS BASICOS
                                // INICIO DE DATOS ADICIONALES
                                ECHO"<div class='tab-pane fade' id='datos_basc_adic' role='tabpanel'
                                aria-labelledby='pills-home-tab'>
                                <div class='row container-fluid'> 
                                <div class='form-group col-sm-4'>
                                <label for='estatus'>Genero:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='sex' name='sex'>
                                    <option value='0'>Seleccionar Opción</option>
                                    <option value='H'>Hombre</option>
                                    <option value='M'>Mujer</option>
                                    <option value='O'>Omitir</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-4'>
                                <label for='estatus'>Hijos:<samp class='text-danger'>*</samp></label>
                                <select class='custom-select' id='Hijos' name='Hijos'>
                                    <option value='0'>Seleccionar Opción</option>
                                    <option value='S'>Sí</option>
                                    <option value='N'>No</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-4'>
                            <label for='estatus'>Estado civil:<samp class='text-danger'>*</samp></label>
                            <select class='custom-select' id='estado_civ' name='estado_civ'>
                                <option value='0'>Seleccionar estado</option>";
                                for ($i=0; $i <count($datos_estados_civil) ; $i++) { 
                                    echo "<option value='".$datos_estados_civil[$i]['id_estado_civil']."'>".$datos_estados_civil[$i]['nombre_estado_civil']."</option>";
                               }
                           echo "</select>
                        </div>
                            </div>
                            <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Escolaridad:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='Escolaridad' name='Escolaridad'>
                                        <option value='0'>Seleccionar Escolaridad</option>";
                                        for ($i=0; $i <count($datos_escolaridad) ; $i++) { 
                                            echo "<option value='".$datos_escolaridad[$i]['id_escolaridad']."'>".$datos_escolaridad[$i]['nombre_escolaridad']."</option>";
                                       }
                                    echo"</select>
                                </div>
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Estatus de estudios:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='estatus_esco' name='estatus_esco'>
                                        <option value='0'>Seleccionar Estatus</option>";
                                        for ($i=0; $i <count($datos_estatus_escolar) ; $i++) { 
                                            echo "<option value='".$datos_estatus_escolar[$i]['id_estatus_escolaridad']."'>".$datos_estatus_escolar[$i]['nombre_estatus_escolaridad']."</option>";
                                       }
                                    echo"</select>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Carrera:</label>
                                    <input type='text' class='form-control' id='carrera' name='carrera'
                                        placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                            
                            </div>

                    

                            <div class='modal-footer'>";
                            echo"<button type='button' class='btn btn-secondary' data-dismiss='modal' id='cerrar_modal_dat_adicio_baja'>Cerrar</button>";

                            if ($perfil == 1 || $perfil == 5|| $perfil == 4 ) {
                            echo"<button type='button' class='btn btn-success' id='actualiza_dat_adicionales_bot_baja' >Actualizar datos Adicionales</button>";

                            }
                       echo" </div>

                                </div>";
                                 // FIN DE DATOS ADICIONALES
                                //  INICIO DE AREA ASIGNADA
                               ECHO" <div class='tab-pane fade' id='datos_op' role='tabpanel'
                                    aria-labelledby='pills-profile-tab'>
                               
                                <!-- Aqui va la segunda parte -->
                                <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <div class='input-group-prepend'>
                                        <label for='id_admin'>Administración:<samp class='text-danger'>*</samp></label>
                                    </div>
                                    <select class='custom-select' id='id_admin' name='id_admin'>
                                        <option value='0'>Seleccionar Local</option>";
                                        
                                    for ($i = 0; $i < count($rows_local); $i++) {
                                        if ($rows_local[$i]["estatus"] == "A") {
                                            echo "<option value='" . $rows_local[$i]["id_admin"] . "'>" . $rows_local[$i]["nombre_admin"] . "</option>";
                                        }
                                    }
                                 echo"
                                    </select>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='id_sub_admin'>Subadministración:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='id_sub_admin' name='id_sub_admin'>
                                        <option value='0'>Seleccionar Subadministración</option>";
                                       
                  
                                    for ($i = 0; $i < count($rows_sub); $i++) {
                                        echo "<option value='" .  $rows_sub[$i]["id_sub_admin"] . "'>" .  $rows_sub[$i]["nombre_sub_admin"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                            </div>
                  
                            <div class='form-row'>
                  
                                <div class='form-group col-md-6'>
                                    <label for='ID_DEPA'>Departamento:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='ID_DEPA' name='ID_DEPA'>
                                        <option value='0'>Seleccionar Departamento</option>";
                                       
                               
                                    for ($i = 0; $i < count($rows_depto); $i++) {
                                        echo "<option value='" .  $rows_depto[$i]["id_depto"] . "'>" .  $rows_depto[$i]["nombre_depto"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='RFC_JEFE'>Jefe Directo:<samp class='text-danger'>*</samp></label>
                                    <select class='custom-select' id='RFC_JEFE' name='RFC_JEFE'>
                                        <option value='0'>Seleccionar Jefe directo</option>";
                                        
                   
                                    for ($i = 0; $i < count($rows_jefes); $i++) {
                                        if ($rows_jefes[$i]["estatus"] == "A") {
                                            echo "<option value='" .  $rows_jefes[$i]["id_empleado_plant"] . "'>" .  $rows_jefes[$i]["nombre_empleado"] . "</option>";
                                        }
                                    }
                                    echo"
                                    </select>
                                </div>
                            </div>
                           
                            <div class='form-row'>
                                <div class='form-group col-md-6'>
                                    <div class='input-group-prepend'>
                                        <label for='ID_PUESTO'>Puesto ADR:<samp class='text-danger'>*</samp></label>
                                    </div>
                                    <select class='custom-select' id='ID_PUESTO' name='ID_PUESTO'>
                                        <option value='0'>Seleccionar Puesto</option>";
                                        
                                    $rows_puestos = $mu->Consulta_Puestos_us_insu();
                                    for ($i = 0; $i < count($rows_puestos); $i++) {
                                        echo "<option value='" .  $rows_puestos[$i]["id_puesto"] . "'>" .  $rows_puestos[$i]["nombre_puesto"] . "</option>";
                                    }
                                    echo"
                                    </select>
                                </div>
                            </div>
                            <div class='modal-footer'>";
                            echo"<button type='button' class='btn btn-secondary' data-dismiss='modal' id='cerrar_modal_dat_area'>Cerrar</button>";

                            if ($perfil == 1 || $perfil== 5 || $perfil == 4) {
                            echo"<button type='button' class='btn btn-success' id='actualiza_area_asig'>Actualizar Area asignada</button>";

                            }
                        echo"</div>
                                </div>";
                                //  FIN DE AREA ASIGNADA
                                       //  INICIO DE ESTRUCTURA FUNCIONAL
                               ECHO" <div class='tab-pane fade' id='datos_fun' role='tabpanel'
                                    aria-labelledby='pills-contact-tab'>
                        
                                   
                                    <div class='container-fluid'>
                                    <div class='container-fluid' >
                                    <div class='row container-fluid' >
                                    <div class = col-md-6>
                                    <h3>
                                    Datos de Plaza actual
                                    </h3>
                                    </div>
                                    <div class = col-md-6>
                                    <label for='estatus'>Proceso a realizar:<samp
                                                    class='text-danger'>*</samp></label>
                                            <select class='custom-select' id='estatus_plazas_act' name='estatus_plazas_act'>
                                                <option value='0'>Seleccionar Estatus</option>";
                                                for ($i=0; $i <count($datos_procesos_act_plaz) ; $i++) { 
                                                    echo "<option value='".$datos_procesos_act_plaz[$i]['id_proc']."'>".$datos_procesos_act_plaz[$i]['nombre_proc']."</option>";
                                                }
                                               
                                            
                                            echo "</select>
                                    </div>
                                    </div>
                                    </div>
                                    <div class='row container-fluid '>
                                    <div class='form-group col-sm-4'>
                                            <label for='estatus'>Posición o plaza asignada:<samp class='text-danger'>*</samp></label>
                                            <input type='text' disabled class='form-control' id='posision' name='posision'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                        </div>
                                        <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Nivel:</label>
                                        <input type='text' disabled class='form-control' id='nivel' name='nivel'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Clave Presupuestal:</label>
                                        <input type='text' disabled class='form-control' id='clave_pres2' name='clave_pres2'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    </div>
                                    <div class='row container-fluid'>
                            
                                    <div class='form-group col-sm-8'>
                                        <label for='estatus'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                                        <input type='text' disabled class='form-control' id='Puesto_fump' name='Puesto_fump'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Clave Puesto:</label>
                                    <input type='text' disabled class='form-control' id='clav_puesto' name='clav_puesto'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                                    
                               
                                
                                </div>
                                <div class='row container-fluid'>
                              
                                <div class='col-md-4 '>
                                <label for='validationServer02'>Sueldo Neto: <samp class='text-danger'>*</samp></label>
                                <input class='form-control' name='sueldo_neto' id='sueldo_neto' value='$'
                                data-inputmask-alias='numeric' data-inputmask-groupSeparator=',' data-inputmask-digits=2
                                data-inputmask-digitsOptional=false data-inputmask-prefix='$ '
                                data-inputmask-placeholder='0' placeholder='$ 0.00 MXM' > 
                            </div>
                            
                            </div>
                                <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
                                    <input type='text' disabled class='form-control' id='plaza_jefe' name='plaza_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Clave Puesto Jefe:</label>
                                <input type='text' disabled class='form-control' id='clav_puesto_jefe' name='clav_puesto_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                            <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Nombre de Jefe directo:</label>
                                <input type='text' disabled class='form-control' id='nombre_jefe' name='nombre_jefe'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                                                            
                            </div>
                            
                            </div>
                            <div class='container-fluid' id='democion_promocion' style='display:none;' >
                            <div class='container-fluid' >
                            <h3>
                            Datos de Plaza tentativa
                            </h3>
                            </div>
                                    <div class='row container-fluid '>
                                    <div class='form-group col-sm-4'>
                                            <label for='estatus'>Posición o plaza asignada:<samp class='text-danger'>*</samp></label>
                                            <select class='custom-select' id='posision_ten' name='posision_ten'>
                                                <option value='0'>Seleccionar Posición</option>";
                                            for ($i=0; $i < count($datos_plaza) ; $i++) { 
                                                echo"<option value='".$datos_plaza[$i]['id_posision']."'>".$datos_plaza[$i]['id_num_posision']."</option>";
                                            }
                                               
                                                
                                           echo" </select>
                                        </div>
                                        <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Nivel:</label>
                                        <input type='text' disabled class='form-control' id='nivel_ten' name='nivel_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                        <label for='estatus'>Clave Presupuestal:</label>
                                        <input type='text' disabled class='form-control' id='clave_pres2_ten' name='clave_pres2_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                            required>
                                    </div>
                                    </div>
                                    <div class='row container-fluid'>
                            
                                    <div class='form-group col-sm-8'>
                                        <label for='estatus'>Nombre de Puesto central:<samp class='text-danger'>*</samp></label>
                                        <input type='text' disabled class='form-control' id='Puesto_fump_ten' name='Puesto_fump_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                    </div>
                                    <div class='form-group col-sm-4' id='asdas'>
                                    <label for='estatus'>Clave Puesto:</label>
                                    <input type='text' disabled class='form-control' id='clav_puesto_ten' name='clav_puesto_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                        required>
                                </div>
                                    
                               
                                
                                </div>
                                <div class='row container-fluid'>
                            
                                <div class='form-group col-sm-4'>
                                    <label for='estatus'>Posición Jefe:<samp class='text-danger'>*</samp></label>
                                    <input type='text' disabled class='form-control' id='plaza_jefe_ten' name='plaza_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                                </div>
                                <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Clave Puesto Jefe:</label>
                                <input type='text' disabled class='form-control' id='clav_puesto_jefe_ten' name='clav_puesto_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                            <div class='form-group col-sm-4' id='asdas'>
                                <label for='estatus'>Nombre de Jefe directo:</label>
                                <input type='text' disabled class='form-control' id='nombre_jefe_ten' name='nombre_jefe_ten'  placeholder='Ejem: Administración de Empresas' onkeyup='javascript:this.value=this.value.toUpperCase();'
                                    required>
                            </div>
                                                            
                            </div>
                            </div>

                            <div class='modal-footer'>";
                            echo"<button type='button' class='btn btn-secondary' id='cerrar_mod_actualiza_plazas' data-dismiss='modal'>Cerrar</button>";

                            if ($perfil==1 || $perfil==5|| $perfil == 4 ) {
                            echo"<button type='button' class='btn btn-success' id='actualiza_plazas'>Actualizar estructura Central</button>";


                            }
                       echo" </div>
                                </div>
                                ";
                                 //  FIN DE ESTRUCTURA FUNCIONAL
                          ECHO"  </div>
                             </div>";
                                  //  FIN DE DATOS GENERALES
                                  //  INICIO DE REGISTRO DE MOVIMIENTOS
                        ECHO"<div class='tab-pane fade' id='MOVIMIENTOS' role='tabpanel' aria-labelledby='nav-profile-tab'>
                            <div id='caja_mov_personal_insumo' class='overflow-auto'>
                            
                            </div>

                        </div>";
                         //  FIN DE REGISTRO DE MOVIMIENTOS
                         //  INICIO DE ACCESO A SISTEMAS
                         ECHO" <div class='tab-pane fade' id='SISTEMAS' role='tabpanel' aria-labelledby='nav-contact-tab'>
                            .3.




                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <button type='button' class='btn btn-success'>Actualizar</button>
                        </div>
                        </div>";
                        //  FIN DE ACCESO A SISTEMAS
                        //  INICIO DE REGISTRO DE DOCUMENTOS FIRMADOS/RESPONSIVAS/CAMBIOS DE NOMBRAMIENTOS
                        ECHO" <div class='tab-pane fade' id='RESPONSIVAS' role='tabpanel' aria-labelledby='nav-contact-tab'>

                            .4.





                            <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            <button type='button' class='btn btn-primary'>Save changes</button>
                        </div>
                        </div>";
                          //  FIN DE ACCESO A SISTEMAS
                    ECHO"</div>

                </div>



            </div>
         
        </div>
    </div>
</div>";
   }
   public function Modal_matriz(){
       include_once "sesion.php";
       include_once "ConsultaADR.php";

       $perfil= $_SESSION['ses_id_perfil_ing'];
       if ($perfil== 1 || $perfil == 4 || $perfil == 5 || $perfil == 7) {
             echo"
             
         <div class='modal fade bd-example-modal-xl' tabindex='-1' role='dialog' id='mod_agree_sistema' aria-hidden='true'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>

                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Agrega sistema</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form>
                        <div  class='row'>
                            <div class='form-group col-sm-3'>
                                <label for='name_sistema' class='col-form-label'>Nombre del sistema/carpeta:</label>
                                <input type='text' class='form-control' id='name_sistema' required onkeyup='javascript:this.value=this.value.toUpperCase();'>
                            </div>
                            <div class='form-group col-sm-3'>
                                <label for='recipient-name' class='col-form-label'>Administración del sistema:</label>
                                <select class='form-control' id='admin_sistema'>
                                    <option value='0' selected >Selecciona Administración</option>
                                    <option value='1' >ADR DF 4</option>
                                    <option value='2' >Desconcentradas</option>
                                    <option value='3' >Centrales</option>
                                    <option value='4' >Externo</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-3'>
                                <label for='recipient-name' class='col-form-label'>Núm. cuentas permitidas:</label>
                                <input type='text' class='form-control' id='num_cuentas_sistema'>
                            </div>

                            <div class='form-group col-sm-3'>
                                <label for='recipient-name' class='col-form-label'>Autoriza cuentas del sistema:</label>
                                <input type='text' class='form-control' id='Autorizador_sistema'>
                            </div>
                        </div>

                        <div  class='row'>
                            <div class='form-group col-sm-3'>
                                <label for='recipient-name' class='col-form-label'>Tipo de acceso:</label>
                                <select class='form-control' id='Tipo_acceso'>
                                <option value='0' selected >Selecciona tipo de acceso</option>
                                <option value='1' >Página web</option>
                                <option value='2' >Carpeta de red</option>
                                <option value='3' >Aplicación de escritorio</option>
                                <option value='4' >Aplicación de Microsoft Office</option>
                              </select>
                            </div>
                            <div class='form-group col-sm-4' id='input_liga' >
                                <label for='recipient-name' class='col-form-label'>Liga o página web:</label>
                                <input type='text' class='form-control' id='Liga_acces_sistema'>
                            </div>
                            <div class='form-group col-sm-2'>
                                <label for='recipient-name' class='col-form-label'>Cuentas con aplicación para carga:</label>
                                <div class='custom-control custom-switch'>
                                <input type='checkbox' class='custom-control-input' id='Selecciona_Opicion_sis'>
                                <label class='custom-control-label' for='Selecciona_Opicion_sis'>Sí</label>
                                </div>
                            </div>
                            <div class='form-group col-sm-3' id='input_carga_sis' Style='display:none;'>
                                <label for='recipient-name' class='col-form-label'>Cargar aplicación:</label>
                                <input type='file' class='form-control-file' id='archivo_sistema_app'>
                            </div>


                        </div>
                          
                            <div class='form-group col-sm-8'>
                                <label for='message-text' class='col-form-label'>Descripción (máximo 750 caracteres):</label>
                                <textarea class='form-control' id='desc_sistema' maxlength='750'></textarea>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <button type='button' class='btn btn-primary'>Continuar registro</button>
                    </div>

                </div>
            </div>
        </div>
             
             ";
       }
       
   }
}
