<?php

namespace App\sts\Models;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * A classe StsAddUsers recebe as informações que serão enviadas para o banco de dados
 *
 * @author Domingos
 */
class StsRequest
{
    /** @var array $dados Recebe as informações que serão enviadas para o banco de dados*/
    private array $dados;
    private array $dadosRequest;
    private array $dadosRequestItems;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas*/
    private bool $resultado;
    
    /** @var string $fromEmail Variavel usada no envio de e-mail, contendo o e-mail do administrador*/
    private string $fromEmail;
    
    /** @var string $firstName Variavel usada no envio de e-mail, contendo o primeiro nome do usuário*/    
    private string $firstName;
    
    /** @var array $emailData Variavel usada no envio de e-mail, contendo o e-mail que será enviado para o usuário*/
    private array $emailData;
    
    /** @var $listRegistryAdd Recebe informações que serão usadas no dropdown do formulário*/
    private $listRegistryAdd;



    /** @return Retorna o resultado verdadeiro ou falso*/
    function getResultado() {
        return $this->resultado;
    }

    /** 
     * Método para validar os campos a serem preenchidos
     * @param array $dados Recebe as informações que serão cadastradas no banco de dados*/
    public function create(array $dados) {
        $this->dados['id'] = 'C'.random_int(10, 99).date("d").random_int(10, 99).date("m").date("y").random_int(100, 999);
        $this->dados['name'] = $dados['name'];
        $this->dados['sts_provinces_id'] = $dados['sts_provinces_id'];
        $this->dados['address'] = $dados['address'];
        $this->dados['contact'] = $dados['contact'];

         $this->dadosRequest['id'] = $this->dados['id'];
         $this->dadosRequest['total_quantity'] = $dados['total_quantity'];

         $this->dadosRequestItems = json_decode($dados['orderDetails'], true);
       
        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
     
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            
            $this->add();
        } else {
            $this->resultado = false;
        }
    } 


     private function addRequest($dados) {
        
            $dadoss=[];
            $dadoss['id']= 'R'.random_int(100, 999).date("d").date("m").date("y").random_int(100, 999);
            $this->dadosRequestItems['sts_requests_id']=$dadoss['id'];
            $dadoss['sts_users_id']=$dados['id'];
            $dadoss['total_quantity']=$dados['total_quantity'];
            $dadoss['sts_request_status_id']=2;
            $dadoss['created'] = date("Y-m-d H:i:s"); 

            $this->dadosRequest= $dadoss;

        $createColor = new \App\sts\Models\helper\StsCreate();
        $createColor->exeCreate("sts_requests", $dadoss);
       
    }

     private function addRequestItems($dados) {
        
        $sts_requests_id=$dados['sts_requests_id'];
        unset($dados['sts_requests_id']);
       
       
        foreach ($dados as  $value) {
            
extract($value);
            $dadoss=[];
            $dadoss['id']= 'I'.random_int(100, 999).date("d").date("m").date("y").random_int(100, 999);
            $dadoss['sts_requests_id'] = $sts_requests_id;
            $dadoss['sts_products_id'] = $id;
            $dadoss['sts_sizes_id'] = $sts_sizes_id;
            $dadoss['type'] = $type;
            $dadoss['quantity'] = $quantity;
            $dadoss['created'] = date("Y-m-d H:i:s"); 
            

       $createColor = new \App\sts\Models\helper\StsCreate();
        $createColor->exeCreate("sts_request_items", $dadoss);
          
        
        } 

        
       
    }

   
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo envia as informações recebidas do formulário para o banco de dados
     */
    private function add() {
      //  $this->dados['conf_email'] = password_hash($this->dados['email'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->dados['created'] = date("Y-m-d H:i:s");
       
        $createUser = new \App\sts\Models\helper\StsCreate();
        $createUser->exeCreate("sts_users", $this->dados);


        if ($createUser->getResult() != null) {
            //$this->sendEmail();
            
            $this->addRequest($this->dadosRequest);
            $this->addRequestItems($this->dadosRequestItems);
            
            $_SESSION['msg'] = "<div class='success' id='msg'>Requesição submetida com sucesso!</div>";
            
            $this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='error' id='msg'>Falha na requesição, tente mais tarde!</div>";
            $this->resultado = false;
        }
    }
    
  
   
   

}
