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
                <h2 class="display-4 title">Detalhes da Categoria</h2>
            </div>
            <?php
            if (!empty($this->dados['viewAccessLevels'])) {
                extract($this->dados['viewAccessLevels'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <?php
                        if ($this->dados['button']['list_categories']) {
                            echo "<a href='" . URLADM . "list-categories/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['edit_categories']) {
                            echo "<a href='" . URLADM . "edit-categories/index/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->dados['button']['delete_categories']) {
                            echo "<a href='" . URLADM . "delete-categories/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php
                            if ($this->dados['button']['list_categories']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "list-categories/index'>Listar</a>";
                            }
                            if ($this->dados['button']['edit_categories']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "edit-categories/index/$id'>Editar</a>";
                            }
                            if ($this->dados['button']['delete_categories']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "delete-categories/index/$id' data-confirm='Excluir'>Apagar</a>";
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

        if (!empty($this->dados['viewCategories'])) {
            extract( $this->dados['viewCategories'][0]);
            ?>
            <dl class="row">     
                <?php           
                if (isset($image) AND (!empty($image)) AND (file_exists('app/adms/assets/image/categories/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/categories/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/categories/category_icon.jpg';
                }
                ?>

                <dt class="col-sm-3">Imagem</dt>
                <dd class="col-sm-9 mb-4">
                    <div class="img-edit">
                        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-thumbnail view-img-size">
                        <div class="edit">
                            <a href="<?php echo URLADM . 'edit-categories-image/index/' . $id; ?>" class="btn btn-outline-warning btn-sm">
                                <i class="far fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </dd>
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $name; ?></dd>

               
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
        }
        ?>
    </div>
</div>
