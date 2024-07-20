<?php

namespace Colognifornia\Web\Views\Twig\Extensions\Runtime;

use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

/**
 * Class TwigRuntimeLoader
 *
 * @package Colognifornia\Web\Views\Twig\Extensions\Runtime
 */
class TwigRuntimeLoader implements RuntimeLoaderInterface {
    public function load($class)
    {
        if (MarkdownRuntime::class === $class) {
            return new MarkdownRuntime(new DefaultMarkdown());
        }
    }
}