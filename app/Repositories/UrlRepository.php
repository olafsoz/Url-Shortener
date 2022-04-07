<?php

namespace App\Repositories;

use App\Models\Url;
use App\Services\UrlServices\Redirect\RedirectRequest;
use App\Services\UrlServices\Shorten\ShortenRequest;
use App\Services\WebServices\MainRequest;
use App\View;

interface UrlRepository
{
    public function main(MainRequest $request);
    public function shorten(ShortenRequest $request);
    public function redirect(RedirectRequest $request);
}