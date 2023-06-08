<?php
declare(strict_types=1);

namespace App\Handler;

use App\Http\Response;
use App\Http\ServerRequest;

interface RequestHandlerInterface
{
    public function handle(ServerRequest $req): Response;
}