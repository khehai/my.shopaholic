<?php 
namespace Models;
use Core\Entity;

class Brand extends Entity
{
    protected static $table = 'brands';

    public $id;
    public $name;
    public $description;
    
}