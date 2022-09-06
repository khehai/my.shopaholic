<?php 
namespace Models;
use Core\Entity;

class Category extends Entity
{
    protected static $table = 'categories';

    public $id;
    public $name;
    public $status;
    public $cover;
    
}