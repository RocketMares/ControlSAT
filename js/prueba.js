

var $ = go.GraphObject.make;
var myDiagram =
  $(go.Diagram, 'myDiagramDiv',
    {
      'undoManager.isEnabled': true,
      layout: $(go.TreeLayout, // specify a Diagram.layout that arranges trees
                { angle: 90, layerSpacing: 35 })
    });
    myDiagram.nodeTemplate =
  $(go.Node, 'Horizontal',
    { background: '#44CCFF' },
    $(go.Picture,
      { margin: 10, width: 50, height: 50, background: 'red' },
      new go.Binding('source')),
    $(go.TextBlock, 'Default Text',
      { margin: 12, stroke: 'white', font: 'bold 16px sans-serif' },
      new go.Binding('text', 'name'))
  );
  myDiagram.model = new go.TreeModel(
    [
      { key: '1',              name: 'Don Meow',   source: 'img/azul.png' },
      { key: '2', parent: '1', name: 'Demeter',    source: 'img/amarillo.png' },
      { key: '3', parent: '1', name: 'Copricat',   source: 'img/LOG1.png' },
      { key: '4', parent: '3', name: 'Jellylorum', source: 'img/LOGO11.png' },
      { key: '5', parent: '3', name: 'Alonzo',     source: 'img/LOGO10.png' },
      { key: '6', parent: '2', name: 'Munkustrap', source: 'img/rojo.png' }
    ]);