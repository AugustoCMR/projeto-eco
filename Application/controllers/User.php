<?php

use Application\core\Controller;

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
      $this->view('user/register_user');
   }

   public function register_user_success()
   {
    
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
    $this->view('user/register_user_success');
   }

}