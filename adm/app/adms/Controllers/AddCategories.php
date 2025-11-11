<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AddCategories cadastra um novo nível de acesso no sistema
 *
 * @author Domingos
 */
class AddCategories
{
    /** @var $dados Recebe as informações que estarão na Views*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações que serão cadastradas no banco de dados através do formulário*/
    private $dadosForm;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['AddCategories'])) {
            unset($this->dadosForm['AddCategories']);
            $addCategories = new \App\adms\Models\AdmsAddCategories();
            $addCategories->create($this->dadosForm);
            if ($addCategories->getResultado()) {
                $urlDestino = URLADM . "list-categories/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddCategories();
            }
        } else {
            $this->viewAddCategories();
        }
    }

    /** Metodo para enviar os dados para a View e carregar os botões
     * Metodo privado, só pode ser chamado na classe
     */
    private function viewAddCategories() {
        $button = ['list_categories' => ['menu_controller' => 'list-categories', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-categories";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/categories/addCategories", $this->dados);
        $carregarView->renderizar();
    }

}
