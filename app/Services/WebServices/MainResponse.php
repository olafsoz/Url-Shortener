<?php

namespace App\Services\WebServices;

class MainResponse
{
    private array $all;
    private string $port;
    private string $errors;

    public function __construct(array $all, string $port, string $errors)
    {
        $this->all = $all;
        $this->port = $port;
        $this->errors = $errors;
    }

    public function getErrors(): string
    {
        return $this->errors;
    }

    public function getAll(): array
    {
        return $this->all;
    }

    public function getPort(): string
    {
        return $this->port;
    }
}