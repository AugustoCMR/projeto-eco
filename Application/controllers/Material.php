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

                $residuo = $this->model('Materials');
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
                
                $idUsuario = $_POST['idUsuario'];
                $idMaterial = $_POST['idMaterial'];
                $quantidade = $_POST['qt_materialentregue'];
                $eco = $_POST['vl_eco'];

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
}