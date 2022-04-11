<?php

namespace App\Services\WebServices;

class GetEverythingRequest
{
    private string $port;
    private string $errors;

    public function __construct(string $port, string $errors)
    {
        $this->port = $port;
        $this->errors = $errors;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getErrors(): string
    {
        return $this->errors;
    }
}