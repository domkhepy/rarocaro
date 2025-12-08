<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe DeleteUsers Recebe as informações que serão deletadas do banco de dados
 *
 * @author Domingos
 */
class DeleteProductImage
{
    /** @var $id Recebe o ID do usuário que será deletado do sistema*/
    private $id;
    private $dados;
    
    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteUser = new \App\adms\Models\AdmsDeleteProductImages();
            $deleteUser->deleteUser($this->id);
            $this->dados=$deleteUser->getResultadoBd();
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar uma foto!";
        }
        
        $urlDestino = URLADM . "view-product/index/".$this->dados[0]['product_id'];
        header("Location: $urlDestino");
    }

}
