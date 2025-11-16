<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Detalhes do Produto</h2>
            </div>
            <?php
            if (!empty($this->dados['viewProduct'])) {
                extract($this->dados['viewProduct'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <?php
                        if ($this->dados['button']['list_product']) {
                            echo "<a href='" . URLADM . "list-products/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['edit_product']) {
                            echo "<a href='" . URLADM . "edit-product/index/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->dados['button']['delete_product']) {
                            echo "<a href='" . URLADM . "delete-product/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a> ";
                        }
                        ?>                         
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php
                            if ($this->dados['button']['list_product']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "list-products/index'>Listar</a>";
                            }
                            if ($this->dados['button']['edit_product']) {
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
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        if (!empty($this->dados['viewProduct'])) {
            ?>
            <dl class="row">                
  <?php
                if (isset($image) AND (!empty($image)) AND (file_exists('app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png';
                }
                ?>

                <dt class="col-sm-3">Imagem</dt>
                <dd class="col-sm-9 mb-4">
                    <div class="img-edit">
                        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-thumbnail view-img-size">
                        <div class="edit">
                            <a href="<?php echo URLADM . 'edit-product-image/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">
                                <i class="far fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </dd>
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $name; ?></dd>
                <dt class="col-sm-3">Título</dt>
                <dd class="col-sm-9"><?php echo $title; ?></dd>
                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9"><?php echo $description; ?></dd>
                <dt class="col-sm-3">Tipo do produto</dt>
                <dd class="col-sm-9"><?php echo $type; ?>
                <dt class="col-sm-3">Preço</dt>
                <dd class="col-sm-9"><?php echo $price; ?>
                <dt class="col-sm-3">Categoria</dt>
                <dd class="col-sm-9"><?php echo $category; ?></dd>
                <dt class="col-sm-3">Acção Rápida</h5>
                   
                   <dd>
                        <form id="edit_product" method="POST" action="<?php echo URLADM."edit-product/index/".$id?>>"
                            enctype="multipart/form-data">
                            <input type="text" name="id" value="<?php if(isset($id)){echo $id;} ?>" hidden>

                            <input type="text" name="sts_view_id" value="<?php if($sts_view_id==0){
                            $label="Publicar";
                            $icon="fa-eye";
                            $button="btn-outline-primary";
                            echo 1;
                         }else{
                             $label="Ocultar";
                            $icon="fa-eye-slash";
                            $button="btn-outline-warning";
                            echo 0;
                         }?>" hidden>
                            <button name="EditProduct" value="editProduct" type="submit" class="btn <?php echo $button;?> ">
                                <i class="fas <?php echo $icon;?> me-1"></i> <?php echo $label;?></button>
                        </form>
                
                </dd>
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Tipo produto não encontrado!</div>";
        }
        ?>
    </div>
</div>
