<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsAddProduct recebe as informações que serão enviadas para o banco de dados
 *
 * @author Domingos
 */
class AdmsAddProduct
{
    /** @var array $dados Recebe as informações que serão enviadas para o banco de dados*/
    private array $dados;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas*/
    private bool $resultado;
    
    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado() {
        return $this->resultado;
    }

    /** 
     * Método para validar os campos a serem preenchidos
     * @param array $dados Recebe as informações que serão cadastradas no banco de dados*/
    public function create(array $dados = null) {
        $this->dados = $dados;
        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo envia as informações recebidas do formulário para o banco de dados
     */
    private function add() {
        $this->dados['created'] = 0;
        $this->dados['created'] = date("Y-m-d H:i:s");
        $this->dados['product_id'] = "P".date("d").rand(100, 999).date("m").rand(100, 999).date("y");
        
        $createColor = new \App\adms\Models\helper\AdmsCreate();
        $createColor->exeCreate("sts_products", $this->dados);

        if ($createColor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Produto cadastrado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não cadastrad0 com sucesso. Tente mais tarde!</div>";
            $this->resultado = false;
        }
    }

     public function listCategories() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id, name FROM sts_categories ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

   
        return $registry['sit'];
    }
/*
    public function listProductTypes() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id, name FROM adms_product_types ORDER BY name ASC");
        $registry = $list->getResult();
        
        
        
        return $registry;
    }*/

}
