<?php

namespace App\Controllers;

use App\Models\Blog;
use App\Models\Entity;
use App\Models\Post;
use App\Models\Tag;
use App\Router;
use Core\Database;
use Core\Request;
use Core\Session;

class BlogController {

    public function index(): void
    {
        $blogs = Blog::select([
            ['owner_id', '=', Session::getUserId()]
        ]);
        include('./Views/Blog/Index.php');
    }

    public function show(Request $request, $blogId): void
    {
        $draftPosts = Post::select([
            ['blog_id', '=', $blogId],
            ['is_draft', '=', 1],
        ]);
        $publishedPosts = Post::select([
            ['blog_id', '=', $blogId],
            ['is_draft', '=', 0],
        ]);
        include('./Views/Blog/Show.php');
    }

    public function store(Request $request): void
    {
        $entityId = Entity::create([]);
        Blog::create(array_merge(
            [
                'id' => $entityId,
                'owner_id' => Session::getUserId()
            ],
            $request->only(['name', 'description'])
        ));

        $this->storeTags($entityId, explode(',', $request->get('tags', '')));

        if ($entityId > 0) {
            Router::redirect('/blogs');
        }
    }

    public function update(Request $request, $id): void
    {
        $updateSuccessful = Blog::update($id, $request->only(['name', 'description']));

        $query = Database::getInstance()->prepare("DELETE FROM blog_tag WHERE blog_id = ?");
        $query->execute([$id]);

        $this->storeTags($id, explode(',', $request->get('tags', '')));

        if ($updateSuccessful) {
            Router::redirect('/blogs');
        }
    }

    public function destroy($id): void
    {
        $deleteSuccessful = Blog::delete($id);
        if ($deleteSuccessful) {
            Router::redirect('/blogs');
        }
    }

    private function storeTags($id, $tags): void
    {
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                if (strlen(trim($tag)) === 0) continue;
                $storedTags = Tag::select([
                    ['LOWER(name)', 'LIKE', strtolower($tag)],
                ]);

                if (count($storedTags) > 0) {
                    $tagId = $storedTags[0]->id;
                } else {
                    $tagId = Tag::create(['name' => $tag]);
                }
                $query = Database::getInstance()->prepare("INSERT INTO blog_tag VALUES (?, ?)");
                $query->execute([$id, $tagId]);
            }
        }
    }
}