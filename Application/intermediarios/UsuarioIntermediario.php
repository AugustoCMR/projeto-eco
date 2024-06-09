<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

class UsuarioIntermediario 
{

    public $erros = [];

    public function __construct()
    {
        $this->validaCPF();
        $this->validaEmail();
        $this->validaCEP();
    }

    public function validaCPF()
    {
        try
        {   
            if(!empty($_POST['cpf']) && isset($_POST['cpf']))
            {   
                $cpf = $_POST['cpf'];

                if(!is_numeric($_POST["cpf"])) {
                     
                    return $this->erros["cpfInvalido"] = "O CPF deve conter apenas números.";   
                }

                if(strlen($cpf) !== 11)
                {
                    return $this->erros["cpfTamanhoInvalido"] = "O CPF deve conter apenas 11 caracteres."; 
                }

                $conn = new Database();
                $buscaCPF = $conn->executeQuery('SELECT * FROM usuario WHERE cpf = :CPF', array(
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
            if(!empty($_POST['email']) && isset($_POST['email']))
            {   
                $email = $_POST['email'];
                $conn = new Database();
                $buscaEmail = $conn->executeQuery('SELECT * FROM usuario WHERE email = :email', array(
                ':email' => $email
                ));

                $resultado = $buscaEmail->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)) 
                {
                    
                    $this->erros['email'] = "O e-mail informado já existe.";
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
           if(!empty($_POST['cep']) && isset($_POST['cep']))
           {
                if(!is_numeric($_POST["cep"])) {
                    $this->erros["cep"] = "O CEP deve conter apenas números.";
                }
           }
                
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
}