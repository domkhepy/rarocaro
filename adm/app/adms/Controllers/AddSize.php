<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AddSize cadastra um novo nível de acesso no sistema
 *
 * @author Domingos
 */
class AddSize
{
    /** @var $dados Recebe as informações que estarão na Views*/
    private $dados;
    
    /** @var $dadosForm Recebe as informações que serão cadastradas no banco de dados através do formulário*/
    private $dadosForm;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['AddSize'])) {
            unset($this->dadosForm['AddSize']);
            $addSize = new \App\adms\Models\AdmsAddSize();
            $addSize->create($this->dadosForm);
            if ($addSize->getResultado()) {
                $urlDestino = URLADM . "list-sizes/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddSize();
            }
        } else {
            $this->viewAddSize();
        }
    }

    /** Metodo para enviar os dados para a View e carregar os botões
     * Metodo privado, só pode ser chamado na classe
     */
    private function viewAddSize() {
        $button = ['list_sizes' => ['menu_controller' => 'list-sizes', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);

        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "list-sizes";
        $carregarView = new \App\adms\core\ConfigView("adms/Views/sizes/addSize", $this->dados);
        $carregarView->renderizar();
    }

}
