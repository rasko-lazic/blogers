<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Entity;
use App\Models\Post;
use App\Router;
use Core\Request;
use Core\Session;

class CommentController {

    /**
     * @throws \Exception
     */
    public function store(Request $request, $postId): void
    {
        $entityId = Entity::create([]);
        Comment::create([
            'id' => $entityId,
            'user_id' => Session::getUserId(),
            'post_id' => $postId,
            'text' => $request->get('text', ''),
        ]);

        $post = Post::fetchById($postId);

        Router::redirect("/$post->slug#comments");
    }
}