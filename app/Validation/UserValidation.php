<?php

namespace App\Validation;

class UserValidation
{
    public static function validateName($name)
    {
        if (empty($name)) {
            return "Name is required.";
        } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            return "Only letters and white space allowed in name.";
        }
        return null;
    }

    public static function validateEmail($email)
    {
        if (empty($email)) {
            return "Email is required.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }

        return null;
    }
}