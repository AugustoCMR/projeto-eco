<?php

use Application\core\Controller;
use Application\models\Eco;
use Application\intermediarios\ProdutoIntermediario;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';

class Produto extends Controller 
{   
     /**
   * Método para cadastrar produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrar()
    {
        try 
        {   
            if(isset($_POST['cadastrarProduto']))
            {  
                
                $intermediario = new ProdutoIntermediario;
               
                $produto = strtolower($_POST['nm_produto']);
                $eco = $_POST['vl_eco'];

                $eco = str_replace(',', '.', $eco);
                $eco = preg_replace('/\.(?=.*\.)/', '', $eco);

                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $produto,
                    'Eco Points' => $eco
                ]);

                $validador = $intermediario->validaFormularioCadastrarProduto($camposObrigatorios, $eco, $produto);

                if(!empty($validador))
                {
                    return $this->view('produto/cadastrar', ['erros' => $validador]);
                }
                

                $produtoModel = $this->model('Produtos');
                $produtoModel::cadastrarProduto($produto, $eco);
                return $this->view('produto/cadastroProdutoSucesso');
            } else 
            {   
                
                return $this->view('produto/cadastrar');
            }
        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo($e);
        }

        
    }

      /**
   * Método para editar o produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do produto
   */
  public function editar($id = null)
    {
       try {
        $produtoModel = $this->model('Produtos');
        $produto = $produtoModel::consultarProduto($id);
        

        if(isset($_POST['editarProduto']))
        {
            $intermediario = new ProdutoIntermediario;
            $id = $_POST['editarProduto'];
            $produto = $produtoModel::consultarProduto($id);

            $nome = strtolower($_POST['nm_produto']);
            $eco = $_POST['vl_eco'];
            $quantidade = $_POST['qt_produto'];

            $eco = str_replace(',', '.', $eco);
            $eco = preg_replace('/\.(?=.*\.)/', '', $eco);

            $camposObrigatorios = validarCamposObrigatorios([
                'Produto' => $nome,
                'Eco Points' => $eco
            ]);

            $validador = $intermediario->validaFormularioCadastrarProduto($camposObrigatorios, $eco,  $nome, $produto[0]['nm_produto']);

            if(!empty($validador))
            {
                return $this->view('produto/editar', ['erros' => $validador,
                'produto' => $produto
                ]);
            }

            $produtoModel::editar($nome, $eco, $quantidade, $id);

            return $this->view('produto/editadoSucesso');
        } else
        {   
            return $this->view('produto/editar', [
                'produto' => $produto
            ]);
        }
       } catch (Exception $e) {
        echo("Algo deu errado, por favor, tente novamente.");
        echo $e;
       }    
    }

        /**
   * Método para deletar o produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do produto
   */
    public function deletar($id)
    {
        try {
            $intermediario = new ProdutoIntermediario;
            
            $cotacao_eco = Eco::$eco;
            $cotacao_real = Eco::$real;

            $produtoModel = $this->model('Produtos');
            $dados = $produtoModel::consultarProdutos();
            $erros = $intermediario->validaDeletar($id);
    
            if(!empty($erros))
            {
                return $this->view('produto/consultarProdutos', [
                'produto' => $dados,
                'cotacao_real' => $cotacao_real,
                'cotacao_eco' => $cotacao_eco,
                'erros' => $erros
                ]);
            }
    
            $produtoModel::deletar($id);
            $dadosAtualizados = $produtoModel::consultarProdutos();
          
            return $this->view('produto/consultarProdutos', [
                'produto' => $dadosAtualizados,
                'cotacao_real' => $cotacao_real,
                'cotacao_eco' => $cotacao_eco
        ]);
    
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }
    }

       /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function editadoSucesso()
  {
      try 
      {
          if(!empty($_POST['menu']) && isset($_POST['menu']))
          {
              return $this->view('home/index');

          } else if(!empty($_POST['listar']) && isset($_POST['listar']))
          {   
              $produtos = $this->model('produtos');
              $dados = $produtos::consultarProdutos();
              $cotacao_eco = Eco::$eco;
              $cotacao_real = Eco::$real;
              return $this->view('produto/consultarProdutos',[
                'produto' => $dados,
                'cotacao_real' => $cotacao_real,
                'cotacao_eco' => $cotacao_eco
              ]);
          }  else {
              return $this->view('produto/cadastroProdutoSucesso');
          }

      } catch (Exception $e) 
      {
          echo("Algo deu errado, por favor, tente novamente.");
          echo $e;
      }    
  }

    /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastroProdutoSucesso()
  {
      try   
      {     
        
        $cotacao_eco = Eco::$eco;
        $cotacao_real = Eco::$real;
        $produtos = $this->model('Produtos');
        $dados = $produtos::consultarProdutos();

          if(!empty($_POST['menu']) && isset($_POST['menu']))
          {
            return $this->view('home/index');

          } else if(!empty($_POST['listar']) && isset($_POST['listar']))
          {
            return $this->view('Produto/consultarProdutos', [
            'produto' => $dados, 
            'cotacao_real' => $cotacao_real,
            'cotacao_eco' => $cotacao_eco
        ]);
          } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
          {
            return $this->view('produto/cadastrar');
          } else 
          {
            return $this->view('produto/cadastroProdutoSucesso');
          }

      } catch (Exception $e) 
      {
          echo("Algo deu errado, por favor, tente novamente.");
          echo $e;
      }    
  }

     /**
   * Método para cadastrar a operação de entrada do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarProdutoEntregue()
    {

        try {
            
            $produtoModel = $this->model('Produtos');
            $produtos = $produtoModel::consultarProdutos();
            $cotacao_real = Eco::$real;
            $cotacao_eco = Eco::$eco;
    
            if(isset($_POST['cadastrarProdutoEntregue']))
            {   
               
                $intermediario = new ProdutoIntermediario;
                $quantidade = $_POST['qt_produtoentregue'];
                $valor_total = $_POST['vl_real'];
                $idProduto = $_POST['idProduto'];
                $formataValor = explode(" ", $_POST['vl_unitario']);
                $valor_unitario = isset($formataValor[1]) ? (float)$formataValor[1] : '';
            
                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $idProduto,
                    'Quantidade' => $quantidade,
                    'Valor Unitário' => $valor_unitario,
                    'Valor Total' => $valor_total
                ]);

                $validaCampos = $intermediario->validaOperacaoEntrada($camposObrigatorios, $quantidade, $valor_unitario, $valor_total);
                
                if(!empty($validaCampos))
                {
        
                    return $this->view('produto/cadastrarProdutoEntrada', ['erros' => $validaCampos,
                    'produtos' => $produtos,
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' =>
                    $cotacao_eco
                    ]);
                }

                $real_valor = explode(" ", $_POST['vl_real'])[1];

                $produtoModel::cadastrarProdutoEntregue($quantidade, $real_valor, $idProduto);
                $produtoModel::operacaoEntradaProduto($idProduto, $quantidade);
                return $this->view('produto/cadastroProdutoEntradaSucesso');

            } else 
            {
                return $this->view('produto/cadastrarProdutoEntrada', [
                    'produtos' => $produtos,
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' =>
                    $cotacao_eco
                ]);
            }

        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }
    } 

     /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastroProdutoEntradaSucesso()
    {
        $cotacao_eco = Eco::$eco;
        $cotacao_real = Eco::$real;
        $produtos = $this->model('Produtos');
        $dados = $produtos::consultarProdutos();
        try 
        {
            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['listar']) && isset($_POST['listar']))
            {
                return $this->view('produto/consultarProdutos', [
                    'produto' => $dados, 
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);

            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {
                return $this->view('produto/cadastrarProdutoEntrada');
            } else {
                return $this->view('produto/cadastroProdutoEntradaSucesso');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

      /**
   * Método para cadastrar a operação de saida do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarProdutoSaida()
    {

        try {

            $produtoModel = $this->model('Produtos');
            $usuarioModel = $this->model('Usuarios');

            $produtos = $produtoModel::consultarProdutos();
            $usuarios = $usuarioModel::buscarUsuarios();
            
            if (isset($_POST['cadastrarProdutoSaida'])) {

                $intermediario = new ProdutoIntermediario;
                $quantidade = $_POST['qt_produtoretirado'];
                $idUsuario = $_POST['idUsuario'];
                $idProduto = $_POST['idProduto'];
                $formataValorSaldo = explode(" ", $_POST['vl_ecosaldo']);
                $formataValorEco = explode(" ", $_POST['vl_ecoProduto']);
                $formataValorFinal = explode(" ", $_POST['vl_ecoTotal']);
                $vl_ecoProduto = isset($formataValorEco[1]) ? (float)$formataValorEco[1] : '';
                $vl_ecosaldo = isset($formataValorSaldo[1]) ? (float)$formataValorSaldo[1] : '';
                $vl_ecoFinal = isset($formataValorFinal[1]) ? (float)$formataValorFinal[1] : '';

                $camposObrigatorios = validarCamposObrigatorios([
                    'Produto' => $idProduto,
                    'Usuário' => $idUsuario,
                    'Quantidade' => $quantidade,
                    'Saldo' => $vl_ecosaldo,
                    'Valor do Produto' => $vl_ecoProduto,
                    'Valor Final do Produto' => $vl_ecoFinal
                ]);

                $validacao = $intermediario->validaOperacaoSaida($camposObrigatorios, $vl_ecosaldo, $vl_ecoFinal, $vl_ecoProduto, $quantidade, $idUsuario, $idProduto);

                if(!empty($validacao))
                {   
                    return $this->view('produto/cadastrarProdutoSaida', ['erros' => $validacao,
                    'produtos' => $produtos,
                    'usuarios' => $usuarios
                    ]);
                }

                $produto = $produtoModel::consultarProduto($idProduto);
                $valorProduto = $produto[0]['vl_eco'];
                $valorFinal = $valorProduto * $quantidade;

                $usuarioModel::operacaoSaidaSaldo($idUsuario, $valorFinal);
                $saldo = $usuarioModel::consultarSaldo($idUsuario);
                $produtoModel::cadastrarProdutoSaida($quantidade, $idUsuario, $idProduto, $valorFinal, $saldo[0]['vl_ecosaldo']);
                $produtoModel::operacaoSaidaProduto($idProduto, $quantidade);
                
                return $this->view('produto/cadastroProdutoSaidaSucesso');                                   
            } else {

                return $this->view('produto/cadastrarProdutoSaida', [
                'produtos' => $produtos,
                'usuarios' => $usuarios]);
            }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }

      
    }

    /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastroProdutoSaidaSucesso()
    {
        $cotacao_eco = Eco::$eco;
        $cotacao_real = Eco::$real;
        $produtos = $this->model('Produtos');
        $dados = $produtos::consultarProdutos();
        try 
        {
            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['listar']) && isset($_POST['listar']))
            {
                return $this->view('produto/consultarProdutos', [
                    'produto' => $dados, 
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);

            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {
                return $this->view('produto/cadastrarProdutoSaida');
            } else {
                return $this->view('produto/cadastroProdutoSaidaSucesso');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

     /**
   * Método para consultar produtos
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function consultarProdutos()
    {   

        $cotacao_eco = Eco::$eco;
        $cotacao_real = Eco::$real;
        $produtos = $this->model('Produtos');
        $dados = $produtos::consultarProdutos();

                if(isset($_POST['submit_quantidade'])) {

                    if(!empty($_POST['produto']) && isset($_POST['produto'])) 
                    {
                        $filtro = $_POST['produto'];
                        $dados = $produtos::consultarProdutoNome($filtro);   
                    }  
                    
                    if(!empty($_POST['quantidade']) && isset($_POST['quantidade'])) 
                    {       
                        
                        $quantidade = $_POST['quantidade'];
                        // $eco = $cotacao_eco * $quantidade;
                        // $real = $cotacao_real * $quantidade;
                        
                        return $this->view('Produto/consultarProdutos', [
                            'produto' => $dados,
                            'quantidade' => $quantidade,
                            // 'vl_ecoTabela' => $eco,
                            // 'real_valorTabela' => $real,
                            'cotacao_real' => $cotacao_real,
                            'cotacao_eco' => $cotacao_eco
                        ]);

                    } 
                }
                
        return $this->view('Produto/consultarProdutos', [
            'produto' => $dados, 
            'cotacao_real' => $cotacao_real,
            'cotacao_eco' => $cotacao_eco
        ]);
    }
    
}