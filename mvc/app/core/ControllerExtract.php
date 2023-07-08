<?php

namespace app\core;

class ControllerExtract
{
  public static function extract()
  {
    $uri = Uri::uri();

    $controller = 'Home';
    
    if(isset($uri[1]) and $uri[1] !== ''){
      $controller = ucfirst($uri[1]);
    }

    $namespaceAndController = "app\\controllers\\".$controller;

    if(class_exists($namespaceAndController))
    {
      $controller = $namespaceAndController;
    }

    return $controller;
  }
}