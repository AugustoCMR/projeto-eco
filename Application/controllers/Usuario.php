<?php

use Application\core\Controller;
use Application\intermediarios\UsuarioIntermediario;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';


class Usuario extends Controller
{
  
//   public function index()
//   {
//     $Users = $this->model('Users'); 
//     $data = $Users::findAll();
//     $this->view('User/index', ['usuario' => $data]);
//   }

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
            'nome' => $nome,
            'email' => $email,
            'cpf' => $cpf,
            'pais' => $pais,
            'estado' => $estado,
            'cidade' => $cidade,
            'cep' => $cep,
            'rua' => $rua,
            'bairro' => $bairro,
            'numero' => $numero     
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
              return $this->view('home/index');
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
         $dados = $usuarioModel::consultarMateriaisEntregues($cpf);

         return $this->view('usuario/consultarMateriaisEntregues', ['query' => $dados,
            'cpf' => $cpf 
         ]);

      }

      return  $this->view('usuario/consultarMateriaisEntregues');
   }

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
         $dados = $usuarioModel::extrato($cpf);

         return $this->view('usuario/extrato', [
            'dados' => $dados,
            'cpf' => $cpf
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