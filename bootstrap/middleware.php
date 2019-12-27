<?php

use Colognifornia\Web\Http\Controllers\Errors\HttpInternalServerErrorController;
use Colognifornia\Web\Http\Controllers\Errors\HttpNotFoundController;
use Colognifornia\Web\Http\Middleware\DetectAndSetUserLanguage;
use Colognifornia\Web\Http\Middleware\RemoveTrailingSlashFromUrl;
use Colognifornia\Web\Http\Middleware\SetSecurityHeaders;
use Colognifornia\Web\Config\Config;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Symfony\Component\Translation\Translator;

$app->addRoutingMiddleware();

$app->add(new RemoveTrailingSlashFromUrl());

$app->add(new SetSecurityHeaders());

$app->add(TwigMiddleware::createFromContainer($app, Twig::class));

$app->add(new DetectAndSetUserLanguage($container->get(Translator::class), $container->get(Config::class)));

$errorMiddleware = $app->addErrorMiddleware($container->get(Config::class)->get('app.debug'), true, true);

// Error Handlers
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (Request $request) use ($container) {
    return (new HttpNotFoundController($container->get(Twig::class), $container->get(Config::class)))
        ->index($request, (new Response())->withStatus(404));
});

$errorMiddleware->setDefaultErrorHandler(function (Request $request) use ($container) {
    return (new HttpInternalServerErrorController($container->get(Twig::class), $container->get(Config::class)))
        ->index($request, (new Response())->withStatus(500));
});
