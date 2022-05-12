<?php

namespace App\Controllers;

class AdminController {

    public function index(): void
    {
        include('./Views/Admin.php');
    }
}