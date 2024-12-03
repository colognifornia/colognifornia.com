<?php

return [

    'base_url' => getenv('GOOGLE_CLOUD_PROJECT') ? 'https://colognifornia.com' : 'https://colognifornia.test',

    'debug' => getenv('GOOGLE_CLOUD_PROJECT') ? false : true,

    'default_lang' => 'en',

    'fallback_lang' => 'en',

    'supported_languages' => [
        'de',
        'en',
    ],

];
