<?php
/*
 * Set specific configuration variables here
 */
return [
    'route' => [
        'enable'     => true,
        'middleware' => ['web', 'auth'],
        'prefix'     => 'epicentrum'
    ],
    'view'  => [
        'layout' => 'layouts.base'
    ],
];
