<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

if (isset($this->dados['form'][0])) {
    $valorForm = $this->dados['form'][0];
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Adicionar Imagem do Product</h2>
            </div>
            <?php
            if (!empty($valorForm)) {
                extract($valorForm);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <?php
                        if ($this->dados['button']['list_products']) {
                            echo "<a href='" . URLADM . "list-products/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['view_product']) {
                            echo "<a href='" . URLADM . "view-product/index/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                        }
                        if ($this->dados['button']['edit_product']) {
                            echo "<a href='" . URLADM . "edit-product/index/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        
                        if ($this->dados['button']['delete_product']) {
                            echo "<a href='" . URLADM . "delete-product/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a>";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php
                            if ($this->dados['button']['list_products']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "list-products/index'>Listar</a>";
                            }
                            if ($this->dados['button']['view_product']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "view-product/index/$id'>Visualizar</a>";
                            }
                            if ($this->dados['button']['edit_products']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "edit-product/index/$id'>Editar</a>";
                            }
                            
                            if ($this->dados['button']['delete_product']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "delete-product/index/$id' data-confirm='Excluir'>Apagar</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <hr class="hr-title">

        <span class="msg"></span>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <form id="edit_img" method="POST" action="" enctype="multipart/form-data">

            <input name="id" type="hidden" id="id" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>">

            <!--<input name="image" type="hidden" value="<?php
           // if (isset($valorForm['image'])) {
             //   echo $valorForm['image'];
            //}
            ?>">-->

            <?php
            if (isset($valorForm['image']) AND (!empty($valorForm['image'])) AND (file_exists('app/adms/assets/image/products/' . $valorForm['id'] . '/' . $valorForm['image']))) {
                $old_image = URLADM . 'app/adms/assets/image/products/' . $valorForm['id'] . '/' . $valorForm['image'];
            } else {
                $old_image = URLADM . 'app/adms/assets/image/products/products.png';
            }
            ?>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_image"><span class="text-danger">*</span> Imagem</label>
                    <input  name="product_image[]" type="file" multiple="multiple" accept="image/*" class="form-control-file" id="product_image">
                </div>

                <div class="form-group col-md-6">
                    <!--<img src="<?php //echo $old_image; ?>" alt="Usuário" id="preview-img" class="img-thumbnail view-img-size">-->
                </div>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="AddProductImagem" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>        

    </div>
</div>

<!--<span class="msg"></span>
<form id="edit_img" method="POST" action="">    
    

    <label>Imagem:*</label>
    <input name="product_image" type="file" id="product_image"><br><br>



    <img src=">" alt="Imagem do perfil" id="preview-img" style="width: 100px; height: 100px">

    <p>( * ) Campos obrigatórios</p><br>

    <input name="" type="submit" value="Salvar">  
</form>

-->