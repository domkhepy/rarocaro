<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsEditCategoriesImage Recebe a informação da imagem do usuário que será editada no banco de dados
 *
 * @author Domingos
 */
class AdmsEditCategoriesImage
{
    /** @var $resultadoBd Recebe o resultado das informações que vieram do banco de dados */
    private $resultadoBd;
    
    /** @var bool $resultado Recebe o resultado das informações que estão sendo manipuladas */
    private bool $resultado;
    
    /** @var int $id Recebe o ID do usuário que será editado */
    private int $id;
    
    /** @var array $dados Recebe os dados serão enviados para a View */
    private array $dados;
    
    /** @var $dadosImage Recebe as informações da imagem */
    private $dadosImage;
    
    /** @var $diretorio Recene o caminho do diretorio*/
    private $diretorio;
    
    /** @var $saveDate Recebe a informação que será salva no banco de dados */
    private $saveDate;
    
    /** @var $delImg Recebe a informação da imagem que será deletada */
    private $delImg;
    
    /** @var string $nameImg Recebe o nome da imagem que será salva */
    private string $nameImg;

    /** @return Retorna o resultado verdadeiro ou falso */
    function getResultado(): bool {
        return $this->resultado;
    }

    /** @return Retorna o resultado do banco de dados*/
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    /**
     * Método para fazer busca na tabela adms_product e validar as informações sobre o usuário antes de editar
     */
    public function viewCategories($id) {
        $this->id = (int) $id;
        $viewCategories = new \App\adms\Models\helper\AdmsRead();
        $viewCategories->fullRead("SELECT usu.id, usu.image
                FROM sts_categories usu
                WHERE usu.id=:id 
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewCategories->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Produto não encontrado!</div>";
            $this->resultado = false;
            return false;
        }
    }

    /**
     * Método para validar os dados antes que a edição seja feita e retirar campos especificos da validação
     * @param array $dados Recebe a informação que será validada*/
    public function update(array $dados) {
        $this->dados = $dados;

        $this->dadosImage = $this->dados['new_image'];
        unset($this->dados['new_image'], $this->dados['image']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dados);
        if ($valCampoVazio->getResultado()) {
            if (!empty($this->dadosImage['name'])) {
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma imagem!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para validar a extensão da imagem
     */
    private function valInput() {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->valExtImg($this->dadosImage['type']);
        if ($this->viewCategories($this->dados['id']) AND $valExtImg->getResultado()) {
            $this->upload();
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para fazer o upload da imagem no servidor
     */
    private function upload() {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dadosImage['name']);

        $this->diretorio = "app/adms/assets/image/categories/" . $this->dados['id'] . "/";

        //$uploadImg = new \App\adms\Models\helper\AdmsUpload();
        //$uploadImg->upload($this->diretorio, $this->dadosImage['tmp_name'], $this->nameImg);

        $uploadImgRed = new \App\adms\Models\helper\AdmsUpload();
        $uploadImgRed->upload( $this->diretorio,$this->dadosImage['tmp_name'], $this->nameImg);

        if ($uploadImgRed->getResultado()) {
            $this->edit();
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para salvar as informações editadas no banco de dados
     */
    private function edit() {
        $this->saveDate['image'] = $this->nameImg;
        $this->saveDate['modified'] = date("Y-m-d H:i:s");

        $upCategories = new \App\adms\Models\helper\AdmsUpdate();
        $upCategories->exeUpdate("sts_categories", $this->saveDate, "WHERE id =:id", "id={$this->dados['id']}");

        if ($upCategories->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Imagem do usuário não editada com sucesso!</div>";
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para apagar a imagem antiga do servidor
     */
    private function deleteImage() {
        if ((!empty($this->resultadoBd[0]['image']) OR ($this->resultadoBd[0]['image'] != null)) AND ($this->resultadoBd[0]['image'] != $this->nameImg)) {
            $this->delImg = "app/adms/assets/image/categories/" . $this->dados['id'] . "/" . $this->resultadoBd[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagem do produto editada com sucesso!</div>";
        $this->resultado = true;
    }

}
