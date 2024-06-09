<?php

use Application\core\Controller;
use Application\models\Eco;

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

    public function cadastrar_operacao_entrada_produto()
    {
        $this->view('produto/operacao_entrada');
    }

    public function cadastrar_operacao_entrada_produto_sucesso()
    {
       $quantidade = $_POST['quantidade'];
       $real_valor = $_POST['real_valor'];
       $produto_id = $_POST['produto'];

       $operacaoModel = $this->model('Produtos');
       $result = $operacaoModel::cadastrar_operacao_entrada_produto_sucesso($quantidade, $real_valor, $produto_id);
       $this->view('produto/operacao_entrada_sucesso');
    }

    public function cadastrar_operacao_saida_produto()
    {
        $this->view('produto/operacao_saida');
    }

    public function cadastrar_operacao_saida_produto_sucesso()
    {
        $quantidade = $_POST['quantidade'];
        $usuario_id = $_POST['usuario'];
        $produto_id = $_POST['produto'];
        $eco_valor = $_POST['eco_valor'];

        $operacaoModel = $this->model('Produtos');
        $result = $operacaoModel::cadastrar_operacao_saida_produto($quantidade, $usuario_id, $produto_id, $eco_valor);
        $this->view('produto/operacao_saida_sucesso');

        return True;
    }

    public function consultar_produto()
    {   

        $real_valor = Eco::$real;
        $produtos = $this->model('Produtos');
        $select = $produtos::consultar_produtos();
        $dados = $produtos::consultar_produtos();

        if(!empty($_POST['produto_id']) && isset($_POST['produto_id'])) 
        {

            $filtro = $_POST['produto_id'];
            $dados = $produtos::consultar_produtos_id($filtro);    
        } 

        if(isset($_POST['submit_quantidade'])) {
        
            if(!empty($_POST['quantidade']) && isset($_POST['quantidade'])) 
            {       
               
                $quantidade = $_POST['quantidade'];
                $real_valor *= $quantidade;
                
               
            }  else
            {
                 echo "Oi";

                 return;
            }
        }
       
        return $this->view('Produto/consultar_produto', ['produto' => $select, 'real' => $real_valor, 'dados' => $dados]);
    }
    
}