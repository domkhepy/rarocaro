<?php

namespace App\sts\Models\helper;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe StsValEmail faz a validação do e-mail
 *
 * @author Celke
 */
class StsValEmail
{
    /** @var string $email Recebe o e-mail*/
    private string $email;
    
    /** @var bool $resultado Recebe o resultado*/
    private bool $resultado;

    /**
     * Recebe o resultado, verdadeiro ou falso
     * @return bool Verdadeiro ou falso
     */
    function getResultado(): bool {
        return $this->resultado;
    }
    
    /**
     * Metodo recebe o e-mail e verifica se é válido
     * @param string $email Recebe o e-mail
     */
    public function validarEmail($email) {
        $this->email = $email;
        
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='error' id='msg'> E-mail inválido!</div>";
            $this->resultado = false;            
        }
    }
}
