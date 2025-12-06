<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsViewProduct Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class AdmsViewProduct
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var int $id Recebe o Id da cor a ser visualizada*/
    private int $id;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado(): bool {
        return $this->resultado;
    }
    
    /** @return Retorna o resultado que veio do banco de dados */
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    /**
     * Metodo para pesquisar as informações no banco de dados na tabela adms_product
     * @param int $id Recebe o Id da cor
     */
    public function viewProduct($id) {
        $this->id = (int) $id;
        $viewProduct = new \App\adms\Models\helper\AdmsRead();
        $viewProduct->fullRead("SELECT prd.id, prd.name, prd.description, prd.title, prd.type, prd.image, prd.price, prd.sts_view_id, prd.modified, prd.created,
                cat.name AS category
                FROM sts_products prd
                INNER JOIN sts_categories cat ON cat.id=prd.sts_categories_id
                
                WHERE prd.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewProduct->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não encontrada!</div>";
            $this->resultado = false;
        }
    }


    
    public function listProductImages($id){
        $this->id = (int) $id;
        $listImage = new \App\adms\Models\helper\AdmsRead();
        $listImage->fullRead("SELECT id img_id , name , sts_product_id as product_id
        FROM sts_product_images
        WHERE sts_product_id =:id ORDER BY id DESC","id=".$this->id);

        return $listImage->getResult();
       
    }

}
