<?php

namespace Colognifornia\Web\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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

    /**
     * @param Request $request
     * @param Response $response
     * @param string $view
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function view(Request $request, Response $response, string $view)
    {
        $this->view->getEnvironment()->addGlobal('request', $request);

        $this->view->render($response, $view);
    }
}
