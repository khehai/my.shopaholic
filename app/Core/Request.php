<?php
namespace Core;

class Request 
{
    private array $request;
    
    public function __construct()
    {
        $this->request = $this->prepare($_REQUEST, $_FILES);
    }
    public function __get($name)
    {
        if(isset($this->request[$name])) {
            return $this->request[$name];
        }
    }
    private function prepare(array $request, array $files) {
        return array_merge($request, $files);
    }
    public function uri() {
        return trim($_SERVER['REQUEST_URI'], '/') ?? '';
    }

     public function session()
    {
        return Session::instance();
    }
    
    public function flash()
    {
        return Session::instance();
    }
}