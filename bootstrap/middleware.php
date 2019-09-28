<?php

use Slim\Views\TwigMiddleware;

$app->addErrorMiddleware(true, false, false);

$app->add(TwigMiddleware::createFromContainer($app));
