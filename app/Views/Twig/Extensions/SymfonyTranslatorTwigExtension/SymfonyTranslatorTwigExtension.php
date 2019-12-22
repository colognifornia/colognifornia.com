<?php

namespace Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension;

use Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions\GetLocale;
use Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions\Translate;
use Symfony\Component\Translation\Translator;
use Twig\Extension\AbstractExtension as TwigExtension;

/**
 * Class SymfonyTranslatorTwigExtension
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension
 */
class SymfonyTranslatorTwigExtension extends TwigExtension
{

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * SymfonyTranslatorTwigExtension constructor.
     *
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array|\Twig\TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            (new Translate($this->translator))->getTwigFunction(),
            (new GetLocale($this->translator))->getTwigFunction(),
        ];
    }
}
