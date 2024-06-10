<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

class MaterialIntermediario
{
    public $erros = [];

    public function validadorResiduo()
    {
        $this->validaNomeResiduo();

        return $this->erros;
    }

    public function validadorMaterial()
    {
        $this->validaFormularioMaterial();

        return $this->erros;
    }

    public function validaNomeResiduo()
    {
        try 
        {
            
            if(!empty($_POST['nome']) && isset($_POST['nome']))
            {
                $nome = $_POST['nome'];

                $conn = new Database();
                $buscaNome = $conn->executeQuery('SELECT * FROM tipo_residuo WHERE name = :nome', array(
                    ':nome' => $nome
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado))
                {
                    $this->erros['nome'] = 'O resíduo informado já existe.';
                }
            }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    public function validaFormularioMaterial()
    {
        try 
        {
            
            if(!empty($_POST['nome']) && isset($_POST['nome']))
            {
                $nome = $_POST['nome'];
                $eco = $_POST['eco_valor'];

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
            }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    
}