<?php

use Colognifornia\Web\Http\Controllers\Errors\HttpInternalServerErrorController;
use Colognifornia\Web\Http\Controllers\Errors\HttpNotFoundController;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app->addRoutingMiddleware();

$app->add(TwigMiddleware::createFromContainer($app, Twig::class));

$errorMiddleware = $app->addErrorMiddleware(false, true, true);

// Error Handlers
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (ServerRequestInterface $request) use ($container) {
    return (new HttpNotFoundController($container->get(Twig::class)))
        ->index($request, (new Response())->withStatus(404));
});

$errorMiddleware->setDefaultErrorHandler(function (ServerRequestInterface $request) use ($container) {
    return (new HttpInternalServerErrorController($container->get(Twig::class)))
        ->index($request, (new Response())->withStatus(500));
});
