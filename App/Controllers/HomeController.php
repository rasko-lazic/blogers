<?php

namespace App\Controllers;

class HomeController {

    public function index(): void
    {
        include('./Views/Home.php');
    }
}