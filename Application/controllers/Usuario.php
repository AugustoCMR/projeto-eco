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