const btns = document.querySelectorAll('button');
  btns.forEach(b => b.addEventListener('click', () => {
    document.documentElement.style.setProperty('--hue', b.dataset.color);
  }))


   /***********************************************
     * Simple mockup editor JS
     * - populate color swatches
     * - change shirt color (SVG fill)
     * - change neckline (switch path)
     * - upload logo, move & scale
     ***********************************************/

    const colors = [
      {name:'Blanc', value:'#ffffff'},
      {name:'Gris', value:'#e9eef0'},
      {name:'Bleu', value:'#1f3d7a'},
      {name:'Bordeaux', value:'#7b1122'},
      {name:'Noir', value:'#111111'},
      {name:'Vert', value:'#0b6b4f'},
      {name:'Rouge', value:'#b2262f'},
      {name:'Marron', value:'#6b4a3b'},
      {name:'Orange', value:'#cb6a2f'}
    ];

    const swatchesEl = document.getElementById('swatches');
    const currentColorName = document.getElementById('current-color-name');
    const teePath = document.getElementById('tee-path');
    const neckline = document.getElementById('neckline');
    const neckSelect = document.getElementById('neck-select');
    const logoLayer = document.getElementById('logo');
    const logoImg = document.getElementById('logo-img');
    const fileInput = document.getElementById('file');
    const logoScale = document.getElementById('logo-scale');
    const resetLogoBtn = document.getElementById('reset-logo');

    /* populate swatches
    colors.forEach((c, i)=>{
      const s = document.createElement('div');
      s.className = 'swatch';
      s.style.background = c.value;
      s.title = c.name;
      if(i===0) s.classList.add('selected'); // default white
      s.addEventListener('click', ()=>{
        document.querySelectorAll('.swatch').forEach(x=>x.classList.remove('selected'));
        s.classList.add('selected');
        setShirtColor(c.value, c.name);
      });
      swatchesEl.appendChild(s);
    });*/

    function setShirtColor(hex, name){
      // set fill for shirt body
      teePath.setAttribute('fill', hex);
      // adjust stroke for very dark colors for visibility
      const stroke = (isDark(hex) ? '#2b2b2b' : '#e6e9eb');
      teePath.setAttribute('stroke', stroke);
      currentColorName.textContent = name;
    }

    function isDark(hex){
      // simple luminance check
      const c = hex.replace('#','');
      const r = parseInt(c.substring(0,2),16);
      const g = parseInt(c.substring(2,4),16);
      const b = parseInt(c.substring(4,6),16);
      const l = 0.2126*r + 0.7152*g + 0.0722*b;
      return l < 100;
    }

    // neckline variants
    const neckVariants = {
      round: {d: "M150 60c12-8 32-8 44 0", strokeWidth:6, show:true},
      v: {d: "M158 60 L200 92 L242 60", strokeWidth:8, show:true},
      crew: {d: "M150 60c20-6 40-6 60 0", strokeWidth:4, show:true}
    };

    neckSelect.addEventListener('change', (e)=>{
      const v = neckVariants[e.target.value] || neckVariants.round;
      neckline.setAttribute('d', v.d);
      neckline.setAttribute('stroke-width', v.strokeWidth);
    });

    // logo upload
    fileInput.addEventListener('change', (ev)=>{
      const f = ev.target.files && ev.target.files[0];
      if(!f) return;
      const url = URL.createObjectURL(f);
      logoImg.src = url;
      logoLayer.style.display = 'block';
      // default size & center
      logoLayer.style.width = logoScale.value + '%';
      logoLayer.style.left = '50%';
      logoLayer.style.top = '42%';
      logoLayer.style.transform = 'translate(-50%,-50%)';
      // make draggable
      makeDraggable(logoLayer);
    });

    // scale control
    logoScale.addEventListener('input', ()=>{
      logoLayer.style.width = logoScale.value + '%';
    });

    resetLogoBtn.addEventListener('click', ()=>{
      logoImg.src = '';
      logoLayer.style.display = 'none';
      fileInput.value = '';
    });

    // simple draggable implementation
    function makeDraggable(el){
      let isDown=false;
      let startX, startY, origLeft, origTop;

      function onDown(e){
        isDown = true;
        document.body.style.userSelect = 'none';
        startX = (e.touches ? e.touches[0].clientX : e.clientX);
        startY = (e.touches ? e.touches[0].clientY : e.clientY);
        // compute current left/top in pixels relative to parent (#stage)
        const stageRect = document.getElementById('stage').getBoundingClientRect();
        const elRect = el.getBoundingClientRect();
        origLeft = elRect.left - stageRect.left;
        origTop = elRect.top - stageRect.top;
        window.addEventListener('mousemove', onMove);
        window.addEventListener('mouseup', onUp);
        window.addEventListener('touchmove', onMove, {passive:false});
        window.addEventListener('touchend', onUp);
      }
      function onMove(e){
        if(!isDown) return;
        e.preventDefault();
        const cx = (e.touches ? e.touches[0].clientX : e.clientX);
        const cy = (e.touches ? e.touches[0].clientY : e.clientY);
        const dx = cx - startX;
        const dy = cy - startY;
        const stageRect = document.getElementById('stage').getBoundingClientRect();
        let newLeft = origLeft + dx;
        let newTop = origTop + dy;
        // clamp within stage
        newLeft = Math.max(0, Math.min(newLeft, stageRect.width - el.offsetWidth));
        newTop  = Math.max(0, Math.min(newTop, stageRect.height - el.offsetHeight));
        // set as percent to be responsive
        const leftPct = (newLeft + el.offsetWidth/2) / stageRect.width * 100;
        const topPct = (newTop + el.offsetHeight/2) / stageRect.height * 100;
        el.style.left = leftPct + '%';
        el.style.top = topPct + '%';
        el.style.transform = 'translate(-50%,-50%)';
      }
      function onUp(){
        isDown=false;
        document.body.style.userSelect = '';
        window.removeEventListener('mousemove', onMove);
        window.removeEventListener('mouseup', onUp);
        window.removeEventListener('touchmove', onMove);
        window.removeEventListener('touchend', onUp);
      }
      el.addEventListener('mousedown', onDown);
      el.addEventListener('touchstart', onDown, {passive:true});
    }

    // initial color
    setShirtColor(colors[0].value, colors[0].name);

    // initial neck
    neckSelect.dispatchEvent(new Event('change'));

    // Accessibility: allow keyboard focus on swatches
    document.querySelectorAll('.swatch').forEach(s=>{
      s.tabIndex = 0;
      s.addEventListener('keydown', (e)=>{ if(e.key === 'Enter') s.click(); });
    });

    // Optional: enable double-click to center logo
    logoLayer.addEventListener('dblclick', ()=>{
      logoLayer.style.left = '50%';
      logoLayer.style.top = '42%';
      logoLayer.style.transform = 'translate(-50%,-50%)';
    });
