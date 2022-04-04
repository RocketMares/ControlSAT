<?php

class Menu_vertical{
    public function Inicia_menu(){
      include_once 'sesion.php';
      include_once 'ConsultaADR.php';
      $cons = new ConsultaInfoADR();
      $datos_admin = $cons->Consulta_Local_menu($_SESSION['ses_id_admin_ing']);
      $datos_subs = $cons->Consulta_Subs_menu($_SESSION['ses_id_admin_ing']);
 
   
      echo"<div id='Nombre_estructura' class='list-group bg-dark text-white table-responsive' style='height: 680px;'>";
     for ($i=0; $i < count($datos_admin) ; $i++) { 
       $nombre_indices_admins = "canvas_admins_".$datos_admin[$i]['id_admin'];
         echo" <a class='list-group-item list-group-item-action bg-dark text-white' href='#$nombre_indices_admins'>".$datos_admin[$i]['nombre_corto']."</a>";
     }
     foreach ($datos_subs as $subs ) {
      $nombre_indices_admins = "canvas_sub_".$subs['id_sub_admin'];
      echo" <a class='list-group-item list-group-item-action bg-secondary text-white' href='#$nombre_indices_admins'>".$subs['nombre_corto']."</a>";
      $datos_deps = $cons->Consulta_deps_menu_x_sub($_SESSION['ses_id_admin_ing'],$subs['id_sub_admin']);
      for ($i=0; $i < count($datos_deps) ; $i++) { 
       $nombre_indices_admins = "canvas_deps_".$datos_deps[$i]['id_depto'];
         echo" <a class='list-group-item list-group-item-action bg-dark text-white' href='#$nombre_indices_admins'>".$datos_deps[$i]['nombre_corto']."</a>";
     }
     }
      
     

    
      
   echo"
   </div>";
    }


}



?>