<?php

use Application\core\Controller;

class Material extends Controller
{

    public function register_type_residue()
    {
        $this->view('material/register_type_residue');
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
        $this->view('material/register_material');
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
}