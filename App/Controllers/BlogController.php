<?php

namespace App\Controllers;

use App\Models\Blog;
use Core\Session;

class BlogController {

    public function index(): void
    {
        include('./Views/Blog/Index.php');
    }

    public function show(): void
    {
        include('./Views/Blog/Show.php');
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? null;
        Blog::create([
            'name' => $name,
            'owner_id' => Session::getUserId()
        ]);
    }

}