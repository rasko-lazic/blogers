<?php

namespace App\Controllers;

use App\Models\Blog;
use Core\Session;

class BlogController {

    public function create(): void
    {
        include('./Views/Blog.php');
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