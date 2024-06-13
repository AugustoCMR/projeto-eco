<?php

use Application\core\Controller;
use Application\intermediarios\UsuarioIntermediario;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';


class User extends Controller
{
  
//   public function index()
//   {
//     $Users = $this->model('Users'); 
//     $data = $Users::findAll();
//     $this->view('User/index', ['usuario' => $data]);
//   }

   public function register_user()
   {
   
      if(isset($_POST['cadastro_usuario'])) {
         $intermediario = new UsuarioIntermediario;
         
         $nome = strtolower($_POST['nome']);
         $sobrenome = strtolower($_POST['sobrenome']);
         $email = strtolower($_POST['email']);
         $saldo = 0;
         $cpf = $_POST['cpf'];
         $cep = $_POST['cep'];
         $rua = strtolower($_POST['rua']);
         $bairro = strtolower($_POST['Bairro']);
         $numero = strtolower($_POST['numero']);

         $validaCampos = validarCamposObrigatorios([
            'Nome' => $nome,
            'Sobrenome'=> $sobrenome,
            'Email' => $email,
            'CPF' => $cpf,
            'CEP' => $cep,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Número' => $numero 
         ]);

         $erros = $intermediario->validacaoUsuario($validaCampos); 

         if(!empty($erros)) 
         {

            return $this->view('user/register_user', ['erros' => $erros,
            'nome' => $nome,
            'sobrenome'=> $sobrenome,
            'email' => $email,
            'cpf' => $cpf,
            'cep' => $cep,
            'rua' => $rua,
            'bairro' => $bairro,
            'numero' => $numero     
            ]);
         }

         $Users = $this->model('Users');
         $data = $Users::register($nome, $sobrenome, $email, $saldo, (int)$cpf, (int)$cep, $rua, $bairro, $numero);
         return $this->view('user/register_user_success');
      
      } else 
      {

         return $this->view('user/register_user');
      }   
   }

   public function register_user_success()
   {
    
    $intermediario = new UsuarioIntermediario();

      $nome = $_POST['nome'];
      $sobrenome = $_POST['sobrenome'];
      $email = $_POST['email'];
      $saldo = 0;
      $cpf = $_POST['cpf'];
      $cep = $_POST['cep'];
      $rua = $_POST['rua'];
      $bairro = $_POST['Bairro'];
      $numero = $_POST['numero'];


      $Users = $this->model('Users');
      $data = $Users::register($nome, $sobrenome, $email, $saldo, (int)$cpf, (int)$cep, $rua, $bairro, $numero);
      $this->view('user/register_user_success', ['erros' => $intermediario->erros]);
   }

   public function consultar_materiais_entregues()
   {
      

      if(isset($_POST['submit_consultar']))
      {  
         
         $intermediario = new UsuarioIntermediario;
         $cpf = $_POST['cpf'];

         $validador = $intermediario->validaConsulta($cpf);

         if(!empty($validador)) 
         {
            return $this->view('user/consulta_materiais_entregues', [
               'cpf' => $cpf,
               'erros' => $validador   
            ]);
         }

         $usuarioModel = $this->model('Users');
         $dados = $usuarioModel::consultarMateriaisEntregues($cpf);

         return $this->view('user/consulta_materiais_entregues', ['query' => $dados,
            'cpf' => $cpf 
         ]);

      }

      return  $this->view('user/consulta_materiais_entregues');
   }

   public function extrato()
   {

      if(isset($_POST['submit_consultar']))
      {  

         $intermediario = new UsuarioIntermediario;
         $cpf = $_POST['cpf'];

         $validador = $intermediario->validaConsulta($cpf);

         if(!empty($validador)) 
         {
            return $this->view('user/extrato', [
               'cpf' => $cpf,
               'erros' => $validador   
            ]);
         }

         $usuarioModel = $this->model('Users');
         $dados = $usuarioModel::extrato($cpf);

         return $this->view('user/extrato', [
            'dados' => $dados,
            'cpf' => $cpf
         ]);
      }

     

      $this->view('user/extrato');
   }

}