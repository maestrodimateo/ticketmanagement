<?php
namespace Http\Middlewares;

use Http\Auth;
use Http\Request;
use Http\Response;

/**
 * Middleware that checks if the user is connected
 */
class AdminMiddleware implements MiddlewareInterface
{
    public function handle(Request $request)
    {
        if (!Auth::user()->is_admin()) {

            return Response::redirect('/nouveau-ticket');
        }
    }
}