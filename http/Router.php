<?php
namespace Http;

use DI\Container;

class Router
{
    private $routes = [];

    /**
     * Register a get route
     *
     * @param string $path
     * @param array $action
     * @return void
     */
    public function get(string $path, array $action)
    {
        return $this->setRoute($path, $action);
    }

    /**
     * Registers a post route
     *
     * @param string $path
     * @param array $action
     * @return void
     */
    public function post(string $path, array $action)
    {
        return $this->setRoute($path, $action, 'POST');
    }

    /**
     * Groups multiple routes
     *
     * @param array $options
     * @param array $execute
     * @return void
     */
    public function group(array $options, array $routes)
    {
        if (array_key_exists('middlewares', $options)) {
            foreach ($routes as $route) {
                $route->setMiddleware($options['middlewares']);
            }
        }
    }

    /**
     * Register a route as per its method type
     *
     * @param string $path
     * @param array $action
     * @param string $method
     * @return void
     */
    private function setRoute(string $path, array $action, string $method = "GET")
    {
        $route = Route::create($path, $action);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function run(Request $request, Container $container)
    {
        foreach ($this->routes[$request->getMethod()] as $route) {
            if ($route->matches($request->getPath())) {
                $container->call([$route, 'executes']);
                return;
            }
        }

        header("HTTP/1.1 404 Not Found");
    }
}