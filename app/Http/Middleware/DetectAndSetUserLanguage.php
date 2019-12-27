<?php

namespace Colognifornia\Web\Http\Middleware;

use Colognifornia\Web\Session\Session;
use Colognifornia\Web\Config\Config;
use Locale;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Symfony\Component\Translation\Translator;

/**
 * Class DetectAndSetUserLanguage
 *
 * @package Colognifornia\Web\Http\Middleware
 */
class DetectAndSetUserLanguage
{

    /**
     * @var
     */
    protected $translator;

    /**
     * DetectAndSetUserLanguage constructor.
     *
     * @param Translator $translator
     * @param Config $config
     */
    public function __construct(Translator $translator, Config $config)
    {
        $this->translator = $translator;
        $this->config = $config;
    }

    /**
     * @param Request $request
     * @param RequestHandler $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $this->translator->setLocale($this->detectLanguage($request));

        return $handler->handle($request);
    }

    /**
     * @param Request $request
     * @return string
     */
    protected function detectLanguage(Request $request) : string
    {
        $lang = $this->parseRequestedLocale($request) ?? Session::get('hl');

        if (!empty($lang) && $this->isSupportedLanguage($lang)) {
            Session::put('hl', $lang);

            return $lang;
        }

        $lang = Locale::getPrimaryLanguage($request->getServerParams()['HTTP_ACCEPT_LANGUAGE'] ?? 'en');

        if (!empty($lang) && $this->isSupportedLanguage($lang)) {
            return $lang;
        }

        return 'en';
    }

    /**
     * @param Request $request
     * @return string|null
     */
    protected function parseRequestedLocale(Request $request) : ?string
    {
        $hl = $request->getQueryParams()['hl'] ?? null;

        $lang = !empty($hl) ? Locale::parseLocale($hl)['language'] : null;

        return $lang;
    }

    /**
     * @param string $lang
     * @return bool
     */
    protected function isSupportedLanguage(string $lang) : bool
    {
        return in_array($lang, $this->config->get('app.supported_languages'));
    }
}
