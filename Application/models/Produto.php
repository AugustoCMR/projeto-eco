<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Produto
{
    public static function cadastrar_produto($nome, $eco_valor)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto(nome, eco_valor) VALUES (:nome, :Eco_valor)', array(
            ':nome' => $nome,
            ':eco_valor' => $eco_valor
        ));

        return True;
    }
}