<?php

use App\Controllers\UrlController;
use App\Controllers\WebController;
use App\Redirect;
use App\Repositories\MySQLUrlRepository;
use App\Repositories\UrlRepository;
use App\View;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    UrlRepository::class => DI\create(MySQLUrlRepository::class)
]);
$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [WebController::class, 'main']);
    $r->addRoute('POST', '/shorten', [UrlController::class, 'shorten']);
    $r->addRoute('GET', '/{url}', [UrlController::class, 'redirect']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1][0];
        $vars = $routeInfo[1][1];

        $response = (new $handler($container))->$vars($routeInfo[2]);

        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);

        if ($response instanceof View) {
            try {
                echo $twig->render($response->getPath() . '.html', $response->getVariables());
            } catch (LoaderError|SyntaxError|RuntimeError $e) {
                echo $e->getMessage();
            }
        }
        if ($response instanceof Redirect) {
            header('Location: ' . $response->getLocation());
            exit;
        }
        break;
}
session_unset();
session_destroy();