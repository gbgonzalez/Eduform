<?php
// src/Model/Table/Userscompetences.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;


class UserscompetencesTable extends Table
{
    public function initialize(array $config)
    {
     $this->addBehavior('Timestamp');//
     //$this->table('customers'); *u can also specify ur table like this 
        $this->belongsTo('Users');
        $this->belongsTo('Competences');

       
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('user_id', 'El usuario es necesario')
            ->notEmpty('competence_id', 'Incluir competencia es necesario');
            
       
    }
 
}