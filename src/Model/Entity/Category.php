<?php 

// src/Model/Entity/Categorie.php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Categorie extends Entity
{

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

}