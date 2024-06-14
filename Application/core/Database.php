<?php

namespace Application\core;

use PDO;
class Database extends PDO
{

  private $DB_NAME = 'eco_teste';
  private $DB_USER = 'postgres';
  private $DB_PASSWORD = '200121mg';
  private $DB_HOST = 'localhost';
  private $DB_PORT = 5432;

  private $conn;

    /**
   * Método para criar conexão com o banco de dados
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * 
   */
  public function __construct()
  {

    $this->conn = new PDO("pgsql:dbname=$this->DB_NAME;host=$this->DB_HOST;port=$this->DB_PORT;user=$this->DB_USER;password=$this->DB_PASSWORD");
  }

    /**
   * Método para setar os paramêtros dos valores da query
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $stmt statements recebido do método montarQuery
   * @param $key chave recebido do método montarQuery
   * @param $value valor recebido do método montarQuery 
   */
  private function setParametros($stmt, $chave, $valor)
  {
    $stmt->bindParam($chave, $valor);
  }

    /**
   * Método para enviar os paramêtros para o método setParametros
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $stmt statements recebido do método executarQuery
   * @param $parametros recebe os paramêtros do método executarQuery
   */
  private function montarQuery($stmt, $parametros)
  {
    foreach( $parametros as $chave => $valor ) {
      $this->setParametros($stmt, $chave, $valor);
    }
  }

    /**
   * Método para montar a query
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $query query para preparar no statement
   * @param $parametros enviados para serem bindados
   */
  public function executarQuery(string $query, array $parametros = [])
  {
    $stmt = $this->conn->prepare($query);
    $this->montarQuery($stmt, $parametros);
    $stmt->execute();
    return $stmt;
  }

}