<?php 

// src/Model/Entity/Subject.php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Subject extends Entity
{

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

}