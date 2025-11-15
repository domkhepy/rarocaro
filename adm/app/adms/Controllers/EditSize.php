<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditSize Recebe as informações que serão editadas do banco de dados
 *
 * @author Domingos
 */
class EditSize
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
        if (!empty($this->id) AND (empty($this->dadosForm['EditSize']))) {
            $viewSize = new \App\adms\Models\AdmsEditSize();
            $viewSize->viewSize($this->id);
            if ($viewSize->getResultado()) {
                $this->dados['form'] = $viewSize->getResultadoBd();
                $this->viewEditSize();
            } else {
                $urlDestino = URLADM . "list-sizes/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editSize();
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões e enviar as informações para a View
     */
    private function viewEditSize() {
        $button = ['list_sizes' => ['menu_controller' => 'list-sizes', 'menu_metodo' => 'index'],
            'view_size' => ['menu_controller' => 'view-size', 'menu_metodo' => 'index'],
            'delete_size' => ['menu_controller' => 'delete-size', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-sizes";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/sizes/editSize", $this->dados);
        $carregarView->renderizar();
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editSize() {
        if (!empty($this->dadosForm['EditSize'])) {
            unset($this->dadosForm['EditSize']);
            $editSize = new \App\adms\Models\AdmsEditSize();
            $editSize->update($this->dadosForm);
            if ($editSize->getResultado()) {
                $urlDestino = URLADM . "list-sizes/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditSize();
            }
        } else {
            $_SESSION['msg'] = "Nível de acesso não encontrado!<br>";
            $urlDestino = URLADM . "list-size/index";
            header("Location: $urlDestino");
        }
    }

}
