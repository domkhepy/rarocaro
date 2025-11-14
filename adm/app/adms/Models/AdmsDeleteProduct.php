<?php

namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsDeleteProduct recebe a informação que será deletada do banco de dados
 *
 * @author Domingos
 */
class AdmsDeleteProduct
{

    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;

    /** @var int $id Contem a Id da cor que será deletado do sistema */
    private int $id;

    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado(): bool {
        return $this->resultado;
    }

    /**
     * Método para fazer busca do Id no banco de dados na tabela cores e validar o mesmo
     * @param array $id Recebe a informação que será validada e deletada do banco de dados */
    public function deleteProduct($id) {
        $this->id = (int) $id;

        if ($this->viewProduct() ) {
            $deleteProduct = new \App\adms\Models\helper\AdmsDelete();
            $deleteProduct->exeDelete("sts_products", "WHERE id =:id", "id={$this->id}");

            if ($deleteProduct->getResult()) {
                $this->deleteImg();
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Produto apagado com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não apagado com sucesso!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para verificar se a cor está cadastrada no sistema, caso esteja o resultado é enviado para o metodo deleteProduct
     */
    private function viewProduct() {
        $viewProduct = new \App\adms\Models\helper\AdmsRead();
        $viewProduct->fullRead("SELECT id, image FROM sts_products
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewProduct->getResult();
        if ($this->resultadoBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro:  Produto não encontrada!</div>";
            return false;
        }
    }

     private function deleteImg() {
        if ((!empty($this->resultadoBd[0]['image'])) OR ($this->resultadoBd[0]['image'] != null)) {
            $this->delDiretorio = "app/adms/assets/image/products/" . $this->resultadoBd[0]['id'];
            $this->delImg = $this->delDiretorio . "/" . $this->resultadoBd[0]['image'];

            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }

            if (file_exists($this->delDiretorio)) {
                rmdir($this->delDiretorio);
            }
        }
    }

    

}
