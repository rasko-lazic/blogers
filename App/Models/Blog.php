<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Blog extends Model {

    protected $table = 'blogs';

    public $id;
    public $name;
    public $description;
    public $tags;
    public $ownerId;
    public $createdAt;
    public $updatedAt;

    private function getTags($id): array
    {
        $query = Database::getInstance()->prepare("SELECT tag_id FROM blog_tag WHERE blog_id = :blog_id");
        $query->execute(['blog_id' => $id]);
        $tagIds = $query->fetchAll();

        if (count($tagIds) > 0) {
            return Tag::select([
                ['id', 'IN', array_column($tagIds, 'tag_id')]
            ]);
        } else {
            return [];
        }
    }

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $blog = new Blog();
            $blog->id = $row['id'];
            $blog->name = $row['name'];
            $blog->description = $row['description'];
            $blog->tags = $this->getTags($row['id']);
            $blog->ownerId = $row['owner_id'];
            $blog->createdAt = $row['created_at'];
            $blog->updatedAt = $row['updated_at'];
            return $blog;
        }, $rows);
    }
}