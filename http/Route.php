<?php

namespace Http;

use DI\Container;
use Http\Middlewares\MiddlewareHandle;

class Route
{
    /**
     * The controller
     *
     * @var App\Controllers\Controller
     */
    private $controller;
    /**
     * The controller's method
     *
     * @var string
     */
    private $method;

    /**
     * The method's arguments
     *
     * @var array
     */
    private $params = [];

    /**
     * The route's path
     *
     * @var string
     */
    private $path;

    private $middleware = [];

    public static function create(string $path, array $action):Route
    {
        $instance = new self;
        $instance->path = trim($path, '/');
        $instance->controller = $action[0];
        $instance->method = $action[1];

        return $instance;
    }

    /**
     * Check if a registered route path corresponds to the current path request
     *
     * @param string $path
     * @return void
     */
    public function matches(string $path):bool
    {
        $path_pattern = preg_replace("/(:[a-z]+)/", "([a-zA-Z0-9\+-]+)", $this->path);
        $path_regex = "#^$path_pattern$#";
        $result = preg_match($path_regex, $path, $matches);

        unset($matches[0]);
        $this->params = $matches;

        return $result;
    }

    /**
     * Set the middleware
     *
     * @param array $names
     * @return void
     */
    public function setMiddleware(array $names)
    {
        $this->middleware = $names;
    }

    /**
     * Execute a controller's method
     *
     * @return void
     */
    public function executes(Request $request, Container $container, MiddlewareHandle $middleware)
    {
        if(!empty($this->middleware)) {

            $middleware->process($this->middleware);
        }

        $controller_instance = $container->get($this->controller);
        $controller_instance->init($request);

        $parameters = array_values($this->params);

        $container->call([$controller_instance, $this->method], $parameters);
    }
}