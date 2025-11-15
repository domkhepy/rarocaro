<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsAddSize recebe as informações que serão enviadas para o banco de dados
 *
 * @author Domingos
 */
class AdmsAddSize
{
    /** @var array $dados Recebe as informações que serão enviadas para o banco de dados*/
    private array $dados;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas*/
    private bool $resultado;
    
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados*/
    private $resultadoBd;

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
            $this->dados['created'] = date("Y-m-d H:i:s");

            $createAccessLevel = new \App\adms\Models\helper\AdmsCreate();
            $createAccessLevel->exeCreate("sts_sizes", $this->dados);

            if ($createAccessLevel->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Provincia cadastrada com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Provincia não cadastrada com sucesso. Tente mais tarde!</div>";
                $this->resultado = false;
            }
       
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo para verificar qual é a última ordem que esta cadastrada no banco de dados
     */
  

}
