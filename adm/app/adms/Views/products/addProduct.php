<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}

?>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Cadastrar Produto</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->dados['button']['list_products']) {
                    echo "<a href='" . URLADM . "list-products/index' class='btn btn-outline-info btn-sm'>Listar</a>";
                }
                ?>
            </div>
        </div>
        <hr class="hr-title">
        <span class="msg"></span>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form id="form_produto_type" method="POST" action="">
            <input name="product_id" type="text" class="form-control" id="name" value="0" hidden>
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
                ?>" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="type"><span class="text-danger">*</span> Tipo de produto:</label>
                    <input name="type" type="text" class="form-control" id="type" placeholder="Tipo do produto" value="<?php
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


            <div class="form-group row">

                <!---<div class="col-12 col-sm-6">
                <label for="adms_product_types_id"><span class="text-danger">*</span> Tipo de Produto:</label>
                 <select class="form-control" id="adms_product_types_id" name="adms_product_types_id">
                                    <?php/*
                                    foreach ($this->dados['listProductsTypes'] as $tipo_evento) {
                                        extract($tipo_evento);
                                    $selected = (isset($valorForm['adms_product_types_id']) && $valorForm['adms_product_types_id']== $id) ? 'selected' : '';
                                    echo"<option value='".$id."' ".$selected.">".$name."</option>";

                                    }*/
                                    ?>
                                </select>
            </div>-->

                <!---<div class="col-12 col-sm-6">
                <label for="quantity"><span class="text-danger">*</span> Quantidade:</label>
                <input name="quantity" type="number" class="form-control" id="quantity" min="1" value="<?php
               /* if (isset($valorForm['quantity'])) {
                    echo $valorForm['quantity'];
                }*/
                ?>" required>
            </div>---->

            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="AddProduct" type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">

        </form>

    </div>
</div>