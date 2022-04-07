<?php

namespace App\Validation;

class UrlValidator
{
    public static function validate(string $url): bool
    {
        $result = filter_var($url, FILTER_VALIDATE_URL);
        $code = @get_headers($url);

        if (! $result) {
            $_SESSION['errors'] = 'The format is incorrect. Did you type https://www at the start?';
            return false;
        } elseif ($code[0] !== "HTTP/1.1 200 OK") {
            $_SESSION['errors'] = 'This Url does not exist';
            return false;
        } else {
            return true;
        }
    }
}