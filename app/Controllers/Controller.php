<?php
namespace App\Controllers;

use Http\Request;
use Http\Response;

abstract class Controller
{
    protected $request;
    protected $layout = '';

    /**
     * initialize the controller
     *
     * @param Request $request
     * @return void
     */
    public function init(Request $request)
    {
        $this->request = $request;
        Response::setLayout($this->layout);
    }
}