<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsViewRequest Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class AdmsViewRequest
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var int $id Recebe o Id da cor a ser visualizada*/
    private  $id;

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
    public function viewRequest($id) {
        $this->id = $id;
        $viewRequest = new \App\adms\Models\helper\AdmsRead();
        $viewRequest->fullRead("SELECT sr.id, sr.total_quantity,
        su.name, su.address,su.contact,
        sp.name AS province,
        ss.name AS request_status,
        ac.color
                FROM sts_requests sr
                INNER JOIN sts_users su ON su.id=sr.sts_users_id
                INNER JOIN sts_provinces sp ON sp.id=su.sts_provinces_id
                INNER JOIN sts_request_status ss ON ss.id=sts_request_status_id
                INNER JOIN adms_colors ac ON ac.id=ss.adms_colors_id
                WHERE sr.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewRequest->getResult();
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Requesição não encontrada!</div>";
            $this->resultado = false;
        }
    }


      public function listRequests() {
        
    

        $listRequests = new \App\adms\Models\helper\AdmsRead();
        $listRequests->fullRead("SELECT sri.id, sri.quantity, sri.type,
                sp.name AS product_name, sp.price, 
                ss.name AS size_name,
                sc.name AS category_name

                FROM sts_request_items AS sri

                INNER JOIN sts_products AS sp ON sri.sts_products_id = sp.id
                INNER JOIN sts_sizes AS ss ON sri.sts_sizes_id = ss.id
                INNER JOIN sts_categories AS sc ON sp.sts_categories_id = sc.id
                
                WHERE sri.sts_requests_id =:sts_requests_id
                ORDER BY sri.created DESC
                ", "sts_requests_id={$this->id}");

        return $listRequests->getResult();
        
    }

}
