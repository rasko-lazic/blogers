<?php

namespace app;

class Router {

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
            'GET:/' => 'Home@index',
            'POST:/login' => 'AuthController@login',
        ];
    }

    private function redirectToController(): void
    {
        try {
            $route = self::getRoutes()["{$this->method}:{$this->url}"];
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Route not found', 404);
        }

        [$controller, $method] = explode('@', $route);
        $controller = new $controller();
        if (method_exists($controller, $method)) {
            $controller->$method();
        }

    }
}