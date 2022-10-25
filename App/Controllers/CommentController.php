<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Entity;
use App\Models\Post;
use App\Router;
use Core\Database;
use Core\Helpers;
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

    public function favorite(Request $request, $id): void
    {
        /** @var Comment $comment */
        $comment = Comment::fetchById($id);
        if (!Session::getUserId()) {
            Router::redirect("/{$comment->post->slug}#comments");
        }
        // MySQL actually ignores SELECT list when it's part of EXISTS subquery
        $query = Database::getInstance()->prepare('SELECT EXISTS (SELECT * FROM entity_like WHERE entity_id = :commentId AND user_id = :userId)');
        $query->execute(['commentId' => $id, 'userId' => Session::getUserId()]);
        $favoriteExists = array_values($query->fetch())[0] ?? false;

        if ($favoriteExists) {
            $query = Database::getInstance()->prepare('DELETE FROM entity_like WHERE entity_id = :commentId AND user_id = :userId');
            $queryResult = $query->execute(['commentId' => $id, 'userId' => Session::getUserId()]);
        } else {
            $query = Database::getInstance()->prepare("INSERT INTO entity_like VALUES (?, ?)");
            $queryResult = $query->execute([$id, Session::getUserId()]);
        }

        if ($queryResult) {
            Router::redirect("/{$comment->post->slug}#comments");
        }
    }

}