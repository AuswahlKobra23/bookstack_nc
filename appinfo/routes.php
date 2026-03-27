<?php

return [
    'routes' => [
        [
            'name' => 'view#index',
            'url'  => '/',
            'verb' => 'GET',
        ],
        [
            'name' => 'view#show',
            'url'  => '/page/{pageId}',
            'verb' => 'GET',
        ],
        [
            'name' => 'settings#saveAdmin',
            'url'  => '/admin/settings',
            'verb' => 'POST',
        ],
        [
            'name' => 'settings#savePersonal',
            'url'  => '/personal/settings',
            'verb' => 'POST',
        ],
    ],
];
