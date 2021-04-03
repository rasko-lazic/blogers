<?php

namespace Core;

class Session {

    public function __construct()
    {
        session_start();
    }

    public static function check(): bool
    {
        return $_SESSION['loggedIn'] ?? false;
    }

    public static function login($userId): void
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $userId;
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }
}