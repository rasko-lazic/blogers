<?php

namespace Core;

use App\Models\User;

class Session {

    public function __construct()
    {
        session_start();
    }

    public static function check(): bool
    {
        return $_SESSION['loggedIn'] ?? false;
    }

    public static function getUserId(): int
    {
        return $_SESSION['userId'] ?? false;
    }

    public static function isAdmin(): bool
    {
        return true;
        if (self::getUserId()) {
            $user = User::fetchById(self::getUserId());
            return $user->isAdmin;
        }
        return false;
    }

    public static function getUser(): ?User
    {
        if (self::getUserId()) {
            return User::fetchById(self::getUserId());
        }
        return null;
    }

    public static function login($userId): void
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = (int) $userId;
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }
}