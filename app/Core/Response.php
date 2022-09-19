<?php
namespace Core;


class Response {

    public array $headers;
    private string $content;
    private string $version;
    private int $statusCode;
    private string $statusText;
    private string $charset;
    
    protected string $layout;
    
    /**
     * Holds HTTP response statuses
     *
     * @var array
     */
    private array $statusTexts = [
        200 => 'ALL OK',
        302 => 'Found',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    /**
     * Constructor.
     *
     * @param string $content The response content
     * @param int    $status  The response status code
     * @param array  $headers An array of response headers
     *
     */
    public function __construct(string $layout, int $status = 200, array $headers = []){

        $this->statusCode = $status;
        $this->headers = $headers;
        $this->statusText = $this->statusTexts[$status];
        $this->version = '1.0';
        $this->charset = 'UTF-8';

        $this->layout = $layout;
     
        ob_start();
        require_once VIEWS."/layouts/$this->layout.php";
        $this->content = ob_get_clean();
    }

    /**
     * Flushes output buffers.
     *
     */
    private function flushBuffer(): void{
        flush();
    }

    /**
     * Sends HTTP headers.
     *
     * @return Response
     */
    private function sendHeaders(): self{
        // check headers have already been sent by the developer
        if (headers_sent()) {
            return $this;
        }
        // status
        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);
        // Content-Type
        // if Content-Type is already exists in headers, then don't send it
        if(!array_key_exists('Content-Type', $this->headers)){
            header('Content-Type: ' . 'text/html; charset=' . $this->charset);
        }
        // headers
        foreach ($this->headers as $name => $value) {
            header($name .': '. $value, true, $this->statusCode);
        }
        return $this;
    }

// http_response_code($newcode = NULL)
    function http_response_code($newcode = NULL)
    {
        static $code = 200;
        if($newcode !== NULL)
        {
            header('X-PHP-Response-Code: '.$newcode, true, $newcode);
            if(!headers_sent())
                $code = $newcode;
        }       
        return $code;
    }

    /**
     * Sends content for the current web response.
     *
     * @return Response
     */
    private function sendContent(): self{
        echo $this->content;
        return $this;
    }

    /**
     * Sets content for the current web response.
     * 
     * @param string $content The response content
     * @return Response
     */
    public function setContent(string $content = ""): self
    {
        $this->content = $content;
        return $this;
    }


    /**
     * Sends HTTP headers and content.
     *
     */
    public function send(): self{
        $this->sendHeaders();
        $this->sendContent();
        $this->flushBuffer();
        return $this;
    }

    public function render($view, $params = [])
    {
     	ob_start();

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        include_once VIEWS."/$view.php";

        $content = ob_get_clean();
        $rendered = str_replace('{{content}}', $content, $this->content);
        $this->setContent($rendered);
        $this->send();
    }

    public static function redirect($location = ""){
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $location);
        exit();
    }

    public static function back($location = ""){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

} 