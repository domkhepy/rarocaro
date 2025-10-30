<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditProductImage Recebe a informação da imagem usuário que será editada do banco de dados
 *
 * @author Celke
 */
class EditProductImage
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações do formulário que serão enviadas para a Models*/
    private $dadosForm;
    
    /** @var $id Recebe a Id do usuário */
    private $id;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditProductImagem']))) {
            $viewProduct = new \App\adms\Models\AdmsEditProductImage();
            $viewProduct->viewProduct($this->id);
            if ($viewProduct->getResultado()) {
                $this->dados['form'] = $viewProduct->getResultadoBd();
                $this->viewEditProductImage();
            } else {
                $urlDestino = URLADM . "list-product/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editProduct();
        }
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões, enviar as informações para a View
     */
    private function viewEditProductImage() {
        $button = ['list_products' => ['menu_controller' => 'list-products', 'menu_metodo' => 'index'],
            'view_product' => ['menu_controller' => 'view-product', 'menu_metodo' => 'index'],
            'edit_product' => ['menu_controller' => 'edit-product', 'menu_metodo' => 'index'],
            'edit_product_password' => ['menu_controller' => 'edit-product-password', 'menu_metodo' => 'index'],
            'delete_product' => ['menu_controller' => 'delete-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-product";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/editProductImage", $this->dados);
        $carregarView->renderizar();
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editProduct() {
        if (!empty($this->dadosForm['EditProductImagem'])) {
            unset($this->dadosForm['EditProductImagem']);
            $this->dadosForm['new_image'] = ($_FILES['new_image'] ? $_FILES['new_image'] : null);
            //var_dump($this->dadosForm);
            $editProduct = new \App\adms\Models\AdmsEditProductImage();
            $editProduct->update($this->dadosForm);
            if ($editProduct->getResultado()) {
                $urlDestino = URLADM . "view-product/index/" . $this->dadosForm['id'];
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditProductImage();
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-product/index";
            header("Location: $urlDestino");
        }
    }

}
