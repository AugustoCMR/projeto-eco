<?php

use Application\core\Controller;

class Operacao extends Controller
{
 
  public function operacao_entrada()
  {
    
    $this->view('operacao/operacao_entrada');
  }
  public function operacao_saida()
  {
    
    $this->view('operacao/operacao_saida');
  }
 
}
