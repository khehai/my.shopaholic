<?php
namespace Core;

class Session
{
    private static $instance = null;
    private $messages = array();
    
    private function __construct()
    {
        session_start();
        $this->messages = self::get('flash_messages');
        self::set('flash_messages', []);
    }

    private function __clone()
    {

    }

    public static function instance()
    {
        if(self::$instance === null){
            self::$instance = new Session;
        }
        return self::$instance;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? false;
    }

    public static function set($key, $val) {
         $_SESSION[$key] = $val;
    }

    public static function unset($key) {
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        session_unset;
    }

    public function message($name, $message) {
        $_SESSION['flash_messages'][] = array(
            'name' => $name,
            'message' => $message
        );
    }

     public function __call($name, $arguments)
    {
        $message = $arguments[0];
        $this->message($name, $message);
    }
    

    public function messageCount() {
       return $this->messages ? count($this->messages) : 0;        
    }

    public function showFlash() {
        if($this->messages[0]){
           return [$this->messages[0]['name'], $this->messages
           [0]['message']];         
        }
       return null;        
    }

}