<?php

use Application\core\Controller;
use Application\intermediarios\UsuarioIntermediario;

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

         

         if(!empty($intermediario->erros)) 
         {

            return $this->view('user/register_user', ['erros' => $intermediario->erros,
            'nome' => $nome,
            'sobrenome'=> $sobrenome,
            'email' => $email,
            'saldo' => $saldo,
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
      
      $this->view('user/consulta_materiais_entregues');
   }

   public function extrato()
   {
      $this->view('user/extrato');
   }

}