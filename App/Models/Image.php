<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Image extends Model {

    protected $table = 'images';

    public $id;
    public $userId;
    public $storageUuid;
    public $name;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $image = new Image();
            $image->id = $row['id'];
            $image->userId = $row['user_id'];
            $image->storageUuid = $row['storage_uuid'];
            $image->name = $row['name'];
            return $image;
        }, $rows);
    }
}