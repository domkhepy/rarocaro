<?php

namespace App\adms\Models\helper;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * A classe AdmsSlug cria o Slug 
 *
 * @author Celke
 */
class AdmsSlug
{
    /** @var string $nome Recebe o nome que será manipulado */
    private string $nome;
    
    /** @var array $formato Recebe o formato */
    private array $formato;

    /**
     * Metodo recebe o nome que será manipulado
     * @param string $nome Recebe o nome
     * @return type Retorna o nome depois que foi mudado para slug
     */
    public function slug($nome) {
        $this->nome = (string) $nome;

        $this->formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        $this->nome = strtr(mb_convert_encoding($this->nome, 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($this->formato['a'], 'ISO-8859-1', 'UTF-8'), $this->formato['b']);
        $this->nome = str_replace(" ", "-", $this->nome);
        $this->nome = str_replace(array('-----', '----', '---', '--'), '-', $this->nome);
        $this->nome = strtolower($this->nome);

        return $this->nome;
    }

}
