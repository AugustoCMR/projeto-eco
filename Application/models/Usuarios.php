<?php

namespace Application\models;

use Application\core\Database;
use Application\models\Eco;
use PDO;
class Usuarios
{ 
  /**
   * Método para buscar todos os usuários no banco.
   * @author: Augusto Ribeiro
   * @created: 13/06/2024
   */
  public static function buscarUsuarios()
  {
    $conn = new Database();
    $resultado = $conn->executarQuery('SELECT * FROM usuario');
    return $resultado->fetchAll(PDO::FETCH_ASSOC);
  }

     /**
   * Método para buscar apenas um usuário no banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do usuário
   */
   public static function buscarUsuario($id)
  {
    $conn = new Database();
    $result = $conn->executarQuery('SELECT * FROM usuario WHERE id_usuario = :ID LIMIT 1', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  } 

    /**
   * Método para cadastrar usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome nome do usuário
   * @param $email email do usuário
   * @param $saldo saldo do usuário em eco
   * @param $cpf cpf do usuário
   * @param $país país do usuário
   * @param $estado estado do usuário
   * @param $cidade cidade do usuário
   * @param $cep cep do usuário
   * @param $rua rua do usuário
   * @param $bairro bairro do usuário
   * @param $numero número da casa do usuário
   */
  public static function cadastrar($nome, $email, $saldo, $cpf, $pais, $estado, $cidade, $cep, $rua, $bairro, $numero)
  {
    $conn = new Database();
    $conn->executarQuery('INSERT INTO usuario(nm_usuario, nm_email, vl_ecosaldo, nu_cpf, nm_pais, nm_estado, nm_cidade, nu_cep, nm_rua, nm_bairro, nm_numero) VALUES (:nome, :email, :eco_saldo, :cpf, :pais, :estado, :cidade, :cep, :rua, :bairro, :numero)', array(
      ':nome' => $nome,
      ':email' => $email,
      ':eco_saldo' => $saldo,
      ':cpf' => $cpf,
      ':pais' => $pais,
      ':estado' => $estado,
      ':cidade' => $cidade, 
      ':cep' => $cep,
      ':rua' => $rua,
      ':bairro' => $bairro,
      ':numero' => $numero
    ));
  }

    /**
   * Método para consultar saldo do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do usuário
   */
  public static function consultarSaldo($id)
  {
    $conn = new Database();
    $result = $conn->executarQuery('SELECT vl_ecosaldo FROM usuario WHERE id_usuario = :ID', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

    /**
   * Método para aumentar o saldo do usuário após entregar o material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do usuário
   * @param $valor_real valor para acrescenter no saldo do usuário
   */
  public static function operacaoEntradaSaldo($id, $valor_eco)
  {
    $conn = new Database();
    $consultaSaldo = self::consultarSaldo($id);
    $saldoAtual = $consultaSaldo[0]['vl_ecosaldo'];
    $saldoFinal = (float)$saldoAtual + (float)$valor_eco;

    $conn->executarQuery('UPDATE usuario SET vl_ecosaldo = :eco WHERE id_usuario = :ID ', array(
      ':eco' => $saldoFinal,
      ':ID' => $id 
    )); 
  }

    /**
   * Método para diminuir o saldo do usuário após comprar um produto
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do usuário
   * @param $eco Valor para diminuir o saldo do usuário
   */
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

    /**
   * Método para consultar os materiais entregues pelo usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $cpf CPF do usuário para consulta
   */
  public static function consultarMateriaisEntregues($cpf)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT us.nome, mt.name, emu.quantidade, emu.eco_valor FROM usuario AS us INNER JOIN entrega_material_usuario AS emu ON us.id = emu.usuario_id INNER JOIN material AS mt
    ON mt.id = emu.material_id WHERE us.cpf = :cpf', array(
      ':cpf' => $cpf
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

    /**
   * Método para mostrar entradas, saidas e saldo do usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $cpf CPF do usuário para consulta
   */
  public static function extrato($cpf)
  {
    $conn = new Database();
    $result = $conn->executeQuery
    ('SELECT 
          us.eco_saldo, 
          mt.name AS nome_material, 
          NULL AS nome_produto, 
          emu.saldo_atual AS saldo_atual_entrada, 
          NULL AS saldo_atual_saida, 
          emu.eco_valor AS entrada, 
          NULL AS saida,
          emu.created_at
          FROM 
          usuario AS us
          INNER JOIN 
          entrega_material_usuario AS emu ON us.id = emu.usuario_id
          INNER JOIN 
          material AS mt ON mt.id = emu.material_id
            WHERE 
          us.cpf = :cpf

          UNION ALL

          SELECT 
          us.eco_saldo, 
          NULL AS nome_material, 
          pd.nome AS nome_produto, 
          NULL AS saldo_atual_entrada, 
          pds.saldo_atual AS saldo_atual_saida, 
          NULL AS entrada, 
          pds.eco_valor AS saida,
          pds.created_at
          FROM 
          usuario AS us
          INNER JOIN 
          produto_saida AS pds ON us.id = pds.usuario_id
          INNER JOIN 
          produto AS pd ON pd.id = pds.produto_id
          WHERE 
          us.cpf = :cpf

          ORDER BY
          created_at;', array
          (
          ':cpf' => $cpf
          )
    );

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
}