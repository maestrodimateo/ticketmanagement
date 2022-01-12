<?php
namespace Http\Middlewares;

use Http\Auth;
use Http\Request;
use Http\Response;

/**
 * Middleware that checks if the user is connected
 */
class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request)
    {
        if (is_null(Auth::user())) {
            
            return Response::redirect('/');
        }
    }
}