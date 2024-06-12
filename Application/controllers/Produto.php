<?php

use Application\core\Controller;
use Application\models\Eco;
use Application\intermediarios\ProdutoIntermediario;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';

class Produto extends Controller 
{
    public function cadastrar_produto()
    {
        try 
        {   
            if(isset($_POST['cadastrar_produto']))
            {  
                
                $intermediario = new ProdutoIntermediario;
               
                $produto = strtolower($_POST['produto']);
                $eco = $_POST['eco_valor'];

                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $produto,
                    'Eco Points' => $eco
                ]);

                $validador = $intermediario->validaFormularioCadastrarProduto($camposObrigatorios, $eco, $produto);

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

    public function cadastrar_operacao_entrada_produto()
    {

        try {
            
            $produtoModel = $this->model('Produtos');
            $produtos = $produtoModel::consultar_produtos();
    
            if(isset($_POST['cadastar_entrada_produto']))
            {   
                $intermediario = new ProdutoIntermediario;
                $quantidade = $_POST['quantidade'];
                $valor_total = $_POST['real_valor'];
                $produto_id = $_POST['produto_id'];
                $valor_unitario = $_POST['valor_unitário'];
            
                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $produto_id,
                    'Quantidade' => $quantidade,
                    'Valor Unitário' => $valor_unitario,
                    'Valor Total' => $valor_total
                ]);

                $validaCampos = $intermediario->validaOperacaoEntrada($camposObrigatorios, $quantidade, $valor_unitario, $valor_total);
                
                if(!empty($validaCampos))
                {
        
                    return $this->view('produto/operacao_entrada', ['erros' => $validaCampos,
                    'produtos' => $produtos
                    ]);
                }

                $real_valor = explode(" ", $_POST['real_valor'])[1];

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

                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $produto_id,
                    'Usuário' => $usuario_id,
                    'Quantidade' => $quantidade,
                    'Saldo' => $saldo_usuario
                ]);

                $validacao = $intermediario->validaOperacaoSaida($camposObrigatorios, $saldo_usuario, $eco_valor, $quantidade);

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

    public function consultar_produto()
    {   

        $eco_valor = Eco::$eco;
        $produtos = $this->model('Produtos');
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
                        $eco_valor *= $quantidade;
                        
                    
                    }  else
                    {
            
                        return;
                    }
                }
       
        return $this->view('Produto/consultar_produto', ['produto' => $dados, 'real' => $eco_valor]);
    }
    
}