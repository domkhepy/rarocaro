<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}
 
/**
 * A classe AddProductImages Recebe a informação da imagem usuário que será editada do banco de dados
 *
 * @author Domingos
 */
class AddProductImages
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
        if (!empty($this->id) AND (empty($this->dadosForm['AddProductImagem']))) {
            $viewProduct = new \App\adms\Models\AdmsAddProductImages();
            $viewProduct->viewProduct($this->id);
            if ($viewProduct->getResultado()) {
                $this->dados['form'] = $viewProduct->getResultadoBd();
                $this->viewAddProductImages();
            } else {
                $urlDestino = URLADM . "list-products/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editProduct();
        }
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões, enviar as informações para a View
     */
    private function viewAddProductImages() {
        $button = ['list_products' => ['menu_controller' => 'list-products', 'menu_metodo' => 'index'],
            'view_product' => ['menu_controller' => 'view-product', 'menu_metodo' => 'index'],
            'edit_product' => ['menu_controller' => 'edit-product', 'menu_metodo' => 'index'],
            'delete_product' => ['menu_controller' => 'delete-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-products";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/addProductImages", $this->dados);
        $carregarView->renderizar();
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editProduct() {
        if (!empty($this->dadosForm['AddProductImagem'])) {
            unset($this->dadosForm['AddProductImagem']);

            $this->dadosForm['product_image'] = ($_FILES['product_image'] ? $_FILES['product_image'] : null);
            
             // Ler o array de arquivos  
    $count=0;
    $dados['id']=$this->dadosForm['id'];
    foreach($this->dadosForm['product_image']['name'] as $key => $value) {  
        $dados[$count]['name'] = $this->dadosForm['product_image']['name'][$key];
        $dados[$count]['type'] = $this->dadosForm['product_image']['type'][$key];
        $dados[$count]['tmp_name'] = $this->dadosForm['product_image']['tmp_name'][$key];
        $dados[$count]['error'] = $this->dadosForm['product_image']['error'][$key];
        $dados[$count]['size'] = $this->dadosForm['product_image']['size'][$key];
        $count++;

        
    } 

            $editProduct = new \App\adms\Models\AdmsAddProductImages();
            $editProduct->update($dados);
            if ($editProduct->getResultado()) {
                $urlDestino = URLADM . "view-product/index/" . $this->dadosForm['id'];
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddProductImages();
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-products/index";
            header("Location: $urlDestino");
        }
    }

}
