<?php

namespace Application\models;

use Application\core\Database;
use PDO;

class Materials
{
    public static function register_type_residue($name)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO tipo_residuo(name) VALUES(:name)', array(
            'name' => $name
        ));

        return true;
    }
}