
   $(function(){
     const svg = $('#tshirtSVG');
 const body = $('#tshirtBody');
  let selected = null, offsetX = 0, offsetY = 0;

  // 🔸 Change shirt color
  $('#corCamiseta').on('input', function() {
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
    if (typeof selected !== 'undefined'){
    if (!selected) return;
    
    const pt = svg[0].createSVGPoint();
    pt.x = e.clientX; pt.y = e.clientY;
    const ctm = selected.getScreenCTM().inverse();
    const p = pt.matrixTransform(ctm);
    selected.setAttribute('x', p.x - offsetX);
    selected.setAttribute('y', p.y - offsetY);}
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
  console.log(svg[0])

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