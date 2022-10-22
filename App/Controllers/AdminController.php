<?php

namespace App\Controllers;

use App\Router;
use Core\Session;

class AdminController {

    public function index(): void
    {
        if (!Session::getUser()->isAdmin) {
            Router::redirect('/');
        }
        include('./Views/Admin.php');
    }
}