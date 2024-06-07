<?php

use Application\core\Controller;

class Produto extends Controller
{
    public function cadastrar_produto()
    {
        $this->view('produto/cadastrar_produto');
    }

    public function cadastrar_produto_sucesso()
    {
        $nome = $_POST['nome'];
        $eco_valor = $_POST['eco_valor'];

        $produtoModel = $this->model('Produtos');
        $data = $produtoModel::cadastrar_produto($nome, $eco_valor);
        $this->view('produto/cadastrar_produto_sucesso');
    }
}