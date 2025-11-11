<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditProduct Recebe as informações que serão editadas do banco de dados
 *
 * @author Domingos
 */
class EditProduct
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações do formulário que serão enviadas para a Models*/
    private $dadosForm;
    
    /** @var $id Recebe o ID da cor que será editada*/
    private $id;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id) { 
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditProduct']))) {
            $viewProduct = new \App\adms\Models\AdmsEditProduct();
            $viewProduct->viewProduct($this->id);
            if ($viewProduct->getResultado()) {
                $this->dados['form'] = $viewProduct->getResultadoBd();
                $this->viewEditProduct();
            } else {
                $urlDestino = URLADM . "list-products/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editProduct();
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões e enviar as informações para a View
     */
    private function viewEditProduct() {
        $button = ['list_product' => ['menu_controller' => 'list-products', 'menu_metodo' => 'index'],
            'view_product' => ['menu_controller' => 'view-product', 'menu_metodo' => 'index'],
            'delete_product' => ['menu_controller' => 'delete-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

         $listSelect = new \App\adms\Models\AdmsEditProduct();
        $this->dados['categories'] = $listSelect->listCategories();

       /* $listProductsTypes = new \App\adms\Models\AdmsAddProduct();
        $this->dados['listProductsTypes'] = $listProductsTypes->listProductTypes();
*/
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-products";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/editProduct", $this->dados);
        $carregarView->renderizar();
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editProduct() {
        if (!empty($this->dadosForm['EditProduct'])) {
            unset($this->dadosForm['EditProduct']);
            $editProduct = new \App\adms\Models\AdmsEditProduct();
            $editProduct->update($this->dadosForm);
            if ($editProduct->getResultado()) {
                $urlDestino = URLADM . "list-products/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditProduct();
            }
        } else {
            $_SESSION['msg'] = "Cor não encontrada!<br>";
            $urlDestino = URLADM . "list-products/index";
            header("Location: $urlDestino");
        }
    }

}
