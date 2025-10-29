<?php

namespace Core;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Configurações básicas do site.
 *
 * @author Domingos Valoi
 */
abstract class Config
{

    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function config(): void {
        define('URL', 'http://localhost/rarocaro/');
        define('URLADM', 'http://localhost/rarocaro/adm/');

        define('CONTROLLER', 'Home');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Erro');

        //Credencias de acesso ao Banco de dados
        define('HOST', 'localhost');
        define('USER', 'mutxato');
        define('PASS', 'Mutxato@2025');
        define('DBNAME', 'myrevoffice');
        define('PORT', 3306);
        
        
        define('EMAILADM', 'domingosvaloi@gmail.com');
    }

}
