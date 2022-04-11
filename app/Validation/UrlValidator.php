<?php

namespace App\Validation;

class UrlValidator
{
    public static function validate(string $url): bool
    {
        $result = filter_var($url, FILTER_VALIDATE_URL);
        $code = @get_headers($url);

        if (! $result) {
            $_SESSION['errors'] = 'The format is incorrect. Did you type https:// at the start?';
            return false;
        } elseif (is_bool($code)) {
            $_SESSION['errors'] = 'This Url does not exist/you do not have access to it';
            return false;
        } else {
            return true;
        }
    }
}