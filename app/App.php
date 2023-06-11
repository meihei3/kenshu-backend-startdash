<?php
declare(strict_types=1);

namespace App;

use App\Http\Response;
use App\Http\ServerRequestFactory;

class App
{
    public function run(): void
    {
        ob_start();

        $req = ServerRequestFactory::build();
        $handler = Route::resolve($req->method, $req->path);

        $res = $handler->handle($req);

        $this->emit($res);
    }

    public function emit(Response $response): void
    {
        ob_end_clean();

        http_response_code($response->status);
        foreach ($response->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        echo $response->body;
    }
}
