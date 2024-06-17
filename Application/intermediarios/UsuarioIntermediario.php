<?php

namespace Application\intermediarios;

use Application\core\Database;
use PDO;

require __DIR__ . '\\../utils/validaCamposTipoNumero.php';

class UsuarioIntermediario 
{

    public $erros = [];


     /**
   * Método para validar cadastro do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $errosCampos campos obrigatórios
   */
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

       /**
   * Método para validar edição do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $errosCampos campos obrigatórios
   * @param $cpfEnviado cpf enviado pelo requisitante ao atualizar cadastro
   * @param $emailEnviado email enviado pelo requisitante ao atualizar cadastro
   */

   public function validacaoEditarUsuario($errosCampos, $cpfEnviado, $emailEnviado)
   {   
       
       if(!empty($errosCampos)) 
       {
          return $this->erros = $errosCampos;
       }
       
       $this->validaEmail($emailEnviado);
       $this->validaCPF($cpfEnviado);
       $this->validaCEP();

       return $this->erros;
   }

        /**
   * Método para validar deletar usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do usuário
   */
   public function validaDeletarUsuario($id)
   {
    $conn = new Database();
    $query = $conn->executarQuery('SELECT * FROM material_entregue WHERE id_usuario = :id', array(
        ':id' => $id
    ));

    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $this->erros['registros'] = "Não é possível deletar, usuário possuí registros";
        return $this->erros;
    }
   }

     /**
   * Método para validar consultas no banco de dados
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $cpf cpf do Usuário
   */
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

     /**
   * Método para validar o CPF do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $cpfRecebido variável para receber o cpf requisitante em casos de edição
   */
    public function validaCPF($cpfRecebido = null)
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

                if($cpf === $cpfRecebido)
                {
                    return;
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

     /**
   * Método para validar o email do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $emailRecebido variável para receber o email requisitante em casos de edição
   */
    public function validaEmail($emailRecebido = null)
    {
        try
        {   
            
            if(!empty($_POST['nm_email']) && isset($_POST['nm_email']))
            {   
                $email = $_POST['nm_email'];

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                $this->erros['emailInvalido'] = "O e-mail informado é inválido.";
                }

                if($email === $emailRecebido)
                {
                    return;
                }

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
        } catch(Exception $e)
        {   
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

     /**
   * Método para validar o CEP do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
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