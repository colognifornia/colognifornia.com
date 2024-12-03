<?php

namespace Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension\Functions;

use Colognifornia\Web\Config\Config;
use Colognifornia\Web\Support\Content\ContentFileReader;
use Colognifornia\Web\Views\Twig\Extensions\Contracts\FunctionInterface;
use Symfony\Component\Translation\Translator;
use Twig\TwigFunction;

/**
 * Class GetMarkdownContent
 *
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\MarkdownContentTwigExtension\Functions
 */
class GetMarkdownContent implements FunctionInterface
{

    /**
     * GetMarkdownContent constructor.
     *
     * @param Translator $translator
     */
    public function __construct(protected Translator $translator, protected Config $config) {}

    /**
     * @return TwigFunction
     */
    public function getTwigFunction() : TwigFunction
    {
        return new TwigFunction('get_markdown_content', $this->getClosure());
    }

    /**
     * @return callable
     */
    protected function getClosure() : callable
    {
        return function (string $contentPath): string {
            $path = $this->config->get('content.path') . '/' . $contentPath;
            
            $content = ContentFileReader::readContentFile($path, $this->translator->getLocale());
            
            return $content ? $content : '';
        };
    }
}
