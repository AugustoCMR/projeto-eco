<?php

use Application\core\Controller;
use Application\intermediarios\MaterialIntermediario;
use Application\models\Eco;

require __DIR__ . '\\../utils/validaCamposObrigatorios.php';

class Material extends Controller
{

    public function register_type_residue()
    {
        try 
        {
            if(isset($_POST['cadastrar_residuo']))
            {
                $intermediario = new MaterialIntermediario;
                

                $nome = strtolower($_POST['nome']);
                $campoObrigatorio = validarCamposObrigatorios([
                    'Nome' => $nome
                ]);
                
                $validador = $intermediario->validadorResiduo($campoObrigatorio, $nome);

                if(!empty($validador))
                {
                    return $this->view('material/register_type_residue', ['erros' => $intermediario->erros]);
                }

                $residue = $this->model('Materials');
                $data = $residue::register_type_residue($nome);

                $this->view('material/register_type_residue_success');
            } else 
            {
                return $this->view('material/register_type_residue');
            }

        } catch (Exception $e) 
        {
            echo("Algo deu errado, por favor, tente novamente.");
        }    
    }

    public function register_material()
    {
        try 
        {

            $materialModel = $this->model('Materials');
            $residuos = $materialModel::buscarResiduos();

            if(isset($_POST['cadastrar_material']))
            {
                $intermediario = new MaterialIntermediario;
               
                $nome = strtolower($_POST['nome']);
                $eco = $_POST['eco_valor'];
                $unidade_medida = $_POST['unidade_medida_id'];
                $tipo_residuo_id = $_POST['tipo_residuo'];

                $camposObrigatorios = validarCamposObrigatorios([
                    'Nome' => $nome,
                    'Eco Points' => $eco,
                    'Unidade de Medida' => $unidade_medida,
                    'Tipo do Resíduo' => $tipo_residuo_id
                ]);

                $validador = $intermediario->validadorMaterial($camposObrigatorios, $nome, $eco);

                if(!empty($validador))
                {
                    return $this->view('material/register_material', ['erros' => $validador,
                    'tipo_residuos' => $residuos]);
                }

                $data = $materialModel::register_material($nome, $unidade_medida, $eco, $tipo_residuo_id);

                return $this->view('material/register_material_success');
            } else 
            {   
               
                return $this->view('material/register_material', ['tipo_residuos' => $residuos]);
            }

        } catch (Exception $e) {
            echo("Algo deu errado, por favor, tente novamente.");
        }
        
    }

    public function cadastro_recebimento_material()
    {   
        try 
        {

            $materialModel = $this->model('Materials');
            $materiais = $materialModel::buscarMateriais();

            $usuarioModel = $this->model('Users');
            $usuarios = $usuarioModel::buscarUsuarios();

            if(isset($_POST['cadastrar_recebimento_material']))
            {
                $intermediario = new MaterialIntermediario;
                
                $usuario_id = $_POST['usuario_id'];
                $material_id = $_POST['material_id'];
                $quantidade = $_POST['quantidade'];
                $eco = $_POST['eco_valor'];

                $camposObrigatorios = validarCamposObrigatorios([
                    'Usuário' => $usuario_id,
                    'Material' => $material_id,
                    'Quantidade' => $quantidade,
                    'Eco Points' => $eco
                ]);

                $validador = $intermediario->validadorMaterial($camposObrigatorios, null, $eco);
            
                if(!empty($validador))
                {
                    return $this->view('material/cadastro_recebimento_material', ['erros' => $intermediario->erros,
                    'usuarios' => $usuarios,
                    'materiais' => $materiais
                ]);
                }

                $usuarioModel::operacaoEntradaSaldo($usuario_id, $eco);
                $saldo = $usuarioModel::consultarSaldo($usuario_id);
                $data = $materialModel::cadastro_recebimento_material($usuario_id, $material_id, $quantidade, $eco, $saldo[0]['eco_saldo']);
                
                return $this->view('material/cadastro_recebimento_material_sucesso');
            } else 
            {   
               
                return $this->view('material/cadastro_recebimento_material', [
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