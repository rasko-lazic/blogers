<?php

namespace Core;

class Request {

    private $parameters;

    // This object is constructed during routing process
    public function __construct()
    {
        // Let's just make a snapshot of current state of $_POST
        $this->parameters = $_POST;
    }

    public function all(): array
    {
        return $this->parameters;
    }

    public function only(array $keys): array
    {
        return array_intersect_key($this->parameters, array_flip($keys));
    }

    public function get($key, $default)
    {
        return $this->parameters[$key] ?? $default;
    }
}