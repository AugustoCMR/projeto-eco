<?php

namespace Application\intermediarios;

use Application\core\Database;
use Application\models\Eco;
use Application\models\Usuarios;
use Application\models\Produtos;
use Exception;
use PDO;

require __DIR__ . '\\../utils/validaCamposTipoNumero.php';

class ProdutoIntermediario 
{

    public $erros = [];

      /**
   * Método para chamar outros métodos que validam o formulário de cadastro
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $errosCampo armazena campos obrigatórios
   * @param $eco valor do produto em eco
   * @param $nome nome do produto
   * @param $nomeEdicao nome do produto para edição se requisitado
   */
    public function validaFormularioCadastrarProduto($errosCampo, $eco, $nome, $nomeEdicao = null)
    {
     
        if(!empty($errosCampo))
        {   
         
            return $this->erros = $errosCampo;   
        }

       $this->validaEcoPoint($eco);
       $this->validaNomeProduto($nome, $nomeEdicao);

       return $this->erros;
    }

       /**
   * Método para validar a operação deletar produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do produto
   */
  public function validaDeletar($id)
  {
   
    $conn = new Database();
    $buscarRegistrosEntrada = $conn->executarQuery('SELECT * FROM produto_entregue WHERE id_produto = :id', array(
        ':id' => $id
    ));

    $resultado = $buscarRegistrosEntrada->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $this->erros['registros'] = "Não é possível deletar, produto possuí registros";
        return $this->erros;
    }

  }



        /**
   * Método para validar o cadastro de entrada dos produtos
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $errosCampo campos obrigatórios do formulário
   * @param $quantidade quantidade fornecida do produto
   * @param $valorUnitario valor unitário do produto
   * @param $valorTotal valor total do produto x quantidade
   */
    public function validaOperacaoEntrada($errosCampo, $quantidade, $valorUnitario, $valorTotal, $dados)
    {  
        
        
        if(empty($dados))
        {
            $this->erros['dadosVazios'] = 'Adicione no mínimo um item para finalizar a compra';
            return $this->erros;
        }

        if(!empty($errosCampo))
        {
            return $this->erros = $errosCampo;
        }

        $camposTipoNumero = validarTipoNumero([
            'Quantidade' => $quantidade,
            'Valor Unitário' => $valorUnitario,
            'Valor total' => $valorTotal
        ]);

        $idsProdutos = array_column($dados, 'idProduto');

        if(count($idsProdutos) !== count(array_unique($idsProdutos)))
        {
            $this->erros['produtosDuplicados'] = "Produtos duplicados não podem ser cadastrados";

            return $this->erros;
        }

        if($valorUnitario <= 0 )
        {
            $this->erros["valorUnitarioInvalido"] = "O valor unitário não pode ser menor que um"; 

            return $this->erros; 
        }

        if($valorTotal <= 0 )
        {
            $this->erros["valorTotalInvalido"] = "O valor total não pode ser menor que um"; 

            return $this->erros; 
        }

        if($quantidade <= 0)
        {   
           
            $this->erros["quantidadeInvalida"] = "A quantidade não pode ser menor que um"; 

            return $this->erros;
        }

        if(!empty($camposTipoNumero)) {
           $this->erros = $camposTipoNumero;
        }

        return $this->erros;

    }

        /**
   * Método para validar a retirada do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $errosCampo campos obrigatórios
   * @param $saldo saldo do usuário
   * @param $valorFinal valor final da transação
   * @param $quantidade quantidade do produto retirado
   * @param $dados dados enviados da tabela de cadastro
   */
    public function validaOperacaoSaida($errosCampo, $saldo, $valorFinal, $valorProduto, $quantidade, $idUsuario, $idProduto, $dados)
    {   
    
        if(!empty($errosCampo))
        {
            return $this->erros = $errosCampo;
        }

        $camposTipoNumero = validarTipoNumero([
            'Quantidade' => $quantidade,
            'Valor do Produto' => $valorProduto,
            'Valor final do Produto' => $valorFinal,
            'Saldo' => $saldo
        ]);

        $idsProdutos = array_column($dados, 'idProduto');
        $idsUsuarios = array_column($dados, 'idUsuario');

        if(count(array_unique($idsUsuarios)) > 1)
        {
            $this->erros['usuariosDuplicados'] = "Todos os produtos devem pertencer ao mesmo usuário";
            return $this->erros;
        }

        if(count($idsProdutos) !== count(array_unique($idsProdutos)))
        {
            $this->erros['produtosDuplicados'] = "Produtos duplicados não podem ser cadastrados";
            return $this->erros;
        }

        if($valorProduto <= 0) {
            $this->erros['valorProdutoInvalido'] = "Valor do Produto não pode ser menor que 1";
            return $this->erros;
          }

        if($valorFinal <= 0) 
        {
            $this->erros['valorFinalInvalido'] = "Valor final não pode ser menor que 1";
            return $this->erros;
        }

        if($quantidade < 1) 
        {
            $this->erros['quantidadeInvalida'] = "Quantidade não pode ser menor que 1";
            return $this->erros;
          }

        if(!empty($camposTipoNumero)) {
            $this->erros = $camposTipoNumero;
         }

        $this->consultaQuantidadeProduto($idProduto, $quantidade);
        $this->verificaSaldo($idUsuario, $valorFinal);

        return $this->erros;
    }

       /**
   * Método para validar o nome do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $produto nome do produto
   */
    public function validaNomeProduto($produto, $nomeEdicao = null)
    {
        try
        {   
            
                $conn = new Database();
                $buscaProduto = $conn->executarQuery('SELECT * FROM produto WHERE nm_produto = :nome', array(
                ':nome' => $produto
                ));

                $resultado = $buscaProduto->fetchAll(PDO::FETCH_ASSOC);

                if($produto === $nomeEdicao)
                {
                    return;
                }

                if(!empty($resultado)) {
                     
                    return $this->erros["produto"] = "O produto informado já existe.";   
                }
              
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

       /**
   * Método para chamar validar o campo Eco Points
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $eco valor do produto
   */
    public function validaEcoPoint($eco)
    {
        try
        {   
                if(!is_numeric($eco)) {
                     
                    return $this->erros["ecoInvalido"] = "O Eco Points deve conter apenas números.";   
                }
             
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
    /**
     * Metodo para validar inputs do tipo number
     * @author Augusto Ribeiro
     * @created 13/06/2024
     * @param $valor Valor input
     * @param $quantidade Quantidade input
     */
    public function validaFormularioTiposNumber($valor = Null, $quantidade = Null)
    {
        try
        {   
        
                if($valor !== null && !is_numeric($valor)) {
                     
                    return $this->erros["valorInvalido"] = "O valor deve conter apenas números.";   
                }

                if($quantidade !== null && !is_numeric($quantidade)) {
                     
                    return $this->erros["quantidadeInvalida"] = "A quantidade deve conter apenas números.";   
                }

                

        } catch(Exception $e)

        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
/**
   * Metodo para verificar o saldo do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $saldo Saldo do usuário
   * @param $valorFinal Valor total da transação de saida do produto
   */
    public function verificaSaldo($idUsuario, $valorFinal)
    {   
    
        $saldo = Usuarios::consultarSaldo($idUsuario);

        if($valorFinal > $saldo[0]['vl_ecosaldo']) {
    
            $this->erros["saldoInsuficiente"] = "Saldo Insuficiente para esta operação";
           return $this->erros;
        } 
    }

    /**
   * Metodo para verificar a quantidade do produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $idProduto id do produto
   * @param $quantidadeDigitada quantidade digitada no formulário
   */
    public function consultaQuantidadeProduto($idProduto, $quantidadeDigitada)
    {
        $produto = Produtos::consultarProduto($idProduto);
        $quantidade = $produto[0]['qt_produto'];

        if($quantidade < $quantidadeDigitada)
        {
            $this->erros['quantidadeInsuficiente'] = "Quantidade Insuficiente para esta operação";
        }
    }
}