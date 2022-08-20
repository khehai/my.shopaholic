<?php

require_once ROOT.'/core/Request.php';

class Router 
{
    private Request $request;
    private static array $routes;

    public function __construct(Request $request, string
     $routesPath = ROOT.'/config/routes.php')
    {
        $this->request = $request !==null ? $request : new Request();
        self::$routes = require_once $routesPath;
    }

    public function run()
    {
        if(array_key_exists($this->request->uri(), self::$routes)) {
            return $this->init(self::$routes[$this->request->uri()]);
        }else{
            return $this->init(self::$routes['errors']);
        }
    }

    private function init(string $path)
    {
        $segments = explode('/', $path);
        $segment = array_pop($segments);
       [$controller, $action] = explode('@', $segment);

        $controllerPath = array_pop($segments);
        $controllerPath = $controllerPath  ? '/'.
        $controllerPath:'';

        $controllerPath = CONTROLLERS.$controllerPath.'/'.
        $controller.'.php'; 
      
        if (file_exists($controllerPath)) {
            include_once $controllerPath;
            $controller = new $controller($this->request);
        }else{
            throw new Exception("File $controllerPath does not exists!");
        }
        return $controller->index();
    }
}