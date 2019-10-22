<?php

use DI\Bridge\Slim\Bridge as AppFactory;
use DI\ContainerBuilder;
use Slim\Views\Twig;

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/container.php');
$container = $builder->build();

$app = AppFactory::create($container);

require_once __DIR__ . '/../bootstrap/middleware.php';

require_once __DIR__ . '/../routes/web.php';

$app->run();
