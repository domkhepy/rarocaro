<?php
if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>



<!-- version -->


<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 title">Detalhes da Notícia</h2>
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
         if(isset($this->dados['viewProduct'])){ 
    extract($this->dados['viewProduct'][0]);
if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

    ?>

        <div class="row">
            <!-- Main products content -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Última atualização: <?php echo $modified;?></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $name; ?></h2>

                        <div class="mb-4 img-edit">
                            <?php
                if (isset($image) AND (!empty($image)) AND (file_exists('app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png';
                }
                ?>
                            <img src="<?php echo $image?>" alt="Imagem principal"
                                class="img-fluid rounded products-image w-100 mb-3">
                            <div class="edit">
                                <a href="<?php echo URLADM . 'edit-products-image/index/' . $id; ?>"
                                    class="btn btn-outline-warning btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                            </div>
                            <!-- <div class="text-muted small">Legenda: Imagem ilustrativa da pesquisa científica mencionada na notícia</div>-->
                        </div>

                        <div class="mb-4">
                            <h5>Descrição:</h5>
                            <div class="highlight-box">
                                <p class="mb-0"><?php echo $description?></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Conteúdo:</h5>
                            <div class="products-content">
                                <p><?php echo $title?></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Imagens Relacionadas:</h5>

                            <div class="row g-2" id="imageGallery">
                                <?php
                                
                                if(isset($this->dados['listProductImages']) && !empty($this->dados['listProductImages'])){
                            foreach($this->dados['listProductImages'] as $listProductImages){

                               extract($listProductImages); 

                               if (isset($name) AND (!empty($name)) AND (file_exists('app/adms/assets/image/products/' . $product_id . '/' . $name))) {
                    $name = URLADM . 'app/adms/assets/image/products/' . $product_id . '/' . $name;
                } else {
                    $name = ''; 
                }
                              if($name !== '') {?>
                                <div class="col-6 col-md-4 col-lg-3 img-edit">
                                    <img src="<?php echo $name?>" alt="Imagem 1" class="img-thumbnail gallery-thumbnail"
                                        data-bs-toggle="modal" data-bs-target="#imageModal">
                                    <div class="edit">
                                        <a href="<?php echo URLADM . 'delete-product-images/index/' . $product_id; ?>"
                                            class="btn btn-outline-danger btn-sm" data-confirm='Excluir'>
                                            <i class="fas fa-cut"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php  }}}?>

                            </div>
                            <a href="<?php echo URLADM . 'add-product-images/index/' . $id; ?>"
                                class="mt-4 btn btn-outline-primary">Adicionar fotos</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Metadata sidebar -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Metadados</h5>
                    </div>
                    <div class="card-body">
                        <div class="metadata-item">
                            <h6 class="text-muted">ID:</h6>
                            <p><?php echo $id?></p>
                        </div>

                        <div class="metadata-item">
                            <h6 class="text-muted">Categoria:</h6>
                            <p><?php echo $category?></p>
                        </div>

                        <div class="metadata-item">
                            <h6 class="text-muted">Data de Criação:</h6>
                            <p><?php echo $created?></p>
                        </div>
                        
                        <div class="metadata-item">
                            <h6 class="text-muted">Visualizações:</h6>
                            <p>0 </p>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Ações Rápidas</h5>
                    </div>
                    <div class="card-body d-grid gap-2">
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
                    </div>
                </div>



            </div>
        </div>

        <?php } ?>