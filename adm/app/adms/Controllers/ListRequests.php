<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe ListRequest Recebe as informações do nível de acesso que serão listadas na View
 *
 * @author Domingos
 */
class ListRequests
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listRequest = new \App\adms\Models\AdmsListRequests();
        $listRequest->listRequest($this->pag);
        if ($listRequest->getResultado()) {
            $this->dados['listRequest'] = $listRequest->getResultadoBd();
            $this->dados['pagination'] = $listRequest->getResultPg();
        } else {
            $this->dados['listRequest'] = [];
            $this->dados['pagination'] = null;
        }

        $button = ['add_request' => ['menu_controller' => 'add-request', 'menu_metodo' => 'index'],
            'view_request' => ['menu_controller' => 'view-request', 'menu_metodo' => 'index'],
            'edit_request' => ['menu_controller' => 'edit-request', 'menu_metodo' => 'index'],
            'delete_request' => ['menu_controller' => 'delete-request', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $this->dados['pag'] = $this->pag;
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-requests";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/requests/listRequests", $this->dados);
        $carregarView->renderizar();
    }

}
