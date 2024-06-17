<?php

use Application\core\Controller;

class Home extends Controller
{
 /**
   * Encaminha para a página inicial
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function index()
  {
    
    $this->view('home/index');
  }
 
}
