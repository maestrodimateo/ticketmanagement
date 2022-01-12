<?php
namespace Http\Middlewares;

use Http\Auth;
use Http\Request;
use Http\Middlewares\MiddlewareInterface;
use Http\Response;

/**
 * Middleware that checks if the user is not connected
 */
class GuestMiddleware implements MiddlewareInterface
{
    public function handle(Request $request)
    {
        if (!is_null(Auth::user())) {

            return Response::redirect('/nouveau-ticket');
        }
    }
}