<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Navbar Replica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #000; }
    .navbar-custom {
      background: #0b0b0c;
      border: 2px solid #00ff62;
      border-radius: 40px;
      padding: 8px 20px;
      margin: 20px;
    }
    .navbar-brand img { height: 40px; }
    .nav-link {
      color: #fff !important;
      padding: 10px 20px;
      border-radius: 20px;
    }
    .nav-link.active {
      background: #00ff62;
      color: #000 !important;
    }
    .nav-item:hover .nav-link:not(.active) {
      background: rgba(255,255,255,0.1);
    }
    .right-btn {
      color:#00ff62;
      margin-right:15px;
      font-weight:600;
    }
    .icon-btn{
      background:#00ff62;
      width:45px;height:45px;
      border-radius:50%;
      display:flex;align-items:center;justify-content:center;
    }
    .icon-btn i{color:#000;font-size:20px;}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="https://via.placeholder.com/120x40?text=ALVIDO" alt="logo">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navMenu">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PAGES</a>
        <ul class="dropdown-menu"><li><a class="dropdown-item">Placeholder</a></li></ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">PROJECTS</a>
        <ul class="dropdown-menu"><li><a class="dropdown-item">Placeholder</a></li></ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">INSIGHTS</a>
        <ul class="dropdown-menu"><li><a class="dropdown-item">Placeholder</a></li></ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="#">CONTACT</a></li>
    </ul>

    <span class="right-btn">REQUEST A DEMO</span>
    <div class="icon-btn"><i class="bi bi-grid"></i></div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
