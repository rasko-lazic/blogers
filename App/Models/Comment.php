<?php

namespace App\Models;

use Core\Database;
use Core\Model;
use Core\Session;

class Comment extends Model {

    protected $table = 'comments';

    public $id;
    public $user;
    public $postId;
    public $post;
    public $text;
    public $isFavorite;
    public $favoriteCount;
    public $createdAt;
    public $updatedAt;

    private function getUser($id): ?User
    {
        return User::fetchById($id);
    }

    private function getPost($id): ?Post
    {
        return Post::fetchById($id);
    }

    private function getIsFavorite($commentId): bool
    {
        $query = Database::getInstance()->prepare('SELECT EXISTS (SELECT * FROM entity_like WHERE entity_id = :commentId AND user_id = :userId)');
        $query->execute(['commentId' => $commentId, 'userId' => Session::getUserId()]);
        return array_values($query->fetch())[0] ?? false;
    }

    private function getFavoriteCount($commentId): int
    {
        $query = Database::getInstance()->prepare('SELECT count(*) FROM entity_like WHERE entity_id = :commentId');
        $query->execute(['commentId' => $commentId]);
        return (int)array_values($query->fetch())[0] ?? 0;
    }

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->user = $this->getUser($row['user_id']);
            $comment->postId = $row['post_id'];
            $comment->post = $this->getPost($row['post_id']);
            $comment->text = $row['text'];
            $comment->isFavorite = $this->getIsFavorite($row['id']);
            $comment->favoriteCount = $this->getFavoriteCount($row['id']);
            $comment->createdAt = date('d/m/Y H:i',strtotime($row['created_at']));
            $comment->updatedAt = date('d/m/Y H:i',strtotime($row['updated_at']));
            return $comment;
        }, $rows);
    }
}