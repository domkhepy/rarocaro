<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
//var_dump($this->dados);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Detalhes da Solicitacao</h2>
            </div>
            <?php
            if (!empty($this->dados['viewRequest'])) {
                extract($this->dados['viewRequest'][0]);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <?php
                        if ($this->dados['button']['list_requests']) {
                            echo "<a href='" . URLADM . "list-requests/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['edit_request']) {
                            echo "<a href='" . URLADM . "edit-request/index/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->dados['button']['delete_request']) {
                            echo "<a href='" . URLADM . "delete-request/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                            <?php
                            if ($this->dados['button']['list_request']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "list-request/index'>Listar</a>";
                            }
                            if ($this->dados['button']['edit_request']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "edit-request/index/$id'>Editar</a>";
                            }
                            if ($this->dados['button']['delete_request']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "delete-request/index/$id' data-confirm='Excluir'>Apagar</a>";
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

        if (!empty($this->dados['viewRequest'])) {
            extract( $this->dados['viewRequest'][0]);
            ?>
           
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id; ?></dd>

                <dt class="col-sm-3">Nome</dt>
                <dd class="col-sm-9"><?php echo $name; ?></dd>
                <dt class="col-sm-3">Contacto</dt>
                <dd class="col-sm-9"><?php echo $contact; ?></dd>
                <dt class="col-sm-3">Endereco</dt>
                <dd class="col-sm-9"><?php echo $province.", ".$address; ?></dd>
                <dt class="col-sm-3">Total</dt>
                <dd class="col-sm-9"><?php echo $total_quantity; ?></dd>

               
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
        }
        ?>

           <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Tamanho </th>
                        <th>QuantxPreco </th>
                        <th>Subtotal </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $count=1;
                    $total_value=0;
                    foreach ($this->dados['viewRequestItems'] as $types) {
                        extract($types);
                        ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $type.", ".$size_name; ?></td>
                        <td><?php echo $quantity."x".$price; ?></td>
                        <td><?php echo number_format($quantity*$price, 2, ',', '.')."MZN"; ?></td>
                    </tr>
                    <?php
                        $count++;
                        $total_value +=$quantity*$price;
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">Total</td>
                        <td class="font-weight-bold"><?php echo number_format($total_value, 2, ',', '.')."MZN"; ?></td>
                </tbody>
            </table>
        </div>
    </div>
</div>
