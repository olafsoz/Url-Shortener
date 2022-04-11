<?php

namespace App\Repositories;

use App\Services\UrlServices\Redirect\RedirectRequest;
use App\Services\UrlServices\Shorten\ShortenRequest;
use App\Services\WebServices\GetEverythingRequest;

interface UrlRepository
{
    public function getEverything(GetEverythingRequest $request);
    public function shorten(ShortenRequest $request);
    public function redirect(RedirectRequest $request);
}