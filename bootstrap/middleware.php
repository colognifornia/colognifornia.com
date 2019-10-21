<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app->addErrorMiddleware(true, false, false);

$app->add(TwigMiddleware::createFromContainer($app, Twig::class));
