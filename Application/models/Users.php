<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{
  
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuario');
    return $result->fetchAll(PDO::FETCH_ASSOC);
   }
}