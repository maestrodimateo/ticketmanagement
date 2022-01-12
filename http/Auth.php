<?php
namespace Http;

use App\Models\User;
use App\Models\Model;

class Auth
{
    private static $user = User::class;

    /**
     * check the user's credentials
     *
     * @param array $credentials
     * @return bool
     */
    public static function attempt(array $credentials): bool
    {
        self::check_credentials_keys($credentials);

        $user = new self::$user;

        $username = $user::$credentials[0];
        $password = $user::$credentials[1];

        $current_user = $user->findBy($username, $credentials[$username]);

        if (!$current_user) return false;

        if (!password_verify($credentials[$password], $current_user->{$password})) return false;

        Session::set('auth', $current_user);

        return true;
    }

    /**
     * Check if the user's credentials' keys are the same as form names
     *
     * @param array $credentials
     * @return void
     */
    private static function check_credentials_keys(array $credentials)
    {

        foreach (self::$user::$credentials as $property) {

            if (!array_key_exists($property, $credentials)) {
                throw new \Exception("La propriété {$property} n'existe pas dans le formulaire", 1);    
            }
        }
    }

    /**
     * Return the connected user
     *
     * @return Model|null
     */
    public static function user()
    {
        return Session::get('auth');
    }

    /**
     * Log out the user
     *
     * @return void
     */
    public static function logout()
    {
        Session::forget(['auth']);
    }
}