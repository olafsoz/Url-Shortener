<?php

namespace App\Services\UrlServices\Redirect;

use App\Repositories\UrlRepository;

class RedirectService
{
    private UrlRepository $urlRepository;

    public function __construct(UrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }
    public function execute(RedirectRequest $request)
    {
        return $this->urlRepository->redirect($request);
    }
}