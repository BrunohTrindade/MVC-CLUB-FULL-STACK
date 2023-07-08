<?php

namespace app\core;

class Uri
{
  public static function uri() 
  {
    /*
    * Função para desconsiderar as variaveis da url
    */
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST)  ;

    return  explode('/', ltrim($uri, '/'));
  }
} 