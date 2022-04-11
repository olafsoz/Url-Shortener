<?php

namespace App\Controllers;

use App\Services\WebServices\GetEverythingRequest;
use App\Services\WebServices\GetEverythingService;
use App\View;
use Psr\Container\ContainerInterface;

class WebController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function getEverything(): View
    {
        $service = $this->container->get(GetEverythingService::class);
        $response = $service->execute(new GetEverythingRequest($_SERVER['SERVER_PORT'], $_SESSION['errors'] ?? ''));

        return new View('main', [
            'all' => $response->getAll(),
            'host' => 'localhost',
            'port' => $response->getPort(),
            'errors' => $response->getErrors()
        ]);
    }
}