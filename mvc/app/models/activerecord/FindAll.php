<?php

namespace app\models\activerecord;

use Exception;
use Throwable;
use app\models\connection\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;

class FindAll implements ActiveRecordExecuteInterface
{

  public function __construct(
    private array $where = [],
    private string|int $limit = '',
    private string|int $offset = '',
    private string $fields = '*'
  )
  {
    
  }
  public function execute(ActiveRecordInterface $activeRecordInterface)
  {
    try{
      $query = $this->createQuery($activeRecordInterface);

      $connection = Connection::connect();

      $prepare = $connection->prepare($query);
      $prepare->execute($this->where);

      return $prepare->fetchAll();
    }catch(Throwable $throw){
      formatException($throw);
    }
  }

  private function createQuery(ActiveRecordInterface $activeRecordInterface){

    if(count($this->where) > 1){
      throw new Exception("No WHERE só pode ser passado um indice");
    }

    $where = array_keys($this->where);
    $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()}";

    $sql .= (!$this->where) ? '' : " WHERE {$where['0']} = :{$where[0]}"; //6:16 minutos video

    $sql .= (!$this->limit) ? '' : " limit {$this->limit}";
    $sql .= ($this->offset != '') ? " offset {$this->offset}" : '';
    
    return $sql;
  }
}