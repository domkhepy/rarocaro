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
    $this->dados['viewRequest'] = $this->dados['form'];
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Editar Solicitação</h2>
            </div>
            <?php
            if (!empty($valorForm)) {
                extract($valorForm);
                ?>
                <div class="p-2">
                    <span class="d-none d-lg-block">
                        <?php
                        if ($this->dados['button']['list_requests']) {
                            echo "<a href='" . URLADM . "list-requests/index' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->dados['button']['view_request']) {
                            echo "<a href='" . URLADM . "view-request/index/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
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
                                echo "<a class='dropdown-item' href='" . URLADM . "list-requests/index'>Listar</a>";
                            }
                            if ($this->dados['button']['view_request']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "view-request/index/$id'>Visualizar</a>";
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

        <span class="msg"></span>

        
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

         if (!empty($this->dados['viewRequest'])) {
            extract( $this->dados['viewRequest'][0]);
            ?>
           <dl >
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
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9 text-<?php echo $color; ?>"><?php echo $request_status; ?></dd>

               
            </dl>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
        }
        ?>
        <form id="form_request" method="POST" action="">
            <input name="id" type="hidden" id="id" value="<?php
            if (isset($valorForm['id'])) {
                echo $valorForm['id'];
            }
            ?>">
            <div class="form-group">
                <label for="sts_request_status_id"><span class="text-danger">*</span> Editar Status da Transação</label>
                <select name="sts_request_status_id" id="sts_request_status_id" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->dados['listStatus'] as $itm) {
                        extract($itm);
                        if ((isset($valorForm['sts_request_status_id'])) AND $valorForm['sts_request_status_id'] == $id) {
                            echo "<option value='$id' selected>$name</option>";
                        } else {
                            echo "<option value='$id'>$name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>

            <input name="EditRequest" type="submit" class="btn btn-outline-warning btn-sm" value="Salvar"> 

        </form>
    </div>
</div>