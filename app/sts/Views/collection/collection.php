<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

//var_dump($this->dados['collection']);
?>


<!-- Destaques 
<section id="projetos" class="">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold display-4">Destaques</h2>
            <p class="text-muted">Descubra a nossa seleção criteriosa de t-shirts premium que definem o luxo moderno</p>
        </div> 

        <div class="row g-4">
           Projeto 1 
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php //echo URL."app/sts/assets/images/collection/t3.jpeg";?>" class="card-img-top" alt="Projeto 1" />
                    <div class="card-body">
                        <h5 class="card-title">Transporte de materiais de construção rodoviária</h5>
                        <p class="card-text text-muted">Transporte de materiais de construção rodoviária.</p>
                    </div>
                </div>
            </div>
            <!-- Projeto 2 
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php// echo URL."app/sts/assets/images/collection/t1.jpeg";?>" class="card-img-top" alt="Projeto 2" />
                    <div class="card-body">
                        <h5 class="card-title">Mining Equipment Relocation</h5>
                        <p class="card-text text-muted">Readequação de equipamentos de mineração com segurança.</p>
                    </div>
                </div>
            </div>
            <!-- Projeto 3 
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php //echo URL."app/sts/assets/images/collection/t2.jpeg";?>" class="card-img-top" alt="Projeto 3" />
                    <div class="card-body">
                        <h5 class="card-title">Port to Site Distribution Network</h5>
                        <p class="card-text text-muted">Rede de distribuição portos->obras com eficiência.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>-->



<!-- Benefícios / Serviços -->
<section id="servicos" class="py-5 ">
    <div class="container">

     <div class="text-center mb-4">
            <h2 class="fw-bold display-4">Nossas Coleções</h2>
            <span class="section-underline" aria-hidden="true"></span>
            <p class="text-muted mt-4">Cada coleção conta uma história única de artesanato e design
                </p>
        </div>



                
       
        <div class="row g-4">

        <?php

foreach($this->dados['collection'] as $collection){

    extract($collection);
    if (isset($image) AND (!empty($image)) AND (file_exists('./adm/app/adms/assets/image/categories/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/categories/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/categories/category_icon.jpg';
                }
            ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?php echo URL."section/index/".$id?>">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo $image;?>"
                        class="card-img-top" alt="touricotouraro" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $name;?></h5>
                        
                    </div>
                </div>
                </a>
            </div>

            <?php
            
            }
                ?>
           
        </div>
    </div>
</section>
