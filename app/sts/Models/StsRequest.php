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
    public function create(array $dados = null) {
        $this->dados['id'] = 'C'.random_int(10, 99).date("d").random_int(10, 99).date("m").date("y").random_int(100, 999);
        $this->dados['name'] = $dados['name'];
        $this->dados['email'] = $dados['email'];
        $this->dados['contact'] = $dados['contact'];

         $this->dadosRequest['id'] = $this->dados['id'];
         $this->dadosRequest['total_quantity'] = $dados['total_quantity'];

         $this->dadosRequestItems = json_decode($dados['orderDetails'], true);
       
        $valCampoVazio = new \App\sts\Models\helper\StsValCampoVazio();
     
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            
            $this->valInput();
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
            $dadoss['quantity'] = $quantity;
            $dadoss['created'] = date("Y-m-d H:i:s"); 
            

       $createColor = new \App\sts\Models\helper\StsCreate();
        $createColor->exeCreate("sts_request_items", $dadoss);
          
        
        } 

        
       
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usuado para validar campos especificos do formulário que devem ser únicos
     */
    private function valInput() {
        $valEmail = new \App\sts\Models\helper\StsValEmail();
        $valEmail->validarEmail($this->dados['email']);

        $valEmailSingle = new \App\sts\Models\helper\StsValEmailSingle();
        $valEmailSingle->validarEmailSingle($this->dados['email']);

        if ($valEmail->getResultado() AND $valEmailSingle->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
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
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo para enviar e-mail de confirmação para o usuário após ter se feito o cadastro
     */
    private function sendEmail() {
        $sendEmail = new \App\sts\Models\helper\StsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResultado()) {
            $_SESSION['msg'] = "<div class='success' id='msg'>Solicitação da subscrição feita com sucesso. Necessário acessar a caixa de e-mail para confimar o e-mail!</div>";
            $this->resultado = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<div class='warning' id='msg'>Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com " . $this->fromEmail . " para mais informações!</div>";
            $this->resultado = true;
        }
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo contendo as informações que serão enviadas no e-mail para o usuário, com tags em HTML
     */
    private function emailHtml() {
        $name = explode(" ", $this->dados['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->dados['email'];
        $this->emailData['toName'] = $this->firstName;
        $this->emailData['subject'] = "Confirmação do e-mail";
        $url = URL . "conf-email/index?chave=" . $this->dados['conf_email'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "A solicitação de subscrição em nosso plataforma foi feita com sucesso!<br>";
       
        $this->emailData['contentHtml'] .= "Para que possamos liberar a sua subscrição em nosso sistema, solicitamos a confirmação do e-mail clicando abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a style='color:green;' href='" . $url . "'>Link de Confirmação</a><br><br>";
        $this->emailData['contentHtml'] .= "Este procedimento é necessário para validar a sua subscrição.<br><br>";
        $this->emailData['contentHtml'] .= "Informamos que esta mensagem foi enviada automaticamente pela equipe de administração. <br>
        Você está registrado no banco de dados da empresa Olamuhk. <br>
        Nenhum e-mail de confirmação foi enviado por terceiros, e o preenchimento de senha ou fornecimento de informações adicionais não é solicitado por essa mensagem.<br>
Caso haja alguma dúvida ou necessidade de suporte, estamos à disposição.<br><br>";
    }
 
    /** Metodo privado, só pode ser chamado na classe
     * Metodo contendo as informações que serão enviadas no e-mail para o usuário, apenas com o texto
     */
    private function emailText() {
        $url = URL. "conf-email/index?chave=" . $this->dados['conf_email'];
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "A solicitação de subscrição em nosso plataforma foi feita com sucesso!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo ou cole o link no navegador: \n\n";
        $this->emailData['contentText'] .= $url . "\n\n";
        $this->emailData['contentText'] .= "Informamos que esta mensagem foi enviada automaticamente pela equipe de administração. <r>
        Você está registrado no banco de dados da empresa Olamuhk. Nenhum e-mail de confirmação foi enviado por terceiros, e o preenchimento de senha ou fornecimento de informações adicionais não é solicitado por essa mensagem.
Caso haja alguma dúvida ou necessidade de suporte, estamos à disposição.\n\n";
    }

   

}
