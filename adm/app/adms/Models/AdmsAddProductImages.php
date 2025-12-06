<?php

namespace App\adms\Models;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}
 
/**
 * A classe AdmsAddProductImages Recebe a informação da imagem do usuário que será editada no banco de dados
 *
 * @author Domingos
 */
class AdmsAddProductImages
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
     * Método para fazer busca na tabela adms_products e validar as informações sobre o usuário antes de editar
     */
    public function viewProduct($id) {
        $this->id = (int) $id;
        $viewProduct = new \App\adms\Models\helper\AdmsRead();
        $viewProduct->fullRead("SELECT prd.id, prd.image
                FROM sts_products prd
                WHERE prd.id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewProduct->getResult();
        if ($this->resultadoBd) {
            $this->resultado = true;
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Noticia nao encontrada não encontrado!</div>";
            $this->resultado = false;
            return false;
        }
    }

    /**
     * Método para validar os dados antes que a edição seja feita e retirar campos especificos da validação
     * @param array $dados Recebe a informação que será validada*/
    public function update(array $dados) {
        $this->dados['id'] = $dados['id'];
        unset($dados['id']);
        
        foreach($dados as $key => $value) {
        $this->dadosImage = $value;

        $valCampoVazio = new \App\adms\Models\helper\AdmsValCampoVazio();
        $valCampoVazio->validarDados($this->dadosImage);
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
    }
    
    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para validar a extensão da imagem
     */
    private function valInput() {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->valExtImg($this->dadosImage['type']);
        if ($this->viewProduct($this->dados['id']) AND $valExtImg->getResultado()) {
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

        $this->diretorio = "app/adms/assets/image/products/" . $this->dados['id'] . "/";

        //$uploadImg = new \App\adms\Models\helper\AdmsUpload();
        //$uploadImg->upload($this->diretorio, $this->dadosImage['tmp_name'], $this->nameImg);

        $uploadImgRed = new \App\adms\Models\helper\AdmsUpload();
        $uploadImgRed->upload($this->diretorio, $this->dadosImage['tmp_name'],  $this->nameImg);

        if ($uploadImgRed->getResultado()) {
            $this->add();
        } else {
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para salvar as informações editadas no banco de dados
     */
    private function add() {
        $this->saveDate['name'] = $this->nameImg;
        $this->saveDate['sts_product_id'] =  $this->id;
        $this->saveDate['created'] = date("Y-m-d H:i:s");

        $createProduct = new \App\adms\Models\helper\AdmsCreate();
        $createProduct->exeCreate("sts_product_images", $this->saveDate);

        if ($createProduct->getResult()) {
            //$this->deleteImage();
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagens da Notícia cadastrada com sucesso</div>";
$this->resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Imagem do notícia não cadastrada com!</div>";
            $this->resultado = false;
        }
    }

    /** Metodo privado, só pode ser chamado na classe
     * Metodo usado para apagar a imagem antiga do servidor
     */
    private function deleteImage() {
        if ((!empty($this->resultadoBd[0]['image']) OR ($this->resultadoBd[0]['image'] != null)) AND ($this->resultadoBd[0]['image'] != $this->nameImg)) {
            $this->delImg = "app/adms/assets/image/products/" . $this->dados['id'] . "/" . $this->resultadoBd[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Imagem da notícia editada com sucesso!</div>";
        $this->resultado = true;
    }

}
