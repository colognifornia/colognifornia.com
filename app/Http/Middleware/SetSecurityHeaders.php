<?php

namespace Colognifornia\Web\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

/**
 * Class SetSecurityHeaders
 *
 * @package Colognifornia\Web\Http\Middleware
 */
class SetSecurityHeaders
{

    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $request = $request->withHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        $request = $request->withHeader('X-Frame-Options', 'SAMEORIGIN');

        $request = $request->withHeader('X-Content-Type-Options', 'nosniff');

        $request = $request->withHeader('Referrer-Policy', 'no-referrer-when-downgrade');

        return $handler->handle($request);
    }
}
