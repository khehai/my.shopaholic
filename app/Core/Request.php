<?php
namespace Core;

class Request
{
    private array $request; // GET and POST

    public function __construct() 
    {
        $this->request = $this->prepareRequest($_REQUEST, $_FILES);
    }

    public function __get($name) 
    {
        if (isset($this->request[$name])) return $this->request[$name];
    }

    private function cleanInput($data) 
    {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = $this->cleanInput($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    
    private function prepareRequest(array $request, array $files)
    {
        $request = $this->cleanInput($request);
        return array_merge($files, $request);
    }

    public function getRequest()
    {
        return $this->request;
    }


	public function uri():string 
    {
        return trim($_SERVER['REQUEST_URI'], '/') ?? '';
    }

    public function session() {
        return Session::instance();
    }
    // Allows flash shorthand
    public function flash() {
       return Session::instance();
    }
}