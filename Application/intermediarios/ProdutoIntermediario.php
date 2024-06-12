<?php

namespace Application\intermediarios;

use Application\core\Database;
use Application\models\Eco;
use PDO;

require __DIR__ . '\\../utils/validaCamposTipoNumero.php';

class ProdutoIntermediario 
{

    public $erros = [];

    public function validaFormularioCadastrarProduto($errosCampo, $eco, $nome)
    {
     
        if(!empty($errosCampo))
        {   
         
            return $this->erros = $errosCampo;   
        }

       $this->validaEcoPoint($eco);
       $this->validaNomeProduto($nome);

       return $this->erros;
    }

    public function validaOperacaoEntrada($errosCampo, $quantidade, $valor_unitario, $valor_total)
    {   

        if($valor_total !== "")
        {
            $valorFormatado = explode(" ", $_POST['real_valor'])[1];
        }
        

        if(!empty($errosCampo))
        {
            return $this->erros = $errosCampo;
        }

        $camposTipoNumero = validarTipoNumero([
            'Quantidade' => $quantidade,
            'Valor Unitário' => $valor_unitario,
            'Valor total' => $valorFormatado
        ]);

        if(!empty($camposTipoNumero)) {
           $this->erros = $camposTipoNumero;
        }

        return $this->erros;

    }

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

    public function validaNomeProduto($produto)
    {
        try
        {   
            
                $conn = new Database();
                $buscaProduto = $conn->executeQuery('SELECT * FROM produto WHERE nome = :nome', array(
                ':nome' => $produto
                ));

                $resultado = $buscaProduto->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)) {
                     
                    return $this->erros["produto"] = "O produto informado já existe.";   
                }
              
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

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