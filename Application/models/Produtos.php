<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Produtos
{
    public static function cadastrar_produto($nome, $eco_valor)
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto(nome, eco_valor, quantidade) VALUES (:nome, :eco_valor, :quantidade)', array(
            ':nome' => $nome,
            ':eco_valor' => $eco_valor,
            ':quantidade' => 0
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

    public static function cadastrar_operacao_saida_produto($quantidade, $usuario_id, $produto_id, $eco_valor) 
    {
        $conn = new Database();
        $result = $conn->executeQuery('INSERT INTO produto_saida(quantidade, usuario_id, produto_id, eco_valor) VALUES (:quantidade, :usuario_id, :produto_id, :eco_valor)', array(
            ':quantidade' => $quantidade,
            ':usuario_id' => $usuario_id,
            ':produto_id' => $produto_id,
            ':eco_valor' => $eco_valor
        ));

        return True;
        
    }

    public static function consultar_produtos()
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM produto');

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function consultar_produtos_id($id)
    {
        $conn = new Database();
        $result = $conn->executeQuery('SELECT * FROM produto WHERE id = :ID', array(
            ':ID' => $id
        ));

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function operacaoEntradaProduto($id, $quantidade)
    {
        $conn = new Database();

        $produto = self::consultar_produtos_id($id);
        $quantidadeAtual = $produto[0]['quantidade']; 
        $quantidadeFinal = $quantidadeAtual + $quantidade;
        

        $result = $conn->executeQuery('UPDATE produto SET quantidade = :quantidade WHERE id = :ID ', array(
        ':quantidade' => $quantidadeFinal,
        ':ID' => $id 
        ));
    }

    public static function operacaoSaidaProduto($id, $quantidade)
    {
        $conn = new Database();

        $produto = self::consultar_produtos_id($id);
        $quantidadeAtual = $produto[0]['quantidade']; 
        $quantidadeFinal = $quantidadeAtual - $quantidade;

        $result = $conn->executeQuery('UPDATE produto SET quantidade = :quantidade WHERE id = :ID ', array(
            ':quantidade' => $quantidadeFinal,
            ':ID' => $id 
        ));
        
    }

}