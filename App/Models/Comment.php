<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Comment extends Model {

    protected $table = 'comments';

    public $id;
    public $user;
    public $postId;
    public $text;
    public $createdAt;
    public $updatedAt;

    private function getUser($id): ?User
    {
        return User::fetchById($id);
    }

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $comment = new Comment();
            $comment->id = $row['id'];
            $comment->user = $this->getUser($row['user_id']);
            $comment->postId = $row['post_id'];
            $comment->text = $row['text'];
            $comment->createdAt = date('d/m/Y H:i',strtotime($row['created_at']));
            $comment->updatedAt = date('d/m/Y H:i',strtotime($row['updated_at']));
            return $comment;
        }, $rows);
    }
}