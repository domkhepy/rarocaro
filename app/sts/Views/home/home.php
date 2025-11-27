<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
//Ler o registro da página home retornado do banco de dados
//A função extract é utilizado para extrair o array e imprimir através do nome da chave
//var_dump($this->dados['sts_homes']['products']);
?>
 
<div class="carousel">
    
    <div class="list" id="list" style="touch-action: none;">
<span class="badge text-bg-success position-absolute d-none" id="maxmize" style="z-index:999; top:10%; right:0%;"><i class="bi bi-fullscreen"></i></span>

        <?php 
        $count=0;
        if(isset($this->dados['sts_homes']['products']) and !empty($this->dados['sts_homes']['products'])){
                foreach($this->dados['sts_homes']['products'] as $products){
                    extract($products);
                    
                               if (isset($image) AND (!empty($image)) AND (file_exists('adm/app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png'; 
                }
              
                echo "<div class='item'><img src='".$image."'>";
           $product_id=$id; 
                ?>
        

        <div class="introduce">
            <div class="title "><?php echo $title;?></div>
            <div class="topic"><?php $product_name=$name; echo $product_name;?></div>
            <div class="des">
                <!-- 20 lorem -->
                <?php echo $description;?>
            </div>
            <button class="seeMore">Detalhes &#8599</button>

        </div>

        <div class="detail">
      
       
        <span class="badge text-bg-danger d-badge d-md-none minimize" ><i class="bi bi-dash"></i></span>

        
            <div class="title d-none d-md-block "><?php echo $name;?></div>
             <div class="des d-none d-md-block">
                <?php  echo $description;?></div>
            <div class="specifications ">
                <div class="d-none d-md-block">
                    <p>Tecido</p>
                    <p><?php echo $type;?></p>
                </div>
                <div class="d-none d-md-block">
                    <p>Preço</p>
                    <p><?php echo number_format($price, 2, ',', '.')."MZN";?></p>
                </div>
                <!--  <div>
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

                        <span class="price d-block d-md-none m-auto title"><?php echo number_format($price, 2, ',', '.')."MZN";?></span>
            </div>
            <div class="checkout d-flex " style="justify-content: flex-end ; width: 100% ;">

                <input type="number" min="1" id="requested_quantity_<?php echo $id?>"
                    class="m-0 form-control requested_quantity" value="1">


                <select data="size" class="form-control requested_size">

                    <?php
                        foreach ($this->dados['sts_homes']['sizes'] as $sit) {
                            extract($sit);
                            
                                echo "<option value='$id'>$name</option>";
                            
                        }
                        ?>
                </select>
                <select data="type" class="form-control requested_type">


                    <option value='Normal' selected>Normal</option>
                    <option value='Oversize'>OverSize</option>



                </select>

            </div>
            <div class="checkout">
                <button id="addCart" class="d-block m-auto mt-2"
                    onclick="addToCart('<?php echo $product_id?>','<?php echo $product_name?>', '<?php echo $price?>')"><i
                        class="bi bi-cart3 text-dark " id="cart-icon"></i> CARRINHO</button>

            </div>
        </div>
    </div>
    <?php   $count++;
                } 
            }?>


</div>
<div class="arrows">
    <button id="prev">
        < </button>
            <button id="next">></button>
            <button id="back" class="d-none">Todos &#8599</button>
</div>
</div>

<script>
const products = <?php echo json_encode($this->dados['sts_homes']['products']); ?>;


//document.addEventListener('DOMContentLoaded', function() {
// Initialize searchable select
// initSearchableSelect(products);
//});
</script>