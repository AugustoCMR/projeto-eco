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

        return True;
    }

    public static function register_material($nome, $unidade_medida, $eco_valor, $tipo_residuo_id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO material(name, unidade_medida, eco_valor, tipo_residuo_id) VALUES(:nome, :unidade_medida, :eco_valor, :tipo_residuo_id)', array(
            'nome' => $nome,
            'unidade_medida' => $unidade_medida,
            'eco_valor' => $eco_valor,
            'tipo_residuo_id' => $tipo_residuo_id
        ));

        return True;
    }

    public static function register_receipt_material()
    {

    }
}