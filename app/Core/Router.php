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

        foreach ($this->routes[$method] as $route => $handler) {

            $pattern = preg_replace(
                '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
                '([^/]+)',
                $route
            );

            $pattern = '#^' . $pattern . '$#';

            if (!preg_match($pattern, $path, $matches)) {
                continue;
            }

            array_shift($matches);

            $this->invokeHandler($handler, $matches);

            return;
        }

        http_response_code(404);

        echo '404 - Oldal nem található';
    }

    private function invokeHandler(
        callable|array $handler,
        array $routeParameters = []
    ): void {

        if (is_callable($handler)) {

            $handler(...$routeParameters);

            return;
        }

        [$controller, $action] = $handler;

        $controllerInstance = new $controller();

        $reflection = new ReflectionMethod(
            $controllerInstance,
            $action
        );

        $arguments = [];

        $routeIndex = 0;

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

                case 'int':

                    $arguments[] = (int) $routeParameters[$routeIndex++];

                    break;

                case 'string':

                    $arguments[] = $routeParameters[$routeIndex++];

                    break;
            }
        }

        $controllerInstance->$action(...$arguments);
    }
}