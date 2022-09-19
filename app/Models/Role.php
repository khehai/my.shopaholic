<?php 

namespace Models;

use Core\Entity;

class Role extends Entity
{
    protected static $table = 'roles';

    public $id;
    public $name;

}