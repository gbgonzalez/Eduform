<?php

// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;


class UsersTable extends Table
{

    public function initialize(array $config)
    {
     $this->addBehavior('Timestamp');//
     //$this->table('customers'); *u can also specify ur table like this 
     $this->belongsToMany('Competences', [
          'foreignKey' => 'user_id',
          'targetForeignKey' => 'competence_id',
          'joinTable' => 'userscompetences',
      ]);
    }
    
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('dni', 'A dni is required')
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['Alumno','Gestor de contenidos','Administrador']],
                'message' => 'Please enter a valid role'
            ]);
    }

     public function buildRules(RulesChecker $rules)
          {
            $rules->add($rules->isUnique(array('dni')));
            $rules->add($rules->isUnique(array('username')));
            return $rules;
          }

}
