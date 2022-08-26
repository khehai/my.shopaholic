<?php 
namespace Core;

class Controller
{
    protected static string $layout = '';

    protected Response $response;
    protected Request $request;
    
    public function __construct(Request $request=null)
    {
        $this->request = $request ?? new Request();
        $this->response = new Response(static::$layout);
    }
}