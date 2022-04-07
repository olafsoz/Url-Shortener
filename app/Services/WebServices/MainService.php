<?php

namespace App\Services\WebServices;

use App\Repositories\MySQLUrlRepository;
use App\Repositories\UrlRepository;

class MainService
{
    private UrlRepository $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function execute(MainRequest $request): MainResponse
    {
        return $this->urlRepository->main($request);
    }
}