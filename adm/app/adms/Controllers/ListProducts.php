<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe ListProducts Recebe as informações das cores que serão listadas na View
 *
 * @author Domingos
 */
class ListProducts
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($pag = null) {
        

        $this->pag = (int) $pag ? $pag : 1;

        $listProducts = new \App\adms\Models\AdmsListProducts();
        

        if(isset($_GET['check']) && !empty($_GET['check'])){
            $listProducts->listProductsCheck($_GET['check'],$this->pag );
        }else{
            $listProducts->listProducts($this->pag);
        }

        if ($listProducts->getResultado()) {
            $this->dados['listProducts'] = $listProducts->getResultadoBd();
            $this->dados['pagination'] = $listProducts->getResultPg();
        } else {
            $this->dados['listProducts'] = [];
            $this->dados['pagination'] = null;
        }

        $button = ['add_product' => ['menu_controller' => 'add-product', 'menu_metodo' => 'index'],
            'view_product' => ['menu_controller' => 'view-product', 'menu_metodo' => 'index'],
            'edit_product' => ['menu_controller' => 'edit-product', 'menu_metodo' => 'index'],
            'delete_product' => ['menu_controller' => 'delete-product', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-products";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/products/listProducts", $this->dados);
        $carregarView->renderizar();
    }

}
