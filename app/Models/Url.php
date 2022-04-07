<?php

namespace App\Models;

class Url
{
    protected string $longUrl;
    protected string $shortUrl;
    protected int $id;

    public function __construct(string $longUrl, string $shortUrl, int $id = null)
    {
        $this->longUrl = $longUrl;
        $this->shortUrl = $shortUrl;
        $this->id = $id;
    }

    public function getLongUrl(): string
    {
        return $this->longUrl;
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}