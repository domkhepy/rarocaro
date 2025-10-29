<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent position-fixed w-100 shadow-sm sticky-top "
    id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#"><img width="30px"
                src="<?php echo URL."app/sts/assets/images/icon/logo.png"?>"></a>
        <button class="navbar-toggler border-0 text-light" id="menu-btn" type="button" data-bs-toggle="collapse"
            data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Abrir menu">
            <i class="bi bi-list fa-2x"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center" id="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#servicos">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="#servicos">COLEÇÕES</a></li>
                <li class="nav-item"><a class="nav-link" href="#depoimentos">DESTAQUES</a></li>
                <li class="nav-item"><a class="nav-link" href="#contactos">CONTACTO</a></li>
                <li class="nav-item"><a class="nav-link" href="#noticias">SOBRE</a></li>
                <li class="nav-item"><a class="nav-link" href="#faleconosco"><i class="bi bi-cart3"></i></a></li>
            </ul>
        </div>
    </div>

    
</nav>