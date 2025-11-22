<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Dynamic Navbar</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      
    }

    /* NAVBAR */
    .navbar {
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      padding: 18px 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(16px);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      z-index: 999;
      transition: 0.3s ease;
    }

    .navbar.scrolled {
      padding: 12px 60px;
      background: rgba(255, 255, 255, 0.85);
    }

    .logo {
      font-size: 26px;
      font-weight: 700;
      letter-spacing: 1px;
      color: #222;
      cursor: pointer;
    }

    .nav-links {
      display: flex;
      gap: 40px;
    }

    .nav-links a {
      text-decoration: none;
      font-size: 16px;
      color: #222;
      font-weight: 500;
      position: relative;
      transition: 0.3s;
    }

    .nav-links a::after {
      content: "";
      width: 0;
      height: 2px;
      background: #ff4d4f;
      position: absolute;
      left: 0;
      bottom: -4px;
      transition: 0.3s;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    /* MOBILE TOGGLE */
    .menu-btn {
      display: none;
      font-size: 30px;
      cursor: pointer;
    }

    /* MOBILE MENU */
    @media (max-width: 850px) {
      .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        height: 100vh;
        width: 260px;
        background: white;
        flex-direction: column;
        padding-top: 120px;
        padding-left: 40px;
        gap: 30px;
        box-shadow: -2px 0 20px rgba(0, 0, 0, 0.1);
        transition: 0.4s ease;
      }

      .nav-links.active {
        right: 0;
      }

      .menu-btn {
        display: block;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar" id="navbar">
    <div class="logo">TOU RARO</div>

    <div class="menu-btn" id="menuBtn">☰</div>

    <div class="nav-links" id="navLinks">
      <a href="#personalizar">Personalizar</a>
      <a href="#colecao">Coleção</a>
      <a href="#contacto">Contacto</a>
      <a href="#carrinho">🛒 Carrinho</a>
    </div>
  </nav>

  <script>
    // SCROLL EFFECT
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 30) nav.classList.add('scrolled');
      else nav.classList.remove('scrolled');
    });

    // MOBILE MENU
    const menuBtn = document.getElementById('menuBtn');
    const navLinks = document.getElementById('navLinks');
    menuBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  </script>

</body>
</html>
