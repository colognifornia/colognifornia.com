<?php

namespace Colognifornia\Web\Views\Twig\Extensions\Contracts;

use Twig\TwigFunction;

/**
 * Interface FunctionInterface
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\Contracts
 */
interface FunctionInterface
{

    /**
     * @return TwigFunction
     */
    public function getTwigFunction() : TwigFunction;

}
