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
        $buscarMateriais = $conn->executarQuery('SELECT * FROM material');

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