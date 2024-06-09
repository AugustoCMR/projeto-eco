<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{
  
  public static function buscarUsuarios()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuario');
    return $result->fetchAll(PDO::FETCH_ASSOC);
   }

   public static function findById(int $id)
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
}