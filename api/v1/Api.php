<?php

// namespace ;

class Api
{
    // protected string $method;
    protected array $request;


    public function __construct()
    {
        $this->request = \parse_url(\urldecode($_SERVER['REQUEST_URI']));

        self::dispatch($this->request['path']);

        // $method = \strtolower($this->method = $_SERVER['REQUEST_METHOD']);
        $method = \strtolower($_SERVER['REQUEST_METHOD']);
        $this->$method();
    }

    public function get()
    {
        $body = $_GET;
        return \pr($body, '$body');
        // return json_encode($body, JSON_HEX_TAG | JSON_INVALID_UTF8_SUBSTITUTE);
    }

    public function post()
    {
        $body = (!empty($_POST)) ? $_POST : json_decode(file_get_contents('php://input'), true);
        if (isset($body['session'])) {
            foreach ($body['session'] as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
        // return print_r($body);
        // return \pr($body, '$body');
        // return json_encode($body, JSON_HEX_TAG | JSON_INVALID_UTF8_SUBSTITUTE);
        print_r($_SESSION);
        // echo json_encode($body);
    }

    private static function dispatch(string $request)
    {
        $request = \explode('/api/v1/', $request);
        $request = \explode('/', $request[1]);
    }
}
