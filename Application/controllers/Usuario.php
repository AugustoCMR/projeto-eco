<?php

use Application\core\Controller;
use Application\intermediarios\UsuarioIntermediario;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';


class Usuario extends Controller
{

   /**
   * Método para cadastrar Usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
   public function cadastrar()  
   {
   
      if(isset($_POST['cadastrarUsuario'])) {
         $intermediario = new UsuarioIntermediario;
         
         $nome = strtolower($_POST['nm_usuario']);
         $email = strtolower($_POST['nm_email']);
         $cpf = $_POST['nu_cpf'];
         $saldo = 0;
         $pais = strtolower($_POST['nm_pais']);
         $estado = strtolower($_POST['nm_estado']);
         $cidade = strtolower($_POST['nm_cidade']);
         $cep = $_POST['nu_cep'];
         $rua = strtolower($_POST['nm_rua']);
         $bairro = strtolower($_POST['nm_bairro']);
         $numero = strtolower($_POST['nm_numero']);

         $validaCampos = validarCamposObrigatorios([
            'Nome' => $nome,
            'Email' => $email,
            'CPF' => $cpf,
            'País' => $pais,
            'Estado' => $estado,
            'Cidade' => $cidade,
            'CEP' => $cep,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Número' => $numero 
         ]);

         $erros = $intermediario->validacaoUsuario($validaCampos); 

         if(!empty($erros)) 
         {

            return $this->view('usuario/cadastrar', ['erros' => $erros,
            'nm_usuario' => $nome,
            'nm_email' => $email,
            'nu_cpf' => $cpf,
            'nm_pais' => $pais,
            'nm_estado' => $estado,
            'nm_cidade' => $cidade,
            'nu_cep' => $cep,
            'nm_rua' => $rua,
            'nm_bairro' => $bairro,
            'nm_numero' => $numero     
            ]);
         }

         $Usuarios = $this->model('Usuarios');
         $Usuarios::cadastrar($nome, $email, $saldo, (int)$cpf, $pais, $estado, $cidade,(int)$cep, $rua, $bairro, $numero);
         return $this->view('usuario/cadastroSucesso');
      
      } else 
      {

         return $this->view('usuario/cadastrar');
      }   
   }

    /**
   * Método para editar usuário cadastrado.
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function editar($id = null)
  {   
  
    try 
    {
        $usuarioModel = $this->model("Usuarios");
        $usuario = $usuarioModel::buscarUsuario($id); 
        
        if(isset($_POST['editarUsuario'])) {
           
            $intermediario = new UsuarioIntermediario;
            $id = $_POST['editarUsuario'];
            $usuario = $usuarioModel::buscarUsuario($id); 
           
            $nome = strtolower($_POST['nm_usuario']);
            $email = strtolower($_POST['nm_email']);
            $cpf = $_POST['nu_cpf'];
            $pais = strtolower($_POST['nm_pais']);
            $estado = strtolower($_POST['nm_estado']);
            $cidade = strtolower($_POST['nm_cidade']);
            $cep = $_POST['nu_cep'];
            $rua = strtolower($_POST['nm_rua']);
            $bairro = strtolower($_POST['nm_bairro']);
            $numero = strtolower($_POST['nm_numero']);
            
            $validaCampos = validarCamposObrigatorios([
               'Nome' => $nome,
               'Email' => $email,   
               'CPF' => $cpf,
               'País' => $pais,
               'Estado' => $estado,
               'Cidade' => $cidade,
               'CEP' => $cep,
               'Rua' => $rua,
               'Bairro' => $bairro,
               'Número' => $numero 
            ]);
    
            $erros = $intermediario->validacaoEditarUsuario($validaCampos, $cpf, $email); 
    
            if(!empty($erros)) 
            {
    
               return $this->view('usuario/editar', ['erros' => $erros,
                'usuario' => $usuario     
               ]);
            }
          
            $usuarioModel::editar($id, $nome, $email, (int)$cpf, $pais, $estado, $cidade,(int)$cep, $rua, $bairro, $numero);
            return $this->view('usuario/editadoSucesso');
         
         } else 
         {
    
            return $this->view('usuario/editar', [
                'usuario' => $usuario
            ]);
         } 
    } catch (Exception $e) 
    {
        echo("Algo deu errado, por favor, tente novamente.");
        echo $e;
    }

    
  }

   /**
   * Método para deletar usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do usuário
   */
  public function deletar($id)
  {
    $intermediario = new UsuarioIntermediario;

    $usuarioModel = $this->model('Usuarios');
    $dados = $usuarioModel::buscarUsuarios();
    $erros = $intermediario->validaDeletarUsuario($id); 
 
    

    if(!empty($erros))
    {
        return $this->view('usuario/consultarUsuarios', [
            'usuarios' => $dados,
            'erros' => $erros
        ]);
    }

    $usuarioModel::deletar($id);
    $dadosAtualizados = $usuarioModel::buscarUsuarios();
      
    return $this->view('usuario/consultarUsuarios', [
        'usuarios' => $dadosAtualizados
    ]);
  }

    /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function cadastroSucesso()
  {
      try 
      {
          if(!empty($_POST['menu']) && isset($_POST['menu']))
          {
              return $this->view('home/index');

          } else if(!empty($_POST['listar']) && isset($_POST['listar']))
          {
            $usuarios = $this->model('Usuarios');
            $dados = $usuarios::buscarUsuarios();
      
            return $this->view('usuario/consultarUsuarios', [
                'usuarios' => $dados
            ]);
          } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
          {
              return $this->view('usuario/cadastrar');
          } else {
              return $this->view('usuario/cadastroSucesso');
          }

      } catch (Exception $e) 
      {
          echo("Algo deu errado, por favor, tente novamente.");
          echo $e;
      }    
  }

  /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function editadoSucesso()
  {
      try 
      {
          if(!empty($_POST['menu']) && isset($_POST['menu']))
          {
              return $this->view('home/index');

          } else if(!empty($_POST['listar']) && isset($_POST['listar']))
          {
            $produtos = $this->model('Usuarios');
            $dados = $produtos::buscarUsuarios();
      
            return $this->view('usuario/consultarUsuarios', [
                'usuarios' => $dados
            ]);
          } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
          {
              return $this->view('usuario/cadastrar');
          } else {
              return $this->view('usuario/cadastroSucesso');
          }

      } catch (Exception $e) 
      {
          echo("Algo deu errado, por favor, tente novamente.");
          echo $e;
      }    
  }

    /**
   * Método para consultar os materiais entregues por um usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
   public function consultarMateriaisEntregues()
   {
      
      if(isset($_POST['consultarMateriaisEntregues']))
      {  
         
         $intermediario = new UsuarioIntermediario;
         $cpf = $_POST['cpf'];

         $validador = $intermediario->validaConsulta($cpf); // ver

         if(!empty($validador)) 
         {
            return $this->view('usuario/consultarMateriaisEntregues', [
               'cpf' => $cpf,
               'erros' => $validador   
            ]);
         }

         $usuarioModel = $this->model('Usuarios');
         $usuario = $usuarioModel::buscarUsuarioCPF($cpf);
         $dados = $usuarioModel::consultarMateriaisEntregues($cpf);

         return $this->view('usuario/consultarMateriaisEntregues', ['query' => $dados,
            'cpf' => $cpf,
            'usuario' => $usuario    
         ]);

      }

      return  $this->view('usuario/consultarMateriaisEntregues');
   }

    /**
   * Método para consultar o extrato
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
   public function extrato()
   {

      if(isset($_POST['consultarExtrato']))
      {  

         $intermediario = new UsuarioIntermediario;
         $cpf = $_POST['cpf'];

         $validador = $intermediario->validaConsulta($cpf);

         if(!empty($validador)) 
         {
            return $this->view('usuario/extrato', [
               'cpf' => $cpf,   
               'erros' => $validador   
            ]);
         }

         $usuarioModel = $this->model('Usuarios');
         $usuario = $usuarioModel::buscarUsuarioCPF($cpf);
         $dados = $usuarioModel::extrato($cpf);

         return $this->view('usuario/extrato', [
            'dados' => $dados,
            'cpf' => $cpf,
            'usuario' => $usuario
         ]);
      }

     

      $this->view('usuario/extrato');
   }

     /**
   * Método para consultar usuários
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function consultarUsuarios()
  {   
      $produtos = $this->model('Usuarios');
      $dados = $produtos::buscarUsuarios();

      return $this->view('usuario/consultarUsuarios', [
          'usuarios' => $dados
      ]);
  }


}