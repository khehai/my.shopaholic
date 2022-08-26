<?php 
namespace Core;

class Response 
{
    public array $headers;

    private string $content;
    private int $statusCode;
    private string $statusText;
    private string $version;
    private string $charset;

    private array $statusTexts = [
        200 => "All Ok",
        302 => "Resource Found",
        400 => "Bad Request",
        401 => "Unauttorized",
        403 => "Forbidden",
        404 => "Not Found",
        500 => "Internal Server Error"
    ];

    protected string $layout;

    public function __construct(string $layout, int $status = 200, array $headers = [])
    {
        $this->statusCode = $status;
        $this->statusText = $this->statusTexts[$status];
        $this->version = "1.0";
        $this->charset = "UTF-8";
        $this->headers = $headers;
        $this->layout = $layout;

        ob_start();
        require_once VIEWS."/layouts/$this->layout.php";
        $this->content = ob_get_clean();
    }

    private function send()
    {
        $this->sendHeaders();
        $this->sendContent();
        $this->flushBuffer();
        return $this;
    }

    private function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }
        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);

        if(!array_key_exists('Content-Type', $this->headers)) {
            header('Content-Type: '. 'text/html; charset='.$this->charset);
        }

        foreach ($this->headers as $name => $value){
            header($name.': '.$value, true, $this->statusCode);
        }
        return $this;
    }

    private function sendContent()
    {
        echo $this->content;
        return $this;
    }
    private function flushBuffer()
    {
        flush();
    }

    private function setContent(string $content="")
    {
        $this->content = $content;
        return $this;
    }

    public function render($view, $params=[])
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once VIEWS."/$view.php";
        $content = ob_get_clean();
        $rendered = str_replace('{{ content }}', $content, $this->content);
        $this->setContent($rendered);
        $this->send();
    }

    public static function redirect($location="")
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].$location);
        exit();
    }
}