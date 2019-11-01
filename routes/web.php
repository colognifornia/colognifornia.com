<?php

use Colognifornia\Web\Http\Controllers\HomeController;
use Colognifornia\Web\Http\Controllers\Legal\LegalNoticeController;
use Colognifornia\Web\Http\Controllers\Legal\PrivacyPolicyController;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', [ HomeController::class, 'index' ]);

$app->group('/legal', function (RouteCollectorProxy $group) {
    $group->get('/legal-notice', [ LegalNoticeController::class, 'index' ]);
    $group->get('/privacy-policy', [ PrivacyPolicyController::class, 'index' ]);
});
