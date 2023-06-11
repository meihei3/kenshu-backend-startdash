<?php
declare(strict_types=1);

namespace App\Http;

class Session
{
    private static Session $instance;

    public static function getInstance(): Session
    {
        if (!isset(self::$instance)) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->start();
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        session_start();
    }

    public function clear(): void
    {
        session_unset();
    }

    public function refresh(): void
    {
        session_regenerate_id(true);
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
}