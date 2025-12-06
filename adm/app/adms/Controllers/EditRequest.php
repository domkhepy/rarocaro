<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditRequest Recebe as informações que serão editadas do banco de dados
 *
 * @author Domingos
 */
class EditRequest
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações do formulário que serão enviadas para a Models*/
    private $dadosForm;
    
    /** @var $id Recebe o ID do nível de acesso que será editado*/
    private $id;
    
    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id) {
        $this->id = $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditRequest']))) {
            $viewRequest = new \App\adms\Models\AdmsEditRequest();
            $viewRequest->viewRequest($this->id);
            if ($viewRequest->getResultado()) {
                $this->dados['form'] = $viewRequest->getResultadoBd();
                $this->dados['listStatus'] = $viewRequest->listStatuses();

                $this->viewEditRequest();
            } else {
                $urlDestino = URLADM . "list-requests/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editRequest();
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões e enviar as informações para a View
     */
    private function viewEditRequest() {
        $button = ['list_requests' => ['menu_controller' => 'list-requests', 'menu_metodo' => 'index'],
            'view_request' => ['menu_controller' => 'view-request', 'menu_metodo' => 'index'],
            'delete_request' => ['menu_controller' => 'delete-request', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-requests";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/requests/editRequest", $this->dados);
        $carregarView->renderizar();
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editRequest() {
        if (!empty($this->dadosForm['EditRequest'])) {

          
            unset($this->dadosForm['EditRequest']);
            $editRequest = new \App\adms\Models\AdmsEditRequest();
            $editRequest->update($this->dadosForm);
            if ($editRequest->getResultado()) {
                $urlDestino = URLADM . "list-requests/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditRequest();
            }
        } else {
            $_SESSION['msg'] = "Nível de acesso não encontrado!<br>";
            $urlDestino = URLADM . "list-request/index";
            header("Location: $urlDestino");
        }
    }

}
