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
                <h2 class="display-4 title">Dashboard</h2>
            </div>                        
        </div>
        <hr class="hr-title">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6 mb-sm-2 card-dash">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <i class="bi bi-check-circle card-icon fa-3x"></i>
                        <h6 class="card-title"><a class="text-light" href="<?php echo URLADM."list-requests/index"?>">Solicitações</a></h6>
                        <h2 class="lead"><?php echo $this->dados['totalRequests'][0]['total_request']?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="bi bi-boxes card-icon fa-3x"></i>
                        <h6 class="card-title"><a class="text-light" href="<?php echo URLADM."list-products/index"?>">Produtos</a></h6>
                        <h2 class="lead"><?php echo $this->dados['totalProducts'][0]['total_products']?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="bi bi-box-fill card-icon fa-3x"></i>
                        <h6 class="card-title">Itens Solicitados</h6>
                        <h2 class="lead"><?php echo $this->dados['totalRequestedItems'][0]['total_itens']?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 card-dash">
                <div class="card bg-danger text-white">
                    <div class="card-body">                                    
                        <i class="bi bi-dropbox  card-icon fa-3x"></i>
                        <h6 class="card-title"><a class="text-light" href="<?php echo URLADM."list-categories/index"?>">Artigos</a></h6>
                        <h2 class="lead"><?php echo $this->dados['totalCategories'][0]['total_categories']?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
