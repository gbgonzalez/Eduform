<?php 

// src/Model/Entity/UsersCompetence.php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class UsersCompetence extends Entity
{

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

}