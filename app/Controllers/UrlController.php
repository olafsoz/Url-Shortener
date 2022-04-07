<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\UrlServices\Redirect\RedirectRequest;
use App\Services\UrlServices\Redirect\RedirectService;
use App\Services\UrlServices\Shorten\ShortenRequest;
use App\Services\UrlServices\Shorten\ShortenService;
use Psr\Container\ContainerInterface;

class UrlController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function shorten(): Redirect
    {
        $service = $this->container->get(ShortenService::class);
        $service->execute(new ShortenRequest($_POST['longUrl']));

        return new Redirect('/');
    }
    public function redirect($url): Redirect
    {
        $service = $this->container->get(RedirectService::class);
        $response = $service->execute(new RedirectRequest($url['url']));
        if ($response !== null) {
            header("Location: $response");
            exit;
        }
        return new Redirect('/');
    }
}