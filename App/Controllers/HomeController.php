<?php

namespace App\Controllers;

class HomeController {

    public function index(): void
    {
        include('./Views/home.php');
    }
}