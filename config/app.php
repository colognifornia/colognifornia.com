<?php

return [

    'debug' => getenv('GOOGLE_CLOUD_PROJECT') ? false : true,

    'default_lang' => 'en',

    'fallback_lang' => 'en',

    'supported_languages' => [
        'de',
        'en',
    ],

];
