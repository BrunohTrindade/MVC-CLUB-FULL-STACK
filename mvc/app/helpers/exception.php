<?php
function formatException(Throwable $throw)
{
  var_dump("Erro no arquivo: {$throw->getFile()}; Na linha: {$throw->getLine()}; {$throw->getMessage()}");
}