<?php
declare(strict_types=1);

namespace App;

use App\Http\Response;
use App\Http\ServerRequestFactory;

class App
{
    public function run(): void
    {
        $handler = Route::getHandler($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        $req = ServerRequestFactory::build();

        $res = $handler->handle($req);

        $this->emit($res);
    }

    public function emit(Response $response): void
    {
        http_response_code($response->status);
        foreach ($response->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        echo $response->body;
    }
}
