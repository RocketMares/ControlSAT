<?php
    require_once 'php/sesion.php';
    require_once 'php/menu_dinamico.php';


    $menu = new Menu();

    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    
  
    // $menu->menu_vertical();
    ?>
<br>
<br>
<br>
<div  class="row" >
<div class="col-md-2 bg-dark">
  <?php
 include_once 'php/menu_vertical_estructura.php';
 include_once 'php/Vistas_generales.php';
 $meto = new Menu_vertical();
 $scrips = new vistas();
 $meto->Inicia_menu();
  ?>
</div>
        <div class="container-fluid ceneter col-sm-10 text-center" >
        <div class='container-fluid py-5 col-sm-9'>
                <h1 class='display-4 text-center'>Estructura Funcional</h1>
            </div>
            <?php   
            include_once 'php/ConsultaADR.php';
            $cons = new ConsultaInfoADR();
            $datos_admin = $cons->Consulta_Local_menu($_SESSION['ses_id_admin_ing']);
            $datos_subs = $cons->Consulta_Subs_menu($_SESSION['ses_id_admin_ing']);
           
            echo"<div data-spy='scroll' data-target='#Nombre_estructura' data-offset='0' class='scrollspy-example table-responsive' style='height: 530px;'>";
            for ($i=0; $i <count($datos_admin) ; $i++) {
                $nombre_indices_admins = "canvas_admins_".$datos_admin[$i]['id_admin'];
                echo" 
                <div class='card' id='$nombre_indices_admins' >
                <div id='myDiagramDiv' class='fondo' style=' height:350px; aligin:center'>
    
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>ADMINISTRACIÓN Y SUBADMINISTRACIONES</h5>
                    <p class='card-text'>Estructura principal.</p>
                    <a  class='btn btn-primary' HREF='javascript:window.print()'>Ver detalles</a>
                </div>";


      
            
            }


            foreach ($datos_subs as $sub ) {
            
              $nombre_indices_subs = "canvas_sub_".$sub['id_sub_admin'];

              if ($sub['id_sub_admin']== 2) {
                $condicion_vista = "style='display:none;'";
              }
              else{
                $condicion_vista = "";
              }

              echo"<div class='card' $condicion_vista id =$nombre_indices_subs>
              <div id='Subadmin_".$sub['id_sub_admin']."_Div' class='fondo' style=' height:350px;'>

              </div>
              <div class='card-body'>
                    <h5 class='card-title'>".$sub['nombre_sub_admin']." Y DEPARTAMENTOS</h5>
                    <p class='card-text'>Estructura Media.</p>
                    <a href='#' class='btn btn-primary' >Ver detalles</a>
                </div>
            </div>
            
            
          ";
          $datos_deps = $cons->Consulta_deps_menu_x_sub($_SESSION['ses_id_admin_ing'],$sub['id_sub_admin']);
          for ($i=0; $i <count($datos_deps) ; $i++) {
            if ($datos_deps[$i]['nombre_depto'] == 'SUBADMINISTRACIÓN' ) {
                $nombre_dep = $datos_deps[$i]['nombre_sub_admin'];
            }
            else {
              $nombre_dep =$datos_deps[$i]['nombre_depto'];
            }
        $nombre_indices_deps = "canvas_deps_".$datos_deps[$i]['id_depto'];

        echo"<div class='card' id =$nombre_indices_deps>
        <div id='departamento_".$datos_deps[$i]['id_depto']."_Div' class='fondo' style=' height:350px;'>

        </div>
        <div class='card-body'>
              <h5 class='card-title'>DEPARTAMENTO DE ".$nombre_dep."</h5>
              <p class='card-text'>Estructura interna por departamento.</p>
              <a href='#' class='btn btn-primary'>Ver detalles</a>
          </div>
      </div>
      
      
         ";
            }
                
                
      }
          
          echo"<script>
          
     
          ";

         
          $scrips->Funciones_canvas_deps();
       
          $scrips->Funciones_canvas_subs();

          $scrips->Funciones_canvas_admins();

         echo"";
          echo"</script>";
            ?> 
</div>
</div>
</div>













<!-- Button trigger modal -->



<?php

   // se imprime footer
   $menu->Footer();

?>