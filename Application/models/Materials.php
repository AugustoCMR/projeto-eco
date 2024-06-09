<?php

namespace Application\models;

use Application\core\Database;
use PDO;

class Materials
{
    public static function register_type_residue($name)
    {
        $conn = new Database();
        $resultado = $conn->executeQuery('INSERT INTO tipo_residuo(name) VALUES(:name)', array(
            'name' => $name
        ));

        return True;
    }

    public static function buscarResiduos()
    {
        $conn = new Database();
        $buscarResiduos = $conn->executeQuery('SELECT * FROM tipo_residuo');

        return $buscarResiduos->fetchAll(PDO::FETCH_ASSOC);
   
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

    public static function buscarMateriais()
    {
        $conn = new Database();
        $buscarMateriais = $conn->executeQuery('SELECT * FROM material');

        return $buscarMateriais->fetchAll(PDO::FETCH_ASSOC);
   
    }

    public static function cadastro_recebimento_material($usuario_id, $material_id, $quantidade, $eco_valor)
    {   
        
        $conn = new Database();
        $resultado = $conn->executeQuery('INSERT INTO entrega_material_usuario(usuario_id, material_id, quantidade, eco_valor) VALUES(:usuario_id, :material_id, :quantidade, :eco_valor)', array(
            'usuario_id' => $usuario_id,
            'material_id' => $material_id,
            'quantidade' => $quantidade,
            'eco_valor' => $eco_valor
        ));

        return True;
    }
}