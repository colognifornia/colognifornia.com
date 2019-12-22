<?php

namespace Colognifornia\Web\Config\Exceptions;

use Colognifornia\Web\Exceptions\Exception;

/**
 * Class RequestedConfigNotDefinedException
 *
 * @package Colognifornia\Web\Config\Exceptions
 */
class RequestedConfigNotDefinedException extends Exception
{

    /**
     * @var string
     */
    protected $message = 'The requested config item is not defined';

}
