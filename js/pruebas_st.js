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
 
  [{ key: '1'
        ,Estructura: 'ADMINISTRACIÓN DESCONCENTRADA DE REACUDACIÓN DEL DISTRITO FEDERAL 4' 
        ,Nombre_encargado: 'ALEJANDRO ROMERO GUDIÑO'
        ,Nombre_puesto: 'ADMINISTRADOR DESCONCENTRADO METROPOLITANO DE RECAUDACIÓN' 
        ,source: 'img/fotos_empleados/194333.jpg' }, { key: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
      , parent: '1'
      , Estructura: 'SUB. CONTROL Y ANÁLISIS ESTRATÉGICO' 
      , Nombre_encargado:'LUIS FERNANDO GONZALEZ CID'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/49036.jpg'}, { key: 'SUBADMINISTRACIÓN DE EJECUCIÓN I'
      , parent: '1'
      , Estructura: 'SUB. EJECUCIÓN I' 
      , Nombre_encargado:'GUILLERMO RODRIGUEZ CRUZ'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/54076.jpg'}, { key: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
      , parent: '1'
      , Estructura: 'SUB. EJECUCIÓN II' 
      , Nombre_encargado:'IRASEMA AGUIRRE RAMIREZ'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/45897.jpg'}, { key: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
      , parent: '1'
      , Estructura: 'SUB. NOTIFICACIÓN' 
      , Nombre_encargado:'DOREIDE MARILIA  OTERO ROMERO'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/101388.jpg'}, { key: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES'
      , parent: '1'
      , Estructura: 'SUB. PROCESOS LEGALES' 
      , Nombre_encargado:'IRMA HERNANDEZ ALVAREZ'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/2185.jpg'}, { key: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
      , parent: '1'
      , Estructura: 'SUB. PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO' 
      , Nombre_encargado:'NORA BERMUDEZ MEJIA'
      , Nombre_puesto: 'SUBADMINISTRADOR'  
      ,source: 'img/fotos_empleados/194452.jpg'},]);
    var $ = go.GraphObject.make;
    var myDiagram1 =
    $(go.Diagram, 'Subadmin_1_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram1.nodeTemplate =
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
    myDiagram1.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram1.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram1.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
              , Estructura: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO' 
              , Nombre_encargado:'LUIS FERNANDO GONZALEZ CID'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/49036.jpg'},{ key: 'BÓVEDA DE CRÉDITOS'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'BÓVEDA DE CRÉDITOS' 
                   , Nombre_encargado:'MARIA DEL ROCIO OLVERA BAZAN'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/4533.jpg'},{ key: 'CANCELACIÓN DE SELLOS DIGITALES'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                   , Nombre_encargado:'JOSE JULIO GALICIA FRANCO'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/174488.jpg'},{ key: 'CONTROL Y ANALISIS ESTRATEGICO'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                   , Nombre_encargado:'MARISELA SANTA ROSA GARCIA'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/44972.jpg'},{ key: 'INVENTARIOS'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'INVENTARIOS' 
                   , Nombre_encargado:'ANTONIO ARTURO SANDOVAL SERRALDE'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/194411.jpg'},{ key: 'INVESTIGACIÓN'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'INVESTIGACIÓN' 
                   , Nombre_encargado:'PABLO RAMIREZ MENDEZ'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/185962.jpg'},{ key: 'OFICIALÍA DE PARTES'
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'OFICIALÍA DE PARTES' 
                   , Nombre_encargado:'EDGAR VERTIZ PEREZ'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/106690.jpg'},{ key: 'RECURSOS Y SERVICIOS '
                   , parent: 'SUBADMINISTRACIÓN DE CONTROL Y ANÁLISIS ESTRATÉGICO'
                   , Estructura: 'RECURSOS Y SERVICIOS ' 
                   , Nombre_encargado:'CAROLINA SÁNCHEZ CERON'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/54681.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram3 =
    $(go.Diagram, 'Subadmin_3_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram3.nodeTemplate =
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
    myDiagram3.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram3.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram3.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE EJECUCIÓN I'
              , Estructura: 'SUBADMINISTRACIÓN DE EJECUCIÓN I' 
              , Nombre_encargado:'GUILLERMO RODRIGUEZ CRUZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/54076.jpg'},{ key: 'COBRO PERSUASIVO I'
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN I'
                   , Estructura: 'COBRO PERSUASIVO I' 
                   , Nombre_encargado:'JONATHAN EDUARDO JIMENEZ MARTINEZ'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/100620.jpg'},{ key: 'EJECUCIÓN TOP I '
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN I'
                   , Estructura: 'EJECUCIÓN TOP I ' 
                   , Nombre_encargado:'OLGA MARIA MOLINA RENZAURES'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/137629.jpg'},{ key: 'EJECUCIÓN TOP II'
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN I'
                   , Estructura: 'EJECUCIÓN TOP II' 
                   , Nombre_encargado:'MARI TERE LOPEZ VELAZQUEZ'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/144384.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram7 =
    $(go.Diagram, 'Subadmin_7_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram7.nodeTemplate =
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
    myDiagram7.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram7.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram7.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
              , Estructura: 'SUBADMINISTRACIÓN DE EJECUCIÓN II' 
              , Nombre_encargado:'IRASEMA AGUIRRE RAMIREZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/45897.jpg'},{ key: 'COBRO PERSUASIVO II '
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
                   , Estructura: 'COBRO PERSUASIVO II ' 
                   , Nombre_encargado:'CIRCE GRANADOS SILVA'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/132744.jpg'},{ key: 'EJECUCIÓN III'
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
                   , Estructura: 'EJECUCIÓN III' 
                   , Nombre_encargado:'ARMANDO MENDOZA AVILES'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/131338.jpg'},{ key: 'EJECUCIÓN IV'
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
                   , Estructura: 'EJECUCIÓN IV' 
                   , Nombre_encargado:'CAROLINA JIMENEZ CORTES'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/74600.jpg'},{ key: 'EJECUCIÓN V'
                   , parent: 'SUBADMINISTRACIÓN DE EJECUCIÓN II'
                   , Estructura: 'EJECUCIÓN V' 
                   , Nombre_encargado:'LILIANA DIAZ MORENO'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/75007.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram4 =
    $(go.Diagram, 'Subadmin_4_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram4.nodeTemplate =
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
    myDiagram4.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram4.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram4.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
              , Estructura: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN' 
              , Nombre_encargado:'DOREIDE MARILIA  OTERO ROMERO'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/101388.jpg'},{ key: 'COBRO PERSUASIVO III'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'COBRO PERSUASIVO III' 
                   , Nombre_encargado:'MARCO ANTONIO MEJIA GONZALEZ'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/76643.jpg'},{ key: 'CONTROL DE DOCUMENTOS'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'CONTROL DE DOCUMENTOS' 
                   , Nombre_encargado:'RAMÓN HERNÁNDEZ QUIROZ'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/63884.jpg'},{ key: 'EJECUCIÓN VI'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'EJECUCIÓN VI' 
                   , Nombre_encargado:'HUGO HERNANDEZ CATALAN'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/172091.jpg'},{ key: 'EJECUCIÓN VII'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'EJECUCIÓN VII' 
                   , Nombre_encargado:'ANAID CONSTANZA RIVERA VALDIVIA'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/64520.jpg'},{ key: 'EJECUCIÓN VIII'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'EJECUCIÓN VIII' 
                   , Nombre_encargado:'MIGUEL ANGEL GAMEZ RODRIGUEZ'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/172095.jpg'},{ key: 'UNIDAD DE DILIGENCIACION'
                   , parent: 'SUBADMINISTRACIÓN DE NOTIFICACIÓN'
                   , Estructura: 'UNIDAD DE DILIGENCIACION' 
                   , Nombre_encargado:'DAVID ANTONIO GALINDO HERNANDEZ'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/178970.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram6 =
    $(go.Diagram, 'Subadmin_6_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram6.nodeTemplate =
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
    myDiagram6.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram6.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram6.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES'
              , Estructura: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES' 
              , Nombre_encargado:'IRMA HERNANDEZ ALVAREZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/2185.jpg'},{ key: 'MULTAS JUDICIALES'
                   , parent: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES'
                   , Estructura: 'MULTAS JUDICIALES' 
                   , Nombre_encargado:'MARISSA LOZANO CONSTANTINO'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/64907.jpg'},{ key: 'PROCESOS LEGALES I'
                   , parent: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES'
                   , Estructura: 'PROCESOS LEGALES I' 
                   , Nombre_encargado:'MIRIAM NAVA CONTRERAS'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/52342.jpg'},{ key: 'PROCESOS LEGALES II'
                   , parent: 'SUBADMINISTRACIÓN DE PROCESOS LEGALES'
                   , Estructura: 'PROCESOS LEGALES II' 
                   , Nombre_encargado:'CARMINA MUÑOZ LUNA'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/149288.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram5 =
    $(go.Diagram, 'Subadmin_5_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram5.nodeTemplate =
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
    myDiagram5.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram5.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram5.model = new go.TreeModel(
            [
            { key: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
              , Estructura: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO' 
              , Nombre_encargado:'NORA BERMUDEZ MEJIA'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/194452.jpg'},{ key: 'CUMPLIMIENTO I'
                   , parent: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
                   , Estructura: 'CUMPLIMIENTO I' 
                   , Nombre_encargado:'FRANCISCO PÉREZ CAMARENA'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/4719.jpg'},{ key: 'CUMPLIMIENTO II'
                   , parent: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
                   , Estructura: 'CUMPLIMIENTO II' 
                   , Nombre_encargado:'LUIS FERNANDO MORALES SALDAÑA'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/80537.jpg'},{ key: 'CUMPLIMIENTO III'
                   , parent: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
                   , Estructura: 'CUMPLIMIENTO III' 
                   , Nombre_encargado:'DAMARIS BELEN HERNANDEZ CANSINO'
                   , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/177383.jpg'},{ key: 'DECLARACIONES Y PAGOS'
                   , parent: 'SUBADMINISTRACIÓN DE PROMOCIÓN Y VIGILANCIA DE CUMPLIMIENTO'
                   , Estructura: 'DECLARACIONES Y PAGOS' 
                   , Nombre_encargado:'MARIBEL MARTINEZ PIEDRA'
                   , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
                   ,source: 'img/fotos_empleados/196493.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram1 =
    $(go.Diagram, 'departamento_1_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram1.nodeTemplate =
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
    myDiagram1.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram1.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram1.model = new go.TreeModel(
            [
            { key: '4'
              , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
              , Nombre_encargado:'MARISELA SANTA ROSA GARCIA'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/44972.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'ANDRÉS MARES SÁNCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/190772.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'JOSE ALBERTO CRUZ CARDOSO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178522.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'LAURA BEATRIZ TRUJILLO ISLAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3822.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'EDUARDO HAZAEL OROZCO FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186523.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'ALEJANDRO ZAVALETA AYALA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182694.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'LEONARDO MOISES MIRAFUENTES MARTINEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185217.jpg'},{ key: '4'
                    , parent: '4'
                    , Estructura: 'CONTROL Y ANALISIS ESTRATEGICO' 
                    , Nombre_encargado:'JUAN JOSE CONSUELO AGUIRRE BECERRIL'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4309.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram2 =
    $(go.Diagram, 'departamento_2_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram2.nodeTemplate =
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
    myDiagram2.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram2.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram2.model = new go.TreeModel(
            [
            { key: '17'
              , Estructura: 'RECURSOS Y SERVICIOS ' 
              , Nombre_encargado:'CAROLINA SÁNCHEZ CERON'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/54681.jpg'},{ key: '17'
                    , parent: '17'
                    , Estructura: 'RECURSOS Y SERVICIOS ' 
                    , Nombre_encargado:'ANA MARIA RODRIGUEZ MORALES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/54274.jpg'},{ key: '17'
                    , parent: '17'
                    , Estructura: 'RECURSOS Y SERVICIOS ' 
                    , Nombre_encargado:'ERIC ENRIQUE REYES ROSAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/172145.jpg'},{ key: '17'
                    , parent: '17'
                    , Estructura: 'RECURSOS Y SERVICIOS ' 
                    , Nombre_encargado:'PEDRO ANCONA MEDINA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195962.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram3 =
    $(go.Diagram, 'departamento_3_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram3.nodeTemplate =
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
    myDiagram3.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram3.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram3.model = new go.TreeModel(
            [
            { key: '23'
              , Estructura: 'INVENTARIOS' 
              , Nombre_encargado:'ANTONIO ARTURO SANDOVAL SERRALDE'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/194411.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'FRIDA ITZEL LARA RAMIREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/183294.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'CHRISTIAN RAMIREZ MARTINEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185150.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'XOCHITL ALBARRAN MIRANDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3894.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'KEVIN RODRIGUEZ NAVARRETE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/176958.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'JOSE BERNARDO ROMERO SANCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4755.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'EVELIN ANAID HERNANDEZ CAMPOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175327.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'ERICKA LOPEZ JIMENEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/170352.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'JOSE ANTONIO  BELMONT  TORRES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/145510.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'ERIK  GONZALEZ NAVARRO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/95990.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'ISMAEL HERNANDEZ BECERRIL'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11754.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'MARISOL  TORRES MORALES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194854.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'MIRIAM  PEREZ LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2701.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'HILARIO RICARDO  ALVAREZ SERRANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3584.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'SERGIO EDUARDO  JIMENEZ MANRIQUE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11893.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'IRIDIAN ANAHI  MONROY TAPIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/172092.jpg'},{ key: '23'
                    , parent: '23'
                    , Estructura: 'INVENTARIOS' 
                    , Nombre_encargado:'JOSE LUIS  ENRIQUEZ MEDINA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/41440.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram4 =
    $(go.Diagram, 'departamento_4_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram4.nodeTemplate =
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
    myDiagram4.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram4.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram4.model = new go.TreeModel(
            [
            { key: '21'
              , Estructura: 'BÓVEDA DE CRÉDITOS' 
              , Nombre_encargado:'MARIA DEL ROCIO OLVERA BAZAN'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/4533.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'BEATRIZ BECERRIL BELTRAN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4570.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'BARBARA HAYDEE VARELA JIMENEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/176410.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ELIZABETH DALILA HERNANDEZ GALAVIZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/90810.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'DOMINGO RODRIGUEZ VELAZQUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4757.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ARTURO TORRES GOMEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/27720.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'GILBERTO ANDRES BECERRIL TAPIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2644.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'MARIANA ALEXIS ROMERO FUENTES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178523.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ANGEL GARCIA GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4630.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'JOSE LUIS FLORES HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3638.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'LUZ MARIA GALICIA OMAÑA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4634.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ANTONIO NICOLAS ROJAS JIMENEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2712.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'FRANCISCO JAVIER ALFARO ZUÑIGA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4557.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'MARIA DE LOS ANGELES DOMINGUEZ CASTRO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2656.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'JOSE FERNANDO ALVAREZ MANCILLA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/62672.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ANA PAOLA AGUILAR CALDERON'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/97562.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'EDITH JUAREZ MENDIETA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2208.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ALFREDO CARRILLO TORRES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/149031.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'FELIPE ANTONIO  HERNÁNDEZ YÁÑEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193826.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'JAIME DAVID  MARIN VERGARA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/168383.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'SILVIA  ARROYO VELAZQUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/40365.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'SERGIO  MONCAYO HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11785.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'MARIA GUADALUPE  ESPINOSA FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38577.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ALFONSO CORTES GALINDO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186399.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'DAVID ARMANDO  GONZALEZ MARTINEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175803.jpg'},{ key: '21'
                    , parent: '21'
                    , Estructura: 'BÓVEDA DE CRÉDITOS' 
                    , Nombre_encargado:'ISRAEL  HERRERA CERVANTES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/157653.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram5 =
    $(go.Diagram, 'departamento_5_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram5.nodeTemplate =
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
    myDiagram5.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram5.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram5.model = new go.TreeModel(
            [
            { key: '3'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'LUIS FERNANDO GONZALEZ CID'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/49036.jpg'},{ key: '3'
                    , parent: '3'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'ROCIO GUADALUPE RODRIGUEZ CORTES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4747.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram6 =
    $(go.Diagram, 'departamento_6_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram6.nodeTemplate =
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
    myDiagram6.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram6.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram6.model = new go.TreeModel(
            [
            { key: '24'
              , Estructura: 'OFICIALÍA DE PARTES' 
              , Nombre_encargado:'EDGAR VERTIZ PEREZ'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/106690.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'MARIA ISABEL HERNANDEZ BERMEJO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4658.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'LUIS ALFREDO SUSANO MARTINEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/174366.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'ALVARO FUENTES LAURO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3641.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'NORMA HERNANDEZ RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/58187.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'JORGE LARA AGUILAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/45144.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'ARTURO BECERRIL IBAÑEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38578.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'RICARDO PEREZ GOMEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/75234.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'ROSA MARIA MICAELA GOMEZ CASTELLANOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3665.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'GUSTAVO GONZALEZ OTERO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/87322.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'ADRIANA GUADALUPE DEL ANGEL ROSAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/176345.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'ELIAS  TOLEDO TORRES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/60374.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'BRENDA YANIN  AGUIRRE NIETO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173184.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'MARCO ANTONIO  FLORES TOVAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/100299.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'SERGIO  ANTUNEZ REYNOSA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/45126.jpg'},{ key: '24'
                    , parent: '24'
                    , Estructura: 'OFICIALÍA DE PARTES' 
                    , Nombre_encargado:'MAURICIO MANUEL  GUTIERREZ RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/161484.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram7 =
    $(go.Diagram, 'departamento_7_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram7.nodeTemplate =
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
    myDiagram7.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram7.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram7.model = new go.TreeModel(
            [
            { key: '22'
              , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
              , Nombre_encargado:'JOSE JULIO GALICIA FRANCO'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/174488.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'MARIA ASUNCION RODRIGUEZ NOYOLA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2855.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'ADRIANA INTRIAGO VALDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/34330.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'MARIA DE LOS ANGELES  FLORES SANDOVAL'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/96225.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'CECILIA  PACHECO VENTURA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/52981.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'CARLOS ROBERTO  PEREZ VILLALOBOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4722.jpg'},{ key: '22'
                    , parent: '22'
                    , Estructura: 'CANCELACIÓN DE SELLOS DIGITALES' 
                    , Nombre_encargado:'BEATRIZ  SANCHEZ LARABARRAGAN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64929.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram34 =
    $(go.Diagram, 'departamento_34_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram34.nodeTemplate =
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
    myDiagram34.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram34.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram34.model = new go.TreeModel(
            [
            { key: '20'
              , Estructura: 'INVESTIGACIÓN' 
              , Nombre_encargado:'PABLO RAMIREZ MENDEZ'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/185962.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'EVELIA GARCIA HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/122856.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'MARCO ANTONIO ESCOBAR ALMARAZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173708.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'LAURA MATIAS MONCADA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3706.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'HILDA QUINTANILLA PULIDO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/147042.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'MARÍA ISABEL  GARCÍA VENTURA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194751.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'MARIA GUADALUPE  TREJO SAINZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/8727.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'MAGALY EUGENIA  MILLAN BECERRIL'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/191578.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'MARIA EDITH  MARQUEZ JUAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/7564.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'KARIN  SANDOVAL PÉREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193234.jpg'},{ key: '20'
                    , parent: '20'
                    , Estructura: 'INVESTIGACIÓN' 
                    , Nombre_encargado:'ISMAEL  PEREZ GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4720.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram33 =
    $(go.Diagram, 'departamento_33_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram33.nodeTemplate =
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
    myDiagram33.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram33.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram33.model = new go.TreeModel(
            [
            { key: '2'
              , Estructura: 'ADMINISTRACIÓN' 
              , Nombre_encargado:'ALEJANDRO ROMERO GUDIÑO'
              , Nombre_puesto: 'ADMINISTRADOR DESCONCENTRADO METROPOLITANO DE RECAUDACIÓN'  
              ,source: 'img/fotos_empleados/194333.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram8 =
    $(go.Diagram, 'departamento_8_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram8.nodeTemplate =
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
    myDiagram8.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram8.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram8.model = new go.TreeModel(
            [
            { key: '27'
              , Estructura: 'EJECUCIÓN TOP I ' 
              , Nombre_encargado:'OLGA MARIA MOLINA RENZAURES'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/137629.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'ERIKA GARCIA RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/160296.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'DANIEL CAMACHO GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/156712.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'ANGELICA CRUZ ALVARADO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/176466.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'JAIR ERNESTO  CARMONA OSNAYA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64950.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'ARIEL  PLIEGO BRAVO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186403.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'LIZETT  HUERTA JARDINES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182348.jpg'},{ key: '27'
                    , parent: '27'
                    , Estructura: 'EJECUCIÓN TOP I ' 
                    , Nombre_encargado:'HILDA ELISA CORREA RAUDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195926.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram9 =
    $(go.Diagram, 'departamento_9_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram9.nodeTemplate =
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
    myDiagram9.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram9.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram9.model = new go.TreeModel(
            [
            { key: '26'
              , Estructura: 'EJECUCIÓN TOP II' 
              , Nombre_encargado:'MARI TERE LOPEZ VELAZQUEZ'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/144384.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'LILIANA CORTES ROSASLANDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186454.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'MIGUEL ANGEL LOPEZ MONCAYO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4680.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'MARIA DE LA LUZ  ESCOBAR  VALDERRAMA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/65218.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'BRENDA FABIOLA  SANCHEZ GALVAN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/187552.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'MONICA  CARRERA TEJEDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/191274.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'ALEXIS  SANTANA DE  LA CRUZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193119.jpg'},{ key: '26'
                    , parent: '26'
                    , Estructura: 'EJECUCIÓN TOP II' 
                    , Nombre_encargado:'PAOLA  RANGEL ZAVALA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185979.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram10 =
    $(go.Diagram, 'departamento_10_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram10.nodeTemplate =
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
    myDiagram10.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram10.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram10.model = new go.TreeModel(
            [
            { key: '6'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'GUILLERMO RODRIGUEZ CRUZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/54076.jpg'},{ key: '6'
                    , parent: '6'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'NORBELLA PADILLA GALLEGOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/94573.jpg'},{ key: '6'
                    , parent: '6'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'CLAUDIA ARLETTE ALATRISTE LÓPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195955.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram11 =
    $(go.Diagram, 'departamento_11_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram11.nodeTemplate =
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
    myDiagram11.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram11.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram11.model = new go.TreeModel(
            [
            { key: '28'
              , Estructura: 'COBRO PERSUASIVO I' 
              , Nombre_encargado:'JONATHAN EDUARDO JIMENEZ MARTINEZ'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/100620.jpg'},{ key: '28'
                    , parent: '28'
                    , Estructura: 'COBRO PERSUASIVO I' 
                    , Nombre_encargado:'GRACIELA GARCIA LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/73557.jpg'},{ key: '28'
                    , parent: '28'
                    , Estructura: 'COBRO PERSUASIVO I' 
                    , Nombre_encargado:'MAURA ALICIA MORENO  ARISTA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/110794.jpg'},{ key: '28'
                    , parent: '28'
                    , Estructura: 'COBRO PERSUASIVO I' 
                    , Nombre_encargado:'JOAQUIN NICOLAS  SALGADO ALATORRE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/78433.jpg'},{ key: '28'
                    , parent: '28'
                    , Estructura: 'COBRO PERSUASIVO I' 
                    , Nombre_encargado:'MA LOURDES  RUIZ BOCANEGRA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4758.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram18 =
    $(go.Diagram, 'departamento_18_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram18.nodeTemplate =
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
    myDiagram18.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram18.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram18.model = new go.TreeModel(
            [
            { key: '35'
              , Estructura: 'COBRO PERSUASIVO III' 
              , Nombre_encargado:'MARCO ANTONIO MEJIA GONZALEZ'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/76643.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'SUSANA SOTO ORDAZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4775.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'ARMANDO ZARCO POBLANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178510.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'JESSICA BELEN DELGADO VALDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193391.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'GABRIELA ROMERO ZUÑIGA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/152875.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'MARIA CRISTINA JUAREZ GUTIERREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4670.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'ESTEFANIA IBARRA MENDOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/169869.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'CRISTIAN OBED  GUEVARA PARRA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185871.jpg'},{ key: '35'
                    , parent: '35'
                    , Estructura: 'COBRO PERSUASIVO III' 
                    , Nombre_encargado:'ANA LUISA  DEL VALLE BENAVIDES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/162968.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram19 =
    $(go.Diagram, 'departamento_19_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram19.nodeTemplate =
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
    myDiagram19.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram19.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram19.model = new go.TreeModel(
            [
            { key: '36'
              , Estructura: 'CONTROL DE DOCUMENTOS' 
              , Nombre_encargado:'RAMÓN HERNÁNDEZ QUIROZ'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/63884.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'LUIS ALBERTO LOPEZ BARRIOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182666.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'ALEJANDRO VELASCO OLVERA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4790.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'DANIEL ROMERO PALOMARES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/187460.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'JOSE OSCAR ARENAS TIZAYUCA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64040.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'ROSA MARTHA AVELAR GARAY'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3898.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'MARIA DE JESUS CASAS HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38451.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'ROSALBA ROBLEDO RAMIREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11900.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'JOSE IGNACIO GALLEGOS HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/183296.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'ARTURO DIEGUEZ RAMOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11778.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'ENDI MARIANA AGUILERA QUEZADA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/60947.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'VICTOR MANUEL ALARCON HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/45281.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'GEORGINA PARDO TOTO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64127.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'LEONARDO HERNANDEZ CHORA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/184950.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'EDGAR ALEJANDRO  CONTRERAS MEZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/149277.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'MARIA DE LOURDES  FUENTES OJEDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/44226.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'FERNANDO  ESPINDOLA GUTIERREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/177640.jpg'},{ key: '36'
                    , parent: '36'
                    , Estructura: 'CONTROL DE DOCUMENTOS' 
                    , Nombre_encargado:'RODRIGO  SÁNCHEZ  ESCOBAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195943.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram20 =
    $(go.Diagram, 'departamento_20_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram20.nodeTemplate =
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
    myDiagram20.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram20.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram20.model = new go.TreeModel(
            [
            { key: '34'
              , Estructura: 'EJECUCIÓN VI' 
              , Nombre_encargado:'HUGO HERNANDEZ CATALAN'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/172091.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'CESAR JAIR RAMIREZ BECERRIL'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/91299.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'LUIS SANDOVAL BECERRA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2333.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'JOSE MANUEL GUZMAN SANCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185980.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'LUIS MANUEL RODRIGUEZ MEDINA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178520.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'CARLOS TORRES LANDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/55627.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'MARIA MAGDALENA ALVA ROMAN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3582.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'JOSUE LEON CANSINO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178500.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'SANDY LUCERO  MIRANDA RUIZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/177432.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'SAUL DAVID  ZAMORA HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/183728.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'REINA  TELLEZ MODESTO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/190121.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'ELVIA  VERA LAGUNA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/42637.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'DILCIA MONTSERRAT  JIMENEZ CRUZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/187821.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'EDZON JOEL  VAZQUEZ GOMEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/170785.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'MARIAN  RIVAS TOLEDO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175335.jpg'},{ key: '34'
                    , parent: '34'
                    , Estructura: 'EJECUCIÓN VI' 
                    , Nombre_encargado:'RODRIGO ALEGRIA MONTENEGRO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195958.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram21 =
    $(go.Diagram, 'departamento_21_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram21.nodeTemplate =
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
    myDiagram21.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram21.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram21.model = new go.TreeModel(
            [
            { key: '33'
              , Estructura: 'EJECUCIÓN VII' 
              , Nombre_encargado:'ANAID CONSTANZA RIVERA VALDIVIA'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/64520.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'OLIVER FABIAN SOLIS JUAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182634.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'LYDIA LARA FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3691.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'MARISOL LOPEZ CRUZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/177591.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'RICARDO BENZ RIVERA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/63883.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'ROSA DEL REFUGIO  ESQUIVEL  HERRERA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/174659.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'XOCHITL GABRIELA  PEREZ VILLANUEVA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/190067.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'MARCO ANTONIO  ECHEVERRIA GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194721.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'VANIA  MARTINEZ HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/189007.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'JULIO CESAR JIMENEZ MODESTO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/167320.jpg'},{ key: '33'
                    , parent: '33'
                    , Estructura: 'EJECUCIÓN VII' 
                    , Nombre_encargado:'ANDREA PAULE VALENCIA KHURY'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/195491.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram22 =
    $(go.Diagram, 'departamento_22_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram22.nodeTemplate =
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
    myDiagram22.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram22.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram22.model = new go.TreeModel(
            [
            { key: '8'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'DOREIDE MARILIA  OTERO ROMERO'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/101388.jpg'},{ key: '8'
                    , parent: '8'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'TERESA ESPINOSA ACOSTA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/58016.jpg'},{ key: '8'
                    , parent: '8'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'ALFONSO  MARQUEZ RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38443.jpg'},{ key: '8'
                    , parent: '8'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'ARTURO POZOS ORTIZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/196527.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram23 =
    $(go.Diagram, 'departamento_23_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram23.nodeTemplate =
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
    myDiagram23.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram23.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram23.model = new go.TreeModel(
            [
            { key: '37'
              , Estructura: 'UNIDAD DE DILIGENCIACION' 
              , Nombre_encargado:'DAVID ANTONIO GALINDO HERNANDEZ'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/178970.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'MARIA DE LOURDES CHACON ORNELAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/76231.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'ELIAS GUADALUPE ROYACELLI GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/146110.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'JOSE LUIS  CALZADA  ZAMORA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/47001.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'ERNESTO GARCIA ORTIZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/48732.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'JESUS EZEQUIEL  SANTOS  NAJERA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185218.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'VICTOR JIMENEZ GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/50310.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'RAUL  VELAZQUEZ GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/56171.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'GERMAN  ALVARADO JUAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64951.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'ROCIO  MACIAS ALVAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/67905.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'ELIEL  SANTIAGO TORRES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/69294.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'ROCIO  BENITEZ LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/98377.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'GERARDO  CASTILLO JIMENEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/174737.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'SANDRA  RAMIREZ BENITEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194873.jpg'},{ key: '37'
                    , parent: '37'
                    , Estructura: 'UNIDAD DE DILIGENCIACION' 
                    , Nombre_encargado:'JESSICA ADRIANA SÁNCHEZ GUZMÁN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194304.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram36 =
    $(go.Diagram, 'departamento_36_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram36.nodeTemplate =
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
    myDiagram36.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram36.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram36.model = new go.TreeModel(
            [
            { key: '13114'
              , Estructura: 'EJECUCIÓN VIII' 
              , Nombre_encargado:'MIGUEL ANGEL GAMEZ RODRIGUEZ'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/172095.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'PEDRO ORTIZ GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4716.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'ELVIA JUAREZ LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/32652.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'GERMAN GARCIA AGUILAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/191318.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'CESAR RAUL HEREDIA SANCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/70824.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'AURA CELESTE BUSTOS BOLAÑOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/133675.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'MARBELLA VIZUET GARDUÑO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182478.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'FERNANDO ALEJANDRO  BAHENA MENDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193292.jpg'},{ key: '13114'
                    , parent: '13114'
                    , Estructura: 'EJECUCIÓN VIII' 
                    , Nombre_encargado:'ZAHIRA  GUTIERREZ VELAZQUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/171331.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram24 =
    $(go.Diagram, 'departamento_24_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram24.nodeTemplate =
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
    myDiagram24.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram24.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram24.model = new go.TreeModel(
            [
            { key: '41'
              , Estructura: 'CUMPLIMIENTO I' 
              , Nombre_encargado:'FRANCISCO PÉREZ CAMARENA'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/4719.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'IRMA ROCIO VELAZQUEZ ZARATE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4795.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'JAVIER ALEJANDRO CARDIEL SANCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/40145.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'JESUS EDER CASTRO ALANIS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178488.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'GUADALUPE LAURA ROMAN ESPARZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3787.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'REYES DOMINGUEZ FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38257.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'MARIA DE LOURDES JORDANA NAJERA FUENTES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/115218.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'MARIA DE LOS ANGELES MUÑOZ MUÑOZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/74189.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'DANIELA GUADALUPE ACUÑA SOLORIO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/94090.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'FRANCISCO JAVIER  MONTES REYES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/140871.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'ANA CARLOTA  JIMENEZ SEDANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/183078.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'GABRIELA  SANCHEZ AGUILAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/54634.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'MARIA CLEOTILDE ARACELI  PEREZ ROSAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11376.jpg'},{ key: '41'
                    , parent: '41'
                    , Estructura: 'CUMPLIMIENTO I' 
                    , Nombre_encargado:'ROCIO NALLELY  ESLAVA LUNA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/78371.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram25 =
    $(go.Diagram, 'departamento_25_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram25.nodeTemplate =
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
    myDiagram25.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram25.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram25.model = new go.TreeModel(
            [
            { key: '42'
              , Estructura: 'CUMPLIMIENTO II' 
              , Nombre_encargado:'LUIS FERNANDO MORALES SALDAÑA'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/80537.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'BRAYAN MEDINA AVENDAÑO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178497.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'GLORIA DAMIAN EMILIANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175381.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'MAIRA ANDREA  AGUILAR DEL VALLE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/177140.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'LETICIA CRUZ MARTINEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/69077.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'JUAN NAJERA GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/168835.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'LETICIA NAJERA GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/171330.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'ANTONIO SALATIEL RAMIREZ HERNANDEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/144956.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'MARISOL  ESPINA VILCHIS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175279.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'NANCY  HERNANDEZ AGUILAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178154.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'DORA ARACELI  GUTIÉRREZ PACHECO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193293.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'MARIA GUADALUPE  ZAMORA SOLANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/194750.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'GREGORIO JOAQUIN  HERNANDEZ QUIROZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/62013.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'SILVIA VICTORIA  BUENDIA LARA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4577.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'JULIO CESAR  FLORES RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/84443.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'ITZEL SARAYD  HERNANDEZ OROPA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/113755.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'JOAQUIN  DIAZ MALAGON'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38446.jpg'},{ key: '42'
                    , parent: '42'
                    , Estructura: 'CUMPLIMIENTO II' 
                    , Nombre_encargado:'ESMERALDA GUADALUPE  NORIEGA MONTAÑO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178524.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram28 =
    $(go.Diagram, 'departamento_28_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram28.nodeTemplate =
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
    myDiagram28.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram28.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram28.model = new go.TreeModel(
            [
            { key: '9'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'NORA BERMUDEZ MEJIA'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/194452.jpg'},{ key: '9'
                    , parent: '9'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'SONIA LORA MONROY'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/2674.jpg'},{ key: '9'
                    , parent: '9'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'MARIA REMEDIOS GRANADOS BERBER'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4628.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram35 =
    $(go.Diagram, 'departamento_35_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram35.nodeTemplate =
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
    myDiagram35.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram35.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram35.model = new go.TreeModel(
            [
            { key: '13260'
              , Estructura: 'DECLARACIONES Y PAGOS' 
              , Nombre_encargado:'MARIBEL MARTINEZ PIEDRA'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/196493.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'JOSEFINA REYNAGA  PANIAGUA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3776.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'JOSE ANTONIO RODRIGUEZ AGUILAR'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4744.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'PATRICIA  DE LA ROSA SEGURA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38439.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'JUAN ALBERTO DIAZ REYES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175766.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'CINTHYA ESBEIDY MEDINA GOMEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/150144.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'MARCO ANTONIO LOPEZ RODRIGUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/71902.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'AMPARO  ESPINOZA ESPINOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38445.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'CECILIA  ALEJANDRO AVILA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38448.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'MARIA DE JESUS MARCELA  VALENZUELA REZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3837.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'NIELSY VIANEY  BARRIOS RIVERA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/160636.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'MARIANA ALEJANDRA  LOPEZ MENDOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182340.jpg'},{ key: '13260'
                    , parent: '13260'
                    , Estructura: 'DECLARACIONES Y PAGOS' 
                    , Nombre_encargado:'JORGE ALEJANDRO CASTILLO CANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/193538.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram37 =
    $(go.Diagram, 'departamento_37_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram37.nodeTemplate =
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
    myDiagram37.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram37.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram37.model = new go.TreeModel(
            [
            { key: '44'
              , Estructura: 'CUMPLIMIENTO III' 
              , Nombre_encargado:'DAMARIS BELEN HERNANDEZ CANSINO'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/177383.jpg'},{ key: '44'
                    , parent: '44'
                    , Estructura: 'CUMPLIMIENTO III' 
                    , Nombre_encargado:'OSCAR  GRANADOS FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/178477.jpg'},{ key: '44'
                    , parent: '44'
                    , Estructura: 'CUMPLIMIENTO III' 
                    , Nombre_encargado:'DOLORES LÓPEZ MARTÍNEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/196438.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram29 =
    $(go.Diagram, 'departamento_29_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram29.nodeTemplate =
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
    myDiagram29.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram29.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram29.model = new go.TreeModel(
            [
            { key: '38'
              , Estructura: 'PROCESOS LEGALES I' 
              , Nombre_encargado:'MIRIAM NAVA CONTRERAS'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/52342.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'JESÚS ALBERTO ARELLANO GARCÍA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/191460.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'AARON SANCHEZ NORBERTO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185219.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'DAVID GUADARRAMA MENDOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/192307.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'YOLANDA ELIZABETH  CORTES JACOBO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/66002.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'LILIANA LIZBETH  CHAVEZ ZAMUDIO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/91059.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'LOURDES ISABEL  GOMEZ GUTIERREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/187509.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'PAULO RENATO  POBLANO VALDERRAMA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/192469.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'LUCIO  SANCHEZ GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3800.jpg'},{ key: '38'
                    , parent: '38'
                    , Estructura: 'PROCESOS LEGALES I' 
                    , Nombre_encargado:'ISAAC  GONZALEZ  RAMIREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/192193.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram30 =
    $(go.Diagram, 'departamento_30_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram30.nodeTemplate =
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
    myDiagram30.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram30.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram30.model = new go.TreeModel(
            [
            { key: '39'
              , Estructura: 'PROCESOS LEGALES II' 
              , Nombre_encargado:'CARMINA MUÑOZ LUNA'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/149288.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'BERNARDINA PADILLA GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3748.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'MAURICIO RAMIREZ GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/58833.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'DORA ALICIA BAEZA REYES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173928.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'DIANA SANCHEZ MONZALVO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/185621.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'NANCY CHAO TAPIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173199.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'ROBERTO ORTIZ CASTAÑEDA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/71635.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'GUADALUPE ERIKA ZERMEÑO RIOFRIO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/56581.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'ZARAHY VONIZU  MEZA  RAYA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/134453.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'NAYELI VARGAS DAVILA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/160130.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'VICTOR URIEL  HERNANDEZ MENDOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/131857.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'ANTONIO  FLORES REYNA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/175041.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'DIANA GARCIA ISLAS GARCIA ISLAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186525.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'SARA  URDIAIN CASTILLO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3824.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'MINERVA GARCIA GUDIÑO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/196439.jpg'},{ key: '39'
                    , parent: '39'
                    , Estructura: 'PROCESOS LEGALES II' 
                    , Nombre_encargado:'SIGFRIDO JAVIER CAMACHO RIOS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/196522.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram31 =
    $(go.Diagram, 'departamento_31_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram31.nodeTemplate =
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
    myDiagram31.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram31.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram31.model = new go.TreeModel(
            [
            { key: '40'
              , Estructura: 'MULTAS JUDICIALES' 
              , Nombre_encargado:'MARISSA LOZANO CONSTANTINO'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/64907.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'ANTONIO ALTAMIRA FLORES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/61029.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'ROCIO CRUZ AVILA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/189705.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'LESLI LUZ  FELICITOS LOZANO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/183884.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'DANIELA POBLETE SUAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173863.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'CARINA MONSERRAT  GUTIERREZ INFANTE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182984.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'ENRIQUE  MARQUEZ GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186315.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'ALFONSO  VALDESPINO LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/75236.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'PATRICIA  URBAN URIOLES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4781.jpg'},{ key: '40'
                    , parent: '40'
                    , Estructura: 'MULTAS JUDICIALES' 
                    , Nombre_encargado:'ULISES  MARTINEZ GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/186397.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram32 =
    $(go.Diagram, 'departamento_32_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram32.nodeTemplate =
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
    myDiagram32.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram32.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram32.model = new go.TreeModel(
            [
            { key: '5'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'IRMA HERNANDEZ ALVAREZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/2185.jpg'},{ key: '5'
                    , parent: '5'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'TERESA RODRIGUEZ ZAPATA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/151235.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram13 =
    $(go.Diagram, 'departamento_13_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram13.nodeTemplate =
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
    myDiagram13.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram13.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram13.model = new go.TreeModel(
            [
            { key: '25'
              , Estructura: 'COBRO PERSUASIVO II ' 
              , Nombre_encargado:'CIRCE GRANADOS SILVA'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/132744.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'PABLO PEDRO RUIZ GONZALEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/54542.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'NANCY CHAVEZ PEREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/177283.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'ARACELI OLVERA VAZQUEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/7608.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'MARISOL  HERNÁNDEZ TÉLLEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/1795.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'HANZ CRISTIAN  FLORES DEL MONTE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/158863.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'RAQUEL  GOMEZ VALENCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/39386.jpg'},{ key: '25'
                    , parent: '25'
                    , Estructura: 'COBRO PERSUASIVO II ' 
                    , Nombre_encargado:'ARLETT YURITZI  FRAGOSO  CONTRERAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/172889.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram14 =
    $(go.Diagram, 'departamento_14_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram14.nodeTemplate =
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
    myDiagram14.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram14.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram14.model = new go.TreeModel(
            [
            { key: '32'
              , Estructura: 'EJECUCIÓN V' 
              , Nombre_encargado:'LILIANA DIAZ MORENO'
              , Nombre_puesto: 'ENCARGADO DEL DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/75007.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'SATURNINA ROSALINDA NAGORE MENDOZA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11882.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'ELDA ISMERAI  VICTORIA  GRESS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/189121.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'LIZBETH ADRIANA  CORTES NAVARRO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/189133.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'EDITH DEL CARMEN  HERNANDEZ LEON'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/182167.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'SUSANA  ALVIRDE RAMIREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/140582.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'JAVIER  JIMENEZ ATZIN'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/56793.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'EDUARDO  BERMUDEZ ASCENCIO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/152062.jpg'},{ key: '32'
                    , parent: '32'
                    , Estructura: 'EJECUCIÓN V' 
                    , Nombre_encargado:'NADIA BERENICE HERNANDEZ GUERRERO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/196359.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram15 =
    $(go.Diagram, 'departamento_15_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram15.nodeTemplate =
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
    myDiagram15.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram15.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram15.model = new go.TreeModel(
            [
            { key: '29'
              , Estructura: 'EJECUCIÓN IV' 
              , Nombre_encargado:'CAROLINA JIMENEZ CORTES'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/74600.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'NELY IVONNE QUIROZ SANCHEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO DE COBRANZA '  
                    ,source: 'img/fotos_empleados/196440.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'MARIBEL GOMEZ GARDUÑO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/64438.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'RAFAEL SILVA DORANTES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/45119.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'LUIS ALBERTO SANTOS CENOBIO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/173862.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'OLGA DUARTE LOYOLA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/11381.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'MARIA CECILIA  ARREDONDO TORRES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/3587.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'CUAUHTEMOC  GUERRERO PONCE'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4654.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'MARIA EUGENIA  PERALTA GARCIA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/150104.jpg'},{ key: '29'
                    , parent: '29'
                    , Estructura: 'EJECUCIÓN IV' 
                    , Nombre_encargado:'ROSA ANGELICA  FLORES BLANCAS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4618.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram16 =
    $(go.Diagram, 'departamento_16_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram16.nodeTemplate =
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
    myDiagram16.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram16.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram16.model = new go.TreeModel(
            [
            { key: '31'
              , Estructura: 'EJECUCIÓN III' 
              , Nombre_encargado:'ARMANDO MENDOZA AVILES'
              , Nombre_puesto: 'JEFE DE DEPARTAMENTO'  
              ,source: 'img/fotos_empleados/131338.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'KARLA IVETTE AHUMADA TRIGUEROS'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/63157.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'EDUARDO DOMINGUEZ GUERRERO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/171177.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'PATRICIA JUAREZ ALVAREZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/38453.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'LUIS ALBERTO MEMBRILLO GOMEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/171438.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'MARIA TERESA LESTRADE MORALES'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/4676.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'MONSERRAT  VEGA LOPEZ'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/176000.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'MAYRA ILSE  RODRIGUEZ VALGAÑON'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/192467.jpg'},{ key: '31'
                    , parent: '31'
                    , Estructura: 'EJECUCIÓN III' 
                    , Nombre_encargado:'RICARDO SANCHEZ LARA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/184339.jpg'}, ]
          );
      
          
    var $ = go.GraphObject.make;
    var myDiagram17 =
    $(go.Diagram, 'departamento_17_Div',
      {
        initialAutoScale: go.Diagram.Uniform,
        'undoManager.isEnabled': false,
        layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                  { angle: 90, layerSpacing: 50})
      });
      // Aqui se definen los datos a ingresar, imagenes, texto, tipos de texto, estilos
      myDiagram17.nodeTemplate =
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
    myDiagram17.addDiagramListener('InitialLayoutCompleted', function(e) {
      e.diagram.findTreeRoots().each(function(r) { r.expandTree(1); });
    });
        myDiagram17.linkTemplate =
        $(go.Link,
          { routing: go.Link.Orthogonal, selectable: false, corner: 8 ,},
          $(go.Shape, // the link's path shape
            { strokeWidth: 8, stroke: '#EABE3F' })
          );
   
          myDiagram17.model = new go.TreeModel(
            [
            { key: '7'
              , Estructura: 'SUBADMINISTRACIÓN' 
              , Nombre_encargado:'IRASEMA AGUIRRE RAMIREZ'
              , Nombre_puesto: 'SUBADMINISTRADOR'  
              ,source: 'img/fotos_empleados/45897.jpg'},{ key: '7'
                    , parent: '7'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'JOSE ISRAEL  MEZA  MEDINA'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/169374.jpg'},{ key: '7'
                    , parent: '7'
                    , Estructura: 'SUBADMINISTRACIÓN' 
                    , Nombre_encargado:'REBECA  REYES CASTRO'
                    , Nombre_puesto: 'ANALISTA DESCONCENTRADO'  
                    ,source: 'img/fotos_empleados/68673.jpg'}, ]
          );