<?php
namespace Core;

class Request 
{
    private array $request;
    
    public function __construct()
    {
        $this->request = $_REQUEST;
    }
    public function __get($name)
    {
        if(isset($this->request[$name])) {
            return $this->request[$name];
        }
    }
    public function uri() {
        return trim($_SERVER['REQUEST_URI'], '/') ?? '';
    }
}
