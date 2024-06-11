<?php

namespace Application\models;

use Application\core\Database;
use Application\models\Eco;
use PDO;
class Users
{
  
  public static function buscarUsuarios()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuario');
    return $result->fetchAll(PDO::FETCH_ASSOC);
   }

   public static function buscarUsuario(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM users WHERE id = :ID LIMIT 1', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  } 

  public static function register(string $nome, string $sobrenome, string $email, $saldo, int $cpf, int $cep, string $rua, string $bairro, int $numero)
  {
    $conn = new Database();
    $result = $conn->executeQuery('INSERT INTO usuario(nome, sobrenome, email, eco_saldo, cpf, cep, rua, bairro, numero) VALUES (:nome, :sobrenome, :email, :eco_saldo, :cpf, :cep, :rua, :bairro, :numero)', array(
      'nome' => $nome,
      'sobrenome' => $sobrenome,
      'email' => $email,
      'eco_saldo' => $saldo,
      'cpf' => $cpf,
      'cep' => $cep,
      'rua' => $rua,
      'bairro' => $bairro,
      'numero' => $numero
    ));

    return True;
  }

  public static function consultarSaldo($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT eco_saldo FROM usuario WHERE ID = :ID', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function operacaoEntradaSaldo($id, $valor_real)
  {
    $conn = new Database();
    $consultaSaldo = self::consultarSaldo($id);
    $saldoAtual = $consultaSaldo[0]['eco_saldo'];
    $saldoFinal = (float)$saldoAtual + ((float)Eco::$eco * (float)$valor_real);

    $result = $conn->executeQuery('UPDATE usuario SET eco_saldo = :eco WHERE id = :ID ', array(
      ':eco' => $saldoFinal,
      ':ID' => $id 
    ));
  }

  public static function operacaoSaidaSaldo($id, $eco)
  {
    $conn = new Database();
    $consultaSaldo = self::consultarSaldo($id);
    $saldoAtual = $consultaSaldo[0]['eco_saldo'];
    $saldoFinal = (float)$saldoAtual - (float)$eco;

    $result = $conn->executeQuery('UPDATE usuario SET eco_saldo = :eco WHERE id = :ID ', array(
      ':eco' => $saldoFinal,
      ':ID' => $id 
    ));
  }
}