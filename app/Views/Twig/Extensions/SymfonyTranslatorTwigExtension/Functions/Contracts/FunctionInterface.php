<?php

namespace Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions\Contracts;

use Twig\TwigFunction;

/**
 * Interface FunctionInterface
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\SymfonyTranslatorTwigExtension\Functions\Contracts
 */
interface FunctionInterface
{

    /**
     * @return TwigFunction
     */
    public function getTwigFunction() : TwigFunction;

}
