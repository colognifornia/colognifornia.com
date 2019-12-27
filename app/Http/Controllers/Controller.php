<?php

namespace Colognifornia\Web\Http\Controllers;

use Colognifornia\Web\Config\Config;
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
     * @var Twig
     */
    protected $view;

    /**
     * @var Config
     */
    protected $config;

    /**
     * HomeController constructor.
     *
     * @param Twig $view
     */
    public function __construct(Twig $view, Config $config)
    {
        $this->view = $view;
        $this->config = $config;
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
        $this->view->render($response, $view, $this->exposeToView());
    }

    /**
     * @return array
     */
    protected function exposeToView() : array
    {
        return [
            'base_url' => $this->config->get('app.base_url'),
        ];
    }
}
