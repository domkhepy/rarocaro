<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe Dashboard contem as informações da página inicial do sistema
 *
 * @author Domingos
 */
class Dashboard
{
    /** @var $dados Recebe as informações que estarão na Views*/
    private $dados;
    
    /** Metodo para enviar os dados na View*/
    public function index() {
        $this->dados['sidebarActive'] = "dashboard";
        
        $listMenu = new \App\adms\Models\AdmsDashboard();
        $listMenu->totalRequests();
        $this->dados['totalRequests'] = $listMenu->getResultDb();
        
        $listMenu->totalProducts();
        $this->dados['totalProducts'] = $listMenu->getResultDb();

        $listMenu->totalRequestedItens();
        $this->dados['totalRequestedItems'] = $listMenu->getResultDb();

        $listMenu->totalCategories();
        $this->dados['totalCategories'] = $listMenu->getResultDb();

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        
        $carregarView = new \App\adms\core\ConfigView("adms/Views/dashboard/home", $this->dados);
        $carregarView->renderizar();
    }

}
