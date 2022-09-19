<?php 

namespace Core\Traits;
 
trait Helpers 
{
    public static function getHash(string $string, int $cost = 10):string 
    {
        $hash = password_hash($string, PASSWORD_BCRYPT, ['cost' => $cost]);

        return $hash;
    }
    
}