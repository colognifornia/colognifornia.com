<?php

return [

    'base_url' => getenv('GOOGLE_CLOUD_PROJECT') ? 'https://colognifornia.com' : 'http://localhost:8000',

    'debug' => getenv('GOOGLE_CLOUD_PROJECT') ? false : true,

    'default_lang' => 'en',

    'fallback_lang' => 'en',

    'supported_languages' => [
        'de',
        'en',
    ],

];
