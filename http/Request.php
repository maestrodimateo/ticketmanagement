<?php
namespace Http;

use Services\validations\Validator;

class Request
{
    private $path;
    private $method;
    /**
     * Body request
     *
     * @var array
     */
    private $body = [];
    private $files = [];

    public static function createFromGlobals()
    {
        $instance = new self;
        $instance->path = trim($_GET['url'], '/');
        $instance->method = $_SERVER['REQUEST_METHOD'];
        $instance->setBody();
        $instance->keep_url();
        return $instance;
    }

    /**
     * Set the body of the request
     *
     * @return void
     */
    private function setBody()
    {
        if (empty($_POST)) return;

        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                $this->body[$key] = $value;
                continue;
            }

            $this->body[$key] = trim(htmlspecialchars($value));
        }
    }

    /**
     * Get all the values from a form
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * Get the path of the current request
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get the method of the current request
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Validate post data
     *
     * @param array $rules
     * @return void
     */
    public function validate(array $rules)
    {
        return Validator::validates($this->body, $rules);
    }

    /**
     * Keep the current url
     *
     * @return void
     */
    private function keep_url()
    {
        if ( $this->method === "GET" && !$this->isAjax()) {
            Session::set('back', $this->path);
        }
    }

    /**
     * Check if the request is an ajax request
     *
     * @return boolean
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    }
}