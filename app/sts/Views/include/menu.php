<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!-- Navbar -->
<header>
    <div class="logo"> <a class="navbar-brand" href="<?php echo URL;?>"><img width="30px"
                src="<?php echo URL."app/sts/assets/images/icon/logo.png"?>"></a>

    </div>


    <nav class=" nav__links" id="nav-links">
        <a href="<?php echo URL."personalize"?>">PERSONALIZAR</a>
        <a href="<?php echo URL."collection"?>">COLEÇÃO</a>
        <a href="<?php echo URL."contact"?>">CONTACTO</a>
    </nav>
    <div class="nav-link text-light" style="cursor: pointer;" id="shopping-cart" aria-label="Carrinho"
        title="Carrinho de compras">
        <i class="bi bi-cart3 text-dark"></i>
        <span id="productNumber" class="position-relative top-0 start-0 translate-middle badge rounded-pill bg-danger">
            0
        </span>
    </div>

    <div class="nav__menu__btn d-flex d-md-none" id="menu-btn">
        <i class="bi bi-list"></i>
    </div>
</header>

<div class=" col-12 col-sm-8 col-md-6 col-lg-4 position-absolute end-0 d-none" id="cartSidebar">
    <div class="card sticky-top" style="top: 20px;  ">
        <div class="card-header text-white d-flex" style=" background-color: #8351b9;">
           <div> Carrinho</div>
            <div id="close-cart" style=" position: relative; justify-content:flex-end; cursor: pointer; 
    left: calc(100% - 100px); display:flex;" >
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <div class="card-body">
            <div id="cartItems">
                <p class="text-muted">Seu carrinho está vazio</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total:</strong>
                <strong id="cartTotal">MZN 0,00</strong>
            </div>
            <button id="checkoutBtn" class="btn  w-100 mt-3 text-light" disabled style=" background-color: #8351b9;">
                <i class="bi bi-cart4"></i> Finalizar Compra
            </button>
        </div>
    </div>
</div>