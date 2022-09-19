<?php 
namespace Models;

use Core\Entity;

class Order extends Entity
{
    protected static $table = 'orders';

    public $id;
    public $user_id;
    public $order_date;
    public $products;
    public $status;
}