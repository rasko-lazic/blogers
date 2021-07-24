<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\BlogController;

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
            'GET:/blog' => [BlogController::class, 'create'],
            'POST:/blog' => [BlogController::class, 'store'],
        ];
    }

    private function redirectToController(): void
    {
        try {
            $route = self::getRoutes()["{$this->method}:{$this->url}"];
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Route not found', 404);
        }

        [$controller, $method] = $route;
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