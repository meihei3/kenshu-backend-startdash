<?php

namespace App\Handler;

use App\Http\Response;
use App\Http\ServerRequest;

interface HandlerInterface
{
    public function run(ServerRequest $req): Response;
}