<?php

use Colognifornia\Web\Http\Controllers\HomeController;

$app->get('/', [ HomeController::class, 'index' ]);
