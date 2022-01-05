<?php

namespace App\Controllers;

use App\Models\Image;
use App\Router;
use Core\Request;
use Core\Session;

class ImageController {

    const STORAGE_PATH = '/storage/images/';

    public function get($imageId)
    {

    }

    public function store(Request $request): void
    {
        $blogId = $request->get('blog', '');
        foreach ($_FILES['images']['name'] as $key => $imageName) {
            $imageId = uniqid();
            $extension = pathinfo(basename($imageName))['extension'];
            $fullMovePath = $_SERVER['DOCUMENT_ROOT'] . self::STORAGE_PATH . "$imageId.$extension";

            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $fullMovePath)) {
                Image::create([
                    'user_id' => Session::getUserId(),
                    'storage_uuid' => "$imageId.$extension",
                    'name' => strtolower(basename($imageName)),
                ]);
            }
        }

        Router::redirect("/blogs/$blogId/posts");
    }
}