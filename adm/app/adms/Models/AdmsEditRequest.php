<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsEditRequest recebe as informações que serão editadas no banco de dados
 *
 * @author Domingos
 */
class AdmsEditRequest
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var int $id Contem a Id do nível de acesso que será editado do sistema */
    private  $id;
    
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
     * Método para fazer busca do Id na tabela sts_request e validar o mesmo
     * @param array $id Recebe a informação que será validada e editada no banco de dados */
    public function viewRequest($id) {
        $this->id =  $id;
        $viewRequest = new \App\adms\Models\helper\AdmsRead();
        $viewRequest->fullRead("SELECT sr.id, sr.total_quantity,sts_request_status_id,
        su.name, su.address,su.contact,
        sp.name AS province,
        srs.name AS request_status,
        ac.color 
                FROM sts_requests sr
                INNER JOIN sts_users su ON su.id=sr.sts_users_id
                INNER JOIN sts_provinces sp ON sp.id=su.sts_provinces_id
                INNER JOIN sts_request_status srs ON srs.id=sr.sts_request_status_id
                INNER JOIN adms_colors ac ON ac.id=srs.adms_colors_id
                WHERE sr.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewRequest->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
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

        $upAccessLevel = new \App\adms\Models\helper\AdmsUpdate();
        $upAccessLevel->exeUpdate("sts_requests", $this->dados, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upAccessLevel->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Solicitação  editada com sucesso!</div>";
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro:Solicitação não editada com sucesso!</div>";
            $this->resultado = false;
        }
    }

    public function listStatuses() {
        
        $viewSize = new \App\adms\Models\helper\AdmsRead();
        $viewSize->fullRead("SELECT id, name
                FROM sts_request_status");

           return $viewSize->getResult();

    }

}
