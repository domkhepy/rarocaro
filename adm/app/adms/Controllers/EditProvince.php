<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditProvince Recebe as informações que serão editadas do banco de dados
 *
 * @author Celke
 */
class EditProvince
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
        if (!empty($this->id) AND (empty($this->dadosForm['EditProvince']))) {
            $viewProvince = new \App\adms\Models\AdmsEditProvince();
            $viewProvince->viewProvince($this->id);
            if ($viewProvince->getResultado()) {
                $this->dados['form'] = $viewProvince->getResultadoBd();
                $this->viewEditProvince();
            } else {
                $urlDestino = URLADM . "list-provinces/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editProvince();
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para carregar os botões e enviar as informações para a View
     */
    private function viewEditProvince() {
        $button = ['list_provinces' => ['menu_controller' => 'list-provinces', 'menu_metodo' => 'index'],
            'view_province' => ['menu_controller' => 'view-province', 'menu_metodo' => 'index'],
            'delete_province' => ['menu_controller' => 'delete-province', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-provinces";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/provinces/editProvince", $this->dados);
        $carregarView->renderizar();
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para manter as informações no formulário e enviar para a Models para que a edição seja feita
     */
    private function editProvince() {
        if (!empty($this->dadosForm['EditProvince'])) {
            unset($this->dadosForm['EditProvince']);
            $editProvince = new \App\adms\Models\AdmsEditProvince();
            $editProvince->update($this->dadosForm);
            if ($editProvince->getResultado()) {
                $urlDestino = URLADM . "list-provinces/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditProvince();
            }
        } else {
            $_SESSION['msg'] = "Nível de acesso não encontrado!<br>";
            $urlDestino = URLADM . "list-province/index";
            header("Location: $urlDestino");
        }
    }

}
