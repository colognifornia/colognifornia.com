<?php

use Slim\Views\Twig;

$container = $app->getContainer();

$container->set('view', function () {
    return new Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);
});
