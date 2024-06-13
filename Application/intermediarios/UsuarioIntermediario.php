<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

require __DIR__ . '\\../utils/validaCamposTipoNumero.php';

class UsuarioIntermediario 
{

    public $erros = [];

    public function validacaoUsuario($errosCampos)
    {   
        
        if(!empty($errosCampos)) 
        {
           return $this->erros = $errosCampos;
        }
        
        $this->validaEmail();
        $this->validaCPF();
        $this->validaCEP();

        return $this->erros;
    }

    public function validaConsulta($cpf)
    {

        if(empty($cpf)) {
            $this->erros["cpfObrigatorio"] = "O campo CPF é obrigatório.";
            return $this->erros;
        }

        if(!is_numeric($cpf))
        {
            $this->erros["cpfIncorreto"] = "O CPF deve conter apenas números.";
            return $this->erros;       
        }

        $conn = new Database();
        $buscaCPF = $conn->executarQuery('SELECT * FROM usuario WHERE nu_cpf = :CPF', array(
            ':CPF' => $cpf
        ));

        $resultado = $buscaCPF->fetchAll(PDO::FETCH_ASSOC);

        if(empty($resultado)) {
            $this->erros['cpfInvalido'] = "CPF informado não encontrado.";
        }

        return $this->erros;
    }

    public function validaCPF()
    {
        try
        {   
            if(!empty($_POST['nu_cpf']) && isset($_POST['nu_cpf']))
            {   
                $cpf = $_POST['nu_cpf'];

                if(!is_numeric($_POST["nu_cpf"])) {
                     
                    return $this->erros["cpfInvalido"] = "O CPF deve conter apenas números.";   
                }

                if(strlen($cpf) !== 11)
                {
                    return $this->erros["cpfTamanhoInvalido"] = "O CPF deve conter 11 caracteres."; 
                }

                $conn = new Database();
                $buscaCPF = $conn->executarQuery('SELECT * FROM usuario WHERE nu_cpf = :CPF', array(
                ':CPF' => $cpf
                ));

                $resultado = $buscaCPF->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)) 
                {
                    
                    $this->erros['cpf'] = "O CPF informado já existe.";
                }
            } 

            
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    public function validaEmail()
    {
        try
        {   
            if(!empty($_POST['nm_email']) && isset($_POST['nm_email']))
            {   
                $email = $_POST['nm_email'];
                $conn = new Database();
                $buscaEmail = $conn->executarQuery('SELECT * FROM usuario WHERE nm_email = :email', array(
                ':email' => $email
                ));

                $resultado = $buscaEmail->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)) 
                {
                    
                   return $this->erros['email'] = "O e-mail informado já existe.";
                }
            }
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $this->erros['emailInvalido'] = "O e-mail informado é inválido.";
            }

            
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    public function validaCEP()
    {
        try
        {   
           if(!empty($_POST['nu_cep']) && isset($_POST['nu_cep']))
           {
                if(!is_numeric($_POST["nu_cep"])) {
                    $this->erros["cep"] = "O CEP deve conter apenas números.";
                }
           }
                
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
}