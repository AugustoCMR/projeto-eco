<?php

namespace Application\intermediarios;

use Application\core\Database;
use Exception;
use PDO;

class MaterialIntermediario
{
    public $erros = [];

     /**
   * Método para validar os dados do resíduo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $erroCampo recebe todos os campos do resíduo
   * @param $nome nome do resíduo
   * @param $nomeEditado variável para verificar edição de resíduo
   */
    public function validadorResiduo($erroCampo = null, $nome = null)
    {
        if(!empty($erroCampo))
        {
            return $this->erros = $erroCampo;
        }

        $this->validaNomeResiduo($nome);

        return $this->erros;
    }

      /**
   * Método para validar a edição do resíduo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $erroCampo recebe todos os campos do resíduo
   * @param $nome nome do resíduo
   * @param $nomeEditado variável para verificar edição de resíduo
   */

    public function validadorResiduoEditar($erroCampo, $nome, $nomeEditado)
    {
        if(!empty($erroCampo))
        {
            return $this->erros =
            $erroCampo;
        }

        $this->validaNomeResiduoEditar($nome, $nomeEditado);

        return $this->erros;
    }

   /**
   * Método para validar os dados do material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $erroCampo recebe todos os campos do material
   * @param $nome nome do material
   * @param $eco valor do material em Eco
   * @param $nomeEdicao variável para verificar edição de cadastro
   */
    public function validadorMaterial($erroCampo = null, $nome = null, $eco = null, $nomeEdicao = null)
    {

        if(!empty($erroCampo))
        {
            return $this->erros = $erroCampo;
        }
        
        $this->validaFormularioMaterial($nome, $eco, $nomeEdicao);

        return $this->erros;
    }

     /**
   * Método para validar recebimento de material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $erroCampo recebe todos os campos do material
   * @param $dados dados necessários para cadastro do recebimento de material

   */
  public function validadorRecebimentoMaterial($erroCampo, $dados, $quantidade)
  {

      if(!empty($erroCampo))
      {
          return $this->erros = $erroCampo;
      }
      
      $idsMateriais = array_column($dados, 'idMaterial');
      $idsUsuarios = array_column($dados, 'idUsuario');

      if($quantidade <= 0) {
        $this->erros['quantidadeInvalida'] = "Quantidade não pode ser menor que 1";
        return $this->erros;
      }

      if(count(array_unique($idsUsuarios)) > 1)
      {

        $this->erros['usuariosDuplicados'] = "Todos os materiais devem pertencer ao mesmo usuário";
        return $this->erros;
      }


      if (count($idsMateriais) !== count(array_unique($idsMateriais))) 
      {
        
          $this->erros['materiaisDuplicados'] = "Materiais duplicados não podem ser cadastrados";
          return $this->erros;
      }

      return $this->erros;
  }

    /**
   * Método para validar o material á ser deletado
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do material
   */
  public function validaDeletarMaterial($id)
  {
    $conn = new Database();
    $query = $conn->executarQuery('SELECT * FROM material_entregue WHERE id_material = :id', array(
        ':id' => $id
    ));
    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $this->erros['registros'] = "Não é possível deletar, material possuí registros";
        return $this->erros;
    }
  }

      /**
   * Método para validar o residuo á ser deletado
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do residuo
   */
  public function validaDeletarResiduo($id)
  {
    $conn = new Database();
    $query = $conn->executarQuery('SELECT * FROM material WHERE id_residuo = :id', array(
        ':id' => $id
    ));
    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($resultado))
    {
        $this->erros['registros'] = "Não é possível deletar, resíduo possuí registros";
        return $this->erros;
    }
  }  

/**
   * Metodo para validar o nome do residuo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome Nome do Residuo
   */
    public function validaNomeResiduo($nome)
    {
        try 
        {   
            
                $conn = new Database();
                $buscaNome = $conn->executarQuery('SELECT * FROM residuo WHERE nm_residuo = :nome', array(
                    ':nome' => $nome
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado))
                {
                    return $this->erros['nome'] = 'O Resíduo informado já existe.';
                }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    /**
     * Método para validar o formulário do material
     * @author Augusto Ribeiro
     * @created 13/06/2024
     * @param $nome nome do material
     * @param $eco valor do eco 
     */
    public function validaFormularioMaterial($nome, $eco, $nomeEdicao)
    {
        try 
        {

                $conn = new Database();
                $buscaNome = $conn->executarQuery('SELECT * FROM material WHERE nm_material = :nome', array(
                    ':nome' => $nome
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if($nome === $nomeEdicao)
                {
                    return;
                }

                if(!empty($resultado))
                {
                    $this->erros['nome'] = 'O material informado já existe.';
                }

                if(!is_numeric($eco))
                {
                    $this->erros['eco_valor'] = 'O valor informado deve ser númerico.';
                }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }

    /**
   * Metodo para validar o nome do residuo na edição
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $nome Nome do Residuo
   * @param $nomeEditado novo nome
   */
    public function validaNomeResiduoEditar($nome, $nomeEditado)
    {
        try 
        {
          
                if($nome === $nomeEditado)
                {        
                    return;
                }
               
                $conn = new Database();
                $buscaNome = $conn->executarQuery('SELECT * FROM residuo WHERE nm_residuo = :nome', array(
                    ':nome' => $nomeEditado
                ));

                $resultado = $buscaNome->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado))
                {
                    $this->erros['nomeResiduo'] = 'O Resíduo informado já existe.';
                }
            
        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
    }
}