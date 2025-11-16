<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**Dashboard Recebe as informações das páginas do sistema que serão listada na View
 *
 * @author Domingos
 */
class AdmsDashboard
{
    /** @var $resultDb Recebe o resultado das informações que vieram do banco de dados */
    private $resultDb;
    
    /** @var bool $result Recebe o resultado das informações que estão sendo manipuladas */
    private bool $result;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;
    
    /** @var $limitResult Recebe o limite de resultados da páginação a serem exibidos na View*/
    private $limitResult = 40;
    
    /** @var $resultPg Recebe o resultado da páginação */
    private $resultPg;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResult() {
        return $this->result;
    }
    
    /** @return Retorna o resultado do banco de dados*/
    function getResultDb() {
        return $this->resultDb;
    }

    /** @return Retorna o resultado da páginação a ser exibida na View*/
    function getResultPg() {
        return $this->resultPg;
    }

    /** Metodo buscar as informações na tabela adms_pages e fazer a paginação do resultado que será mostrado na View listar página
     * 
     * @param $pag Retorna a páginação
     */
    public function totalRequests() {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT COUNT(id) AS total_request
                FROM sts_requests
               
                ");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function totalProducts() {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT COUNT(id) AS total_products
                FROM sts_products
                ");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

     public function totalRequestedItens() {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT SUM(quantity) AS total_itens
                FROM sts_request_items");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

     public function totalCategories() {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT COUNT(id) AS total_categories
                FROM sts_categories");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    

     public function semStock() {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT COUNT(id) AS stock
                FROM adms_products
               WHERE quantity <= 0 
                ");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nenhuma página encontrada!</div>";
            $this->result = false;
        }
    }

    public function listRequests($id) {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT aroi.quantity, aroi.created,
                ap.name AS product_name

        
                FROM adms_request_order_items AS aroi

                INNER JOIN adms_products AS ap ON aroi.adms_products_id = ap.id    
                INNER JOIN adms_request_orders AS aro ON aroi.adms_request_orders_id =aro.id    
               
                WHERE aro.adms_users_id=:adms_users_id

                ORDER BY aroi.created DESC
                ", "adms_users_id={$id}");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function listApprovedRequests($id) {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT aro.id, aro.adms_users_id, aro.adms_request_status_id, aro.total_quantity,
                
                ars.name AS request_status,
                ac.color,
                au.id AS user_id, au.name AS requester
        
                FROM adms_request_orders AS aro

                INNER JOIN adms_request_status AS ars ON aro.adms_request_status_id = ars.id
                INNER JOIN adms_colors AS ac ON ars.adms_color_id = ac.id
                INNER JOIN adms_users AS au ON aro.adms_users_id = au.id
                WHERE aro.adms_users_id=:adms_users_id and aro.adms_request_status_id=1

                ORDER BY aro.id DESC
                ", "adms_users_id={$id}");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

    public function listReprovedRequests($id) {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT aro.id, aro.adms_users_id, aro.adms_request_status_id, aro.total_quantity,
                
                ars.name AS request_status,
                ac.color,
                au.id AS user_id, au.name AS requester
        
                FROM adms_request_orders AS aro

                INNER JOIN adms_request_status AS ars ON aro.adms_request_status_id = ars.id
                INNER JOIN adms_colors AS ac ON ars.adms_color_id = ac.id
                INNER JOIN adms_users AS au ON aro.adms_users_id = au.id
                WHERE aro.adms_users_id=:adms_users_id and aro.adms_request_status_id=2

                ORDER BY aro.id DESC
                ", "adms_users_id={$id}");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

     public function listPendingRequests($id) {


        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT aro.id, aro.adms_users_id, aro.adms_request_status_id, aro.total_quantity,
                
                ars.name AS request_status,
                ac.color,
                au.id AS user_id, au.name AS requester
        
                FROM adms_request_orders AS aro

                INNER JOIN adms_request_status AS ars ON aro.adms_request_status_id = ars.id
                INNER JOIN adms_colors AS ac ON ars.adms_color_id = ac.id
                INNER JOIN adms_users AS au ON aro.adms_users_id = au.id
                WHERE aro.adms_users_id=:adms_users_id and aro.adms_request_status_id=3

                ORDER BY aro.id DESC
                ", "adms_users_id={$id}");

        $this->resultDb = $listPages->getResult();
        if ($this->resultDb) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }

}
