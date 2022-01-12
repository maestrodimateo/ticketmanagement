<?php
namespace Http\Middlewares;

use Http\Request;

interface MiddlewareInterface
{
    public function handle(Request $request);
}