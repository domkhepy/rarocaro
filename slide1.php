<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <title>Swipe entre fotos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root {
      --gap: 16px;
      --bg: #111;
      --fg: #fff;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: var(--bg);
      color: var(--fg);
      font-family: Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .viewer {
      width: min(92vw, 600px);
      height: 60vh;
      max-height: 420px;
      background: #222;
      border-radius: 16px;
      overflow: hidden;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      user-select: none;
      touch-action: pan-y; /* permite swipe horizontal, bloqueando rolagem vertical */
      box-shadow: 0 20px 40px rgba(0,0,0,.5);
    }
    .slide {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0; left: 100%; /* começamos fora da tela à direita */
      display: flex;
      align-items: center;
      justify-content: center;
      transition: left .3s ease;
      background: #000;
    }
    .slide.active {
      left: 0; /* foto atual fica visível */
    }
    .slide.prev {
      left: -100%; /* anterior visível ao sair para a direita (não essencial) */
    }
    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    /* Indicadores simples */
    .dots {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 6px;
    }
    .dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: rgba(255,255,255,.4);
    }
    .dot.active { background: #fff; }
  </style>
</head>
<body>

  <div class="viewer" id="viewer" aria-label="Swipe para navegar entre fotos">
    <!-- Slides (adicione mais conforme necessário) -->
    <div class="slide active" aria-label="Foto 1">
      <img src="https://placehold.co/800x480/111/fff?text=Foto+1" alt="Foto 1"/>
    </div>
    <div class="slide" aria-label="Foto 2">
      <img src="https://placehold.co/800x480/333/fff?text=Foto+2" alt="Foto 2"/>
    </div>
    <div class="slide" aria-label="Foto 3">
      <img src="https://placehold.co/800x480/666/fff?text=Foto+3" alt="Foto 3"/>
    </div>

    <div class="dots" id="dots" aria-label="Indicadores de fotos"></div>
  </div>

  <script>
    // Configuração básica
    const viewer = document.getElementById('viewer');
    const slides = Array.from(document.querySelectorAll('.slide'));
    const dotsContainer = document.getElementById('dots');
    let index = 0;
    const total = slides.length;

    // Criar indicadores
    const updateDots = () => {
      dotsContainer.innerHTML = '';
      slides.forEach((_, i) => {
        const d = document.createElement('span');
        d.className = 'dot' + (i === index ? ' active' : '');
        dotsContainer.appendChild(d);
      });
    };
    updateDots();

    // Lógica de swipe simples (left/right)
    let startX = 0;
    let isDragging = false;

    const onPointerDown = (e) => {
      isDragging = true;
      startX = e.clientX;
      // Evita seleção de imagem durante o swipe
      viewer.style.cursor = 'grabbing';
    };

    const onPointerMove = (e) => {
      if (!isDragging) return;
      // Podemos adicionar feedback visual aqui deslocando o slide atual/futuro
    };

    const onPointerUp = (e) => {
      if (!isDragging) return;
      const dx = e.clientX - startX;
      const threshold = 60; // sensibilidade do swipe
      if (dx < -threshold) {
        // swipe left -> próxima foto
        goNext();
      } else if (dx > threshold) {
        // swipe right -> foto anterior
        goPrev();
      }
      isDragging = false;
      viewer.style.cursor = 'default';
    };

    const goNext = () => {
      const prevIndex = index;
      index = (index + 1) % total;
      updateSlide(prevIndex, index);
    };

    const goPrev = () => {
      const prevIndex = index;
      index = (index - 1 + total) % total;
      updateSlide(prevIndex, index);
    };

    const updateSlide = (from, to) => {
      // Esconde o antigo e mostra o novo
      slides[from].classList.remove('active');
      slides[to].classList.add('active');
      updateDots();
    };

    // Event handlers
    viewer.addEventListener('pointerdown', onPointerDown);
    window.addEventListener('pointermove', onPointerMove);
    window.addEventListener('pointerup', onPointerUp);

    // Opcional: mover com teclado (arrow keys)
    window.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') goPrev();
      if (e.key === 'ArrowRight') goNext();
    });
  </script>
</body>
</html>