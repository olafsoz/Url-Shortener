<?php

namespace App\Services\UrlServices\Redirect;

class RedirectRequest
{
    private string $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}