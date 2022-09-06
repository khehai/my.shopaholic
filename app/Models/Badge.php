<?php 
namespace Models;
use Core\Entity;

class Badge extends Entity
{
    protected static $table = 'badges';

    public $id;
    public $title;
    public $bg;
    
}