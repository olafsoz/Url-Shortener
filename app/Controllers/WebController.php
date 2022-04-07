<?php

namespace App\Controllers;

use App\Services\WebServices\MainRequest;
use App\Services\WebServices\MainService;
use App\View;
use Psr\Container\ContainerInterface;

class WebController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function main(): View
    {
        $service = $this->container->get(MainService::class);
        $response = $service->execute(new MainRequest($_SERVER['SERVER_PORT'], $_SESSION['errors'] ?? ''));

        return new View('main', [
            'all' => $response->getAll(),
            'host' => 'localhost',
            'port' => $response->getPort(),
            'errors' => $response->getErrors()
        ]);
    }
}