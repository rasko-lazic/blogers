<?php

namespace App\Models;

use Core\Model;

class Entity extends Model {

    protected $table = 'entities';

    public $id;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $entity = new Entity();
            $entity->id = $row['id'];
            return $entity;
        }, $rows);
    }
}