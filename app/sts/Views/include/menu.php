<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

//var_dump($this->dados['footer'])
?>


<!-- Navbar -->
<header>
    <div class="logo"> <a class="navbar-brand" href="<?php echo URL;?>"><img width="30px"
                src="<?php echo URL."app/sts/assets/images/icon/logo.png"?>"></a>

    </div>


    <nav class="nav__links" id="nav-links">
        <a href="<?php echo URL."personalize"?>">PERSONALIZAR</a>
        <a href="<?php echo URL."collection"?>">COLEÇÃO</a>
        <a href="<?php echo URL."contact"?>">CONTACTO</a>
    </nav>
    <div class="nav-link text-light" style="cursor: pointer;" id="shopping-cart" aria-label="Carrinho"
        title="Carrinho de compras">
        <i class="bi bi-cart3 text-dark " id="cart-icon"></i>
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
    left: calc(100% - 100px); display:flex;">
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

<!-- Modal de Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Finalizar Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm" action="<?php echo URL?>request/index" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="row">
                    

                    <div class=" col-6">
                        <label for="province"> Província</label>
                        <select name="sts_provinces_id" id="province" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                        foreach ($this->dados['footer'][1] as $sit) {
                            extract($sit);
                            if ((isset($valorForm['province'])) AND $valorForm['province'] == $id) {
                                echo "<option value='$id' selected>$name</option>";
                            } else {
                                echo "<option value='$id'>$name</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>

                    <div class=" col-6">
                        <label for="bairro" class="form-label m-0">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="contact" name="contact" required>
                        <input type="text" class="form-control" id="total_quantity" name="total_quantity" value="0"
                            hidden>
                    </div>
                    <div id="orderSummary" class="mb-3 p-3 bg-light rounded">
                        <!-- Resumo do pedido será inserido aqui -->
                    </div>
                    <input type="hidden" id="orderDetails" name="orderDetails">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="checkoutForm" class="btn btn-success">Confirmar Pedido</button>
            </div>
        </div>
    </div>
</div>

<div class="notification mt-5 ms-3 d-none p-1">
    <div class="content p-1">
        <i id="check" class="bi bi-check check"></i>

        <div class="message p-1"> <?php if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }?>
        </div>
    </div>

    <i class="bi bi-x-lg close"></i>

    <div class="progress"></div>
</div>