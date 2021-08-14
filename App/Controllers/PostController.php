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

    /**
     * @throws \Exception
     */
    public function store(): void
    {
        // Let's strip any newline characters from the title
        $title = preg_replace('/\s+/', ' ', trim($_POST['title']));

        $entity = Entity::create([]);
        Post::create([
            'id' => $entity,
            'blog_id' => 1,
            'user_id' => Session::getUserId(),
            // In order to guarantee a unique slug, we add 10 random chars after the title
            'slug' => str_replace(' ', '-', strtolower($title))
                . '-' . bin2hex(random_bytes(5)),
            'title' => $title,
            'text' => $_POST['content'],
            'html_text' => (new Parsedown)->text($_POST['content']),
        ]);

        Router::redirect('/blogs/1');
    }
}