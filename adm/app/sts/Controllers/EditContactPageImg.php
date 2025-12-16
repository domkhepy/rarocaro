<?php

namespace App\sts\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe EditContactPageImg
 *
 * @author Domingos
 */
class EditContactPageImg
{
    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditContactPageImg']))) {
            $viewAboutsComp = new \App\sts\Models\StsEditContactPageImg();
            $viewAboutsComp->viewAboutsComp($this->id);
            if ($viewAboutsComp->getResultado()) {
                $this->dados['form'] = $viewAboutsComp->getResultadoBd();
                $this->viewEditContactPageImg();
            } else {
                $urlDestino = URLADM . "view-page-contact/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editAboutsComp();
        }
    }
    private function viewEditContactPageImg() {
        $button = [ 'view_page_contact' => ['menu_controller' => 'view-page-contact', 'menu_metodo' => 'index'],
            'edit_page_contact' => ['menu_controller' => 'edit-page-contact', 'menu_metodo' => 'index']];
        $listButton = new \App\adms\Models\helper\AdmsButton();
        $this->dados['button'] = $listButton->buttonPermission($button);
        
        $listMenu = new \App\adms\Models\AdmsMenu();
        $this->dados['menu'] = $listMenu->itemMenu();
        $this->dados['sidebarActive'] = "view-page-contact";
        $carregarView = new \App\sts\core\ConfigView("sts/Views/contact/editContactPageImg", $this->dados);
        $carregarView->renderAdmSite();
    }

    private function editAboutsComp() {
        if (!empty($this->dadosForm['EditContactPageImg'])) {
            unset($this->dadosForm['EditContactPageImg']);
            $this->dadosForm['new_image'] = ($_FILES['new_image'] ? $_FILES['new_image'] : null);
            //var_dump($this->dadosForm);
            $editAboutsComp = new \App\sts\Models\StsEditContactPageImg();
            $editAboutsComp->update($this->dadosForm);
            if ($editAboutsComp->getResultado()) {
                $urlDestino = URLADM . "view-page-contact/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditContactPageImg();
            }
        } else {
            $_SESSION['msg'] = "Sobre empresa não encontrado!<br>";
            $urlDestino = URLADM . "view-page-contact/index";
            header("Location: $urlDestino");
        }
    }

}
