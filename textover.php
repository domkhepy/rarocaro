<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>T-Shirt SVG Editor with Zoom</title>
<style>
  body { font-family: Arial, sans-serif; background: #f3f3f3; text-align: center; }
  #editor { width: 400px; margin: 20px auto; background: #fff; border: 1px solid #ccc; }
  svg { width: 100%; height: auto; background: white; }
  .item { cursor: move; user-select: none; }
  #controls { margin-top: 15px; }
  input[type="text"] { width: 150px; }
  #zoomControls { display: none; margin-top: 10px; }
  #zoomControls button { margin: 0 5px; padding: 5px 10px; }
</style>
</head>
<body>

<div id="editor">
  <svg id="tshirtSVG" viewBox="0 0 400 400">
    <!-- Simple T-shirt -->
    <rect id="tshirtBody" x="100" y="120" width="200" height="180" fill="#ff0000" stroke="#000" stroke-width="2"/>
    <rect x="150" y="60" width="100" height="60" fill="#ff0000" stroke="#000" stroke-width="2"/>
  </svg>
</div>

<div id="controls">
  <label>Cor da Camiseta: <input type="color" id="corCamisa" value="#ff0000"></label><br><br>
  <input type="text" id="textoCamiseta" placeholder="Digite o texto">
  <button id="btnAddTexto">Adicionar Texto</button>
  <input type="file" id="inputImg" accept="image/*"><br><br>

  <div id="zoomControls">
    <button id="zoomIn">🔍 + Zoom</button>
    <button id="zoomOut">🔍 - Zoom</button>
  </div>

  <button id="btnExport" style="margin-top:10px;">Baixar SVG</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  const svg = $('#tshirtSVG');
  const body = $('#tshirtBody');
  let selected = null, offsetX = 0, offsetY = 0;

  // 🔸 Change shirt color
  $('#corCamisa').on('input', function() {
    body.attr('fill', this.value);
  });

  // 🔸 Add text
  $('#btnAddTexto').on('click', function() {
    const texto = $('#textoCamiseta').val().trim();
    if (!texto) return;
    const textEl = $(document.createElementNS('http://www.w3.org/2000/svg', 'text'))
      .attr({
        x: 200, y: 220, fill: '#000', 'text-anchor': 'middle',
        'font-size': 22, class: 'item'
      })
      .text(texto);
    svg.append(textEl);
  });

  // 🔸 Add image
  $('#inputImg').on('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(evt) {
      const imgEl = $(document.createElementNS('http://www.w3.org/2000/svg', 'image'))
        .attr({
          href: evt.target.result,
          x: 150, y: 220, width: 100, height: 100,
          class: 'item', 'data-scale': 1
        });
      svg.append(imgEl);
    };
    reader.readAsDataURL(file);
  });

  // 🔸 Drag items
  svg.on('mousedown', '.item', function(e){
    selected = this;
    const pt = svg[0].createSVGPoint();
    pt.x = e.clientX; pt.y = e.clientY;
    const ctm = selected.getScreenCTM().inverse();
    const p = pt.matrixTransform(ctm);
    offsetX = p.x - (parseFloat(selected.getAttribute('x')) || 0);
    offsetY = p.y - (parseFloat(selected.getAttribute('y')) || 0);

    if (selected.tagName === 'image') $('#zoomControls').show();
    else $('#zoomControls').hide();
  });

  svg.on('mousemove', function(e){
    if (!selected) return;
    const pt = svg[0].createSVGPoint();
    pt.x = e.clientX; pt.y = e.clientY;
    const ctm = selected.getScreenCTM().inverse();
    const p = pt.matrixTransform(ctm);
    selected.setAttribute('x', p.x - offsetX);
    selected.setAttribute('y', p.y - offsetY);
  });

  svg.on('mouseup mouseleave', function() { selected = null; });

  // 🔸 Zoom image with mouse wheel
  svg.on('wheel', function(e) {
    if (!selected || selected.tagName !== 'image') return;
    e.preventDefault();
    let scale = parseFloat(selected.getAttribute('data-scale')) || 1;
    scale += e.originalEvent.deltaY < 0 ? 0.1 : -0.1;
    scale = Math.min(Math.max(scale, 0.3), 3);
    selected.setAttribute('data-scale', scale);
    selected.setAttribute('width', 100 * scale);
    selected.setAttribute('height', 100 * scale);
  });

  // 🔸 Zoom buttons
  $('#zoomIn').on('click', function(){
    if (!selected || selected.tagName !== 'image') return;
    let scale = parseFloat(selected.getAttribute('data-scale')) || 1;
    scale = Math.min(scale + 0.1, 3);
    selected.setAttribute('data-scale', scale);
    selected.setAttribute('width', 100 * scale);
    selected.setAttribute('height', 100 * scale);
  });

  $('#zoomOut').on('click', function(){
    if (!selected || selected.tagName !== 'image') return;
    let scale = parseFloat(selected.getAttribute('data-scale')) || 1;
    scale = Math.max(scale - 0.1, 0.3);
    selected.setAttribute('data-scale', scale);
    selected.setAttribute('width', 100 * scale);
    selected.setAttribute('height', 100 * scale);
  });

  // 🔸 Export SVG
  $('#btnExport').on('click', function(){
    const svgData = new XMLSerializer().serializeToString(svg[0]);
    const blob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'camiseta.svg';
    link.click();
  });
});
</script>

</body>
</html>
