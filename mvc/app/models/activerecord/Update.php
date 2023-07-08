<?php

namespace app\models\activerecord;

use app\models\connection\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;
use Exception;
use Throwable;

class Update implements ActiveRecordExecuteInterface
{

  public function __construct(private $field, private string | int $value)
  {
    
  }
  public function execute(ActiveRecordInterface $activeRecordInterface)
  {

    try{

      $query = $this->createQuery($activeRecordInterface);

      $Connection = Connection::connect();

      $attributes = array_merge($activeRecordInterface->getAttributes(), [

        $this->field => $this->value
      ]);

      $prepare = $Connection->prepare($query);

      $prepare->execute($attributes);

      return $prepare->rowCount();
      // return $this->createQuery($activeRecordInterface);

    }catch (Throwable $throw){

      formatException($throw);

    }

  }

  private function createQuery(ActiveRecordInterface $activeRecordInterface)
  {

    if(array_key_exists('id', $activeRecordInterface->getAttributes()))
    {
      throw new Exception('O campo id não pode ser passado para o update');
    }
    $sql = "update {$activeRecordInterface->getTable()} set ";
    
    foreach($activeRecordInterface->getAttributes() as $key => $value)
    {
      if($key != 'id'){
      $sql.= "{$key} = :{$key}, ";
      }
    }

    $sql = trim($sql, ", ");
    $sql.= " WHERE {$this->field} = :{$this->field}" ;

    return $sql;
  }
}