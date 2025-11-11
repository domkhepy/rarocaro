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
                <h2 class="display-4 title">Editar Produto</h2>
            </div>
            <?php
            if (!empty($valorForm)) {
                extract($valorForm);
                ?>
            <div class="p-2">
                <span class="d-none d-lg-block">
                    <?php
                        if ($this->dados['button']['list_product']) {
                            echo "<a href='" . URLADM . "list-products/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['view_product']) {
                            echo "<a href='" . URLADM . "view-product/index/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                        }
                        if ($this->dados['button']['delete_product']) {
                            echo "<a href='" . URLADM . "delete-product/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a> ";
                        }
                        ?>
                </span>
                <div class="dropdown d-block d-lg-none">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <?php
                            if ($this->dados['button']['list_product']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "list-products/index'>Listar</a>";
                            }
                            if ($this->dados['button']['view_product']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "view-product/index/$id'>Visualizar</a>";
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
        <form id="form_color" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>">

            <div class="row form-group">
                <div class="col-12 col-md-6">
                    <label for="name"><span class="text-danger">*</span> Nome:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Nome do produto" value="<?php
                if (isset($valorForm['name'])) {
                    echo $valorForm['name'];
                }
                ?>" required autofocus>
                </div>

                <div class="col-12 col-md-6">
                    <label for="title"><span class="text-danger">*</span> Título:</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Título do produto"
                        value="<?php
                if (isset($valorForm['title'])) {
                    echo $valorForm['title'];
                }
                ?>" required autofocus>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-12 col-md-6">
                <label for="description"><span class="text-danger">*</span> Descrição:</label>
                <input name="description" type="text" class="form-control" id="description"
                    placeholder="Descrição do  producto  " value="<?php
                if (isset($valorForm['description'])) {
                    echo $valorForm['description'];
                }
                ?>" required></div>

                <div class="col-12 col-md-6">
                    <label for="type"><span class="text-danger">*</span> Tipo de produto:</label>
                    <input name="type" type="text" class="form-control" id="type" placeholder="Tipo do produto"
                        value="<?php
                if (isset($valorForm['type'])) {
                    echo $valorForm['type'];
                }
                ?>" required autofocus>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-12 col-md-6">
                    <label for="price"><span class="text-danger">*</span> Preço:</label>
                    <input name="price" type="text" class="form-control" id="price" placeholder="Preço do  producto  "
                        value="<?php
                if (isset($valorForm['price'])) {
                    echo $valorForm['price'];
                }
                ?>" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="ca_id"><span class="text-danger">*</span> Categoria</label>
                    <select name="sts_categories_id" id="sts_categories_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->dados['categories'] as $sit) {
                            extract($sit);
                            if ((isset($valorForm['sts_categories_id'])) AND $valorForm['sts_categories_id'] == $id) {
                                echo "<option value='$id' selected>$name</option>";
                            } else {
                                echo "<option value='$id'>$name</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditProduct" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">

        </form>
    </div>
</div>