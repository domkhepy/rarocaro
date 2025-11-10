<?php

namespace App\sts\Models\helper;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe StsValCampoVazio faz a validação dos campos vazios dos formularios
 *
 * @author Celke
 */
class StsValCampoVazio
{
    /** @var array $dados Recebe os dados que serão validados*/
    private array $dados;
    
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
     * Metodo recebe os dados e faz a validação
     * @param array $dados Recebe os dados
     */
    public function validarDados(array $dados) {
        $this->dados = $dados;
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        
        if(in_array('', $this->dados)){
            $_SESSION['msg'] = "<div class='error' id='msg'>Necessário preencher todos os campos!</div>";
            $this->resultado = false;
        }else{
            $this->resultado = true;
        }
    }
}
