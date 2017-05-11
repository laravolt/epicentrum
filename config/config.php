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
    'menu'  => [
        'enable' => true
    ],
    'role'  => [
        'multiple' => true
    ],
    'repository' => [
        'criteria' => [
            \Prettus\Repository\Criteria\RequestCriteria::class,
        ],
    ],
];
