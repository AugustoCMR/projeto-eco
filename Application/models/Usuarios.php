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
  public static function editar($id, $nome, $email, $cpf, $pais, $estado, $cidade, $cep, $rua, $bairro, $numero)
  {
    $conn = new Database();
    $conn->executarQuery('UPDATE usuario
    SET nm_usuario = :nome, nm_email = :email, nu_cpf = :cpf, nm_pais = :pais, nm_estado = :estado, nm_cidade = :cidade, nu_cep = :cep, nm_rua = :rua, nm_bairro = :bairro, nm_numero = :numero
    WHERE id_usuario = :id', array(
       ':nome' => $nome,
       ':email' => $email,
       ':cpf' => $cpf,
       ':pais' => $pais,
       ':estado' => $estado,
       ':cidade' => $cidade, 
       ':cep' => $cep,
       ':rua' => $rua,
       ':bairro' => $bairro,
       ':numero' => $numero,
       ':id' => $id
    ));
  }

   /**
   * Método para deletar usuário
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do usuário
   */
  public static function deletar($id)
  {
    $conn = new Database();
    $conn->executarQuery('DELETE FROM usuario WHERE id_usuario = :id', array(
      ':id' => $id
    ));
  }

   /**
   * Método para consultar usuário por cpf
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $cpf cpf do usuário
   */
  public static function buscarUsuarioCPF($cpf)
  {
    $conn = new Database();
    $resultado = $conn->executarQuery('SELECT * FROM usuario WHERE nu_cpf = :cpf', array(
      ':cpf' => $cpf
    ));

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
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
    $saldoAtual = $consultaSaldo[0]['vl_ecosaldo'];
    $saldoFinal = (float)$saldoAtual - (float)$eco;

    $result = $conn->executarQuery('UPDATE usuario SET vl_ecosaldo = :eco WHERE id_usuario = :ID ', array(
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
    $result = $conn->executarQuery('SELECT us.nm_usuario, mt.nm_material, me.qt_materialentregue, me.vl_eco FROM usuario AS us INNER JOIN material_entregue AS me ON us.id_usuario = me.id_usuario INNER JOIN material AS mt
    ON mt.id_material = me.id_material WHERE us.nu_cpf = :cpf', array(
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
    $result = $conn->executarQuery
    ('SELECT 
          us.vl_ecosaldo, us.nm_usuario,
          mt.nm_material AS nome_material, 
          NULL AS nome_produto, 
          me.vl_saldoatual AS saldo_atual_entrada, 
          NULL AS saldo_atual_saida, 
          me.vl_eco AS entrada, 
          NULL AS saida,
          me.dt_criadoem
          FROM 
          usuario AS us
          INNER JOIN 
          material_entregue AS me ON us.id_usuario = me.id_usuario
          INNER JOIN 
          material AS mt ON mt.id_material = me.id_material
          WHERE 
          us.nu_cpf = :cpf

          UNION ALL

          SELECT 
          us.vl_ecosaldo, us.nm_usuario,
          NULL AS nome_material, 
          pd.nm_produto AS nome_produto, 
          NULL AS saldo_atual_entrada, 
          pds.vl_saldoatual AS saldo_atual_saida, 
          NULL AS entrada, 
          pds.vl_eco AS saida,
          pds.dt_criadoem
          FROM 
          usuario AS us
          INNER JOIN 
          produto_retirado AS pds ON us.id_usuario = pds.id_usuario
          INNER JOIN 
          produto AS pd ON pd.id_produto = pds.id_produto
          WHERE 
          us.nu_cpf = :cpf

          ORDER BY
          dt_criadoem DESC;
          ', array
          (
          ':cpf' => $cpf
          )
    );

    return $result->fetchAll(PDO::FETCH_ASSOC);
  } 
}