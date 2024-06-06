<?php

use Application\core\Controller;

class User extends Controller
{
  
  public function index()
  {
    $Users = $this->model('Users'); 
    $data = $Users::findAll();
    $this->view('User/index', ['usuario' => $data]);
   }

}