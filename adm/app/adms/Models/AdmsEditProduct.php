<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsEditProduct recebe as informações que serão editadas no banco de dados
 *
 * @author Domingos
 */
class AdmsEditProduct
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var int $id Contem a Id da cor que será editada no sistema */
    private int $id;
    
    /** @var array $dados Recebe as informações que serão editadas */
    private array $dados;
    
    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado(): bool {
        return $this->resultado;
    }

    /** @return Retorna o resultado do banco de dados*/
    function getResultadoBd() {
        return $this->resultadoBd;
    }
    
    /**
     * Método para fazer busca do Id na tabela adms_products e validar o mesmo
     * @param array $id Recebe a informação que será validada e editada no banco de dados */
    public function viewProduct($id) {
        $this->id = (int) $id;
        $viewProduct = new \App\adms\Models\helper\AdmsRead();
        $viewProduct->fullRead("SELECT prd.id, prd.name, description, type, title, price, sts_categories_id,
        cat.name AS category
                FROM sts_products prd
                INNER JOIN sts_categories cat ON cat.id=prd.sts_categories_id
                
                WHERE prd.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewProduct->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não encontrada!</div>";
            $this->resultado = false;
        }
    }
    
    /**
     * Método para validar os dados antes que a edição seja feita
     * @param array $dados Recebe a informação que será validada*/
    public function update(array $dados) {
        $this->dados = $dados;

        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para fazer a atualização das informações no banco de dados
     */
    private function edit() {
        $this->dados['modified'] = date("Y-m-d H:i:s");

        $upColor = new \App\adms\Models\helper\AdmsUpdate();
        $upColor->exeUpdate("sts_products", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upColor->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Produto editado com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não editada com sucesso!</div>";
            $this->resultado = false;
        }
    }

 public function listCategories() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id, name FROM sts_categories ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

   
        return $registry['sit'];
    }

    public function listProductTypes() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id, name FROM adms_product_types ORDER BY name ASC");
        $registry = $list->getResult();
        
        
        
        return $registry;
    }

}
