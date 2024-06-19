<?php

use Application\core\Controller;
use Application\intermediarios\MaterialIntermediario;
use Application\models\Eco;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';

class Material extends Controller
{

     /**
   * Método para cadastrar Resíduo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarResiduo()
    {
        try 
        {
            if(isset($_POST['cadastrarResiduo']))
            {
                $intermediario = new MaterialIntermediario;
                

                $nome = strtolower($_POST['nm_residuo']);
                $campoObrigatorio = validarCamposObrigatorios([
                    'Resíduo' => $nome
                ]);
                
                $validador = $intermediario->validadorResiduo($campoObrigatorio, $nome);

                if(!empty($validador))
                {
                    return $this->view('material/cadastrarResiduo', ['erros' => $intermediario->erros]);
                }

                $residuo = $this->model('Materiais');
                $residuo::cadastrarResiduo($nome);

                $this->view('material/cadastroResiduoSucesso');
            } else 
            {
                return $this->view('material/cadastrarResiduo');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

     /**
   * Método para consultar resíduos
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function consultarResiduos()
    {
        try {
            $residuoModel = $this->model('Materiais');
            $residuos = $residuoModel::buscarResiduos();

            return $this->view('material/consultarResiduos', [
                'residuos' => $residuos
            ]);

        } catch (Exception $e) 
        {
            echo "Ocorreu um erro";
            echo  $e;
        }
        
    }

    
     /**
   * Método para editar residuo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function editarResiduo($id = null)
    {
        try {
            
            $residuoModel = $this->model('Materiais');
            $residuo = $residuoModel::buscarResiduo($id);

            if(isset($_POST['editarResiduo']))
            {
            
                $intermediario = new MaterialIntermediario;
                $id = $_POST['editarResiduo'];
                $residuo = $residuoModel::buscarResiduo($id);

                $nm_residuo = strtolower($_POST['nm_residuo']);

                $camposObrigatorios = validarCamposObrigatorios([
                    'Resíduo' => $nm_residuo
                ]);   

                $validador = $intermediario->validadorResiduoEditar($camposObrigatorios, strtolower($residuo[0]['nm_residuo']), $nm_residuo);

                if(!empty($validador))
                {
                    return $this->view('material/editarResiduo', [
                        'erros' => $validador,
                        'residuo' => $residuo
                    ]);
                }

                $residuoModel::editarResiduo($id, $nm_residuo);

                return $this->view('material/editarResiduoSuccesso');
            } else
            {
                
                return $this->view('material/editarResiduo', [
                    'residuo' => $residuo
                ]);
            }
        } catch (Exception $e) 
        {
            echo "Ocorreu um erro";
            echo $e;
        }
    }

      /**
   * Método para deletar Resíduo
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function deletarResiduo($id = null)
    {
        try 
        {

            $intermediario = new MaterialIntermediario;

            $residuoModel = $this->model('Materiais');
            $dados = $residuoModel::buscarResiduos();
            $erros = $intermediario->validaDeletarResiduo($id);

            if(!empty($erros))
            {
                return $this->view('material/consultarResiduos', [
                'residuos' => $dados,
                'erros' => $erros
                ]);
            }

            $residuoModel::deletarResiduo($id);
            $dadosAtualizados = $residuoModel::buscarResiduos();
        
            return $this->view('material/consultarResiduos', [
                'residuos' => $dadosAtualizados
            ]);
            } catch (Exception $e) 
        {
            echo "Ocorreu um erro";
            echo $e;
        }
    } 

     /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarResiduoSucesso()
    {
        try 
        {
            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {
                return $this->view('material/cadastrarResiduo');
            } else {
                return $this->view('material/cadastroResiduoSucesso');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

    /**
   * Método para cadastrar o Material
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarMaterial()
    {
        try 
        {

            $materialModel = $this->model('Materiais');
            $residuos = $materialModel::buscarResiduos();

            if(isset($_POST['cadastrarMaterial']))
            {
                $intermediario = new MaterialIntermediario;
               
                $nome = strtolower($_POST['nm_material']);
                $eco = $_POST['vl_eco'];
                $unidadeMedida = $_POST['nm_unidademedida'];
                $idResiduo = $_POST['idResiduo'];

                $eco = str_replace(',', '.', $eco);
                $eco = preg_replace('/\.(?=.*\.)/', '', $eco);

                $camposObrigatorios = validarCamposObrigatorios([
                    'Material' => $nome,
                    'Eco Points' => $eco,
                    'Unidade de Medida' => $unidadeMedida,
                    'Tipo do Resíduo' => $idResiduo
                ]);

                $validador = $intermediario->validadorMaterial($camposObrigatorios, $nome, $eco);

                if(!empty($validador))
                {
                    return $this->view('material/cadastrarMaterial', ['erros' => $validador,
                    'residuos' => $residuos]);
                }

                $data = $materialModel::cadastrarMaterial($nome, $unidadeMedida, $eco, $idResiduo);

                return $this->view('material/cadastroMaterialSucesso');
            } else 
            {   
               
                return $this->view('material/cadastrarMaterial', ['residuos' => $residuos]);
            }

        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }
        
    }

      /**
   * Método para atualizar material cadastrado
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do material
   */
    public function editarMaterial($id = null)
    {
       try {
        $materialModel = $this->model('Materiais');
        $material = $materialModel::buscarMaterial($id);
        $residuos = $materialModel::buscarResiduos();

        if(isset($_POST['editarMaterial']))
        {
            $intermediario = new MaterialIntermediario;
            $id = $_POST['editarMaterial'];
            $material = $materialModel::buscarMaterial($id);

            $nome = strtolower($_POST['nm_material']);
            $eco = $_POST['vl_eco'];
            $unidadeMedida = $_POST['nm_unidademedida'];
            $idResiduo = $_POST['idResiduo'];

            $eco = str_replace(',', '.', $eco);
            $eco = preg_replace('/\.(?=.*\.)/', '', $eco);

            $camposObrigatorios = validarCamposObrigatorios([
                'Material' => $nome,
                'Eco Points' => $eco,
                'Unidade de Medida' => $unidadeMedida,
                'Tipo do Resíduo' => $idResiduo
            ]);

            $validador = $intermediario->validadorMaterial($camposObrigatorios, $nome, $eco, $material[0]['nm_material']);

            if(!empty($validador))
            {
                return $this->view('material/editarMaterial', ['erros' => $validador,
                'residuos' => $residuos,
                'material' => $material
                ]);
            }

            $materialModel::editarMaterial($id, $nome, $unidadeMedida, $eco, $idResiduo);

            return $this->view('material/materialEditadoSucesso');
        } else
        {
            return $this->view('material/editarMaterial', ['residuos' => $residuos,
                'material' => $material
            ]);
        }
       } catch (Exception $e) {
        echo("Algo deu errado, por favor, tente novamente.");
        echo $e;
       }    
    }

       /**
   * Método para deletar material cadastrado
   * @author Augusto Ribeiro
   * @created 13/06/2024
   * @param $id id do material
   */
   public function deletarMaterial($id)
   {
    try {
        $intermediario = new MaterialIntermediario;

        $materialModel = $this->model('Materiais');
        $dados = $materialModel::buscarMateriais();
        $erros = $intermediario->validaDeletarMaterial($id);

        if(!empty($erros))
        {
            return $this->view('material/consultarMateriais', [
            'materiais' => $dados,
            'erros' => $erros
            ]);
        }

        $materialModel::deletarMaterial($id);
        $dadosAtualizados = $materialModel::buscarMateriais();
      
        return $this->view('material/consultarMateriais', [
            'materiais' => $dadosAtualizados
    ]);

    } catch (Exception $e) {
        echo("Algo deu errado, por favor, tente novamente.");
        echo $e;
    }
   }

     /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastroMaterialSucesso()
    {
        try 
        {
            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['listar']) && isset($_POST['listar']))
            {
                $materiais = $this->model('Materiais');
                $dados = $materiais::buscarMateriais();
                return $this->view('material/consultarMateriais',[
                    'materiais' => $dados
                ]);
            } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
            {   
                $materialModel = $this->model('Materiais');
                $residuos = $materialModel::buscarResiduos();
                return $this->view('material/cadastrarMaterial',[
                    'residuos' => $residuos
                ]);
            } else {
                return $this->view('material/cadastroMaterialSucesso');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

       /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function editarMaterialSucesso()
    {
        try 
        {
            if(!empty($_POST['menu']) && isset($_POST['menu']))
            {
                return $this->view('home/index');

            } else if(!empty($_POST['listar']) && isset($_POST['listar']))
            {   
                $materiais = $this->model('Materiais');
                $dados = $materiais::buscarMateriais();
                return $this->view('material/consultarMateriais',[
                    'materiais' => $dados
                ]);
            }  else {
                return $this->view('material/cadastroMaterialSucesso');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
            echo $e;
        }    
    }

       /**
   * Método para cadastrar o material recebido
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
    public function cadastrarMaterialRecebido()
    {   
        try 
        {
            $materialModel = $this->model('Materiais');
            $materiais = $materialModel::buscarMateriais();

            $usuarioModel = $this->model('Usuarios');
            $usuarios = $usuarioModel::buscarUsuarios();

            if(isset($_POST['cadastrarMaterialRecebido']))
            {   
                
                $intermediario = new MaterialIntermediario;
                $tabela = json_decode($_POST['dadosTabela'], true);

                foreach($tabela as $item)
                {   
                    $idUsuario = $item['idUsuario'];
                    $idMaterial = $item['idMaterial'];
                    $quantidade = $item['quantidade'];
                    $eco = $item['valorFinal'];

                    $camposObrigatorios = validarCamposObrigatorios([
                        'Usuário' => $idUsuario,
                        'Material' => $idMaterial,
                        'Quantidade' => $quantidade,
                        'Eco Points' => $eco
                    ]);

                    $validador = $intermediario->validadorMaterial($camposObrigatorios, null, $eco);

                    if(!empty($validador))
                    {
                        return $this->view('material/cadastrarRecebimentoMaterial', ['erros' => $intermediario->erros,
                        'usuarios' => $usuarios,
                        'materiais' => $materiais
                        ]);
                    }

                    $usuarioModel::operacaoEntradaSaldo($idUsuario, $eco);
                    $saldo = $usuarioModel::consultarSaldo($idUsuario);
                    $materialModel::cadastrarMaterialRecebido($idUsuario, $idMaterial, $quantidade, $eco, $saldo[0]['vl_ecosaldo']);

                    
                }

                return $this->view('material/cadastroMaterialRecebidoSucesso');
            } else 
            {   
               
                return $this->view('material/cadastrarRecebimentoMaterial', [
                    'usuarios' => $usuarios,
                    'materiais' => $materiais
                ]);
            }

        } catch (Exception $e) 
        {
           
            echo("Algo deu errado, por favor, tente novamente.");
            echo($e);
        }
    }

     /**
   * Método para encaminhar o usuário para a view escolhida
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function cadastroMaterialRecebidoSucesso()
  {
      try 
      {
          if(!empty($_POST['menu']) && isset($_POST['menu']))
          {
              return $this->view('home/index');

          } else if(!empty($_POST['listar']) && isset($_POST['listar']))
          {
              return $this->view('usuario/consultarMateriaisEntregues');
          } else if(!empty($_POST['cadastrar']) && isset($_POST['cadastrar']))
          {
              return $this->view('material/cadastrarRecebimentoMaterial');
          } else {
              return $this->view('material/cadastroMaterialRecebidoSucesso');
          }

      } catch (Exception $e) 
      {
          echo("Algo deu errado, por favor, tente novamente.");
          echo $e;
      }    
  }

     /**
   * Método para consultar materiais
   * @author Augusto Ribeiro
   * @created 13/06/2024
   */
  public function consultarMateriais()
  {   
      $materiais = $this->model('Materiais');
      $dados = $materiais::buscarMateriais();

      return $this->view('material/consultarMateriais', [
          'materiais' => $dados
      ]);
  }
}