<?php

namespace Application\intermediarios;

use Application\core\Database;
use Application\models\Eco;
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
    $buscarRegistros = $conn->executarQuery('SELECT * FROM produto_retirado WHERE id_produto = :id', array(
        ':id' => $id
    ));

    $resultado = $buscarRegistros->fetchAll(PDO::FETCH_ASSOC);

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
    public function validaOperacaoEntrada($errosCampo, $quantidade, $valorUnitario, $valorTotal)
    {   

        if($valorTotal !== "")
        {
            $valorFormatado = explode(" ", $_POST['vl_real'])[1];
        }
        

        if(!empty($errosCampo))
        {
            return $this->erros = $errosCampo;
        }

        $camposTipoNumero = validarTipoNumero([
            'Quantidade' => $quantidade,
            'Valor Unitário' => $valorUnitario,
            'Valor total' => $valorFormatado
        ]);

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
   */
    public function validaOperacaoSaida($errosCampo, $saldo, $valorFinal, $quantidade)
    {
        if(!empty($errosCampo))
        {
            return $this->erros = $errosCampo;
        }

        $camposTipoNumero = validarTipoNumero([
            'Quantidade' => $quantidade
        ]);

        if(!empty($camposTipoNumero)) {
            $this->erros = $camposTipoNumero;
         }

        $this->verificaSaldo($saldo, $valorFinal);

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

    public function verificaSaldo($saldo, $valorFinal)
    {
        if($valorFinal > $saldo) {
           return $this->erros['saldoInvalido'] = "Saldo insuficiente";
        }
    }
}