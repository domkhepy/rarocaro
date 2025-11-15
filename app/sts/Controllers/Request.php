<?php

namespace App\sts\Controllers;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe NewUser Recebe as informações para cadastrar um novo usuário no sistema
 *
 * @author Domingos
 */
class Request
{
    /** @var $dados Recebe as informações que serão enviadas para a View*/
    private array $dados;
    
    /** @var $dadosForm Recebe as informações que serão usadas no formulário */
    private $dadosForm;

    /** Metodo para receber os dados da View e enviar para Models */
    public function index() {
        

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

       if(!empty($this->dadosForm)){
            $createNewUser = new \App\sts\Models\StsRequest();
            $createNewUser->create($this->dadosForm);
            if($createNewUser->getResultado()){
                $urlDestino = URL; 
                header("Location: $urlDestino");
            }else{
                $this->dados['form'] = $this->dadosForm;
               $urlDestino = URL ;
                header("Location: $urlDestino");
            }          
        }else{
             $urlDestino = URL ;
                header("Location: $urlDestino");
        }    
    }
    
   

}
