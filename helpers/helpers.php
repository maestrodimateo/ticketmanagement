<?php

use App\Models\Model;
use Http\Auth;
use Http\Session;

if (! function_exists('env')) {

    /**
     * Get all the environnement variables
     *
     * @param string $name
     * @return void
     */
    function env(string $name)
    {
        $capitalized = strtoupper($name);
        return $_ENV[$capitalized];
    }
}

if (! function_exists('get_file_content')) {

    /**
     * Get a file content
     *
     * @param string $file
     * @return void
     */
    function get_file_content(string $file, array $data): string {
        extract($data);
        ob_start();
        require $file;
        return ob_get_clean();
    }
}

if (! function_exists('error')) {

    /**
     * Get the form errors
     *
     * @param string $name
     * @return string|null
     */
    function error(string $message)
    {
        $match = preg_match("/{[a-zA-Z]+}/", $message, $matches);

        if ($match !== 0) {
            $name = rtrim(ltrim($matches[0], "{"), "}");
            $error = Session::getError($name);

            if (!is_null($error)) {

                return preg_replace("/{[a-zA-Z]+}/", $error, $message);
            }

            return null;
        }
    }
}

if (! function_exists('includes')) {

    /**
     * Inlcude view partials
     *
     * @param string $path
     * @return void
     */
    function includes(string $path, array $data = [])
    {
        extract($data);
        require VIEWS . $path . '.html.php';
    }
}

if (! function_exists('flash')) {

    /**
     * Set a flash message
     *
     * @param string $message
     * @return void
     */
    function flash(string $message)
    {
        Session::flash($message);
    }
}

if (! function_exists('session')) {

    /**
     * get a session value
     *
     * @param string $key
     * @return void
     */
    function session(string $key)
    {
        return Session::get($key);
    }
}

if (! function_exists('auth')) {

    /**
     * get an auth value
     *
     * @param string $key
     * @return Model|null
     */
    function auth()
    {
        return Auth::user();
    }
}