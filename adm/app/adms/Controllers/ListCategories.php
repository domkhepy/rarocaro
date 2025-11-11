<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe ListCategories Recebe as informações do nível de acesso que serão listadas na View
 *
 * @author Domingos
 */
class ListCategories
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listCategories = new \App\adms\Models\AdmsListCategories();
        $listCategories->listCategories($this->pag);
        if ($listCategories->getResultado()) {
            $this->dados['listCategories'] = $listCategories->getResultadoBd();
            $this->dados['pagination'] = $listCategories->getResultPg();
        } else {
            $this->dados['listCategories'] = [];
            $this->dados['pagination'] = null;
        }

        $button = ['add_categories' => ['menu_controller' => 'add-categories', 'menu_metodo' => 'index'],
            'sync_pages_levels' => ['menu_controller' => 'sync-pages-levels', 'menu_metodo' => 'index'],
            'order_categories' => ['menu_controller' => 'order-categories', 'menu_metodo' => 'index'],
            'list_permission' => ['menu_controller' => 'list-permission', 'menu_metodo' => 'index'],
            'view_categories' => ['menu_controller' => 'view-categories', 'menu_metodo' => 'index'],
            'edit_categories' => ['menu_controller' => 'edit-categories', 'menu_metodo' => 'index'],
            'delete_categories' => ['menu_controller' => 'delete-categories', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $this->dados['pag'] = $this->pag;
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-categories";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/categories/listCategories", $this->dados);
        $carregarView->renderizar();
    }

}
