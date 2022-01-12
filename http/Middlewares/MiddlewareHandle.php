<?php
namespace Http\Middlewares;

use Http\Request;

class MiddlewareHandle
{
    private $middlewares = [
        "auth" => AuthMiddleware::class,
        "guest" => GuestMiddleware::class,
        "is_admin" => AdminMiddleware::class,
    ];
    
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Process the different middlewares
     *
     * @param array $middlewares
     * @return void
     */
    public function process(array $middlewares)
    {
        $called_middlewares = array_filter($this->middlewares, function($value, $index) use ($middlewares){
            return in_array($index, $middlewares);
        }, ARRAY_FILTER_USE_BOTH);

        if (!empty($called_middlewares)) {
            foreach ($called_middlewares as $middleware) {
                $instance = new $middleware;
                call_user_func([$instance, 'handle'], $this->request);
            }
        }
    }
}