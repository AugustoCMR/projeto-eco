<?php

namespace Application\core;

use Application\models\Users;

class Controller
{

  /**
   * Método para chamar a model solicitada
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $model model para buscar na pasta.
   */
  public function model($model)
  {
    require '../Application/models/' . $model . '.php';
    $classe = 'Application\\models\\' . $model;
    return new $classe();

  }

  /**
   * Método para chamar a view solicitada.
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   * @param $view view para buscar na pasta
   * @param $dados para passar informações na view
   */
  public function view(string $view, $dados = [])
  {
    
    require '../Application/views/' . $view . '.php';

  }

  /**
   * Método para caso não encontre uma view solicitada, lançar um erro.
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   */
  public function pageNotFound()
  {
    $this->view('erro404');
  }
}
