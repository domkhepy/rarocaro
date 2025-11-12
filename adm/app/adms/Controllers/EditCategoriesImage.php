<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditCategoriesImage Recebe a informação da imagem usuário que será editada do banco de dados
 *
 * @author 
 */
class EditCategoriesImage
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
        if (!empty($this->id) AND (empty($this->dadosForm['EditCategoriesImagem']))) {
            $viewCategories = new \App\adms\Models\AdmsEditCategoriesImage();
            $viewCategories->viewCategories($this->id);
            if ($viewCategories->getResultado()) {
                $this->dados['form'] = $viewCategories->getResultadoBd();
                $this->viewEditCategoriesImage();
            } else {
                $urlDestino = URLADM . "list-categories/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editCategories();
        }
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões, enviar as informações para a View
     */
    private function viewEditCategoriesImage() {
        $button = ['list_categories' => ['menu_controller' => 'list-categories', 'menu_metodo' => 'index'],
            'view_categories' => ['menu_controller' => 'view-categories', 'menu_metodo' => 'index'],
            'edit_categories' => ['menu_controller' => 'edit-categories', 'menu_metodo' => 'index'],
            'delete_categories' => ['menu_controller' => 'delete-categories', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-categories";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/categories/editCategoriesImage", $this->dados);
        $carregarView->renderizar();
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editCategories() {
        if (!empty($this->dadosForm['EditCategoriesImagem'])) {
            unset($this->dadosForm['EditCategoriesImagem']);
            $this->dadosForm['new_image'] = ($_FILES['new_image'] ? $_FILES['new_image'] : null);
            //var_dump($this->dadosForm);
            $editCategories = new \App\adms\Models\AdmsEditCategoriesImage();
            $editCategories->update($this->dadosForm);
            if ($editCategories->getResultado()) {
                $urlDestino = URLADM . "view-categories/index/" . $this->dadosForm['id'];
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditCategoriesImage();
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-categories/index";
            header("Location: $urlDestino");
        }
    }

}
