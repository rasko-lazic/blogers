<?php

namespace App\Controllers;

use App\Libraries\Parsedown;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Entity;
use App\Models\Image;
use App\Models\Post;
use App\Router;
use Core\Request;
use Core\Session;

class PostController {

    public function show($slug): void
    {
        // Fetching by id if integer is used instead of slug
        $column = is_numeric($slug) ? 'id' : 'slug';
        $post = Post::select([
            [$column, '=', urldecode($slug)]
        ])[0];

        $blog = Blog::fetchById($post->blogId);
        $comments = Comment::select([
            ['post_id', '=', $post->id],
        ]);

        include('./Views/Post/Show.php');
    }

    public function create($blogId): void
    {
        $images = Image::select([
            ['user_id', '=', Session::getUserId()]
        ]);
        include('./Views/Post/Create.php');
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request, $blogId): void
    {
        // Let's strip any newline characters from the title
        $title = preg_replace('/\s+/', ' ', trim($request->get('title', '')));

        $entityId = Entity::create([]);
        Post::create([
            'id' => $entityId,
            'blog_id' => $blogId,
            'user_id' => Session::getUserId(),
            // In order to guarantee a unique slug, we add 10 random chars after the title
            'slug' => str_replace(' ', '-', strtolower($title)) . '-' . bin2hex(random_bytes(5)),
            'title' => $title,
            'text' => $request->get('content', ''),
            'html_text' => (new Parsedown)->text($request->get('content', '')),
        ]);

        Router::redirect("/blogs/$blogId");
    }

    public function destroy($id): void
    {
        $blogId = Post::fetchById($id)->blogId ?? null;
        $deleteSuccessful = Post::delete($id);
        if ($deleteSuccessful) {
            Router::redirect("/blogs/$blogId");
        }
    }

}