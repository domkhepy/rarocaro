<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe ViewProduct Recebe as informações para visualizar os detalhes da cor
 *
 * @author domingos
 */
class ViewProduct
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
            $viewProduct = new \App\adms\Models\AdmsViewProduct();
            $viewProduct->viewProduct($this->id);
            if ($viewProduct->getResultado()) {
                $this->dados['viewProduct'] = $viewProduct->getResultadoBd();
                $this->viewProduct();
            } else {
                $urlDestino = URLADM . "list-products/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de produto não encontrado!</div>";
            $urlDestino = URLADM . "list-products/index";
            header("Location: $urlDestino");
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar os dados para a View e carregar a View
     */
    private function viewProduct() {
        $button = ['list_product' => ['menu_controller' => 'list-products', 'menu_metodo' => 'index'],
            'edit_product' => ['menu_controller' => 'edit-product', 'menu_metodo' => 'index'],
            'delete_product' => ['menu_controller' => 'delete-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-products";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/viewProduct", $this->dados);
        $carregarView->renderizar();
    }

}
