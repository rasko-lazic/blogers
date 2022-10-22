<?php

namespace App\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Router;
use Core\Session;

class AdminController {

    public function index(): void
    {
        if (!Session::getUser()->isAdmin) {
            Router::redirect('/');
        }

        $users = User::select([]);
        $blogs = Blog::select([]);
        $posts = Post::select([]);
        $comments = Comment::select([]);

        include('./Views/Admin.php');
    }

    public function userDestroy($id): void
    {
        $deleteSuccessful = User::delete($id);
        if ($deleteSuccessful) {
            Router::redirect("/admin");
        }
    }

    public function blogDestroy($id): void
    {
        $deleteSuccessful = Blog::delete($id);
        if ($deleteSuccessful) {
            Router::redirect("/admin#blog");
        }
    }

    public function postDestroy($id): void
    {
        $deleteSuccessful = Post::delete($id);
        if ($deleteSuccessful) {
            Router::redirect("/admin#post");
        }
    }

    public function commentDestroy($id): void
    {
        $deleteSuccessful = Comment::delete($id);
        if ($deleteSuccessful) {
            Router::redirect("/admin#comment");
        }
    }
}