<?php
namespace Core;

class App 
{
    public function __construct()
    {
        Session::instance();
    }
    
    public function run()
    {
        (new Router(new Request(), ROOT.'/config/routes.php'))->run();
    }
}