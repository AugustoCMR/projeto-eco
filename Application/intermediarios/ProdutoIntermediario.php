<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

class ProdutoIntermediario 
{

    public $erros = [];

    public function __construct()
    {
       $this->validaEcoPoint();
       $this->validaNomeProduto();
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

    public function validaFormularioOperacaoEntrada($valor, $quantidade)
    {
        try
        {   
        
                if(!is_numeric($valor)) {
                     
                    $this->erros["valorInvalido"] = "O valor deve conter apenas números.";   
                }

                if(!is_numeric($quantidade)) {
                     
                    $this->erros["quantidadeInvalida"] = "A quantidade deve conter apenas números.";   
                }

                return $this->erros;

        } catch(Exception $e)

        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
}