<?php

namespace Colognifornia\Web\Http\Controllers\Errors;

use Colognifornia\Web\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class HttpNotFoundController
 *
 * @package Colognifornia\Web\Http\Controllers\Errors
 */
class HttpNotFoundController extends Controller
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
        $this->view($request, $response, 'errors/404.twig');

        return $response;
    }
}
