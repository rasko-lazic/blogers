<?php

namespace App\Models;

use Core\Model;

class User extends Model {

    protected $table = 'users';

    public $id;
    public $firstName;
    public $lastName;
    public $username;
    public $email;
    public $createdAt;
    public $updatedAt;
    public $deletedAt;

    public function formatDatabaseData($rows): array
    {
        return array_map(function ($row) {
            $user = new User();
            $user->id = $row['id'];
            $user->firstName = $row['first_name'];
            $user->lastName = $row['last_name'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->createdAt = $row['created_at'];
            $user->updatedAt = $row['updated_at'];
            $user->deletedAt = $row['deleted_at'];
            return $user;
        }, $rows);
    }
}