<?php

namespace Colognifornia\Web\Config\Exceptions;

use Colognifornia\Web\Exceptions\Exception;

/**
 * Class ConfigNotDefinedException
 *
 * @package Colognifornia\Web\Config\Exceptions
 */
class ConfigNotFoundException extends Exception
{

    /**
     * @var string
     */
    protected $message = 'No config has been defined for the application';

}
