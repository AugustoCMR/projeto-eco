<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Produtos
{   
       /**
   * Método para cadastrar produto no banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $produto nome do produto para cadastrar
   * @param $eco valor do produto em eco
   */
    public static function cadastrarProduto($produto, $eco)
    {
        $conn = new Database();
        $conn->executarQuery('INSERT INTO produto(nm_produto, vl_eco, qt_produto) VALUES (:produto, :eco_valor, :quantidade)', array(
            ':produto' => $produto,
            ':eco_valor' => $eco,
            ':quantidade' => 0
        ));
    }

       /**
   * Método para cadastrar a operação de entrada do produto no banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $quantidade quantidade do produto
   * @param $real_valor valor do produto em real
   * @param $idProduto id do produto
   */
    public static function cadastrarProdutoEntregue($quantidade, $real_valor, $idProduto)
    {
        $conn = new Database();
        $conn->executarQuery('INSERT INTO produto_entregue(qt_produtoentregue, vl_real, id_produto) VALUES(:quantidade, :real_valor, :idProduto)', array(
            ':quantidade' => $quantidade,
            ':real_valor' => $real_valor,
            ':idProduto' => $idProduto
        ));

    }

       /**
   * Método para cadastrar a operação de saida do produto no banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $quantidade quantidade do produto
   * @param $idUsuario id do usuário
   * @param $idProduto id do produto
   * @param $vl_eco valor em eco da transação
   * @param $saldoAtual saldo atual do usuário após a transação
   */
    public static function cadastrarProdutoSaida($quantidade, $idUsuario, $idProduto, $vl_eco, $saldoAtual) 
    {
        $conn = new Database();
        $conn->executarQuery('INSERT INTO produto_retirado(qt_produtoretirado, id_usuario, id_produto, vl_eco, vl_saldoatual) VALUES (:quantidade, :idUsuario, :idProduto, :eco_valor, :saldo)', array(
            ':quantidade' => $quantidade,
            ':idUsuario' => $idUsuario,
            ':idProduto' => $idProduto,
            ':eco_valor' => $vl_eco,
            ':saldo' => $saldoAtual
        ));    
    }

        /**
   * Método para consultar os produtos cadastrados no banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public static function consultarProdutos()
    {
        $conn = new Database();
        $resultado = $conn->executarQuery('SELECT * FROM produto');

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
   * Método para consultar produtos pelo id
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do produto
   */
    public static function consultarProduto($id)
    {
        $conn = new Database();
        $result = $conn->executarQuery('SELECT * FROM produto WHERE id_produto = :ID', array(
            ':ID' => $id
        ));

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

          /**
   * Método para consultar produtos pelo nome
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome nome do produto
   */
    public static function consultarProdutoNome($nome)
    {
        $conn = new Database();
        $result = $conn->executarQuery('SELECT * FROM produto WHERE nm_produto ILIKE :nome', array(
            ':nome' => '%' . $nome . '%'
        ));

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
   * Método para aumentar a quantidade de produtos no estoque 
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $quantidade quantidade do produto
   * @param $id id do produto 
   */
    public static function operacaoEntradaProduto($id, $quantidade)
    {
        $conn = new Database();

        $produto = self::consultarProduto($id);
        $quantidadeAtual = $produto[0]['qt_produto']; 
        $quantidadeFinal = $quantidadeAtual + $quantidade;
        
        $result = $conn->executarQuery('UPDATE produto SET qt_produto = :quantidade WHERE id_produto = :ID ', array(
        ':quantidade' => $quantidadeFinal,
        ':ID' => $id 
        ));
    }

          /**
   * Método para diminuir a quantidade de produtos no banco de dados 
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $quantidade quantidade do produto
   * @param $id id do produto 
   */
    public static function operacaoSaidaProduto($id, $quantidade)
    {
        $conn = new Database();

        $produto = self::consultarProduto($id);
        $quantidadeAtual = $produto[0]['qt_produto']; 
        $quantidadeFinal = $quantidadeAtual - $quantidade;

        $result = $conn->executarQuery('UPDATE produto SET qt_produto = :quantidade WHERE id_produto = :ID ', array(
            ':quantidade' => $quantidadeFinal,
            ':ID' => $id 
        ));
        
    }

    /**
   * Método para atualizar produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $produto nome do produto
   * @param $ecoValor valor do produto
   * @param $quantidade quantidade do produto
   * @param $id id do produto
   */
  public static function editar($produto, $ecoValor, $quantidade, $id)
  {
      $conn = new Database();   
      $conn->executarQuery('UPDATE produto SET nm_produto = :nome, vl_eco = :eco, qt_produto = :quantidade WHERE id_produto = :id', array(
        ':nome' => $produto,
        ':eco' => $ecoValor,
        ':quantidade' => $quantidade,
        ':id' => $id
      ));
  }

  /**
   * Método para deletar produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do produto
   */
  public static function deletar($id)
  {
      $conn = new Database();   
      $conn->executarQuery('DELETE FROM produto WHERE id_produto = :id', array(
        ':id' => $id
      ));
  }
}