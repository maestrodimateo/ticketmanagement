<?php
namespace Http;

abstract class Session
{

    /**
     * Start the session
     *
     * @return void
     */
    public static function start()
    {
        session_start();
    }

    /**
     * Set the errors
     *
     * @param array $errors
     * @return void
     */
    public static function setErrors(array $errors)
    {
        $_SESSION['errors'] = $errors;
    }

    /**
     * Get the error
     *
     * @param string $name
     * @return string|none
     */
    public static function getError(string $name)
    {
        if (array_key_exists('errors', $_SESSION) &&
            array_key_exists($name, $_SESSION['errors'])) {
            
            return $_SESSION['errors'][$name];
        }
    }

    /**
     * Remove the session for a specific key
     *
     * @param string $key
     * @return void
     */
    public static function forget(array $keys)
    {
        foreach ($keys as $key) {

            if(array_key_exists($key, $_SESSION)) {
                unset($_SESSION[$key]);
            }
        }

    }

    /**
     * get the session value according to the key name
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Set a value into the session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Set a flash message
     *
     * @param string $message
     * @return void
     */
    public static function flash(string $message): void
    {
        $_SESSION['flash'] = $message;
    }

    /**
     * Check if the session has a key
     *
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

}