<?php

declare(strict_types=1);

namespace App\Core;

use ReflectionMethod;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $uri, callable|array $handler): void
    {
        $this->routes['GET'][$uri] = $handler;
    }

    public function post(string $uri, callable|array $handler): void
    {
        $this->routes['POST'][$uri] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo '404 - Oldal nem található';
            return;
        }

        if (is_callable($handler)) {
            $handler();
            return;
        }

        [$controller, $action] = $handler;

        $controllerInstance = new $controller();

        $reflection = new ReflectionMethod($controllerInstance, $action);

        $arguments = [];

        foreach ($reflection->getParameters() as $parameter) {

            $type = $parameter->getType();

            if ($type === null) {
                continue;
            }

            switch ($type->getName()) {

                case Request::class:
                    $arguments[] = new Request();
                    break;

                case Response::class:
                    $arguments[] = new Response();
                    break;
            }
        }

        $controllerInstance->$action(...$arguments);
    }
}