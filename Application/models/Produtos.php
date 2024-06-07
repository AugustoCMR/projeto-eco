<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Produto
{
    public static function cadastrar_produto($nome, $eco_valor)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto(nome, eco_valor) VALUES (:nome, :eco_valor)', array(
            ':nome' => $nome,
            ':eco_valor' => $eco_valor
        ));

        return True;
    }

    public static function cadastrar_operacao_entrada_produto($quantidade, $real_valor, $produto_id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto_entrada(quantidade, real_valor, produto_id) VALUES(:quantidade, :real_valor, :produto_id)', array(
            ':quantidade' => $quantidade,
            ':real_valor' => $real_valor,
            ':produto_id' => $produto_id
        ));

        return True;
    }

    public static function cadastrar_operacao_saida_produto($quantidade, $usuario_id, $produto_id, $eco_valor) {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto_saida(quantidade, usuario_id, produto_id, eco_valor) VALUES (:quantidade, :usuario_id, :produto_id, :eco_valor)', array(
            ':quantidade' => $quantidade,
            ':usuario_id' => $usuario_id,
            ':produto_id' => $produto_id,
            ':eco_valor' => $eco_valor
        ));

        return True;
        
    }
}