<?php

use Colognifornia\Web\Config\Config;
use Colognifornia\Web\Session\Session;
use Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension\MarkdownContentTwigExtension;
use Colognifornia\Web\Views\Twig\Extensions\Runtime\TwigRuntimeLoader;
use Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\SymfonyTranslatorTwigExtension;
use Symfony\Component\Translation\Translator;
use DI\Bridge\Slim\Bridge as AppFactory;
use DI\ContainerBuilder;
use Slim\Views\Twig;
use Twig\Extra\Markdown\MarkdownExtension;

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/container.php');
$container = $builder->build();

$app = AppFactory::create($container);

Session::start([
    'cookie_secure' => getenv('GOOGLE_CLOUD_PROJECT') ? true : false,
]);

$twig = $container->get(Twig::class);
$twig->addExtension(
    new SymfonyTranslatorTwigExtension($container->get(Translator::class))
);
$twig->addExtension(new MarkdownExtension);
$twig->addRuntimeLoader(new TwigRuntimeLoader);
$twig->addExtension(
    new MarkdownContentTwigExtension(
        $container->get(Translator::class),
        $container->get(Config::class)
    )
);

require_once __DIR__ . '/../bootstrap/middleware.php';

require_once __DIR__ . '/../routes/web.php';

$app->run();
