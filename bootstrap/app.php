<?php

use Colognifornia\Web\Session\Session;
use Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\SymfonyTranslatorTwigExtension;
use Symfony\Component\Translation\Translator;
use DI\Bridge\Slim\Bridge as AppFactory;
use DI\ContainerBuilder;
use Slim\Views\Twig;

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/container.php');
$container = $builder->build();

$app = AppFactory::create($container);

Session::start([
    'cookie_secure' => getenv('GOOGLE_CLOUD_PROJECT') ? true : false,
]);

$container->get(Twig::class)->getEnvironment()->addExtension(
    new SymfonyTranslatorTwigExtension($container->get(Translator::class))
);

require_once __DIR__ . '/../bootstrap/middleware.php';

require_once __DIR__ . '/../routes/web.php';

$app->run();
