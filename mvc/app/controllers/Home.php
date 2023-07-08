<?php

namespace app\controllers;

class Home
{
  public string $view;
  public array $data = [];

  public function index()  
  {
   $this->view = 'home.php';
   $this->data = [
    'title' => 'Home'
   ];
  }
}