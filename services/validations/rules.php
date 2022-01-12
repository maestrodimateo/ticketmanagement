<?php

/**
 * All the form rules
 */
return [

    "required" => function ($value_name) {

        if ( empty($value_name) || is_null($value_name) ) {
            return "Champs obligatoire";
        }
    },

    "alpha" => function ($value_name) {

        $is_alpha = preg_match("/^[a-zA-Z ]+$/", $value_name);
        if ($is_alpha === false) {
            return "ce champs ne doit contenir que des lettres.";
        }
    },

    "email" => function ($value_name = null) {
        
        if(filter_var($value_name, FILTER_VALIDATE_EMAIL) === false) {
            return "Email invalide.";
        }
    },

    'required_if' => function ($value_name, string $condition) {

        if (!$condition) {
            throw new Exception("Il manque un paramètre à la règle required_if, exemple: required_if:false", 1);
        }
    
        if ($condition === "true") {
            
            if ( empty($value_name) || is_null($value_name) ) {
                return "Champs obligatoire";
            }
        }
    },

    "max" => function ($value_name, string $size) {
        if (!$size) {
            throw new Exception("Il manque un paramètre à la regle max, exemple: max:10", 1);
        }

        $size = (int) $size;

        if (strlen($value_name) >= $size) {
            return "La valeur ne doit pas être supérieure à $size.";
        }
    }

];