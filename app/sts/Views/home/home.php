<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
//Ler o registro da página home retornado do banco de dados
//A função extract é utilizado para extrair o array e imprimir através do nome da chave
//var_dump($this->dados['sts_homes']['products']);
?>
<div class="carousel ">
        <div class="list">


        
            <?php if(isset($this->dados['sts_homes']['products']) and !empty($this->dados['sts_homes']['products'])){
                foreach($this->dados['sts_homes']['products'] as $products){
                    extract($products);
                    
                               if (isset($image) AND (!empty($image)) AND (file_exists('adm/app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png'; 
                }
              
                echo "<div class='item'><img src='".$image."'>";

                ?>
                <div class="introduce">
                    <div class="title"><?php echo $title;?></div>
                    <div class="topic"><?php echo $name;?></div>
                    <div class="des">
                        <!-- 20 lorem -->
                        <?php echo $description;?>
                    </div>
                    <button class="seeMore">Detalhes &#8599</button>
                    
                </div>
                <div class="detail">
                    <div class="title"><?php echo $name;?></div>
                    <div class="des">
                        <?php echo $description;?></div>
                    <div class="specifications">
                        <div>
                            <p>Tecido</p>
                            <p><?php echo $type;?></p>
                        </div>
                        <!--<div>
                            <p>Charging port</p>
                            <p>Type-C</p>
                        </div>
                        <div>
                            <p>Compatible</p>
                            <p>Android</p>
                        </div>
                        <div>
                            <p>Bluetooth</p>
                            <p>5.3</p>
                        </div>
                        <div>
                            <p>Controlled</p>
                            <p>Touch</p>
                        </div>-->
                    </div>
                    <div class="checkout">
                       <!-- <button>ADD TO CART</button>-->
                        <a href="">REQUESITAR</a>
                    </div>
                </div>
            </div>
           <?php   } 
            }?>

           
        </div>
        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
            <button id="back">Ver todos &#8599</button>
        </div>
    </div>