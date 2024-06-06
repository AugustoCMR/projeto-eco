<?php

use Application\core\Controller;

class Material extends Controller
{

    public function index()
    {
        $this->view('material/index');
    }

    public function register_type_residue()
    {
        $name = $_POST['name'];

        $residue = $this->model('Materials');
        $data = $residue::register_type_residue($name);
        $this->view('material/register_type_residue');
    }
}