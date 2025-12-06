<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsListRequest Recebe as informações do nível de acesso que será listada na View
 *
 * @author Domingos
 */
class AdmsListRequests 
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
    
    /** Metodo buscar as informações na tabela adms_request e fazer a paginação do resultado que será mostrado na View listar nível de acesso
     * 
     * @param $pag Retorna a páginação
     */
    public function listRequest($pag = null) {
        
        $this->pag = (int) $pag;
        $paginacao = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-requests/index');
        $paginacao->condition($this->pag, $this->limitResult);
        $paginacao->pagination("SELECT COUNT(id) AS num_result FROM sts_requests ");
        $this->resultPg = $paginacao->getResult();

        $listRequest = new \App\adms\Models\helper\AdmsRead();
        $listRequest->fullRead("SELECT sr.id, sr.total_quantity, sts_request_status_id,
        su.name, su.address, su.contact,
        sp.name AS province,
        srs.name AS request_status,
        ac.color 
                FROM sts_requests sr
                INNER JOIN sts_users su ON su.id=sr.sts_users_id
                INNER JOIN sts_provinces sp ON sp.id=su.sts_provinces_id
                INNER JOIN sts_request_status srs ON srs.id=sr.sts_request_status_id
                INNER JOIN adms_colors ac ON ac.id=srs.adms_colors_id
                ORDER BY sr.created DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$paginacao->getOffset()}");

        $this->resultadoBd = $listRequest->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma solicitação encontrada!</div>";
            $this->resultado = false;
        }
    }
}
