<?php

namespace Colognifornia\Web\Support\Content;

/**
 * Class ContentFileReader
 *
 * @package Colognifornia\Web\Support\Content
 */
class ContentFileReader
{

  /**
   * Read contents of Markdown content file
   *
   * @param string $path
   * @param string $locale
   * @return string|bool
   */
  public static function readContentFile(string $path, string $locale): string|bool
  {
    $pathArr = explode('/', $path);
    $fullPath = $path . '/' . $pathArr[array_key_last($pathArr)]
      . '.' . $locale . '.md';
    
    if (!file_exists($fullPath)) {
      return false;
    }

    return file_get_contents($fullPath);
  }
    
}
