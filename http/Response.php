<?php
namespace Http;

use Http\Session;

class Response
{
    private static $layout;

    /**
     * Render the view without layout
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function render(string $view, array $data = [])
    {
        extract($data);
        
        $view_file =  self::check_file($view);
        
        require_once $view_file;
        
        Session::forget(['errors', 'flash']);
    }

    /**
     * Render the view with its layout
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function render_withLayout(string $view, array $data = [])
    {
        $view_file =  self::check_file($view);

        $content = get_file_content($view_file, $data);

        require_once VIEWS . self::$layout . VIEW_EXTENSION;

        Session::forget(['errors', 'flash']);
    }

    /**
     * Check if the view exists
     *
     * @param string $view
     * @return string
     */
    private static function check_file(string $view)
    {
        $view_file = VIEWS . $view . VIEW_EXTENSION;
        if (!file_exists($view_file)) throw new \Exception("Le ficher {$view_file} n'existe pas", 1);
        return $view_file;
    }

    /**
     * Redirect to the corresponding
     *
     * @param string $path
     * @param integer $status_code
     * @return void
     */
    public static function redirect(string $path = '/', int $status_code = 302)
    {
        http_response_code($status_code);
        header("Location: $path");
    }

    /**
     * Set the layout if it exists
     *
     * @param string $layout
     * @return void
     */
    public static function setLayout(string $layout):void
    {
        self::$layout = $layout;
    }

    /**
     * Return back
     *
     * @param integer $code
     * @return void
     */
    public static function back(int $code = 302)
    {
        http_response_code($code);
        $path = array_pop(explode('/', $_SERVER['HTTP_REFERER']));
        header("Location: /$path");
    }

    /**
     * Return a json response
     *
     * @param array $values
     * @return void
     */
    public static function json(array $values)
    {
        header('Content-Type:application/json');

        echo json_encode($values);
    }

}