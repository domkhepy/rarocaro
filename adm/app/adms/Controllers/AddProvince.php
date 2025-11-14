<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AddProvince cadastra um novo nível de acesso no sistema
 *
 * @author Domingos
 */
class AddProvince
{
    /** @var $dados Recebe as informações que estarão na Views*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações que serão cadastradas no banco de dados através do formulário*/
    private $dadosForm;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['AddProvince'])) {
            unset($this->dadosForm['AddProvince']);
            $addProvince = new \App\adms\Models\AdmsAddProvince();
            $addProvince->create($this->dadosForm);
            if ($addProvince->getResultado()) {
                $urlDestino = URLADM . "list-provinces/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddProvince();
            }
        } else {
            $this->viewAddProvince();
        }
    }

    /** Metodo para enviar os dados para a View e carregar os botões
     * Metodo privado, só pode ser chamado na classe
     */
    private function viewAddProvince() {
        $button = ['list_province' => ['menu_controller' => 'list-province', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-province";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/provinces/addProvince", $this->dados);
        $carregarView->renderizar();
    }

}
