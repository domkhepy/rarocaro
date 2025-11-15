<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe DeleteColors Recebe as informações que serão deletadas do banco de dados
 *
 * @author Domingos
 */
class DeleteSize
{
    /** @var $id Recebe o ID do cor que será deletada do sistema*/
    private $id;
    
    /** Metodo para receber os dados da View e enviar para Models */
    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteColors = new \App\adms\Models\AdmsDeleteSize();
            $deleteColors->deleteSize($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar uma provincia!";
        }
        
        $urlDestino = URLADM . "list-sizes/index";
        header("Location: $urlDestino");
    }

}
