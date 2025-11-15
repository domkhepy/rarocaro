<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");

   
}

/**
 * A classe ViewSize Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class ViewSize
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
            $viewSize = new \App\adms\Models\AdmsViewSize();
            $viewSize->viewSize($this->id);
            if ($viewSize->getResultado()) {
                $this->dados['viewSize'] = $viewSize->getResultadoBd();
                $this->viewSize();
            } else {
                $urlDestino = URLADM . "list-sizes/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
            $urlDestino = URLADM . "list-sizes/index";
            header("Location: $urlDestino");
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar os dados para a View e carregar a View
     */
    private function viewSize() {
        $button = ['list_sizes' => ['menu_controller' => 'list-sizes', 'menu_metodo' => 'index'],
            'edit_size' => ['menu_controller' => 'edit-size', 'menu_metodo' => 'index'],
            'delete_size' => ['menu_controller' => 'delete-size', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-sizes";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/sizes/viewSize", $this->dados);
        $carregarView->renderizar();
    }

}
