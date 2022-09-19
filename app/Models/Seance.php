<?php 
namespace Models;

use Core\Entity;

class Seance extends Entity
{
    protected static $table = 'seances';

    public $id;
    public $uid;
    public $hash;
    public $expiredate;
    public $agent;
    public $cookie_crc;

}