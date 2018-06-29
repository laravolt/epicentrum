<?php
/*
 * Set specific configuration variables here
 */
return [
    'route'                 => [
        'enable'     => true,
        'middleware' => ['web', 'auth'],
        'prefix'     => 'epicentrum',
    ],
    'view'                  => [
        'layout' => 'ui::layouts.app',
    ],
    'menu'                  => [
        'enable' => true,
    ],
    'role'                  => [
        'multiple' => true,
    ],
    'repository'            => [
        'criteria' => [
            \Prettus\Repository\Criteria\RequestCriteria::class,
            \Laravolt\Epicentrum\Repositories\Criteria\WithTrashedCriteria::class,
        ],
    ],
    'user_available_status' => [
        'PENDING' => 'PENDING',
        'ACTIVE'  => 'ACTIVE',
    ],
    'models' => [
        'role'  => \Laravolt\Acl\Models\Role::class,
    ],
];
