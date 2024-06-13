<?php

namespace Application\core;

class App
{
  protected $controller = 'Home';
  protected $indexController = 2;
  protected $method = 'index';
  protected $params = [];

  /**
   * Método executar todos os métodos da URl e preparar o caminho/método da página
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   */
  public function __construct()
  {
    $URL_ARRAY = $this->parseUrl();
    $this->getControllerDaUrl($URL_ARRAY);
    $this->getMethodDaUrl($URL_ARRAY);
    $this->getParamsDaUrl($URL_ARRAY);

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  /**
   * Método para pegar a URL da requisição da URI 
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   */
  private function parseUrl()
  {
    $REQUEST_URI = explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
    
    return $REQUEST_URI;
  }

  /**
   * Método para pegar a URL digitada e verificar se existe o controller específicado.
   * caminho nomeDoArquivoController/nomeDoMétodo/parâmetro
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $url url digitada na web
   */
  private function getControllerDaUrl($url)
  {
    if ( !empty($url[$this->indexController]) && isset($url[$this->indexController]) ) {
      if ( file_exists('../Application/controllers/' . ucfirst($url[$this->indexController])  . '.php') ) {
        $this->controller = ucfirst($url[$this->indexController]);
      } else {

        $this->method = "pageNotFound";
      }
    }

    require '../Application/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller();

  }

  /**
   * Método para pegar a URL digitada e verificar se existe o método específicado.
   * caminho nomeDoArquivoController/nomeDoMétodo/parâmetro
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $url url digitada na web
   */
  private function getMethodDaUrl($url)
  {
    if ( !empty($url[1 + $this->indexController]) && isset($url[1 + $this->indexController]) ) {
      if ( method_exists($this->controller, $url[1 + $this->indexController])) {
        
        $this->method = $url[1 + $this->indexController];
      } else {
        
        $this->method = 'pageNotFound';
      }
    } 
 
  }
  
   /**
   * Método para pegar a URL digitada e verificar se existe algum paramêtro específicado.
   * caminho nomeDoArquivoController/nomeDoMétodo/parâmetro
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $url url digitada na web
   */
  private function getParamsDaUrl($url)
  {
    if (count($url) > (2 + $this->indexController)) {
      $this->params = array_slice($url, (2 + $this->indexController));
    }
  }

} 
