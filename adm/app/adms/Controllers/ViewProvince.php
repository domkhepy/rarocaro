<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");

   
}

/**
 * A classe ViewProvince Recebe as informações para visualizar os detalhes da cor
 *
 * @author Domingos
 */
class ViewProvince
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
            $viewProvince = new \App\adms\Models\AdmsViewProvince();
            $viewProvince->viewProvince($this->id);
            if ($viewProvince->getResultado()) {
                $this->dados['viewProvince'] = $viewProvince->getResultadoBd();
                $this->viewProvince();
            } else {
                $urlDestino = URLADM . "list-provinces/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
            $urlDestino = URLADM . "list-provinces/index";
            header("Location: $urlDestino");
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar os dados para a View e carregar a View
     */
    private function viewProvince() {
        $button = ['list_provinces' => ['menu_controller' => 'list-provinces', 'menu_metodo' => 'index'],
            'edit_province' => ['menu_controller' => 'edit-province', 'menu_metodo' => 'index'],
            'delete_province' => ['menu_controller' => 'delete-province', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-provinces";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/provinces/viewProvince", $this->dados);
        $carregarView->renderizar();
    }

}
