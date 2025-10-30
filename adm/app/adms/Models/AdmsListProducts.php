<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsListAccessLevels Recebe as informações das cores que será listada na View
 *
 * @author Domingos
 */
class AdmsListProducts 
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;
    
    /** @var $limitResult Recebe o limite de resultados da páginação a serem exibidos na View*/
    private $limitResult = 40;
    
    /** @var $resultPg Recebe o resultado da páginação */
    private $resultPg;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado() {
        return $this->resultado;
    }
    
    /** @return Retorna o resultado do banco de dados*/
    function getResultadoBd() {
        return $this->resultadoBd;
    }
    
    /** @return Retorna o resultado da páginação a ser exibida na View*/
    function getResultPg() {
        return $this->resultPg;
    }
    
    /** Metodo buscar as informações na tabela adms_products e fazer a paginação do resultado que será mostrado na View listar cores
     * 
     * @param $pag Retorna a páginação
     */
    public function listProducts($pag = null) { 
        
        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-products/index');
        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(id) AS num_result FROM sts_products");
        $this->resultPg = $paginacao->getResult();

        $listProducts = new \App\adms\Models\helper\AdmsRead();
        $listProducts->fullRead("SELECT id, name,  title
                FROM sts_products
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");

        $this->resultadoBd = $listProducts->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>";
            $this->resultado = false;
        }
    }

    public function listProductsCheck($id, $pag = null) { 
        $condition="";
        if($id==1){
            $condition="WHERE quantity > 99";
        }else if($id==2){
            $condition="WHERE quantity <= 99 AND quantity >= 0";
        }else if($id==3){
            $condition="WHERE quantity <= 0";
        }
        
        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-products/index');
        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(id) AS num_result FROM adms_products");
        $this->resultPg = $paginacao->getResult();

        $listProducts = new \App\adms\Models\helper\AdmsRead();
        $listProducts->fullRead("SELECT id, name, description, quantity
                FROM adms_products
                $condition
                ORDER BY id DESC
                 
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");

        $this->resultadoBd = $listProducts->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>";
            $this->resultado = false;
        }
    }
}
