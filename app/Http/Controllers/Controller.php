<?php

namespace Colognifornia\Web\Http\Controllers;

use Slim\Views\Twig;

/**
 * Class Controller
 *
 * @package Colognifornia\Web\Http\Controllers
 */
abstract class Controller
{

    /**
     * @var
     */
    protected $view;

    /**
     * HomeController constructor.
     *
     * @param Twig $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }
}
