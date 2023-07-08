<?php


namespace app\core;

class ParamsExtract
{
  public static function extract($sliceIndexStartFrom) 
 {
  $uri = Uri::uri();
  $countUri = count($uri);  

  /* Array_slice é a fatia do array ao qual queremos
  * por exemplo: o array é URI, e pegaremos do item 3
  * até o final do array, já que demos um count na qntdd
  * de itens do array.
  */
  return array_slice($uri, $sliceIndexStartFrom, $countUri); 
  }
}