<?php
namespace Core;

class Session
{
    private static $instance = null;
    private $messages = array();
    private $now = false;
    
    private function __construct()
    {
        ini_set("session.use_strict_mode", 1);
        ini_set("session.cookie_httponly", 1);
        ini_set("session.sid_length", 48);
        ini_set("session.sid_bits_per_character", 6);
        ini_set("session.hash_function", "sha256");
        ini_set("session.cache_limiter", 'nocache');
        ini_set("session.use_trans_sid", 0);
        
        session_start();

        // Save all messages
        $this->messages = self::get('flash_messages');
    
        // Reset all flash messages or create the session
        self::set('flash_messages', []);
    }

    // don't allow cloning
    private function __clone() {}

    public static function instance()
    {
        if(self::$instance === null){
            self::$instance = new Session;
        }
        return self::$instance;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? false;
    }


    public static function set($key, $value)
    {
         $_SESSION[$key] = $value;
    }

    public static function unset($key)
    {
         unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        if(self::$instance == true){
            session_unset();
        }
 
    }

    public function replace($name, $value)
    {
        $this->unset($name);
        $this->set($name, $value);
    }

    // Allows simple message adding
    // usage: flash()->notice('You have logged in successfully');
    public function __call($name, $args) 
    {
        $message = $args[0];
        $this->message($name, $message);
    }
  
  
    public function message($name, $message) 
    {
         if($this->now) {
             $this->messages[] = array(
                'name' => $name,
                'message' => $message
             );
             $this->now = false;
         }else
             $_SESSION['flash_messages'][] = array(
                'name' => $name,
                'message' => $message
             );
     }

  
    public function each($callback = null) {
        
        // Set default markup
        if( $callback === null ) {
          $callback = function($name, $message) {
            echo '<div class="flash_' . $name . '">' . $message . '</div>';
          };
        }
        
        foreach( $this->messages as $flash ) {
          echo $callback($flash['name'], $flash['message']);
        }
    }
  
    // Allows message to be displayed instantly
    // (opposed to waiting for next page request)
    public function now() {
        $this->now = true;
        return $this;
    }

    public function flashCount(){
        return $this->messages ? count($this->messages) : 0;
    }

    public function showFlash() {
        if ($this->messages[0]) {
            return [$this->messages[0]['name'], $this->messages[0]['message']];    
        }
        return null;
    }
}