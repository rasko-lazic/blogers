<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\BlogController;
use App\Controllers\PostController;

class Router {

    private const BASE_URL = 'https://blogers.rasko-dev.website';

    private $url;

    private $query;

    private $method;

    public function __construct()
    {
        [$this->url, $this->query] = explode('?', $_SERVER['REQUEST_URI']) + ['/', ''];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->redirectToController();
    }

    private static function getRoutes(): array
    {
        return [
            'GET:/' => [HomeController::class, 'index'],
            'POST:/login' => [AuthController::class, 'login'],
            'GET:/logout' => [AuthController::class, 'logout'],
            'GET:/blogs' => [BlogController::class, 'index'],
            'GET:/blogs/?' => [BlogController::class, 'show'],
            'POST:/blogs' => [BlogController::class, 'store'],
            'GET:/blogs/?/posts' => [PostController::class, 'create'],
        ];
    }

    private function redirectToController(): void
    {
        try {
            $action = self::getRoutes()["{$this->method}:{$this->url}"];
        } catch (\Exception $e) {
            foreach (self::getRoutes() as $route => $action) {
                if (fnmatch($route, "{$this->method}:{$this->url}")) {
                    $this->goToAction($action);
                    return;
                }
            }
            throw new \InvalidArgumentException('Route not found', 404);
        }

        $this->goToAction($action);
    }

    private function goToAction(array $action): void
    {
        [$controller, $method] = $action;
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            $controller->$method();
        }
    }


    public static function redirect($path)
    {
        header('Location: ' . self::BASE_URL . $path);
    }
}