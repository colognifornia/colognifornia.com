<?php

use DI\Bridge\Slim\Bridge as AppFactory;

$app = AppFactory::create();

require_once __DIR__ . '/../bootstrap/container.php';

require_once __DIR__ . '/../bootstrap/middleware.php';

require_once __DIR__ . '/../routes/web.php';

$app->run();
