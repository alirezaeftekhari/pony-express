<?php

namespace Core;

class Router
{
    private static array $routes = [];

    /**
     * Router serveDirs.
     * @return array
     */
    private static function serveDirs(): array
    {
        return [
            'assets'
        ];
    }

    /**
     * Router addRoute.
     * @param string $uri
     * @param array $controllerAction
     * @return void
     */
    public static function addRoute(string $uri, array $controllerAction): void
    {
        static::$routes[$uri] = $controllerAction;
    }

    /**
     * Router dispatch.
     * @param string $requestUri
     * @return bool
     */
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
