<?php

namespace Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions;

use Colognifornia\Web\Views\Twig\Extensions\Contracts\FunctionInterface;
use Symfony\Component\Translation\Translator;
use Twig\TwigFunction;

/**
 * Class GetLocale
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions
 */
class GetLocale implements FunctionInterface
{

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * GetLocale constructor.
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
        return new TwigFunction('get_locale', $this->getClosure());
    }

    /**
     * @return callable
     */
    protected function getClosure() : callable
    {
        return function () {
            return $this->translator->getLocale();
        };
    }
}
