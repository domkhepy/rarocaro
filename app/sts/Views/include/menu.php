<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!-- Navbar -->
<header>
    <div class="logo"> <a class="navbar-brand" href="<?php echo URL;?>"><img width="30px"
                src="<?php echo URL."app/sts/assets/images/icon/logo.png"?>"></a></div>
    <nav>
        <a href="<?php echo URL."personalize"?>">PERSONALIZAR</a>
        <a href="<?php echo URL."collection"?>">COLEÇÃO</a>
        <a href="<?php echo URL."contact"?>">CONTACTO</a>
    </nav>
</header>