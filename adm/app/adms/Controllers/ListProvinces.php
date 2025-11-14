<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe ListProvince Recebe as informações do nível de acesso que serão listadas na View
 *
 * @author Domingos
 */
class ListProvinces
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $pag Recebe o numero dá pagina para que seja feita a paginação do resultado vindo do banco de dados */
    private $pag;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listProvince = new \App\adms\Models\AdmsListProvince();
        $listProvince->listProvince($this->pag);
        if ($listProvince->getResultado()) {
            $this->dados['listProvince'] = $listProvince->getResultadoBd();
            $this->dados['pagination'] = $listProvince->getResultPg();
        } else {
            $this->dados['listProvince'] = [];
            $this->dados['pagination'] = null;
        }

        $button = ['add_province' => ['menu_controller' => 'add-province', 'menu_metodo' => 'index'],
            'view_province' => ['menu_controller' => 'view-province', 'menu_metodo' => 'index'],
            'edit_province' => ['menu_controller' => 'edit-province', 'menu_metodo' => 'index'],
            'delete_province' => ['menu_controller' => 'delete-province', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $this->dados['pag'] = $this->pag;
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-provinces";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/provinces/listProvinces", $this->dados);
        $carregarView->renderizar();
    }

}
