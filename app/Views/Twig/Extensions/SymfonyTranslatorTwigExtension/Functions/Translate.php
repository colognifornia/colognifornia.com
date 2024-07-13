<?php

namespace Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions;

use Colognifornia\Web\Views\Twig\Extensions\Contracts\FunctionInterface;
use Symfony\Component\Translation\Translator;
use Twig\TwigFunction;

/**
 * Class Translate
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions
 */
class Translate implements FunctionInterface
{

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * Translate constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return TwigFunction
     */
    public function getTwigFunction() : TwigFunction
    {
        return new TwigFunction('__', $this->getClosure());
    }

    /**
     * @return callable
     */
    protected function getClosure() : callable
    {
        return function (string $id, array $parameters = [], $domain = null, $locale = null) {
            return $this->translator->trans($id, $parameters, $domain, $locale);
        };
    }
}
