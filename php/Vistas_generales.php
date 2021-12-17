<?php




class vistas{
            public function Vista_general(){
              include_once 'php/ConsultaADR.php';
              $Consulta_info = new ConsultaInfoADR();
               $admins = $Consulta_info->Estructura_por_admin_agregados();
               $cade_admin = $Consulta_info->Datos_subs_por_admin();
               $cade_sub = $Consulta_info->Datos_deps_por_subs();
              
             echo "
             <script>
              var $ = go.GraphObject.make;
              var myDiagram =
              $(go.Diagram, 'myDiagramDiv',
                {
                  'undoManager.isEnabled': true,
                  layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                            { angle: 90, layerSpacing: 90 })
                });
                // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
                myDiagram.nodeTemplate =
               $(go.Node, 'Vertical',
                { background: '#5B0216 '},

                  $(go.Picture,
                  { margin: 12, width: 60, height: 60, background: 'white' },
                  new go.Binding('source')),

                  $(go.TextBlock, 'Default Text',
                  { margin: 12, stroke: 'white', font: 'bold 16px sans-serif' },
                  new go.Binding('text', 'Estructura')),

                  $(go.TextBlock, 'Default Text',
                  { margin: 12, stroke: 'white', font: ' 12px sans-serif' },
                  new go.Binding('text', 'Nombre_encargado')),

                  $(go.TextBlock, 'Default Text',// se le indica que formato tendra la etiqueta
                  { margin: 12, stroke: 'white', font: ' 12px sans-serif' },
                  new go.Binding('text', 'Nombre_puesto'))// Se agrega el nombre de la etiqueta
              );
                  myDiagram.linkTemplate =
                  $(go.Link,
                    { routing: go.Link.Orthogonal, corner: 5 },
                    $(go.Shape, // the link's path shape
                      { strokeWidth: 3, stroke: '#EABE3F' })
                    );

              myDiagram.model = new go.TreeModel(
               
                [";
                // Aqui se depositan las administraciones y el nombre de los administradores con su puesto operativo
                for ($i=0; $i < count($admins) ; $i++) { 
                echo"{ key: '".$admins[$i]['nombre_admin']."'
                      ,Estructura: '".$admins[$i]['nombre_admin']."' 
                      ,Nombre_encargado: '".$admins[$i]['nombre_empleado']."'
                      ,Nombre_puesto: '".$admins[$i]['nombre_puesto']."' 
                      ,source: 'img/fotos_empleados/".$admins[$i]['no_empleado'].".jpg' },";
                }
                // Aqui se depositan las Subadministraciones y el nombre de los Subadministradores con su puesto operativo
                  for ($i=0; $i <count($cade_admin) ; $i++) { 
                    $num_empleado =$cade_admin[$i]['no_empleado'] == NULL ? "LOGO11": $cade_admin[$i]['no_empleado'];
                   echo" { key: '".$cade_admin[$i]['nombre_sub_admin']."'
                    , parent: '".$cade_admin[$i]['nombre_admin']."'
                    , Estructura: '".$cade_admin[$i]['nombre_sub_admin']."' 
                    , Nombre_encargado:'".$cade_admin[$i]['nombre_empleado']."'
                    , Nombre_puesto: '".$cade_admin[$i]['nombre_puesto']."'  
                    ,source: 'img/fotos_empleados/".$num_empleado.".jpg' },";
                  }
                 // Aqui se depositan los departamentos y el nombre de los jefes de departamento con su puesto operativo
                  for ($i=0; $i <count($cade_sub) ; $i++) { 
                    if ($cade_sub[$i]['nombre_puesto'] == 'ANALISTA DESCONCENTRADO') {
                      continue;
                    }
                    $num_empleado =$cade_sub[$i]['no_empleado'] == NULL ? "LOGO11": $cade_sub[$i]['no_empleado'];
                    $nombre_encargado =$cade_sub[$i]['nombre_empleado'] == '  ' ? "VACANTE": $cade_sub[$i]['nombre_empleado'];
                    $nombre_puesto =$cade_sub[$i]['nombre_puesto'] == NULL ? "VACANTE": $cade_sub[$i]['nombre_puesto'];
                    echo" { key: '".$cade_sub[$i]['nombre_depto']."'
                    ,parent: '".$cade_sub[$i]['nombre_sub_admin']."'
                    ,Estructura: '".$cade_sub[$i]['nombre_depto']."'
                    ,Nombre_encargado: '".$nombre_encargado."'
                    ,Nombre_puesto: '".$nombre_puesto."'
                    ,source: 'img/fotos_empleados/".$num_empleado.".jpg' },";
                   }
                echo"]);
            </script>";

          }

          public function Tabla_posisiones(){
            include_once 'sesion.php';
            include_once 'ConsultaADR.php';
            $cons = new ConsultaInfoADR();
            $datos = $cons->Consulta_datos_Posisines_General();
            $universo_de_datos = $cons->Consulta_datos_Posisines_General();
            $resultado = $universo_de_datos[0]['TOTAL'] / 50;
            $Posision_por_pagina = 50;
            $paginas_por_vista = ceil($resultado);
            switch ($_GET) {
              case isset($_GET['pagina']):
                      $num = $_GET['pagina'];
              break;
            }
            if ($num==1) {
              $inicio = 1;
              $datos_vista = $cons->datos_por_vissta_Consulta_datos_Posisines_General($inicio);
              }
              else {
              $pagina = $num-1 ;
              $inicio = ($pagina * $Posision_por_pagina) + 1;
              $datos_vista = $cons->datos_por_vissta_Consulta_datos_Posisines_General($inicio);
              }
              self::Paginacion_responsiva_posisiones($paginas_por_vista);
            echo "
            <table class='table  table-sm text-center  table-striped table-bordered shadow-sm bg-white rounded table-hover'>
                <thead class='thead-dark'>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Posision</th>
                    <th scope='col'>Ocupante</th>
                    <th scope='col'>Estado</th>
                    <th scope='col'>Puesto FUMP</th>
                    <th scope='col'>Nivel</th>
                    <th scope='col'>Posision Jefe</th>
                    <th scope='col'>Acciones</th>
                  </tr>
                </thead>
                <tbody>";


                if (isset($datos_vista)) {
                    $j = 1;
                    for ($i=0; $i < count($datos_vista) ; $i++) { 
                        // onclick='Revisa_info_det(\"".$datos[$i]['id_empleado_plant']."\")'
                       $ocupante = $datos_vista[$i]['Ocupante'];
                       if ($ocupante == '  ') {
                        $ocupante= "Vacante";
                        
                       }
                       else {
                         $ocupante = $datos_vista[$i]['Ocupante'];
                         
                       }
                       $estado_analista = $datos_vista[$i]['estado_analista'];
                       switch ($estado_analista) {
                              case 9: // Activo
                              $color = "success";
                              break;
                              case 7: // Laudo
                              $color = "danger";
                              break;
                              case 11: //Baja
                              $color = "dark";
                              break;
                              case 12://Licencia
                              $color = "info";
                              break;
                         
                              default:
                              $color = "light";
                              break;
                       }
                     
                        echo " 
                        <tr class='table-$color'>
                            <th scope='row'>".$datos_vista[$i]['seq']."</th>
                            <td> ".$datos_vista[$i]['id_num_posision']."</td>
                            <td>".$ocupante."</td>
                            <td>".$datos_vista[$i]['nombre_proc']."</td>
                            <td>".$datos_vista[$i]['nombre_puesto']."</td>
                            <td>".$datos_vista[$i]['nivel']."</td>
                            <td>".$datos_vista[$i]['posision_jefe']."</td>
                            <td> <button type='button' class='btn btn-dark btn-group' id='informacion_plaza'  onclick='Revisa_info_plaza(\"".$datos_vista[$i]['id_posision']."\")' > Info.</button> </td>
                        </tr>";
                    }
                }
                else {
                    echo "No hay usuarios registrados por el momento.";
                }
                echo"</tbody>
                </table>";
            }

            public function Paginacion_responsiva_posisiones($paginas_por_vista){
              switch ($_GET) {
                case isset($_GET['pagina']):
                        $page =$_GET['pagina'];
                        $nombre_get = "pagina";
                break;
              }
              $pagina_responsiva = $page + 10;
              $anterior = $page - 1;
              $siguiente = $page + 1;
      
              if ($page == 1) {
                      $condicion = "disabled";
              }
              else{
                      $condicion = "";
              }
              echo "<nav aria-label='Page navigation example '>
              <ul class='pagination justify-content-center'>
              <li class='page-item $condicion'><a class='page-link' href='Posisiones.php?$nombre_get=1'>Inicio</a></li>
              <li class='page-item $condicion'><a class='page-link' href='Posisiones.php?$nombre_get=".$anterior."'>anterior</a></li>";
              $k = 1;
              $m = 1;
              if ($paginas_por_vista < 10) {
           
              for ($i=0; $i < $paginas_por_vista ; $i++) { 
                      if ($page == $m) {
                              $active = 'active';
                        }
                        else {
                                $active = '';
                        }
                      echo"<li class='page-item $active'><a class='page-link' href='Posisiones.php?$nombre_get=".$m++."'>".$k++."</a></li>";
              }
              }
              elseif ($paginas_por_vista > 20) {
              for ($i=$page; $i < $pagina_responsiva ; $i++) { 
                  if ($page == $i) {
                      $active = 'active';
                }
                else {
                        $active = '';
                }
                      echo"<li class='page-item $active'><a class='page-link' href='Posisiones.php?$nombre_get=".$i."'>".$i."</a></li>";
                      
              }
              echo"<li class='page-item disabled '><a class='page-link' href='Posisiones.php?$nombre_get=".($i)."'>...</a></li>";
              } 
              if ($page == $paginas_por_vista) {
                      $condicion1 = "disabled";  
              }
              else{
                      $condicion1 = "";
              }
               echo" <li class='page-item $condicion1'><a class='page-link' href='Posisiones.php?$nombre_get=".$siguiente."'>siguiente</a></li>
               <li class='page-item $condicion1'><a class='page-link' href='Posisiones.php?$nombre_get=".$paginas_por_vista."'>Final</a></li>
              </ul>
            </nav>";
                
            }
          
}