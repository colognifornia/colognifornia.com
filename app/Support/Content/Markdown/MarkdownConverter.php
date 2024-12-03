<?php

namespace Colognifornia\Web\Support\Content\Markdown;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use Twig\Extra\Markdown\LeagueMarkdown;
use Twig\Extra\Markdown\MarkdownInterface;

/**
 * Class MarkdownConverter
 *
 * @package Colognifornia\Web\Support\Content\Markdown
 */
class MarkdownConverter implements MarkdownInterface
{

  /**
   * @var MarkdownInterface
   */
  protected MarkdownInterface $converter;

  /**
   * MarkdownConverter constructor.
   */
  public function __construct()
  {
    if (class_exists(CommonMarkConverter::class)) {
      $commonMark = new CommonMarkConverter([
        'external_link' => [
          'internal_hosts' => ['colognifornia.com', 'colognifornia.de', 'colognifornia.test'],
          'open_in_new_window' => true,
          'noopener' => 'external',
          'noreferrer' => '',
        ],
        'autolink' => [
          'allowed_protocols' => ['https'],
          'default_protocol' => 'https',
        ]
      ]);

      $commonMark->getEnvironment()->addExtension(new ExternalLinkExtension);
      $commonMark->getEnvironment()->addExtension(new AutolinkExtension);

      $this->converter = new LeagueMarkdown($commonMark);
    } else {
      throw new \LogicException('You cannot use the "markdown_to_html" filter as no Markdown library is available; try running "composer require league/commonmark".');
    }
  }

  /**
   * Convert markdown with the configured converter
   *
   * @param string $body
   * @return string
   */
  public function convert(string $body): string
  {
    return $this->converter->convert($body);
  }
}
