<?php

namespace App\Controllers;

use Core\Session;
use App\Router;

class AuthController {

    public function login(): void
    {
        // TODO auth here
        Session::login(1);
        Router::redirect('/');
    }

    public function logout(): void
    {
        Session::logout();
        Router::redirect('/');
    }
}