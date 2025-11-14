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
                <h2 class="display-4 title">Listar Províncias</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-lg-block">
                    <?php
                    if ($this->dados['button']['add_province']) {
                        echo "<a href='" . URLADM . "add-province/index' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                    }
                   
                    ?>
                </span>
                <div class="dropdown d-block d-lg-none">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <?php
                        if ($this->dados['button']['add_province']) {
                            echo "<a class='dropdown-item' href='" . URLADM . "add-province/index'>Cadastrar</a>";
                        }
                       
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr-title">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell">ID</th>
                        <th>Nome</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qnt_linhas_exe = 1;
                    foreach ($this->dados['listProvince'] as $accessLevel) {
                        extract($accessLevel);
                        ?>
                        <tr>
                            <td class="d-none d-sm-table-cell"><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td class="text-center">
                                <span class="d-none d-lg-block">
                                    <?php
                                   
                                    if ($this->dados['button']['view_province']) {
                                        echo "<a href='" . URLADM . "view-province/index/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->dados['button']['edit_province']) {
                                        echo "<a href='" . URLADM . "edit-province/index/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->dados['button']['delete_province']) {
                                        echo "<a href='" . URLADM . "delete-province/index/$id' class='btn btn-outline-danger btn-sm' data-confirm='Excluir'>Apagar</a> ";
                                    }
                                    ?>                                     
                                </span>
                                <div class="dropdown d-block d-lg-none">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                       
                                        if ($this->dados['button']['view_province']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "view-province/index/$id'>Visualizar</a>";
                                        }
                                        if ($this->dados['button']['edit_province']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "edit-province/index/$id'>Editar</a>";
                                        }
                                        if ($this->dados['button']['delete_province']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "delete-province/index/$id' data-confirm='Excluir'>Apagar</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php echo $this->dados['pagination']; ?>
        </div>
    </div>
</div>
