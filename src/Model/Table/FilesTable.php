<?php
/*
   In the present example, these changes would be made in:
   src/Model/Table/filesTable.php
*/

namespace App\Model\Table;
use Cake\ORM\Table;

class FilesTable extends Table
{
  public function initialize(array $config)
    {
     $this->addBehavior('Timestamp');//
     //$this->table('customers'); *u can also specify ur table like this 
     $this->belongsTo('Contents', [
            'foreignKey' => 'content_id',
            'joinType' => 'INNER'
        ]);
    
    }

}