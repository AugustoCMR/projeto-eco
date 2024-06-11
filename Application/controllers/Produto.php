<?php

use Application\core\Controller;
use Application\models\Eco;
use Application\intermediarios\ProdutoIntermediario;

class Produto extends Controller 
{
    public function cadastrar_produto()
    {
        try 
        {   
            if(isset($_POST['cadastrar_produto']))
            {  
                
                $intermediario = new ProdutoIntermediario;
                $validador = $intermediario->validaFormularioCadastrarProduto();
               
                $produto = $_POST['produto'];
                $eco = $_POST['eco_valor'];

                if(!empty($validador))
                {
                    return $this->view('produto/cadastrar_produto', ['erros' => $validador]);
                }
                

                $produtoModel = $this->model('Produtos');
                $data = $produtoModel::cadastrar_produto($produto, $eco);
                return $this->view('produto/cadastrar_produto_sucesso');
            } else 
            {   
                
                return $this->view('produto/cadastrar_produto');
            }
        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo($e);
        }

        
    }

    public function cadastrar_produto_sucesso()
    {
        
    }

    public function cadastrar_operacao_entrada_produto()
    {

        try {
            
            $produtoModel = $this->model('Produtos');
            $produtos = $produtoModel::consultar_produtos();
    
            if(isset($_POST['cadastar_entrada_produto']))
            {   
                $intermediario = new ProdutoIntermediario;
                $quantidade = $_POST['quantidade'];
                $formataValor = explode(" ", $_POST['real_valor']);
                $produto_id = $_POST['produto_id'];

                $real_valor = $formataValor[1];
                $validaCampos = $intermediario->validaFormularioTiposNumber($real_valor, $quantidade);
                
                if(!empty($validaCampos))
                {
             
                    return $this->view('produto/operacao_entrada', ['erros' => $validaCampos,
                    'produtos' => $produtos
                    ]);
                }

        
                $produtoModel::cadastrar_operacao_entrada_produto($quantidade, $real_valor, $produto_id);
                $produtoModel::operacaoEntradaProduto($produto_id, $quantidade);
                return $this->view('produto/operacao_entrada_sucesso');

            } else 
            {
                return $this->view('produto/operacao_entrada', [
                    'produtos' => $produtos
                ]);
            }

        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }
    } 

    public function cadastrar_operacao_saida_produto()
    {

        try {

            $produtoModel = $this->model('Produtos');
            $usuarioModel = $this->model('Users');

            $produtos = $produtoModel::consultar_produtos();
            $usuarios = $usuarioModel::buscarUsuarios();
            
            if (isset($_POST['cadastrar_saida_produto'])) {

                $intermediario = new ProdutoIntermediario;
                $quantidade = $_POST['quantidade'];
                $usuario_id = $_POST['usuario_id'];
                $produto_id = $_POST['produto_id'];
                $saldo_usuario = $_POST['saldo_usuario'];
                $formataValor = explode(" ", $_POST['eco_valor']);
                $eco_valor = (float)$formataValor[1];

                $validacao = $intermediario->validaOperacaoSaida($saldo_usuario, $eco_valor, $quantidade);

                if(!empty($validacao))
                {   
                    return $this->view('produto/operacao_saida', ['erros' => $validacao,
                    'produtos' => $produtos,
                    'usuarios' => $usuarios
                    ]);
                }

                $produtoModel::cadastrar_operacao_saida_produto($quantidade, $usuario_id, $produto_id, $eco_valor);
                $produtoModel::operacaoSaidaProduto($produto_id, $quantidade);
                $usuarioModel::operacaoSaidaSaldo($usuario_id, $eco_valor);
                return $this->view('produto/operacao_saida_sucesso');                                                                                                                                                                                                                                                                                                                                                                                                                                                           
        
            } else {

                return $this->view('produto/operacao_saida', [
                'produtos' => $produtos,
                'usuarios' => $usuarios]);
            }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }

      
    }

    public function cadastrar_operacao_saida_produto_sucesso()
    {
        
    }

    public function consultar_produto()
    {   

        $real_valor = Eco::$eco;
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
    
                 return;
            }
        }
       
        return $this->view('Produto/consultar_produto', ['produto' => $select, 'real' => $real_valor, 'dados' => $dados]);
    }
    
}