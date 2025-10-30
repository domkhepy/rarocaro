<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 *  * A classe AddProduct cadastra uma nova cor no sistema
 *
 * @author Domingos
 */
class AddProduct
{
    /** @var $dados Recebe as informações que estarão na Views*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações que serão cadastradas no banco de dados através do formulário*/
    private $dadosForm;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['AddProduct'])) {
            unset($this->dadosForm['AddProduct']);
            $addProduct = new \App\adms\Models\AdmsAddProduct();
            $addProduct->create($this->dadosForm);
            if ($addProduct->getResultado()) {
                $urlDestino = URLADM . "list-products/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                
                $this->viewAddProduct();
            }
        } else {
            $this->viewAddProduct();
        }
    }

    /** Metodo para enviar os dados para a View e carregar os botões
     * Metodo privado, só pode ser chamado na classe
     */
    private function viewAddProduct() {
        $button = ['list_products' => ['menu_controller' => 'list-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

       // $listProductsTypes = new \App\adms\Models\AdmsAddProduct();
     //   $this->dados['listProductsTypes'] = $listProductsTypes->listProductTypes();
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-products";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/addProduct", $this->dados);
        $carregarView->renderizar();
    }

}
