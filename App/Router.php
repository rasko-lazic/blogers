<?php

namespace App;

use App\Controllers\AdminController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\BlogController;
use App\Controllers\ImageController;
use App\Controllers\PostController;
use Core\Request;

class Router {

    private const BASE_URL = 'https://blogers.rasko-dev.website';

    private $url;

    private $query;

    private $method;

    public function __construct()
    {
        [$this->url, $this->query] = explode('?', $_SERVER['REQUEST_URI']) + ['/', ''];
        $this->method = $_SERVER['REQUEST_METHOD'];

        // _method field is used for simulation of PUT and DELETE requests
        if (isset($_POST['_method'])) {
            $this->method = $_POST['_method'];
            // Once we extracted the necessary information, we can drop the key
            unset($_POST['_method']);
        }

        $this->redirectToController();
    }

    private static function getRoutes(): array
    {
        return [
            'GET:/' => [HomeController::class, 'index'],
            'POST:/register' => [AuthController::class, 'register'],
            'POST:/login' => [AuthController::class, 'login'],
            'GET:/logout' => [AuthController::class, 'logout'],
            'POST:/posts/favorite/*' => [PostController::class, 'favorite'],
            'POST:/posts/*/comments' => [CommentController::class, 'store'],
            'DELETE:/posts/*' => [PostController::class, 'destroy'],
            'GET:/admin' => [AdminController::class, 'index'],
            'DELETE:/admin/user/*' => [AdminController::class, 'userDestroy'],
            'DELETE:/admin/blog/*' => [AdminController::class, 'blogDestroy'],
            'DELETE:/admin/post/*' => [AdminController::class, 'postDestroy'],
            'DELETE:/admin/comment/*' => [AdminController::class, 'commentDestroy'],
            'GET:/blogs' => [BlogController::class, 'index'],
            'GET:/blogs/*/posts' => [PostController::class, 'create'],
            'GET:/blogs/*' => [BlogController::class, 'show'],
            'POST:/blogs' => [BlogController::class, 'store'],
            'PUT:/blogs/*' => [BlogController::class, 'update'],
            'DELETE:/blogs/*' => [BlogController::class, 'destroy'],
            'POST:/images' => [ImageController::class, 'store'],
            'POST:/blogs/*/posts' => [PostController::class, 'store'],
            'GET:/*' => [PostController::class, 'show'],
        ];
    }

    private function redirectToController(): void
    {
        try {
            $action = self::getRoutes()["$this->method:$this->url"];
        } catch (\Exception $e) {
            foreach (self::getRoutes() as $route => $action) {
                if (fnmatch($route, "$this->method:$this->url")) {
                    $wildcardIndex = array_search('*', explode('/', $route));
                    $wildcardValue = explode('/', "$this->method:$this->url")[$wildcardIndex] ?? null;
                    $this->goToAction($action, $wildcardValue);
                    return;
                }
            }
            throw new \InvalidArgumentException('Route not found', 404);
        }

        $this->goToAction($action);
    }

    private function goToAction(array $action, $routeParameter = null): void
    {
        [$controller, $method] = $action;
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            if (in_array($this->method, ['GET', 'POST', 'PUT'])) {
                $controller->$method(new Request(), $routeParameter);
            } else {
                $controller->$method($routeParameter);
            }
        }
    }


    public static function redirect($path)
    {
        header('Location: ' . self::BASE_URL . $path);
        die();
    }
}