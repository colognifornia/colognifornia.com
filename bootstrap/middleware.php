<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app->add(TwigMiddleware::createFromContainer($app, Twig::class));
