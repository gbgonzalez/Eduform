<?php 

// src/Model/Entity/Materia.php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Materia extends Entity
{

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

}