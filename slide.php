<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Deslizar Imagen entre dos zonas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root {
      --gap: 16px;
      --zone-h: 200px;
    }
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      padding: 20px;
    }
    .container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--gap);
      width: min(900px, 100%);
    }
    .zone {
      border: 2px dashed #aaa;
      border-radius: 12px;
      height: var(--zone-h);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      background: #f8f8f8;
      overflow: hidden;
    }
    .zone h3 {
      position: absolute;
      top: 6px;
      left: 10px;
      margin: 0;
      font-size: 12px;
      color: #555;
    }
    #image {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,.15);
      touch-action: none; /* evita desplazamiento propio en móvil para control personalizado */
      user-select: none;
      cursor: grab;
      position: absolute;
    }
    #image.dragging {
      opacity: 0.8;
      cursor: grabbing;
      z-index: 10;
    }
    /* Área objetivo para soltar (opcional, con indicación) */
    .drop-target {
      position: absolute;
      bottom: 6px;
      right: 6px;
      font-size: 10px;
      color: #666;
    }
    /* Indicadores simples */
    .highlight {
      outline: 2px solid #4CAF50;
      outline-offset: -4px;
    }
  </style>
</head>
<body>

  <h2>Deslizar una imagen de la izquierda a la derecha</h2>

  <div class="container">
    <section id="zone1" class="zone" aria-label="Zona de origen">
      <h3>Zona de origen</h3>
      <img id="image" src="https://placehold.co/200x200?text=Imagen" alt="Imagen que se puede mover" />
    </section>

    <section id="zone2" class="zone" aria-label="Zona de destino">
      <h3>Zona de destino</h3>
      <span class="drop-target">Suelta aquí</span>
    </section>
  </div>

  <script>
    // Selección de elementos
    const image = document.getElementById('image');
    const zone1 = document.getElementById('zone1');
    const zone2 = document.getElementById('zone2');

    // Estados
    let dragging = false;
    let offsetX = 0;
    let offsetY = 0;
    let startX = 0;
    let startY = 0;

    // Colocar la imagen dentro de zone1 al inicio
    const ensureInZone1 = () => {
      // Ubicación inicial de la imagen dentro de zone1
      const rectZone1 = zone1.getBoundingClientRect();
      image.style.left = (rectZone1.left + 20) + 'px';
      image.style.top = (rectZone1.top + 20) + 'px';
    }

    // Iniciar posición si la imagen está fuera de la zona
    ensureInZone1();

    // Funciones auxiliares
    const getPointerPos = (ev) => {
      // Evita scroll en móviles
      if (ev.touches && ev.touches.length) {
        return { x: ev.touches[0].clientX, y: ev.touches[0].clientY };
      }
      return { x: ev.clientX, y: ev.clientY };
    }

    const onPointerDown = (e) => {
      e.preventDefault();
      dragging = true;
      image.classList.add('dragging');
      const pos = getPointerPos(e);
      const rect = image.getBoundingClientRect();
      offsetX = pos.x - rect.left;
      offsetY = pos.y - rect.top;
      startX = pos.x;
      startY = pos.y;
      // Asegura que el canvas/ventana no rola al mover
      document.body.style.userSelect = 'none';
    }

    const onPointerMove = (e) => {
      if (!dragging) return;
      const pos = getPointerPos(e);
      // Actualizar posición de la imagen
      image.style.left = (pos.x - offsetX) + 'px';
      image.style.top  = (pos.y - offsetY) + 'px';
    }

    const zoneContainsPoint = (zone, x, y) => {
      const r = zone.getBoundingClientRect();
      return (x >= r.left && x <= r.right && y >= r.top && y <= r.bottom);
    }

    const onPointerUp = (e) => {
      if (!dragging) return;
      dragging = false;
      image.classList.remove('dragging');
      document.body.style.userSelect = '';

      const pos = getPointerPos(e);
      const inZone2 = zoneContainsPoint(zone2, pos.x, pos.y);

      if (inZone2) {
        // Mover la imagen dentro de zone2
        const r2 = zone2.getBoundingClientRect();
        // Posición centrada dentro de zone2
        const centerX = r2.left + (r2.width / 2) - (image.width / 2);
        const centerY = r2.top + (r2.height / 2) - (image.height / 2);
        image.style.left = centerX + 'px';
        image.style.top  = centerY + 'px';
      } else {
        // Si no soltar en zone2, volver a zone1 (posición inicial)
        ensureInZone1();
      }
    }

    // Eventos para soportar ratón y toque
    image.addEventListener('pointerdown', onPointerDown);
    window.addEventListener('pointermove', onPointerMove);
    window.addEventListener('pointerup', onPointerUp);

    // Aseguramos que si el usuario redimensiona, la imagen siga en zona1 sensible
    window.addEventListener('resize', () => {
      // Opcional: reasignar posición si está fuera
    });
  </script>
</body>
</html>