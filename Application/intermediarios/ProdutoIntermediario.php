<?php

namespace Application\intermediarios;

use Application\core\Database;
use Application\models\Eco;
use PDO;

class ProdutoIntermediario 
{

    public $erros = [];

    public function validaFormularioCadastrarProduto()
    {
       $this->validaEcoPoint();
       $this->validaNomeProduto();

       return $this->erros;
    }

    public function validaOperacaoSaida($saldo, $valorFinal, $quantidade)
    {
        $this->validaFormularioTiposNumber(null, $quantidade);
        $this->verificaSaldo($saldo, $valorFinal);

        return $this->erros;
    }

    public function validaNomeProduto()
    {
        try
        {   
            if(!empty($_POST['produto']) && isset($_POST['produto']))
            {   
                $produto = $_POST['produto'];
                $conn = new Database();
                $buscaProduto = $conn->executeQuery('SELECT * FROM produto WHERE nome = :nome', array(
                ':nome' => $produto
                ));

                $resultado = $buscaProduto->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)) {
                     
                    return $this->erros["produto"] = "O produto informado já existe.";   
                }
            } 

            
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    public function validaEcoPoint()
    {
        try
        {   
            if(!empty($_POST['eco_valor']) && isset($_POST['eco_valor']))
            {   
                $eco = $_POST['eco_valor'];

                if(!is_numeric($eco)) {
                     
                    return $this->erros["ecoInvalido"] = "O Eco Points deve conter apenas números.";   
                }
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