<?php

use Slim\Views\Twig;

return [
    Twig::class => DI\autowire(Twig::class)
        ->constructor(__DIR__ . '/../resources/views', [
            'cache' => false,
        ]),
];
