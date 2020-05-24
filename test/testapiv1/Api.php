<?php

// namespace ;

class Api
{
    // protected string $method;
    protected $request;


    public function __construct()
    {
        // $this->request = \parse_url(\urldecode($_SERVER['REQUEST_URI']));
        $this->request = \urldecode($_SERVER['REQUEST_URI']);
        $method = \strtolower($_SERVER['REQUEST_METHOD']);
        $this->$method();
    }


    public function get()
    {
        echo __METHOD__ . '<br>';

        if (\strpos('/api', $this->request)) {
            echo 'обращение к API';

            // $request = \explode('/api/v1/', $this->request);
            // $request = \explode('/', $request[1]);

            $body = $_GET;
            return \pr($body, '$body');
            // return json_encode($body, JSON_HEX_TAG | JSON_INVALID_UTF8_SUBSTITUTE);
        } else {
            $user = new User();
            require 'view.php';
        }
    }

    public function post()
    {
        echo __METHOD__ . '<br>';
        $body = (!empty($_POST)) ? $_POST : json_decode(file_get_contents('php://input'), true);
        if (isset($body['session'])) {
            foreach ($body['session'] as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    }

    public function put()
    {
        echo __METHOD__ . '<br>';
        /* PUT данные приходят в потоке ввода stdin */
        $putdata = fopen("php://input", "r");

        /* Открываем файл на запись */
        $fp = fopen("myputfile.ext", "w");

        /* Читаем 1 KB данных за один раз и пишем в файл */
        while ($data = fread($putdata, 1024))
            fwrite($fp, $data);

        /* Закрываем потоки */
        fclose($fp);
        fclose($putdata);
    }

    public function delete()
    {
        echo __METHOD__ . '<br>';
    }
}
