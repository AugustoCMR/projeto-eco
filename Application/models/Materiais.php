<?php

namespace Application\models;

use Application\core\Database;
use PDO;

class Materiais
{
   /**
   * Método para cadastrar Resíduo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome nome do resíduo
   */
    public static function cadastrarResiduo($nome)
    {
        $conn = new Database();
        $conn->executarQuery('INSERT INTO residuo(nm_residuo) VALUES(:nome)', array(
            'nome' => $nome
        ));
    }

   /**
   * Método para cadastrar material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome nome do material
   * @param $unidadeMedida unidade de medida do material
   * @param $ecoValor valor do material calculado
   * @param $residuoId id do residuo referente ao material
   */
  public static function cadastrarMaterial($material, $unidadeMedida, $ecoValor, $residuoId)
  {
      $conn = new Database();
      $conn->executarQuery('INSERT INTO material(nm_material, nm_unidademedida, vl_eco, id_residuo) VALUES(:nome, :unidadeMedida, :ecoValor, :residuoId)', array(
          'nome' => $material,
          'unidadeMedida' => $unidadeMedida,
          'ecoValor' => $ecoValor,
          'residuoId' => $residuoId
      ));   
  }

  /**
   * Método para atualizar material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do material
   * @param $nome nome do material
   * @param $unidadeMedida unidade de medida do material
   * @param $ecoValor valor do mater    ial calculado
   * @param $residuoId id do residuo referente ao material
   */
  public static function editarMaterial($id, $material, $unidadeMedida, $ecoValor, $residuoId)
  {
      $conn = new Database();   
      $conn->executarQuery('UPDATE material SET nm_material = :nome, nm_unidademedida = :unidadeMedida, vl_eco = :eco, id_residuo = :idResiduo WHERE id_material = :id', array(
        ':nome' => $material,
        ':unidadeMedida' => $unidadeMedida,
        ':eco' => $ecoValor,
        ':idResiduo' => $residuoId,
        ':id' => $id
      ));
  }

    /**
   * Método para deletar material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id Id do material
   */
  public static function deletarMaterial($id)
  {
    $conn = new Database();
    $conn->executarQuery('DELETE FROM material WHERE id_material = :id', array(
      ':id' => $id
    ));
  }


     /**
   * Método para buscar Resíduos no Banco
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public static function buscarResiduos()
    {
        $conn = new Database();
        $buscarResiduos = $conn->executarQuery('SELECT * FROM residuo');

        return $buscarResiduos->fetchAll(PDO::FETCH_ASSOC);
    }

    
      /**
   * Método para buscar materiais cadastrados
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public static function buscarMateriais()
    {
        $conn = new Database();
        $buscarMateriais = $conn->executarQuery('SELECT * FROM material
        INNER JOIN residuo
        ON material.id_residuo = residuo.id_residuo');

        return $buscarMateriais->fetchAll(PDO::FETCH_ASSOC);
   
    }

       /**
   * Método para buscar material cadastrado
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do material
   */
  public static function buscarMaterial($id)
    {
        $conn = new Database();
        $buscarMateriais = $conn->executarQuery('SELECT * FROM material WHERE id_material = :id', array(
            ':id' => $id
        ));

        return $buscarMateriais->fetchAll(PDO::FETCH_ASSOC);
   
    }

      /**
   * Método para cadastrar recebimento do material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome nome do material
   * @param $unidadeMedida unidade de medida do material
   * @param $ecoValor valor do material calculado
   * @param $residuoId id do residuo referente ao material
   */
    public static function cadastrarMaterialRecebido($idUsuario, $idMaterial, $quantidade, $eco_valor, $saldoAtual)
    {   
        $conn = new Database();
        $conn->executarQuery('INSERT INTO material_entregue(id_usuario, id_material, qt_materialentregue, vl_eco, vl_saldoatual) VALUES(:idUsuario, :idMaterial, :quantidade, :eco_valor, :saldo)', array(
            'idUsuario' => $idUsuario,
            'idMaterial' => $idMaterial,
            'quantidade' => $quantidade,
            'eco_valor' => $eco_valor,
            'saldo' => $saldoAtual
        ));
    }
}