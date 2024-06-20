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

            $produtoModel::editar($nome, $eco, $id);

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
  
          if (isset($_POST['cadastrarProdutoEntregue'])) {
              $intermediario = new ProdutoIntermediario;
              $tabela = json_decode($_POST['dadosTabela'], true);

              if(empty($tabela))
              {
                $erro = [];
                
                $erro['dadosVazios'] = 'Adicione no mínimo um item para completar a operação';
                return $this->view('produto/cadastrarProdutoEntrada', [
                    'erros' => $erro,
                    'produtos' => $produtos,
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);
              }
              
              $produtosValidos = [];
  
              foreach ($tabela as $item) {
                  $quantidade = $item['quantidade'];
                  $idProduto = $item['idProduto'];
                  $formataValorUnitario = str_replace(['R$', ' '], '', $item['valorUnitario']);
                  $formataValorTotal = str_replace(['R$', ' '], '', $item['valorFinal']);
                  $valor_total = (float) str_replace(',', '.', $formataValorTotal);
                  $valor_unitario = (float) str_replace(',', '.', $formataValorUnitario);
  
                  $camposObrigatorios = validarCamposObrigatorios([
                      'Produto' => $idProduto,
                      'Quantidade' => $quantidade,
                      'Valor Unitário' => $valor_unitario,
                      'Valor Total' => $valor_total
                  ]);
  
                  $validaCampos = $intermediario->validaOperacaoEntrada($camposObrigatorios, $quantidade, $valor_unitario, $valor_total, $tabela);
  
                  if (!empty($validaCampos)) {
                      return $this->view('produto/cadastrarProdutoEntrada', [
                          'erros' => $validaCampos,
                          'produtos' => $produtos,
                          'cotacao_real' => $cotacao_real,
                          'cotacao_eco' => $cotacao_eco,
                          'tabela' => $tabela,
                      ]);
                  }
  
                
                  $produtosValidos[] = [
                      'quantidade' => $quantidade,
                      'valor_total' => $valor_total,
                      'id_produto' => $idProduto
                  ];
              }
  
              
              foreach ($produtosValidos as $produtoValido) {
                  $quantidade = $produtoValido['quantidade'];
                  $valor_total = $produtoValido['valor_total'];
                  $idProduto = $produtoValido['id_produto'];
  
                  $produtoModel::cadastrarProdutoEntregue($quantidade, $valor_total, $idProduto);
                  $produtoModel::operacaoEntradaProduto($idProduto, $quantidade);
              }
  
              return $this->view('produto/cadastroProdutoEntradaSucesso');
          } else {
              return $this->view('produto/cadastrarProdutoEntrada', [
                  'produtos' => $produtos,
                  'cotacao_real' => $cotacao_real,
                  'cotacao_eco' => $cotacao_eco
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
                return $this->view('produto/consultarProdutos', [
                    'produto' => $dados, 
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);

            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {   

                return $this->view('produto/cadastrarProdutoEntrada', [
                    'produtos' => $dados,
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);
                
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
              $tabela = json_decode($_POST['dadosTabela'], true);

              if(empty($tabela))
              {
                $erro = [];

                $erro['dadosVazios'] = 'Adicione no mínimo um item para finalizar a compra';
                return $this->view('produto/cadastrarProdutoSaida', [
                    'erros' => $erro,
                    'produtos' => $produtos,
                  'usuarios' => $usuarios
                ]);
              }

              $itensValidos = []; 
  
              foreach ($tabela as $item) 
              {
                  $quantidade = $item['quantidade'];
                  $idUsuario = $item['idUsuario'];
                  $idProduto = $item['idProduto'];
                  $nm_usuario = $item['nm_usuario'];
                  $saldoUsuario = $item['saldoUsuario'];
                  $formataValorSaldo = explode(" ", $item['saldoUsuario']);
                  $formataValorEco = explode(" ", $item['valorProduto']);
                  $formataValorFinal = explode(" ", $item['valorFinal']);
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
  
                  $validacao = $intermediario->validaOperacaoSaida($camposObrigatorios, $vl_ecosaldo, $vl_ecoFinal, $vl_ecoProduto, $quantidade, $idUsuario, $idProduto, $tabela);
  
                  if (!empty($validacao)) {
                      return $this->view('produto/cadastrarProdutoSaida', [
                          'erros' => $validacao,
                          'produtos' => $produtos,
                          'usuarios' => $usuarios,
                          'tabela' => $tabela,
                          'nm_usuario' => $nm_usuario,
                          'saldoUsuario' => $saldoUsuario,
                          'id_usuario' => $idUsuario
                      ]);
                  }
  
                  $itensValidos[] = [
                      'quantidade' => $quantidade,
                      'idUsuario' => $idUsuario,
                      'idProduto' => $idProduto,
                      'nm_usuario' => $nm_usuario,
                      'saldoUsuario' => $saldoUsuario,
                      'vl_ecoProduto' => $vl_ecoProduto,
                      'vl_ecosaldo' => $vl_ecosaldo,
                      'vl_ecoFinal' => $vl_ecoFinal
                  ];
                }
  
              foreach ($itensValidos as $item) {
                  $produto = $produtoModel::consultarProduto($item['idProduto']);
                  $valorProduto = $produto[0]['vl_eco'];
                  $valorFinal = $valorProduto * $item['quantidade'];
  
                  $usuarioModel::operacaoSaidaSaldo($item['idUsuario'], $valorFinal);
                  $saldo = $usuarioModel::consultarSaldo($item['idUsuario']);
                  $produtoModel::cadastrarProdutoSaida($item['quantidade'], $item['idUsuario'], $item['idProduto'], $valorFinal, $saldo[0]['vl_ecosaldo']);
                  $produtoModel::operacaoSaidaProduto($item['idProduto'], $item['quantidade']);
              }
  
              return $this->view('produto/cadastroProdutoSaidaSucesso');
          } else {

              return $this->view('produto/cadastrarProdutoSaida', [
                  'produtos' => $produtos,
                  'usuarios' => $usuarios
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
    public function cadastroProdutoSaidaSucesso()
    {
       

        try 
        {

            $cotacao_eco = Eco::$eco;
            $cotacao_real = Eco::$real;
            $produtoModel = $this->model('Produtos');
            $usuarioModel = $this->model('Usuarios');
    
            $produtos = $produtoModel::consultarProdutos();
            $usuarios = $usuarioModel::buscarUsuarios();

            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['listar']) && isset($_POST['listar']))
            {
                return $this->view('produto/consultarProdutos', [
                    'produto' => $produtos, 
                    'cotacao_real' => $cotacao_real,
                    'cotacao_eco' => $cotacao_eco
                ]);

            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {
                return $this->view('produto/cadastrarProdutoSaida', [
                    'produtos' => $produtos,
                    'usuarios' => $usuarios
                ]);
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