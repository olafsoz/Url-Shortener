<?php

namespace App\Services\WebServices;

use App\Repositories\MySQLUrlRepository;
use App\Repositories\UrlRepository;

class GetEverythingService
{
    private UrlRepository $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function execute(GetEverythingRequest $request): GetEverythingResponse
    {
        return $this->urlRepository->getEverything($request);
    }
}