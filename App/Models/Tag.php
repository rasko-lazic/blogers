<?php

namespace App\Models;

use Core\Model;

class Tag extends Model {

    protected $table = 'tags';

    public $id;
    public $name;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $tag = new Tag();
            $tag->id = $row['id'];
            $tag->name = $row['name'];
            return $tag;
        }, $rows);
    }
}