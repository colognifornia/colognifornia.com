<?php

return [

    'path' => __DIR__ . '/../resources/views',

    'cache' => getenv('GOOGLE_CLOUD_PROJECT') ? sys_get_temp_dir() . '/views' : __DIR__ . '/../tmp/views',

];
