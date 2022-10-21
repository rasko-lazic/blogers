<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Core\Request;

class HomeController {

    public function index(Request $request): void
    {
        $tags = array_slice(Tag::select([]), 0, 10);
        $topPosts = (new Post())->runQuery('SELECT * FROM posts ORDER BY RAND() LIMIT 6', []);

        $requestedTag = $request->get('tag', null);
        if ($requestedTag === null) {
            $latestPosts = (new Post())->runQuery('SELECT * FROM posts ORDER BY created_at DESC LIMIT 8', []);
        } else {
            $latestPosts = (new Post())->runQuery(
                'SELECT posts.* FROM posts 
                    LEFT JOIN blog_tag ON blog_tag.blog_id = posts.blog_id  
                    WHERE blog_tag.tag_id = :tagId
                    ORDER BY created_at DESC LIMIT 8',
                ['tagId' => $requestedTag]
            );
        }
        include('./Views/Home.php');
    }
}