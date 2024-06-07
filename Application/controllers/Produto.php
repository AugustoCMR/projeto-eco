<?php

use Application\core\Controller;

class Produto extends Controller
{
    public function cadastrar_produto()
    {
        $this->view('produto/cadastrar_produto');
    }
}