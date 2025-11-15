<?php

namespace App\sts\Controllers;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página SobreEmpresa
 *
 * @author Domingos
 */
class Section
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;

    /**
     * Instanciar a MODELS e receber o retorno
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index($id) {

        $viewFooter = new \App\sts\Models\StsSection();
        $this->dados['products'] = $viewFooter->index($id);
        $this->dados['sizes'] = $viewFooter->listSizes();

        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
        
        $carregarView = new \Core\ConfigView("sts/Views/section/section", $this->dados);
        $carregarView->renderizar();
    }
}

