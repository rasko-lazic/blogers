<?php

namespace App\Controllers;

use App\Libraries\Parsedown;

class PostController {

    public function create(): void
    {
        include('./Views/Post/Create.php');
    }

}