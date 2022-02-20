<?php
namespace App\Controllers\Auth;

use Http\Auth;
use Http\Response;
use App\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Login page
     *
     * @return void
     */
    public function index()
    {
        return Response::render('sign-in');
    }

    /**
     * Connection to the application
     *
     * @return void
     */
    public function login()
    {
        $this->request->validate([
            'mail' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($this->request->getBody())) {

            return Response::redirect('/nouveau-ticket');
        }

        flash('Mail ou mot de passe incorrect');

        return Response::redirect('/');
    }

    /**
     * Log out the application
     *
     * @return void
     */
    public function logout()
    {
        Auth::logout();

        return Response::redirect('/');
    }
}