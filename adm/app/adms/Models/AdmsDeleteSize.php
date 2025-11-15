<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsDeleteSize recebe a informação que será deletada do banco de dados
 *
 * @author Domingos
 */
class AdmsDeleteSize
{

    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;

    /** @var int $id Contem a Id do nível de acesso que será deletado do sistema */
    private int $id;

    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado(): bool {
        return $this->resultado;
    }

    /**
     * Método para fazer busca do Id no banco de dados na tabela nível de acessp e validar o mesmo
     * @param array $id Recebe a informação que será validada e deletada do banco de dados */
    public function deleteSize($id) {
        $this->id = (int) $id;

        if ($this->viewSize() ) {
            $deleteSize = new \App\adms\Models\helper\AdmsDelete();
            $deleteSize->exeDelete("sts_sizes", "WHERE id =:id", "id={$this->id}");

            if ($deleteSize->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Provincia apagada com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Provincia não apagada com sucesso!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para validar se o usuário tem permissão ou não de deletar o nível de acesso
     */
    private function viewSize() {
        $viewSize = new \App\adms\Models\helper\AdmsRead();
        $viewSize->fullRead("SELECT id FROM sts_sizes
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewSize->getResult();
        if ($this->resultadoBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada ou não tem permissão de acessar!</div>";
            return false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para verificar se tem usuários cadastrados no nível de acesso a ser deletado, caso tenha a exclusão não é permitida
     */
    

}
