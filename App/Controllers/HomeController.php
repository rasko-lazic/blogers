<?php

namespace App\Controllers;

use App\Models\Post;

class HomeController {

    public function index(): void
    {
        $topPosts = (new Post())->runQuery('SELECT * FROM posts ORDER BY RAND() LIMIT 6', []);
        $latestPosts = (new Post())->runQuery('SELECT * FROM posts ORDER BY created_at DESC LIMIT 8', []);
        include('./Views/Home.php');
    }
}