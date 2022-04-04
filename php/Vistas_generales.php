<?php




class vistas{
          public function Funciones_canvas_admins(){
            include_once 'php/ConsultaADR.php';
            $cons = new ConsultaInfoADR();
            $admins = $cons->Estructura_por_admin_agregados();
            $cade_admin = $cons->Datos_subs_por_admin();
            echo"
          var $ = go.GraphObject.make;
          var myDiagram =
          $(go.Diagram, 'myDiagramDiv',
            { initialAutoScale: go.Diagram.Uniform,
              'undoManager.isEnabled': false,
              layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                        { angle: 90, layerSpacing: 50,
                          alternateAngle: 90,
                          alternateLayerSpacing: 35,
                          alternateNodeSpacing: 20 })
            });
            // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
            myDiagram.nodeTemplate =
           $(go.Node, 'Vertical',

              $(go.Picture,
              { margin: 5, width: 160, height: 160, background: 'white' },
              new go.Binding('source')),

              $(go.TextBlock, 'Default Text',
              { margin: 5, stroke: 'black', font: 'bold 26px sans-serif'},
              new go.Binding('text', 'Estructura')),


              $(go.TextBlock, 'Default Text',
              { margin: 5, stroke: 'black', font: 'bold 26px sans-serif' },
              new go.Binding('text', 'Nombre_encargado')),

              $(go.TextBlock, 'Default Text',// se le indica que formato tendra la etiqueta
              { margin: 5, stroke: 'black', font: 'bold 26px sans-serif' },
              new go.Binding('text', 'Nombre_puesto'))// Se agrega el nombre de la etiqueta
              );
              myDiagram.linkTemplate =
              $(go.Link,
              { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
              $(go.Shape, // the link's path shape
              { strokeWidth: 8, stroke: '#EABE3F' })
              );
         
          myDiagram.model = new go.TreeModel(
           
            [";
            // Aqui se depositan las administraciones y el nombre de los administradores con su puesto operativo
            for ($i=0; $i < count($admins) ; $i++) { 
            echo"{ key: '".$admins[$i]['id_admin']."'
                  ,Estructura: '".$admins[$i]['nombre_admin']."' 
                  ,Nombre_encargado: '".$admins[$i]['nombre_empleado']."'
                  ,Nombre_puesto: '".$admins[$i]['nombre_puesto']."' 
                  ,source: 'img/fotos_empleados/".$admins[$i]['no_empleado'].".jpg' },";
            }
            // Aqui se depositan las Subadministraciones y el nombre de los Subadministradores con su puesto operativo
              for ($i=0; $i <count($cade_admin) ; $i++) { 
                $num_empleado =$cade_admin[$i]['no_empleado'] == NULL ? "LOGO11": $cade_admin[$i]['no_empleado'];
               echo" { key: '".$cade_admin[$i]['nombre_sub_admin']."'
                , parent: '".$cade_admin[$i]['id_admin']."'
                , Estructura: '".$cade_admin[$i]['nombre_estructura_sub']."' 
                , Nombre_encargado:'".$cade_admin[$i]['nombre_empleado']."'
                , Nombre_puesto: '".$cade_admin[$i]['nombre_puesto']."'  
                ,source: 'img/fotos_empleados/".$num_empleado.".jpg'},";
              }

            echo"]);";

            echo"
            ";

          }
          public function Funciones_canvas_subs(){
              include_once 'php/ConsultaADR.php';
              $cons = new ConsultaInfoADR();
  
              $cade_admin = $cons->Datos_subs_por_admin();
              foreach ($cade_admin as $data=> $pin) {
                $num_empleado =$pin['no_empleado'] == NULL ? "LOGO11": $pin['no_empleado'];
              
                
                echo "
                var $ = go.GraphObject.make;
                var myDiagram".$pin['id_sub_admin']." =
                $(go.Diagram, 'Subadmin_".$pin['id_sub_admin']."_Div',
                  {
                    initialAutoScale: go.Diagram.Uniform,
                    'undoManager.isEnabled': false,
                    layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                              { angle: 90, layerSpacing: 50})
                  });
                  // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
                  myDiagram".$pin['id_sub_admin'].".nodeTemplate =
                  $(go.Node, 'Vertical',
                 
                 
                    $(go.Picture,
                    {  maxSize: new go.Size(160,160)},
                    new go.Binding('source')),
    
                    $(go.TextBlock, 'Default Text',
                    { margin: 12, stroke: 'black', font: 'bold 18px sans-serif'},
                    new go.Binding('text', 'Estructura')),
    
    
                    $(go.TextBlock, 'Default Text',
                    { margin: 12, stroke: 'black', font: ' 18px sans-serif' },
                    new go.Binding('text', 'Nombre_encargado')),
    
                    $(go.TextBlock, 'Default Text',// se le indica que formato tendra la etiqueta
                    { margin: 12, stroke: 'black', font: ' 18px sans-serif' },
                    new go.Binding('text', 'Nombre_puesto'))// Se agrega el nombre de la etiqueta
                );
              
                    myDiagram".$pin['id_sub_admin'].".linkTemplate =
                    $(go.Link,
                      { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
                      $(go.Shape, // the link's path shape
                        { strokeWidth: 8, stroke: '#EABE3F' })
                      );
               
                      myDiagram".$pin['id_sub_admin'].".model = new go.TreeModel(
                        [
                        { key: '".$pin['nombre_sub_admin']."'
                          , Estructura: '".$pin['nombre_sub_admin']."' 
                          , Nombre_encargado:'".$pin['nombre_empleado']."'
                          , Nombre_puesto: '".$pin['nombre_puesto']."'  
                          ,source: 'img/fotos_empleados/".$num_empleado.".jpg'},";
                             $recibe_sub = $cons->filtra_deps_por_sub($pin['id_sub_admin']);
                             for ($i=0; $i < count($recibe_sub) ; $i++) { 
                               $num_empleado =$recibe_sub[$i]['no_empleado'] == NULL ? "LOGO11": $recibe_sub[$i]['no_empleado'];
  
                               echo "{ key: '".$recibe_sub[$i]['nombre_depto']."'
                               , parent: '".$recibe_sub[$i]['nombre_sub_admin']."'
                               , Estructura: '".$recibe_sub[$i]['nombre_depto']."' 
                               , Nombre_encargado:'".$recibe_sub[$i]['nombre_empleado']."'
                               , Nombre_puesto: '".$recibe_sub[$i]['nombre_puesto']."'  
                               ,source: 'img/fotos_empleados/".$num_empleado.".jpg'},";
                             }
    
                        echo" ]
                      );
                  
                      ";
                       
              } 
          }
          public function Funciones_canvas_deps(){
            include_once 'php/ConsultaADR.php';
            $cons = new ConsultaInfoADR();
            $diragramas_por_jefes = $cons->jefes_Diagramas();

            foreach ($diragramas_por_jefes  as $data) {
              
              echo "
              var $ = go.GraphObject.make;
              var myDiagram".$data['id_depto']." =
              $(go.Diagram, 'departamento_".$data['id_depto']."_Div',
                {
                  initialAutoScale: go.Diagram.Uniform,
                  'undoManager.isEnabled': false,
                  layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                            { angle: 90, layerSpacing: 50})
                });
                // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
                myDiagram".$data['id_depto'].".nodeTemplate =
                $(go.Node, 'Vertical',
               
               
                  $(go.Picture,
                  {  maxSize: new go.Size(160,160)},
                  new go.Binding('source')),
  
                  $(go.TextBlock, 'Default Text',
                  { margin: 12, stroke: 'black', font: 'bold 18px sans-serif'},
                  new go.Binding('text', 'Estructura')),
  
  
                  $(go.TextBlock, 'Default Text',
                  { margin: 12, stroke: 'black', font: ' 18px sans-serif' },
                  new go.Binding('text', 'Nombre_encargado')),
  
                  $(go.TextBlock, 'Default Text',// se le indica que formato tendra la etiqueta
                  { margin: 12, stroke: 'black', font: ' 18px sans-serif' },
                  new go.Binding('text', 'Nombre_puesto'))// Se agrega el nombre de la etiqueta
              );
              
                  myDiagram".$data['id_depto'].".linkTemplate =
                  $(go.Link,
                    { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
                    $(go.Shape, // the link's path shape
                      { strokeWidth: 8, stroke: '#EABE3F' })
                    );
             
                    myDiagram".$data['id_depto'].".model = new go.TreeModel(
                      [
                      { key: '".$data['id_empleado_plant']."'
                        , Estructura: '".$data['nombre_depto']."' 
                        , Nombre_encargado:'".$data['nombre_empleado']."'
                        , Nombre_puesto: '".$data['nombre_puesto']."'  
                        ,source: 'img/fotos_empleados/".$data['no_empleado'].".jpg'},";
                           
                           if ($recibe_jefes = $cons->Datos_empleados_por_jefes($data['id_empleado_plant'])) {
                            for ($i=0; $i < count($recibe_jefes) ; $i++) { 
                              $num_empleado =$recibe_jefes[$i]['no_empleado'] == NULL ? "LOGO11": $recibe_jefes[$i]['no_empleado'];
                              echo "{ key: '".$recibe_jefes[$i]['jefe_directo']."'
                              , parent: '".$recibe_jefes[$i]['jefe_directo']."'
                              , Estructura: '".$recibe_jefes[$i]['nombre_depto']."' 
                              , Nombre_encargado:'".$recibe_jefes[$i]['nombre_empleado']."'
                              , Nombre_puesto: '".$recibe_jefes[$i]['nombre_puesto']."'  
                              ,source: 'img/fotos_empleados/".$num_empleado.".jpg'},";
                            }
                           }
                          
  
                      echo" ]
                    );
                
                    ";
            }
              

          }

          public function Tabla_posisiones(){
            include_once 'sesion.php';
            include_once 'ConsultaADR.php';
            $cons = new ConsultaInfoADR();
            $universo_de_datos = $cons->Consulta_datos_Posisines_General();
            $resultado = $universo_de_datos[0]['TOTAL'] / 50;
            $Posision_por_pagina = 50;
            $paginas_por_vista = ceil($resultado);
            switch ($_GET) {
              case isset($_GET['pagina']):
              $num = $_GET['pagina'];
              break;
              case isset($_GET['Cod_puesto']):
              $num = $_GET['Cod_puesto'];
              break;
              case isset($_GET['Nivel']):
              $num = $_GET['Nivel'];
              break;
              case isset($_GET['Pos_gerente']):
              $num = $_GET['Pos_gerente'];
              break;
              case isset($_GET['Posision']):
              $num = $_GET['Posision'];
              break;
              case isset($_GET['Stock']):
              $num = $_GET['Stock'];
              break;
              default:
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
            echo "<span class='badge badge-secondary'>Contador de Posiciones (".$universo_de_datos[0]['TOTAL'].")</span>
            <table class='table  table-sm text-center table-bordered shadow-sm bg-white rounded table-hover '>
                <thead class='thead-dark sticky-top'>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Posición</th>
                    <th scope='col'>Ocupante</th>
                    <th scope='col'>Estado</th>
                    <th scope='col'>Cod. Puesto</th>
                    <th scope='col'>Puesto FUMP</th>
                    <th scope='col'>Nivel</th>
                    <th scope='col'>Posición Jefe</th>
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
                              $color = "table-success";
                              break;
                              case 7: // Laudo
                              $color = "bg-danger text-white";
                              break;
                              case 11: //Baja
                              $color = "bg-dark text-white";
                              break;
                              case 12://Licencia Medica 
                              $color = "table-info";
                              break;
                              case 25://Susprencion
                              $color = "bg-info";
                              break;
                              case 6://Comision Sindical
                              $color = "bg-secondary text-white";
                              break;
                              case 28://Licencia Sin goce de sueldo
                              $color = "table-warning";
                              break;
                              default:
                              $color = "light";
                              break;
                       }
                     
                        echo " 
                        <tr class='$color'>
                            <th scope='row'>".$datos_vista[$i]['seq']."</th>
                            <td> ".$datos_vista[$i]['id_num_posision']."</td>
                            <td>".$ocupante."</td>
                            <td>".$datos_vista[$i]['nombre_proc']."</td>
                            <td>".$datos_vista[$i]['clave_puesto']."</td>
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
                self::Paginacion_responsiva_posisiones($paginas_por_vista);
            }

            public function Paginacion_responsiva_posisiones($paginas_por_vista){
              switch ($_GET) {
                  case isset($_GET['pagina']):
                  $page =$_GET['pagina'];
                  $nombre_get = "pagina";
                  break;
                  case isset($_GET['Cod_puesto']):
                  $page =$_GET['Cod_puesto'];
                  $nombre_get = "Cod_puesto";
                  break;
                  case isset($_GET['Nivel']):
                  $page =$_GET['Nivel'];
                  $nombre_get = "Nivel";
                  break;
                  case isset($_GET['Pos_gerente']):
                  $page =$_GET['Pos_gerente'];
                  $nombre_get = "Pos_gerente";
                  break;
                  case isset($_GET['Posision']):
                  $page =$_GET['Posision'];
                  $nombre_get = "Posision";
                  break;
                  case isset($_GET['Stock']):
                  $page =$_GET['Stock'];
                  $nombre_get = "Stock";
                  break;
                  default:
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
                //\\99.85.24.95\fotos Subadministración de Control y Análisis
            }
  
          
}