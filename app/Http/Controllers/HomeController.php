<?php

namespace Colognifornia\Web\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class HomeController
 *
 * @package Colognifornia\Web\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(Request $request, Response $response)
    {
        $this->view->render($response, 'home.twig');

        return $response;
    }
}
