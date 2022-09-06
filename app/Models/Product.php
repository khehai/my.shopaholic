<?php 
namespace Models;
use Core\Entity;

class Product extends Entity
{
    protected static $table = 'products';

    public $id;
    public $title;
    public $description;
    public $price;
    public $image;
    public $status;
    public $badge_id;
    public $category_id;
    public $brand_id;
    
}