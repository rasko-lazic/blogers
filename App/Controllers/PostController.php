<?php

namespace App\Controllers;

use App\Libraries\Parsedown;
use App\Models\Entity;
use App\Models\Post;
use App\Router;
use Core\Session;

class PostController {

    public function create(): void
    {
        include('./Views/Post/Create.php');
    }

    public function store(): void
    {
        $entity = Entity::create([]);

        Post::create([
            'id' => $entity,
            'blog_id' => 1,
            'user_id' => Session::getUserId(),
            'title' => $_POST['title'],
            'text' => $_POST['content'],
            'html_text' => (new Parsedown)->text($_POST['content']),
        ]);

        Router::redirect('/blogs/1');
    }
}