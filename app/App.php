<?php
declare(strict_types=1);

namespace App;

class App
{
    public function run()
    {
        $handler = Route::getHandler($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

        $req = [
            'method' => $_SERVER['REQUEST_METHOD'],
            'path' => $_SERVER['REQUEST_URI'],
            'get' => $_GET,
            'post' => $_POST,
        ];

        $res = $handler->run($req);

        http_response_code($res['status_code']);
        header('Content-Type: text/html; charset=utf-8');
        echo $res['body'];
    }
}
