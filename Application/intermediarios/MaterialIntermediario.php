<?php

namespace Application\intermediarios;

use Application\core\Database;
use Exception;
use PDO;

class MaterialIntermediario
{
    public $erros = [];

    public function validadorResiduo($erroCampo, $nome)
    {
        if(!empty($erroCampo))
        {
            return $this->erros = $erroCampo;
        }

        $this->validaNomeResiduo($nome);

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

    
}