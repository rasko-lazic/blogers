<?php

namespace App\Models;

use Core\Model;

class Post extends Model {

    protected $table = 'posts';

    public $id;
    public $blogId;
    public $userId;
    public $title;
    public $text;
    public $htmlText;
    public $headerImage;
    public $commentsEnabled;
    public $isDraft;
    public $isHidden;
    public $createdAt;
    public $updatedAt;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $post = new Post();
            $post->id = $row['id'];
            $post->blogId = $row['blog_id'];
            $post->userId = $row['user_id'];
            $post->title = $row['title'];
            $post->text = $row['text'];
            $post->htmlText = $row['html_text'];
            $post->headerImage = $row['header_image'];
            $post->commentsEnabled = $row['comments_enabled'];
            $post->isDraft = $row['is_draft'];
            $post->isHidden = $row['is_hidden'];
            $post->createdAt = $row['created_at'];
            $post->updatedAt = $row['updated_at'];
            return $post;
        }, $rows);
    }
}