<?php

namespace App\Models;

use Core\Model;

class Blog extends Model {

    protected $table = 'blogs';

    public $id;
    public $name;
    public $ownerId;
    public $createdAt;
    public $updatedAt;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $blog = new Blog();
            $blog->id = $row['id'];
            $blog->name = $row['name'];
            $blog->ownerId = $row['owner_id'];
            $blog->createdAt = $row['created_at'];
            $blog->updatedAt = $row['updated_at'];
            return $blog;
        }, $rows);
    }
}