<?php
// src/Model/Table/Competences.php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;


class CompetencesTable extends Table
{
    public function initialize(array $config)
    {
     $this->addBehavior('Timestamp');//
     //$this->table('customers'); *u can also specify ur table like this 
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', 'A name is required')
            ->notEmpty('description', 'A description is required')
            ->notEmpty('subject_id', 'A subject is required');
    }
     public function buildRules(RulesChecker $rules)
          {
            $rules->add($rules->isUnique(array('name')));
            return $rules;
          }
}