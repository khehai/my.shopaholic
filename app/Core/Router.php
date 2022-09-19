<?php

namespace Core;

class Router
{
    protected static array $routes;
    protected Request $request;
    
    function __construct(Request $request, string $routesPath = ROOT.'/config/routes.php')
    {
        self::$routes = require_once $routesPath;
        $this->request =  $request  !== null ? $request  : new Request();
    }

    public function run()
    {
        if (array_key_exists($this->request->uri(), self::$routes)) {
            return $this->init(self::$routes[$this->request->uri()]);
        } else {
            foreach (self::$routes as $key => $val) {
                $pattern = "%^" . preg_replace('/{([a-zA-Z0-9]+)}/', '(?<$1>[0-9]+)', $key) . "$%";
                preg_match($pattern, $this->request->uri(), $matches);
                array_shift($matches);
                if ($matches) {
                    $arr[] = $val;
                    $arr[] = $matches;
                    return $this->init(...$arr);
                }
            }
        }
    }

    private function init($path, $vars = []) {
        [$controller, $action] = explode('@', $path);
        $controller = new $controller($this->request);
        return $controller->$action($vars);
    }

}