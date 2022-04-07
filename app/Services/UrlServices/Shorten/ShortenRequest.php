<?php

namespace App\Services\UrlServices\Shorten;

class ShortenRequest
{
    private string $longUrl;

    public function __construct(string $longUrl)
    {
        $this->longUrl = $longUrl;
    }

    public function getLongUrl(): string
    {
        return $this->longUrl;
    }
}