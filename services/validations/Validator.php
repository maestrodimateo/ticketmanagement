<?php
namespace Services\validations;

use Http\Response;
use Http\Session;

abstract class Validator
{
    /**
     * Check if the listed data respect the rules
     *
     * @param array $data
     * @param array $names_rules
     * @return void
     */
    public static function validates(array $form_body, array $names_rules)
    {
        $errors = [];

        $rules = require_once __DIR__ . '/rules.php';

        foreach ($names_rules as $name => $values) {
            foreach ($values as $value) {

                $rule_with_params = explode(':', $value);
                $rule_param = null;

                if (count($rule_with_params) == 2) {
                    $value = $rule_with_params[0];
                    $rule_param = $rule_with_params[1];
                }

                $rule = $rules[$value];
                $form_value = $form_body[$name];

                $message = $rule($form_value, $rule_param);

                if (is_string($message)) {

                    $errors[$name] = $message;
                    break;
                }

            }
        }
        if (!empty($errors)) {
            Session::setErrors($errors);
            Response::back();
            exit();            
        }
    }
}