<?php

namespace Core;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Description of Config
 *
 * @author myrevoffice
 */
abstract class Config
{
    protected function configAdm() {
        define('URL', 'http://localhost/rarocaro/');
        define('URLADM', 'http://localhost/rarocaro/adm/');
        
        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Erro');
        
        //Credencias de acesso ao Banco de dados
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'rarocaro');
        define('PORT', 3306);
        
        define('EMAILADM', 'domingosvaloi@gmail.com');
    }
}
