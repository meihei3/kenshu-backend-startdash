<?php

namespace App\Handler;

interface HandlerInterface
{
    public function run(array $req): array;
}