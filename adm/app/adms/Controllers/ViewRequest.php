<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");

   
}

/**
 * A classe ViewRequest Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class ViewRequest
{
    /** @var int $id Recebe o Id da cor a ser visualizado */
    private  $id;
    
    /** @var $dados Recebe os dados que serão enviados para a View */
    private $dados;

    /**
     * Metodo para receber os dados da View e enviar para Models
     * @param int $id Recebe o Id da cor
     */
    public function index($id) {
        $this->id =  $id;
        if (!empty($this->id)) {
            $viewRequest = new \App\adms\Models\AdmsViewRequest();
            $viewRequest->viewRequest($this->id);
            if ($viewRequest->getResultado()) {
                $this->dados['viewRequest'] = $viewRequest->getResultadoBd();
                $this->dados['viewRequestItems']= $viewRequest->listRequests();
                $this->viewRequest();
            } else {
                $urlDestino = URLADM . "list-requests/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Solicitacao não encontrada!</div>";
            $urlDestino = URLADM . "list-requests/index";
            header("Location: $urlDestino");
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar os dados para a View e carregar a View
     */
    private function viewRequest() {
        $button = ['list_requests' => ['menu_controller' => 'list-requests', 'menu_metodo' => 'index'],
            'edit_request' => ['menu_controller' => 'edit-request', 'menu_metodo' => 'index'],
            'delete_request' => ['menu_controller' => 'delete-request', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-requests";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/requests/viewRequest", $this->dados);
        $carregarView->renderizar();
    }

}
