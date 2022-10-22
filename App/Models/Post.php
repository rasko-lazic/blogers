<?php

namespace App\Models;

use Core\Database;
use Core\Model;
use Core\Session;

class Post extends Model {

    protected $table = 'posts';

    public $id;
    public $blogId;
    public $userId;
    public $slug;
    public $title;
    public $text;
    public $htmlText;
    public $headerImage;
    public $commentsEnabled;
    public $isDraft;
    public $isHidden;
    public $createdAt;
    public $updatedAt;

    public $isFavorite = false;
    public $user = null;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $post = new Post();
            $post->id = $row['id'];
            $post->blogId = $row['blog_id'];
            $post->userId = $row['user_id'];
            $post->user = $this->getUser($row['user_id']);
            $post->slug = $row['slug'];
            $post->title = $row['title'];
            $post->text = $row['text'];
            $post->htmlText = $row['html_text'];
            $post->headerImage = $row['header_image'];
            $post->commentsEnabled = $row['comments_enabled'];
            $post->isDraft = $row['is_draft'];
            $post->isHidden = $row['is_hidden'];
            $post->isFavorite = $this->getIsFavorite($row['id']);
            $post->createdAt = date('d/m/Y',strtotime($row['created_at']));
            $post->updatedAt = date('d/m/Y',strtotime($row['updated_at']));
            return $post;
        }, $rows);
    }

    private function getIsFavorite($postId): bool
    {
        $query = Database::getInstance()->prepare('SELECT EXISTS (SELECT * FROM entity_like WHERE entity_id = :postId AND user_id = :userId)');
        $query->execute(['postId' => $postId, 'userId' => Session::getUserId()]);
        return array_values($query->fetch())[0] ?? false;
    }

    private function getUser($id): ?User
    {
        return User::fetchById($id);
    }
}