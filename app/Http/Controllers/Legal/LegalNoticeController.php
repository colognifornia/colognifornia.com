<?php

namespace Colognifornia\Web\Http\Controllers\Legal;

use Colognifornia\Web\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Class LegalNoticeController
 *
 * @package Colognifornia\Web\Http\Controllers\Legal
 */
class LegalNoticeController extends Controller
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
        $this->view($request, $response, 'legal/legal-notice.twig');

        return $response;
    }
}
