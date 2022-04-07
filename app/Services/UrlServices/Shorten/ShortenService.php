<?php

namespace App\Services\UrlServices\Shorten;

use App\Repositories\UrlRepository;

class ShortenService
{
    private UrlRepository $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }
    public function execute(ShortenRequest $request)
    {
        return $this->urlRepository->shorten($request);
    }
}