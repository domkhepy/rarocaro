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
    <div class="list" id="list" style="touch-action: none;">



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
                <div>
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
            </div>
            <div class="checkout d-flex "  style="justify-content: flex-end ; width: calc(100% + 50px);">
 <button id="addCart" onclick="addToCart('<?php echo $id?>','<?php echo $name?>', '<?php echo $price?>')"><i class="bi bi-cart3 text-dark " id="cart-icon"></i></button>
                
                <input type="number" min="1" id="requested_quantity_<?php echo $id?>" class="m-0 form-control requested_quantity" value="1">
           
           
                        <select  data="size" class="form-control requested_size" >
                            
                            <?php
                        foreach ($this->dados['sts_homes']['sizes'] as $sit) {
                            extract($sit);
                            
                                echo "<option value='$id'>$name</option>";
                            
                        }
                        ?>
                        </select>
                        <select  data="type" class="form-control requested_type" >
                           
    
                                <option value='Normal' selected>Normal</option>
                                <option value='Oversize'>OverSize</option>
                            
                        
                        
                        </select>
                    
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
            <button id="back">Ver todos &#8599</button>
</div>
</div>

<script>
const products = <?php echo json_encode($this->dados['sts_homes']['products']); ?>;
const size = <?php echo json_encode($this->dados['sts_homes']['sizes'][0]['id']); ?>;
const listSize = <?php echo json_encode($this->dados['sts_homes']['sizes']); ?>;


//document.addEventListener('DOMContentLoaded', function() {
// Initialize searchable select
// initSearchableSelect(products);
//});
</script>