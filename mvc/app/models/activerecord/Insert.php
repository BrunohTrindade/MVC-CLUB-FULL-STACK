<?php

namespace app\models\activerecord;

use Throwable;
use app\models\connection\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;

class Insert implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
      try{
        $query = $this->createQuery($activeRecordInterface);

        $connection = Connection::connect();

        $prepare = $connection->prepare($query);
        return $prepare->execute($activeRecordInterface->getAttributes());

        // return $prepare;
      }catch(Throwable $throw){
        formatException($throw);
      }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
      $sql = "INSERT INTO {$activeRecordInterface->getTable()}(";
      $sql.= implode(',', array_keys($activeRecordInterface->getAttributes())).') VALUES (';
      $sql.= ':'.implode(',:', array_keys($activeRecordInterface->getAttributes())).')';

      return $sql;
    }
}