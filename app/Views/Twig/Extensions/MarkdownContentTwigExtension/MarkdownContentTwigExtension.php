<?php

namespace Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension;

use Colognifornia\Web\Config\Config;
use Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension\Functions\GetMarkdownContent;
use Symfony\Component\Translation\Translator;
use Twig\Extension\AbstractExtension as TwigExtension;

/**
 * Class MarkdownContentTwigExtension
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension
 */
class MarkdownContentTwigExtension extends TwigExtension
{
    
    /**
     * MarkdownContentTwigExtension constructor.
     *
     * @param Translator $translator 
     */
    public function __construct(protected Translator $translator, protected Config $config) {}

    /**
     * @return array|\Twig\TwigFunction[]
     */
    public function getFunctions()
    {
        return [
          (new GetMarkdownContent($this->translator, $this->config))->getTwigFunction()
        ];
    }
}
