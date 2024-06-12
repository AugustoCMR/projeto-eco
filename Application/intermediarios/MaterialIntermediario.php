<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

class MaterialIntermediario
{
    public $erros = [];

    public function validadorResiduo($erroCampo, $nome)
    {
        if(!empty($erroCampo))
        {
            return $this->erros = $erroCampo;
        }

        $this->validaNomeResiduo($nome);

        return $this->erros;
    }

    public function validadorMaterial($erroCampo = null, $nome = null, $eco = null)
    {

        if(!empty($erroCampo))
        {
            return $this->erros = $erroCampo;
        }
        
        $this->validaFormularioMaterial($nome, $eco);

        return $this->erros;
    }

    public function validaNomeResiduo($nome)
    {
        try 
        {

                $conn = new Database();
                $buscaNome = $conn->executeQuery('SELECT * FROM tipo_residuo WHERE name = :nome', array(
                    ':nome' => $nome
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado))
                {
                    return $this->erros['nome'] = 'O Resíduo informado já existe.';
                }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    public function validaFormularioMaterial($nome, $eco)
    {
        try 
        {

                $conn = new Database();
                $buscaNome = $conn->executeQuery('SELECT * FROM material WHERE name = :nome', array(
                    ':nome' => $nome
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado))
                {
                    $this->erros['nome'] = 'O material informado já existe.';
                }

                if(!is_numeric($eco))
                {
                    $this->erros['eco_valor'] = 'O valor informado deve ser númerico.';
                }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    
}