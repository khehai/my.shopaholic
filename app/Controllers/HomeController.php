<?php
require_once ROOT.'/core/Response.php';
class HomeController
{
    protected static string $layout = 'app';
    protected Response $response;
   

    public function __construct()
     {
        $this->response = new Response(static::$layout);
    }

    public function index()
     {
          $this->response->render ('/home/index');
    }
}
//  require_once realpath(ROOT.'/app/Views/home/index.php');  

    