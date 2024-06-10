<?php

use Application\core\Controller;
use Application\intermediarios\MaterialIntermediario;
use Application\models\Eco;

class Material extends Controller
{

    public function register_type_residue()
    {
        try 
        {
            if(isset($_POST['cadastrar_residuo']))
            {
                $intermediario = new MaterialIntermediario;
                $validador = $intermediario->validadorResiduo();

                $name = $_POST['nome'];

                if(!empty($validador))
                {
                    return $this->view('material/register_type_residue', ['erros' => $intermediario->erros]);
                }

                $residue = $this->model('Materials');
                $data = $residue::register_type_residue($name);

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

    public function register_type_residue_success()
    {

        $name = $_POST['name'];

        $residue = $this->model('Materials');
        $data = $residue::register_type_residue($name);
        $this->view('material/register_type_residue_success');
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
                $validador = $intermediario->validadorMaterial();
                
                $nome = $_POST['nome'];
                $eco = $_POST['eco_valor'];
                $unidade_medida = $_POST['unidade_medida_id'];
                $tipo_residuo_id = $_POST['tipo_residuo'];

                if(!empty($validador))
                {
                    return $this->view('material/register_material', ['erros' => $intermediario->erros,
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

    public function register_material_success()
    {
        $name = $_POST['name'];
        $unidade_medida = $_POST['unidade_medida'];
        $eco_valor = $_POST['eco_valor'];
        $tipo_residuo_id = $_POST['tipo_residuo_id'];

        $material = $this->model('Materials');
        $data = $material::register_material($name, $unidade_medida, $eco_valor, $tipo_residuo_id);
        $this->view('material/register_material_success');
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
                $validador = $intermediario->validadorMaterial();
                
                $usuario_id = $_POST['usuario_id'];
                $material_id = $_POST['material_id'];
                $quantidade = $_POST['quantidade'];
                $eco = $_POST['eco_valor'];
            
                if(!empty($validador))
                {
                    return $this->view('material/register_material', ['erros' => $intermediario->erros,
                    'usuarios' => $usuarios,
                    'materiais' => $materiais
                ]);
                }

                $data = $materialModel::cadastro_recebimento_material($usuario_id, $material_id, $quantidade, $eco);
                $usuarioModel::atualizarSaldo($usuario_id, $eco);
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

    public function cadastro_recebimento_material_sucesso()
    {   
        $usuario = $_POST['usuario'];
        $material = $_POST['material'];
        $quantidade = $_POST['quantidade'];
        $eco_valor = $_POST['eco_valor'];

        $materialModel = $this->model('Materials');
        $data = $materialModel::cadastro_recebimento_material($usuario, $material, $quantidade, $eco_valor);
        $this->view('material/cadastro_recebimento_material_sucesso');

    }
}