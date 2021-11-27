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
                            { angle: 90, layerSpacing: 35 })
                });
                // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
                myDiagram.nodeTemplate =
               $(go.Node, 'Vertical',
                { background: '#5B0216 '},

                  $(go.Picture,
                  { margin: 10, width: 60, height: 60, background: 'white' },
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
                      ,source: 'img/".$admins[$i]['no_empleado'].".jpg' },";
                }
                // Aqui se depositan las Subadministraciones y el nombre de los Subadministradores con su puesto operativo
                  for ($i=0; $i <count($cade_admin) ; $i++) { 
                   echo" { key: '".$cade_admin[$i]['nombre_sub_admin']."'
                    , parent: '".$cade_admin[$i]['nombre_admin']."'
                    , Estructura: '".$cade_admin[$i]['nombre_sub_admin']."' 
                    , Nombre_encargado:'".$cade_admin[$i]['nombre_sub_admin']."'
                    , Nombre_puesto: '".$cade_admin[$i]['nombre_sub_admin']."'  
                    ,source: 'img/LOGO11.png'  },";
                  }
                 // Aqui se depositan los departamentos y el nombre de los jefes de departamento con su puesto operativo
                  for ($i=0; $i <count($cade_sub) ; $i++) { 
                    echo" { key: '".$cade_sub[$i]['nombre_depto']."'
                    ,parent: '".$cade_sub[$i]['nombre_sub_admin']."'
                    ,Estructura: '".$cade_sub[$i]['nombre_depto']."'
                    ,Nombre_encargado: '".$cade_sub[$i]['nombre_depto']."'
                    ,Nombre_puesto: '".$cade_sub[$i]['nombre_depto']."'
                    ,source: 'img/LOGO11.png' },";
                   }
                echo"]);
            </script>";

          }
}