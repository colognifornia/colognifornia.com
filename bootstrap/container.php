<?php

use Colognifornia\Web\Config\Config;
use Slim\Views\Twig;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use DI\Container;

return [
    Config::class => DI\create(Config::class)
        ->method('set', require_once __DIR__ . '/../config/config.php'),
    Twig::class => function (Container $container) {
        return Twig::create($container->get(Config::class)->get('view.path'), [
            'cache' => $container->get(Config::class)->get('app.debug') ? false : $container->get(Config::class)->get('view.cache'),
        ]);
    },
    Translator::class => function (Container $container) {
        $translator = new Translator(
            $container->get(Config::class)->get('app.default_lang')
        );

        $translator->addLoader('array', new ArrayLoader());
        $translator->addResource('array', require_once __DIR__ . '/../resources/lang/lang.de.php', 'de');
        $translator->addResource('array', require_once __DIR__ . '/../resources/lang/lang.en.php', 'en');
        $translator->setFallbackLocales([ $container->get(Config::class)->get('app.fallback_lang') ]);

        return $translator;
    },
];
