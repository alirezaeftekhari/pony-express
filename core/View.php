<?php

namespace Core;

use Exception;

class View
{
    /**
     * Router dispatch.
     * @param string $view
     * @param array $parameters
     * @return string
     * @throws Exception
     */
    public static function render(string $view, array $parameters = []): string
    {
        $viewPath = __DIR__.'/../app/Views/'.$view.'.html';
        if (!file_exists($viewPath)) {
            throw new Exception('View not found');
        }
        return preg_replace_callback(
            '/{{ (.*?) }}/',
            function ($parameter) use ($parameters) {
                return $parameters[$parameter[1]] ?? '';
            },
            file_get_contents($viewPath)
        );
    }
}
