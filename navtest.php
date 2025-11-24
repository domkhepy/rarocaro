<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Website - Navbar Dinâmica</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f5f5;
    }

    /* NAVBAR */
    .navbar {
      width: 100%;
      background: linear-gradient(90deg, #caa6ff, #c7afea);
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
      color: #fff;
    }

    .nav-links {
      display: flex;
      gap: 40px;
    }

    .nav-links a {
      text-decoration: none;
      color: black;
      font-size: 18px;
      font-weight: 600;
      padding-bottom: 5px;
      transition: 0.3s;
      position: relative;
    }

    /* Indicador dinâmico */
    .nav-links a.active::after,
    .nav-links a:hover::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -3px;
      width: 100%;
      height: 3px;
      background: #ff4757;
      border-radius: 2px;
    }

    /* CONTEÚDO */
    .hero {
      padding: 80px 40px;
      text-align: center;
    }

    h1 {
      font-size: 50px;
      margin: 0;
    }

    p {
      font-size: 18px;
      color: #444;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="logo">LOGO</div>
    <div class="nav-links">
      <a href="home.html" id="home">HOME</a>
      <a href="personalizar.html" id="personalizar">PERSONALIZAR</a>
      <a href="colecao.html" id="colecao">COLEÇÃO</a>
      <a href="contacto.html" id="contacto">CONTACTO</a>
    </div>
  </nav>

  <div class="hero">
    <h1>Página Exemplo</h1>
    <p>Aqui estará o conteúdo da página atual.</p>
  </div>

  <script>
    // Código para ativar indicador da página atual automaticamente
    const currentPage = window.location.pathname.split("/").pop();

    const pages = {
      "home.html": "home",
      "personalizar.html": "personalizar",
      "colecao.html": "colecao",
      "contacto.html": "contacto"
    };

    if (pages[currentPage]) {
      document.getElementById(pages[currentPage]).classList.add("active");
    }
  </script>

</body>
</html>
