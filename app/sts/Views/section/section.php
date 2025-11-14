<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

//var_dump($this->dados['collection']);
?>


  <!-- carousel -->
    <div class="car_ousel">
        <!-- li_st it_em -->
        <div class="li_st">

        <?php

foreach($this->dados['products'] as $collection){

    extract($collection);
    if (isset($image) AND (!empty($image)) AND (file_exists('./adm/app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png';
                }
            ?>
 <div class="it_em" >
                
                <img src="<?php echo $image;?>" >
                <div class="conten_t">
                    <div class="author">TOURICOTOURARO</div>
                    <div class="title"><?php echo number_format($price, 2, ',', '.')."MZN";?></div>
                    <div class="topic"><?php echo $name;?></div>
                    <div class="des">
                    <?php echo $title;?>
                 </div>
                    <div class="buttons">
                        <button onclick="addToCart('<?php echo $id?>','<?php echo $name?>', '<?php echo $price?>')">+ CARINHO</button>
                        <input type="number" min="1" id="requested_quantity_<?php echo $id?>" class="form-control w-100 requested_quantity" value="1" >
                    </div>
                </div>
            </div>

        <?php
            
            }
                ?>
           
        </div>
        <!-- li_st thumnail -->
         
        <div class="thumbnail">
             <?php

foreach($this->dados['products'] as $collection){

    extract($collection);
    if (isset($image) AND (!empty($image)) AND (file_exists('./adm/app/adms/assets/image/products/' . $id . '/' . $image))) {
                    $image = URLADM . 'app/adms/assets/image/products/' . $id . '/' . $image;
                } else {
                    $image = URLADM . 'app/adms/assets/image/products/product_icon.png';
                }
            ?>
            <div class="it_em">
                <img src="<?php echo $image;?>">
                <div class="conten_t">
                    <div class="title">
                        <?php echo $name;?>
                    </div>
                    <div class="description">
                        <?php echo $title;?>
                    </div>
                </div>
            </div>
             <?php
            
            }
                ?>
        </div>
        <!-- next prev -->

        <div class="arrow_s">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <!-- time running -->
        <div class="time"></div>
    </div>

    <script>
const check_section = true;
</script>