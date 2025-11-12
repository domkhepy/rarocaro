<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");

   
}

/**
 * A classe ViewCategories Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class ViewCategories
{
    /** @var int $id Recebe o Id da cor a ser visualizado */
    private int $id;
    
    /** @var $dados Recebe os dados que serão enviados para a View */
    private $dados;

    /**
     * Metodo para receber os dados da View e enviar para Models
     * @param int $id Recebe o Id da cor
     */
    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewCategories = new \App\adms\Models\AdmsViewCategories();
            $viewCategories->viewCategories($this->id);
            if ($viewCategories->getResultado()) {
                $this->dados['viewCategories'] = $viewCategories->getResultadoBd();
                $this->viewCategories();
            } else {
                $urlDestino = URLADM . "list-categories/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
            $urlDestino = URLADM . "list-categories/index";
            header("Location: $urlDestino");
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar os dados para a View e carregar a View
     */
    private function viewCategories() {
        $button = ['list_categories' => ['menu_controller' => 'list-categories', 'menu_metodo' => 'index'],
            'edit_categories' => ['menu_controller' => 'edit-categories', 'menu_metodo' => 'index'],
            'delete_categories' => ['menu_controller' => 'delete-categories', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-categories";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/categories/viewCategories", $this->dados);
        $carregarView->renderizar();
    }

}
