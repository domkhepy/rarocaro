<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsViewSize Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class AdmsViewSize
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
     * Metodo para pesquisar as informações no banco de dados na tabela adms_colors
     * @param int $id Recebe o Id da cor
     */
    public function viewSize($id) {
        $this->id = (int) $id;
        $viewSize = new \App\adms\Models\helper\AdmsRead();
        $viewSize->fullRead("SELECT id, name
                FROM sts_sizes
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewSize->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
            $this->resultado = false;
        }
    }

}
