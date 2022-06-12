<?php

namespace Core;

class Router
{
    private static array $routes = [];

    private static function serveDirs(): array
    {
        return [
            'assets'
        ];
    }

    public static function addRoute(string $uri, array $controllerAction): void
    {
        static::$routes[$uri] = $controllerAction;
    }

    public static function dispatch(string $requestUri): bool
    {
        if (array_key_exists($requestUri, static::$routes)) {
            [$controllerName, $actionName] = static::$routes[$requestUri];
            $controller = new $controllerName();
            $controller->$actionName();
            return true;
        }
        foreach (self::serveDirs() as $dir) {
            if (str_starts_with($requestUri, '/'.$dir.'/')) {
                return false;
            }
        }
        http_response_code(404);
        return true;
    }
}
