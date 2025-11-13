<?php
namespace Core;
if (!defined('48b5t9')) {
	header("Location: /");
	die("Erro: Pagina não encontrada!");
}

/**
 * 
 */
class ConfigController extends Config
{
	/* @var string $url recebe a URL do .htaccess*/
	private string $url;
	/* @var array $urlConjunto recebe a URL convertida para array*/
	private array $urlConjunto;
	/* @var string $urlController recebe da URL o nome da controller*/
	private string $urlController;
	/* @var string $urlSlugController recebe a controller convertida para o formato do nome da classe*/
	private string $urlMetodo;
	/* @var string $urlMetodo recebe da URL o metodo*/
	private string $urlParametro;
	/* @var string $urlParametro recebe da URL o parametro*/
	private string $urlSlugController;
    private string $slugMetodo;
	private array $format;
	 /* @var string classe recebe a clasee*/
	private string $classe;

	private string $rodizio;

	/**
	 * Receber a URL do .htaccess
	 * Validar a URL
	 */

	

	public function __construct()
	{

		$this->config();
		//receber a url
		if (!empty(filter_input(INPUT_GET, "url",FILTER_DEFAULT))) {
			
		$this->url=filter_input(INPUT_GET, "url",FILTER_DEFAULT);

		$this->limparURL();
		
		$this->urlConjunto=explode("/", $this->url);
$this->rodizio = '';

	    
		
		if (isset($this->urlConjunto[0])) {
			$this->urlController=$this->slugController($this->urlConjunto[0]);
		}else{
			$this->urlController=CONTROLLER;
		}

		if (isset($this->urlConjunto[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlConjunto[1]);
            } else {
                $this->urlController = $this->slugController($this->urlController);
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

		if (isset($this->urlConjunto[2])) {
			$this->urlParametro=$this->urlConjunto[2];
		}else{
			$this->urlParametro="";
		}
		}else{
			$this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
		}

		//echo "Controller: {$this->urlController}<br>Metodo: {$this->urlMetodo}<br>{$this->urlParametro}";
	}

	/**
	 *Limpa a URL, elimina as TAG, os espacos em branco, retirar a barra do final da URL e retirar os caracteres especiais
	 * 
	 * $return void
	 * */
	private function limparURL():void{
		//eliminar as tags
		$this->url=strip_tags($this->url);
		//eliminar espacos em branco
		$this->url=trim($this->url);
		//eliminar a barra no final da URL
		$this->url=rtrim($this->url,"/");

	$this->format['a']='ÀÁÂÃÄÅàáâãäåÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ”!@#$%&*()_-+={[}]?;:.,\’<>֯º ';
	$this->format['b']='AAAAAAaaaaaaEEEEIIIINOOOOOOUUUUUYaBaaaaaaaceeeeiiiionoooooouuuuyby-----------------------------=';

	$this->url = strtr(  
		mb_convert_encoding($this->url, 'ISO-8859-1', 'UTF-8'),  
		mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'),  // Added encoding parameters  
		$this->format['b'] // Assuming $this->format['b'] is already in ISO-8859-1.  If not, encode it too!  
	);
 }

	//colocar mauscullo primeira letra
	private function slugController($slugController){
		//converter para minusculo
		$this->urlSlugController=strtolower($slugController);
		//Converter o traco em espaco em branco
		$this->urlSlugController=str_replace("-"," ",$this->urlSlugController);
		//converter a primeira letra de cada palavra maiuscula
		$this->urlSlugController=ucwords($this->urlSlugController);
		//Retir o espaco em branco
		$this->urlSlugController=str_replace(" ","",$this->urlSlugController);

		return $this->urlSlugController;
	}

	private function slugMetodo($slugMetodo) {
        $this->slugMetodo = $this->slugController($slugMetodo);
        //Converter para minusculo a primeira letra
        $this->slugMetodo = lcfirst($this->slugMetodo);

        return $this->slugMetodo;
    }
	/*
	public function carregar() {
        $carregarPgAdm = new \Core\CarregarPgAdmLevel();
        $carregarPgAdm->carregarPg( $this->urlController, $this->urlMetodo, $this->urlParamentro);        
    }*/
	public function carregar(){

		

		
		$this->classe="\\App\\sts\\Controllers\\".$this->urlController;
		
		if (class_exists($this->classe)) {
			$this->carregarMetodo();
		}else{
			$this->urlController=$this->slugController(CONTROLLERERRO);
			$this->carregar();
		}
		

	}
	private function carregarMetodo(){
			$classeCarregar= new $this->classe();
			if (method_exists($classeCarregar, $this->urlMetodo)) {
				$classeCarregar->{$this->urlMetodo}($this->urlParametro);
			}else{
				//var_dump($this->urlConjunto);
			die('Erro: Por favor tente novamnete. Caso o problema persista, entre em contacto o administrador '.EMAILADM."<br>");

			}
		
		}
}