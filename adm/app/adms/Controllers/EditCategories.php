<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditCategories Recebe as informações que serão editadas do banco de dados
 *
 * @author Celke
 */
class EditCategories
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações do formulário que serão enviadas para a Models*/
    private $dadosForm;
    
    /** @var $id Recebe o ID do nível de acesso que será editado*/
    private $id;
    
    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditCategories']))) {
            $viewCategories = new \App\adms\Models\AdmsEditCategories();
            $viewCategories->viewCategories($this->id);
            if ($viewCategories->getResultado()) {
                $this->dados['form'] = $viewCategories->getResultadoBd();
                $this->viewEditCategories();
            } else {
                $urlDestino = URLADM . "list-categories/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editCategories();
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões e enviar as informações para a View
     */
    private function viewEditCategories() {
        $button = ['list_categories' => ['menu_controller' => 'list-categories', 'menu_metodo' => 'index'],
            'view_categories' => ['menu_controller' => 'view-categories', 'menu_metodo' => 'index'],
            'delete_categories' => ['menu_controller' => 'delete-categories', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-categories";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/categories/editCategories", $this->dados);
        $carregarView->renderizar();
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editCategories() {
        if (!empty($this->dadosForm['EditCategories'])) {
            unset($this->dadosForm['EditCategories']);
            $editCategories = new \App\adms\Models\AdmsEditCategories();
            $editCategories->update($this->dadosForm);
            if ($editCategories->getResultado()) {
                $urlDestino = URLADM . "list-categories/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditCategories();
            }
        } else {
            $_SESSION['msg'] = "Nível de acesso não encontrado!<br>";
            $urlDestino = URLADM . "list-categories/index";
            header("Location: $urlDestino");
        }
    }

}
